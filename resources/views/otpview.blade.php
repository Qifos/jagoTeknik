<!--
 * Author : Sinta Dewi Rahmawati (NRP 5026231231)
 * Desc   : OTP View
-->

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>OTP Verification — Jago Teknik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/loginregister.css') }}">

</head>

<body>
    <div class="login-container">
        <!-- Left: Carousel -->
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
            <div class="auth-panel">
                <h4 class="otp-title mb-3">Masukkan kode OTP di Gmail</h4>
                @isset($email)
                    <div class="otp-hint small mb-4">Kami mengirimkan kode ke <strong>{{ $email }}</strong></div>
                @endisset

                <form id="otpForm" method="POST" action="{{ route('otp.verify') }}" class="mb-3">
                    @csrf
                    <input type="hidden" name="code" id="otpHidden">

                    <div class="d-flex otp-row mb-4">
                        <input inputmode="numeric" maxlength="1" class="otp-input" autocomplete="one-time-code" />
                        <input inputmode="numeric" maxlength="1" class="otp-input" />
                        <input inputmode="numeric" maxlength="1" class="otp-input" />
                        <input inputmode="numeric" maxlength="1" class="otp-input" />
                    </div>

                    @error('code')
                        <div class="alert alert-danger py-2 px-3 mb-3">{{ $message }}</div>
                    @enderror

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-verify w-auto">Verifikasi</button>
                    </div>
                </form>
                <form method="POST" action="{{ route('otp.resend') }}" class="mt-2">
                    @csrf
                    @if (session('status'))
                        <div class="small text-success mt-2">{{ session('status') }}</div>
                    @endif
                </form>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function() {
            const inputs = Array.from(document.querySelectorAll('.otp-input'));
            const hidden = document.getElementById('otpHidden');
            const form = document.getElementById('otpForm');

            const setHidden = () => {
                hidden.value = inputs.map(i => i.value.trim()).join('');
            };

            inputs.forEach((el, idx) => {
                el.addEventListener('input', e => {
                    el.value = el.value.replace(/\D/g, '').slice(0, 1);
                    if (el.value && idx < inputs.length - 1) inputs[idx + 1].focus();
                    setHidden();
                });
                el.addEventListener('keydown', e => {
                    if (e.key === 'Backspace' && !el.value && idx > 0) {
                        inputs[idx - 1].focus();
                    }
                });
                el.addEventListener('paste', e => {
                    const text = (e.clipboardData || window.clipboardData).getData('text').replace(
                        /\D/g, '').slice(0, 4);
                    if (!text) return;
                    e.preventDefault();
                    for (let i = 0; i < Math.min(text.length, inputs.length); i++) {
                        inputs[i].value = text[i];
                    }
                    setHidden();
                    const next = inputs[Math.min(text.length, inputs.length) - 1];
                    next && next.focus();
                });
            });

            if (inputs.length) inputs[0].focus();

            form.addEventListener('submit', e => {
                setHidden();
                if (hidden.value.length !== 4) {
                    e.preventDefault();
                    inputs[0].focus();
                }
            });
        })();
    </script>
</body>
</html>
