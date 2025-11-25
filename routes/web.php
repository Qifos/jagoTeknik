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

// Landing page
Route::view('/landingpage', 'landingpageview')->name('landing');

// Authentication routes
Route::get('/register', fn () => view('registerview'))->name('register.view');
Route::get('/login', fn () => view('loginview'))->name('login.view');
Route::get('/otp', [UserController::class, 'showOtp'])->name('otp.view');

// Auth processing
Route::post('/register', [UserController::class, 'register'])->name('user.register.perform');
Route::post('/otp/verify', [UserController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/otp/resend', [UserController::class, 'resendOtp'])->name('otp.resend');
Route::post('/login', [UserController::class, 'login'])->name('user.login.perform');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Test/demo views
Route::view('/otp-test', 'otpview');
Route::view('/username-test', 'usernameview');
Route::view('/personalisasi-test', 'personalisasi');

// Username view
Route::get('/username', [UserController::class, 'showUsernameView'])->name('username.view');
Route::post('/username', [UserController::class, 'setUsername'])->name('username.set');

// Dashboard contoh
//Route::get('/homepage', fn () => view('homepageview'))->name('homepage');

// Dashboard + rekomendasi kelas
Route::get('/homepage', [RekomendasiController::class, 'showHomepage'])->name('homepage');

// ============================================
// TASK 1: DYNAMIC CLASS ARCHITECTURE ROUTES
// ============================================

// Index/list all classes
Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');

// GET /kelas/{id} -> Shows the dynamic class page
Route::get('/kelas/{id}', [KelasController::class, 'showKelas'])->name('kelas.show');

// GET /kelas/{id}/beli -> Shows the buy landing page
Route::get('/kelas/{id}/beli', [KelasController::class, 'belikelas'])->name('kelas.beli');

// GET /kelas/{id}/belajar -> Shows learning page for purchased classes
Route::get('/kelas/{id}/belajar', [KelasController::class, 'showKelasDetail'])->name('kelas.detail.beli');

// --- NEW PEMBAYARAN (BUY CLASS) ROUTES ---
// Show the initial buy page (Beli kelas.jpg)
Route::get('/beli/{id}', [PembayaranController::class, 'showBeliKelas'])->name('pembayaran.show');
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
Route::view('/semuakelas', 'semuakelas'); // langsung render view tanpa controller

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

// ============================================
// CHAT ROUTES
// ============================================

Route::get('/livechat', [ChatController::class, 'index'])->name('chat.index');
Route::get('/api/chat/rooms', [ChatController::class, 'rooms'])->name('chat.rooms');
Route::post('/api/chat/send', [ChatController::class, 'send'])->name('chat.send');
Route::post('/api/chat/mark-read', [ChatController::class, 'markRead'])->name('chat.markRead');

// ============================================
// USER/PROFILE ROUTES
// ============================================

Route::get('/personalisasi', [UserController::class, 'showPersonalisasi'])->name('personalisasi.view');

// ============================================
// UTILITY ROUTES
// ============================================

// Serve CSS from resources during development
Route::get('/resources/css/app.css', function () {
    $path = resource_path('css/app.css');
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path, ['Content-Type' => 'text/css']);
});

// Alternative wishlist toggle (via auth middleware)
Route::middleware('auth')->group(function () {
    Route::post('/wishlist/{id_kelas}/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle.alt');
});
