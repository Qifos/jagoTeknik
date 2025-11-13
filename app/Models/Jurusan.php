<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';           // bukan 'jurusans'
    protected $primaryKey = 'id_jurusan';   // PK custom
    public $timestamps = false;             // set sesuai tabelmu

    public function users()
    {
        return $this->hasMany(User::class, 'id_jurusan', 'id_jurusan');
    }
}
