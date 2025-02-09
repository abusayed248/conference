<?php
namespace App\Http\Controllers;

use App\Models\CallAction;
use App\Models\SubCallAction;
use App\Models\TelnyxEvent;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Log;

use App\Services\SubscriptionsService;

class TelnyxWebhookController extends Controller
{
    private $apiKey;
    private $apiBaseUrl;

    private $subscriptionsService;

    public function __construct(SubscriptionsService $subscriptionsService)
    {
        $this->apiKey = env('TELNYX_API_KEY');
        $this->apiBaseUrl = env('TELNYX_API_BASE_URL', 'https://api.telnyx.com/v2');

        $this->subscriptionsService = $subscriptionsService;
    }

    public function handle(Request $request)
    {
        Log::info('Call initiated');

        // Log telnyx request
        Log::info('Telnyx API Request', [
            'request' => $request,
        ]);

        // Get the raw POST data from the webhook
        $rawInputData = file_get_contents('php://input');
        $requestData = json_decode($rawInputData, true);

        // Log telnyx request
        Log::info('Telnyx API Request', [
            'requestData' => $requestData,
        ]);

        $event = $requestData['data']['event_type'] ?? null;
        $payload = $requestData['data']['payload'];
        $callControlId = $payload['call_control_id'] ?? null;

        if (!$event || !$callControlId) {
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        switch ($event) {
            case 'call.initiated':
                // Handle the event when the call is initiated
                $this->callInitAction($callControlId, $payload, false);
                break;

            case 'call.answered':
                // Handle the event when the call is answered
                $this->callAnswerAction($callControlId, $payload);
                break;

            case 'call.dtmf.received':
                // Handle the event when a DTMF digit (button press) is received
                $digit = $payload['digit'] ?? null;
                if ($digit !== null) {
                    Log::info('Processing DTMF digit', ['digit' => $digit]);

                    if ($digit == '0' || $digit == 0) {
                        // Back to the main menu
                        $this->callAnswerAction($callControlId, $payload);
                    }
                    else {
                        $callAction = CallAction::query()->where('digit', $digit)->first();
                        Log::info('CallAction data found in database', $callAction->toArray());

                        if ($callAction) {
                            if ($callAction->type == 'transfer' && $callAction->transfer_to) {
                                // $this->{"handleDigit$digit"}($callControlId, $payload['data']['payload']);
                                $this->callTransfer($callControlId, $payload, $callAction);
                            }
                            elseif ($callAction->type == 'audio' && $callAction->audio_link) {
                                $this->playAudioPrompt($callControlId, $callAction->audio_link, $payload);
                            }
                            elseif ($callAction->type == 'sub_menu') {
                                // Call initiated to manage submenu
                                $this->callInitAction($callControlId, $payload, true);
                            }
                            else {
                                Log::info('Invalid data found in database', $callAction->toArray());
                            }
                        }
                        else {
                            Log::info('No data found with the digit ' . $digit, $requestData);
                        }
                    }
                }
                break;

            case 'call.hangup':
                // Handle the event when the call is hung up
                Log::info('Call hangup received', ['call_control_id' => $callControlId]);
                break;

            case 'call.gather.ended':
                // Handle the event when the gather has ended (no input received)
                $result = $requestData['data']['result'];
                if ($result === 'no_input') {
                    $this->timeoutAction($callControlId, $payload);
                }
                break;

            default:
                // Handle any other events that do not match
                Log::info('Unhandled event type', ['event' => $event]);
                break;
        }
    }

    public function handleSubmenu(Request $request) {
        Log::info('Call initiated for submenu');

        // Log telnyx request
        Log::info('Telnyx API Request', [
            'request' => $request,
        ]);

        // Get the raw POST data from the webhook
        $rawInputData = file_get_contents('php://input');
        $requestData = json_decode($rawInputData, true);

        // Log telnyx request
        Log::info('Telnyx API Request', [
            'requestData' => $requestData,
        ]);

        $event = $requestData['data']['event_type'] ?? null;
        $payload = $requestData['data']['payload'];
        $callControlId = $payload['call_control_id'] ?? null;

        if (!$event || !$callControlId) {
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        switch ($event) {
            case 'call.answered':
                // Handle the event when the call is answered
                $this->callAnswerAction($callControlId, $payload, true);
                break;

            case 'call.dtmf.received':
                // Handle the event when a DTMF digit (button press) is received
                $digit = $payload['digit'] ?? null;
                if ($digit !== null) {
                    Log::info('Processing DTMF digit', ['digit' => $digit]);

                    if ($digit == '0' || $digit == 0) {
                        // Back to the main menu
                        // Handle the event when the call is initiated
                        $this->callInitAction($callControlId, $payload, false);
                    }
                    else {
                        $callAction = SubCallAction::query()->where('digit', $digit)->first();
                        Log::info('SubCallAction data found in database', $callAction->toArray());

                        if ($callAction) {
                            if ($callAction->type == 'transfer' && $callAction->transfer_to) {
                                // $this->{"handleDigit$digit"}($callControlId, $payload);
                                $this->callTransfer($callControlId, $payload, $callAction);
                            }
                            elseif ($callAction->type == 'audio' && $callAction->audio_link) {
                                $this->playAudioPrompt($callControlId, $callAction->audio_link, $payload);
                            }
                            elseif ($callAction->type == 'sub_menu') {
                                // Call initiated to manage submenu
                                $this->callInitAction($callControlId, $payload, true);
                            }
                            else {
                                Log::info('Invalid data found in database', $callAction->toArray());
                            }
                        }
                        else {
                            Log::info('No data found with the digit ' . $digit, $requestData);
                        }
                    }
                }
                break;

            case 'call.hangup':
                // Handle the event when the call is hung up
                Log::info('Call hangup received', ['call_control_id' => $callControlId]);
                break;

            case 'call.gather.ended':
                // Handle the event when the gather has ended (no input received)
                $result = $requestData['data']['result'];
                if ($result === 'no_input') {
                    $this->timeoutAction($callControlId, $payload);
                }
                break;

            default:
                // Handle any other events that do not match
                Log::info('Unhandled event type', ['event' => $event]);
                break;
        }
    }

    private function callInitAction(string $callControlId, $payload, $isSubmenu = false): void
    {
        Log::info('Call initiated for answer');
        $endpoint = "/calls/$callControlId/actions/answer";
        $commandId = Uuid::uuid4()->toString();

        Log::info('Attempting to answer call', [
            'call_control_id' => $callControlId,
        ]);

        try {
            TelnyxEvent::create([
                'phone' => $payload['from'],
                'call_control_id' => $callControlId,
                'event_type' => 'call.initiated',
                'command_id' => null,
                'client_state' => $payload['client_state'],
                'payload' => $payload,
                'request' => null
            ]);
        }
        catch(\Exception $e) {
            Log::error('Error failed to create telnyx event in callInitAction', [
                'call_control_id' => $callControlId,
                'error' => $e->getMessage(),
            ]);
        }

        try {
            $response = $this->makeTelnyxApiCall($endpoint, 'POST', [
                'client_state' => $payload['client_state'],
                'command_id' => $commandId,
                'webhook_url' => 'https://onetimeonetime.net/webhook/telnyx' . ($isSubmenu ? '/submenu' : ''),
                'webhook_url_method' => 'POST',
                'send_silence_when_idle' => true,
            ]);

            Log::info('Call answered successfully', [
                'response' => $response,
            ]);
        }
        catch (\Exception $e) {
            Log::error('Error answering call', [
                'call_control_id' => $callControlId,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function callAnswerAction(string $callControlId, $payload, $isSubmenu = false): void
    {
        Log::info('Call answered', ['call_control_id' => $callControlId]);

        if ($isSubmenu) {
            $callAction = SubCallAction::query()
                ->where('type', 'greetings')
                ->whereNotNull('audio_link')
                ->where('audio_link', '!=', '')
                ->first();
        }
        else
        {
            $hasSubscription = $this->subscriptionsService->isActive($payload['from']);
            $type = $hasSubscription ? 'greetings' : 'non_subscriber_greetings';

            $callAction = CallAction::query()
                ->where('type', $type)
                ->whereNotNull('audio_link')
                ->where('audio_link', '!=', '')
                ->first();
        }

        if ($callAction) {
            try {
                TelnyxEvent::create([
                    'phone' => $payload['from'],
                    'call_control_id' => $callControlId,
                    'event_type' => 'call.answered',
                    'command_id' => null,
                    'client_state' => $payload['client_state'],
                    'payload' => $payload,
                    'request' => null
                ]);
            }
            catch(\Exception $e) {
                Log::error('Error failed to create telnyx event in callAnswerAction', [
                    'call_control_id' => $callControlId,
                    'error' => $e->getMessage(),
                ]);
            }

            $this->playAudioPrompt($callControlId, $callAction->audio_link, $payload);
        }
        else {
            Log::info('No greetings audio found', ['call_control_id' => $callControlId]);
        }
    }

    private function timeoutAction(string $callControlId, $payload): void
    {
        Log::info('No input timeout', ['call_control_id' => $callControlId]);
        $this->playAudioPrompt($callControlId, "https://onetimeonetime.net/audio/fingerer.mp3", $payload);
    }

    private function playAudioPrompt(string $callControlId, string $audioUrl, $payload): void
    {
        Log::info('Attempting to play audio prompt', [
            'call_control_id' => $callControlId,
            'audio_url' => $audioUrl,
        ]);

        $endpoint = "/calls/$callControlId/actions/playback_start";
        $commandId = Uuid::uuid4()->toString();

        $request = [
            'audio_url' => $audioUrl,
            'loop' => 1,
            'overlay' => false,
            'stop' => 'all',
            'target_legs' => 'self',
            'client_state' => $payload['client_state'],
            'command_id' => $commandId,
        ];

        try {
            TelnyxEvent::create([
                'phone' => $payload['from'],
                'call_control_id' => $callControlId,
                'event_type' => 'playback_start',
                'command_id' => $commandId,
                'client_state' => $payload['client_state'],
                'payload' => $payload,
                'request' => $request
            ]);
        }
        catch(\Exception $e) {
            Log::error('Error failed to create telnyx event in playAudioPrompt', [
                'call_control_id' => $callControlId,
                'request' => $request,
                'error' => $e->getMessage(),
            ]);
        }

        try {
            $response = $this->makeTelnyxApiCall($endpoint, 'POST', $request);

            // Log the response from Telnyx
            Log::info('Audio prompt played successfully', [
                'response' => $response,
            ]);
        } catch (\Exception $e) {
            // Log the error if the API call fails
            Log::error('Error playing audio prompt', [
                'call_control_id' => $callControlId,
                'audio_url' => $audioUrl,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function stopAudioPrompt(string $callControlId, $payload)
    {
        Log::info('Attempting to stop audio prompt', $payload);

        $lastAudioEvent = TelnyxEvent::where('call_control_id', $callControlId)
            ->where('event_type', 'playback_start')
            ->latest()
            ->first();
        if (!$lastAudioEvent) {
            Log::info('Nothing found to stop', ['call_control_id' => $callControlId]);
            return true;
        }

        $endpoint = "/calls/$callControlId/actions/playback_stop";
        $commandId = $lastAudioEvent->command_id;

        $request = [
            // 'overlay' => false,
            'stop' => 'all',
            // 'client_state' => $payload['client_state'],
            // 'command_id' => $commandId,
        ];

        try {
            TelnyxEvent::create([
                'phone' => $payload['from'],
                'call_control_id' => $callControlId,
                'event_type' => 'playback_stop',
                'command_id' => $commandId,
                'client_state' => $payload['client_state'],
                'payload' => $payload,
                'request' => $request
            ]);
        }
        catch(\Exception $e) {
            Log::error('Error failed to create telnyx event in stopAudioPrompt', [
                'call_control_id' => $callControlId,
                'request' => $request,
                'error' => $e->getMessage(),
            ]);
        }

        try {
            $response = $this->makeTelnyxApiCall($endpoint, 'POST', $request);

            // Log the response from Telnyx
            Log::info('Audio prompt stopped successfully', [
                'response' => $response,
            ]);

            if (isset($response['data']['result'])) {
                return true;
            }
        }
        catch (\Exception $e) {
            // Log the error if the API call fails
            Log::error('Error stopping audio prompt', [
                'call_control_id' => $callControlId,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function callTransfer(string $callControlId, $payload, $callAction)
    {
        Log::info('Attempting to transfer call', [
            'payload' => $payload,
            'callAction' => $callAction,
        ]);

        if (!$this->stopAudioPrompt($callControlId, $payload)) {
            Log::info('Failed to transfer call due to audio not stopped', []);
            return false;
        }

        sleep(2);

        $endpoint = "/calls/$callControlId/actions/transfer";
        $commandId = Uuid::uuid4()->toString();

        $request = [
            'to' => $callAction->transfer_to,
            'from' => '+13606638463',
            'from_display_name' => 'Kids Conversation',
            'time_limit_secs' => (int) $callAction->afer_time,
            'client_state' => $payload['client_state'],
            'command_id' => $commandId,
            'webhook_url' => 'https://onetimeonetime.net/webhook/telnyx',
            'webhook_url_method' => 'POST',
        ];

        try {
            TelnyxEvent::create([
                'phone' => $payload['from'],
                'call_control_id' => $callControlId,
                'event_type' => 'transfer',
                'command_id' => $commandId,
                'client_state' => $payload['client_state'],
                'payload' => $payload,
                'request' => $request
            ]);
        }
        catch(\Exception $e) {
            Log::error('Error failed to create telnyx event in callTransfer', [
                'call_control_id' => $callControlId,
                'request' => $request,
                'error' => $e->getMessage(),
            ]);
        }

        try {
            $response = $this->makeTelnyxApiCall($endpoint, 'POST', $request);

            // Log the response from Telnyx
            Log::info('Call transferred successfully', [
                'response' => $response,
            ]);
        }
        catch (\Exception $e) {
            // Log the error if the API call fails
            Log::error('Error to transfer call', [
                'payload' => $payload,
                'callAction' => $callAction,
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
