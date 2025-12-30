<?php

/**
 * Author : Muhammad Fiqih Soetam Putra (NRP 5026231096)
 * File   : app/Http/Controllers/KelasController.php
 * Desc   : kelas controller untuk mengelola kelas, materi, video
 * Date   : 25-11-2025
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Matkul;
use App\Models\Materi;
use App\Models\Video;
use App\Models\BeliMatkul;
use App\Models\UserMateriProgress;

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
                'ment.image_mentor',
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
        $materiList = Materi::where('id_matkul', $id)->orderBy('id_materi', 'asc')->get();

        // Build materials array with their videos and progress status
        $materiItems = $materiList->map(function($materi, $index) use ($matkul, $user, $materiList) {
            $videos = Video::where('id_materi', $materi->id_materi)->get();

            // Get user progress for this materi
            $progress = null;
            $isUnlocked = false;

            if ($user) {
                $progress = UserMateriProgress::where('id_user', $user->id_user)
                    ->where('id_materi', $materi->id_materi)
                    ->first();

                // Check if materi is unlocked
                // First materi is always unlocked
                if ($index === 0) {
                    $isUnlocked = true;
                } else {
                    // For other materies, check if all previous materies are completed with quiz passed
                    $previousMateri = $materiList->slice(0, $index);
                    $previousCompleted = UserMateriProgress::where('id_user', $user->id_user)
                        ->whereIn('id_materi', $previousMateri->pluck('id_materi'))
                        ->where('quiz_passed', true)
                        ->count();
                    $isUnlocked = $previousCompleted === $previousMateri->count();
                }
            } else {
                // If not logged in, only first materi is unlocked
                $isUnlocked = ($index === 0);
            }

            // Determine status text
            $isCompleted = $progress ? $progress->is_completed : false;
            $statusText = $isCompleted ? 'Sudah dibaca' : 'Belum dibaca';
            $progressValue = $isCompleted ? 100 : 0;

            return [
                'id' => $materi->id_materi,
                'title' => $materi->nama_materi,
                'tag' => $materi->tipe ?? 'Teori',
                'thumb' => $materi->thumbnail_path ?? 'https://placehold.co/600x400/0284c7/white?text=' . urlencode($materi->nama_materi),
                'instructor' => $matkul->mentor->nama ?? 'Instruktur',
                'mentor_image' => $matkul->mentor->image_mentor ?? null,
                'progress' => $progressValue,
                'progress_text' => $statusText,
                'is_completed' => $isCompleted,
                'is_unlocked' => $isUnlocked,
                'content_read' => $progress ? $progress->content_read : false,
                'video_completed' => $progress ? $progress->video_completed : false,
                'videos_count' => $videos->count()
            ];
        });

        // Fetch videos (get first video from each materi)
        $videoItems = $materiList->map(function($materi) use ($matkul) {
            $videos = Video::where('id_materi', $materi->id_materi)->first();
            if (!$videos) return null;
            return [
                'id' => $videos->id_video,
                'title' => 'Video ' . ($materi->nama_materi ?? 'Materi'),
                'thumb' => $videos->thumbnail_path ?? 'https://placehold.co/600x400/e11d48/white?text=Video',
                'instructor' => $matkul->mentor->nama ?? 'Instruktur',
                'materi_id' => $materi->id_materi
            ];
        })->filter()->values();

        // Calculate overall progress for the class
        $overallProgress = 0;
        if ($user && $materiList->count() > 0) {
            $completedCount = UserMateriProgress::where('id_user', $user->id_user)
                ->where('id_matkul', $id)
                ->where('is_completed', true)
                ->count();
            $overallProgress = round(($completedCount / $materiList->count()) * 100);
        }

        return view('kelas', [
            'matkul' => $matkul,
            'sudahDibeli' => $sudahDibeli,
            'materiItems' => $materiItems,
            'videoItems' => $videoItems,
            'overallProgress' => $overallProgress
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

    // ✅ PERBAIKAN: Ambil data dari tabel KELAS, bukan MATKUL
    $kelas = DB::table('kelas as k')
        ->join('matkul as m', 'k.id_matkul', '=', 'm.id_matkul')
        ->leftJoin('mentor as ment', 'm.id_mentor', '=', 'ment.id_mentor')
        ->where('k.id_kelas', $id)
        ->select(
            'k.id_kelas',
            'k.image_path',
            'k.harga_asli',
            'k.preview',
            'ment.image_mentor',
            'ment.nama as nama_mentor',
            'm.id_matkul',
            'm.nama_matkul',
            'm.deskripsi',
            'ment.nama as nama_mentor'
        )
        ->first();

    if (!$kelas) {
        return redirect()->route('kelas.semua')
            ->with('error', 'Kelas tidak ditemukan.');
    }

    // Check if user already purchased this class
    $sudahDibeli = BeliMatkul::where('id_user', $user->id_user)
        ->where('id_matkul', $kelas->id_matkul)
        ->exists();

    if ($sudahDibeli) {
        return redirect()->route('kelas.show', $kelas->id_matkul)
            ->with('info', 'Anda sudah memiliki kelas ini.');
    }

    // Dynamic benefits based on materi count
    $materiCount = Materi::where('id_matkul', $kelas->id_matkul)->count();
    $benefits = [
        'Bimbingan kelas offline',
        'Akses video pembelajaran',
        'Silabus & soal terbaru',
        $materiCount . ' Materi pembelajaran'
    ];

    // Ambil harga_asli dari tabel kelas
    $harga = $kelas->harga_asli ?? 0;
    $image = $kelas->image_path;

    // Cek apakah kelas ini sudah ada di wishlist user
    // (dipakai untuk state tombol "Tambahkan ke wishlist")
    $isWishlisted = DB::table('wishlist_kelas')
        ->where('id_user', $user->id_user)
        ->where('id_kelas', $kelas->id_kelas)
        ->exists();

    return view('belikelasview', [
        'kelas' => $kelas,
        'benefits' => $benefits,
        'harga' => $harga,
        'image' => $image,
        'isWishlisted' => $isWishlisted,
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
            // Return 0 progress for anonymous users
            return 0;
        }

        try {
            // Get the matkul associated with this kelas
            $kelas = DB::table('kelas')->where('id_kelas', $id_kelas)->first();
            if (!$kelas) {
                return 0;
            }

            // Get total number of materies in this matkul
            $totalMateri = Materi::where('id_matkul', $kelas->id_matkul)->count();
            if ($totalMateri === 0) {
                return 0;
            }

            // Get number of completed materies (quiz_passed = true)
            $completedMateri = UserMateriProgress::where('id_user', $user->id_user)
                ->where('id_matkul', $kelas->id_matkul)
                ->where('quiz_passed', true)
                ->count();

            // Calculate progress percentage
            $progress = round(($completedMateri / $totalMateri) * 100);
            return $progress;

        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Preview class page from Jadwal view
     * Shows class details with video preview
     * GET /kelas/{id_kelas}/preview
     */
    public function preview($id_kelas)
    {
        // Fetch kelas with related matkul and mentor data
        $kelas = DB::table('kelas as k')
            ->join('matkul as m', 'k.id_matkul', '=', 'm.id_matkul')
            ->leftJoin('mentor as mt', 'm.id_mentor', '=', 'mt.id_mentor')
            ->where('k.id_kelas', $id_kelas)
            ->select(
                'k.id_kelas',
                'k.image_path',
                'k.deskripsi',
                'k.tempat',
                'm.id_matkul',
                'm.nama_matkul',
                'm.deskripsi as matkul_deskripsi',
                'mt.nama as mentor_nama'
            )
            ->first();

        if (!$kelas) {
            return redirect()->route('jadwal.index')
                ->with('error', 'Kelas tidak ditemukan.');
        }

        // Get nearest jadwal for this kelas
        $today = \Carbon\Carbon::now()->toDateString();
        $currentTime = \Carbon\Carbon::now()->format('H:i:s');

        $jadwal = DB::table('jadwal as j')
            ->where('j.id_kelas', $id_kelas)
            ->where(function ($query) use ($today, $currentTime) {
                $query->where('j.tanggal', '>', $today)
                      ->orWhere(function ($q) use ($today, $currentTime) {
                          $q->where('j.tanggal', '=', $today)
                            ->where('j.jam_mulai', '>=', $currentTime);
                      });
            })
            ->orderBy('j.tanggal', 'asc')
            ->orderBy('j.jam_mulai', 'asc')
            ->select('j.id_jadwal', 'j.tanggal', 'j.jam_mulai', 'j.jam_selesai')
            ->first();

        if (!$jadwal) {
            return redirect()->route('jadwal.index')
                ->with('error', 'Jadwal kelas tidak ditemukan.');
        }

        // Get matkul with mentor and jurusan
        $matkul = Matkul::with(['mentor', 'jurusan'])->find($kelas->id_matkul);

        return view('kelaspreview', [
            'kelas' => $kelas,
            'jadwal' => $jadwal,
            'matkul' => $matkul
        ]);
    }

    /**
     * Default index for compatibility with existing routes
     */
    public function index()
    {
        return $this->semuaKelas();
    }
}
