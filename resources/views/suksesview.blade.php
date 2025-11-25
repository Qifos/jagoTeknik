<!--
 * Author : Muhammad Fiqih Soetam Putra (NRP 5026231096)
 * File   : resources/views/suksesview.blade.php
 * Desc   : view untuk halaman sukses checkout pembayaran kelas
 * Date   : 25-11-2025
-->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jago Teknik - Pembelian Berhasil</title>

    <!-- CSS Links -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pembayaran.css') }}">
</head>
<body class="min-vh-100 d-flex flex-column">
    <header class="bg-transparent">
        <nav class="navbar navbar-expand-lg navbar-jagoteknik">
            <div class="container-fluid">
                <!-- Left Side -->
                <a class="navbar-brand d-flex align-items-center" href="{{ route('landing') }}">
                    <span class="footer-logo me-2">J</span>
                    Jago Teknik
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('homepage') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('kelas.index') }}">Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jadwal.index') }}">Jadwal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Chat</a>
                        </li>
                    </ul>

                    <!-- Right Side -->
                    <div class="d-flex align-items-center gap-3">
                        <form class="d-flex" role="search">
                            <input class="form-control search-input" type="search" placeholder="Cari di Jago Teknik" aria-label="Search">
                        </form>
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none gap-2">
                            <img src="https://placehold.co/40x40/6b2fa0/white?text=A" alt="Profil" class="profile-img">
                            <span class="d-none d-lg-inline">Profil</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow-1">
        <div class="container-fluid px-lg-5 py-4">
            <div class="mb-3">
                <a href="{{ route('kelas.index') }}" class="back-btn">&lt; Back to Kelas</a>
            </div>

            <header class="text-center">
                <h1 class="display-4 title-hero">Pembelian Kelas Berhasil!</h1>
            </header>

            <div style="height: 30px;"></div>

            <div class="row g-4 justify-content-center">
                <div class="col-lg-7">
                    <img src="{{ $kelas['image'] }}" class="img-fluid beli-container class-image" alt="{{ $kelas['title'] }}">
                </div>

                <div class="col-lg-5">
                    <div class="sukses-card h-100">
                        <img src="{{ $kelas['image'] }}" class="card-img-top mb-3" alt="{{ $kelas['title'] }}">
                        <div class="card-body px-1">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="small-pill" style="background-color: rgba(0,0,0,0.2);">Pemrograman</span>
                                <span class="small text-muted">{{ $kelas['duration'] }}</span>
                            </div>
                            <h3 class="card-title mt-2">{{ $kelas['title'] }}</h3>
                            <p class="card-desc">{{ $kelas['description'] }}</p>

                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span class="rating fw-bold">{{ $kelas['rating'] }}</span>
                                <!-- Add stars here if you have icons -->
                                <span class="text-muted small">({{ $kelas['rating_count'] }})</span>
                            </div>

                            <div class="instructor">
                                <img src="https://placehold.co/24x24/eee/333?text=M" alt="instructor">
                                <span>{{ $kelas['instructor'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('kelas.detail.beli', ['id' => $kelas['id']]) }}" class="btn-sukses">
                    Cek kelas kamu sekarang
                </a>
            </div>

        </div>
    </main>

    <footer class="site-footer">
        <div class="container-fluid px-lg-5">
            <div class="row gy-4">
                <div class="col-lg-3">
                    <a class="navbar-brand d-flex align-items-center" href="#">
                        <span class="footer-logo me-2">J</span>
                        Jago Teknik
                    </a>
                    <p class="mt-2">Kuliah Teknik Jadi Easy</p>
                </div>
                <div class="col-6 col-lg-2">
                    <h5>Jurusan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Umum</a></li>
                        <li><a href="#">Teknik</a></li>
                        <li><a href="#">Vokasi</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h5>Ikuti Kami</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">X</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">LinkedIn</a></li>
                        <li><a href="#">YouTube</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h5>Legal</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Terms</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Cookies</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5>Kontak Kami</h5>
                    <ul class="list-unstyled">
                        <li>081234567890</li>
                        <li>jagoteknikcourse@gmail.com</li>
                        <li>Surabaya, Indonesia 60111</li>
                        <li><a href="#">News</a></li>
                    </ul>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-4 border-top border-secondary-subtle pt-4">
                <p class="mb-0">&copy; 2025 Jago Teknik</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Alpine.js for small interactions -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
