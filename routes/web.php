<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;

Route::redirect('/', '/landingpage');

// Landing (sudah ada)
Route::view('/landingpage', 'landingpageview')->name('landing');

// Register page (Blade kamu yang ini)
Route::get('/register', fn () => view('registerview'))->name('register.view');
Route::get('/login', fn () => view('loginview'))->name('login.view');
Route::get('/otp', [UserController::class, 'showOtp'])->name('otp.view');

// Proses register → simpan user + OTP → redirect ke OTP
Route::post('/register', [UserController::class, 'register'])->name('user.register.perform');
Route::post('/otp/verify', [UserController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/otp/resend', [UserController::class, 'resendOtp'])->name('otp.resend');
Route::post('/login', [UserController::class, 'login'])->name('user.login.perform');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Ini buat coba otp view doang si
Route::view('/otp-test', 'otpview'); // langsung render view tanpa controller
Route::view('/username-test', 'usernameview'); // langsung render view tanpa controller
Route::view('/personalisasi-test', 'personalisasi'); // langsung render view tanpa controller

// Buat username view
Route::get('/username', [UserController::class, 'showUsernameView'])->name('username.view');
Route::post('/username', [UserController::class, 'setUsername'])->name('username.set');

// Dashboard contoh
Route::get('/homepage', fn () => view('homepageview'))->name('homepage');

// Kelas pages (static views for design preview)
Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');

// --- JADWAL ROUTES ---
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
Route::get('/jadwal/preview/{id}', [JadwalController::class, 'showPreview'])->name('jadwal.preview');

// --- NEW PEMBAYARAN (BUY CLASS) ROUTES ---
// Show the initial buy page (Beli kelas.jpg)
// Route::get('/beli/{id}', [PembayaranController::class, 'showBeliKelas'])->name('pembayaran.show');
// Show the checkout page (Bayar kelas.png)
Route::get('/checkout/{id}', [PembayaranController::class, 'showCheckout'])->name('pembayaran.checkout')->middleware('auth'); // Must be logged in
// Process the payment
Route::post('/checkout/{id}', [PembayaranController::class, 'processPayment'])->name('pembayaran.process')->middleware('auth'); // Must be logged in
// Show the loading page
Route::get('/loading/{id}', [PembayaranController::class, 'showLoading'])->name('pembayaran.loading')->middleware('auth'); // Must be logged in
// Show the success page (bayar sukses.jpg)
Route::get('/sukses/{id}', [PembayaranController::class, 'showSukses'])->name('pembayaran.sukses')->middleware('auth'); // Must be logged in
// --- END NEW PEMBAYARAN ROUTES ---

// Materi/video pages are handled by MediaController to avoid overlapping controller methods
Route::get('/kelas/materi', [MediaController::class, 'materi'])->name('kelas.materi');
Route::get('/kelas/video', [MediaController::class, 'video'])->name('kelas.video');

// Route untuk API progress (dipanggil dari view)
Route::get('/api/progress-kelas/{id_kelas}', [KelasController::class, 'getProgressKelas'])->name('api.kelas.progress');

// Halaman list semua kelas untuk browsing (view template saja)
Route::get('/semuakelas', [KelasController::class, 'semuaKelas'])->name('kelas.semua');

// Halaman detail kelas default (Kalkulus 2) - mock data untuk demo
Route::get('/kelas/default', [KelasController::class, 'index'])->name('kelas.index');

/**
 * HALAMAN PEMBELIAN KELAS
 * Alternatif halaman beli kelas (menggunakan model Matkul)
 */
Route::get('/kelas/{id}/beli', [KelasController::class, 'showBeliKelas'])->name('kelas.beli');

/**
 * HALAMAN BELAJAR - SUDAH DIBELI
 * Untuk user yang SUDAH membeli kelas, menampilkan materi & video pembelajaran
 */
Route::get('/kelas/{id}/belajar', [KelasController::class, 'showKelasDetail'])->name('kelas.detail.beli');

/**
 * WISHLIST MANAGEMENT
 * Untuk menambah/menghapus kelas dari wishlist user
 */
Route::post('/wishlist/{id_kelas}', [KelasController::class, 'toggleWishlist'])->name('wishlist.toggle');

Route::get('/personalisasi', [UserController::class, 'showPersonalisasi'])->name('personalisasi.view');

// Serve CSS from resources during development (not recommended for production)
Route::get('/resources/css/app.css', function () {
    $path = resource_path('css/app.css');
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path, [
        'Content-Type' => 'text/css'
    ]);
});

// Route Jadwal
Route::get('/jadwal', fn () => redirect()->route('jadwalview'));
Route::resource('jadwal', JadwalController::class)->parameters(['jadwal' => 'jadwal:id_jadwal']);
Route::get('/api/jadwal/bulan', [JadwalController::class, 'byMonth'])->name('jadwal.byMonth');

// Media routes (image and video)
Route::get('/media/image/{id}', [MediaController::class, 'showImage'])->name('media.image');
Route::get('/media/video/{id}', [MediaController::class, 'showVideo'])->name('media.video');

// Chat
Route::get('/livechat', [ChatController::class, 'index'])->name('chat.index');

// API JSON untuk chat
Route::get('/api/chat/rooms', [ChatController::class, 'rooms'])->name('chat.rooms');
Route::post('/api/chat/send', [ChatController::class, 'send'])->name('chat.send');
Route::post('/api/chat/mark-read', [ChatController::class, 'markRead'])->name('chat.markRead');

// Route Kelas
Route::middleware('auth')->group(function () {
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
});

Route::view('/personalisasi', 'personalisasi')->name('personalisasi.view');
// Route untuk menampilkan halaman password

Route::middleware('auth')->group(function () {
    Route::post('/wishlist/{id_kelas}/toggle', [WishlistController::class, 'toggle'])
        ->name('wishlist.toggle');
});
