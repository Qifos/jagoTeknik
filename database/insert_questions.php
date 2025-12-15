<?php
// Insert sample quiz questions and options
try {
    $mysqli = new mysqli('127.0.0.1', 'root', '', 'jago_teknik');

    if ($mysqli->connect_error) {
        die('Connection error: ' . $mysqli->connect_error);
    }

    // Insert questions for materi 1
    $queries = [
        "INSERT INTO questions (id_materi, question_text, question_type, difficulty_level) VALUES (1, 'Apa pengertian dari fungsi transeden?', 'multiple_choice', 'easy')",
        "INSERT INTO questions (id_materi, question_text, question_type, difficulty_level) VALUES (1, 'Manakah yang merupakan contoh fungsi transeden?', 'multiple_choice', 'medium')",
        "INSERT INTO questions (id_materi, question_text, question_type, difficulty_level) VALUES (1, 'Fungsi logaritma alami didefinisikan sebagai integral dari?', 'multiple_choice', 'hard')",

        // Options for question 1
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (1, 'Fungsi yang dapat dinyatakan sebagai kombinasi aljabar', 'A', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (1, 'Fungsi yang tidak dapat dinyatakan sebagai kombinasi aljabar', 'B', 1)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (1, 'Fungsi polinomial derajat tinggi', 'C', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (1, 'Fungsi yang selalu bernilai positif', 'D', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (1, 'Fungsi trigonometri dasar', 'E', 0)",

        // Options for question 2
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (2, 'Fungsi kuadrat', 'A', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (2, 'Fungsi eksponensial e^x', 'B', 1)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (2, 'Fungsi linear', 'C', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (2, 'Fungsi kubik', 'D', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (2, 'Fungsi konstan', 'E', 0)",

        // Options for question 3
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (3, 'Integral dari x sampai x^2', 'A', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (3, 'Integral dari 1/t dari 0 sampai x', 'B', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (3, 'Integral dari 1/t dari 1 sampai x', 'C', 1)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (3, 'Integral dari e^t dari 1 sampai x', 'D', 0)",
        "INSERT INTO question_options (id_question, option_text, option_letter, is_correct) VALUES (3, 'Integral dari sin(t) dari 1 sampai x', 'E', 0)",
    ];

    foreach ($queries as $query) {
        if (!$mysqli->query($query)) {
            echo "Error: " . $mysqli->error . "\n";
        } else {
            echo "Query executed successfully\n";
        }
    }

    echo "All questions inserted!\n";
    $mysqli->close();

} catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
}
?>
