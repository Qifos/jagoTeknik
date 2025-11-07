<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\History;
use App\Models\Wishlist;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();              // id user yang login

        // ===== 1) SEMUA =====
        $semua = Kelas::orderByDesc('updated_at')->get();

        // ===== 2) DIAKUTI =====
        // Asumsi: tabel histori punya kolom user_id & kelas_id
        $diikuti = Kelas::whereHas('histories', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->get();

        // ===== 3) SELESAI =====
        // Selesai jika progress 100% ATAU status_materi = 1
        $selesai = Kelas::whereHas('histories', function ($q) use ($userId) {
            $q->where('user_id', $userId)
              ->where(function ($qq) {
                  $qq->where('progres_precentage', 100)
                     ->orWhere('status_materi', 1);
              });
        })->get();

        // ===== 4) WISHLIST =====
        // Kalau kamu SUDAH punya tabel wishlists (user_id, kelas_id):
        $wishlist = Kelas::whereHas('wishlists', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->get();

        // ---- Jika BELUM punya tabel wishlists dan (sementara) simpan di kolom kelas.id_wishlist_kelas,
        // ganti baris $wishlist di atas dengan ini:
        // $wishlist = Kelas::whereNotNull('id_wishlist_kelas')->get();

        return view('kelas', compact('semua', 'diikuti', 'selesai', 'wishlist'));
    }
}
