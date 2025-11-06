<?php

/**
 * Author : Sinta Dewi Rahmawati (NRP 5026231231)
 * File   : app/Http/Controllers/UserController.php
 * Desc   : user controller untuk register, OTP, login, logout
 * Date   : 2025-11-04
 */


namespace App\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    // Tabel & Primary Key kustom
    protected $table = 'user';        // GANTI jika tabel kamu bukan "users"
    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'int';


    // Timestamps kustom (kolommu "updated_")
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $fillable = [
        'id_jurusan', 'nama', 'username', 'email',
        'password', 'no_hp', 'angkatan', 'tanggal_lahir',
        'jenis_kelamin', 'foto_profil', 'otp', 'is_active',
    ];


    protected $hidden = ['password', 'remember_token', 'otp'];


    // Biar Auth::attempt() tetap bisa pakai 'password'
    public function getAuthPassword()
    {
        return $this->password;
    }
}
