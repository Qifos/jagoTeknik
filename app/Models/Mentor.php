<?php
/**
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231196)
 * File   : Mentor.php
  * Date   : 18-12-2025
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    protected $table = 'mentor';
    protected $primaryKey = 'id_mentor';
    public $timestamps = true;

    protected $fillable = [
        'id_jurusan','id_matkul','id_chat','nama','email','password','foto_profil'
    ];
}


