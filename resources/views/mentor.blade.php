<!DOCTYPE html>
<!--
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231196)
 * Desc   : Mentor View
-->
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JagoTeknik — Tutor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Navbar homepage --}}
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/personalisasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    {{-- CSS khusus mentor list --}}
    <link rel="stylesheet" href="{{ asset('css/mentor.css') }}">
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('homepage') }}">Beranda</a></li>
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
                            <input name="q" value="{{ $q ?? '' }}" class="form-control search-box-mentor"
                                placeholder="Cari tutor anda..." />
                            {{-- keep dropdown params --}}
                            @if (!empty($matkul))
                                <input type="hidden" name="matkul" value="{{ $matkul }}">
                            @endif
                            @if (!empty($jurusan))
                                <input type="hidden" name="jurusan" value="{{ $jurusan }}">
                            @endif
                        </form>
                    </div>
                </div>

                <div class="flex-grow-1">
                    <h1 class="mentor-title">Tutor ({{ $mentors->total() }})</h1>

                    <form method="GET" action="{{ route('mentor.index') }}"
                        class="filters-row row g-4 align-items-end mb-4">
                        <input type="hidden" name="q" value="{{ $q ?? '' }}">
                        <div class="col-12 col-md-6 col-lg-4">
                            <label class="d-block mb-2">Mata Kuliah:</label>
                            <select name="matkul" class="form-select" onchange="this.form.submit()">
                                <option value="">Pilih tipe mata kuliah</option>
                                @foreach ($matkuls as $mk)
                                    <option value="{{ $mk->id_matkul }}" @selected((string) $matkul === (string) $mk->id_matkul)>
                                        {{ $mk->nama_matkul }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4 ms-lg-auto">
                            <label class="d-block mb-2">Jurusan:</label>
                            <select name="jurusan" class="form-select" onchange="this.form.submit()">
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusans as $j)
                                    <option value="{{ $j->id_jurusan }}" @selected((string) $jurusan === (string) $j->id_jurusan)>
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
                                        src="{{ !empty($m->image_mentor) ? asset($m->image_mentor) : (!empty($m->foto_profil) ? $m->foto_profil : 'https://i.pravatar.cc/300?img=11') }}"
                                        alt="{{ $m->nama }}">
                                    <div class="tutor-mid">
                                        <p class="tutor-name">{{ $m->nama }}</p>
                                        <p class="tutor-dept">{{ $m->nama_jurusan ?? '-' }}</p>
                                    </div>

                                    <div class="tutor-stats">
                                        <span><i
                                                class="bi bi-star-fill"></i>{{ number_format((float) ($m->rating ?? 0), 1) }}</span>
                                        <span>{{ number_format((int) ($m->jumlah_kelas ?? 0), 0, ',', '.') }}
                                            kelas</span>
                                    </div>

                                    <a class="btn tutor-btn" href="{{ route('mentor.show', $m->id_mentor) }}">Cek
                                        Profil</a>
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
