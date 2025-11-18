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
    protected $fillable = ['id_matkul','id_jadwal','id_materi','id_wishlist_kelas','deskripsi','preview','rating_kelas','rating_review','tempat'];

    public function matkul() { return $this->belongsTo(Matkul::class,'id_matkul','id_matkul'); }
    public function jadwal() { return $this->belongsTo(Jadwal::class,'id_jadwal','id_jadwal'); }
    public function materi() { return $this->hasMany(Materi::class,'id_kelas','id_kelas'); }
}
