-- ========================================
-- DUMMY QUESTIONS DATA FOR EACH MATERI
-- ========================================

-- MATERI 1: Fungsi Transeden
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(1, 'Apa yang dimaksud dengan fungsi transeden?', 'multiple_choice', 'easy');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(1, 'Fungsi yang dapat dinyatakan sebagai kombinasi aljabar', 'A', FALSE),
(1, 'Fungsi yang melampaui aljabar biasa dan tidak dapat dinyatakan sebagai kombinasi aljabar', 'B', TRUE),
(1, 'Fungsi linear sederhana', 'C', FALSE),
(1, 'Fungsi yang hanya terdefinisi untuk bilangan bulat', 'D', FALSE),
(1, 'Fungsi yang selalu bernilai positif', 'E', FALSE);

-- MATERI 2: Teknik Integrasi
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(2, 'Rumus integrasi parsial adalah?', 'multiple_choice', 'medium');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(2, '∫ u dv = uv - ∫ v du', 'A', TRUE),
(2, '∫ u dv = uv + ∫ v du', 'B', FALSE),
(2, '∫ u dv = u + v', 'C', FALSE),
(2, '∫ u dv = u × v', 'D', FALSE),
(2, '∫ u dv = u / v', 'E', FALSE);

-- MATERI 3: Integrasi Numerik
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(3, 'Aturan mana yang menggunakan parabola untuk mendekati kurva?', 'multiple_choice', 'medium');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(3, 'Aturan Riemann', 'A', FALSE),
(3, 'Aturan Trapezoida', 'B', FALSE),
(3, 'Aturan Simpson', 'C', TRUE),
(3, 'Aturan Persegi Panjang', 'D', FALSE),
(3, 'Aturan Segitiga', 'E', FALSE);

-- MATERI 4: Aplikasi Integrasi Tertentu
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(4, 'Metode mana yang digunakan ketika daerah diputar tanpa ada celah?', 'multiple_choice', 'medium');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(4, 'Metode Cincin', 'A', FALSE),
(4, 'Metode Cakram', 'B', TRUE),
(4, 'Metode Kulit Tabung', 'C', FALSE),
(4, 'Metode Silinder', 'D', FALSE),
(4, 'Metode Bola', 'E', FALSE);

-- MATERI 5: Deret Tak Terhingga
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(5, 'Uji konvergensi mana yang sangat ampuh untuk deret dengan faktorial?', 'multiple_choice', 'hard');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(5, 'Uji Suku ke-n', 'A', FALSE),
(5, 'Uji Rasio', 'B', TRUE),
(5, 'Uji Akar', 'C', FALSE),
(5, 'Uji Banding', 'D', FALSE),
(5, 'Uji Limit', 'E', FALSE);

-- MATERI 6: Koordinat Kutub
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(6, 'Rumus konversi x dalam koordinat kutub adalah?', 'multiple_choice', 'easy');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(6, 'x = r + θ', 'A', FALSE),
(6, 'x = r sin(θ)', 'B', FALSE),
(6, 'x = r cos(θ)', 'C', TRUE),
(6, 'x = r × θ', 'D', FALSE),
(6, 'x = r / θ', 'E', FALSE);

-- MATERI 7: Pengenalan Struktur Data
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(7, 'Apa itu ADT (Abstract Data Type)?', 'multiple_choice', 'easy');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(7, 'Model fisik dari data dalam memori', 'A', FALSE),
(7, 'Model logika dari bentuk data beserta operasi-operasinya', 'B', TRUE),
(7, 'Tipe data primitif seperti integer', 'C', FALSE),
(7, 'Bahasa pemrograman', 'D', FALSE),
(7, 'Sistem operasi komputer', 'E', FALSE);

-- MATERI 8: Linked List
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(8, 'Berapa banyak pointer yang dimiliki Doubly Linked List?', 'multiple_choice', 'easy');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(8, 'Satu (Next)', 'A', FALSE),
(8, 'Dua (Next dan Prev)', 'B', TRUE),
(8, 'Tiga', 'C', FALSE),
(8, 'Tidak ada pointer', 'D', FALSE),
(8, 'Empat', 'E', FALSE);

-- MATERI 9: Stack dan Queue
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(9, 'Prinsip apa yang digunakan oleh Stack?', 'multiple_choice', 'easy');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(9, 'FIFO (First In First Out)', 'A', FALSE),
(9, 'LIFO (Last In First Out)', 'B', TRUE),
(9, 'FILO (First In Last Out)', 'C', FALSE),
(9, 'Random Access', 'D', FALSE),
(9, 'Sequential Access', 'E', FALSE);

-- MATERI 10: Tree
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(10, 'Traversal mana yang menghasilkan data terurut pada BST?', 'multiple_choice', 'medium');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(10, 'Pre-order', 'A', FALSE),
(10, 'In-order', 'B', TRUE),
(10, 'Post-order', 'C', FALSE),
(10, 'Level-order', 'D', FALSE),
(10, 'Depth-first', 'E', FALSE);

