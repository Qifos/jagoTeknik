<!--
 * Author : Muhammad Fiqih Soetam Putra (NRP 5026231096)
 * File   : resources/views/kelaspreview.blade.php
 * Desc   : view untuk halaman preview kelas dari jadwal
 * Date   : 02-12-2025
-->
@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jago Teknik - Preview Kelas</title>

    <!-- CSS Links -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kelaspreview.css') }}">
</head>

<body class="min-vh-100 d-flex flex-column">
    <header class="bg-transparent">
        <!-- Navbar (SAMA seperti homepage/jadwal) -->
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
    </header>


    <main class="flex-grow-1 text-white">
        <div class="container-fluid px-lg-5 py-4">
            <div class="mb-3">
                <a href="javascript:void(0);" onclick="handleBackButton()" class="back-btn">&lt; Back</a>
            </div>

            <div class="row g-4">
                <!-- Left Sidebar -->
                <div class="col-lg-4">
                    <div class="video-sidebar">
                        <!-- Class Image -->
                        <div class="position-relative mb-3">
                            <img src="{{ $kelas->image_path ? asset($kelas->image_path) : 'https://placehold.co/600x340/6b2fa0/fff?text=' . urlencode($kelas->nama_matkul) }}"
                                class="img-fluid rounded" alt="{{ $kelas->nama_matkul }}">
                            <span class="time-badge">
                                {{ Carbon::parse($jadwal->tanggal)->format('d M Y') }}
                            </span>
                        </div>

                        <!-- Class Info -->
                        <p class="small text-white-50 mb-1">Jadwal Kelas</p>
                        <h2 class="h3 text-white fw-bold">
                            {{ $kelas->nama_matkul }}
                        </h2>

                        <!-- Class Time and Location -->
                        <div class="mb-3">
                            <p class="text-secondary mb-2">
                                <i class="bi bi-clock me-2"></i>
                                <strong>Waktu:</strong>
                                {{ Carbon::parse($jadwal->jam_mulai)->format('H:i') }} -
                                {{ Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                            </p>
                            <p class="text-secondary mb-0">
                                <i class="bi bi-geo-alt me-2"></i>
                                <strong>Lokasi:</strong>
                                {{ $kelas->tempat ?? 'Lokasi belum ditentukan' }}
                            </p>
                        </div>

                        <hr class="border-secondary my-4">

                        <!-- Description -->
                        <h5 class="text-white mb-3">Deskripsi Kelas</h5>
                        <p class="text-white-50">
                            {{ $kelas->deskripsi ?? 'Deskripsi kelas tidak tersedia.' }}
                        </p>

                        <hr class="border-secondary my-4">

                        <!-- Action Button -->
                        <button class="btn btn-primary w-100 mb-2">
                            <i class="bi bi-bookmark me-2"></i>Simpan Jadwal
                        </button>
                        <button class="btn btn-outline-primary w-100">
                            <i class="bi bi-share me-2"></i>Bagikan
                        </button>
                    </div>
                </div>

                <!-- Right Preview Content -->
                <div class="col-lg-8">
                    <div class="video-player">
                        <!-- Class Banner/Video -->
                        <div class="ratio ratio-16x9 mb-4">
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                <div class="text-center text-white">
                                    <i class="bi bi-play-circle"></i>
                                    <p class="mt-3 mb-0">Video Preview Kelas Akan Segera Hadir</p>
                                </div>
                            </div>
                        </div>

                        <!-- Class Details Section -->
                        <div class="card bg-dark border-secondary">
                            <div class="card-body">
                                <h4 class="text-white mb-4">Detail Kelas</h4>

                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <p class="text-white-50 mb-1">
                                            <i class="bi bi-calendar-event me-2"></i>Tanggal
                                        </p>
                                        <p class="text-white fw-bold">
                                            {{ Carbon::parse($jadwal->tanggal)->isoFormat('D MMMM Y') }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <p class="text-white-50 mb-1">
                                            <i class="bi bi-clock me-2"></i>Durasi Kelas
                                        </p>
                                        <p class="text-white fw-bold">
                                            @php
                                                $start = Carbon::parse($jadwal->jam_mulai);
                                                $end = Carbon::parse($jadwal->jam_selesai);
                                                $duration = $start->diffInMinutes($end);
                                                echo intdiv($duration, 60) . ' jam ' . $duration % 60 . ' menit';
                                            @endphp
                                        </p>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <p class="text-white-50 mb-1">
                                            <i class="bi bi-geo-alt me-2"></i>Tempat
                                        </p>
                                        <p class="text-white fw-bold">
                                            {{ $kelas->tempat ?? 'Lokasi belum ditentukan' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <p class="text-white-50 mb-1">
                                            <i class="bi bi-bookmark me-2"></i>Kategori
                                        </p>
                                        <p class="text-white fw-bold">
                                            {{ $matkul->jurusan->nama_jurusan ?? 'Umum' }}
                                        </p>
                                    </div>
                                </div>

                                <hr class="border-secondary">

                                <!-- Mentor Info -->
                                <div class="mt-4">
                                    <h5 class="text-white mb-3">Instruktur</h5>
                                    <div class="d-flex align-items-center">
                                        <img src="https://placehold.co/50x50/6b2fa0/fff?text={{ urlencode(substr($matkul->mentor->nama ?? 'Mentor', 0, 1)) }}"
                                            class="rounded-circle me-3" alt="{{ $matkul->mentor->nama ?? 'Mentor' }}"
                                            width="50" height="50">
                                        <div>
                                            <p class="text-white fw-bold mb-0">{{ $matkul->mentor->nama ?? 'Mentor' }}
                                            </p>
                                            <small class="text-white-50">Instruktur</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                    </ul>
                </div>
            </div>
            <div
                class="d-flex justify-content-between align-items-center mt-4 border-top border-secondary-subtle pt-4">
                <p class="mb-0">&copy; 2025 Jago Teknik</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function handleBackButton() {
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
