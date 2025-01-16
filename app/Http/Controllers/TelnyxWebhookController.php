<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telnyx\Call;

class TelnyxWebhookController extends Controller
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('TELNYX_API_KEY');
        
        // Initialize Telnyx with your API key once
        \Telnyx\Telnyx::setApiKey($this->apiKey);
    }

    public function handle(Request $request)
    {
        // Get the raw POST data from the webhook
        $rawPayload = file_get_contents('php://input');
        $payload = json_decode($rawPayload, true);
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
                    $this->{"handleDigit$digit"}($callControlId);
                }
                break;

            case 'call.hangup':
                // Handle the event when the call is hung up
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
                break;
        }
    }

    private function handleCallInit(): void
    {
        // Logic for call initiated
    }

    private function handleCallAnswered(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/pre.mp3');
    }

    private function handleDigit0(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/pre.mp3');
    }

    private function handleDigit1(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/one.wav');
    }

    private function handleDigit2(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/two.wav');
    }

    private function handleDigit3(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/three.wav');
    }

    private function handleDigit4(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/four.wav');
    }

    private function handleDigit5(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/five.wav');
    }

    private function handleDigit6(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/six.wav');
    }

    private function handleDigit7(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/seven.wav');
    }

    private function handleDigit8(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/eight.wav');
    }

    private function handleDigit9(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/nine.wav');
    }

    private function handleTimeout(string $callControlId): void
    {
        $this->playAudioPrompt($callControlId, 'https://onetimeonetime.net/audio/Wed.mp3');
    }

    private function playAudioPrompt(string $callControlId, string $audioUrl): void
    {
        echo $callControlId.'<br>';
        echo $audioUrl.'<br>';
        try {
            // Using the correct Telnyx Call::create method
            Call::create([
                'call_control_id' => $callControlId,
                'audio_url' => $audioUrl,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error creating call with audio: ' . $e->getMessage());
        }
    }
}
