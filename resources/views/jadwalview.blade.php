<!--
 * Author : Akhtar Zia Faizarrobbi (NRP 5026231095)
 * Desc   : Jadwal View
 * Date   : 2025-11-04
-->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>JagoTeknik • Jadwal</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- App CSS -->
  <link rel="stylesheet" href="{{ asset('css/jadwal.css') }}">
</head>
<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
    <div class="container py-2">
      <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
        <span class="brand-mark d-inline-flex align-items-center justify-content-center">
          <i class="bi bi-journal-code text-dark"></i>
        </span>
        Jago<span class="text-primary">Teknik</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-3 me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Kelas</a></li>
          <li class="nav-item"><a class="nav-link active" href="#">Jadwal</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Chat</a></li>
        </ul>
        <form class="d-none d-lg-flex search-wide" role="search">
          <div class="input-group">
            <span class="input-group-text bg-dark-subtle border-0"><i class="bi bi-search"></i></span>
            <input class="form-control bg-dark-subtle border-0" type="search" placeholder="Cari di JagoTeknik" aria-label="Search">
          </div>
        </form>
        <div class="ms-3">
          <img src="https://i.pravatar.cc/40?img=12" class="rounded-circle" alt="Profil" width="36" height="36" />
        </div>
      </div>
    </div>
  </nav>

  <main class="container py-4 py-lg-5">
    <!-- Back Button -->
    <div class="mb-3">
      <a href="#" class="btn btn-sm btn-outline-light"><i class="bi bi-chevron-left"></i> Back</a>
    </div>

    <!-- Title -->
    <h1 class="display-6 headline mb-4">Kelas yang akan datang</h1>

    <div class="row g-4 align-items-stretch">
      <!-- Left: Upcoming class details -->
      <div class="col-lg-5">
        <div class="panel-surface h-100 d-flex flex-column align-items-center justify-content-center text-center p-4 p-lg-5">
          <div class="class-pill mb-3">
            <i class="bi bi-alarm"></i>
          </div>
          <h5 class="mb-1">Data Lakehouse</h5>
          <div class="text-secondary mb-3">Ikhwanul Hafidz</div>
          <div class="fs-4 fw-bold">TW1 - 705</div>
        </div>
      </div>

      <!-- Right: Calendar -->
      <div class="col-lg-7">
        <div class="calendar h-100">
          <div class="cal-top mb-3">
            <button class="btn navbtn" aria-label="Prev"><i class="bi bi-chevron-left text-light"></i></button>
            <div class="d-flex gap-2 align-items-center">
              <span class="month-chip">June</span>
              <span class="month-chip">2025</span>
            </div>
            <button class="btn navbtn" aria-label="Next"><i class="bi bi-chevron-right text-light"></i></button>
          </div>

          <!-- Week header -->
          <div class="grid mb-2">
            <div class="cell head">Mo</div>
            <div class="cell head">Tu</div>
            <div class="cell head">We</div>
            <div class="cell head">Th</div>
            <div class="cell head">Fr</div>
            <div class="cell head">Sa</div>
            <div class="cell head">Su</div>
          </div>

          <!-- Dates -->
          <div class="grid">
            <!-- row 1 (end of May) -->
            <div class="cell muted">29</div>
            <div class="cell muted">30</div>
            <div class="cell muted">31</div>
            <div class="cell">1</div>
            <div class="cell">2</div>
            <div class="cell">3</div>
            <div class="cell">4</div>
            <!-- row 2 -->
            <div class="cell">5</div>
            <div class="cell">6</div>
            <div class="cell">7</div>
            <div class="cell">8</div>
            <div class="cell">9</div>
            <div class="cell">10</div>
            <div class="cell">11</div>
            <!-- row 3 -->
            <div class="cell">12</div>
            <div class="cell">13</div>
            <div class="cell active">14</div>
            <div class="cell">15</div>
            <div class="cell">16</div>
            <div class="cell">17</div>
            <div class="cell">18</div>
            <!-- row 4 -->
            <div class="cell">19</div>
            <div class="cell">20</div>
            <div class="cell">21</div>
            <div class="cell">22</div>
            <div class="cell">23</div>
            <div class="cell">24</div>
            <div class="cell">25</div>
            <!-- row 5 -->
            <div class="cell">26</div>
            <div class="cell">27</div>
            <div class="cell">28</div>
            <div class="cell">29</div>
            <div class="cell">30</div>
            <div class="cell muted">1</div>
            <div class="cell muted">2</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Next classes -->
    <h2 class="display-6 headline mt-5 mb-4">Jadwal Kelas Selanjutnya</h2>

    <div class="row g-4">
      <div class="col-md-6 col-lg-4">
        <div class="course-card p-4 h-100 d-flex flex-column">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="thumb"><i class="bi bi-hexagon fs-2 text-secondary"></i></div>
            <div>
              <h5 class="mb-1">Kalkulus 1</h5>
              <span class="badge badge-cat">Matematika</span>
            </div>
          </div>
          <p class="text-secondary mb-0">Belajar kalkulus untuk meraih perhitungan yang…</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="course-card p-4 h-100 d-flex flex-column">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="thumb"><i class="bi bi-snow fs-2 text-secondary"></i></div>
            <div>
              <h5 class="mb-1">Fisika 1</h5>
              <span class="badge badge-cat">Fisika</span>
            </div>
          </div>
          <p class="text-secondary mb-0">Pahami dasar-dasar dari hukum fisika, dan temuk…</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="course-card p-4 h-100 d-flex flex-column">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="thumb"><i class="bi bi-grid-1x2 fs-2 text-secondary"></i></div>
            <div>
              <h5 class="mb-1">Aljabar Linier</h5>
              <span class="badge badge-cat">Matematika</span>
            </div>
          </div>
          <p class="text-secondary mb-0">Pelajari dasar-dasar aljabar linier dan perhit…</p>
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
