<?php

namespace App\Http\Controllers;

use App\Models\Greeting;
use Illuminate\Http\Request;

class GreetingController extends Controller
{

    public function updateAudio(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'audio_file' => 'required|file|mimes:mp3,wav|max:2048', // Validate file type and size
        ]);

        // Find or create a greeting record based on the type
        $greeting = Greeting::firstOrCreate(['type' => $request->type]);


        if ($request->file('audio_file')) {
            if ($greeting->hasMedia('audio_file')) {
                // Delete the existing media
                $greeting->clearMediaCollection('audio_file');
            }

            $greeting->addMedia($request->file('audio_file'))
                ->toMediaCollection('audio_file');

            $greeting->update([
                'audio_link' => $greeting->getFirstMediaUrl('audio_file')
            ]);
        }
        return back()->with('success', 'Audio link updated successfully!');
    }

    public function updateAudioNonSubscription(Request $request)
    {

        $request->validate([
            'type' => 'required|string',
            'audio_file' => 'required|file|mimes:mp3,wav|max:2048', // Validate file type and size
        ]);

        // Find or create a greeting record based on the type
        $greeting = Greeting::firstOrCreate(['type' => $request->type]);


        if ($request->file('audio_file')) {
            if ($greeting->hasMedia('audio_file')) {
                // Delete the existing media
                $greeting->clearMediaCollection('audio_file');
            }

            $greeting->addMedia($request->file('audio_file'))
                ->toMediaCollection('audio_file');

            $greeting->update([
                'audio_link' => $greeting->getFirstMediaUrl('audio_file')
            ]);

        }
        return back()->with('success', 'Audio link updated successfully!');
    }
}
