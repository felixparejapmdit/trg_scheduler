<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|username',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            // Check if the user is activated
            // if (Auth::user()->activated != 1) {
            //     Auth::logout();

            //     return redirect()->route('login')->withErrors(['username' => 'Your account is not activated.']);
            // }

            // Authentication passed, redirect to the intended page
            return redirect()->intended('/dashboard');
        }

        // If login attempt failed, redirect back with an error
        return redirect()->route('login')->withErrors(['username' => 'These credentials do not match our records.']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

      public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
