<?php

namespace App\Http\Controllers;

use App\Models\Greeting;
use App\Models\CallAction;
use Illuminate\Http\Request;

class GreetingController extends Controller
{

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
}
