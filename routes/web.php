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

// Dashboard contoh
Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');


//ini buat coba otp view doang si
Route::view('/otp-test', 'otpview'); // langsung render view tanpa controller

//buat username view
Route::view('/username-test', 'usernameview'); // langsung render view tanpa controller

// Kelas pages (static views for design preview)
Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
// materi/video pages are handled by MediaController to avoid overlapping controller methods
Route::get('/kelas/materi', [MediaController::class, 'materi'])->name('kelas.materi');
Route::get('/kelas/video', [MediaController::class, 'video'])->name('kelas.video');

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

// Media routes (image and video)
Route::get('/media/image/{id}', [MediaController::class, 'showImage'])->name('media.image');
Route::get('/media/video/{id}', [MediaController::class, 'showVideo'])->name('media.video');

//chat
Route::get('/livechat', [ChatController::class, 'index'])->name('chat.index');


/* API JSON untuk chat */
Route::get('/api/chat/rooms', [ChatController::class, 'rooms'])->name('chat.rooms');
Route::post('/api/chat/send', [ChatController::class, 'send'])->name('chat.send');
Route::post('/api/chat/mark-read', [ChatController::class, 'markRead'])->name('chat.markRead');
