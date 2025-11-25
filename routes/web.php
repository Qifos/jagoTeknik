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

Route::view('/landingpage', 'landingpageview')->name('landing');

Route::get('/register', fn () => view('registerview'))->name('register.view');
Route::get('/login', fn () => view('loginview'))->name('login.view');
Route::get('/otp', [UserController::class, 'showOtp'])->name('otp.view');

Route::post('/register', [UserController::class, 'register'])->name('user.register.perform');
Route::post('/otp/verify', [UserController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/otp/resend', [UserController::class, 'resendOtp'])->name('otp.resend');
Route::post('/login', [UserController::class, 'login'])->name('user.login.perform');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::view('/otp-test', 'otpview');
Route::view('/username-test', 'usernameview');
Route::view('/personalisasi-test', 'personalisasi');

Route::get('/username', [UserController::class, 'showUsernameView'])->name('username.view');
Route::post('/username', [UserController::class, 'setUsername'])->name('username.set');

Route::get('/homepage', fn () => view('homepageview'))->name('homepage');

Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');

Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
Route::get('/jadwal/preview/{id}', [JadwalController::class, 'showPreview'])->name('jadwal.preview');

Route::get('/checkout/{id}', [PembayaranController::class, 'showCheckout'])->name('pembayaran.checkout')->middleware('auth'); // Must be logged in

Route::post('/checkout/{id}', [PembayaranController::class, 'processPayment'])->name('pembayaran.process')->middleware('auth'); // Must be logged in

Route::get('/loading/{id}', [PembayaranController::class, 'showLoading'])->name('pembayaran.loading')->middleware('auth'); // Must be logged in

Route::get('/sukses/{id}', [PembayaranController::class, 'showSukses'])->name('pembayaran.sukses')->middleware('auth'); // Must be logged in

Route::get('/kelas/materi', [MediaController::class, 'materi'])->name('kelas.materi');
Route::get('/kelas/video', [MediaController::class, 'video'])->name('kelas.video');

Route::get('/api/progress-kelas/{id_kelas}', [KelasController::class, 'getProgressKelas'])->name('api.kelas.progress');

Route::get('/semuakelas', [KelasController::class, 'semuaKelas'])->name('kelas.semua');
Route::get('/kelas/default', [KelasController::class, 'index'])->name('kelas.index');

Route::get('/kelas/{id}/beli', [KelasController::class, 'showBeliKelas'])->name('kelas.beli');

Route::get('/kelas/{id}/belajar', [KelasController::class, 'showKelasDetail'])->name('kelas.detail.beli');

Route::post('/wishlist/{id_kelas}', [KelasController::class, 'toggleWishlist'])->name('wishlist.toggle');

Route::get('/personalisasi', [UserController::class, 'showPersonalisasi'])->name('personalisasi.view');
Route::get('/resources/css/app.css', function () {
    $path = resource_path('css/app.css');
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path, [
        'Content-Type' => 'text/css'
    ]);
});

Route::get('/jadwal', fn () => redirect()->route('jadwalview'));
Route::resource('jadwal', JadwalController::class)->parameters(['jadwal' => 'jadwal:id_jadwal']);
Route::get('/api/jadwal/bulan', [JadwalController::class, 'byMonth'])->name('jadwal.byMonth');

Route::get('/media/image/{id}', [MediaController::class, 'showImage'])->name('media.image');
Route::get('/media/video/{id}', [MediaController::class, 'showVideo'])->name('media.video');

Route::get('/livechat', [ChatController::class, 'index'])->name('chat.index');

Route::get('/api/chat/rooms', [ChatController::class, 'rooms'])->name('chat.rooms');
Route::post('/api/chat/send', [ChatController::class, 'send'])->name('chat.send');
Route::post('/api/chat/mark-read', [ChatController::class, 'markRead'])->name('chat.markRead');

Route::middleware('auth')->group(function () {
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
});

Route::view('/personalisasi', 'personalisasi')->name('personalisasi.view');

Route::middleware('auth')->group(function () {
    Route::post('/wishlist/{id_kelas}/toggle', [WishlistController::class, 'toggle'])
        ->name('wishlist.toggle');
});
