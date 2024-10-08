<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return redirect()->intended('tasks');
        }

        // return redirect()->back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->withInput($request->only('email'));

        return redirect()->back()->with('loginError', 'The provided credentials do not match our records.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); // Invalidates the current session
        $request->session()->regenerateToken(); // Regenerates CSRF token

        return redirect('/');
    }
}
