<?php
/**
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231196)
 * File   : MentorChatifySyncSeeder.php
  * Date   : 18-12-2025
 */
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Mentor;
use App\Models\User;

class MentorChatifySyncSeeder extends Seeder
{
    public function run(): void
    {
        $mentors = Mentor::all();

        foreach ($mentors as $m) {

            // 1) Cari user by email mentor
            $u = User::where('email', $m->email)->first();

            // 2) Kalau user belum ada, buat
            if (!$u) {
                $u = new User();
                $u->nama  = $m->nama;
                $u->email = $m->email;
                $u->password = $m->password; // sudah hash

                // username kalau ada kolomnya
                if (Schema::hasColumn($u->getTable(), 'username')) {
                    $base = 'mentor_'.$m->id_mentor;
                    $u->username = $base;
                }

                if (Schema::hasColumn($u->getTable(), 'foto_profil')) {
                    $u->foto_profil = $m->foto_profil;
                }
                if (Schema::hasColumn($u->getTable(), 'avatar')) {
                    $u->avatar = $m->foto_profil ?? 'avatar.png';
                }
                if (Schema::hasColumn($u->getTable(), 'messenger_color')) {
                    $u->messenger_color = '#9E67D8';
                }
                if (Schema::hasColumn($u->getTable(), 'is_active')) {
                    $u->is_active = 1;
                }
                if (Schema::hasColumn($u->getTable(), 'role')) {
                    $u->role = 'mentor';
                }
                if (Schema::hasColumn($u->getTable(), 'is_mentor')) {
                    $u->is_mentor = 1;
                }

                $u->save();
            } else {
                // kalau user sudah ada, pastikan flag mentor terisi (kalau kolom ada)
                if (Schema::hasColumn($u->getTable(), 'role') && empty($u->role)) {
                    $u->role = 'mentor';
                }
                if (Schema::hasColumn($u->getTable(), 'is_mentor')) {
                    $u->is_mentor = 1;
                }
                $u->save();
            }

            // 3) Pastikan mentor.id_chat terisi id_user milik user
            // (jangan skip, supaya kalau sebelumnya salah bisa dibenerin)
            $m->id_chat = $u->getKey(); // harusnya id_user
            $m->save();
        }
    }
}
