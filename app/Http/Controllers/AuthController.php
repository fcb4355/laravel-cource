<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // Login Page
    public function showLoginForm()
    {
        return view('login');
    }

    // Register page.
    public function showRegisterForm()
    {
        return view('register');
    }

    // Handler Register
    public function register(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:50|string',
            'email' => 'required|email|unique:users,email|max:250',
            'password' => ['required', 'min:8', 'max:20', Password::default()]
        ]);

        $user = User::create($validated);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect('/notes')->with('success', 'User created succussfully');
    }

    // Handler Login
    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Login successfully');
        } else {
            return redirect('/login')->with('error', 'Email or password not correct');
        }
    }

    // Logout
    public function logout()
    {
        Auth::logout();

        return redirect('/login')->with('success', 'Logout successfully');
    }
}
