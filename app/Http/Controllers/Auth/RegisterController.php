<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'customer', // default
        ]);

        if (! $user) {
            return back()->withErrors(['Registration failed. Please try again.']);
        }

        return redirect()->route('login')
            ->with('success', 'Registration successful! Please login.');
    }
}
