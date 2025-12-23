<!--
 * Author : Muhammad Fiqih Soetam Putra (NRP 5026231096)
 * File   : resources/views/kelas.blade.php
 * Desc   : view untuk halaman kelas
 * Date   : 25-11-2025
-->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jago Teknik - Kelas</title>
    <!-- Samakan navbar & style dengan Homepage -->
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/personalisasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">

    <!-- CSS Links -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kelas.css') }}">
</head>
<body class="min-vh-100 d-flex flex-column">
<<<<<<< HEAD
    <header class="bg-transparent">
        <!-- Navbar (SAMA seperti homepage/jadwal) -->
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
            <div class="container-fluid px-4">
                <a class="navbar-brand ms-2 ms-lg-3" href="#">
                    <img src="{{ asset('image/jagoteknik.png') }}" alt="Jago Teknik" class="brand-logo">
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
                                <img src="{{ asset('image/profile.jpg') }}" alt="Profile" class="profile-img">
                                <span class="ms-2">Profil</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
=======
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
                        <a class="nav-link" href="{{ route('homepage') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kelas.semua') }}">Kelas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('jadwal.index') }}">Jadwal</a>
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

>>>>>>> 008e2df50e114cd6f15e972ab9f157700f9bd9b0


    <main class="flex-grow-1">
        <div class="container-fluid px-lg-5 py-4">
            <div class="mb-3">
                <a href="javascript:void(0);" onclick="handleBackButton()" class="back-btn">&lt; Back</a>
            </div>

            <header class="text-center">
                <h1 class="display-5 title-hero">{{ $matkul->nama_matkul }}</h1>
                <p class="text-muted">{{ $matkul->mentor->nama ?? 'Instruktur' }}</p>
            </header>

            <div style="height: 30px;"></div>

            <!-- Materi Belajar Section -->
            <section class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 fw-bold mb-0">Materi Belajar</h2>
                    <div class="d-none d-md-block">
                        <button class="btn btn-sm btn-light me-2" onclick="document.getElementById('materi-scroll').scrollBy({ left: -280, behavior: 'smooth' })">&lt;</button>
                        <button class="btn btn-sm btn-light" onclick="document.getElementById('materi-scroll').scrollBy({ left: 280, behavior: 'smooth' })">&gt;</button>
                    </div>
                </div>

                <div class="h-scroll" id="materi-scroll">
                    @foreach($materiItems as $item)
                    <div class="card-item">
                        @php
                            $isMateriUnlocked = isset($item['is_unlocked']) ? $item['is_unlocked'] : ($loop->first ? true : false);
                        @endphp

                        @if($isMateriUnlocked)
                            <a href="{{ route('media.materi', ['id' => $item['id']]) }}" class="text-decoration-none">
                                <div class="custom-card">
                                    <div class="media-container mb-3">
                                        @if(isset($item['thumb']) && $item['thumb'])
                                            <img src="{{ $item['thumb'] }}" alt="{{ $item['title'] }}">
                                        @else
                                            <div class="media-empty">
                                                <span>{{ $item['title'] }}</span>
                                            </div>
                                        @endif
                                        <span class="small-pill">{{ $item['tag'] }}</span>
                                    </div>

                                    <div style="padding: 0 12px;">
                                        <div class="card-title mb-2">{{ $item['title'] }}</div>
                                        <div class="instructor mb-2">
                                            <img src="https://placehold.co/24x24/eee/333?text=N" alt="instructor">
                                            <span>{{ $item['instructor'] }}</span>
                                        </div>

                                        <div class="custom-progress mt-auto">
                                            <div class="bar" style="width: {{ $item['progress'] }}%"></div>
                                        </div>
                                        <div class="progress-text mt-2 mb-3">
                                            @if($item['is_completed'])
                                                <span style="color: #28a745; font-weight: bold;">✓ {{ $item['progress_text'] }}</span>
                                            @else
                                                <span style="color: #6c757d;">{{ $item['progress_text'] }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @else
                            <div onclick="showLockedMateriWarning()" style="cursor: not-allowed; display: block;">
                                <div class="custom-card" style="opacity: 0.6;">
                                    <div class="media-container mb-3" style="position: relative;">
                                        @if(isset($item['thumb']) && $item['thumb'])
                                            <img src="{{ $item['thumb'] }}" alt="{{ $item['title'] }}">
                                        @else
                                            <div class="media-empty">
                                                <span>{{ $item['title'] }}</span>
                                            </div>
                                        @endif
                                        <span class="small-pill">{{ $item['tag'] }}</span>
                                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0,0,0,0.7); color: white; padding: 8px 12px; border-radius: 4px; font-size: 0.85rem; white-space: nowrap; z-index: 10;">
                                            🔒 Terkunci
                                        </div>
                                    </div>

                                    <div style="padding: 0 12px;">
                                        <div class="card-title mb-2">{{ $item['title'] }}</div>
                                        <div class="instructor mb-2">
                                            <img src="https://placehold.co/24x24/eee/333?text=N" alt="instructor">
                                            <span>{{ $item['instructor'] }}</span>
                                        </div>

                                        <div class="custom-progress mt-auto">
                                            <div class="bar" style="width: {{ $item['progress'] }}%"></div>
                                        </div>
                                        <div class="progress-text mt-2 mb-3">
                                            <span style="color: #6c757d;">Selesaikan materi sebelumnya</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- Video Kelas Section -->
            <section class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 fw-bold mb-0">Video Kelas</h2>
                    <div class="d-none d-md-block">
                        <button class="btn btn-sm btn-light me-2" onclick="document.getElementById('video-scroll').scrollBy({ left: -280, behavior: 'smooth' })">&lt;</button>
                        <button class="btn btn-sm btn-light" onclick="document.getElementById('video-scroll').scrollBy({ left: 280, behavior: 'smooth' })">&gt;</button>
                    </div>
                </div>

                <div class="h-scroll" id="video-scroll">
                    @foreach($videoItems as $video)
                    <div class="card-item">
                        <a href="{{ route('media.video.detail', ['id' => $video['id']]) }}" class="text-decoration-none">
                            <div class="custom-video-card">
                                <div class="media-container mb-3">
                                    @if(isset($video['thumb']) && $video['thumb'])
                                        <img src="{{ $video['thumb'] }}" alt="{{ $video['title'] }}">
                                    @else
                                        <div class="media-empty">
                                            <span>{{ $video['title'] }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div style="padding: 0 12px; display: flex; flex-direction: column; flex: 1;">
                                    <div class="card-title mb-2">{{ $video['title'] }}</div>
                                    <div class="instructor mb-2">
                                        <img src="https://placehold.co/24x24/eee/333?text=I" alt="instructor">
                                        <span>{{ $video['instructor'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </section>
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

    <script>
        /**
         * Show warning popup when user tries to click locked materi
         */
        function showLockedMateriWarning() {
            alert('🔒 Materi ini belum terbuka.\n\nSelesaikan materi sebelumnya terlebih dahulu untuk membuka materi ini.');
        }

        /**
         * Handle back button logic
         * If coming from materi or video view, go to semuakelas
         * Otherwise, go back or to semuakelas as default
         */
        function handleBackButton() {
            const referrer = document.referrer;

            // Check if referrer contains 'materi' or 'video' route
            if (referrer && (referrer.includes('/materi/') || referrer.includes('/video/'))) {
                // Go to semuakelas view
                window.location.href = '{{ route('kelas.semua') }}';
            } else if (history.length > 1) {
                // Go back in history
                history.back();
            } else {
                // Fallback to semuakelas
                window.location.href = '{{ route('kelas.semua') }}';
            }
        }
    </script>
</body>
</html>
