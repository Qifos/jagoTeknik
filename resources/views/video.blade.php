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
        <nav class="navbar navbar-expand-lg navbar-jagoteknik">
            <div class="container-fluid">
                <!-- Left Side -->
                <a class="navbar-brand d-flex align-items-center" href="{{ route('landing') }}">
                    <span class="footer-logo me-2">J</span>
                    Jago Teknik
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('homepage') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('kelas.index') }}">Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Jadwal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Chat</a>
                        </li>
                    </ul>

                    <!-- Right Side -->
                    <div class="d-flex align-items-center gap-3">
                        <form class="d-flex" role="search">
                            <input class="form-control search-input" type="search" placeholder="Cari di Jago Teknik" aria-label="Search">
                        </form>
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none gap-2">
                            <img src="https://placehold.co/40x40/6b2fa0/white?text=A" alt="Profil" class="profile-img">
                            <span class="d-none d-lg-inline">Profil</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow-1">
        <div class="container-fluid px-lg-5 py-4">
            <div class="mb-3">
                <a href="{{ route('media.materi', ['id' => $materi->id_materi]) }}" class="back-btn">&lt; Back</a>
            </div>

            <div class="row g-4">
                <!-- Left Sidebar -->
                <div class="col-lg-4">
                    <div class="video-sidebar">
                        <div class="position-relative mb-3">
                            <img src="https://placehold.co/600x340/000/fff?text={{ urlencode($video->nama_video ?? 'Video') }}" class="img-fluid rounded" alt="{{ $video->nama_video }}">
                            <span class="time-badge">{{ $video->durasi ?? 'Video' }}</span>
                        </div>

                        <p class="small text-muted mb-1">{{ $materi->nama_materi }}</p>
                        <h2 class="h3 text-white fw-bold d-flex justify-content-between align-items-center">
                            {{ $video->nama_video }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrows-angle-expand" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M5.172 10.172a.5.5 0 0 0 .707 0l4-4a.5.5 0 0 0 0-.707l-4-4a.5.5 0 0 0-.707.707L8.793 9.5H5.5a.5.5 0 0 0 0 1h3.293l-3.62 3.62a.5.5 0 0 0 0 .707z"/>
                                <path fill-rule="evenodd" d="M10.828 5.828a.5.5 0 0 0-.707 0l-4 4a.5.5 0 0 0 0 .707l4 4a.5.5 0 0 0 .707-.707L7.207 6.5H10.5a.5.5 0 0 0 0-1H7.207l3.62-3.62a.5.5 0 0 0 0-.707z"/>
                            </svg>
                        </h2>
                        <p class="text-muted">{{ $video->deskripsi ?? 'Deskripsi video tidak tersedia.' }}</p>

                        <hr class="border-secondary my-4">

                        <div class="d-flex align-items-center">
                            <img src="https://placehold.co/40x40/888/white?text={{ urlencode(substr($matkul->mentor->nama ?? 'Mentor', 0, 2)) }}" class="rounded-circle" alt="{{ $matkul->mentor->nama ?? 'Mentor' }}">
                            <div class="ms-3">
                                <p class="text-white mb-0 fw-bold">{{ $matkul->mentor->nama ?? 'Mentor' }}</p>
                                <small class="text-muted">{{ $matkul->nama_matkul }}</small>
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
                                                <small class="text-muted">{{ $relatedVideo->durasi ?? 'Video' }}</small>
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
                            <video controls poster="https://placehold.co/1280x720/000/333?text=Video+Player+{{ $videoId ?? 1 }}" class="w-100">
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
</body>
</html>
