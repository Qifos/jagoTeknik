<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;

    protected $table = 'matkul';
    protected $primaryKey = 'id_matkul';
    public $timestamps = true;

    public function mentor(){ return $this->belongsTo(Mentor::class,'id_mentor','id_mentor'); }

    public function materi(){ return $this->hasMany(Materi::class,'id_matkul','id_matkul'); }

    public function beliMatkul(){ return $this->hasMany(BeliMatkul::class,'id_matkul','id_matkul'); }
}
