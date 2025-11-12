<!--
 * Author : Faiz Hazmi Maulana (NRP 502623120)
 * Desc   : semuaKelas
 * Date   : 2025-11-12
-->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas Jago Teknik</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/kelas-style.css">
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
                        <a class="nav-link" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('kelas.index') }}">Kelas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Chat</a>
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
                        <a class="nav-link d-flex align-items-center" href="#">
                            <img src="profile.jpg" alt="Profile" class="profile-img">
                            <span class="ms-2">Profil</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <section class="main-section">
        <div class="container py-4">
            <!-- Back Button -->
            <button class="btn btn-back mb-4">
                <i class="bi bi-chevron-left"></i> Back
            </button>

            <!-- Page Title -->
            <h1 class="page-title mb-4 text-center">Kelas Jago Teknik</h1>

            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs custom-tabs justify-content-center mb-4" id="kelasTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="semua-tab" data-bs-toggle="tab"
                            data-bs-target="#semua" type="button" role="tab">
                        Semua
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="diikuti-tab" data-bs-toggle="tab"
                            data-bs-target="#diikuti" type="button" role="tab">
                        Di Ikuti
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="selesai-tab" data-bs-toggle="tab"
                            data-bs-target="#selesai" type="button" role="tab">
                        Selesai
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="wishlist-tab" data-bs-toggle="tab"
                            data-bs-target="#wishlist" type="button" role="tab">
                        Wishlist
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="kelasTabContent">
                <div class="tab-pane fade show active" id="semua" role="tabpanel">
                    <!-- Section Title -->
                    <div class="section-header mb-3">
                        <h2 class="section-title">Semua kelas</h2>
                        <p class="section-subtitle">Lihat semua kelas yang ada di jagoteknik</p>
                    </div>

                    <!-- Course Cards Grid -->
                    <div class="row g-4">
                        <!-- Card 1 - Kalkulus 2 -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="course-card">
                                <div class="course-image">
                                    <img src="kalkulus2.jpg" alt="Kalkulus 2">
                                    <div class="course-badge">
                                        <i class="bi bi-play-circle-fill"></i>
                                    </div>
                                </div>
                                <div class="course-info">
                                    <h3 class="course-title">Kalkulus 2</h3>
                                    <p class="course-progress">Lesson 5 of 7</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 - Fisika -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="course-card">
                                <div class="course-image">
                                    <img src="fisika.jpg" alt="Fisika">
                                    <div class="course-badge">
                                        <i class="bi bi-play-circle-fill"></i>
                                    </div>
                                </div>
                                <div class="course-info">
                                    <h3 class="course-title">Fisika</h3>
                                    <p class="course-progress">Lesson 5 of 7</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 - Kimia -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="course-card">
                                <div class="course-image">
                                    <img src="kimia.jpg" alt="Kimia">
                                    <div class="course-badge completed">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                </div>
                                <div class="course-info">
                                    <h3 class="course-title">Kimia</h3>
                                    <p class="course-progress">Daftar kelas ini</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 - Pemrograman -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="course-card">
                                <div class="course-image">
                                    <img src="pemrograman.jpg" alt="Pemrograman">
                                    <div class="course-badge add">
                                        <i class="bi bi-plus-circle-fill"></i>
                                    </div>
                                </div>
                                <div class="course-info">
                                    <h3 class="course-title">Pemrograman</h3>
                                    <p class="course-progress">Lesson 5 of 7</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 5 - Database -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="course-card">
                                <div class="course-image">
                                    <img src="database.jpg" alt="Database">
                                    <div class="course-badge">
                                        <i class="bi bi-play-circle-fill"></i>
                                    </div>
                                </div>
                                <div class="course-info">
                                    <h3 class="course-title">Database</h3>
                                    <p class="course-progress">Lesson 5 of 7</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 6 - Sistem Elektrik -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="course-card">
                                <div class="course-image">
                                    <img src="elektrik.jpg" alt="Sistem Elektrik">
                                    <div class="course-badge">
                                        <i class="bi bi-play-circle-fill"></i>
                                    </div>
                                </div>
                                <div class="course-info">
                                    <h3 class="course-title">Sistem Elektrik</h3>
                                    <p class="course-progress">Daftar kelas ini</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 7 - Jaringan Komputer -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="course-card">
                                <div class="course-image">
                                    <img src="jaringan.jpg" alt="Jaringan Komputer">
                                    <div class="course-badge completed">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                </div>
                                <div class="course-info">
                                    <h3 class="course-title">Jaringan Komputer</h3>
                                    <p class="course-progress">Completed</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 8 - Biologi -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="course-card">
                                <div class="course-image">
                                    <img src="biologi.jpg" alt="Biologi">
                                    <div class="course-badge add">
                                        <i class="bi bi-plus-circle-fill"></i>
                                    </div>
                                </div>
                                <div class="course-info">
                                    <h3 class="course-title">Biologi</h3>
                                    <p class="course-progress">Daftar kelas ini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="diikuti" role="tabpanel">
                    <p class="text-white">Konten kelas yang sedang diikuti akan ditampilkan di sini.</p>
                </div>

                <div class="tab-pane fade" id="selesai" role="tabpanel">
                    <p class="text-white">Konten kelas yang sudah selesai akan ditampilkan di sini.</p>
                </div>

                <div class="tab-pane fade" id="wishlist" role="tabpanel">
                    <p class="text-white">Konten wishlist akan ditampilkan di sini.</p>
                </div>
            </div>
        </div>
    </section>
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
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
