<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar - Jago Teknik</title>
  <meta name="description" content="Daftar akun JagoTeknik" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('loginregister.css') }}">
</head>
<body>
  <div class="login-container">
    <!-- Left: Carousel -->
    <aside class="login-left d-none d-lg-block">
      <div id="regCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#regCarousel" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#regCarousel" data-bs-slide-to="1"></button>
          <button type="button" data-bs-target="#regCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active"><img src="/image/loginregister.png" alt="Intensive Class"></div>
          <div class="carousel-item"><img src="/image/loginregister.png" alt="Expert Tutors"></div>
          <div class="carousel-item"><img src="/image/loginregister.png" alt="Learn Anywhere"></div>
        </div>
      </div>
    </aside>

    <!-- Right: Register Form -->
    <main class="login-right">
      <div class="auth-panel">
        <div class="welcome-text">
          <h2>Selamat datang di Jago Teknik</h2>
        </div>

        <!-- Tab -->
        <div class="tab-switcher">
            <a href="{{ route('login.view') }}" class="tab-btn text-decoration-none text-center">Login</a>
            <button class="tab-btn active" type="button">Daftar

            </button>
        </div>

        <form method="POST" action="{{ route('user.register.perform') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="Masukkan nama anda" value="{{ old('name') }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Masukkan email anda" value="{{ old('email') }}" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Masukkan password anda" required>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <small class="text-secondary d-block mt-2">
            Minimal 8 karakter, kombinasi huruf besar-kecil, angka, dan simbol.
            </small>
        </div>

        <div class="mb-4">
            <label class="form-label">Verifikasi password</label>
            <input type="password" name="password_confirmation" class="form-control"
                placeholder="Verifikasi password anda" required>
        </div>

        <div class="d-flex align-items-start gap-2 mb-3">
            <input class="form-check-input mt-1" type="checkbox"
                    id="terms" name="terms" value="1" required>
            <label class="form-check-label terms-note" for="terms">
                Dengan mendaftar, Anda menyetujui
                <a href="#" class="link-terms">Ketentuan Pengguna</a>
                dan <a href="#" class="link-terms">Kebijakan Privasi</a> kami
            </label>
            </div>
            @error('terms') <div class="text-danger small">{{ $message }}
                </div> @enderror


        <button type="submit" class="btn btn-login">Daftar Sekarang</button>
        </form>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
