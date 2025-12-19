<?php

/**
 * Author : System
 * File   : app/Http/Controllers/QuizController.php
 * Desc   : controller untuk mengelola quiz/questions
 * Date   : 16-12-2025
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\UserQuizAnswer;
use App\Models\UserMateriProgress;
use App\Models\Materi;

class QuizController extends Controller
{
    /**
     * Get all questions for a materi
     * GET /api/quiz/materi/{materiId}
     */
    public function getQuestions($materiId)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            if (!is_numeric($materiId)) {
                return response()->json(['error' => 'Invalid materi ID'], 400);
            }

            if (!Materi::where('id_materi', $materiId)->exists()) {
                return response()->json(['error' => 'Materi not found'], 404);
            }

            $questions = Question::where('id_materi', $materiId)
                ->with('options')
                ->get();

            if ($questions->isEmpty()) {
                return response()->json(['error' => 'No questions found for this materi'], 400);
            }

            // Get user's latest attempt number
            $latestAttempt = UserQuizAnswer::where('id_user', $user->id_user)
                ->where('id_materi', $materiId)
                ->max('attempt_number') ?? 0;

            // Get user's previous answers from current/next attempt
            $userAnswers = UserQuizAnswer::where('id_user', $user->id_user)
                ->where('id_materi', $materiId)
                ->where('attempt_number', $latestAttempt + 1)
                ->get()
                ->keyBy('id_question');

            $questionsData = $questions->map(function($question) use ($userAnswers) {
                return [
                    'id_question' => $question->id_question,
                    'question_text' => $question->question_text,
                    'question_type' => $question->question_type,
                    'difficulty_level' => $question->difficulty_level,
                    'options' => $question->options->map(function($option) {
                        return [
                            'id_option' => $option->id_option,
                            'option_text' => $option->option_text,
                            'option_letter' => $option->option_letter,
                        ];
                    }),
                    'user_answer' => isset($userAnswers[$question->id_question])
                        ? $userAnswers[$question->id_question]->selected_option_id
                        : null,
                ];
            });

            return response()->json([
                'success' => true,
                'questions' => $questionsData,
                'total_questions' => $questions->count(),
                'current_attempt' => $latestAttempt + 1,
            ]);

        } catch (\Throwable $e) {
            \Log::error('Get questions error', [
                'user_id' => Auth::user()?->id_user ?? 'unknown',
                'materi_id' => $materiId ?? 'unknown',
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'error' => 'Terjadi kesalahan saat memuat pertanyaan',
            ], 500);
        }
    }

    /**
     * Submit quiz answer
     * POST /api/quiz/answer/{materiId}
     */
    public function submitAnswer(Request $request, $materiId)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $validated = $request->validate([
                'id_question' => 'required|integer',
                'selected_option_id' => 'required|integer',
                'attempt_number' => 'required|integer|min:1',
            ]);

            $question = Question::find($validated['id_question']);
            if (!$question) {
                return response()->json(['error' => 'Question not found'], 404);
            }

            $option = QuestionOption::find($validated['selected_option_id']);
            if (!$option) {
                return response()->json(['error' => 'Option not found'], 404);
            }

            // Verify question belongs to this materi
            if ($question->id_materi != $materiId) {
                return response()->json(['error' => 'Question does not belong to this materi'], 400);
            }

            // Verify option belongs to this question
            if ($option->id_question != $validated['id_question']) {
                return response()->json(['error' => 'Option does not belong to this question'], 400);
            }

            $isCorrect = (bool)$option->is_correct;

            // Save or update user answer for this attempt
            $userAnswer = UserQuizAnswer::updateOrCreate(
                [
                    'id_user' => $user->id_user,
                    'id_question' => $validated['id_question'],
                    'id_materi' => $materiId,
                    'attempt_number' => $validated['attempt_number'],
                ],
                [
                    'selected_option_id' => $validated['selected_option_id'],
                    'is_correct' => $isCorrect,
                    'answered_at' => now(),
                ]
            );

            return response()->json([
                'success' => true,
                'is_correct' => $isCorrect,
                'message' => $isCorrect ? 'Jawaban Anda benar!' : 'Jawaban Anda salah',
            ]);

        } catch (\Throwable $e) {
            \Log::error('Quiz submit answer error', [
                'user_id' => Auth::user()?->id_user ?? 'unknown',
                'materi_id' => $materiId ?? 'unknown',
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan saat menyimpan jawaban',
            ], 500);
        }
    }

    /**
     * Complete quiz and calculate score
     * POST /api/quiz/complete/{materiId}
     */
    public function completeQuiz($materiId)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
            }

            // Validate materiId is numeric
            if (!is_numeric($materiId)) {
                return response()->json(['success' => false, 'error' => 'Invalid materi ID'], 400);
            }

            // Ensure materi exists
            if (!Materi::where('id_materi', $materiId)->exists()) {
                return response()->json(['success' => false, 'error' => 'Materi not found'], 404);
            }

            // Get all questions for this materi
            $totalQuestions = Question::where('id_materi', $materiId)->count();

            if ($totalQuestions == 0) {
                return response()->json(['success' => false, 'error' => 'No questions found for this materi'], 400);
            }

            // Get the latest attempt number
            $latestAttempt = UserQuizAnswer::where('id_user', $user->id_user)
                ->where('id_materi', $materiId)
                ->max('attempt_number');

            // If no attempts yet, use attempt 1
            if (is_null($latestAttempt)) {
                $latestAttempt = 1;
            }

            // Get user's answers for the CURRENT ATTEMPT only
            $userAnswers = UserQuizAnswer::where('id_user', $user->id_user)
                ->where('id_materi', $materiId)
                ->where('attempt_number', $latestAttempt)
                ->get();

            // Count correct answers for current responses
            $correctAnswers = $userAnswers->where('is_correct', true)->count();
            $answeredQuestions = $userAnswers->count();

            // If not all questions answered, return error
            if ($answeredQuestions < $totalQuestions) {
                return response()->json([
                    'success' => false,
                    'error' => 'Mohon jawab semua pertanyaan sebelum submit (Sudah jawab ' . $answeredQuestions . ' dari ' . $totalQuestions . ')'
                ], 422);
            }

            $score = round(($correctAnswers / $totalQuestions) * 100);
            $passed = $score >= 70; // 70% is passing score

            // Get or create progress record
            $progress = UserMateriProgress::firstOrCreate(
                [
                    'id_user' => $user->id_user,
                    'id_materi' => $materiId,
                ],
                [
                    'id_matkul' => 1, // Default value, will be updated below
                    'started_at' => now(),
                ]
            );

            // Update with materi's matkul if needed
            if (!$progress->id_matkul) {
                $materi = Materi::find($materiId);
                if ($materi && isset($materi->id_matkul)) {
                    $progress->id_matkul = $materi->id_matkul;
                }
            }

            // Update scores
            // Set highest score if this is the first attempt or current score is higher
            if (is_null($progress->highest_quiz_score) || $progress->highest_quiz_score < $score) {
                $progress->highest_quiz_score = $score;
            }

            // Always update recent score
            $progress->recent_quiz_score = $score;
            $progress->quiz_completed = true;
            $progress->quiz_passed = $passed;
            $progress->last_quiz_attempt = now();

            // Only mark complete if passed the quiz
            if ($passed) {
                $progress->is_completed = true;
                $progress->completed_at = now();
            }

            $progress->save();

            return response()->json([
                'success' => true,
                'score' => (int)$score,
                'highest_score' => (int)($progress->highest_quiz_score ?? 0),
                'recent_score' => (int)($progress->recent_quiz_score ?? 0),
                'passed' => (bool)$passed,
                'correct_answers' => (int)$correctAnswers,
                'total_questions' => (int)$totalQuestions,
                'message' => $passed
                    ? 'Selamat! Anda berhasil menyelesaikan quiz dengan skor ' . $score . '%'
                    : 'Skor Anda ' . $score . '%. Coba lagi untuk mencapai minimal 70%',
            ], 200);

        } catch (\Throwable $e) {
            // Catch all exceptions including fatal errors
            \Log::error('Quiz complete error', [
                'user_id' => Auth::user()?->id_user ?? 'unknown',
                'materi_id' => $materiId ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan saat menyelesaikan quiz. Silahkan coba lagi.',
                'debug' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Start a new quiz attempt
     * POST /api/quiz/attempt/{materiId}
     */
    public function startNewAttempt($materiId)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
            }

            if (!is_numeric($materiId)) {
                return response()->json(['success' => false, 'error' => 'Invalid materi ID'], 400);
            }

            if (!Materi::where('id_materi', $materiId)->exists()) {
                return response()->json(['success' => false, 'error' => 'Materi not found'], 404);
            }

            // Get latest attempt number
            $latestAttempt = UserQuizAnswer::where('id_user', $user->id_user)
                ->where('id_materi', $materiId)
                ->max('attempt_number') ?? 0;

            $nextAttemptNumber = $latestAttempt + 1;

            return response()->json([
                'success' => true,
                'attempt_number' => (int)$nextAttemptNumber,
                'message' => 'Memulai percobaan ke ' . $nextAttemptNumber,
            ]);

        } catch (\Throwable $e) {
            \Log::error('Start new attempt error', [
                'user_id' => Auth::user()?->id_user ?? 'unknown',
                'materi_id' => $materiId ?? 'unknown',
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan saat memulai percobaan baru',
            ], 500);
        }
    }

    /**
     * Get quiz results for a materi
     * GET /api/quiz/results/{materiId}
     */
    public function getResults($materiId)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            if (!is_numeric($materiId)) {
                return response()->json(['error' => 'Invalid materi ID'], 400);
            }

            $answers = UserQuizAnswer::where('id_user', $user->id_user)
                ->where('id_materi', $materiId)
                ->with('question', 'selectedOption')
                ->get();

            if ($answers->isEmpty()) {
                return response()->json(['error' => 'No quiz attempts found'], 404);
            }

            $resultsData = $answers->map(function($answer) {
                $correctOption = $answer->question->options->where('is_correct', true)->first();
                return [
                    'id_question' => $answer->id_question,
                    'question_text' => $answer->question->question_text,
                    'user_answer' => $answer->selectedOption->option_text ?? 'No answer',
                    'is_correct' => (bool)$answer->is_correct,
                    'correct_option' => $correctOption ? $correctOption->option_text : 'N/A',
                    'attempt_number' => (int)$answer->attempt_number,
                ];
            });

            return response()->json([
                'success' => true,
                'results' => $resultsData,
            ]);

        } catch (\Throwable $e) {
            \Log::error('Get results error', [
                'user_id' => Auth::user()?->id_user ?? 'unknown',
                'materi_id' => $materiId ?? 'unknown',
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'error' => 'Terjadi kesalahan saat mengambil hasil',
            ], 500);
        }
    }
}
