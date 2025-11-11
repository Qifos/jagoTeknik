<!--
 * Author : Sinta Dewi Rahmawati (NRP 5026231231)
 * Desc   : Username View
 * Date   : 2025-11-04
-->

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pilih Username — Jago Teknik</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Shared styles -->
    <link rel="stylesheet" href="{{ asset('css/loginregister.css') }}">
</head>
<body>
    <div class="login-container">
    <!-- Left: Carousel (ikut style halaman login/register) -->
    <aside class="login-left d-none d-lg-block">
      <div id="otpCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#otpCarousel" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#otpCarousel" data-bs-slide-to="1"></button>
          <button type="button" data-bs-target="#otpCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active"><img src="/image/loginregister.png" alt="Intensive Class"></div>
          <div class="carousel-item"><img src="/image/loginregister.png" alt="Expert Tutors"></div>
          <div class="carousel-item"><img src="/image/loginregister.png" alt="Learn Anywhere"></div>
        </div>
      </div>
    </aside>

    <!-- Right: OTP form -->
    <main class="login-right">
    <div class="panel">
      <h2 class="title text-center mb-1">Selamat datang,</h2>
      <p class="subtitle text-center mb-4">Ayo lengkapi profilmu terlebih dulu</p>

      <form id="profileForm" action="#" method="POST" novalidate>
        {{-- @csrf --}}

        <!-- Angkatan -->
        <div class="mb-3">
          <div class="label">Angkatan</div>
          <input type="text" inputmode="numeric" maxlength="4" class="form-control ipt" id="angkatan"
                 name="angkatan" placeholder="Masukkan tahun angkatan anda" required>
        </div>

        <!-- Tanggal lahir -->
        <div class="mb-3">
          <div class="label">Tanggal lahir</div>
          <input type="date" class="form-control ipt" id="tanggal_lahir"
                 name="tanggal_lahir" placeholder="Masukkan tanggal lahir anda" required>
        </div>

        <!-- Jurusan -->
        <div class="mb-3">
          <div class="label">Jurusan</div>
          {{-- pilih salah satu: text bebas atau select --}}
          <input type="text" class="form-control ipt" id="jurusan"
                 name="jurusan" placeholder="Masukkan jurusan anda" required>
          <!--
          <select class="form-select ipt mt-2" name="jurusan">
            <option value="" selected disabled>Pilih jurusan</option>
            <option>Teknik Informatika</option>
            <option>Teknik Mesin</option>
            <option>Teknik Elektro</option>
            <option>Teknik Sipil</option>
          </select>
          -->
        </div>

        <!-- Nomor HP -->
        <div class="mb-4">
          <div class="label">Nomor HP</div>
          <input type="tel" class="form-control ipt" id="no_hp" name="no_hp"
                 inputmode="numeric" placeholder="Masukkan nomor HP anda" required>
        </div>

        <!-- Tombol di tengah -->
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-main px-4" id="submitBtn">Selesaikan</button>
        </div>
      </form>
    </div>
</main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // UX kecil: batasi angkatan ke 4 digit, format HP hanya angka
    const angkatan = document.getElementById('angkatan');
    const hp = document.getElementById('no_hp');

    angkatan.addEventListener('input', () => {
      angkatan.value = angkatan.value.replace(/\D/g,'').slice(0,4);
    });
    hp.addEventListener('input', () => {
      hp.value = hp.value.replace(/\D/g,'').slice(0,15);
    });

    // demo only: cegah submit beneran
    document.getElementById('profileForm').addEventListener('submit', e => {
      e.preventDefault();
    });
  </script>
</body>
</html>
