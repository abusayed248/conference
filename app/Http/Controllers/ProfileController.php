<?php

namespace App\Http\Controllers;

use App\Models\UserPlans;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function home(Request $request): View
    {
        $user = $request->user();
        if ($user->role == 'admin') {
            return view('home');
        } else {
            $userPlan = UserPlans::query()->first();
            return view("subscription", compact("userPlan"));
        }
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('auth.login');
    }

    public function updatePhoneNumber(Request $request)
    {
        $user = auth()->user();

        // Validate the input
        $request->validate([
            'phone_number' => 'required|string|max:20',
        ]);

        // Update the user's phone number
        $user->phone = $request->phone_number;
        $user->save();

        return response()->json(['success' => true]);
    }
}
