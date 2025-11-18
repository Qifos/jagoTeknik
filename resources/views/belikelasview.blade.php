<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jago Teknik - Beli {{ $kelas->nama_matkul }}</title>

    <!-- CSS Links -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pembayaran.css') }}">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
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
            <div class="beli-header">
                <a href="#" onclick="if(history.length > 1) { history.back(); return false; } else { window.location = '{{ route('kelas.index') }}'; }" class="back-btn">&lt; Back</a>
                <h1 class="title-hero mt-3">{{ $kelas->nama_matkul }}</h1>
            </div>

            <div class="row g-4 g-lg-5">
                <!-- Left Column -->
                <div class="col-lg-7">
                    <div class="beli-hero-image mb-4">
                        <img src="https://placehold.co/800x450/000/fff?text={{ urlencode($kelas->nama_matkul) }}" alt="{{ $kelas->nama_matkul }}">
                        <div class="hero-title-overlay">{{ $kelas->nama_matkul }}</div>
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
                            <p>{{ $kelas->deskripsi }}</p>
                        </div>
                        <!-- Rating Tab -->
                        <div class="tab-pane fade" id="nav-rating" role="tabpanel" aria-labelledby="nav-rating-tab">
                            <h4 class="fw-bold">Rating: 4.5/5 (1,234 reviews)</h4>
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
                        <img src="https://placehold.co/600x400/000/fff?text={{ urlencode($kelas->nama_matkul) }}" class="img-fluid sidebar-image" alt="{{ $kelas->nama_matkul }}">

                        <div class="d-flex align-items-center gap-3 mb-2">
                            <!-- Mock prices, replace with DB data if available -->
                            <span class="price-lg">Rp.45k</span>
                            <span class="price-sm-strike">Rp.90k</span>
                            <span class="price-discount">50% Off</span>
                        </div>
                        <p class="promo-text mb-3">11 jam tersisa untuk promo ini!</p>

                        <a href="{{ route('pembayaran.checkout', ['id' => $kelas->id_matkul]) }}" class="btn btn-beli">
                            Beli sekarang
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
