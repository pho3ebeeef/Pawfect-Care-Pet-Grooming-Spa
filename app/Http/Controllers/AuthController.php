<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $users = Auth::user();

        if ($users->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($users->role === 'groomer') {
            return redirect()->route('groomer.dashboard');
        } else {
            return redirect()->route('client.dashboard');
        }
    }

    return back()->withErrors(['email' => 'Invalid credentials']);
}


    /**
     * Show the registration form.
     */
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|string|in:client,groomer,admin',
        ]);

        $users= User::create([  
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
        ]);

         if ($users->role === 'client') {
        \App\Models\Client::create([
            'user_id'   => $users->id,
            'full_name' => $users->name,
            'email'     => $users->email,
        ]);
    }

    if ($users->role === 'groomer') {
    \App\Models\Groomer::create([
        'user_id'   => $users->id,
        'full_name' => $users->name,
        'email'     => $users->email,
    ]);
}

        Auth::login($users);
        // Role-based redirect
        return $this->redirectByRole($users->role);
    }

    /**
     * Redirect users based on their role.
     */
    protected function redirectByRole(string $role): RedirectResponse
    {
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'groomer':
                return redirect()->route('groomer.dashboard');
            case 'client':
            default:
                return redirect()->route('client.dashboard');
        }
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}