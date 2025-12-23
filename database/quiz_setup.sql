-- ========================================
-- QUIZ/QUESTIONS SYSTEM - DATABASE SETUP
-- ========================================
-- NOTE: Table names are based on existing database schema:
-- - user table (NOT users) with id_user primary key
-- - materi table with id_materi primary key
-- ========================================

-- 1. CREATE QUESTIONS TABLE
-- References materi(id_materi)
CREATE TABLE `questions` (
  `id_question` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_materi` INT NOT NULL,
  `question_text` LONGTEXT NOT NULL,
  `question_type` VARCHAR(50) DEFAULT 'multiple_choice' COMMENT 'Type: multiple_choice, true_false, etc',
  `difficulty_level` VARCHAR(20) DEFAULT 'medium' COMMENT 'easy, medium, hard',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_materi_questions` (`id_materi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Add foreign key for questions after table creation
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_questions_materi`
  FOREIGN KEY (`id_materi`) REFERENCES `materi`(`id_materi`) ON DELETE CASCADE;

-- 2. CREATE QUESTION OPTIONS TABLE
-- References questions(id_question)
CREATE TABLE `question_options` (
  `id_option` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_question` INT NOT NULL,
  `option_text` TEXT NOT NULL,
  `option_letter` CHAR(1) DEFAULT 'A' COMMENT 'A, B, C, D, E',
  `is_correct` BOOLEAN DEFAULT FALSE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_question_options` (`id_question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Add foreign key for question_options after table creation
ALTER TABLE `question_options`
  ADD CONSTRAINT `fk_question_options_questions`
  FOREIGN KEY (`id_question`) REFERENCES `questions`(`id_question`) ON DELETE CASCADE;

-- 3. CREATE USER QUIZ ANSWERS TABLE
-- References user(id_user), materi(id_materi), questions(id_question), question_options(id_option)
CREATE TABLE `user_quiz_answers` (
  `id_quiz_answer` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_user` INT NOT NULL,
  `id_materi` INT NOT NULL,
  `id_question` INT NOT NULL,
  `selected_option_id` INT,
  `is_correct` BOOLEAN DEFAULT FALSE,
  `attempt_number` INT DEFAULT 1 COMMENT 'Which attempt is this (1st, 2nd, etc)',
  `answered_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_user_materi_quiz` (`id_user`, `id_materi`),
  INDEX `idx_user_question` (`id_user`, `id_question`),
  INDEX `idx_selected_option` (`selected_option_id`),
  UNIQUE KEY `unique_attempt` (`id_user`, `id_materi`, `id_question`, `attempt_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Add all foreign keys for user_quiz_answers after table creation
ALTER TABLE `user_quiz_answers`
  ADD CONSTRAINT `fk_quiz_answers_user`
  FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_quiz_answers_materi`
  FOREIGN KEY (`id_materi`) REFERENCES `materi`(`id_materi`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_quiz_answers_questions`
  FOREIGN KEY (`id_question`) REFERENCES `questions`(`id_question`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_quiz_answers_options`
  FOREIGN KEY (`selected_option_id`) REFERENCES `question_options`(`id_option`) ON DELETE SET NULL;

-- 4. UPDATE user_materi_progress TABLE - ADD QUIZ TRACKING
-- Add new columns if they don't already exist
ALTER TABLE `user_materi_progress`
  ADD COLUMN `highest_quiz_score` INT DEFAULT 0 COMMENT 'Highest score achieved' AFTER `quiz_score`,
  ADD COLUMN `recent_quiz_score` INT DEFAULT 0 COMMENT 'Most recent score' AFTER `highest_quiz_score`,
  ADD COLUMN `last_quiz_attempt` TIMESTAMP NULL AFTER `quiz_passed`;

-- 5. CREATE INDEX FOR PERFORMANCE
CREATE INDEX `idx_user_materi_quiz_status` ON `user_materi_progress` (`id_user`, `id_matkul`, `quiz_completed`);
