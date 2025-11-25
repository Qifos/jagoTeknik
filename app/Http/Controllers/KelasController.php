<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Matkul;

class KelasController extends Controller
{
    /**
     * Halaman list semua kelas untuk browsing
     * Menampilkan semua kelas dari database dengan filter status
     */
    public function semuaKelas()
    {
        $user = Auth::user();

        $semuaKelas = DB::table('kelas as k')
            ->join('matkul as m', 'k.id_matkul', '=', 'm.id_matkul')
            ->leftJoin('mentor as ment', 'm.id_mentor', '=', 'ment.id_mentor')
            ->leftJoin('beli_matkul as bm', function($join) use ($user) {
                $join->on('m.id_matkul', '=', 'bm.id_matkul')
                     ->where('bm.id_user', '=', $user ? $user->id_user : null);
            })
            ->leftJoin('wishlist_kelas as wl', function($join) use ($user) {
                $join->on('k.id_kelas', '=', 'wl.id_kelas')
                     ->where('wl.id_user', '=', $user ? $user->id_user : null);
            })
            ->select(
                'k.id_kelas',
                'm.id_matkul',
                'm.nama_matkul',
                'm.deskripsi',
                'k.deskripsi as deskripsi_kelas',
                'k.preview',
                'k.rating_kelas',
                'k.harga_asli',
                'ment.nama as nama_mentor',
                'bm.id_beli_matkul',
                'wl.id_wishlist_kelas',
                DB::raw('CASE
                    WHEN bm.id_beli_matkul IS NOT NULL THEN "completed"
                    WHEN wl.id_wishlist_kelas IS NOT NULL THEN "wishlist"
                    ELSE "available"
                END as status_kelas')
            )
            ->get();

        return view('semuakelas', compact('semuaKelas'));
    }

    /**
     * Halaman pembelian kelas (menggunakan model Matkul)
     * Untuk user yang belum membeli kelas
     */
        public function showBeliKelas($id_matkul)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah user sudah membeli kelas ini
        $sudahDibeli = DB::table('beli_matkul')
            ->where('id_user', $user->id_user)
            ->where('id_matkul', $id_matkul)
            ->exists();

        // Jika sudah dibeli, redirect ke halaman belajar
        if ($sudahDibeli) {
            // Cari id_kelas untuk redirect
            $kelas = DB::table('kelas')
                ->where('id_matkul', $id_matkul)
                ->first();

            if ($kelas) {
                return redirect()->route('kelas.detail.beli', $kelas->id_kelas)
                    ->with('info', 'Anda sudah memiliki kelas ini.');
            }
        }

        // Fetch the class from the 'matkul' table using its ID
        $kelas = Matkul::findOrFail($id_matkul);

        // Mock data for benefits as it's not in the DB
        $benefits = [
            'Bimbingan kelas offline',
            'Akses video',
            'Silabus & soal terbaru',
            '32 Materi'
        ];

        return view('belikelasview', [
            'kelas' => $kelas,
            'benefits' => $benefits
        ]);
    }

    /**
     * Halaman belajar - untuk kelas yang SUDAH dibeli
     */
    public function showKelasDetail($id_kelas)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil detail kelas
        $kelas = DB::table('kelas as k')
            ->join('matkul as m', 'k.id_matkul', '=', 'm.id_matkul')
            ->leftJoin('materi as mt', 'k.id_materi', '=', 'mt.id_materi')
            ->leftJoin('mentor as ment', 'm.id_mentor', '=', 'ment.id_mentor')
            ->where('k.id_kelas', $id_kelas)
            ->select(
                'k.*',
                'm.id_matkul',
                'm.nama_matkul',
                'm.deskripsi',
                'ment.nama as nama_mentor',
                'ment.rating as rating_mentor',
                'mt.nama_materi'
            )
            ->first();

        if (!$kelas) {
            abort(404, 'Kelas tidak ditemukan');
        }

        // Cek apakah user sudah membeli kelas ini
        $sudahDibeli = DB::table('beli_matkul')
            ->where('id_user', $user->id_user)
            ->where('id_matkul', $kelas->id_matkul)
            ->exists();

