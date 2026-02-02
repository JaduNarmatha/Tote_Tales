<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        return view('auth.register'); // Make sure this file exists
    }

    // Handle the registration request
    public function register(Request $request)
    {
        // Validate the input
        $request->validate([
            'name'                  => 'required|string|max:255',
            'phone'                 => 'required|string|max:20',
            'address'               => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users',
            'password'              => 'required|string|min:8|confirmed', // requires password_confirmation
        ]);

        // Create the user
        $user = User::create([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'customer', // default role
        ]);

        // Log in the user
        Auth::login($user);

        // Redirect to home or dashboard
        return redirect()->route('home'); // or route('admin.dashboard') if needed
    }
}
