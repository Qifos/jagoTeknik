<?php

/**
 * Author : Sinta Dewi Rahmawati (NRP 5026231231)
 * File   : app/Http/Controllers/UserController.php
 * Desc   : user controller untuk register, OTP, login, logout
 * Date   : 2025-11-04
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password as Pwd;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // ===== Register: validasi, simpan user, OTP, redirect ke OTP =====
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required','string','max:255'],
            'email'    => [
                'required','email','max:255',
                // unique ke tabel & kolom kamu
                Rule::unique((new User)->getTable(), 'email'),
            ],
            'password' => [
                'required','confirmed',
                Pwd::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(),
            ],
            'terms'    => ['accepted'], // checkbox di form
        ]);

        // generate OTP 4 digit
        $otp = str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        // simpan user ke kolom-kolom kustom kamu
        $user = User::create([
            'nama'          => $data['name'],
            'email'         => $data['email'],
            'password_hash' => Hash::make($data['password']),
            'otp_code'      => $otp,
            'is_active'     => 0, // belum aktif sebelum verifikasi
        ]);

        // simpan context email untuk OTP view
        $request->session()->put('pending_email', $user->email);

        // DEV: tampilkan di log (hapus di production)
        Log::info("DEV OTP for {$user->email}: {$otp}");

        // redirect ke halaman OTP
        return redirect()->route('otp.view');
    }

    // ===== Tampilkan form OTP =====
    public function showOtp(Request $request)
    {
        $email = $request->session()->get('pending_email');
        if (!$email) {
            return redirect()->route('register.view');
        }
        return view('otpview', ['email' => $email]);
    }

    // ===== Verifikasi OTP =====
    public function verifyOtp(Request $request)
    {
        $request->validate(['code' => ['required','digits:4']]);

        $email = $request->session()->get('pending_email');
        if (!$email) {
            return redirect()->route('register.view');
        }

        $user = User::where('email', $email)->first();

        if ($user && hash_equals((string)$user->otp_code, (string)$request->code)) {
            // clear OTP, aktifkan user, login
            $user->otp_code = null;
            $user->is_active = 1;
            $user->save();

            Auth::login($user);
            $request->session()->forget('pending_email');

            return redirect()->route('dashboard')->with('success', 'OTP terverifikasi');
        }

        return back()
            ->withErrors(['code' => 'Kode OTP salah atau kadaluarsa.'])
            ->withInput();
    }

    // ===== Login (pakai getAuthPassword()) =====
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required','min:6'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])
                     ->onlyInput('email');
    }

    // ===== Logout =====
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to('/');
    }
}
