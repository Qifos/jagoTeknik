<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // Tabel & Primary Key kustom
    protected $table = 'users';        // GANTI jika tabel kamu bukan "users"
    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'int';

    // Timestamps kustom (kolommu "updated_")
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_';

    protected $fillable = [
        'id_jurusan', 'nama', 'username', 'email',
        'password_hash', 'no_hp', 'angkatan', 'tanggal_lahir',
        'jenis_kelamin', 'foto_profil', 'otp_code', 'is_active',
    ];

    protected $hidden = ['password_hash', 'remember_token', 'otp_code'];

    // Biar Auth::attempt() tetap bisa pakai 'password'
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}
