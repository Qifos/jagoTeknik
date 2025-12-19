<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;

Route::redirect('/', '/landingpage');

// Landing page
Route::view('/landingpage', 'landingpageview')->name('landing');

// Authentication View Routes
Route::get('/register', fn () => view('registerview'))->name('register.view');
Route::get('/login', fn () => view('loginview'))->name('login.view');
Route::get('/otp', [UserController::class, 'showOtp'])->name('otp.view');

// Authentication Logic Routes
Route::post('/register', [UserController::class, 'register'])->name('user.register.perform');
Route::post('/otp/verify', [UserController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/otp/resend', [UserController::class, 'resendOtp'])->name('otp.resend');
Route::post('/login', [UserController::class, 'login'])->name('user.login.perform');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Username Setup
Route::get('/username', [UserController::class, 'showUsernameView'])->name('username.view');
Route::post('/username', [UserController::class, 'setUsername'])->name('username.set');

// Dashboard contoh
// Route::get('/homepage', fn () => view('homepageview'))->name('homepage');
Route::get('/homepage', [RekomendasiController::class, 'showHomepage'])
    ->name('homepage');


// Personalisasi
Route::get('/personalisasi', [UserController::class, 'showPersonalisasi'])->name('personalisasi.view');

// 1. KELAS ROUTES (Class Architecture)
// --------------------------------------------
// List all classes
Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
Route::get('/semuakelas', [KelasController::class, 'semuaKelas'])->name('kelas.semua');

// Single class details
Route::get('/kelas/{id}', [KelasController::class, 'showKelas'])->name('kelas.show');

// Buy Landing Page for a specific class
Route::get('/kelas/{id}/beli', [KelasController::class, 'belikelas'])->name('kelas.beli');

// Learning Page (Access content after purchase)
Route::get('/kelas/{id}/belajar', [KelasController::class, 'showKelasDetail'])->name('kelas.detail.beli');

// API for progress tracking
Route::get('/api/progress-kelas/{id_kelas}', [KelasController::class, 'getProgressKelas'])->name('api.kelas.progress');


// 2. PAYMENT / CHECKOUT ROUTES
// --------------------------------------------
Route::middleware('auth')->group(function () {
    // Initial buy page
    Route::get('/beli/{id}', [PembayaranController::class, 'showBeliKelas'])->name('pembayaran.show');

    // Checkout page (Password validation/Confirm)
    Route::get('/checkout/{id}', [PembayaranController::class, 'showCheckout'])->name('pembayaran.checkout');
    Route::post('/checkout/{id}', [PembayaranController::class, 'processPayment'])->name('pembayaran.process');

    // Payment Flow States
    Route::get('/loading/{id}', [PembayaranController::class, 'showLoading'])->name('pembayaran.loading');
    Route::get('/sukses/{id}', [PembayaranController::class, 'showSukses'])->name('pembayaran.sukses');
});


// 3. MEDIA & CONTENT ROUTES
// --------------------------------------------
// Specific Content Views
Route::get('/materi/{id}', [MediaController::class, 'showMateri'])->name('media.materi');
Route::get('/video/{id}', [MediaController::class, 'showVideoDetail'])->name('media.video.detail');

// Legacy/Fallback Routes (kept for compatibility)
Route::get('/kelas/materi', [MediaController::class, 'materi'])->name('kelas.materi');
Route::get('/kelas/video', [MediaController::class, 'video'])->name('kelas.video');

// Media Serving Routes
Route::get('/media/image/{id}', [MediaController::class, 'showImage'])->name('media.image');
Route::get('/media/video/{id}', [MediaController::class, 'showVideo'])->name('media.video');


// 4. JADWAL (SCHEDULE) ROUTES
// --------------------------------------------
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
Route::get('/jadwal/preview/{id}', [JadwalController::class, 'showPreview'])->name('jadwal.preview');
Route::resource('jadwal', JadwalController::class)->parameters(['jadwal' => 'jadwal:id_jadwal']);
Route::get('/api/jadwal/bulan', [JadwalController::class, 'byMonth'])->name('jadwal.byMonth');


// 5. CHAT ROUTES
// --------------------------------------------
Route::get('/livechat', [ChatController::class, 'index'])->name('chat.index');
Route::get('/api/chat/rooms', [ChatController::class, 'rooms'])->name('chat.rooms');
Route::post('/api/chat/send', [ChatController::class, 'send'])->name('chat.send');
Route::post('/api/chat/mark-read', [ChatController::class, 'markRead'])->name('chat.markRead');


// ============================================
// UTILITIES & ACTIONS
// ============================================

// Wishlist Logic (Auth required)
Route::middleware('auth')->group(function () {
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
});

Route::view('/personalisasi', 'personalisasi')->name('personalisasi.view');

Route::middleware('auth')->group(function () {
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');

    Route::post('/wishlist/{id_kelas}/toggle', [WishlistController::class, 'toggle'])
        ->name('wishlist.toggle');

    Route::get('/account', fn () => view('account'))->name('account.view');
});


// ============================================
// 6. PROGRESS TRACKING ROUTES (Auth required)
// ============================================
Route::middleware('auth')->group(function () {
    // Record video watch progress
    Route::post('/api/progress/video/{materiId}', [ProgressController::class, 'recordVideoWatch'])
        ->name('progress.video.record');

    // Record content read progress
    Route::post('/api/progress/content/{materiId}', [ProgressController::class, 'recordContentRead'])
        ->name('progress.content.record');

    // Complete materi
    Route::post('/api/materi/complete/{materiId}', [ProgressController::class, 'completeMateri'])
        ->name('materi.complete');

    // Check if materi is unlocked
    Route::get('/api/progress/check-unlock/{materiId}', [ProgressController::class, 'checkMateriUnlock'])
        ->name('progress.check.unlock');

    // Get matkul progress
    Route::get('/api/progress/matkul/{matkulId}', [ProgressController::class, 'getMatkulProgress'])
        ->name('progress.matkul');
});
