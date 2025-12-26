<!DOCTYPE html>
<!--
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231196)
 * Desc   : Mentor Profile View
-->
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JagoTeknik — Profil Tutor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    {{-- Navbar homepage --}}
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/personalisasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    <style>
        body {
            background: #000;
            color: #fff;
        }

        .wrap {
            padding: 40px 0 64px;
        }

        .back-btn {
            background: #fff;
            color: #111;
            border: 0;
            border-radius: 8px;
            padding: 10px 18px;
            font-weight: 600;
        }

        .hero {
            background: #5f5aa9;
            border-radius: 0;
            padding: 34px 36px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            margin-top: 22px;
        }

        .hero-left {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .avatar {
            width: 84px;
            height: 84px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, .65);
            background: #111;
        }

        .hero-name {
            font-weight: 800;
            font-size: 1.6rem;
            margin: 0;
        }

        .hero-role {
            margin: 4px 0 0;
            opacity: .9;
        }

        .hero-btn {
            background: #e6dbf4;
            color: #5b3a6b;
            border: 0;
            padding: 14px 22px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 260px;
            justify-content: center;
        }

        .hero-btn i {
            font-size: 1.1rem;
        }

        .section-title {
            font-size: 1.7rem;
            font-weight: 800;
            margin: 26px 0 18px;
        }

        .stat-card {
            background: #5f5aa9;
            border: 0;
            padding: 18px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            height: 92px;
        }

        .stat-ico {
            width: 54px;
            height: 54px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5f5aa9;
            font-size: 1.3rem;
        }

        .stat-num {
            font-size: 1.35rem;
            font-weight: 800;
            line-height: 1;
        }

        .stat-label {
            opacity: .9;
            margin-top: 6px;
        }

        .course-card {
            height: 240px;
            background: #3f2a86;
            border: 0;
            display: flex;
            align-items: flex-end;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .course-card:before {
            content: "";
            position: absolute;
            inset: -40px -40px auto auto;
            width: 220px;
            height: 220px;
            background: rgba(255, 255, 255, .13);
            transform: rotate(25deg);
            filter: blur(0.2px);
        }

        .course-title {
            position: relative;
            font-weight: 900;
            letter-spacing: .8px;
            text-transform: uppercase;
            font-size: 1.35rem;
            margin: 0;
        }

        .course-sub {
            position: relative;
            opacity: .85;
            margin-top: 8px;
            font-size: .95rem;
        }

        /* Override: avatar mentor di halaman profile harus bulat (bukan card photo) */
        .hero-left .tutor-photo {
            width: 96px !important;
            height: 96px !important;
            aspect-ratio: 1 / 1 !important;
            border-radius: 50% !important;
            object-fit: cover !important;
            background: #111;
            border: 2px solid rgba(255, 255, 255, .25);
            flex: 0 0 96px;
        }
    </style>
</head>

<body>
    {{-- NAVBAR HOMEPAGE --}}
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('homepage') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('kelas.semua') }}">Kelas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('jadwal.index') }}">Jadwal</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('chat.index') }}">Chat</a></li>
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
                            <img src="{{ asset('image/profile.jpg') }}" alt="Profile" class="profile-img">
                            <span class="ms-2">Profil</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="wrap">
        <div class="container">
            <a href="{{ route('mentor.index') }}" class="btn back-btn">&lt; Back</a>

            <div class="hero">
                <div class="hero-left">
                    <img class="tutor-photo"
                        src="{{ !empty($mentor->image_mentor) ? asset($mentor->image_mentor) : (!empty($mentor->foto_profil) ? $mentor->foto_profil : 'https://i.pravatar.cc/300?img=11') }}"
                        alt="{{ $mentor->nama }}">
                    <div>
                        <p class="hero-name">{{ $mentor->nama }}</p>
                        <p class="hero-role">
                            {{ $mentor->nama_matkul ? 'Asdos ' . $mentor->nama_matkul : 'Tutor' }}
                        </p>
                    </div>
                </div>

                @if (!empty($chatifyUserId))
                    <a class="btn hero-btn" href="{{ url('chatify/' . $chatifyUserId) }}">
                        Ayo Belajar Bareng! <i class="bi bi-arrow-right"></i>
                    </a>
                @else
                    <button class="btn hero-btn" disabled title="Akun mentor belum terdaftar sebagai user chatify">
                        Ayo Belajar Bareng! <i class="bi bi-arrow-right"></i>
                    </button>
                @endif
            </div>

            <div class="section-title">Dashboard</div>

            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-ico"><i class="bi bi-play-circle"></i></div>
                        <div>
                            <div class="stat-num">{{ (int) ($mentor->jumlah_video ?? 0) }}</div>
                            <div class="stat-label">Video</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-ico"><i class="bi bi-journal-check"></i></div>
                        <div>
                            <div class="stat-num">{{ (int) ($mentor->jumlah_kelas ?? 0) }}</div>
                            <div class="stat-label">Kelas</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-ico"><i class="bi bi-trophy"></i></div>
                        <div>
                            <div class="stat-num">{{ (int) ($mentor->jumlah_materi ?? 0) }}</div>
                            <div class="stat-label">Materi</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-ico"><i class="bi bi-people"></i></div>
                        <div>
                            <div class="stat-num">{{ (int) ($mentor->jumlah_siswa ?? 0) }}</div>
                            <div class="stat-label">Siswa</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Course grid bawah (mirip kartu besar di prototype) --}}
            <div class="row g-4 mt-3">
                @php($courses = $courses ?? collect())
                @forelse($courses->take(4) as $c)
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="course-card">
                            <div>
                                <p class="course-title">{{ $c->nama_matkul }}</p>
                                <p class="course-sub">Kelas dari tutor ini</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-secondary mt-4">Belum ada mata kuliah yang ditampilkan.</div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
