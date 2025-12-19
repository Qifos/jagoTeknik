-- ========================================
-- SAMPLE QUESTIONS DATA FOR TESTING
-- ========================================

-- ===== QUESTIONS FOR MATERI ID 1 (Fungsi Transeden) =====
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(1, 'Apa pengertian dari fungsi transeden?', 'multiple_choice', 'easy'),
(1, 'Manakah yang merupakan contoh fungsi transeden?', 'multiple_choice', 'medium'),
(1, 'Fungsi logaritma alami didefinisikan sebagai integral dari?', 'multiple_choice', 'hard');

-- Get the question IDs (assuming they're 1, 2, 3)
-- Question 1 options
INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(1, 'Fungsi yang dapat dinyatakan sebagai kombinasi aljabar', 'A', 0),
(1, 'Fungsi yang tidak dapat dinyatakan sebagai kombinasi aljabar', 'B', 1),
(1, 'Fungsi polinomial derajat tinggi', 'C', 0),
(1, 'Fungsi yang selalu bernilai positif', 'D', 0),
(1, 'Fungsi trigonometri dasar', 'E', 0);

-- Question 2 options
INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(2, 'Fungsi kuadrat', 'A', 0),
(2, 'Fungsi eksponensial e^x', 'B', 1),
(2, 'Fungsi linear', 'C', 0),
(2, 'Fungsi kubik', 'D', 0),
(2, 'Fungsi konstan', 'E', 0);

-- Question 3 options
INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(3, 'Integral dari x sampai x^2', 'A', 0),
(3, 'Integral dari 1/t dari 0 sampai x', 'B', 0),
(3, 'Integral dari 1/t dari 1 sampai x', 'C', 1),
(3, 'Integral dari e^t dari 1 sampai x', 'D', 0),
(3, 'Integral dari sin(t) dari 1 sampai x', 'E', 0);

-- ===== QUESTIONS FOR MATERI ID 2 (Teknik Integrasi) =====
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(2, 'Rumus dasar integrasi substitusi adalah?', 'multiple_choice', 'medium'),
(2, 'Integrasi parsial didasarkan pada?', 'multiple_choice', 'hard');

-- Question 4 options
INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(4, '∫ f(x)dx = F(x) + C', 'A', 0),
(4, '∫ f(g(x)) g\'(x) dx = ∫ f(u) du', 'B', 1),
(4, '∫ u dv = uv - ∫ v du', 'C', 0),
(4, '∫ f(x)/g(x) dx = ∫ f(x) dx / ∫ g(x) dx', 'D', 0),
(4, '∫ (f+g) dx = ∫ f dx + ∫ g dx', 'E', 0);

-- Question 5 options
INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(5, 'Turunan penjumlahan fungsi', 'A', 0),
(5, 'Turunan perkalian fungsi', 'B', 1),
(5, 'Turunan pembagian fungsi', 'C', 0),
(5, 'Turunan fungsi komposisi', 'D', 0),
(5, 'Aturan rantai', 'E', 0);

-- ===== QUESTIONS FOR MATERI ID 3 (Integrasi Numerik) =====
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(3, 'Metode apa yang menggunakan trapesium untuk aproksimasi?', 'multiple_choice', 'easy'),
(3, 'Aturan Simpson menggunakan aproksimasi dengan?', 'multiple_choice', 'medium'),
(3, 'Keuntungan integrasi numerik adalah?', 'multiple_choice', 'hard');

-- Question 6 options
INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(6, 'Aturan Riemann', 'A', 0),
(6, 'Aturan Trapezoida', 'B', 1),
(6, 'Aturan Simpson', 'C', 0),
(6, 'Aturan Titik Tengah', 'D', 0),
(6, 'Aturan Boole', 'E', 0);

-- Question 7 options
INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(7, 'Persegi panjang', 'A', 0),
(7, 'Parabola (polinom orde 2)', 'B', 1),
(7, 'Garis lurus', 'C', 0),
(7, 'Polinomial orde 3', 'D', 0),
(7, 'Eksponensial', 'E', 0);

-- Question 8 options
INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(8, 'Dapat menghitung integral yang tidak memiliki antiturunan elementer', 'A', 1),
(8, 'Lebih cepat dari kalkulus analitik', 'B', 0),
(8, 'Tidak memerlukan komputer', 'C', 0),
(8, 'Selalu memberikan hasil yang tepat', 'D', 0),
(8, 'Hanya berlaku untuk fungsi polinomial', 'E', 0);
