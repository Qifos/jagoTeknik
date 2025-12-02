<!--
 * Author : Sinta Dewi Rahmawati (NRP 5026231231)
 * Desc   : Landing Page View
-->

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Jago Teknik — Kuliah Teknik Jadi Easy</title>
    <meta name="description"
        content="Platform bimbingan belajar mata kuliah teknik dasar terbaik. Tutor berkualitas, materi terbaru, dan soal HOTS." />

    <!-- Bootstrap 5 + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container py-2">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-0">
                <img src="image/jagoteknik.png" alt="Jago Teknik" class="brand-logo">
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('login.view') }}">Beranda</a></li>
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
                        <a href="{{ route('login.view') }}" class="btn btn-outline-light rounded-pill px-3 py-2">
                            Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- LANDING -->
    <header class="landing-hero pt-9">
        <div class="container position-relative" style="z-index:1;">
            <div class="row align-items-center min-vh-100 pb-5 pb-lg-0">

                <div class="col-lg-6 mt-5 mt-lg-0">
                    <h1 class="display-4 display-title mb-3">
                        Kuliah Teknik<br />Jadi <span class="accent">Easy</span>
                    </h1>
                    <p class="lead pe-lg-5 mb-4">
                        Platform bimbingan belajar mata kuliah Teknik dasar terbaik.
                    </p>
                    <div class="d-grid d-sm-inline-flex gap-3 align-items-center mb-5">
                        <a href="{{ route('register.view') }}" class="btn btn-gradient fw-semibold w-100">
                            Daftar Sekarang
                        </a>
                    </div>

                    <div class="d-flex flex-wrap gap-3">
                        <div class="feature-pill"><i class="bi bi-award"></i><span>Tutor Berkualitas</span></div>
                        <div class="feature-pill"><i class="bi bi-layers"></i><span>Materi Terbaru</span></div>
                        <div class="feature-pill"><i class="bi bi-lightbulb"></i><span>Soal HOTS</span></div>
                    </div>
                </div>

                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="position-relative mx-auto" style="max-width:520px;">
                        <div class="landing-orb">
                            <div class="landing-logo">
                                <div class="logo-j">J</div>
                                <div class="logo-text">ago<br />Teknik</div>
                                <div class="logo-url">jagoteknik.co</div>
                            </div>
                        </div>

                        <div class="landing-orb-image"></div>
                        <div class="landing-stat-card landing-stat-tutor">
                            <img src="/image/01.png" alt="Tutor" />
                        </div>
                        <div class="landing-stat-card landing-stat-kelas">
                            <img src="/image/02.png" alt="Tutor" />
                        </div>
                        <div class="landing-stat-card landing-stat-video">
                            <img src="/image/03.png" alt="Tutor" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- INTRO: Apa itu Jago Teknik? -->
        <section id="apa-jagoteknik" class="py-5">
            <div class="container text-center">
                <h1 class="fw-bold mb-3" style="letter-spacing:.2px;">
                    Apa itu <span class="layout">Jago Teknik?</span>
                </h1>
                <p class="mx-auto desc-text" style="max-width:900px">
                    Jago Teknik adalah platform bimbingan belajar mata kuliah Teknik dasar,
                    dengan lebih dari 300 member serta 300+ sesi belajar selama periode semester 2023/2024.
                    Belajar fleksibel dan komprehensif, <strong>#KuliahTeknikJadiEasy</strong>
                </p>
            </div>
            <div class="container">

                <div class="row g-2">
                    <div class="col-12 col-lg-6">
                        <div class="image-card border rounded-4 shadow-sm">
                            <img src="{{ asset('image/landing-apa1.jpg') }}" alt="Masuk sebagai Mentor"
                                class="img-fluid w-100 d-block rounded-4" loading="lazy" style="height:auto;" />
                            <div class="image-overlay-gradient"></div>
                            <div class="image-overlay-center">
                                <h3 class="text-white mb-3">Untuk Mentor</h3>
                                <a href="{{ route('login.view', ['as' => 'mentor']) }}"
                                    class="btn btn-outline-light rounded-pill px-4 py-2 stretched-link"
                                    aria-label="Login sebagai Mentor">
                                    Masuk Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="image-card border rounded-4">
                            <img src="{{ asset('image/landing-apa2.jpg') }}" alt="Masuk sebagai Murid"
                                class="img-fluid w-100 d-block rounded-4" loading="lazy" style="height:auto;" />
                            <div class="image-overlay-gradient"></div>

                            <div class="image-overlay-center">
                                <h3 class="text-white mb-3">Untuk Murid</h3>
                                <a href="{{ route('login.view', ['as' => 'murid']) }}"
                                    class="btn btn-murid rounded-pill px-4 py-2 stretched-link"
                                    aria-label="Login sebagai Murid">
                                    Masuk Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- MILESTONE SECTION -->
        <section id="milestone" class="py-5 mt-4 mb-5">
            <div class="container text-center">
                <h6 class="milestone-title mb-4">Milestone Kami</h6>
                <div class="row justify-content-center g-4">
                    <!-- Item 1 -->
                    <div class="col-6 col-md-3">
                        <h2 class="milestone-value">300+</h2>
                        <p class="milestone-label">Mahasiswa<br>Aktif</p>
                    </div>
                    <!-- Item 2 -->
                    <div class="col-6 col-md-3">
                        <h2 class="milestone-value">100+</h2>
                        <p class="milestone-label">Mata<br>Kuliah</p>
                    </div>
                    <!-- Item 3 -->
                    <div class="col-6 col-md-3">
                        <h2 class="milestone-value">70+</h2>
                        <p class="milestone-label">Tutor<br>Terbaik</p>
                    </div>
                    <!-- Item 4 -->
                    <div class="col-6 col-md-3">
                        <h2 class="milestone-value">7</h2>
                        <p class="milestone-label">Tahun<br>Pengalaman</p>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="feature-section text-center mb-5">
                <p class="feature-toptext">Bingung Pelajaran Teknik Bikin Susah?</p>
                <h3 class="feature-maintext">Belajar Teknik Jadi Lebih Mudah!</h3>
            </div>
            <div class="container feature-cards">
                <div class="row g-4">
                    <!-- Card 1 -->
                    <div class="col-12 col-md-4">
                        <div class="feature-card">
                            <div class="feature-head">
                                <img src="image/lpcard1.png" alt="icon" clas="feature-icon">
                                <h3 class="feature-title">Dimana saja, kapan saja</h3>
                            </div>
                            <p class="feature-desc">
                                Buka materi, kerjakan soal, dan chat tutor dimanapun kamu berada
                            </p>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="col-12 col-md-4">
                        <div class="feature-card">
                            <div class="feature-head">
                                <img src="image/lpcard2.png" alt="icon" clas="feature-icon">
                                <h3 class="feature-title">Materi terupdate kurikulum terbaru</h3>
                            </div>
                            <p class="feature-desc">
                                Pelajari materi dari kurikulum terbaru, tidak perlu tertinggal lagi
                            </p>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="col-12 col-md-4">
                        <div class="feature-card">
                            <div class="feature-head">
                                <img src="image/lpcard2.png" alt="icon" clas="feature-icon">
                                <h3 class="feature-title">Tracking perkembangan</h3>
                            </div>
                            <p class="feature-desc">
                                Monitor perkembanganmu, pilih jadwal yang cocok, hingga ambil mata kuliah yang kamu
                                butuhkan
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="container mt-5">
            <p class="text-left mb-1">Jelajahi Kelas</p>
            <h2 class="text-left feature-maintext mb-4 mt-1">Kelas Paling Populer</h2>
            <div class="row">
                <div class="col-12 col-md-4 position-relative">
                    <a href="{{ route('login.view') }}" class="d-block">
                        <img src="image/lpkelas1.png" alt="Kelas 1" class="img-fluid feature-class"
                            style="border-radius: 12px; transition: transform 0.3s ease;">
                    </a>
                </div>
                <div class="col-12 col-md-4 position-relative">
                    <a href="{{ route('login.view') }}" class="d-block">
                        <img src="image/lpkelas2.png" alt="Kelas 2" class="img-fluid feature-class"
                            style="border-radius: 12px; transition: transform 0.3s ease;">
                    </a>
                </div>
                <div class="col-12 col-md-4 position-relative">
                    <a href="{{ route('login.view') }}" class="d-block">
                        <img src="image/lpkelas3.png" alt="Kelas 3" class="img-fluid feature-class"
                            style="border-radius: 12px; transition: transform 0.3s ease;">
                    </a>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('login.view') }}" class="btn btn-outline-light px-5 py-2"
                    style="position: relative;">
                    Lihat Lebih Banyak Kelas</a>
            </div>
        </section>

        <!-- JAGO NEWS SECTION -->
        <section class="container mt-5">
            <h2 class="text-left feature-maintext mb-4">Jago News</h2>
            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="news-card">
                                <div class="news-card-content">
                                    <img src="image/jnews1.png" alt="News 1" class="news-card-img-vertical" />
                                    <div class="news-content">
                                        <p class="news-date">November 16, 2024</p>
                                        <h3 class="news-title">EAS Makin Dekat, Sudah Siap?</h3>
                                        <p class="news-desc">Halo sobat Jago Teknik, tak terasa EAS sudah semakin
                                            dekat, tinggal 2 minggu la...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="news-card">
                                <div class="news-card-content">
                                    <img src="image/jnews2.png" alt="News 2" class="news-card-img-vertical" />
                                    <div class="news-content">
                                        <p class="news-date">September 24, 2024</p>
                                        <h3 class="news-title">Cara Menghafal Rumus Cepat</h3>
                                        <p class="news-desc">Menghafal rumus pastinya sangat susah bagi kebanyakan
                                            orang, tapi bagaimana jika aku beri...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="news-card">
                        <div class="news-card-content-vertical">
                            <img src="image/jnews3.png" alt="News 3" class="news-card-img" />
                            <div class="news-content">
                                <p class="news-date mt-4">March 13, 2024</p>
                                <h3 class="news-title">Jago Teknik Gratis?</h3>
                                <p class="news-desc">Ada info terbaru nih, dengar dengar jago teknik sekarang bakal
                                    jadi gratis! Eitss, tapi ada syaratnya...</p>
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
                <div class="col-md-2 text-md-left">
                    <div class="footer-logo">
                        <img src="image/jagoteknik.png" alt="Jago Teknik Logo" class="footer-logo-img" />
                        <p class="footer-tagline mt-2">Kuliah Teknik Jadi Easy</p>
                    </div>
                </div>
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
                    <div class="col-12 col-md-6 text-md-left">
                        <p class="mb-0" style="text-align: left">© <span id="year"></span> Jago Teknik. All
                            rights reserved.</p>
                    </div>
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
    <script>
        document.getElementById('y').textContent = new Date().getFullYear();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
