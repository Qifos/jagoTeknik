<!--
 * Author : Muhammad Fiqih Soetam Putra (NRP 5026231096)
 * File   : resources/views/video.blade.php
 * Desc   : view untuk halaman video pembelajaran
 * Date   : 25-11-2025
-->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jago Teknik - Video</title>

    <!-- CSS Links -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/video.css') }}">
</head>
<body class="min-vh-100 d-flex flex-column">
    <header class="bg-transparent">
<<<<<<< HEAD
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
                        <a class="nav-link active" href="{{ route('kelas.semua') }}">Kelas</a>
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
>>>>>>> 008e2df50e114cd6f15e972ab9f157700f9bd9b0

    </header>


<<<<<<< HEAD
    <main class="flex-grow-1">
=======
    <main class="flex-grow-1 text-white">
>>>>>>> 008e2df50e114cd6f15e972ab9f157700f9bd9b0
        <div class="container-fluid px-lg-5 py-4">
            <div class="mb-3">
                <a href="javascript:void(0);" onclick="handleVideoBackButton()" class="back-btn">&lt; Back</a>
            </div>

            <div class="row g-4">
                <!-- Left Sidebar -->
                <div class="col-lg-4">
                    <div class="video-sidebar">
                        <div class="position-relative mb-3">
                            <img src="https://placehold.co/600x340/000/fff?text={{ urlencode($video->nama_video ?? 'Video') }}" class="img-fluid rounded" alt="{{ $video->nama_video }}">
                            <span class="time-badge">{{ $video->durasi ?? 'Video' }}</span>
                        </div>

                        <p class="small text-white-50 mb-1">{{ $materi->nama_materi }}</p>
                        <h2 class="h3 text-white fw-bold d-flex justify-content-between align-items-center">
                            {{ $video->nama_video }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrows-angle-expand" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M5.172 10.172a.5.5 0 0 0 .707 0l4-4a.5.5 0 0 0 0-.707l-4-4a.5.5 0 0 0-.707.707L8.793 9.5H5.5a.5.5 0 0 0 0 1h3.293l-3.62 3.62a.5.5 0 0 0 0 .707z"/>
                                <path fill-rule="evenodd" d="M10.828 5.828a.5.5 0 0 0-.707 0l-4 4a.5.5 0 0 0 0 .707l4 4a.5.5 0 0 0 .707-.707L7.207 6.5H10.5a.5.5 0 0 0 0-1H7.207l3.62-3.62a.5.5 0 0 0 0-.707z"/>
                            </svg>
                        </h2>
                        <p class="text-white-50">{{ $video->deskripsi ?? 'Deskripsi video tidak tersedia.' }}</p>

                        <hr class="border-secondary my-4">

                        <div class="d-flex align-items-center">
                            <img src="https://placehold.co/40x40/888/white?text={{ urlencode(substr($matkul->mentor->nama ?? 'Mentor', 0, 2)) }}" class="rounded-circle" alt="{{ $matkul->mentor->nama ?? 'Mentor' }}">
                            <div class="ms-3">
                                <p class="text-white mb-0 fw-bold">{{ $matkul->mentor->nama ?? 'Mentor' }}</p>
                                <small class="text-white-50">{{ $matkul->nama_matkul }}</small>
                            </div>
                        </div>

                        <!-- Related Videos -->
                        @if($relatedVideos && $relatedVideos->count() > 0)
                            <hr class="border-secondary my-4">
                            <h5 class="text-white mb-3">Video Lainnya</h5>
                            <div class="related-videos">
                                @foreach($relatedVideos as $relatedVideo)
                                    @if($relatedVideo->id_video !== $video->id_video)
                                        <a href="{{ route('media.video.detail', ['id' => $relatedVideo->id_video]) }}" class="related-video-item d-flex mb-2 text-decoration-none">
                                            <img src="https://placehold.co/60x40/000/fff?text=V" class="rounded me-2" alt="{{ $relatedVideo->nama_video }}">
                                            <div class="text-start flex-grow-1">
                                                <p class="mb-1 small text-white fw-bold">{{ substr($relatedVideo->nama_video, 0, 20) }}...</p>
                                                <small class="text-white-50">{{ $relatedVideo->durasi ?? 'Video' }}</small>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right Video Player -->
                <div class="col-lg-8">
                    <div class="video-player">
                        <div class="ratio ratio-16x9">
                            <video controls poster="https://placehold.co/1280x720/000/333?text=Video+Player+{{ $videoId ?? 1 }}" class="w-100" id="mainVideo">
                                <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
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
        const materiId = {{ $materi->id_materi ?? 0 }};
        const matkulId = {{ $matkul->id_matkul ?? 0 }};
        let videoWatchPercentage = 0;
        let videoCompleted = false;
        let lastProgressUpdate = 0;
        const PROGRESS_UPDATE_INTERVAL = 5000; // Update every 5 seconds

        // Initialize video tracking
        document.addEventListener('DOMContentLoaded', () => {
            const video = document.querySelector('video');

            if (video) {
                // Track video play
                video.addEventListener('play', () => {
                    console.log('Video started');
                });

                // Track video time update
                video.addEventListener('timeupdate', () => {
                    const currentTime = Math.round(video.currentTime);
                    const totalDuration = Math.round(video.duration);

                    if (totalDuration > 0) {
                        videoWatchPercentage = Math.round((currentTime / totalDuration) * 100);
                    }

                    // Update progress every 5 seconds
                    const now = Date.now();
                    if (now - lastProgressUpdate > PROGRESS_UPDATE_INTERVAL) {
                        recordVideoWatchProgress(totalDuration);
                        lastProgressUpdate = now;
                    }
                });

                // Track video ended
                video.addEventListener('ended', () => {
                    console.log('Video completed');
                    videoCompleted = true;
                    recordVideoCompletion(video.duration);
                });

                // Track video pause
                video.addEventListener('pause', () => {
                    console.log('Video paused at:', video.currentTime);
                });

                // Track when leaving the page
                window.addEventListener('beforeunload', () => {
                    if (videoWatchPercentage > 0) {
                        recordVideoWatchProgress(video.duration);
                    }
                });
            }
        });

        /**
         * Record video watch progress continuously
         */
        async function recordVideoWatchProgress(totalDuration) {
            if (!materiId || videoWatchPercentage === 0) return;

            try {
                const response = await fetch(`/api/progress/video-complete/${materiId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        watch_percentage: videoWatchPercentage,
                        total_duration: Math.round(totalDuration)
                    })
                });

                if (response.ok) {
                    const data = await response.json();
                    console.log('Video progress recorded:', data);
                }
            } catch (error) {
                console.error('Error recording video progress:', error);
            }
        }

        /**
         * Record video completion
         */
        async function recordVideoCompletion(totalDuration) {
            if (!materiId || !videoCompleted) return;

            try {
                const response = await fetch(`/api/progress/video-complete/${materiId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        watch_percentage: 100,
                        total_duration: Math.round(totalDuration)
                    })
                });

                if (response.ok) {
                    const data = await response.json();
                    console.log('Video completion recorded:', data);

                    // Show notification after video is done
                    showVideoCompleteNotification();
                }
            } catch (error) {
                console.error('Error recording video completion:', error);
            }
        }

        /**
         * Show notification when video is completed
         */
        function showVideoCompleteNotification() {
            const notification = document.createElement('div');
            notification.className = 'alert alert-success position-fixed bottom-0 end-0 m-4';
            notification.style.zIndex = '9999';
            notification.innerHTML = `
                <h6 class="alert-heading">Video Selesai!</h6>
                <p>Anda telah menonton video ini. Silakan kembali ke materi untuk melanjutkan pembelajaran.</p>
                <hr>
                <a href="{{ route('media.materi', ['id' => $materi->id_materi]) }}" class="btn btn-sm btn-success">Kembali ke Materi</a>
            `;
            document.body.appendChild(notification);

            // Auto remove after 10 seconds
            setTimeout(() => {
                notification.remove();
            }, 10000);
        }

        function handleVideoBackButton() {
            // Check if there's a previous page in history
            if (history.length > 1) {
                history.back();
            } else {
                // Fallback to homepage if no previous page
                window.location.href = '{{ route('homepage') }}';
            }
        }
    </script>
</body>
</html>
