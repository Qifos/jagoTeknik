<?php
/**
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231196)
 * File   : app/Http/Models/LiveChat.php
 * Desc   : Live Chat Models
 * Date   : 2025-11-06
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class LiveChat extends Model
{
    protected $table = 'live_chat';
    protected $primaryKey = 'id_live_chat';


    // created_at ada, updated_at belum -> nanti kita tambah; sementara izinkan null
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';   // akan ditambahkan via migration di bawah


    protected $fillable = [
        'id_user',
        'id_mentor',
        'message',
        'media_url',
        'sender_type', // <-- kolom baru (lihat migration)
        'is_read',     // <-- kolom baru (lihat migration)
        'status',      // ada di dump
        'tanggal',
        'waktu',
        'created_at',
        'updated_at',
    ];


    public function user()   { return $this->belongsTo(User::class,   'id_user',   'id_user'); }
    public function mentor() { return $this->belongsTo(Mentor::class, 'id_mentor', 'id_mentor'); }
}
