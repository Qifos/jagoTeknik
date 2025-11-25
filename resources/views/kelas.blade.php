<!--
 * Author : Fiqih Soetam PuTra (NRP 5026231096)
 * Desc   : Kelas
 * Date   : 2025-11-04
-->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jago Teknik - Kelas</title>

    <!-- CSS Links -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kelas.css') }}">
</head>
<body class="min-vh-100 d-flex flex-column">
    <header class="bg-transparent">
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
                        <a class="nav-link" href="{{route('homepage')}}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kelas.index') }}">Kelas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jadwal.index') }}">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chat.index') }}">Chat</a>
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
                        <a class="nav-link active d-flex align-items-center" href="{{ route('personalisasi.view') }}">
                            <img src="profile.jpg" alt="Profile" class="profile-img">
                            <span class="ms-2">Profil</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </header>

    <main class="flex-grow-1">
        <div class="container-fluid px-lg-5 py-4">
            <div class="mb-3">
                <a href="#" onclick="if(history.length > 1) { history.back(); return false; } else { window.location = '{{ route('kelas.index') }}'; }" class="back-btn">&lt; Back</a>
            </div>

            <header class="text-center">
                <h1 class="display-5 title-hero">Kalkulus 2</h1>
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
                        <a href="{{ route('media.image', ['id' => $item['id']]) }}" class="text-decoration-none">
                            <div class="custom-card">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="small-pill">{{ $item['tag'] }}</span>
                                </div>

                                <div class="media-container mb-3">
                                    @if(isset($item['thumb']) && $item['thumb'])
                                        <img src="{{ $item['thumb'] }}" alt="{{ $item['title'] }}">
                                    @else
                                        <div class="media-empty">
                                            <span>{{ $item['title'] }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="card-title mb-2">{{ $item['title'] }}</div>
                                <div class="instructor mb-3">
                                    <img src="https://placehold.co/24x24/eee/333?text=N" alt="instructor">
                                    <span>{{ $item['instructor'] }}</span>
                                </div>

                                <div class="custom-progress mt-auto">
                                    <div class="bar" style="width: {{ $item['progress'] }}%"></div>
                                </div>
                                <div class="progress-text mt-2">{{ $item['progress_text'] }}</div>
                            </div>
                        </a>
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
                        <a href="{{ route('media.video', ['id' => $video['id']]) }}" class="text-decoration-none">
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

                                <div class="card-title mb-2">{{ $video['title'] }}</div>
                                <div class="instructor mb-3">
                                    <img src="https://placehold.co/24x24/eee/333?text=I" alt="instructor">
                                    <span>{{ $video['instructor'] }}</span>
                                </div>

                                <div class="custom-progress mt-auto">
                                    <div class="bar" style="width: {{ $video['progress'] }}%"></div>
                                </div>
                                <div class="progress-text mt-2">{{ $video['progress_text'] }}</div>
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
</body>
</html>
