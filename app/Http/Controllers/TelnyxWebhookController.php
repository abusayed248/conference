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
                Log::info('call.initiated');
                // Handle the event when the call is initiated
                if ($payload['direction'] == 'incoming') {
                    $this->callInitAction($callControlId, $payload, false);
                }
                break;

            case 'call.answered':
                Log::info('call.answered');
                // Handle the event when the call is answered
                $phone = $this->getPhone($payload['from']);
                $lastTransfer = TelnyxEvent::where('phone', $phone)
                    ->where('event_type', 'transfer')
                    ->where('status', 'processing')
                    ->latest()
                    ->first();
                if (!$lastTransfer) {
                // if ($phone != '+13606638463' && !$lastTransfer) {
                // if ($phone != '+13606638463') {
                    $this->callAnswerAction($callControlId, $payload);
                    return;
                }
                break;

            case 'call.dtmf.received':
                Log::info('call.dtmf.received');
                // Handle the event when a DTMF digit (button press) is received
                $digit = $payload['digit'] ?? null;
                if ($digit !== null) {
                    Log::info('DTMF digit', ['digit' => $digit]);

                    if ($digit == '0' || $digit == 0) {
                        // Making events done
                        TelnyxEvent::where('call_control_id', $callControlId)
                            ->where('event_type', 'sub_menu')
                            ->update(['status' => 'completed']);

                        // Back to the main menu on press 0 with initial audio playback
                        $this->callAnswerAction($callControlId, $payload);
                    }
                    else {
                        $hasCallTransfer = TelnyxEvent::where('call_control_id', $callControlId)
                            ->where('event_type', 'transfer')
                            ->where('status', 'processing')
                            ->latest()
                            ->first();
                        Log::info('hasCallTransfer', ['hasCallTransfer' => $hasCallTransfer]);
                        if ($hasCallTransfer) {
                            break;
                        }

                        $hasSubmenu = TelnyxEvent::where('call_control_id', $callControlId)
                            ->where('event_type', 'sub_menu')
                            ->where('status', 'processing')
                            ->latest()
                            ->first();
                        Log::info('hasSubmenu', ['hasSubmenu' => $hasSubmenu]);
                        if ($hasSubmenu) {
                            $callAction = CallAction::query()->where('digit', $hasSubmenu->payload['digit'])->first();
                            Log::info('sub callAction', ['callAction' => $callAction]);

                            if ($callAction) {
                                Log::info('CallAction data found in database', $callAction->toArray());

                                $subCallAction = SubCallAction::query()
                                    ->where('call_action_id', $callAction->id)
                                    ->where('digit', $digit)
                                    ->first();
                                Log::info('subCallAction', ['subCallAction' => $subCallAction]);

                                if ($subCallAction) {
                                    if ($subCallAction->type == 'transfer' && $subCallAction->transfer_to) {
                                        $this->callTransfer($callControlId, $payload, $subCallAction);
                                    }
                                    elseif ($subCallAction->type == 'audio' && $subCallAction->audio_link) {
                                        $this->playAudioPrompt($callControlId, $subCallAction->audio_link, $payload);
                                    }
                                    else {
                                        Log::info('Invalid data found in database', $subCallAction->toArray());
                                    }
                                }
                            }
                            else {
                                Log::info('No data found with the digit ' . $digit, $requestData);
                            }
                        }
                        else {
                            // Check caller subscription
                            $phone = $this->getPhone($payload['from']);
                            if (!$this->subscriptionsService->isActive($phone)) {
                                Log::info('Call hangup due to not a subscriber');
                                return;
                            }

                            $callAction = CallAction::query()->where('digit', $digit)->first();
                            Log::info('callAction', ['callAction' => $callAction]);

                            if ($callAction) {
                                Log::info('CallAction data found in database', $callAction->toArray());

                                if ($callAction->type == 'transfer' && $callAction->transfer_to) {
                                    $this->callTransfer($callControlId, $payload, $callAction);
                                }
                                elseif ($callAction->type == 'audio' && $callAction->audio_link) {
                                    if ($callAction->audio_link) {
                                        $this->playAudioPrompt($callControlId, $callAction->audio_link, $payload);
                                    }
                                    else {
                                        Log::info("Audio link not found for digit: $digit");
                                    }
                                }
                                elseif ($callAction->type == 'sub_menu') {
                                    TelnyxEvent::create([
                                        'phone' => $this->getPhone($payload['from']),
                                        'call_control_id' => $callControlId,
                                        'event_type' => 'sub_menu',
                                        'command_id' => null,
                                        'client_state' => $payload['client_state'],
                                        'payload' => $payload,
                                        'request' => []
                                    ]);

                                    $subCallAction = SubCallAction::query()
                                        ->where('call_action_id', $callAction->id)
                                        ->where('type', 'greetings')
                                        ->whereNotNull('audio_link')
                                        ->where('audio_link', '!=', '')
                                        ->first();
                                    if ($subCallAction) {
                                        // Play greetings audio for initial of submenu
                                        Log::info('Play greetings audio for initial of submenu');
                                        $this->playAudioPrompt($callControlId, $subCallAction->audio_link, $payload);
                                    }
                                    else {
                                        Log::info('No valid data found to play submenu greetings');
                                    }
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
                }
                break;

            case 'call.hangup':
                Log::info('call.hangup');
                // Making events done
                TelnyxEvent::where('call_control_id', $callControlId)->update(['status' => 'completed']);

                // Handle the event when the call is hung up
                Log::info('Call hangup received', ['call_control_id' => $callControlId]);
                break;

            case 'call.gather.ended':
                Log::info('call.hangup');
                Log::info('call.gather.ended started');
                // Handle the event when the gather has ended (no input received)
                $result = $requestData['data']['result'];
                if ($result === 'no_input') {
                    Log::info('call.gather.ended no_input');
                    $this->timeoutAction($callControlId, $payload);
                }
                break;

            case 'call.playback.ended':
                Log::info('call.playback.ended');

                $firstEvent = TelnyxEvent::where('call_control_id', $callControlId)->oldest()->first();
                $phone = $firstEvent ? $this->getPhone($firstEvent->phone) : 0;
                $payload['from'] = $phone;
                Log::info('Call playback ended', ['phone' => $phone]);
                $mediaUrl = $payload['media_url'];
                Log::info('Call playback ended', ['mediaUrl' => $mediaUrl]);

                // User does not have an active subscription, fetch last playback event
                $lastPlaybackEvent = TelnyxEvent::where('call_control_id', $callControlId)
                    ->where('event_type', 'playback_start')
                    ->latest()
                    ->first();

                $commandId = $lastPlaybackEvent->command_id ?? '';
                Log::info('Call playback ended', ['commandId' => $commandId]);

                if ($this->subscriptionsService->isActive($phone)) {
                    Log::info('Call playback ended case 1');
                    Log::info('Call playback ended case 1 payload', $payload);
                    // $callAction = CallAction::query()->where('audio_link', 'LIKE', "%{$mediaUrl}%")->first();
                    // Log::info('Call playback ended case 1 callAction', $callAction->toArray());
                    // if ($callAction && $callAction->type != 'greetings') {
                    //     $this->callAnswerAction($callControlId, $payload);
                    //     break;
                    // }
                }
                else {
                    Log::info('Call playback ended case 2');
                    $this->makeCallEnded($callControlId, $commandId, $payload);
                }
                break;

            default:
                Log::info('default');
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
                'phone' => $this->getPhone($payload['from']),
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
                'webhook_url' => 'https://onetimeonetime.net/webhook/telnyx',
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

    private function callAnswerAction(string $callControlId, $payload, $isSubmenu = false, $callActionId = null): void
    {
        Log::info('Call answered', ['call_control_id' => $callControlId]);
        $phone = $this->getPhone($payload['from']);

        $playbackType = 'playback_start';

        // if ($isSubmenu) {
        //     $callAction = SubCallAction::query()
        //         ->where('call_action_id', $callActionId)
        //         ->where('type', 'greetings')
        //         ->whereNotNull('audio_link')
        //         ->where('audio_link', '!=', '')
        //         ->first();
        // }
        // else
        // {
        //     $hasSubscription = $this->subscriptionsService->isActive($phone);
        //     $type = $hasSubscription ? 'greetings' : 'non_subscriber_greetings';
        //     $playbackType = $type . '_' . $playbackType;

        //     $callAction = CallAction::query()
        //         ->where('type', $type)
        //         ->whereNotNull('audio_link')
        //         ->where('audio_link', '!=', '')
        //         ->first();
        // }

        $hasSubscription = $this->subscriptionsService->isActive($phone);
        $type = $hasSubscription ? 'greetings' : 'non_subscriber_greetings';
        $playbackType = $type . '_' . $playbackType;

        $callAction = CallAction::query()
            ->where('type', $type)
            ->whereNotNull('audio_link')
            ->where('audio_link', '!=', '')
            ->first();

        if ($callAction) {
            try {
                TelnyxEvent::create([
                    'phone' => $phone,
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

            $this->playAudioPrompt($callControlId, $callAction->audio_link, $payload, $playbackType);
        }
        else {
            Log::info('No greetings audio found', ['call_control_id' => $callControlId]);
        }
    }

    private function timeoutAction(string $callControlId, $payload): void
    {
        Log::info('No input timeout', ['call_control_id' => $callControlId]);

        // User does not have an active subscription, fetch last playback event
        $lastPlaybackEvent = TelnyxEvent::where('call_control_id', $callControlId)
            ->where('event_type', 'playback_start')
            ->latest()
            ->first();

        $commandId = $lastPlaybackEvent->command_id ?? '';

        // No valid last event or phone, mark events completed and end call
        TelnyxEvent::where('call_control_id', $callControlId)
            ->where('event_type', 'sub_menu')
            ->update(['status' => 'completed']);

        $this->makeCallEnded($callControlId, $commandId, $payload);
    }

    private function makeCallEnded(string $callControlId, $commandId, $payload): void
    {
        Log::info('Attempting to end call', ['call_control_id' => $callControlId]);

        // No valid last event or phone, mark events completed and end call
        TelnyxEvent::where('call_control_id', $callControlId)
            ->where('event_type', 'sub_menu')
            ->update(['status' => 'completed']);

        $endpoint = "/calls/$callControlId/actions/hangup";

        $request = [
            'client_state' => $payload['client_state'],
        ];
        if ($commandId) {
            $request['command_id'] = $commandId;
        }

        Log::info('Call ended successfully', ['request' => $request]);

        try {
            $response = $this->makeTelnyxApiCall($endpoint, 'POST', $request);

            // Log the response from Telnyx
            Log::info('Call ended successfully', ['response' => $response]);
        } catch (\Exception $e) {
            // Log the error if the API call fails
            Log::error('Error playing audio prompt', [
                'call_control_id' => $callControlId,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function playAudioPrompt(string $callControlId, string $audioUrl, $payload, $playbackType = 'playback_start'): void
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
                'phone' => $this->getPhone($payload['from']),
                'call_control_id' => $callControlId,
                'event_type' => $playbackType,
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
        ->where(function($query) {
            $query->where('event_type', 'playback_start')->orWhere('event_type', 'greetings_playback_start');
        })
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
                'phone' => $this->getPhone($payload['from']),
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

        $phone = $this->getPhone($payload['from']);

        $endpoint = "/calls/$callControlId/actions/transfer";
        $commandId = Uuid::uuid4()->toString();

        $request = [
            'to' => $callAction->transfer_to,
            // 'from' => '+13606638463',
            'from' => $phone,
            'from_display_name' => $phone,
            // 'from_display_name' => 'Kids Conversation',
            'time_limit_secs' => (int) $callAction->afer_time,
            'client_state' => $payload['client_state'],
            'command_id' => $commandId,
            'webhook_url' => 'https://onetimeonetime.net/webhook/telnyx',
            'webhook_url_method' => 'POST',
        ];

        try {
            TelnyxEvent::create([
                'phone' => $phone,
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

    private function getPhone($from) {
        return $from ? explode('@', $from)[0] : 0; // Get the part before '@'
    }
}
