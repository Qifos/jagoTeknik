<!--
 * Author : Sinta Dewi Rahmawati (NRP 5026231231)
 * Desc   : HomePage View
-->

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JagoTeknik - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="css/personalisasi.css">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

</head>

<body>
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
                        <a class="nav-link active" href="{{route('homepage')}}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kelas.semua') }}">Kelas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jadwal.index') }}">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chat.index') }}">Chat</a>
                    </li>
                    <li class="nav-item">
                        <form class="d-flex mx-3">
                            <div class="search-box">
                                <input class="form-control" type="search" placeholder="Cari di JagoTeknik">
                                <i class="bi bi-search"></i>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('personalisasi.view') }}">
                            <img src="profile.jpg" alt="Profile" class="profile-img">
                            <span class="ms-2">Profil</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero position-relative">
        <div class="hero__orbit"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center">
                <!-- Left: judul & subjudul -->
                <div class="col-lg-6">
                    <h1 class="hero__title">Halo <span class="accent">{{ Auth::user()->username }}</span>!</h1>
                    <p class="hero__subtitle fs-5">Mau belajar apa hari ini?</p>
                    <h2 class="section-title mb-0">Kelas yang akan datang</h2>
                </div>

                <!-- Kanan: dua bubble kecil -->
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="bubbles">
                        <div class="bubble">
                            <div class="bubble__ring">
                                <div class="bubble__icon"><i class="bi bi-clock"></i></div>
                            </div>
                            <div class="bubble__label">
                                <div class="bubble__title">Fisika 1</div>
                                <div class="bubble__time">11:00 – 13:00</div>
                            </div>
                        </div>

                        <div class="bubble">
                            <div class="bubble__ring">
                                <span class="bubble__dot"></span>
                                <div class="bubble__icon"><i class="bi bi-book"></i></div>
                            </div>
                            <div class="bubble__label">
                                <div class="bubble__title">Kalkulus 2</div>
                                <div class="bubble__time">14:00 – 16:00</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Section -->
    <section class="py-5 section-courses">
        <div class="container">
            <h2 class="section-title">Jelajahi kelas kamu</h2>
            <div class="row g-4">
                <!-- Courses List -->
                <div class="col-md-4">
                    <div class="course-card">
                        <div class="course-image">
                            <i class="bi bi-calculator" style="color: #fff;"></i>
                        </div>
                        <div class="course-body">
                            <span class="course-badge">Teori</span>
                            <h4>Matematika Dasar</h4>
                            <p class="text-muted">Pelajari konsep dasar matematika</p>
                        </div>
                    </div>
                </div>
                <!-- More courses here... -->
            </div>

            <h2 class="section-title">Lihat lebih banyak</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="course-card">
                        <div class="course-image"
                            style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                            <i class="bi bi-cloud" style="color: #fff;"></i>
                        </div>
                        <div class="course-body">
                            <span class="course-badge">Praktik</span>
                            <h4>Termodinamika</h4>
                            <p class="text-muted">Studi tentang energi dan panas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Menampilkan Pesan Sukses -->
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <section class="container mt-5">
        <h2 class="text-left feature-maintext mb-4">Jago News</h2>
        <div class="row g-4">
            <!-- Left side container (two cards horizontally aligned) -->
            <div class="col-12 col-md-6">
                <div class="row g-4">
                    <!-- News Card 1 -->
                    <div class="col-12">
                        <div class="news-card">
                            <div class="news-card-content">
                                <img src="image/jnews1.png" alt="News 1" class="news-card-img-vertical" />
                                <div class="news-content">
                                    <p class="news-date">November 16, 2024</p>
                                    <h3 class="news-title">EAS Makin Dekat, Sudah Siap?</h3>
                                    <p class="news-desc">Halo sobat Jago Teknik, tak terasa EAS sudah semakin dekat,
                                        tinggal 2 minggu la...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- News Card 2 -->
                    <div class="col-12">
                        <div class="news-card">
                            <div class="news-card-content">
                                <img src="image/jnews2.png" alt="News 2" class="news-card-img-vertical" />
                                <div class="news-content">
                                    <p class="news-date">September 24, 2024</p>
                                    <h3 class="news-title">Cara Menghafal Rumus Cepat</h3>
                                    <p class="news-desc">Menghafal rumus pastinya sangat susah bagi kebanyakan orang,
                                        tapi bagaimana jika aku beri...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side container (one card) -->
            <div class="col-12 col-md-6">
                <div class="news-card">
                    <div class="news-card-content-vertical">
                        <img src="image/jnews3.png" alt="News 3" class="news-card-img" />
                        <div class="news-content">
                            <p class="news-date mt-4">March 13, 2024</p>
                            <h3 class="news-title">Jago Teknik Gratis?</h3>
                            <p class="news-desc">Ada info terbaru nih, dengar dengar jago teknik sekarang bakal jadi
                                gratis! Eitss, tapi ada syaratnya...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </header>

    <!-- FOOTER -->
    <footer class="py-5 border-top border-opacity-25" style="border-color:var(--border)!important;">
        <div class="container text-left text-white">
            <div class="row align-items-left">

                <!-- Jago Teknik Logo and Tagline (Left side) -->
                <div class="col-md-2 text-md-left">
                    <div class="footer-logo">
                        <img src="image/jagoteknik.png" alt="Jago Teknik Logo" class="footer-logo-img" />
                        <p class="footer-tagline mt-2">Kuliah Teknik Jadi Easy</p>
                    </div>
                </div>

                <!-- Jurusan, Ikuti Kami, Legal, Kontak Kami (Horizontal Row) -->
                <div class="col-md-10">
                    <div class="row text-md-left">
                        <!-- Jurusan Section -->
                        <div class="col-md-3">
                            <ul class="list-unstyled">
                                <li>Jurusan</li>
                                <li>Umum</li>
                                <li>Teknik</li>
                                <li>Vokasi</li>
                            </ul>
                        </div>

                        <!-- Ikuti Kami Section -->
                        <div class="col-md-3">
                            <ul class="list-unstyled">
                                <li>Ikuti Kami</li>
                                <li>X</li>
                                <li>Instagram</li>
                                <li>LinkedIn</li>
                                <li>YouTube</li>
                            </ul>
                        </div>

                        <!-- Legal Section -->
                        <div class="col-md-3">
                            <ul class="list-unstyled">
                                <li>Legal</li>
                                <li>Terms</li>
                                <li>Privacy</li>
                                <li>Cookies</li>
                                <li>Contact</li>
                            </ul>
                        </div>

                        <!-- Kontak Kami Section -->
                        <div class="col-md-3">
                            <ul class="list-unstyled">
                                <li>Kontak Kami</li>
                                <li>081234567890</li>
                                <li>jagoteknikcourse@gmail.com</li>
                                <li>Surabaya, Indonesia 60111</li>
                                <li>News</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="container mt-4">
                <div class="row d-flex align-items-center justify-content-between">

                    <!-- Left side: Copyright Text -->
                    <div class="col-12 col-md-6 text-md-left">
                        <p class="mb-0" style="text-align: left">© <span id="year"></span> Jago Teknik. All
                            rights reserved.</p>
                    </div>

                    <!-- Right side: Social Media Icons -->
                    <div class="col-12 col-md-6 text-md-right">
                        <div class="social-icons">
                            <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-github"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-globe"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
