<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Ramsey\Uuid\Uuid;

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
        $callControlId = $payload['data']['payload']['call_control_id'] ?? null;

        if (!$event || !$callControlId) {
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        switch ($event) {
            case 'call.initiated':
                // Handle the event when the call is initiated
                $this->handleCallInit($callControlId, $payload['data']['payload']);
                break;

            case 'call.answered':
                // Handle the event when the call is answered
                $this->handleCallAnswered($callControlId, $payload['data']['payload']);
                break;

            case 'call.dtmf.received':
                // Handle the event when a DTMF digit (button press) is received
                $digit = $payload['data']['payload']['digit'] ?? null;
                if ($digit !== null && method_exists($this, "handleDigit$digit")) {
                    \Log::info('Processing DTMF digit', ['digit' => $digit]);
                    $this->{"handleDigit$digit"}($callControlId, $payload['data']['payload']);
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
                    $this->handleTimeout($callControlId, $payload['data']['payload']);
                }
                break;

            default:
                // Handle any other events that do not match
                \Log::info('Unhandled event type', ['event' => $event]);
                break;
        }
    }

    private function handleCallInit(string $callControlId, $payload): void
    {
        \Log::info('Call initiated for answer');
        $endpoint = "/calls/$callControlId/actions/answer";
        $commandId = Uuid::uuid4()->toString();

        \Log::info('Attempting to answer call', [
            'call_control_id' => $callControlId,
        ]);

        try {
            $response = $this->makeTelnyxApiCall($endpoint, 'POST', [
                'client_state' => $payload['client_state'],
                'command_id' => $commandId,
                'webhook_url' => 'https://onetimeonetime.net/webhook/telnyx',
                'webhook_url_method' => 'POST',
                'send_silence_when_idle' => true,
            ]);

            \Log::info('Call answered successfully', [
                'response' => $response,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error answering call', [
                'call_control_id' => $callControlId,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function handleCallAnswered(string $callControlId, $payload): void
    {
        \Log::info('Call answered', ['call_control_id' => $callControlId]);
        $this->playAudioPrompt($callControlId, "https://onetimeonetime.net/audio/fingerer.mp3", $payload);
    }

    private function handleDigit0(string $callControlId, $payload): void
    {
        \Log::info('No input timeout', ['call_control_id' => $callControlId]);
        $this->playAudioPrompt($callControlId, "https://onetimeonetime.net/audio/fingerer.mp3", $payload);
    }

    private function handleDigit1(string $callControlId, $payload): void
    {
        $this->playAudioPrompt($callControlId, "https://onetimeonetime.net/audio/fires.mp3", $payload);
    }

    private function handleDigit2(string $callControlId, $payload): void
    {
        $this->playAudioPrompt($callControlId, "https://onetimeonetime.net/audio/fingerer.mp3", $payload);
    }

    private function handleDigit3(string $callControlId, $payload): void
    {
        $this->playAudioPrompt($callControlId, "https://onetimeonetime.net/audio/fires.mp3", $payload);
    }

    private function handleDigit4(string $callControlId, $payload): void
    {
        $this->playAudioPrompt($callControlId, "https://onetimeonetime.net/audio/fingerer.mp3", $payload);
    }

    private function handleDigit5(string $callControlId, $payload): void
    {
        $this->playAudioPrompt($callControlId, "https://onetimeonetime.net/audio/fires.mp3", $payload);
    }

    private function handleDigit6(string $callControlId, $payload): void
    {
        $this->playAudioPrompt($callControlId, "https://onetimeonetime.net/audio/fingerer.mp3", $payload);
    }

    private function handleDigit7(string $callControlId, $payload): void
    {
        $this->playAudioPrompt($callControlId, "https://onetimeonetime.net/audio/fires.mp3", $payload);
    }

    private function handleDigit8(string $callControlId, $payload): void
    {
        $this->playAudioPrompt($callControlId, "https://onetimeonetime.net/audio/fingerer.mp3", $payload);
    }

    private function handleDigit9(string $callControlId, $payload): void
    {
        $this->playAudioPrompt($callControlId, "https://onetimeonetime.net/audio/fires.mp3", $payload);
    }

    private function handleTimeout(string $callControlId, $payload): void
    {
        \Log::info('No input timeout', ['call_control_id' => $callControlId]);
        $this->playAudioPrompt($callControlId, "https://onetimeonetime.net/audio/fingerer.mp3", $payload);
    }

    private function playAudioPrompt(string $callControlId, string $audioUrl, $payload): void
    {
        \Log::info('Attempting to play audio prompt', [
            'call_control_id' => $callControlId,
            'audio_url' => $audioUrl,
        ]);

        $endpoint = "/calls/$callControlId/actions/playback_start";
        $commandId = Uuid::uuid4()->toString();

        try {
            $response = $this->makeTelnyxApiCall($endpoint, 'POST', [
                'audio_url' => $audioUrl,
                'loop' => 'infinity',
                'overlay' => true,
                'stop' => 'current',
                'target_legs' => 'self',
                'client_state' => $payload['client_state'],
                'command_id' => $commandId,
            ]);
    
            // Log the response from Telnyx
            \Log::info('Audio prompt played successfully', [
                'response' => $response,
            ]);
        } catch (\Exception $e) {
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
