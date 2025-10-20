<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
        public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('whatsapp_number', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return Auth::user()->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('home');
        }

        return back()->withErrors(['whatsapp_number' => 'Nomor WhatsApp atau password salah']);
    }
}
