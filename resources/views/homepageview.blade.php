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
                        <a class="nav-link active" href="{{ route('homepage') }}">Beranda</a>
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

    <!-- Bagian Ni Kadek Adelia Paramita Putri (5026231196)
            =========================================================
            Section: Jadwal Kelas Terdekat - Homepage (2 Kelas Terdekat)
            ====================================================== -->

    @php
        use Illuminate\Support\Facades\Auth;
        use Illuminate\Support\Facades\DB;
        use Carbon\Carbon;

        $user = Auth::user();
        $jadwalTerdekatHome = collect();

        if ($user) {
            $userId = $user->id_user ?? $user->id;
            $now = Carbon::now();
            $today = $now->toDateString();
            $currentTime = $now->format('H:i:s');

            $jadwalTerdekatHome = DB::table('jadwal as j')
                ->join('kelas as k', 'j.id_kelas', '=', 'k.id_kelas')
                ->join('matkul as m', 'k.id_matkul', '=', 'm.id_matkul')
                ->join('beli_matkul as bm', function ($join) use ($userId) {
                    $join->on('bm.id_matkul', '=', 'm.id_matkul')->where('bm.id_user', '=', $userId);
                })
                // jadwal yang masih di depan waktu sekarang
                ->where(function ($q) use ($today, $currentTime) {
                    $q->where('j.tanggal', '>', $today)->orWhere(function ($q2) use ($today, $currentTime) {
                        $q2->where('j.tanggal', '=', $today)->where('j.jam_mulai', '>=', $currentTime);
                    });
                })
                ->orderBy('j.tanggal')
                ->orderBy('j.jam_mulai')
                ->limit(2)
                ->select('j.tanggal', 'j.jam_mulai', 'j.jam_selesai', 'm.nama_matkul')
                ->get();
        }
    @endphp

    <header class="landing-hero-hp pt-9">
        <div class="container position-relative" style="z-index: 1">
            <div class="row align-items-center min-vh-100 pb-5 pb-lg-0 pt-5 pt-lg-0">

                <!-- Kiri: sapaan & judul kelas yang akan datang -->
                <div class="col-lg-6 mt-0 mt-lg-0 pt-lg-0">
                    <h1 class="hero__title mb-3">
                        Halo <span class="accent">{{ Auth::user()->username }}</span>!
                    </h1>
                    <p class="hero__subtitle fs-5">Mau belajar apa hari ini?</p>
                    <h2 class="section-title mb-0">Kelas yang akan datang</h2>
                </div>

                <!-- Kanan: dua bubble jadwal terdekat -->
                <div class="col-lg-6 mt-1 mt-lg-0">
                    <div class="bubbles">
                        @forelse ($jadwalTerdekatHome as $index => $jadwal)
                            <div class="bubble">
                                <div class="bubble__ring">
                                    {{-- icon beda sedikit untuk bubble pertama & kedua --}}
                                    <div class="bubble__icon">
                                        <i class="bi {{ $index === 0 ? 'bi-clock' : 'bi-book' }}"></i>
                                    </div>
                                    @if ($index === 1)
                                        <span class="bubble__dot"></span>
                                    @endif
                                </div>
                                <div class="bubble__label">
                                    <div class="bubble__title">{{ $jadwal->nama_matkul }}</div>
                                    <div class="bubble__time">
                                        {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}
                                        – {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                    </div>
                                    <div class="bubble__tanggal text-secondary mb-2">
                                        {{ $jadwal->tanggal ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted mb-0">
                                Belum ada jadwal kelas terdekat.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Batas Bagian Ni Kadek Adelia Paramita Putri (5026231196)
            =========================================================
            Section: Jadwal Kelas Terdekat - Homepage (2 Kelas Terdekat)
            ====================================================== -->

    <section class="py-5 section-explore-classes">
        <div class="container">
            <div class="section-header-with-link">
                <h2 class="section-title">Jelajahi kelas kamu</h2>
                <a href="{{ route('kelas.semua') }}" class="view-more-link">Lihat lebih banyak</a>
            </div>

            @php
                $userClasses = collect();
                $user = Auth::user();

                if ($user) {
                    $userId = $user->id_user ?? $user->id;

                    $userClasses = DB::table('beli_matkul as bm')
                        ->join('matkul as m', 'bm.id_matkul', '=', 'm.id_matkul')
                        ->join('mentor as mt', 'm.id_mentor', '=', 'mt.id_mentor')
                        ->join('kelas as k', 'k.id_matkul', '=', 'm.id_matkul')
                        ->leftJoin('user_matkul_progress as ump', function ($join) use ($userId) {
                            $join->on('ump.id_matkul', '=', 'm.id_matkul')->where('ump.id_user', '=', $userId);
                        })
                        ->where('bm.id_user', '=', $userId)
                        ->orderByDesc('ump.last_accessed_at')
                        ->orderByDesc('bm.created_at')
                        ->select(
                            'm.id_matkul',
                            'k.id_kelas',
                            'm.nama_matkul',
                            'k.image_path',
                            'mt.nama as mentor_name',
                            'mt.image_mentor',
                            'ump.progress_percentage',
                            'ump.last_accessed_at',
                        )
                        ->limit(10)
                        ->get();
                }
            @endphp


            @if ($userClasses->count() > 0)
                <div class="explore-classes-container">
                    <div class="explore-classes-scroll" id="exploreClassesScroll">
                        @foreach ($userClasses as $kelas)
                            <a href="{{ route('media.materi', $kelas->id_matkul) }}" class="explore-card-final">
                                <div class="explore-card-final__image-wrapper">
                                    <img src="{{ $kelas->image_path ? asset($kelas->image_path) : asset('images/kelas/default.jpg') }}"
                                        alt="{{ $kelas->nama_matkul }}"
                                        onerror="this.src='{{ asset('images/kelas/default.jpg') }}'">
                                    <span
                                        class="explore-card-final__category">{{ $kelas->nama_jurusan ?? 'Teknik' }}</span>
                                </div>

                                <!-- CONTENT SECTION -->
                                <div class="explore-card-final__content">
                                    <h4 class="explore-card-final__title">{{ $kelas->nama_matkul }}</h4>
                                    <p class="explore-card-final__subtitle">
                                        @php
                                            $chapterNum = intval(($kelas->progress_percentage ?? 0) / 14.28) + 1;
                                        @endphp
                                        Bagian {{ $chapterNum }} - Pembelajaran
                                    </p>

                                    <!-- Mentor Info -->
                                    <div class="explore-card-final__mentor">
                                        <img
                                            src="{{ $kelas->image_mentor ? asset($kelas->image_mentor) : asset('images/default-mentor.jpg') }}"
                                            alt="{{ $kelas->mentor_name ?? 'Mentor' }}"
                                            class="explore-card-final__mentor-avatar"
                                            onerror="this.src='{{ asset('images/default-mentor.jpg') }}'"
                                        >
                                        <span class="explore-card-final__mentor-name">{{ $kelas->mentor_name ?? 'Mentor' }}</span>
                                        </div>


                                    <!-- Progress -->
                                    <div class="explore-card-final__progress">
                                        Lesson
                                        {{ $kelas->progress_percentage ? intval($kelas->progress_percentage / 14.28) : 0 }}
                                        of 7
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Navigation Arrows -->
                    <div class="explore-classes-nav-final">
                        <button class="explore-nav-btn-final explore-nav-prev-final" id="explorePrevBtn"
                            aria-label="Sebelumnya">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="explore-nav-btn-final explore-nav-next-final" id="exploreNextBtn"
                            aria-label="Berikutnya">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
            @else
                <div class="empty-state-final">
                    <i class="bi bi-book" style="font-size: 3rem; color: #6c757d; margin-bottom: 1rem;"></i>
                    <p class="empty-state-final__text">Belum ada kelas yang diikuti</p>
                    <a href="{{ route('kelas.semua') }}" class="btn btn-primary mt-3">Jelajahi Kelas</a>
                </div>
            @endif
        </div>
    </section>

    <!--Bagian Ni Kadek Adelia Paramita Putri (5026231196)-->
    <!-- Rekomendasi: Kelas yang cocok buat kamu -->
    <section class="py-5 section-match">
        <div class="container">
            <h2 class="section-title mb-5">Kelas yang cocok buat kamu</h2>

            @if (isset($recommendations) && $recommendations->count())
                <div class="row g-4">
                    @foreach ($recommendations as $index => $kelas)
                        <a href="{{ route('kelas.beli', $kelas->id_kelas) }}"
                            class="col-md-4 text-decoration-none d-block">
                            <div class="match-card">
                                {{-- Top label: kategori & durasi --}}
                                <div class="match-card__top">
                                    <span class="match-card__category">
                                        {{ optional(optional($kelas->matkul)->jurusan)->nama_jurusan ?? 'Kelas Teknik' }}
                                    </span>
                                    <span class="match-card__duration">3 Bulan</span>
                                </div>

                                @php
                                    $staticImages = [
                                        'image/rekomkelas1.png',
                                        'image/rekomkelas2.png',
                                        'image/rekomkelas3.png',
                                    ];
                                    $foto = $staticImages[$index % count($staticImages)];
                                @endphp

                                <div class="match-card__image-wrapper">
                                    <img src="{{ asset($foto) }}"
                                        alt="{{ optional($kelas->matkul)->nama_matkul ?? 'Kelas JagoTeknik' }}"
                                        class="match-card__image">
                                </div>

                                <div class="match-card__body">
                                    <h4 class="match-card__title">
                                        {{ optional($kelas->matkul)->nama_matkul ?? 'Kelas JagoTeknik' }}
                                    </h4>
                                    <p class="match-card__desc">
                                        {{ $kelas->deskripsi ??
                                            (optional($kelas->matkul)->deskripsi ?? 'Belajar materi teknik dengan cara yang mudah dipahami.') }}
                                    </p>
                                </div>

                                <div class="match-card__footer">
                                    <div class="match-card__mentor">
                                        <span class="match-card__mentor-dot"></span>
                                        <span>
                                            {{ optional(optional($kelas->matkul)->mentor)->nama ?? 'Mentor JagoTeknik' }}
                                        </span>
                                    </div>
                                    <div class="match-card__price">
                                        @if (!is_null($kelas->harga))
                                            Rp {{ number_format($kelas->harga, 0, ',', '.') }}
                                        @else
                                            Gratis
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="mt-3 text-muted">
                    Belum ada rekomendasi khusus. Jelajahi kelas lain dulu, yuk! 😄
                </p>
            @endif
        </div>
    </section>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollContainer = document.getElementById('exploreClassesScroll');
            const prevBtn = document.getElementById('explorePrevBtn');
            const nextBtn = document.getElementById('exploreNextBtn');

            if (!scrollContainer || !prevBtn || !nextBtn) {
                return;
            }

            const updateButtonStates = () => {
                const isAtStart = scrollContainer.scrollLeft <= 0;
                const isAtEnd = scrollContainer.scrollLeft + scrollContainer.clientWidth >= scrollContainer
                    .scrollWidth - 10;

                prevBtn.disabled = isAtStart;
                nextBtn.disabled = isAtEnd;
            };

            const scrollAmount = 250;

            prevBtn.addEventListener('click', () => {
                scrollContainer.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
                setTimeout(updateButtonStates, 300);
            });

            nextBtn.addEventListener('click', () => {
                scrollContainer.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
                setTimeout(updateButtonStates, 300);
            });
            scrollContainer.addEventListener('scroll', updateButtonStates);
            updateButtonStates();
        });

        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>

</html>
