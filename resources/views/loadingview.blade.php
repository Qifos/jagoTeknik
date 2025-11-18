<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jago Teknik - Memproses...</title>

    <!-- CSS Links -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pembayaran.css') }}">

    <!-- Meta refresh to simulate loading and redirect -->
    <meta http-equiv="refresh" content="3;url={{ $redirectTo }}">
</head>
<body class="loading-body">

    <div class="text-center">
        <div class="spinner-border loading-spinner" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="loading-text mt-3">Memproses pembayaran Anda...</p>
    </div>

    <!-- Bootstrap JS bundle (optional for this page) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
