<?php

namespace App\Http\Controllers;

use App\Models\CallAction;
use App\Models\CallActionDetails;
use App\Models\SubCallAction;
use Illuminate\Http\Request;

class CallActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function updateAudio(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'audio_file' => 'required|file|mimes:mp3,wav', // Validate file type and size
        ]);


        $callAction = CallAction::query()->where([
            'type' => $request->type,
        ])->first();
        if ($callAction) {

            if ($callAction->hasMedia('audio_file')) {
                // Delete the existing media
                $callAction->clearMediaCollection('audio_file');
            }

            $callAction->addMedia($request->file('audio_file'))
                ->toMediaCollection('audio_file');

            $callAction->update([
                'audio_link' => $callAction->getFirstMediaUrl('audio_file')
            ]);
        } else {
            $callAction = CallAction::create([
                'type' => $request->type
            ]);

            $callAction->addMedia($request->file('audio_file'))
                ->toMediaCollection('audio_file');

            $callAction->update([
                'audio_link' => $callAction->getFirstMediaUrl('audio_file')
            ]);
        }

        return back()->with('success', 'Audio link updated successfully!');
    }

    public function updateAudioNonSubscription(Request $request)
    {

        $request->validate([
            'type' => 'required|string',
            'audio_file' => 'required|file|mimes:mp3,wav', // Validate file type and size
        ]);


        $callAction = CallAction::query()->where([
            'type' => $request->type,
        ])->first();
        if ($callAction) {

            if ($callAction->hasMedia('audio_file')) {
                // Delete the existing media
                $callAction->clearMediaCollection('audio_file');
            }

            $callAction->addMedia($request->file('audio_file'))
                ->toMediaCollection('audio_file');

            $callAction->update([
                'audio_link' => $callAction->getFirstMediaUrl('audio_file')
            ]);
        } else {
            $callAction = CallAction::create([
                'type' => $request->type
            ]);

            $callAction->addMedia($request->file('audio_file'))
                ->toMediaCollection('audio_file');

            $callAction->update([
                'audio_link' => $callAction->getFirstMediaUrl('audio_file')
            ]);
        }
        return back()->with('success', 'Audio link updated successfully!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'number' => 'nullable|string|max:15',
            'afer' => 'nullable',
        ]);

        $callAction = CallAction::query()->where([
            'type' => $request->type,
            'digit' => $request->digit
        ])->first();
        if ($callAction) {
            $callAction->update([
                'transfer_to' => $request->number,
                'call_transfer_timer' => $request->call_transfer_timer,
                'afer_time' => $request->afer,
            ]);
        } else {
            $callAction = CallAction::create([
                'type' => $request->type,
                'digit' => $request->digit,
                'transfer_to' => $request->number,
                'call_transfer_timer' => $request->call_transfer_timer,
                'afer_time' => $request->afer,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Call action saved successfully.',
            'data' => $callAction,
        ], 201);
    }

    public function storeMp3CallAction(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'number' => 'nullable|string|max:15',
            'afer' => 'nullable',
        ]);

        $callAction = CallAction::query()->where([
            'type' => $request->type,
            'digit' => $request->digit
        ])->first();
        if ($callAction) {

            if ($callAction->hasMedia('audio_file')) {
                // Delete the existing media
                $callAction->clearMediaCollection('audio_file');
            }

            $callAction->addMedia($request->file('audio_file'))
                ->toMediaCollection('audio_file');

            $callAction->update([
                'audio_link' => $callAction->getFirstMediaUrl('audio_file')
            ]);
        } else {
            $callAction = CallAction::create([
                'type' => $request->type,
                'digit' => $request->digit
            ]);


            $callAction->addMedia($request->file('audio_file'))
                ->toMediaCollection('audio_file');

            $callAction->update([
                'audio_link' => $callAction->getFirstMediaUrl('audio_file')
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Call action saved successfully.',
            'data' => $callAction,
        ], 201);
    }

    public function storeMp3SubCallAction(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'digit' => 'required',
            'number' => 'nullable|string|max:15',
            'sub' => 'nullable',
        ]);

        $callAction = CallAction::query()->where([
            'digit' => $request->digit
        ])->first();
        if (!$callAction) {
            $callAction = CallAction::create([
                'type' => $request->type,
                'digit' => $request->digit
            ]);
        }

        $subCallAction = SubCallAction::query()->where([
            'call_action_id' => $callAction->id,
            'type' => $request->sub_type,
            'digit' => $request->sub
        ])->first();

        if ($subCallAction) {

            if ($subCallAction->hasMedia('audio_file')) {
                // Delete the existing media
                $subCallAction->clearMediaCollection('audio_file');
            }

            $media =  $subCallAction->addMedia($request->file('audio_file'))
                ->toMediaCollection('audio_file');
            $audioUrl = $media->getUrl(); // Get the URL of the uploaded file

            $subCallAction->update([
                'audio_link' => $audioUrl
            ]);
        } else {

            $subCallAction = SubCallAction::create([
                'call_action_id' => $callAction->id,
                'type' => $request->sub_type,
                'digit' => $request->sub
            ]);

            $subCallAction->addMedia($request->file('audio_file'))
                ->toMediaCollection('audio_file');

            $subCallAction->update([
                'audio_link' => $callAction->getFirstMediaUrl('audio_file')
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Call action sub saved successfully.',
            'data' => $callAction,
        ], 201);
    }

    public function updateCallAction(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'digit' => 'required',
        ]);

        $callAction = CallAction::query()->where([
            'digit' => $request->digit
        ])->first();
        if (!$callAction) {
            $callAction = CallAction::create([
                'type' => $request->type,
                'digit' => $request->digit
            ]);
        }
        if ($callAction) {
            $callAction->update([
                'type' => $request->type
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Call action saved successfully.',
            'data' => $callAction,
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CallAction $callAction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CallAction $callAction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CallAction $callAction)
    {
        //
    }
}
