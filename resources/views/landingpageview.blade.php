<!--
 * Author : Sinta Dewi Rahmawati (NRP 5026231231)
 * Desc   : Landing Page View
 * Date   : 2025-11-04
-->

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Jago Teknik — Kuliah Teknik Jadi Easy</title>
  <meta name="description" content="Platform bimbingan belajar mata kuliah teknik dasar terbaik. Tutor berkualitas, materi terbaru, dan soal HOTS." />

  <!-- Bootstrap 5 + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">

</head>
<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container py-2">
      <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
        <span class="rounded-circle d-inline-block" style="width:28px;height:28px;background:linear-gradient(135deg,var(--brand-1),var(--brand-2));"></span>
        Jago<span class="accent">Teknik</span>
      </a>

      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
          <li class="nav-item"><a class="nav-link active" href="#">Beranda</a></li>
          <li class="nav-item d-none d-lg-block">
            <form class="d-flex" role="search" onsubmit="return false;">
              <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0 text-secondary"><i class="bi bi-search"></i></span>
                <input class="form-control border-start-0" type="search" placeholder="Cari di JagoTeknik" aria-label="Cari" />
              </div>
            </form>
          </li>
          <li class="nav-item">
            <a href="{{ route('login.view') }}" class="btn btn-outline-light rounded-pill px-3 py-2">
                Login
            </a>
        </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- LANDING HERO -->
  <header class="landing-hero pt-5">
    <div class="container position-relative" style="z-index:1;">
      <div class="row align-items-center min-vh-100 pb-5 pb-lg-0">

        <!-- Left copy -->
        <div class="col-lg-6 mt-5 mt-lg-0">
          <h1 class="display-4 display-title mb-3">
            Kuliah Teknik<br/>Jadi <span class="accent">Easy</span>
          </h1>
          <p class="lead muted pe-lg-5 mb-4">
            Platform bimbingan belajar mata kuliah Teknik dasar terbaik.
          </p>
          <div class="d-grid d-sm-inline-flex gap-3 align-items-center mb-5">
            <a href="{{ route('register.view') }}" class="btn btn-gradient fw-semibold">
                Daftar Sekarang
            </a>
          </div>

          <div class="d-flex flex-wrap gap-3">
            <div class="feature-pill"><i class="bi bi-award"></i><span>Tutor Berkualitas</span></div>
            <div class="feature-pill"><i class="bi bi-layers"></i><span>Materi Terbaru</span></div>
            <div class="feature-pill"><i class="bi bi-lightbulb"></i><span>Soal HOTS</span></div>
          </div>
        </div>

        <!-- Right visual -->
        <div class="col-lg-6 mt-5 mt-lg-0">
          <div class="position-relative mx-auto" style="max-width:520px;">
            <div class="landing-orb">
              <div class="landing-logo">
                <div class="logo-j">J</div>
                <div class="logo-text">ago<br/>Teknik</div>
                <div class="logo-url">jagoteknik.co</div>
              </div>
            </div>

            <!-- Image overlay -->
            <div class="landing-orb-image"></div>

            <!-- Stats -->
            <div class="landing-stat-card landing-stat-tutor">
              <div class="icon-wrapper">
                <img src="/image/landing-tutor.png" alt="Tutor" />
              </div>
              <div class="stat-content">
                <div class="title">Tutor</div>
                <div class="value">300+</div>
              </div>
            </div>
            <div class="landing-stat-card landing-stat-kelas">
              <div class="icon-wrapper">
                <img src="/image/landing-progress.png" alt="Kelas" />
              </div>
              <div class="title">Kelas</div>
              <div class="value">5K+</div>
            </div>
            <div class="landing-stat-card landing-stat-video">
              <div class="icon-wrapper">
                <img src="/image/landing-video.png" alt="Video" />
              </div>
              <div class="stat-content">
                <div class="title">Video Belajar</div>
                <div class="value">2K+</div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- INTRO: Apa itu Jago Teknik? -->
<section id="apa-jagoteknik" class="py-5">
  <div class="container text-center">
    <h1 class="fw-bold mb-3" style="letter-spacing:.2px;">
      Apa itu <span class="accent">Jago Teknik?</span>
    </h1>
    <p class="mx-auto text-secondary" style="max-width:900px">
      Jago Teknik adalah platform bimbingan belajar mata kuliah Teknik dasar,
      dengan lebih dari 300 member serta 300+ sesi belajar selama periode semester 2023/2024.
      Belajar fleksibel dan komprehensif, <strong>#KuliahTeknikJadiEasy</strong>
    </p>
  </div>
  <div class="container">

    <div class="row g-2">
      <!-- Kartu: Mentor -->
      <div class="col-12 col-lg-6">
        <div class="image-card border rounded-4 shadow-sm">
          <img
            src="{{ asset('image/landing-apa1.jpg') }}"
            alt="Masuk sebagai Mentor"
            class="img-fluid w-100 d-block rounded-4"
            loading="lazy"
            style="height:auto;"
          />
          <!-- gradasi agar teks jelas -->
          <div class="image-overlay-gradient"></div>

          <!-- tombol di atas gambar -->
          <div class="image-overlay-center">
            <h3 class="text-white mb-3">Untuk Mentor</h3>
            <a href="{{ route('login.view', ['as' => 'mentor']) }}"
               class="btn btn-outline-light rounded-pill px-4 py-2 stretched-link"
               aria-label="Login sebagai Mentor">
              Masuk Sekarang
            </a>
          </div>
        </div>
      </div>

      <!-- Kartu: Murid -->
      <div class="col-12 col-lg-6">
        <div class="image-card border rounded-4 shadow-sm">
          <img
            src="{{ asset('image/landing-apa2.jpg') }}"
            alt="Masuk sebagai Murid"
            class="img-fluid w-100 d-block rounded-4"
            loading="lazy"
            style="height:auto;"
          />
          <div class="image-overlay-gradient"></div>

          <div class="image-overlay-center">
             <h3 class="text-white mb-3">Untuk Murid</h3>
            <a href="{{ route('login.view', ['as' => 'murid']) }}"
               class="btn btn-gradient rounded-pill px-4 py-2 stretched-link"
               aria-label="Login sebagai Murid">
               Masuk Sekarang
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>



  </header>

  <!-- FOOTER -->
  <footer class="py-5 border-top border-opacity-25" style="border-color:var(--border)!important;">
    <div class="container small text-center text-secondary">
      © <span id="y"></span> JagoTeknik. All rights reserved.
    </div>
  </footer>

  <script>document.getElementById('y').textContent = new Date().getFullYear();</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
  </header>

  <!-- FOOTER -->
  <footer class="py-5 border-top border-opacity-25" style="border-color:var(--border)!important;">
    <div class="container small text-center text-secondary">
      © <span id="y"></span> JagoTeknik. All rights reserved.
    </div>
  </footer>

  <script>document.getElementById('y').textContent = new Date().getFullYear();</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
