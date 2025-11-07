<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    public $timestamps = true;

    // relasi ke histori (user × kelas)
    public function histories()
    {
        // ganti 'kelas_id' jika kolommu bernama lain
        return $this->hasMany(History::class, 'kelas_id', 'id_kelas');
    }

    // relasi ke wishlist (opsional, kalau pakai tabel wishlists)
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'kelas_id', 'id_kelas');
    }
}
