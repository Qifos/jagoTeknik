<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';
    protected $primaryKey = 'id_materi';
    public $timestamps = true;

    public function video(){ return $this->belongsTo(Video::class,'id_video','id_video'); }
    use HasFactory;
}
