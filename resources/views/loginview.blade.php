<!--
 * Author : Sinta Dewi Rahmawati (NRP 5026231231)
 * Desc   : Login View
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
    <link rel="stylesheet" href="{{ asset('css/loginregister.css') }}">

</head>

<body>
    <div class="login-container">
        <!-- Left side - Carousel -->
        <aside class="login-left d-none d-lg-block">
            <div id="loginCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel"
                data-bs-interval="5000">
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
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email anda"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password anda"
                            required>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                        <label class="form-check-label" for="rememberMe">Ingatkan saya</label>
                    </div>

                    <button type="submit" class="btn btn-login">Login</button>
                </form>
            </div>
    </div>

    <script>
        function switchTab(tab) {
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            if (tab === 'daftar') {
                console.log('Switch to register form');
            } else {
                console.log('Switch to login form');
            }
        }

        document.getElementById('loginForm').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Login functionality would be implemented here');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>
</html>