        // Jika belum dibeli, redirect ke halaman pembelian
        if (!$sudahDibeli) {
            return redirect()->route('kelas.beli', $kelas->id_matkul)
                ->with('info', 'Silakan beli kelas terlebih dahulu untuk mengakses materi.');
        }

        // Ambil materi untuk kelas ini
        $materiItems = DB::table('materi as m')
            ->where('m.id_kelas', $id_kelas)
            ->select('m.*')
            ->get()
            ->map(function($item, $index) {
                return [
                    'id' => $item->id_materi,
                    'thumb' => $index % 2 == 0 ? 'https://placehold.co/600x400/0284c7/white?text=Materi' . $item->id_materi : null,
                    'tag' => $index % 2 == 0 ? 'Teori' : 'Praktik',
                    'title' => $item->nama_materi,
                    'instructor' => 'Instruktur Default',
                    'progress' => rand(0, 100),
                    'progress_text' => 'Lesson ' . rand(1, 7) . ' of 7'
                ];
            });

        // Jika tidak ada materi, gunakan mock data
        if ($materiItems->isEmpty()) {
            $materiItems = collect([
                ['id' => 1, 'thumb' => 'https://placehold.co/600x400/0284c7/white?text=Fungsi', 'tag' => 'Teori', 'title' => 'Pengenalan ' . $kelas->nama_matkul, 'instructor' => $kelas->nama_mentor, 'progress' => 100, 'progress_text' => 'Finished'],
                ['id' => 2, 'thumb' => 'https://placehold.co/600x400/c026d3/white?text=Konsep', 'tag' => 'Praktik', 'title' => 'Konsep Dasar', 'instructor' => $kelas->nama_mentor, 'progress' => 71, 'progress_text' => 'Lesson 5 of 7'],
            ]);
        }

        // Ambil video untuk kelas ini
        $videoItems = [
            ['id' => 1, 'thumb' => 'https://placehold.co/600x400/e11d48/white?text=QUIZ+1', 'title' => 'Video 1', 'instructor' => $kelas->nama_mentor, 'progress' => 71, 'progress_text' => 'Lesson 5 of 7'],
            ['id' => 2, 'thumb' => 'https://placehold.co/600x400/f43f5e/white?text=QUIZ+2', 'title' => 'Video 2', 'instructor' => $kelas->nama_mentor, 'progress' => 71, 'progress_text' => 'Lesson 5 of 7'],
        ];

        return view('kelas', [
            'kelas' => $kelas,
            'materiItems' => $materiItems,
            'videoItems' => $videoItems
        ]);
    }

    /**
     * Toggle wishlist kelas
     * Untuk menambah/menghapus kelas dari wishlist user
     */
    public function toggleWishlist($id_kelas)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah sudah ada di wishlist
        $existingWishlist = DB::table('wishlist_kelas')
            ->where('id_user', $user->id_user)
            ->where('id_kelas', $id_kelas)
            ->first();

        if ($existingWishlist) {
            // Hapus dari wishlist
            DB::table('wishlist_kelas')
                ->where('id_wishlist_kelas', $existingWishlist->id_wishlist_kelas)
                ->delete();

            $message = 'Kelas dihapus dari wishlist.';
        } else {
            // Tambah ke wishlist
            DB::table('wishlist_kelas')->insert([
                'id_user' => $user->id_user,
                'id_kelas' => $id_kelas,
                'tanggal_wishlist' => now()->toDateString(),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $message = 'Kelas ditambahkan ke wishlist.';
        }

        return back()->with('success', $message);
    }

    /**
     * Get progress kelas untuk user
     * Method ini dipanggil dari view
     */
    public function getProgressKelas($id_kelas)
    {
        $user = Auth::user();

        if (!$user) {
            // Return progress default untuk demo
            return rand(0, 100);
        }

        // Query untuk mendapatkan progress
        $progress = DB::table('history as h')
            ->join('materi as m', 'h.id_status', '=', 'm.id_materi')
            ->join('kelas as k', 'm.id_kelas', '=', 'k.id_kelas')
            ->where('k.id_kelas', $id_kelas)
            ->where('h.id_status', $user->id_user)
            ->avg('h.progres_precentage');

        return $progress ? round($progress) : rand(0, 100);
    }
}
