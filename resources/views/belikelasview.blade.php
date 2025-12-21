<!--
 * Author : Faiz Hazmi Maulana (NRP 502623120)
 * Desc   : semuaKelas
 * Date   : 2025-11-30
-->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jago Teknik - Beli {{ $kelas->nama_matkul }}</title>

    <!-- CSS Links -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Samakan navbar & style dengan Homepage -->
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/personalisasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/belikelas.css') }}">
</head>
<body class="min-vh-100 d-flex flex-column">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand ms-2 ms-lg-3" href="#">
                <img src="image/jagoteknik.png" alt="Jago Teknik" class="brand-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('homepage') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kelas.semua') }}">Kelas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('jadwal.index') }}">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chat.index') }}">Chat</a>
                    </li>
                    <li class="nav-item d-none d-lg-block">
                        <form class="d-flex" role="search" onsubmit="return false;">
                            <div class="input-group">
                                <input class="form-control border-start-1" type="search"
                                    placeholder="Cari di JagoTeknik" aria-label="Cari" />
                                <span class="input-group-text bg-transparent border-end-0 text-secondary"><i
                                    class="bi bi-search"></i></span>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('personalisasi.view') }}">
                            <img src="{{ asset('image/profile.jpg') }}" alt="Profile" class="profile-img">
                            <span class="ms-2">Profil</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        <div class="container-fluid px-lg-5 py-4">
            <div class="beli-header">
                <a href="#" onclick="if(history.length > 1) { history.back(); return false; } else { window.location = '{{ route('kelas.semua') }}'; }" class="back-btn">&lt; Back</a>
                <h1 class="title-hero mt-3">{{ $kelas->nama_matkul }}</h1>
            </div>

            <div class="row g-4 g-lg-5">
                <!-- Left Column -->
        <div class="col-lg-7">
            <div class="beli-hero-image mb-4">
                <img src="{{ $kelas->image_path ? asset($kelas->image_path) : asset('images/kelas/default.jpg') }}"
                    alt="{{ $kelas->nama_matkul }}"
                    onerror="this.src='{{ asset('images/kelas/default.jpg') }}'">
            </div>

            <nav class="class-tabs mb-3">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-overview-tab" data-bs-toggle="tab" data-bs-target="#nav-overview" type="button" role="tab" aria-controls="nav-overview" aria-selected="true">Overview</button>
                    <button class="nav-link" id="nav-rating-tab" data-bs-toggle="tab" data-bs-target="#nav-rating" type="button" role="tab" aria-controls="nav-rating" aria-selected="false">Rating</button>
                    <button class="nav-link" id="nav-benefit-tab" data-bs-toggle="tab" data-bs-target="#nav-benefit" type="button" role="tab" aria-controls="nav-benefit" aria-selected="false">Benefit</button>
                </div>
            </nav>

            <div class="tab-content py-3" id="nav-tabContent">
                <!-- Overview Tab -->
                <div class="tab-pane fade show active" id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
                    <p>{{ $kelas->deskripsi ?? $kelas->deskripsi_kelas ?? 'Deskripsi kelas tidak tersedia.' }}</p>
                </div>

                <!-- Rating Tab -->
                <div class="tab-pane fade" id="nav-rating" role="tabpanel" aria-labelledby="nav-rating-tab">
                    <h4 class="fw-bold">Rating: {{ $kelas->rating_kelas ?? '4.5' }}/5 (1,234 reviews)</h4>
                    <div class="rating-bar">
                        <span>5 stars</span>
                        <div class="progress"><div class="progress-bar" style="width: 70%"></div></div>
                        <span>70%</span>
                    </div>
                    <div class="rating-bar">
                        <span>4 stars</span>
                        <div class="progress"><div class="progress-bar" style="width: 20%"></div></div>
                        <span>20%</span>
                    </div>
                    <div class="rating-bar">
                        <span>3 stars</span>
                        <div class="progress"><div class="progress-bar" style="width: 5%"></div></div>
                        <span>5%</span>
                    </div>
                    <div class="rating-bar">
                        <span>2 stars</span>
                        <div class="progress"><div class="progress-bar" style="width: 3%"></div></div>
                        <span>3%</span>
                    </div>
                    <div class="rating-bar">
                        <span>1 star</span>
                        <div class="progress"><div class="progress-bar" style="width: 2%"></div></div>
                        <span>2%</span>
                    </div>
                </div>

                <!-- Benefit Tab -->
                <div class="tab-pane fade" id="nav-benefit" role="tabpanel" aria-labelledby="nav-benefit-tab">
                    <ul class="benefit-list">
                        @foreach($benefits as $benefit)
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg>
                            <span>{{ $benefit }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="col-lg-5">
            <div class="beli-sidebar">
                <img src="{{ $kelas->image_path ? asset($kelas->image_path) : asset('images/kelas/default.jpg') }}"
                    alt="{{ $kelas->nama_matkul }}"
                    class="sidebar-image"
                    onerror="this.src='{{ asset('images/kelas/default.jpg') }}'">

                <div class="d-flex align-items-center gap-3 mb-2">
                    <span class="price-lg">Rp {{ number_format($harga, 0, ',', '.') }}</span>
                </div>
                <p class="promo-text mb-3">Harga khusus untuk Anda!</p>

                <!-- Tombol Beli Sekarang -->
                <a href="{{ route('pembayaran.checkout', ['id' => $kelas->id_matkul]) }}" class="btn btn-beli">
                    Beli sekarang - Rp {{ number_format($harga, 0, ',', '.') }}
                </a>

                <h5 class="mt-4 mb-3">Anda Ini Akan Mendapatkan</h5>
                <ul class="benefit-list">
                    @foreach($benefits as $benefit)
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16"><path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.893zM16 1.828c-1.13-.124-2.258-.063-3.112.752v9.746c.935-.53 2.12-.603 3.213-.493 1.18.12 2.37.461 3.287.893zM15 2.828c-.885-.37-2.154-.769-3.388-.893-1.33-.134-2.458.063-3.112.752v9.746c.935-.53 2.12-.603 3.213-.493 1.18.12 2.37.461 3.287.893z"/></svg>
                        <span>{{ $benefit }}</span>
                    </li>
                    @endforeach
                </ul>

                <hr class="my-4">

                <h5 class="mb-3 text-center">Bagikan Kelas Ini</h5>
                <div class="share-icons">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-telegram"></i></a>
                    <a href="#"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </main>

   <!-- Footer -->
    <footer class="footer-custom">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-mortarboard-fill me-2" style="font-size: 1.5rem; color: var(--primary-purple);"></i>
                        <span class="fw-bold fs-5">Jago Teknik</span>
                    </div>
                    <p class="text-muted">Kuliah Teknik Jadi Easy</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold mb-3">Jurusan</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="footer-link">Umum</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Teknik</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Vokasi</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold mb-3">Ikuti Kami</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="footer-link">X</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Instagram</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">LinkedIn</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">YouTube</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold mb-3">Legal</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="footer-link">Terms</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Privacy</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Cookies</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h6 class="fw-bold mb-3">Kontak Kami</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2 text-muted">081234567890</li>
                        <li class="mb-2"><a href="mailto:jagoteknikcourse@gmail.com" class="footer-link">jagoteknikcourse@gmail.com</a></li>
                        <li class="mb-2 text-muted">Surabaya, Indonesia 60111</li>
                        <li class="mb-2"><a href="#" class="footer-link">News</a></li>
                    </ul>
                </div>
            </div>
            <hr style="border-color: rgba(255, 255, 255, 0.1);">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-muted mb-0">&copy; 2025 Jago Teknik</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#" class="social-icon me-3"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="social-icon me-3"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="social-icon me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon me-3"><i class="bi bi-github"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-dribbble"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Alpine.js for small interactions -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
