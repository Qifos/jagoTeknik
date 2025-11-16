<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;   // Import DB facade
use Illuminate\Support\Facades\Hash; // Import Hash facade
use Illuminate\Support\Facades\Log;   // Import Log facade
use App\Models\User;                 // Import User model
use App\Models\Matkul;               // Import your Matkul model
use App\Models\BeliMatkul;           // Import your BeliMatkul model

class PembayaranController extends Controller
{
    /**
     * Show the "Beli Kelas" page.
     * Mockup: Beli kelas.jpg
     */
    public function showBeliKelas($id)
    {
        // Fetch the class from the 'matkul' table using its ID
        $kelas = Matkul::findOrFail($id);

        // Mock data for benefits as it's not in the DB
        $benefits = [
            'Bimbingan kelas offline',
            'Akses video',
            'Silabus & soal terbaru',
            '32 Materi'
        ];

        return view('belikelasview', [
            'kelas' => $kelas,
            'benefits' => $benefits // Pass benefits separately
        ]);
    }

    /**
     * Show the "Checkout" page.
     * Mockup: Bayar kelas.png
     */
    public function showCheckout($id)
    {
        // Fetch the class to get its price
        $kelas = Matkul::findOrFail($id);

        // Simulate the cart items based on the class
        $item1 = [
            'title' => $kelas->nama_matkul . ' - Paket Recording',
            'description' => 'Video pembelajaran...',
            'price' => 25000, // Mock price for this part
            'image' => 'https://placehold.co/100x100/333/fff?text=Rec'
        ];
        $item2 = [
            'title' => 'Paket 1 Meet (Reguler EAS)',
            'description' => 'Kelas offline untuk...',
            'price' => 65000, // Mock price for this part
            'image' => 'https://placehold.co/100x100/555/fff?text=Meet'
        ];

        $subtotal = $item1['price'] + $item2['price'];
        $admin_fee = 2000;
        $discount = 0.50; // 50%
        $total = ($subtotal * (1 - $discount)) + $admin_fee;

        $summary = [
            'items' => [$item1, $item2],
            'subtotal' => $subtotal,
            'discount_percent' => '50%',
            'admin_fee' => $admin_fee,
            'total' => $total,
            'final_price' => $total // This is what we'll save
        ];

        return view('checkoutview', [
            'summary' => $summary,
            'kelas_id' => $id // Pass the class ID to the form
        ]);
    }

    /**
     * Process the payment.
     * This follows the Sequence Diagram: validates user password, then redirects.
     */
    public function processPayment(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'payment_method' => 'required'
        ]);

        // 1. Authenticate the user (as per your sequence diagram)
        $credentials = $request->only('email', 'password');

        // We use Auth::validate() instead of Auth::attempt() so we don't log them in,
        // we just check their password. We assume they are already logged in.
        $user = Auth::user();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
             // Password failed
            Log::warning("Payment failed (password mismatch) for user: " . $request->email);
            return back()->withErrors(['password' => 'Password yang Anda masukkan salah.'])->withInput();
        }

        // 2. Password is correct. Fetch class and summary data again.
        // (In a real app, you'd pass this from a secure session, but for this flow, we recalculate)
        $kelas = Matkul::findOrFail($id);
        $subtotal = 90000; // Mocked subtotal from showCheckout
        $admin_fee = 2000;
        $discount_amount = 45000; // Mocked discount
        $total = 47000; // Mocked total

        // 3. Create the transaction in `beli_matkul` table
        try {
            $pembelian = new BeliMatkul();
            $pembelian->id_matkul = $id;
            $pembelian->id_user = $user->id_user; // Get logged-in user's ID
            $pembelian->cara_pembayaran = $request->payment_method;
            $pembelian->sub_total = $subtotal;
            $pembelian->diskon = $discount_amount;
            $pembelian->biaya_admin = $admin_fee;
            $pembelian->total = $total;
            $pembelian->benefit = 'Akses ' . $kelas->nama_matkul; // Example benefit
            $pembelian->save();

            Log::info("Payment processing SUCCESS for user: " . $user->email . " for class: " . $id . ". New transaction ID: " . $pembelian->id_beli_matkul);

            // 4. Redirect to loading page
            return redirect()->route('pembayaran.loading', ['id' => $id]);

        } catch (\Exception $e) {
            Log::error("Database error during payment: " . $e->getMessage());
            return back()->withErrors(['password' => 'Gagal menyimpan transaksi. Coba lagi.'])->withInput();
        }
    }

    /**
     * Show the loading page.
     * This page will auto-redirect to the success page.
     */
    public function showLoading($id)
    {
        // Redirect to the success page, passing the class ID
        $redirectTo = route('pembayaran.sukses', ['id' => $id]);
        return view('loadingview', ['redirectTo' => $redirectTo]);
    }

    /**
     * Show the "Pembelian Sukses" page.
     * Mockup: bayar sukses.jpg
     */
    public function showSukses($id)
    {
        // Fetch the class data that was just purchased
        $kelas = Matkul::findOrFail($id);

        // Mock data for the card
        $purchased_class_data = [
            'id' => $id,
            'title' => $kelas->nama_matkul,
            'description' => $kelas->deskripsi,
            'image' => 'https://placehold.co/600x400/000/fff?text=' . urlencode($kelas->nama_matkul),
            'rating' => 4.3, // Mock data
            'rating_count' => 16325, // Mock data
            'instructor' => 'Mario', // Mock data
            'instructor_angkatan' => 2023, // Mock data
            'duration' => '3 Bulan' // Mock data
        ];

        return view('suksesview', ['kelas' => $purchased_class_data]);
    }
}
