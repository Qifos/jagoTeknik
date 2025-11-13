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
                        <a class="nav-link" href="{{ route('kelas.index') }}">Kelas</a>
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
                        <div class="course-image" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
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
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
