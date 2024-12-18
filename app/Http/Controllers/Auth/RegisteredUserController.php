<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'number' => ['required', 'numeric', 'unique:users'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Ensure valid image
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'password' => Hash::make($request->password),
        ]);
    
        $photo = $request->file('photo');
        $slug = Str::slug($request->name, '-');

        if ($photo) {
            $extension = $photo->getClientOriginalExtension();
            $fileNameToStore = $slug . '_' . time() . '.' . $extension; // Filename to store
            $destinationPath = 'files/users';
            $photo->move(public_path($destinationPath), $fileNameToStore);
            $user->photo = 'files/users/' . $fileNameToStore;
        }
    
        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect(RouteServiceProvider::HOME);
    }
}
