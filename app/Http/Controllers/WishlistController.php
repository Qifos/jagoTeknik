<?php
/**
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231196)
 * File   : app/Http/Controllers/WishlistController.php
 * Desc   : controller untuk daftar wishlist masing" user di navbar kelas
 */
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
     * - Kalau belum ada → ditambahkan
     * - Kalau sudah ada → dihapus
     */
    public function toggle(Request $request, $id_kelas)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()
                ->route('login')
                ->with('error', 'Silakan login dulu untuk menggunakan wishlist.');
        }

        $userId = $user->id_user ?? $user->id;

        // Cari kelas
        $kelas = Kelas::findOrFail($id_kelas);

        // Optional: kalau sudah dibeli, nggak usah bisa di-wishlist
        $sudahDibeli = BeliMatkul::where('id_user', $userId)
            ->where('id_matkul', $kelas->id_matkul)
            ->exists();

        if ($sudahDibeli) {
            return back()->with('info', 'Kelas ini sudah kamu beli 👍');
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
