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
                        <a class="nav-link" href="{{ url('/homepage') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/semuakelas') }}">Kelas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/jadwal') }}">Jadwal</a>
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
                        <a class="nav-link d-flex align-items-center" href="{{ url('/personalisasi') }}">
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
            <a class="btn btn-back mb-4" href="{{ url('/homepage') }}">
                 <i class="bi bi-chevron-left"></i> Back
            </a>
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

                    <!-- Course Cards Grid -->
                    <div class="row g-4">
                        @php
                            use Illuminate\Support\Facades\Auth;
                            use Illuminate\Support\Facades\DB;

                            $user = Auth::user();

                            // Ambil semua kelas dengan informasi terkait
                            $semuaKelas = DB::table('kelas as k')
                                ->join('matkul as m', 'k.id_matkul', '=', 'm.id_matkul')
                                ->leftJoin('mentor as ment', 'm.id_mentor', '=', 'ment.id_mentor')
                                ->leftJoin('beli_matkul as bm', function($join) use ($user) {
                                    $join->on('m.id_matkul', '=', 'bm.id_matkul')
                                         ->where('bm.id_user', '=', $user ? $user->id_user : null);
                                })
                                ->leftJoin('wishlist_kelas as wl', function($join) use ($user) {
                                    $join->on('k.id_kelas', '=', 'wl.id_kelas')
                                         ->where('wl.id_user', '=', $user ? $user->id_user : null);
                                })
                                ->select(
                                    'k.id_kelas',
                                    'm.id_matkul',
                                    'k.image_path',
                                    'm.nama_matkul',
                                    'm.deskripsi',
                                    'k.deskripsi as deskripsi_kelas',
                                    'k.preview',
                                    'k.rating_kelas',
                                    'k.harga_asli',
                                    'ment.nama as nama_mentor',
                                    'bm.id_beli_matkul',
                                    'wl.id_wishlist_kelas',
                                    DB::raw('CASE
                                        WHEN bm.id_beli_matkul IS NOT NULL THEN "completed"
                                        WHEN wl.id_wishlist_kelas IS NOT NULL THEN "wishlist"
                                        ELSE "available"
                                    END as status_kelas')
                                )
                                ->get();

                            // Fallback jika tidak ada data dari database
                            $showDefault = $semuaKelas->isEmpty();
                        @endphp

                        @if($showDefault)
                            <!-- Default cards jika tidak ada data dari database -->
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
                                        <p class="course-progress">Rp 125.000</p>
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
                                        <p class="course-progress">Rp 150.000</p>
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
                                        <p class="course-progress">Progress: 75%</p>
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
                                        <p class="course-progress">Dalam wishlist</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Data dinamis dari database -->
                            @foreach($semuaKelas as $item)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <!-- Link berbeda berdasarkan status kelas -->
                                    @if($item->status_kelas === 'completed')
                                        <!-- Jika sudah dibeli, link ke halaman belajar -->
                                        <a href="{{ route('kelas.detail.beli', $item->id_kelas) }}" class="text-decoration-none">
                                    @else
                                        <!-- Jika belum dibeli, link ke halaman detail/pembelian -->
                                        <a href="{{ route('kelas.beli', $item->id_kelas) }}" class="text-decoration-none">
                                    @endif

                                        <div class="course-card">
                                            <div class="course-image">
                                                {{-- GAMBAR DARI image_path TABEL KELAS --}}
                                                <img src="{{ $item->image_path ? asset($item->image_path) : asset('images/kelas/default.jpg') }}"
                                                    alt="{{ $item->nama_matkul }}"
                                                    onerror="this.src='{{ asset('images/kelas/default.jpg') }}'">
                                                <div class="course-badge {{ $item->status_kelas === 'completed' ? 'completed' : ($item->status_kelas === 'wishlist' ? 'add' : '') }}">
                                                    @if($item->status_kelas === 'completed')
                                                        <i class="bi bi-check-circle-fill"></i>
                                                    @elseif($item->status_kelas === 'wishlist')
                                                        <form action="{{ route('wishlist.toggle', $item->id_kelas) }}" method="POST" style="all: unset; cursor: pointer;">
                                                            @csrf
                                                            <i class="bi bi-plus-circle-fill"></i>
                                                        </form>
                                                    @else
                                                        <i class="bi bi-play-circle-fill"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="course-info">
                                                <h3 class="course-title">{{ $item->nama_matkul }}</h3>
                                                <p class="course-progress">
                                                    @if($item->status_kelas === 'completed')
                                                        <!-- Tampilkan progress untuk kelas yang sudah dibeli -->
                                                        @php
                                                            $progress = app(App\Http\Controllers\KelasController::class)->getProgressKelas($item->id_kelas);
                                                        @endphp
                                                        Progress: {{ $progress }}%
                                                    @elseif($item->status_kelas === 'wishlist')
                                                        <!-- Tampilkan status wishlist -->
                                                        Dalam wishlist
                                                    @else
                                                        <!-- Tampilkan harga untuk kelas yang belum dibeli -->
                                                        Rp {{ number_format($item->harga_asli, 0, ',', '.') }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- TAB DIIKUTI -->
                <div class="tab-pane fade" id="diikuti" role="tabpanel">
                    @php
                        // Ambil kelas yang sedang diikuti (status completed)
                        $kelasDiikuti = $semuaKelas->where('status_kelas', 'completed');
                    @endphp

                    <div class="section-header mb-3">
                        <h2 class="section-title">Kelas yang Diikuti</h2>
                        <p class="section-subtitle">
                            @if($kelasDiikuti->count() > 0)
                                Kelas yang sedang Anda ikuti
                            @else
                                Belum ada kelas yang sedang diikuti
                            @endif
                        </p>
                    </div>

                    @if($kelasDiikuti->count() > 0)
                        <div class="row g-4">
                            @foreach($kelasDiikuti as $item)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <!-- Link ke halaman belajar untuk kelas yang sudah dibeli -->
                                    <a href="{{ route('kelas.detail.beli', $item->id_kelas) }}" class="text-decoration-none">
                                        <div class="course-card">
                                            <div class="course-image">
                                                <!-- SESUDAH (PERBAIKAN) -->
                                                    <img src="{{ $item->image_path ? asset($item->image_path) : asset('images/kelas/default.jpg') }}"
                                                     alt="{{ $item->nama_matkul }}"
                                                     onerror="this.src='{{ asset('images/kelas/default.jpg') }}'">
                                                <div class="course-badge completed">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                </div>
                                            </div>
                                            <div class="course-info">
                                                <h3 class="course-title">{{ $item->nama_matkul }}</h3>
                                                @php
                                                    $progress = app(App\Http\Controllers\KelasController::class)->getProgressKelas($item->id_kelas);
                                                @endphp
                                                <!-- Di tab Diikuti, selalu tampilkan progress -->
                                                <p class="course-progress">Progress: {{ $progress }}%</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-book" style="font-size: 3rem; color: #6c757d;"></i>
                            <p class="text-muted mt-3">Belum ada kelas yang sedang diikuti</p>
                            <a href="{{ route('kelas.semua') }}" class="btn btn-primary mt-2">Jelajahi Kelas</a>
                        </div>
                    @endif
                </div>

                <!-- TAB SELESAI -->
                <div class="tab-pane fade" id="selesai" role="tabpanel">
                    @php
                        // Ambil kelas yang sudah selesai (progress 100%)
                        $kelasSelesai = $semuaKelas->where('status_kelas', 'completed')
                            ->filter(function($item) {
                                $progress = app(App\Http\Controllers\KelasController::class)->getProgressKelas($item->id_kelas);
                                return $progress == 100;
                            });
                    @endphp

                    <div class="section-header mb-3">
                        <h2 class="section-title">Kelas yang Selesai</h2>
                        <p class="section-subtitle">
                            @if($kelasSelesai->count() > 0)
                                Kelas yang sudah Anda selesaikan
                            @else
                                Belum ada kelas yang diselesaikan
                            @endif
                        </p>
                    </div>

                    @if($kelasSelesai->count() > 0)
                        <div class="row g-4">
                            @foreach($kelasSelesai as $item)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <!-- Link ke halaman belajar untuk kelas yang sudah selesai -->
                                    <a href="{{ route('kelas.detail.beli', $item->id_kelas) }}" class="text-decoration-none">
                                        <div class="course-card">
                                            <div class="course-image">
                                                <!-- SESUDAH (PERBAIKAN) -->
                                                    <img src="{{ $item->image_path ? asset($item->image_path) : asset('images/kelas/default.jpg') }}"
                                                     alt="{{ $item->nama_matkul }}"
                                                     onerror="this.src='{{ asset('images/kelas/default.jpg') }}'">
                                                <div class="course-badge completed">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                </div>
                                            </div>
                                            <div class="course-info">
                                                <h3 class="course-title">{{ $item->nama_matkul }}</h3>
                                                <p class="course-instructor">Oleh: {{ $item->nama_mentor ?? 'Instruktur' }}</p>
                                                <!-- Di tab Selesai, tampilkan status selesai -->
                                                <p class="course-progress">Selesai</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-flag" style="font-size: 3rem; color: #6c757d;"></i>
                            <p class="text-muted mt-3">Belum ada kelas yang diselesaikan</p>
                            <a href="{{ route('kelas.semua') }}" class="btn btn-primary mt-2">Lanjutkan Belajar</a>
                        </div>
                    @endif
                </div>

            <!-- Bagian Ni Kadek Adelia Paramita Putri (5026231196)
            =========================================================
            Section: Tab Wishlist - View Semua Kelas
            ====================================================== -->

            <div class="tab-pane fade" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">

                @php
                    $user = Auth::user();
                    $wishlistItems = collect();

                    if ($user) {
                        $userId = $user->id_user ?? $user->id;

                        $wishlistItems = DB::table('wishlist_kelas as w')
                            ->join('kelas as k', 'w.id_kelas', '=', 'k.id_kelas')
                            ->join('matkul as m', 'k.id_matkul', '=', 'm.id_matkul')
                            ->leftJoin('mentor as ment', 'm.id_mentor', '=', 'ment.id_mentor')
                            ->leftJoin('beli_matkul as b', function ($join) use ($userId) {
                                $join->on('b.id_matkul', '=', 'm.id_matkul')
                                     ->where('b.id_user', '=', $userId);
                            })
                            ->where('w.id_user', $userId)
                            // tetap exclude kelas yang sudah dibeli
                            ->whereNull('b.id_beli_matkul')
                            ->select(
                                'k.id_kelas',
                                'm.nama_matkul',
                                'k.image_path'
                            )
                            ->get();
                    }

                    $showEmptyState = !$user || $wishlistItems->isEmpty();
                @endphp

                <div class="section-header mb-3">
                    <h2 class="section-title">Kelas yang mau diikuti</h2>
                    <p class="section-subtitle">
                        Lihat daftar kelas yang sudah kamu masukkan ke wishlist di JagoTeknik.
                    </p>
                </div>

                <div class="row g-4">

                    @if($showEmptyState)
                        <div class="col-12">
                            <div class="empty-wishlist-box text-center py-5">
                                <h3 class="empty-title">Belum ada kelas di wishlist</h3>
                                <p class="empty-subtitle">Tambah kelas dari tab "Semua".</p>
                            </div>
                        </div>
                    @else
                        @foreach($wishlistItems as $kelas)
                            <div class="col-lg-3 col-md-4 col-sm-6">

                                {{-- Dari wishlist: klik card langsung ke halaman detail / pembelian --}}
                                <a href="{{ route('kelas.beli', $kelas->id_kelas) }}" class="course-card-link">

                                    <div class="course-card">
                                        <div class="course-image">
                                            <img src="{{ asset($kelas->image_path) }}"
                                                 alt="{{ $kelas->nama_matkul }}"
                                                 onerror="this.src='{{ asset('images/kelas/default.jpg') }}'">

                                            {{-- Ikon plus di pojok kanan atas (sama seperti tab Semua) --}}
                                            <div class="course-badge add">
                                                <form action="{{ route('wishlist.toggle', ['id_kelas' => $kelas->id_kelas]) }}"
                                                      method="POST"
                                                      style="all: unset; cursor: pointer;">
                                                    @csrf
                                                    <button type="submit" style="all: unset; cursor: pointer;">
                                                        <i class="bi bi-plus-circle-fill"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="course-info">
                                            <h3 class="course-title">{{ $kelas->nama_matkul }}</h3>
                                            <p class="course-progress">Daftar kelas ini</p>
                                        </div>
                                    </div>

                                </a>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>

            <!-- Batas Bagian Ni Kadek Adelia Paramita Putri (5026231196)
            =========================================================
            Section: Tab Wishlist - View Semua Kelas
            ====================================================== -->
        </div>
    </section>

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
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert untuk notifikasi -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Notifikasi untuk wishlist
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>
</body>
</html>
