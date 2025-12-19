<?php
/**
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231196)
 * File   : MentorController.php
  * Date   : 18-12-2025
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mentor;
use App\Models\Matkul;
use App\Models\Jurusan;
use App\Models\User;

class MentorController extends Controller
{
    public function index(Request $request)
    {
        $q       = trim((string) $request->query('q', ''));
        $matkul  = $request->query('matkul');
        $jurusan = $request->query('jurusan');

        $matkuls  = Matkul::select('id_matkul','nama_matkul')->orderBy('nama_matkul')->get();
        $jurusans = Jurusan::select('id_jurusan','nama_jurusan')->orderBy('nama_jurusan')->get();

        $query = Mentor::query()
            ->leftJoin('jurusan', 'mentor.id_jurusan', '=', 'jurusan.id_jurusan')
            ->leftJoin('matkul', 'mentor.id_matkul', '=', 'matkul.id_matkul')
            ->select('mentor.*', 'jurusan.nama_jurusan', 'matkul.nama_matkul');

        if ($q !== '') {
            $query->where('mentor.nama', 'like', "%{$q}%");
        }
        if (!empty($matkul)) {
            $query->where('mentor.id_matkul', (int)$matkul);
        }
        if (!empty($jurusan)) {
            $query->where('mentor.id_jurusan', (int)$jurusan);
        }

        $mentors = $query->orderBy('mentor.nama')->paginate(12)->withQueryString();

        return view('mentor', compact('mentors','matkuls','jurusans','q','matkul','jurusan'));
    }

    public function show($id)
    {
        $mentor = Mentor::query()
            ->leftJoin('jurusan', 'mentor.id_jurusan', '=', 'jurusan.id_jurusan')
            ->leftJoin('matkul', 'mentor.id_matkul', '=', 'matkul.id_matkul')
            ->select('mentor.*', 'jurusan.nama_jurusan', 'matkul.nama_matkul')
            ->where('mentor.id_mentor', (int)$id)
            ->firstOrFail();

        // ✅ cari user mentor di tabel user (biar bisa diarahkan ke chatify/{id})
        $mentorUser = \App\Models\User::query()
            ->where('email', $mentor->email)
            ->orWhere('nama', $mentor->nama)
            ->first();

        $chatifyUserId = $mentorUser?->id; // Chatify pakai $user->id

        // ✅ ambil daftar mata kuliah/kelas (BIAR $courses ADA)
        // kalau struktur tabel matkul kamu beda, minimal ini tidak bikin error
        $courses = \App\Models\Matkul::query()
            ->select('id_matkul', 'nama_matkul')
            ->where(function ($q) use ($mentor) {
                // opsi 1: kalau ada id_mentor di tabel matkul
                $q->where('id_mentor', $mentor->id_mentor);
            })
            ->orderBy('nama_matkul')
            ->get();

        return view('mentor_profile', compact('mentor', 'chatifyUserId', 'courses'));
    }
}
