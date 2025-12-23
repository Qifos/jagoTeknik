<?php
// Clear and re-insert quiz questions with correct options for each
try {
    $mysqli = new mysqli('127.0.0.1', 'root', '', 'jago_teknik');

    if ($mysqli->connect_error) {
        die('Connection error: ' . $mysqli->connect_error);
    }

    // Clear existing data
    $mysqli->query("DELETE FROM question_options");
    $mysqli->query("DELETE FROM questions");

    // Reset auto_increment
    $mysqli->query("ALTER TABLE questions AUTO_INCREMENT = 1");
    $mysqli->query("ALTER TABLE question_options AUTO_INCREMENT = 1");

    // Insert questions for materi 1
    $queries = [
        // === MATERI 1 QUESTIONS ===
        "INSERT INTO questions (id_materi, question_text, question_type, difficulty_level) VALUES (1, 'Apa pengertian dari fungsi transeden?', 'multiple_choice', 'easy')",
        "INSERT INTO questions (id_materi, question_text, question_type, difficulty_level) VALUES (1, 'Manakah yang merupakan contoh fungsi transeden?', 'multiple_choice', 'medium')",
        "INSERT INTO questions (id_materi, question_text, question_type, difficulty_level) VALUES (1, 'Fungsi logaritma alami didefinisikan sebagai integral dari?', 'multiple_choice', 'hard')",

        // Options for question 1
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (1, 'Fungsi yang dapat dinyatakan sebagai kombinasi aljabar', 'A', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (1, 'Fungsi yang tidak dapat dinyatakan sebagai kombinasi aljabar', 'B', 1)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (1, 'Fungsi polinomial derajat tinggi', 'C', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (1, 'Fungsi yang selalu bernilai positif', 'D', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (1, 'Fungsi trigonometri dasar', 'E', 0)",

        // DIFFERENT Options for question 2
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (2, 'Fungsi kuadrat f(x) = x²', 'A', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (2, 'Fungsi eksponensial f(x) = e^x', 'B', 1)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (2, 'Fungsi linear f(x) = 2x + 1', 'C', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (2, 'Fungsi kubik f(x) = x³ - 2x', 'D', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (2, 'Fungsi konstan f(x) = 5', 'E', 0)",

        // DIFFERENT Options for question 3
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (3, 'Integral dari x sampai x²', 'A', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (3, 'Integral dari 1/t dari 0 sampai x', 'B', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (3, 'Integral dari 1/t dari 1 sampai x', 'C', 1)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (3, 'Integral dari e^t dari 1 sampai x', 'D', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (3, 'Integral dari sin(t) dari 1 sampai x', 'E', 0)",
    ];

    $count = 0;
    foreach ($queries as $query) {
        if ($mysqli->query($query)) {
            $count++;
        } else {
            echo "Error: " . $mysqli->error . "\n";
        }
    }

    echo "Successfully processed $count queries!\n";
    $mysqli->close();

} catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
}
?>
