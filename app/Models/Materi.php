<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';
    protected $primaryKey = 'id_materi';
    public $timestamps = true;

    public function matkul(){ return $this->belongsTo(Matkul::class,'id_matkul','id_matkul'); }

    public function video(){ return $this->hasMany(Video::class,'id_materi','id_materi'); }
}
