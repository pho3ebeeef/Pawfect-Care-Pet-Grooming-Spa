<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client; // ✅ import Client model
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|string|in:client,admin', 
        ]);

        // Create the user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'   => $request->role,
        ]);

        // ✅ Automatically create a Client record if role is 'client'
        if ($user->role === 'client') {
            Client::create([
                'id'       => $user->id,     // match user id for FK
                'full_name'=> $user->name,
                'email'    => $user->email,
            ]);
        }


        event(new Registered($user));

        Auth::login($user);

        return redirect()->route(
            $user->role === 'admin' ? 'admin.dashboard' :
            ($user->role === 'groomer' ? 'groomer.dashboard' : 'client.dashboard')
        );
    }
}