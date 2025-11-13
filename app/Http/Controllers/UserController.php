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
use App\Models\Jurusan; // <-- WAJIB: import model Jurusan!
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password as Pwd;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // REGISTER
    public function register(Request $request)
    {
        $data = $request->validate([
            // pakai 'nama' (bukan 'name') agar match dengan form
            'nama'     => ['required','string','max:255'],
            'email'    => ['required','email','max:255', Rule::unique('user', 'email')],
            'password' => ['required','confirmed', Pwd::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            'terms'    => ['accepted'],
        ]);

        $otp = str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        // NOTE: username belum diisi di sini -> pastikan kolomnya nullable (lihat bagian D)
        $user = User::create([
            'nama'       => $data['nama'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'otp'        => $otp,
            'is_active'  => 0,
        ]);

        $request->session()->put('pending_email', $user->email);
        Log::info("DEV OTP for {$user->email}: {$otp}");

        return redirect()->route('otp.view');
    }

    public function showOtp(Request $request)
    {
        $email = $request->session()->get('pending_email');
        if (!$email) return redirect()->route('register.view');
        return view('otpview', ['email' => $email]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['code' => ['required','digits:4']]);

        $email = $request->session()->get('pending_email');
        if (!$email) return redirect()->route('register.view');

        $user = User::where('email', $email)->first();

        if ($user && hash_equals((string)$user->otp, (string)$request->code)) {
            $user->otp = null;
            $user->is_active = 1;
            $user->save();

            Auth::login($user);
            $request->session()->forget('pending_email');

            return redirect()->route('username.view')->with('success', 'OTP terverifikasi');
        }

        return back()->withErrors(['code' => 'Kode OTP salah atau kadaluarsa.'])->withInput();
    }

    public function showUsernameView()
    {
        // pastikan model Jurusan sudah benar (lihat bagian C)
        $jurusanList = Jurusan::select('id_jurusan','nama_jurusan')->get();
        return view('usernameview', compact('jurusanList'));
    }

    public function setUsername(Request $request)
    {
        $request->validate([
            'username'      => ['required','string','max:255','unique:user,username'], // tabel 'user' (bukan 'users')
            'angkatan'      => ['required','numeric','digits:4'],
            'tanggal_lahir' => ['required','date'],
            'id_jurusan'    => ['required','exists:jurusan,id_jurusan'], // tabel & PK custom
            'no_hp'         => ['required','numeric','digits_between:10,15'],
        ]);

        $user = Auth::user();
        $user->username      = $request->username;
        $user->angkatan      = $request->angkatan;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->no_hp         = $request->no_hp;
        $user->id_jurusan    = $request->id_jurusan;
        $user->save();

        return redirect()->route('homepage')->with('success', 'Profil berhasil disimpan');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required','min:6'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('homepage'));
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to('/');
    }

// Menampilkan form untuk melihat password
public function showPasswordView()
{
    // Mengambil data user yang sedang login
    $user = Auth::user();
    // Mengirimkan data user ke view
    return view('personalisasi', ['user' => $user]);
}

public function showPersonalisasi()
{
    // Mengambil data user yang sedang login
    $user = Auth::user();
    return view('personalisasi', ['user' => $user]);
}

}


