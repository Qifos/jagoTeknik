<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Kelas;
use App\Models\BeliMatkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Toggle wishlist untuk sebuah kelas.
     * - Kalau belum ada → tambahkan
     * - Kalau sudah ada → hapus
     * - Kalau kelas sudah dibeli → blok (tidak bisa di-wishlist-kan)
     */
    public function toggle($id_kelas, Request $request)
    {
        $user = Auth::user();

        // Kalau belum login, lempar ke halaman login
        if (!$user) {
            return redirect()->route('login.view')
                ->with('error', 'Silakan login terlebih dahulu untuk menggunakan wishlist.');
        }

        $userId = $user->id_user ?? $user->id;

        // Pastikan kelas ada
        $kelas = Kelas::findOrFail($id_kelas);

        // Cek apakah user sudah membeli matkul dari kelas ini
        $sudahBeli = BeliMatkul::where('id_user', $userId)
            ->where('id_matkul', $kelas->id_matkul)
            ->exists();

        if ($sudahBeli) {
            // Kelas yang sudah dibeli tidak bisa dimasukkan ke wishlist
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => 'blocked',
                    'message' => 'Kelas ini sudah kamu beli, tidak bisa dimasukkan ke wishlist.',
                ], 400);
            }

            return back()->with('info', 'Kelas ini sudah kamu beli, tidak bisa dimasukkan ke wishlist.');
        }

        // Cek apakah sudah ada di wishlist
        $existing = Wishlist::where('id_user', $userId)
            ->where('id_kelas', $id_kelas)
            ->first();

        if ($existing) {
            // Hapus dari wishlist
            $existing->delete();
            $status = 'removed';
        } else {
            // Tambah ke wishlist
            Wishlist::create([
                'id_user'          => $userId,
                'id_kelas'         => $id_kelas,
                'tanggal_wishlist' => now()->toDateString(),
            ]);
            $status = 'added';
        }

        // Kalau nanti mau dipakai AJAX
        if ($request->wantsJson()) {
            return response()->json(['status' => $status]);
        }

        // Default: balik ke halaman sebelumnya
        return back();
    }
}
