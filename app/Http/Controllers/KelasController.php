<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Matkul;
use App\Models\Materi;
use App\Models\Video;
use App\Models\BeliMatkul;

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
     * TASK 1: Dynamic Class Display Page (One View, Many Data)
     * Shows the main class page with materials, videos, and dynamic action button
     * GET /kelas/{id} -> Shows the dynamic class page
     */
    public function showKelas($id)
    {
        $user = Auth::user();

        // Fetch the Matkul (class) with its Mentor
        $matkul = Matkul::with('mentor')->findOrFail($id);

        // Check if user has purchased this class
        $sudahDibeli = false;
        if ($user) {
            $sudahDibeli = BeliMatkul::where('id_user', $user->id_user)
                ->where('id_matkul', $id)
                ->exists();
        }

        // Fetch all Materi (materials) for this Matkul
        $materiList = Materi::where('id_matkul', $id)->get();

        // Build materials array with their videos
        $materiItems = $materiList->map(function($materi, $index) use ($matkul) {
            $videos = Video::where('id_materi', $materi->id_materi)->get();
            return [
                'id' => $materi->id_materi,
                'title' => $materi->nama_materi,
                'tag' => $index % 2 == 0 ? 'Teori' : 'Praktik',
                'thumb' => $materi->thumbnail_path ?? 'https://placehold.co/600x400/0284c7/white?text=' . urlencode($materi->nama_materi),
                'instructor' => $matkul->mentor->nama ?? 'Instruktur',
                'progress' => rand(0, 100),
                'progress_text' => 'Lesson ' . rand(1, 7) . ' of 7',
                'videos_count' => $videos->count()
            ];
        });

        // Fetch videos (get first video from each materi)
        $videoItems = $materiList->map(function($materi) use ($matkul) {
            $videos = Video::where('id_materi', $materi->id_materi)->first();
            if (!$videos) return null;
            return [
                'id' => $videos->id_video,
                'title' => $videos->nama_video ?? 'Video ' . $videos->id_video,
                'thumb' => $videos->thumbnail_path ?? 'https://placehold.co/600x400/e11d48/white?text=Video',
                'instructor' => $matkul->mentor->nama ?? 'Instruktur',
                'progress' => rand(0, 100),
                'progress_text' => 'Lesson ' . rand(1, 7) . ' of 7'
            ];
        })->filter()->values();

        return view('kelas', [
            'matkul' => $matkul,
            'sudahDibeli' => $sudahDibeli,
            'materiItems' => $materiItems,
            'videoItems' => $videoItems
        ]);
    }

    /**
     * TASK 2: Buy Class Landing Page
     * Display dynamic class details (Price, Description) from the matkul table
     * GET /kelas/{id}/beli -> Shows the buy landing page
     */
    public function belikelas($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.view')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Check if user already purchased this class
        $sudahDibeli = BeliMatkul::where('id_user', $user->id_user)
            ->where('id_matkul', $id)
            ->exists();

        if ($sudahDibeli) {
            return redirect()->route('kelas.show', $id)
                ->with('info', 'Anda sudah memiliki kelas ini.');
        }

        // Fetch the Matkul with its Mentor
        $kelas = Matkul::with('mentor')->findOrFail($id);

        // Dynamic benefits based on materi count
        $materiCount = Materi::where('id_matkul', $id)->count();
        $benefits = [
            'Bimbingan kelas offline',
            'Akses video pembelajaran',
            'Silabus & soal terbaru',
            $materiCount . ' Materi pembelajaran'
        ];

        return view('belikelasview', [
            'kelas' => $kelas,
            'benefits' => $benefits
        ]);
    }

    /**
     * Show the class detail page (for already purchased classes)
     * This is an alias for showKelas to handle the /kelas/{id}/belajar route
     */
    public function showKelasDetail($id_matkul)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.view')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Check if user purchased this class
        $sudahDibeli = BeliMatkul::where('id_user', $user->id_user)
            ->where('id_matkul', $id_matkul)
            ->exists();

        if (!$sudahDibeli) {
            return redirect()->route('kelas.beli', $id_matkul)
                ->with('info', 'Silakan beli kelas terlebih dahulu untuk mengakses materi.');
        }

        return $this->showKelas($id_matkul);
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

    /**
     * Default index for compatibility with existing routes
     */
    public function index()
    {
        return $this->semuaKelas();
    }
}
