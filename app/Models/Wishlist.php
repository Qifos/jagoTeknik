<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    // Tabel sesuai database: wishlist_kelas
    protected $table = 'wishlist_kelas';
    protected $primaryKey = 'id_wishlist_kelas';

    protected $fillable = [
        'id_user',
        'id_kelas',
        'tanggal_wishlist',
    ];

    // Kalau tabel kamu tidak punya created_at / updated_at, biarkan false
    public $timestamps = false;

    public function user()
    {
        // PK di tabel user = id_user
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function kelas()
    {
        // PK di tabel kelas = id_kelas
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}
