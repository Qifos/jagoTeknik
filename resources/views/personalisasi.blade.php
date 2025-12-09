<!--
 * Author : Faiz Hazmi Maulana (NRP 502623120)
 * Desc   : Personalisasi
 * Date   : 2025-11-30
-->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Jago Teknik</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/personalisasi.css">
    <link rel="stylesheet" href="css/footer.css">
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
                        <a class="nav-link active d-flex align-items-center" href="{{ url('/personalisasi') }}">
                            <img src="{{ asset('image/profile.jpg') }}" alt="Profile" class="profile-img">
                            <span class="ms-2">Profil</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <section class="main-section">
        <div class="container py-1">
            <!-- Back Button -->
            <button class="btn btn-back mb-4">
                <i class="bi bi-chevron-left"></i> Back
            </button>

            <!-- Page Title -->
            <h1 class="page-title text-center mb-4">My Account</h1>

            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs custom-tabs justify-content-center mb-1" id="accountTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profil-tab" data-bs-toggle="tab"
                            data-bs-target="#profil" type="button" role="tab">
                        Profil
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="personalisasi-tab" data-bs-toggle="tab"
                            data-bs-target="#personalisasi" type="button" role="tab">
                        Personalisasi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="notifikasi-tab" data-bs-toggle="tab"
                            data-bs-target="#notifikasi" type="button" role="tab">
                        Notifikasi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="privasi-tab" data-bs-toggle="tab"
                            data-bs-target="#privasi" type="button" role="tab">
                        Privasi
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="accountTabContent">
                <!-- Profil Tab -->
                <div class="tab-pane fade show active" id="profil" role="tabpanel">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8">
                            <div class="profile-form">
                                <!-- Profile Photo -->
                                <div class="text-center mb-4">
                                    <div class="profile-photo-wrapper">
                                        <img src="profile.jpg" alt="Profile Photo" class="profile-photo">
                                        <button class="btn-edit-photo">
                                            <i class="bi bi-camera-fill"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Form Fields -->
                                <form>
                                    <div class="mb-4">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control custom-input" id="nama" placeholder="Masukkan nama Anda">
                                    </div>

                                    <div class="mb-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control custom-input" id="email" placeholder="Masukkan email Anda">
                                    </div>

                                    <div class="mb-4">
                                        <label for="nomor-hp" class="form-label">Nomor HP</label>
                                        <input type="tel" class="form-control custom-input" id="nomor-hp" placeholder="Masukkan nomor HP Anda">
                                    </div>

                                    <div class="mb-4">
                                        <label for="angkatan" class="form-label">Angkatan</label>
                                        <input type="text" class="form-control custom-input" id="angkatan" placeholder="Masukkan angkatan Anda">
                                    </div>

                                    <div class="mb-4">
                                        <label for="tanggal-lahir" class="form-label">Tanggal lahir</label>
                                        <input type="date" class="form-control custom-input" id="tanggal-lahir">
                                    </div>

                                    <!-- Save Button -->
                                    <div class="text-center mt-5">
                                        <button type="submit" class="btn btn-save">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                  <!-- Personalisasi Tab -->
                <div class="tab-pane fade" id="personalisasi" role="tabpanel">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8">
                            <div class="profile-form">
                                <form>
                                    <div class="mb-4">
                                        <label for="jurusan" class="form-label">Jurusan</label>
                                        <input type="text" class="form-control custom-input" id="jurusan" placeholder="Masukkan jurusan Anda">
                                    </div>

                                    <div class="mb-4">
                                        <label for="universitas" class="form-label">Universitas</label>
                                        <input type="text" class="form-control custom-input" id="universitas" placeholder="Masukkan universitas anda">
                                    </div>

                                    <div class="mb-4">
                                        <label for="kelamin" class="form-label">Kelamin</label>
                                        <select class="form-select custom-select" id="kelamin">
                                            <option selected>Pilih jenis kelamin anda</option>
                                            <option value="laki-laki">Laki-laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label for="bahasa" class="form-label">Bahasa</label>
                                        <select class="form-select custom-select" id="bahasa">
                                            <option selected>Pilih bahasa</option>
                                            <option value="indonesia">Bahasa Indonesia</option>
                                            <option value="english">English</option>
                                            <option value="mandarin">Mandarin</option>
                                        </select>
                                    </div>

                                    <!-- Save Button -->
                                    <div class="text-center mt-5">
                                        <button type="submit" class="btn btn-save">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notifikasi Tab. Akhtar Zia Faizarrobbi (5026231095) -->
                <div class="tab-pane fade" id="notifikasi" role="tabpanel">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8">
                            <div class="profile-form">
                                <p class="notif-title">Atur notifikasi dari Jago Teknik</p>

                                <div class="notif-list">
                                    <div class="form-check form-switch notif-row">
                                        <input class="form-check-input notif-switch" type="checkbox" role="switch" id="notif_reminder_kelas">
                                        <label class="form-check-label notif-label" for="notif_reminder_kelas">Reminder kelas</label>
                                    </div>

                                    <div class="form-check form-switch notif-row">
                                        <input class="form-check-input notif-switch" type="checkbox" role="switch" id="notif_reminder_belajar">
                                        <label class="form-check-label notif-label" for="notif_reminder_belajar">Reminder belajar</label>
                                    </div>

                                    <div class="form-check form-switch notif-row">
                                        <input class="form-check-input notif-switch" type="checkbox" role="switch" id="notif_live_chat">
                                        <label class="form-check-label notif-label" for="notif_live_chat">Live chat</label>
                                    </div>

                                    <div class="form-check form-switch notif-row">
                                        <input class="form-check-input notif-switch" type="checkbox" role="switch" id="notif_promosi">
                                        <label class="form-check-label notif-label" for="notif_promosi">Promosi</label>
                                    </div>
                                </div>
                                <!-- Save Button -->
                                <div class="text-center mt-5">
                                    <button type="button" class="btn btn-save" onclick="redirectToHome()">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- Privasi Tab. Sinta Dewi Rahmawati (5026231231) -->
                <div class="tab-pane fade" id="privasi" role="tabpanel">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8">
                            <div class="profile-form">
                                <!-- Password Hash Field with Eye Icon -->
                                <div class="mb-1 position-relative">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control custom-input password-field" id="password" value="********" readonly>
                                    <i class="bi bi-eye-slash toggle-password" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                </div>
                                <!-- Privacy Settings -->
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="share-browser-data">
                                        <label class="form-check-label" for="share-browser-data">
                                            Bagikan data browser untuk personalisasi yang lebih baik
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="disable-read" checked>
                                        <label class="form-check-label" for="disable-read">
                                            Matikan Read dalam chat
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="hide-status">
                                        <label class="form-check-label" for="hide-status">
                                            Sembunyikan status saat online
                                        </label>
                                    </div>
                                </div>

                                <!-- Save Button -->
                                <div class="text-center mt-5">
                                    <button type="button" class="btn btn-save" onclick="redirectToHome()">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
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

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        if (togglePassword && passwordField) {
            togglePassword.addEventListener('click', function() {
                const type = passwordField.type === 'password' ? 'text' : 'password';
                passwordField.type = type;

                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
            });
        }
        const checkboxIds = ['share-browser-data', 'disable-read', 'hide-status'];
        checkboxIds.forEach(id => {
            const checkbox = document.getElementById(id);
            if (!checkbox) return;

            const storageKey = 'privacy_' + id;
            const savedValue = localStorage.getItem(storageKey);
            if (savedValue !== null) {
                checkbox.checked = savedValue === 'true';
            }
            checkbox.addEventListener('change', function () {
                localStorage.setItem(storageKey, this.checked);
            });
        });
    });
    function redirectToHome() {
        window.location.href = "{{ route('homepage') }}";
    }
    </script>

</body>
</html>
