<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        // Guests only can access login form
       // $this->middleware('guest')->except('logout');
    }

    // Show login form
    public function create()
    {
        return view('auth.login'); // resources/views/auth/login.blade.php
    }

    // Handle login
public function login(Request $request)
{
    $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return back()->withErrors([
            'email' => 'Invalid email or password',
        ]);
    }

    $request->session()->regenerate();

    $user = Auth::user();

    // ✅ ROLE BASED REDIRECT
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('home'); // customer
}


    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
