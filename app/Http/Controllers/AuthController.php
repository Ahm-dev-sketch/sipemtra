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
        public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'whatsapp_number' => 'required|string|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        // Simpan data registrasi di session untuk verifikasi OTP
        $registrationData = $request->only(['name', 'whatsapp_number', 'password']);
        $request->session()->put('registration_data', $registrationData);

        // Kirim OTP ke WhatsApp (untuk registrasi, set isRegistration=true)
        $result = $this->otpService->sendOtp($request->whatsapp_number, true);

        if ($result['success']) {
            return redirect()->route('register.verify')->with('status', $result['message']);
        }

        return back()->withErrors(['whatsapp_number' => $result['message']]);
    }
}
