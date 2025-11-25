<?php

/**
 * Author : Muhammad Fiqih Soetam Putra (NRP 5026231096)
 * File   : app/Http/Controllers/PembayaranController.php
 * Desc   : pembayaran controller untuk mengelola proses pembayaran kelas
 * Date   : 25-11-2025
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Matkul;
use App\Models\BeliMatkul;

class PembayaranController extends Controller
{
    /**
     * TASK 2 - Step 1: Show the "Beli Kelas" page (initial buy view)
     * Display dynamic class details (Price, Description) from the matkul table
     * This is handled by KelasController::belikelas method now
     */

    /**
     * TASK 2 - Step 2: Show the "Checkout" page with password validation
     * GET /checkout/{id} -> Shows checkout
     */
    public function showCheckout($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.view')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Fetch the class to get its price and details
        $kelas = Matkul::findOrFail($id);

        // Create mock cart items based on the class
        $item1 = [
            'title' => $kelas->nama_matkul . ' - Paket Recording',
            'description' => 'Video pembelajaran lengkap...',
            'price' => $kelas->harga ?? 90000,
            'image' => 'https://placehold.co/100x100/333/fff?text=Rec'
        ];
        $item2 = [
            'title' => 'Paket 1 Meet (Reguler)',
            'description' => 'Kelas offline untuk pembelajaran...',
            'price' => 0,
            'image' => 'https://placehold.co/100x100/555/fff?text=Meet'
        ];

        $subtotal = $item1['price'] + $item2['price'];
        $admin_fee = 2000;
        $discount_percent = 0.50; // 50%
        $discount_amount = $subtotal * $discount_percent;
        $total = ($subtotal - $discount_amount) + $admin_fee;

        $summary = [
            'items' => [$item1, $item2],
            'subtotal' => $subtotal,
            'discount_percent' => '50%',
            'discount_amount' => $discount_amount,
            'admin_fee' => $admin_fee,
            'total' => $total
        ];

        return view('checkoutview', [
            'summary' => $summary,
            'kelas' => $kelas,
            'kelas_id' => $id
        ]);
    }

    /**
     * TASK 2 - Step 3: Process the payment
     * POST /checkout/{id} -> Processes payment
     * Validates user password for security, creates BeliMatkul record, redirects to loading
     */
    public function processPayment(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'payment_method' => 'required'
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.view')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Validate password using Hash::check for security
        if (!Hash::check($request->password, $user->password)) {
            Log::warning("Payment failed (password mismatch) for user: " . $request->email);
            return back()->withErrors(['password' => 'Password yang Anda masukkan salah.'])->withInput();
        }

        // Fetch class and summary data
        $kelas = Matkul::findOrFail($id);

        // Check if user already purchased this class
        $alreadyBought = BeliMatkul::where('id_user', $user->id_user)
            ->where('id_matkul', $id)
            ->exists();

        if ($alreadyBought) {
            return back()->withErrors(['payment' => 'Anda sudah membeli kelas ini sebelumnya.']);
        }

        // Calculate payment amounts
        $subtotal = $kelas->harga ?? 90000;
        $admin_fee = 2000;
        $discount_percent = 0.50;
        $discount_amount = $subtotal * $discount_percent;
        $total = ($subtotal - $discount_amount) + $admin_fee;

        // Create the transaction in `beli_matkul` table
        try {
            $pembelian = new BeliMatkul();
            $pembelian->id_matkul = $id;
            $pembelian->id_user = $user->id_user;
            $pembelian->cara_pembayaran = $request->payment_method;
            $pembelian->sub_total = $subtotal;
            $pembelian->diskon = $discount_amount;
            $pembelian->biaya_admin = $admin_fee;
            $pembelian->total = $total;
            $pembelian->benefit = 'Akses ' . $kelas->nama_matkul;
            $pembelian->save();

            Log::info("Payment processing SUCCESS for user: " . $user->email . " for class: " . $id . ". Transaction ID: " . $pembelian->id_beli_matkul);

            // Redirect to loading page
            return redirect()->route('pembayaran.loading', ['id' => $id]);

        } catch (\Exception $e) {
            Log::error("Database error during payment: " . $e->getMessage());
            return back()->withErrors(['payment' => 'Gagal menyimpan transaksi. Coba lagi.'])->withInput();
        }
    }

    /**
     * TASK 2 - Step 4: Show the loading page for 3 seconds
     * GET /loading/{id} -> Loading screen
     * Meta refresh redirects to success page after 3 seconds
     */
    public function showLoading($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.view');
        }

        // Verify the class exists
        Matkul::findOrFail($id);

        // Redirect URL to success page
        $redirectTo = route('pembayaran.sukses', ['id' => $id]);

        return view('loadingview', ['redirectTo' => $redirectTo]);
    }

    /**
     * TASK 2 - Step 5: Show the "Sukses" page
     * GET /sukses/{id} -> Success screen
     * Display details of the specific class purchased
     */
    public function showSukses($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.view');
        }

        // Fetch the class data that was just purchased
        $kelas = Matkul::with('mentor')->findOrFail($id);

        // Get the purchase record for this user and class
        $pembelian = BeliMatkul::where('id_user', $user->id_user)
            ->where('id_matkul', $id)
            ->first();

        if (!$pembelian) {
            abort(404, 'Pembelian tidak ditemukan');
        }

        // Prepare success page data
        $purchased_class_data = [
            'id' => $id,
            'title' => $kelas->nama_matkul,
            'description' => $kelas->deskripsi,
            'image' => 'https://placehold.co/600x400/000/fff?text=' . urlencode($kelas->nama_matkul),
            'rating' => 4.3,
            'rating_count' => 16325,
            'instructor' => $kelas->mentor->nama ?? 'Instruktur',
            'duration' => '3 Bulan',
            'price' => $pembelian->total,
            'transaction_id' => $pembelian->id_beli_matkul
        ];

        return view('suksesview', ['kelas' => $purchased_class_data]);
    }
}

