<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TelnyxWebhookController extends Controller
{
    private $apiKey;
    private $apiBaseUrl;

    public function __construct()
    {
        $this->apiKey = env('TELNYX_API_KEY');
        $this->apiBaseUrl = env('TELNYX_API_BASE_URL', 'https://api.telnyx.com/v2');
    }

    public function handle(Request $request)
    {
        \Log::info('Call initiated');

        // Log telnyx request
        \Log::info('Telnyx API Request', [
            'request' => $request,
        ]);

        // Get the raw POST data from the webhook
        $rawPayload = file_get_contents('php://input');
        $payload = json_decode($rawPayload, true);
    
        // Log telnyx request
        \Log::info('Telnyx API Request', [
            'payload' => $payload,
        ]);

        $event = $payload['data']['event_type'] ?? null;
        $callControlId = $payload['data']['call_control_id'] ?? null;

        if (!$event || !$callControlId) {
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        switch ($event) {
            case 'call.initiated':
                // Handle the event when the call is initiated
                $this->handleCallInit();
                break;

            case 'call.answered':
                // Handle the event when the call is answered
                $this->handleCallAnswered($callControlId);
                break;

            case 'call.dtmf.received':
                // Handle the event when a DTMF digit (button press) is received
                $digit = $payload['data']['digit'] ?? null;
                if ($digit !== null && method_exists($this, "handleDigit$digit")) {
                    \Log::info('Processing DTMF digit', ['digit' => $digit]);
                    $this->{"handleDigit$digit"}($callControlId);
                }
                break;

            case 'call.hangup':
                // Handle the event when the call is hung up
                \Log::info('Call hangup received', ['call_control_id' => $callControlId]);
                break;

            case 'call.gather.ended':
                // Handle the event when the gather has ended (no input received)
                $result = $payload['data']['result'];
                if ($result === 'no_input') {
                    $this->handleTimeout($callControlId);
                }
                break;

            default:
                // Handle any other events that do not match
                \Log::info('Unhandled event type', ['event' => $event]);
                break;
        }
    }

    private function handleCallInit(): void
    {
        \Log::info('Call initiated');
    }

    private function handleCallAnswered(string $callControlId): void
    {
        \Log::info('Call answered', ['call_control_id' => $callControlId]);
        $this->playAudioPrompt($callControlId, `https://onetimeonetime.net/audio/fingerer.mp3`);
    }

    private function handleDigit0(string $callControlId): void
    {
        \Log::info('No input timeout', ['call_control_id' => $callControlId]);
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/fingerer.mp3');
    }

    private function handleDigit1(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, `https://onetimeonetime.net/audio/fires.mp3`);
    }

    private function handleDigit2(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/fingerer.mp3');
    }

    private function handleDigit3(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, `https://onetimeonetime.net/audio/fires.mp3`);
    }

    private function handleDigit4(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/fingerer.mp3');
    }

    private function handleDigit5(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, `https://onetimeonetime.net/audio/fires.mp3`);
    }

    private function handleDigit6(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/fingerer.mp3');
    }

    private function handleDigit7(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, `https://onetimeonetime.net/audio/fires.mp3`);
    }

    private function handleDigit8(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/fingerer.mp3');
    }

    private function handleDigit9(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, `https://onetimeonetime.net/audio/fires.mp3`);
    }

    private function handleTimeout(string $callControlId): void
    {
        \Log::info('No input timeout', ['call_control_id' => $callControlId]);
        $this->playAudioPrompt($callControlId, `https://onetimeonetime.net/audio/fingerer.mp3`);
    }

    private function playAudioPrompt(string $callControlId, string $audioUrl): void
    {
        try {
            \Log::info('Attempting to play audio prompt', [
                'call_control_id' => $callControlId,
                'audio_url' => $audioUrl,
            ]);

            // Create the call with audio prompt
            $response = $this->makeTelnyxApiCall('/calls', 'POST', [
                'call_control_id' => $callControlId,
                'audio_url' => $audioUrl,
            ]);
            
            // Log the response from Telnyx
            \Log::info('Audio prompt played successfully', [
                'response' => $response,
            ]);
        }
        catch (\Exception $e) {
            // Log the error if the API call fails
            \Log::error('Error playing audio prompt', [
                'call_control_id' => $callControlId,
                'audio_url' => $audioUrl,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function makeTelnyxApiCall($endpoint, $method = 'GET', $data = [])
    {
        $client = new Client();
        
        $options = [
            'headers' => [
                'Authorization' => "Bearer $this->apiKey",
                'Content-Type' => 'application/json',
            ],
        ];
        
        if ($method === 'POST' || $method === 'PUT') {
            $options['json'] = $data;
        }

        $response = $client->request($method, $this->apiBaseUrl . $endpoint, $options);

        return json_decode((string) $response->getBody(), true);
    }
}