-- MATERI 11: Graph
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(11, 'Algoritma traversal mana yang menggunakan Queue?', 'multiple_choice', 'medium');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(11, 'Depth First Search (DFS)', 'A', FALSE),
(11, 'Breadth First Search (BFS)', 'B', TRUE),
(11, 'Binary Search', 'C', FALSE),
(11, 'Linear Search', 'D', FALSE),
(11, 'Recursive Search', 'E', FALSE);

-- MATERI 12: Sorting & Searching
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(12, 'Kompleksitas waktu Best Case dari Quick Sort adalah?', 'multiple_choice', 'hard');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(12, 'O(n)', 'A', FALSE),
(12, 'O(n log n)', 'B', TRUE),
(12, 'O(n²)', 'C', FALSE),
(12, 'O(2^n)', 'D', FALSE),
(12, 'O(1)', 'E', FALSE);

-- MATERI 13: Besaran dan Satuan
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(13, 'Berapa banyak besaran pokok dalam SI?', 'multiple_choice', 'easy');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(13, 'Lima', 'A', FALSE),
(13, 'Enam', 'B', FALSE),
(13, 'Tujuh', 'C', TRUE),
(13, 'Delapan', 'D', FALSE),
(13, 'Sembilan', 'E', FALSE);

-- MATERI 14: Vektor
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(14, 'Hasil dari dot product adalah?', 'multiple_choice', 'medium');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(14, 'Vektor', 'A', FALSE),
(14, 'Skalar', 'B', TRUE),
(14, 'Matriks', 'C', FALSE),
(14, 'Tensor', 'D', FALSE),
(14, 'Array', 'E', FALSE);

-- MATERI 15: Kinematika Partikel
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(15, 'Rumus GLB adalah?', 'multiple_choice', 'easy');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(15, 's = v × t', 'A', TRUE),
(15, 's = ½at²', 'B', FALSE),
(15, 'v = at', 'C', FALSE),
(15, 'a = v/t', 'D', FALSE),
(15, 'F = ma', 'E', FALSE);

-- MATERI 16: Dinamika Partikel
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(16, 'Hukum Newton yang kedua adalah?', 'multiple_choice', 'easy');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(16, 'ΣF = 0 (keseimbangan)', 'A', FALSE),
(16, 'ΣF = ma', 'B', TRUE),
(16, 'F aksi = F reaksi', 'C', FALSE),
(16, 'a = v/t', 'D', FALSE),
(16, 'v = gt', 'E', FALSE);

-- MATERI 17: Usaha dan Energi
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(17, 'Rumus energi kinetik adalah?', 'multiple_choice', 'easy');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(17, 'EK = mgh', 'A', FALSE),
(17, 'EK = ½mv²', 'B', TRUE),
(17, 'EK = Fs', 'C', FALSE),
(17, 'EK = at²', 'D', FALSE),
(17, 'EK = mv', 'E', FALSE);

-- MATERI 18: Momentum Impuls
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(18, 'Apa itu koefisien restitusi (e) pada tumbukan lenting sempurna?', 'multiple_choice', 'medium');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(18, 'e = 0', 'A', FALSE),
(18, 'e = 1', 'B', TRUE),
(18, 'e = 0.5', 'C', FALSE),
(18, 'e = 2', 'D', FALSE),
(18, 'e tidak terdefinisi', 'E', FALSE);

-- MATERI 19: Logika Matematika
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(19, 'Hasil dari negasi (~) dari pernyataan benar adalah?', 'multiple_choice', 'easy');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(19, 'Benar', 'A', FALSE),
(19, 'Salah', 'B', TRUE),
(19, 'Tidak terdefinisi', 'C', FALSE),
(19, 'Mungkin', 'D', FALSE),
(19, 'Setara', 'E', FALSE);

-- MATERI 20: Himpunan
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(20, 'Operasi himpunan mana yang menghasilkan elemen yang ada di A DAN B?', 'multiple_choice', 'easy');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(20, 'Gabungan (Union ∪)', 'A', FALSE),
(20, 'Irisan (Intersection ∩)', 'B', TRUE),
(20, 'Selisih (-)', 'C', FALSE),
(20, 'Komplemen', 'D', FALSE),
(20, 'Produk Kartesian', 'E', FALSE);

-- MATERI 21: Relasi dan Fungsi
INSERT INTO `questions` (`id_materi`, `question_text`, `question_type`, `difficulty_level`) VALUES
(21, 'Fungsi apakah yang setiap elemen domain dipetakan tepat ke satu elemen kodomain?', 'multiple_choice', 'easy');

INSERT INTO `question_options` (`id_question`, `option_text`, `option_letter`, `is_correct`) VALUES
(21, 'Relasi', 'A', FALSE),
(21, 'Fungsi', 'B', TRUE),
(21, 'Pemetaan Parsial', 'C', FALSE),
(21, 'Relasi Ekuivalen', 'D', FALSE),
(21, 'Fungsi Multi-valued', 'E', FALSE);
