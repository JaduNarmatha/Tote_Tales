<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show login page
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function store(Request $request)
    {
        // Validate login data
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt authentication
        if (Auth::attempt($credentials)) {

            // Regenerate session (security)
            $request->session()->regenerate();

            $user = Auth::user();

            // Optional: store session values
            session([
                'user_id'    => $user->id,
                'user_name'  => $user->name,
                'user_email' => $user->email,
                'role'       => $user->role,
            ]);

            // 🔐 Role-based redirect
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome Admin!');
            }

            // 👤 Customer redirect
            return redirect()->route('home')
                ->with('success', 'Welcome back to Tote_Tales!');
        }

        // ❌ Login failed
        return back()
            ->withInput()
            ->with('error', 'Invalid email or password!');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Destroy session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Logged out successfully.');
    }
}
