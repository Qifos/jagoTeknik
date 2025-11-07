<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'histori';
    protected $primaryKey = 'id_status';
    public $timestamps = true;

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas'); // ganti 'kelas_id' bila perlu
    }
}
