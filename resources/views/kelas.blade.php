<!--
 * Author : Akhtar Zia Faizarrobbi (NRP 5026231095)
 * Desc   : Kelas
 * Date   : 2025-11-04
-->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>JagoTeknik • Kelas</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Page CSS -->
  <link href="css/kelas.css" rel="stylesheet" />
</head>
<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg sticky-top shadow-sm navbar-dark bg-transparent">
    <div class="container py-2">
      <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
        <span class="brand-mark d-inline-flex align-items-center justify-content-center"><i class="bi bi-mortarboard text-dark"></i></span>
        Jago <span class="text-primary">Teknik</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-3 me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
          <li class="nav-item"><a class="nav-link active" href="#">Kelas</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Jadwal</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Chat</a></li>
        </ul>
        <form class="d-none d-lg-flex search-wide" role="search">
          <div class="input-group">
            <span class="input-group-text bg-dark-subtle border-0"><i class="bi bi-search"></i></span>
            <input class="form-control bg-dark-subtle border-0" type="search" placeholder="Cari di JagoTeknik" aria-label="Search">
          </div>
        </form>
        <div class="ms-3">
          <img src="https://i.pravatar.cc/40?img=14" class="rounded-circle" alt="Profil" width="36" height="36" />
        </div>
      </div>
    </div>
  </nav>

  <main class="container py-4 py-lg-5">
    <div class="mb-3">
      <a href="#" class="btn btn-sm btn-outline-light"><i class="bi bi-chevron-left"></i> Back</a>
    </div>

    <h1 class="page-title">Kelas Jago Teknik</h1>

    <!-- Category Tabs -->
    <ul class="nav nav-underline justify-content-center gap-3 my-3 kelas-tabs" id="kelasTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="semua-tab" data-bs-toggle="tab" data-bs-target="#semua" type="button" role="tab">Semua</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="diikuti-tab" data-bs-toggle="tab" data-bs-target="#diikuti" type="button" role="tab">Di ikuti</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="selesai-tab" data-bs-toggle="tab" data-bs-target="#selesai" type="button" role="tab">Selesai</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="wishlist-tab" data-bs-toggle="tab" data-bs-target="#wishlist" type="button" role="tab">Wishlist</button>
      </li>
    </ul>

    <div class="tab-content mt-4">
      <!-- SEMUA -->
      <div class="tab-pane fade show active" id="semua" role="tabpanel">
        <div class="section-head">
          <h5>Semua kelas</h5>
          <p class="text-secondary">Lihat semua kelas yang ada di jagoteknik</p>
        </div>
        <div class="row g-4">
          <!-- repeat course card -->
          <div class="col-md-6 col-lg-3">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=1200" alt="Kalkulus">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Kalkulus 2</div>
                <div class="progress slim"><div class="progress-bar" style="width:60%"></div></div>
                <div class="meta">Lesson 5 of 7</div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1518307418455-0f0f60f52f12?q=80&w=1200" alt="Fisika">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Fisika</div>
                <div class="progress slim"><div class="progress-bar" style="width:45%"></div></div>
                <div class="meta">Lesson 5 of 7</div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?q=80&w=1200" alt="Kimia">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Kimia</div>
                <div class="progress slim"><div class="progress-bar" style="width:25%"></div></div>
                <div class="meta">Daftar kelas ini</div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1518779578993-ec3579fee39f?q=80&w=1200" alt="Pemrograman">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Pemrograman</div>
                <div class="progress slim"><div class="progress-bar" style="width:80%"></div></div>
                <div class="meta">Lesson 5 of 7</div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1517433456452-f9633a875f6f?q=80&w=1200" alt="Database">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Database</div>
                <div class="progress slim"><div class="progress-bar" style="width:55%"></div></div>
                <div class="meta">Lesson 5 of 7</div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1581091012432-1f37c6f4c5d6?q=80&w=1200" alt="Sistem Elektrik">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Sistem Elektrik</div>
                <div class="progress slim"><div class="progress-bar" style="width:20%"></div></div>
                <div class="meta">Daftar kelas ini</div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?q=80&w=1200" alt="Jaringan Komputer">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Jaringan Komputer</div>
                <div class="progress slim"><div class="progress-bar" style="width:100%"></div></div>
                <div class="meta">Completed</div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1615485737654-3b4310a46f79?q=80&w=1200" alt="Biologi">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Biologi</div>
                <div class="progress slim"><div class="progress-bar" style="width:12%"></div></div>
                <div class="meta">Daftar kelas ini</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- DIAKUTI -->
      <div class="tab-pane fade" id="diikuti" role="tabpanel">
        <div class="section-head">
          <h5>Kelas kamu</h5>
          <p class="text-secondary">Daftar kelas yang kamu ikuti</p>
        </div>
        <div class="row g-4">
          <!-- subset of cards -->
          <div class="col-md-6 col-lg-4">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=1200" alt="Kalkulus 2">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Kalkulus 2</div>
                <div class="progress slim"><div class="progress-bar" style="width:60%"></div></div>
                <div class="meta">Lesson 5 of 7</div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1518307418455-0f0f60f52f12?q=80&w=1200" alt="Fisika">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Fisika</div>
                <div class="progress slim"><div class="progress-bar" style="width:45%"></div></div>
                <div class="meta">Lesson 5 of 7</div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1518779578993-ec3579fee39f?q=80&w=1200" alt="Pemrograman">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Pemrograman</div>
                <div class="progress slim"><div class="progress-bar" style="width:80%"></div></div>
                <div class="meta">Lesson 5 of 7</div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1517433456452-f9633a875f6f?q=80&w=1200" alt="Database">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Database</div>
                <div class="progress slim"><div class="progress-bar" style="width:55%"></div></div>
                <div class="meta">Lesson 5 of 7</div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1615271796558-4f22c8b5a8a0?q=80&w=1200" alt="Algoritma">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Algoritma Struktur Data</div>
                <div class="progress slim"><div class="progress-bar" style="width:35%"></div></div>
                <div class="meta">Lesson 5 of 7</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- SELESAI -->
      <div class="tab-pane fade" id="selesai" role="tabpanel">
        <div class="section-head">
          <h5>Kelas selesai</h5>
          <p class="text-secondary">Lihat semua kelas kamu yang sudah selesai</p>
        </div>
        <div class="row g-4">
          <div class="col-md-6 col-lg-4">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?q=80&w=1200" alt="Jaringan Komputer">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Jaringan Komputer</div>
                <div class="progress slim"><div class="progress-bar" style="width:100%"></div></div>
                <div class="meta">Completed</div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=1200" alt="Matematika 1">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Matematika 1</div>
                <div class="progress slim"><div class="progress-bar" style="width:100%"></div></div>
                <div class="meta">Completed</div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1596495578065-8ae0b9c1f1f5?q=80&w=1200" alt="Etika TI">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Etika TI</div>
                <div class="progress slim"><div class="progress-bar" style="width:100%"></div></div>
                <div class="meta">Completed</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- WISHLIST -->
      <div class="tab-pane fade" id="wishlist" role="tabpanel">
        <div class="section-head">
          <h5>Kelas yang mau di ikuti</h5>
          <p class="text-secondary">Lihat daftar kelas yang sudah kamu masukkan kedalam wishlist</p>
        </div>
        <div class="row g-4">
          <div class="col-md-6 col-lg-3">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?q=80&w=1200" alt="Kimia">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Kimia</div>
                <div class="progress slim"><div class="progress-bar" style="width:10%"></div></div>
                <div class="meta">Daftar kelas ini</div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1581091012432-1f37c6f4c5d6?q=80&w=1200" alt="Sistem Elektrik">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Sistem Elektrik</div>
                <div class="progress slim"><div class="progress-bar" style="width:15%"></div></div>
                <div class="meta">Daftar kelas ini</div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1615485737654-3b4310a46f79?q=80&w=1200" alt="Biologi">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Biologi</div>
                <div class="progress slim"><div class="progress-bar" style="width:12%"></div></div>
                <div class="meta">Daftar kelas ini</div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="course shadow-sm">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1518307418455-0f0f60f52f12?q=80&w=1200" alt="Fisika Terapan">
                <button class="btn btn-sm btn-more"><i class="bi bi-three-dots-vertical"></i></button>
              </div>
              <div class="course-body">
                <div class="title">Fisika Terapan</div>
                <div class="progress slim"><div class="progress-bar" style="width:5%"></div></div>
                <div class="meta">Daftar kelas ini</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
