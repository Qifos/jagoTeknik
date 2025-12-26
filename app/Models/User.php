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
use Illuminate\Support\Str;
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
<<<<<<< HEAD
<<<<<<< HEAD
=======
        'jenis_kelamin', 'foto_profil', 'otp', 'is_active', 'is_mentor',
>>>>>>> 008e2df50e114cd6f15e972ab9f157700f9bd9b0
=======
        'jenis_kelamin', 'foto_profil', 'otp', 'is_active', 'is_mentor',
>>>>>>> 04178d1b4cda36a2a838469edd267471fd3d5375
        'avatar', 'dark_mode', 'messenger_color', 'active_status', 'last_seen',
    ];


    protected $hidden = ['password', 'remember_token', 'otp'];
    protected $appends = ['id', 'name'];


    // Biar Auth::attempt() tetap bisa pakai 'password'
    public function getAuthPassword()
    {
        return $this->password;
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }

    public function beliMatkul()
    {
        return $this->hasMany(BeliMatkul::class, 'id_user', 'id_user');
    }

    // ✅ Chatify sering pakai $user->id
    public function getIdAttribute()
    {
        return $this->getAttribute($this->primaryKey);
    }

    // ✅ Chatify sering pakai $user->name
    public function getNameAttribute()
    {
        return $this->getAttribute('nama');
    }

    //avatar
    public function getAvatarAttribute($value)
    {
    $value = $value ?: $this->foto_profil;

    if (!$value) return asset('image/default-avatar.png');

    // sudah URL absolut
    if (Str::startsWith($value, ['http://', 'https://', '//'])) return $value;

    // kalau mulai dari /, buang / biar asset() rapi
    return asset(ltrim($value, '/'));
    }
}
