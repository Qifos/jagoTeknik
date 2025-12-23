<!DOCTYPE html>
<!--
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231196)
 * Desc   : Mentor View
-->
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>JagoTeknik — Tutor</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  {{-- Navbar homepage --}}
  <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
  <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
  <link rel="stylesheet" href="{{ asset('css/personalisasi.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

  <style>
    body{ background:#000; color:#fff; }
    .mentor-wrap{ padding: 42px 0 56px; }
    .back-btn{
      background:#fff; color:#111; border:0; border-radius:8px;
      padding:10px 18px; font-weight:600;
    }

    .search-label{ color:#cfcfcf; font-size:.9rem; margin-bottom:8px; }
    .search-box-mentor{
      background:#8f89c5; border:1px solid rgba(255,255,255,.25);
      border-radius:0; height:44px; color:#fff;
      padding-left:44px;
    }
    .search-ico{
      position:absolute; left:14px; top:50%; transform:translateY(-50%);
      color:#fff; opacity:.9;
    }
    .mentor-title{
      text-align:center; font-weight:700; letter-spacing:.2px;
      margin: 14px 0 18px;
    }
    .filters-row .form-select{
      background:transparent; color:#fff;
      border:0; border-bottom:1px solid rgba(255,255,255,.35);
      border-radius:0;
      padding-left:0;
    }
    .filters-row label{ color:#cfcfcf; font-size:.85rem; }

    /* Card Tutor */
    .tutor-card{
      background:transparent;
      border:1px solid rgba(255,255,255,.10);
      overflow:hidden;
    }
    .tutor-photo{
      width:100%;
      aspect-ratio: 4/4.2;
      object-fit:cover;
      background:#111;
    }
    .tutor-mid{
      background:#5b3a6b;
      padding:14px 12px 12px;
      text-align:center;
    }
    .tutor-name{ font-weight:700; font-size:1.05rem; margin:0; }
    .tutor-dept{ opacity:.9; margin:0; font-size:.9rem; }

    .tutor-stats{
      background:#4c2f5a;
      display:flex; justify-content:space-between; align-items:center;
      padding:10px 12px;
      font-size:.9rem;
      border-top:1px solid rgba(255,255,255,.10);
    }
    .tutor-stats i{ margin-right:6px; }
    .tutor-btn{
      width:100%;
      border-radius:0;
      background:#9a93cf;
      color:#fff;
      border:0;
      padding:10px 12px;
      font-weight:600;
    }
    .tutor-btn:hover{ filter:brightness(1.05); }

    .pagination .page-link{ background:transparent; color:#fff; border-color:rgba(255,255,255,.15); }
    .pagination .active>.page-link{ background:#5b3a6b; border-color:#5b3a6b; }
  </style>
</head>

<body>
  {{-- NAVBAR HOMEPAGE --}}
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
          <li class="nav-item"><a class="nav-link" href="{{route('homepage')}}">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('kelas.semua') }}">Kelas</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('jadwal.index') }}">Jadwal</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('chat.index') }}">Chat</a></li>
          <li class="nav-item">
            <form class="d-flex mx-3">
              <div class="search-box">
                <input class="form-control" type="search" placeholder="Cari di JagoTeknik">
                <i class="bi bi-search"></i>
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

  <div class="mentor-wrap">
    <div class="container">

      <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
        <div style="min-width:260px">
          <a href="{{ url()->previous() }}" class="btn back-btn">&lt; Back</a>

          <div class="mt-4">
            <div class="search-label">Search:</div>
            <form method="GET" action="{{ route('mentor.index') }}" class="position-relative">
              <i class="bi bi-search search-ico"></i>
              <input name="q" value="{{ $q ?? '' }}" class="form-control search-box-mentor" placeholder="Cari tutor anda..." />
              {{-- keep dropdown params --}}
              @if(!empty($matkul)) <input type="hidden" name="matkul" value="{{ $matkul }}"> @endif
              @if(!empty($jurusan)) <input type="hidden" name="jurusan" value="{{ $jurusan }}"> @endif
            </form>
          </div>
        </div>

        <div class="flex-grow-1">
          <h1 class="mentor-title">Tutor ({{ $mentors->total() }})</h1>

          <form method="GET" action="{{ route('mentor.index') }}" class="filters-row row g-4 align-items-end mb-4">
            <input type="hidden" name="q" value="{{ $q ?? '' }}">
            <div class="col-12 col-md-6 col-lg-4">
              <label class="d-block mb-2">Mata Kuliah:</label>
              <select name="matkul" class="form-select" onchange="this.form.submit()">
                <option value="">Pilih tipe mata kuliah</option>
                @foreach($matkuls as $mk)
                  <option value="{{ $mk->id_matkul }}" @selected((string)$matkul === (string)$mk->id_matkul)>
                    {{ $mk->nama_matkul }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-12 col-md-6 col-lg-4 ms-lg-auto">
              <label class="d-block mb-2">Jurusan:</label>
              <select name="jurusan" class="form-select" onchange="this.form.submit()">
                <option value="">Pilih Jurusan</option>
                @foreach($jurusans as $j)
                  <option value="{{ $j->id_jurusan }}" @selected((string)$jurusan === (string)$j->id_jurusan)>
                    {{ $j->nama_jurusan }}
                  </option>
                @endforeach
              </select>
            </div>
          </form>

          <div class="row g-4">
            @forelse($mentors as $m)
              <div class="col-12 col-md-6 col-lg-3">
                <div class="tutor-card">
                  <img class="tutor-photo"
                       src="{{ $m->foto_profil ?: 'https://i.pravatar.cc/300?img=11' }}"
                       alt="{{ $m->nama }}">

                  <div class="tutor-mid">
                    <p class="tutor-name">{{ $m->nama }}</p>
                    <p class="tutor-dept">{{ $m->nama_jurusan ?? '-' }}</p>
                  </div>

                  <div class="tutor-stats">
                    <span><i class="bi bi-star-fill"></i>{{ number_format((float)($m->rating ?? 0), 1) }}</span>
                    <span>{{ number_format((int)($m->jumlah_kelas ?? 0), 0, ',', '.') }} kelas</span>
                  </div>

                  <a class="btn tutor-btn" href="{{ route('mentor.show', $m->id_mentor) }}">Cek Profil</a>
                </div>
              </div>
            @empty
              <div class="col-12">
                <div class="text-center text-secondary py-5">
                  Tutor tidak ditemukan.
                </div>
              </div>
            @endforelse
          </div>

          <div class="d-flex justify-content-center mt-4">
            {{ $mentors->links() }}
          </div>

        </div>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
