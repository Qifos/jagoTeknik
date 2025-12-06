<!--
 * Author : Akhtar Zia Faizarrobbi (NRP 5026231095)
 * Desc   : Jadwal View (Interactive Calendar)
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

  <!-- Samakan navbar & style dengan Homepage -->
  <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
  <link rel="stylesheet" href="{{ asset('css/personalisasi.css') }}">
  <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">

  <!-- Style khusus Jadwal (harus TERAKHIR supaya override body/calendar dll) -->
  <link rel="stylesheet" href="{{ asset('css/jadwal.css') }}">
</head>

<body>
  <!-- Navbar (SAMA seperti homepage) -->
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
              <img src="{{ asset('profile.jpg') }}" alt="Profile" class="profile-img">
              <span class="ms-2">Profil</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container py-4 py-lg-5">
    <!-- Back Button -->
    <div class="mb-3">
      <a href="#" class="btn btn-sm btn-outline-light"><i class="bi bi-chevron-left"></i> Back</a>
    </div>

                <!-- Bagian Ni Kadek Adelia Paramita Putri (5026231196)
                =========================================================
                Section: Jadwal Kelas Terdekat - Halaman Jadwal
                ====================================================== -->

                @php
                    use Illuminate\Support\Facades\Auth;
                    use Illuminate\Support\Facades\DB;
                    use Carbon\Carbon;

                    $user = Auth::user();
                    $jadwalTerdekat = null;

                    if ($user) {
                        $userId = $user->id_user ?? $user->id;
                        $now = Carbon::now();
                        $today = $now->toDateString();
                        $currentTime = $now->format('H:i:s');

                        $jadwalTerdekat = DB::table('jadwal as j')
                            ->join('kelas as k', 'j.id_kelas', '=', 'k.id_kelas')
                            ->join('matkul as m', 'k.id_matkul', '=', 'm.id_matkul')
                            ->leftJoin('mentor as ment', 'm.id_mentor', '=', 'ment.id_mentor')
                            // hanya jadwal untuk matkul yang SUDAH dibeli user
                            ->join('beli_matkul as bm', function ($join) use ($userId) {
                                $join->on('bm.id_matkul', '=', 'm.id_matkul')
                                     ->where('bm.id_user', '=', $userId);
                            })
                            // hanya jadwal yang >= sekarang
                            ->where(function ($q) use ($today, $currentTime) {
                                $q->where('j.tanggal', '>', $today)
                                  ->orWhere(function ($q2) use ($today, $currentTime) {
                                      $q2->where('j.tanggal', '=', $today)
                                         ->where('j.jam_mulai', '>=', $currentTime);
                                  });
                            })
                            ->orderBy('j.tanggal')
                            ->orderBy('j.jam_mulai')
                            ->select(
                                'j.tanggal',
                                'j.jam_mulai',
                                'j.jam_selesai',
                                'k.tempat',
                                'm.nama_matkul',
                                'ment.nama as nama_mentor'
                            )
                            ->first();
                    }
                @endphp

                <!-- Title -->
                <h1 class="display-6 headline mb-4">Kelas yang akan datang</h1>

                <div class="row g-4 align-items-stretch">
                    <!-- Left: Upcoming class details -->
                    <div class="col-lg-5">
                        <div class="h-100 d-flex flex-column align-items-center justify-content-center text-center p-4"
                             style="background:var(--surface); border-radius:1rem; border:1px solid #26263a;">
                            <div class="class-pill mb-3">
                                <i class="bi bi-alarm"></i>
                            </div>

                            @if ($jadwalTerdekat)
                                <h5 class="mb-1">{{ $jadwalTerdekat->nama_matkul }}</h5>
                                <div class="text-secondary mb-2">
                                    {{ $jadwalTerdekat->nama_mentor ?? 'Mentor belum ditentukan' }}
                                </div>
                                <div class="text-secondary mb-2">
                                    {{ $jadwalTerdekat->tanggal ?? '-' }}
                                </div>
                                <div class="fs-6 mb-1">
                                    {{ \Carbon\Carbon::parse($jadwalTerdekat->jam_mulai)->format('H:i') }}
                                    — {{ \Carbon\Carbon::parse($jadwalTerdekat->jam_selesai)->format('H:i') }}
                                </div>
                                <div class="fs-5 fw-bold">
                                    {{ $jadwalTerdekat->tempat ?? 'Ruang belum ditentukan' }}
                                </div>

                            @else
                                <h5 class="mb-1">Belum ada jadwal terdekat</h5>
                                <div class="text-secondary mb-2">
                                    Ikuti kelas terlebih dahulu dari menu <strong>Kelas</strong>.
                                </div>
                            @endif
                        </div>
                    </div>
                <!-- Batas Bagian Ni Kadek Adelia Paramita Putri (5026231196)
                =========================================================
                Section: Jadwal Kelas Terdekat - Halaman Jadwal
                ====================================================== -->

      <!-- Right: Calendar (INTERAKTIF) -->
      <div class="col-lg-7">
        <!-- Kalau mau default ke bulan sekarang: HAPUS data-year & data-month -->
        <div class="calendar h-100" id="calendar" data-year="2025" data-month="5">
          <div class="cal-top mb-3">
            <button class="btn navbtn" id="calPrev" aria-label="Prev">
              <i class="bi bi-chevron-left text-light"></i>
            </button>

            <div class="d-flex gap-2 align-items-center">
              <span class="month-chip" id="calMonthLabel">June</span>
              <span class="month-chip" id="calYearLabel">2025</span>

              <!-- Optional: tombol balik ke hari ini -->
              <button class="btn btn-sm btn-outline-light ms-2" id="calToday" type="button">Today</button>
            </div>

            <button class="btn navbtn" id="calNext" aria-label="Next">
              <i class="bi bi-chevron-right text-light"></i>
            </button>
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

          <!-- Dates (diisi JS) -->
          <div class="grid" id="calGrid"></div>
        </div>
      </div>
    </div>

    <!-- Next classes -->
    <h2 class="display-6 headline mt-5 mb-4">Jadwal Kelas Selanjutnya</h2>

    @php
        $nextClasses = collect();
        $now = Carbon::now();
        $today = $now->toDateString();
        $currentTime = $now->format('H:i:s');

        // Get 3 nearest classes that haven't passed yet
        $nextClasses = DB::table('jadwal as j')
            ->join('kelas as k', 'j.id_kelas', '=', 'k.id_kelas')
            ->join('matkul as m', 'k.id_matkul', '=', 'm.id_matkul')
            ->where(function ($q) use ($today, $currentTime) {
                $q->where('j.tanggal', '>', $today)
                  ->orWhere(function ($q2) use ($today, $currentTime) {
                      $q2->where('j.tanggal', '=', $today)
                         ->where('j.jam_mulai', '>=', $currentTime);
                  });
            })
            ->orderBy('j.tanggal', 'asc')
            ->orderBy('j.jam_mulai', 'asc')
            ->limit(3)
            ->select(
                'j.id_jadwal',
                'j.tanggal',
                'j.jam_mulai',
                'j.jam_selesai',
                'k.id_kelas',
                'k.deskripsi',
                'k.tempat',
                'k.image_path',
                'm.id_matkul',
                'm.nama_matkul'
            )
            ->get();
    @endphp

    <div class="row g-4">
        @forelse($nextClasses as $kelas)
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('kelas.preview', $kelas->id_kelas) }}" class="text-decoration-none">
                    <div class="course-card p-4 h-100 d-flex flex-column">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="thumb">
                                <i class="bi bi-hexagon fs-2 text-secondary"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">{{ $kelas->nama_matkul }}</h5>
                                <span class="badge badge-cat">{{ Carbon::parse($kelas->tanggal)->format('d M Y') }}</span>
                            </div>
                        </div>
                        <p class="text-secondary mb-0">
                            {{ \Illuminate\Support\Str::limit($kelas->deskripsi, 50, '...') }}
                        </p>
                        <div class="mt-auto pt-3 border-top border-secondary">
                            <small class="text-muted">
                                <i class="bi bi-clock me-2"></i>{{ Carbon::parse($kelas->jam_mulai)->format('H:i') }} - {{ Carbon::parse($kelas->jam_selesai)->format('H:i') }}
                            </small>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">Belum ada jadwal kelas yang akan datang.</p>
            </div>
        @endforelse
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- JS Kalender Interaktif + deteksi hari ini -->
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const cal = document.getElementById("calendar");
    const grid = document.getElementById("calGrid");
    const monthLabel = document.getElementById("calMonthLabel");
    const yearLabel  = document.getElementById("calYearLabel");
    const btnPrev = document.getElementById("calPrev");
    const btnNext = document.getElementById("calNext");
    const btnToday = document.getElementById("calToday");

    if (!cal || !grid || !monthLabel || !yearLabel || !btnPrev || !btnNext) {
      console.error("Calendar elements missing. Check IDs.");
      return;
    }

    const now = new Date();

    // Default: pakai data-year & data-month kalau ada, kalau nggak -> bulan sekarang
    let year = cal.dataset.year ? parseInt(cal.dataset.year, 10) : now.getFullYear();
    let month = cal.dataset.month ? parseInt(cal.dataset.month, 10) : now.getMonth(); // 0-11

    // Default selection: kalau bulan sekarang -> hari ini, kalau tidak -> tanggal 1
    let selected =
      (year === now.getFullYear() && month === now.getMonth())
        ? new Date(now.getFullYear(), now.getMonth(), now.getDate())
        : new Date(year, month, 1);

    const fmtMonth = new Intl.DateTimeFormat("en-US", { month: "long" }); // biar "June"
    // Kalau mau "Juni": ganti "en-US" => "id-ID"

    function daysInMonth(y, m) { return new Date(y, m + 1, 0).getDate(); }
    function sameYMD(a, b) {
      return a.getFullYear() === b.getFullYear() &&
            a.getMonth() === b.getMonth() &&
            a.getDate() === b.getDate();
    }

    function shiftMonth(delta) {
      const keepDay = selected.getDate();
      month += delta;

      if (month < 0) { month = 11; year -= 1; }
      if (month > 11) { month = 0; year += 1; }

      const dim = daysInMonth(year, month);
      selected = new Date(year, month, Math.min(keepDay, dim));
      render();
    }

    function render() {
      monthLabel.textContent = fmtMonth.format(new Date(year, month, 1));
      yearLabel.textContent = String(year);

      const first = new Date(year, month, 1);

      // JS: 0=Sun..6=Sat -> kita ubah supaya Monday = 0
      const firstWeekday = (first.getDay() + 6) % 7;

      const dim = daysInMonth(year, month);
      const dimPrev = daysInMonth(year, month - 1);

      grid.innerHTML = "";

      // 6 minggu = 42 cell (layout stabil)
      for (let i = 0; i < 42; i++) {
        const dayNum = i - firstWeekday + 1;

        let cellDate, muted = false, displayDay;

        if (dayNum <= 0) {
          muted = true;
          displayDay = dimPrev + dayNum;
          cellDate = new Date(year, month - 1, displayDay);
        } else if (dayNum > dim) {
          muted = true;
          displayDay = dayNum - dim;
          cellDate = new Date(year, month + 1, displayDay);
        } else {
          displayDay = dayNum;
          cellDate = new Date(year, month, displayDay);
        }

        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "cell";

        if (muted) btn.classList.add("muted");

        // tandai HARI INI (tanpa mengganggu active)
        const today = new Date();
        if (!muted && sameYMD(cellDate, today)) btn.classList.add("today");

        // active = tanggal terpilih (hanya untuk bulan aktif)
        if (!muted && sameYMD(cellDate, selected)) btn.classList.add("active");

        btn.textContent = String(displayDay);

        btn.dataset.y = String(cellDate.getFullYear());
        btn.dataset.m = String(cellDate.getMonth());
        btn.dataset.d = String(cellDate.getDate());

        btn.addEventListener("click", function () {
          year = parseInt(btn.dataset.y, 10);
          month = parseInt(btn.dataset.m, 10);
          selected = new Date(year, month, parseInt(btn.dataset.d, 10));
          render();
        });

        grid.appendChild(btn);
      }
    }

    btnPrev.addEventListener("click", () => shiftMonth(-1));
    btnNext.addEventListener("click", () => shiftMonth(1));

    btnToday?.addEventListener("click", () => {
      const t = new Date();
      year = t.getFullYear();
      month = t.getMonth();
      selected = new Date(year, month, t.getDate());
      render();
    });

    render();
  });
  </script>
</body>
</html>
