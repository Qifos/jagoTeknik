<!--
 * Author : Muhammad Fiqih Soetam Putra (NRP 5026231096)
 * File   : resources/views/checkoutview.blade.php
 * Desc   : view untuk halaman checkout pembayaran kelas
 * Date   : 25-11-2025
-->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jago Teknik - Checkout</title>

    <!-- CSS Links -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pembayaran.css') }}">

    <!-- Alpine.js for component state -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="checkout-body">

    <main class="container-fluid px-lg-5 py-4">
        <div class="mb-4">
            <a href="#" onclick="if(history.length > 1) { history.back(); return false; } else { window.location = '{{ route('kelas.index') }}'; }" class="back-btn">&lt; Back</a>
        </div>

        <div class="row g-5">
            <!-- Left Side: Form -->
            <div class="col-lg-7">
                <h1 class="display-5 title-hero mb-4">Checkout</h1>
                <p class="text-muted mb-4">Kelas: <strong>{{ $kelas->nama_matkul }}</strong></p>

                <form class="checkout-form" method="POST" action="{{ route('pembayaran.process', ['id' => $kelas_id]) }}" x-data="{ paymentMethod: 'bca' }">
                    @csrf

                    <h5 class="mb-3">Cara Pembayaran</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-4">
                            <div class="payment-method-card d-flex align-items-center justify-content-center"
                                 :class="{ 'active': paymentMethod === 'ewallet' }"
                                 @click="paymentMethod = 'ewallet'">
                                <img src="https://placehold.co/100x40/333/fff?text=E-Wallet" alt="E-Wallet">
                                <input type="radio" name="payment_method" value="ewallet" x-model="paymentMethod" class="d-none">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="payment-method-card d-flex align-items-center justify-content-center"
                                 :class="{ 'active': paymentMethod === 'bca' }"
                                 @click="paymentMethod = 'bca'">
                                <img src="https://placehold.co/100x40/003366/fff?text=BCA" alt="BCA">
                                <input type="radio" name="payment_method" value="bca" x-model="paymentMethod" class="d-none" checked>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="payment-method-card d-flex align-items-center justify-content-center"
                                 :class="{ 'active': paymentMethod === 'wallet' }"
                                 @click="paymentMethod = 'wallet'">
                                <img src="https://placehold.co/100x40/005599/fff?text=Wallet" alt="Wallet">
                                <input type="radio" name="payment_method" value="wallet" x-model="paymentMethod" class="d-none">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ auth()->user()->email ?? old('email') }}" required>
                        @error('email')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        @error('password')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" value="" id="simpanInfo">
                        <label class="form-check-label" for="simpanInfo">
                            Simpan informasi saya untuk kedepannya
                        </label>
                    </div>

                    <button type="submit" class="btn btn-konfirmasi">Konfirmasi Pembayaran</button>
                </form>
            </div>

            <!-- Right Side: Summary -->
            <div class="col-lg-5">
                <h5 class="my-3 my-lg-0 fw-bold">Ringkasan</h5>
                <div class="summary-card">
                    @foreach($summary['items'] as $item)
                    <div class="summary-item">
                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                        <div>
                            <div class="item-title">{{ $item['title'] }}</div>
                            <p class="item-desc mb-2">{{ $item['description'] }}</p>
                        </div>
                        <div class="item-price">Rp. {{ number_format($item['price'], 0, ',', '.') }}</div>
                    </div>
                    @endforeach

                    <div class="summary-total">
                        <div class="total-row">
                            <span>Subtotal</span>
                            <strong>Rp. {{ number_format($summary['subtotal'], 0, ',', '.') }}</strong>
                        </div>
                        <div class="total-row">
                            <span>Kupon Diskon</span>
                            <strong>{{ $summary['discount_percent'] }}</strong>
                        </div>
                        <div class="total-row">
                            <span>Biaya Admin</span>
                            <strong>Rp. {{ number_format($summary['admin_fee'], 0, ',', '.') }}</strong>
                        </div>
                        <hr class="border-secondary">
                        <div class="total-row grand-total">
                            <span>Total</span>
                            <strong>Rp. {{ number_format($summary['total'], 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
