<?php

namespace App\Http\Controllers;

use App\Models\CallAction;
use App\Models\CallActionDetails;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

    /**
     * Display the specified resource.
     */
    public function show(CallAction $callAction)
    {
        //
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
