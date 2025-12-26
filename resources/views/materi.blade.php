<!--
 * Author : Muhammad Fiqih Soetam Putra (NRP 5026231096)
 * File   : resources/views/materi.blade.php
 * Desc   : view untuk halaman materi pembelajaran
 * Date   : 25-11-2025
-->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jago Teknik - Materi</title>

    <!-- CSS Links -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/materi.css') }}">
</head>

<body class="min-vh-100 d-flex flex-column">
    <header class="bg-transparent">
        <!-- Navbar (SAMA seperti homepage/jadwal) -->
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('homepage') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('kelas.semua') }}">Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jadwal.index') }}">Jadwal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('chat.index') }}">Chat</a>
                        </li>
                        <li class="nav-item d-none d-lg-block">
                            <form class="d-flex" role="search" onsubmit="return false;">
                                <div class="input-group">
                                    <input class="form-control border-start-1" type="search"
                                        placeholder="Cari di JagoTeknik" aria-label="Cari" />
                                    <span class="input-group-text bg-transparent border-end-0 text-secondary"><i
                                            class="bi bi-search"></i></span>
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
    </header>


    <main class="flex-grow-1">
        <div class="container py-4">
            <div class="mb-3">
                <a href="{{ route('kelas.detail.beli', $matkul->id_matkul) }}" class="back-btn">&lt; Back</a>
            </div>

            <header class="text-center">
                <h1 class="display-5 title-hero">{{ $matkul->nama_matkul }}</h1>
            </header>

            <div class="content-card">
                <h2 class="h4 mb-3">{{ $materi->nama_materi ?? 'Materi Pembelajaran' }}</h2>

                <div>{!! $materi->isi_materi ?? '<p>Deskripsi materi tidak tersedia.</p>' !!}</div>

                <!-- QUIZ SECTION (Before Videos) -->
                <div class="mt-5 mb-4">
                    <div id="quizScoreDisplay" style="display: none;" class="alert mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-2">Hasil Kuis</h5>
                                <p class="mb-1"><strong>Skor Tertinggi:</strong> <span id="highestScore">-</span>%</p>
                                <p class="mb-0"><strong>Skor Terbaru:</strong> <span id="recentScore">-</span>%</p>
                            </div>
                            <div class="text-center" style="min-width: 100px;">
                                <div id="scorePercentage" style="font-size: 2.5rem; font-weight: bold;">-</div>
                                <small id="scoreStatus">-</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mb-3">
                        <button id="quizToggleBtn" class="btn btn-sm"
                            style="background: #6b4fa0; color: #fff; border: none;" onclick="toggleQuizContainer()">
                            📝 Mulai Kuis Pemahaman
                        </button>
                        <button id="reAttemptBtn" class="btn btn-sm"
                            style="background: #8b5cf6; color: #fff; border: none; display: none;"
                            onclick="startNewAttempt()">
                            🔄 Coba Lagi
                        </button>
                    </div>

                    <!-- Quiz Container -->
                    <div id="quizContainer"
                        style="display: none; background: #2a2a3e; border: 2px solid #6b4fa0; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0" style="color: #fff;">Kuis Pemahaman Materi</h5>
                            <button type="button" class="btn-close btn-close-white"
                                onclick="toggleQuizContainer()"></button>
                        </div>

                        <div id="questionsContent" class="mb-3">
                            <!-- Questions will be loaded here -->
                            <div class="text-center py-3">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button id="submitQuizBtn" class="btn"
                                style="background: #6b4fa0; color: #fff; border: none;" onclick="submitQuiz()">
                                ✓ Selesaikan Kuis
                            </button>
                            <button type="button" class="btn"
                                style="background: #444; color: #fff; border: none;" onclick="toggleQuizContainer()">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Video List -->
                @if ($videos && $videos->count() > 0)
                    <h5 class="mt-4 mb-3">Video Pembelajaran</h5>
                    <div class="video-grid">
                        @foreach ($videos as $video)
                            <div class="teaser-card">
                                <div class="thumb">
                                    <img src="https://placehold.co/400x225/000/fff?text={{ urlencode($video->nama_video ?? 'Video') }}"
                                        alt="{{ $video->nama_video }}">
                                    <a href="{{ route('media.video.detail', ['id' => $video->id_video]) }}"
                                        class="play-large">▶</a>
                                </div>
                                <div>
                                    <div class="fw-bold video-title">
                                        {{ $video->nama_video }}
                                    </div>
                                    <div class="instructor">
                                        <img src="https://placehold.co/24x24/eee/333?text=I" alt="instructor">
                                        <span>{{ $video->durasi ?? 'Video' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info mt-4">
                        <p>Belum ada video pembelajaran untuk materi ini.</p>
                    </div>
                @endif

                <!-- Navigation Button to Next Materi -->
                @php
                    $currentMateriId = $materi->id_materi ?? null;
                    $nextMateri = $materi->matkul
                        ->materi()
                        ->where('id_materi', '>', $currentMateriId)
                        ->orderBy('id_materi', 'asc')
                        ->first();
                    $previousMateri = $materi->matkul
                        ->materi()
                        ->where('id_materi', '<', $currentMateriId)
                        ->orderBy('id_materi', 'desc')
                        ->first();
                @endphp

                <!-- Previous Button -->
                @if ($previousMateri)
                    <a href="{{ route('media.materi', ['id' => $previousMateri->id_materi]) }}"
                        class="materi-prev-button">
                        ← Materi Sebelumnya
                    </a>
                @endif

                <!-- Next or Complete Button -->
                @if ($nextMateri)
                    <button id="nextMateriBtn" class="materi-nav-button" onclick="goToNextMateri()" disabled>
                        Lanjut ke Materi Selanjutnya → (Selesaikan kuis dulu)
                    </button>
                @else
                    <button class="materi-nav-button complete-btn" onclick="completeMateri()">
                        Selesaikan Pembelajaran ✓
                    </button>
                @endif
            </div>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container-fluid px-lg-5">
            <div class="row gy-4">
                <div class="col-lg-3">
                    <a class="navbar-brand d-flex align-items-center" href="#">
                        <span class="footer-logo me-2">J</span>
                        Jago Teknik
                    </a>
                    <p class="mt-2">Kuliah Teknik Jadi Easy</p>
                </div>
                <div class="col-6 col-lg-2">
                    <h5>Jurusan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Umum</a></li>
                        <li><a href="#">Teknik</a></li>
                        <li><a href="#">Vokasi</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h5>Ikuti Kami</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">X</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">LinkedIn</a></li>
                        <li><a href="#">YouTube</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h5>Legal</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Terms</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Cookies</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5>Kontak Kami</h5>
                    <ul class="list-unstyled">
                        <li>081234567890</li>
                        <li>jagoteknikcourse@gmail.com</li>
                        <li>Surabaya, Indonesia 60111</li>
                        <li><a href="#">News</a></li>
                    </ul>
                </div>
            </div>
            <div
                class="d-flex justify-content-between align-items-center mt-4 border-top border-secondary-subtle pt-4">
                <p class="mb-0">&copy; 2025 Jago Teknik</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Alpine.js for small interactions -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        const materiId = {{ $materi->id_materi ?? 0 }};
        const matkulId = {{ $matkul->id_matkul ?? 0 }};
        @if ($nextMateri)
            const nextMateriId = {{ $nextMateri->id_materi ?? 0 }};
        @else
            const nextMateriId = null;
        @endif

        let currentAttempt = 1;
        let quizAnswers = {};
        let quizPassed = false;
        let highestScore = 0;
        let recentScore = 0;

        // Initialize page
        document.addEventListener('DOMContentLoaded', () => {
            loadQuizStatus();
        });

        // ===== QUIZ FUNCTIONS =====

        /**
         * Load quiz status on page load
         * Checks if user has already passed the quiz for this materi
         */
        async function loadQuizStatus() {
            try {
                const response = await fetch(`/api/progress/matkul/${matkulId}/materi`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });

                const data = await response.json();

                if (data.success && data.materi_progress) {
                    const materiProgress = data.materi_progress.find(m => m.id_materi === materiId);

                    if (materiProgress && materiProgress.quiz_passed) {
                        // Quiz already passed, set state and enable next button
                        quizPassed = true;
                        highestScore = materiProgress.highest_quiz_score || 0;
                        recentScore = materiProgress.recent_quiz_score || 0;

                        // Show quiz results
                        document.getElementById('scorePercentage').textContent = recentScore + '%';
                        document.getElementById('highestScore').textContent = highestScore;
                        document.getElementById('recentScore').textContent = recentScore;
                        document.getElementById('scoreStatus').textContent = '✓ LULUS';
                        document.getElementById('scoreStatus').style.color = '#28a745';
                        document.getElementById('quizScoreDisplay').className = 'alert alert-success mb-3';
                        document.getElementById('quizScoreDisplay').style.display = 'block';
                        document.getElementById('reAttemptBtn').style.display = 'inline-block';
                        document.getElementById('quizToggleBtn').textContent = '📝 Lihat Kuis Lagi';

                        // Enable next button
                        if (nextMateriId) {
                            document.getElementById('nextMateriBtn').disabled = false;
                            document.getElementById('nextMateriBtn').textContent = 'Lanjut ke Materi Selanjutnya →';
                            document.getElementById('nextMateriBtn').style.cursor = 'pointer';
                        }
                    }
                }
            } catch (error) {
                console.error('Error loading quiz status:', error);
            }
        }

        function toggleQuizContainer() {
            const container = document.getElementById('quizContainer');
            const isVisible = container.style.display !== 'none';

            if (!isVisible) {
                container.style.display = 'block';
                loadQuestions();
            } else {
                container.style.display = 'none';
            }
        }

        async function loadQuestions() {
            const container = document.getElementById('questionsContent');

            try {
                const response = await fetch(`/api/quiz/materi/${materiId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });

                const data = await response.json();

                if (data.success) {
                    renderQuestions(data.questions);
                    quizAnswers = {};
                } else {
                    container.innerHTML = '<div class="alert alert-danger">Error loading questions</div>';
                }
            } catch (error) {
                console.error('Error loading questions:', error);
                container.innerHTML = '<div class="alert alert-danger">Error loading questions</div>';
            }
        }

        function renderQuestions(questions) {
            const container = document.getElementById('questionsContent');
            let html = '';

            questions.forEach((question, index) => {
                html += `
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6 class="card-title" style="color: #fff;">Pertanyaan ${index + 1} <span class="badge bg-info">${question.difficulty_level}</span></h6>
                            <p class="mb-3" style="color: #e9ecef;">${question.question_text}</p>
                            <div class="options">
                `;

                question.options.forEach(option => {
                    const checked = question.user_answer === option.id_option ? 'checked' : '';
                    html += `
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="question_${question.id_question}"
                                   id="option_${option.id_option}" value="${option.id_option}"
                                   onchange="recordAnswer(${question.id_question}, ${option.id_option})" ${checked}>
                            <label class="form-check-label" for="option_${option.id_option}" style="color: #fff;">
                                <strong>${option.option_letter}.</strong> ${option.option_text}
                            </label>
                        </div>
                    `;
                });

                html += `
                            </div>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
        }

        async function recordAnswer(questionId, optionId) {
            quizAnswers[questionId] = optionId;

            try {
                const response = await fetch(`/api/quiz/answer/${materiId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        id_question: questionId,
                        selected_option_id: optionId,
                        attempt_number: currentAttempt
                    })
                });

                const data = await response.json();
                console.log('Answer recorded:', data);
            } catch (error) {
                console.error('Error recording answer:', error);
            }
        }

        async function submitQuiz() {
            try {
                // Check if questions are answered
                const totalQuestions = document.querySelectorAll('.form-check-input').length / 5;
                const answeredQuestions = Object.keys(quizAnswers).length;

                if (answeredQuestions < totalQuestions) {
                    alert('Mohon jawab semua pertanyaan sebelum submit (' + answeredQuestions + ' dari ' + Math.ceil(
                        totalQuestions) + ')');
                    return;
                }

                const response = await fetch(`/api/quiz/complete/${materiId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });

                const data = await response.json();
                console.log('Submit response:', data);

                if (data.success) {
                    highestScore = data.highest_score || data.score;
                    recentScore = data.recent_score || data.score;
                    quizPassed = data.passed;

                    showQuizResult(data);
                } else {
                    console.error('Server error:', data);
                    alert(data.error || 'Error submitting quiz');
                }
            } catch (error) {
                console.error('Error submitting quiz:', error);
                alert('Terjadi kesalahan: ' + error.message);
            }
        }

        function showQuizResult(data) {
            const scoreDisplay = document.getElementById('quizScoreDisplay');
            const container = document.getElementById('quizContainer');

            document.getElementById('scorePercentage').textContent = data.score + '%';
            document.getElementById('highestScore').textContent = data.highest_score || data.score;
            document.getElementById('recentScore').textContent = data.recent_score || data.score;
            document.getElementById('scoreStatus').textContent = data.passed ? '✓ LULUS' : '✗ TIDAK LULUS';
            document.getElementById('scoreStatus').style.color = data.passed ? '#28a745' : '#dc3545';

            if (data.passed) {
                scoreDisplay.className = 'alert alert-success mb-3';
                document.getElementById('reAttemptBtn').style.display = 'inline-block';

                // Enable next button if exists
                if (nextMateriId) {
                    document.getElementById('nextMateriBtn').disabled = false;
                    document.getElementById('nextMateriBtn').textContent = 'Lanjut ke Materi Selanjutnya →';
                    document.getElementById('nextMateriBtn').style.cursor = 'pointer';
                }
            } else {
                scoreDisplay.className = 'alert alert-warning mb-3';
                document.getElementById('reAttemptBtn').style.display = 'inline-block';
            }

            scoreDisplay.style.display = 'block';
            container.style.display = 'none';
            document.getElementById('quizToggleBtn').textContent = '📝 Lihat Kuis Lagi';
        }

        async function startNewAttempt() {
            try {
                const response = await fetch(`/api/quiz/attempt/${materiId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });

                const data = await response.json();

                if (data.success) {
                    currentAttempt = data.attempt_number;
                    quizAnswers = {};

                    document.getElementById('quizScoreDisplay').style.display = 'none';
                    toggleQuizContainer();
                }
            } catch (error) {
                console.error('Error starting new attempt:', error);
                alert('Terjadi kesalahan');
            }
        }

        function goToNextMateri() {
            if (nextMateriId) {
                window.location.href = `/materi/${nextMateriId}`;
            }
        }

        // ===== COMPLETE MATERI =====
        async function completeMateri() {
            if (!materiId || !matkulId) {
                alert('Informasi materi tidak lengkap');
                return;
            }

            if (!quizPassed) {
                alert('Silakan selesaikan kuis dengan skor minimal 70% terlebih dahulu');
                return;
            }

            try {
                const response = await fetch(`/api/materi/complete/${materiId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    alert('Selamat! Anda telah menyelesaikan pembelajaran ini.');
                    window.location.href = `/kelas/${matkulId}/belajar`;
                } else {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            } catch (error) {
                console.error('Error completing materi:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        }
    </script>
</body>

</html>
