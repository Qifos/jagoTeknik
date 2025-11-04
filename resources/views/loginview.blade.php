<!--
 * Author : Sinta Dewi Rahmawati (NRP 5026231231)
 * Desc   : Login View
 * Date   : 2025-11-04
-->

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - Jago Teknik</title>
  <meta name="description" content="Login ke JagoTeknik untuk akses kelas teknik terbaik" />

  <!-- Bootstrap 5 + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('loginregister.css') }}">

</head>
<body>
  <div class="login-container">
    <!-- Left side - Carousel -->
    <aside class="login-left d-none d-lg-block">
      <div id="loginCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#loginCarousel" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#loginCarousel" data-bs-slide-to="1"></button>
          <button type="button" data-bs-target="#loginCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active"><img src="/image/loginregister.png" alt="Intensive Class"></div>
          <div class="carousel-item"><img src="/image/loginregister.png" alt="Expert Tutors"></div>
          <div class="carousel-item"><img src="/image/loginregister.png" alt="Learn Anywhere"></div>
        </div>
      </div>
    </aside>

    <!-- Right side - Form -->
    <main class="login-right">
      <div class="auth-panel">
        <div class="welcome-text">
          <h2>Selamat datang di Jago Teknik</h2>
        </div>

        <div class="tab-switcher">
            <button class="tab-btn active" type="button">Login</button>
            <a href="{{ route('register.view') }}" class="tab-btn text-decoration-none text-center">Daftar</a>
            </div>

            <form method="POST" action="{{ route('user.login.perform') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email anda" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password anda" required>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                <label class="form-check-label" for="rememberMe">Ingatan saya</label>
            </div>

            <button type="submit" class="btn btn-login">Login</button>

            <div class="divider"><span>Atau lanjut dengan</span></div>

            </form>
      <!-- Social Login -->
      <div class="social-login mt-3">
        <button class="social-btn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
          </svg>
          Google
        </button>
        <button class="social-btn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
            <path d="M9.198 21.5h4v-8.01h3.604l.396-3.98h-4V7.5a1 1 0 0 1 1-1h3v-4h-3a5 5 0 0 0-5 5v2.01h-2l-.396 3.98h2.396v8.01Z"/>
          </svg>
          Facebook
        </button>
      </div>
    </div>
  </div>

  <script>
    function switchTab(tab) {
      const buttons = document.querySelectorAll('.tab-btn');
      buttons.forEach(btn => btn.classList.remove('active'));
      event.target.classList.add('active');

      // You can add form switching logic here
      if (tab === 'daftar') {
        // Show register form
        console.log('Switch to register form');
      } else {
        // Show login form
        console.log('Switch to login form');
      }
    }

    // Prevent form submission for demo
    document.getElementById('loginForm').addEventListener('submit', (e) => {
      e.preventDefault();
      alert('Login functionality would be implemented here');
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</div>
</body>
</html>
