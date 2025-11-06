<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jago Teknik</title>
    <!-- Bootstrap CSS (required) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- App CSS (custom theme) -->
    {{-- This link points to the route in web.php --}}
    <link rel="stylesheet" href="\public\footer.css">
    <link rel="stylesheet" href="\public\kelas.css">
    <link rel="stylesheet" href="\public\materi.css">
    <link rel="stylesheet" href="\public\video.css">
    <link rel="stylesheet" href="\public\navbar.css">
    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&display=swap" rel="stylesheet">
</head>
<body class="min-vh-100">
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
                            <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kelas.index') }}">Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Jadwal</a>
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

    {{-- The main content area --}}
    @yield('content')

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
                <!-- Add social icons here if needed -->
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Alpine.js for small interactions -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>

