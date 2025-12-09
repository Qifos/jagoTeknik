<?php
/**
 * Author : Akhtar Zia Faizarrobbi (NRP 5026231095)
 * File   : app/Http/Models/Jadwal.php
 * Desc   : Jadwal
 * Date   : 2025-11-10
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';
    public $incrementing = true;
    protected $keyType = 'int';

    // timestamps aktif karena kolom created_at & updated_at ada
    protected $fillable = ['id_kelas', 'tanggal', 'jam_mulai', 'jam_selesai'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // contoh relasi ke tabel kelas (opsional)
    public function kelas()
    {
        return $this->belongsTo(\App\Models\Kelas::class, 'id_kelas', 'id_kelas');
    }
}
