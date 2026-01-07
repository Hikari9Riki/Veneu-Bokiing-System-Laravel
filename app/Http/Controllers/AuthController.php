<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    //show the regisater form
    public function showRegister() {
        return view('auth.register');
    }

    //submit register form
    public function register(Request $request) {
        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:15',
        ]);

        if ($request->password !== $request->password_confirmation) {
            return back()->withErrors([
                'password' => 'Password confirmation does not match.',
            ])->onlyInput('email');
        }

        // Create the user
        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
            'phone' => $credentials['phone'],
        ]);
        Auth::login($user);
        return redirect()->intended('dashboard');
    }

    // Show the login form
    public function showLogin() {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }

    // Handle the login attempt
    public function login(Request $request) 
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }

    // Handle logout
    public function showLogout(){
        if (Auth::check()) {
            Auth::logout();
            return redirect()->intended('showlogin');
        }
        return redirect()->intended('showlogin');
        
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended('login');
    }
}