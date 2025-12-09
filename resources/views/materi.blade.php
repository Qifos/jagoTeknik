<!--
 * Author : Muhammad Fiqih Soetam Putra (NRP 5026231096)
 * File   : resources/views/materi.blade.php
 * Desc   : view untuk halaman materi pembelajaran
 * Date   : 25-11-2025
-->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jago Teknik - Materi</title>

    <!-- CSS Links -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/materi.css') }}">
</head>
<body class="min-vh-100 d-flex flex-column">
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


    <main class="flex-grow-1">
        <div class="container py-4">
            <div class="mb-3">
                <a href="{{ route('kelas.detail.beli', $matkul->id_matkul) }}" class="back-btn">&lt; Back</a>
            </div>

            <header class="text-center">
                <h1 class="display-5 title-hero">{{ $matkul->nama_matkul }}</h1>
            </header>

            <div class="content-card">
                <h2 class="h4 mb-3">{{ $materi->nama_materi ?? 'Materi Pembelajaran' }}</h2>

                <div>{!! $materi->isi_materi ?? '<p>Deskripsi materi tidak tersedia.</p>' !!}</div>

                <!-- Video List -->
                @if($videos && $videos->count() > 0)
                    <h5 class="mt-4 mb-3">Video Pembelajaran</h5>
                    <div class="video-grid">
                        @foreach($videos as $video)
                            <div class="teaser-card">
                                <div class="thumb">
                                    <img src="https://placehold.co/400x225/000/fff?text={{ urlencode($video->nama_video ?? 'Video') }}" alt="{{ $video->nama_video }}">
                                    <a href="{{ route('media.video.detail', ['id' => $video->id_video]) }}" class="play-large">▶</a>
                                </div>
                                <div>
                                    <div class="fw-bold video-title">
                                        {{ $video->nama_video }}
                                    </div>
                                    <div class="instructor">
                                        <img src="https://placehold.co/24x24/eee/333?text=I" alt="instructor">
                                        <span>{{ $video->durasi ?? 'Video' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info mt-4">
                        <p>Belum ada video pembelajaran untuk materi ini.</p>
                    </div>
                @endif

                <!-- Navigation Button to Next Materi -->
                @php
                    $currentMateriId = $materi->id_materi ?? null;
                    $nextMateri = $materi->matkul->materi()
                        ->where('id_materi', '>', $currentMateriId)
                        ->orderBy('id_materi', 'asc')
                        ->first();
                    $previousMateri = $materi->matkul->materi()
                        ->where('id_materi', '<', $currentMateriId)
                        ->orderBy('id_materi', 'desc')
                        ->first();
                @endphp

                <!-- Previous Button -->
                @if($previousMateri)
                    <a href="{{ route('media.materi', ['id' => $previousMateri->id_materi]) }}" class="materi-prev-button">
                        ← Materi Sebelumnya
                    </a>
                @endif

                <!-- Next or Complete Button -->
                @if($nextMateri)
                    <a href="{{ route('media.materi', ['id' => $nextMateri->id_materi]) }}" class="materi-nav-button">
                        Lanjut ke Materi Selanjutnya →
                    </a>
                @else
                    <button class="materi-nav-button complete-btn" onclick="completeMateri()">
                        Selesaikan Pembelajaran ✓
                    </button>
                @endif
            </div>
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
        // Complete materi function
        async function completeMateri() {
            const materiId = {{ $materi->id_materi ?? 0 }};
            const matkulId = {{ $matkul->id_matkul ?? 0 }};

            try {
                const response = await fetch(`/api/materi/complete/${materiId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    alert('Selamat! Anda telah menyelesaikan pembelajaran ini.');
                    // Redirect to kelas view
                    window.location.href = `/kelas/${matkulId}`;
                } else {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        }

        // Track content reading progress
        let scrollDepth = 0;
        let contentReadTimer = null;
        const materiId = {{ $materi->id_materi ?? 0 }};

        window.addEventListener('scroll', () => {
            const contentCard = document.querySelector('.content-card');
            if (!contentCard) return;

            const scrollHeight = contentCard.scrollHeight - window.innerHeight;
            const scrolledHeight = window.scrollY;
            scrollDepth = Math.round((scrolledHeight / scrollHeight) * 100);

            // Record when user has read most of the content
            if (scrollDepth >= 80 && !contentReadTimer) {
                contentReadTimer = setTimeout(() => {
                    recordContentProgress(true);
                }, 2000); // Record after 2 seconds of reading
            }
        });

        // Record content read progress
        async function recordContentProgress(contentRead) {
            if (!materiId) return;

            try {
                await fetch(`/api/progress/content/${materiId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        scroll_depth: scrollDepth,
                        content_read: contentRead
                    })
                });
            } catch (error) {
                console.error('Error recording content progress:', error);
            }
        }

        // Track video completion if there are videos
        document.addEventListener('DOMContentLoaded', () => {
            const videoElements = document.querySelectorAll('video');
            videoElements.forEach((video, index) => {
                video.addEventListener('ended', () => {
                    recordVideoProgress(true, video.duration);
                });

                // Record progress as video plays
                video.addEventListener('timeupdate', () => {
                    const currentTime = Math.round(video.currentTime);
                    recordVideoProgress(false, video.duration, currentTime);
                });
            });
        });

        // Record video progress
        async function recordVideoProgress(completed, totalDuration, watchedDuration = null) {
            if (!materiId) return;

            try {
                await fetch(`/api/progress/video/${materiId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        watched_duration: watchedDuration || totalDuration,
                        total_duration: Math.round(totalDuration),
                        completed: completed
                    })
                });
            } catch (error) {
                console.error('Error recording video progress:', error);
            }
        }
    </script>
</body>
</html>
