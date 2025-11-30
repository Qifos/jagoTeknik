<?php
/**
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231196)
 * File   : app/Http/Controllers/RekomendasiController.php
 * Desc   : controller untuk 3 list rekomendasi kelas masing" user di homepage
 */

namespace App\Http\Controllers;

use App\Models\BeliMatkul;
use App\Models\Kelas;
use App\Models\Matkul;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekomendasiController extends Controller
{
    /**
     * Menampilkan homepage + 3 kelas rekomendasi.
     */
    public function showHomepage()
    {
        $user = Auth::user();

        // Kalau belum login → top 3 global
        if (!$user) {
            $current = Kelas::with(['matkul.mentor'])
                ->orderByDesc('rating_kelas')
                ->take(3)
                ->get();

            // kalau <3 di DB ya yang ada saja
            return view('homepageview', [
                'recommendations' => $current,
            ]);
        }

        $recommendations = $this->getRekomendasiKelas($user->id_user);

        return view('homepageview', [
            'recommendations' => $recommendations,
            'user'            => $user,
        ]);
    }

    /**
     * Menghasilkan **tepat** 3 kelas rekomendasi untuk user
     * (kalau di DB jumlah kelas memang >=3).
     */
    protected function getRekomendasiKelas(int $userId)
    {
        /** @var \App\Models\User|null $user */
        $user = User::find($userId);
        if (!$user) {
            return $this->fillIfLessThanThree(collect(), collect());
        }

        $jurusanId = $user->id_jurusan;

        // ID matkul yang sudah pernah dibeli user
        $purchasedMatkulIds = BeliMatkul::where('id_user', $userId)
            ->pluck('id_matkul')
            ->filter()
            ->unique()
            ->values();

        // ID kelas yang ada di wishlist user
        $wishlistKelasIds = Wishlist::where('id_user', $userId)
            ->pluck('id_kelas')
            ->filter()
            ->unique()
            ->values();

        // Semua matkul sesuai jurusan user
        $matkulIds = Matkul::where('id_jurusan', $jurusanId)
            ->pluck('id_matkul');

        // Kalau user belum punya jurusan / matkul di jurusan tsb tidak ada
        if (!$jurusanId || $matkulIds->isEmpty()) {
            // fallback: isi global tapi tetap exclude matkul yang sudah dibeli
            $current = Kelas::with(['matkul.mentor'])
                ->when($purchasedMatkulIds->isNotEmpty(), function ($q) use ($purchasedMatkulIds) {
                    $q->whereNotIn('id_matkul', $purchasedMatkulIds);
                })
                ->orderByDesc('rating_kelas')
                ->take(3)
                ->get();

            return $this->fillIfLessThanThree($current, $purchasedMatkulIds);
        }

        // Base query: kelas dari matkul yang sesuai jurusan
        $baseQuery = Kelas::with(['matkul.mentor'])
            ->whereIn('id_matkul', $matkulIds);

        $purchasedEmpty = $purchasedMatkulIds->isEmpty();
        $wishlistEmpty  = $wishlistKelasIds->isEmpty();

        $recommendations = collect();

        /**
         * [A1] IDMatkul[] kosong
         * [A2] wishlist kosong ^ IDMatkul[] tidak kosong
         * → ambil top 3 dari jurusan user, jika pernah beli exclude matkul tsb
         */
        if ($purchasedEmpty || $wishlistEmpty) {

            if (!$purchasedEmpty) {
                $baseQuery->whereNotIn('id_matkul', $purchasedMatkulIds);
            }

            $recommendations = $baseQuery
                ->orderByDesc('rating_kelas')
                ->take(3)
                ->get();

            // PENTING: kalau hasilnya cuma 1 atau 2, isi lagi sampai 3
            return $this->fillIfLessThanThree($recommendations, $purchasedMatkulIds);
        }

        /**
         * [A3] wishlist tidak kosong ^ IDMatkul[] tidak kosong
         * - filterByJurusan     → baseQuery
         * - excludePurchased    → baseQuery->whereNotIn(id_matkul, purchased)
         * - prioritise wishlist → ambil dulu kelas yang ada di wishlist
         * - selectTop3
         */
        $baseQuery->whereNotIn('id_matkul', $purchasedMatkulIds);

        // 1) Prioritas: kelas yang ada di wishlist
        $wishlistFirst = (clone $baseQuery)
            ->whereIn('id_kelas', $wishlistKelasIds)
            ->orderByDesc('rating_kelas')
            ->take(3)
            ->get();

        $remaining = 3 - $wishlistFirst->count();

        // 2) Kalau wishlist < 3, isi sisa dari kelas lain di jurusan yang sama
        if ($remaining > 0) {
            $others = (clone $baseQuery)
                ->whereNotIn('id_kelas', $wishlistFirst->pluck('id_kelas'))
                ->orderByDesc('rating_kelas')
                ->take($remaining)
                ->get();

            $wishlistFirst = $wishlistFirst->concat($others);
        }

        // 3) Pastikan tetap 3 (kalau di jurusan tsb kelas yang lolos filter kurang dari 3,
        //    kita isi lagi dari kelas lain di luar jurusan, tetapi tetap yang belum dibeli)
        return $this->fillIfLessThanThree($wishlistFirst, $purchasedMatkulIds);
    }

    /**
     * Helper: kalau hasil rekomendasi masih kurang dari 3,
     * isi dengan kelas lain (global) yang:
     *  - belum dibeli user (id_matkul tidak ada di $purchasedMatkulIds)
     *  - belum ada di list rekomendasi sekarang
     */
    protected function fillIfLessThanThree($current, $purchasedMatkulIds, $limit = 3)
    {
        $countCurrent = $current->count();
        $needed       = $limit - $countCurrent;

        if ($needed <= 0) {
            // jaga-jaga kalau ternyata lebih dari 3
            return $current->take($limit);
        }

        $excludeKelas = $current->pluck('id_kelas')->filter()->values();

        $query = Kelas::with(['matkul.mentor'])
            ->when($purchasedMatkulIds->isNotEmpty(), function ($q) use ($purchasedMatkulIds) {
                $q->whereNotIn('id_matkul', $purchasedMatkulIds);
            })
            ->when($excludeKelas->isNotEmpty(), function ($q) use ($excludeKelas) {
                $q->whereNotIn('id_kelas', $excludeKelas);
            })
            ->orderByDesc('rating_kelas')
            ->take($needed);

        $extra = $query->get();

        return $current->concat($extra);
    }
}
