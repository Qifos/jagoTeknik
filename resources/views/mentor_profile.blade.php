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

    {{-- CSS khusus halaman mentor profile --}}
    <link rel="stylesheet" href="{{ asset('css/profilementor.css') }}">
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

            {{-- Course grid bawah --}}
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
