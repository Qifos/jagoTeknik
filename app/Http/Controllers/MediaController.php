<?php

/**
 * Author : Muhammad Fiqih Soetam Putra (NRP 5026231096)
 * File   : app/Http/Controllers/MediaController.php
 * Desc   : media controller untuk mengelola materi dan video
 * Date   : 25-11-2025
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Materi;
use App\Models\Video;
use App\Models\Matkul;
use App\Models\BeliMatkul;
use App\Models\Question;
use App\Models\UserQuizAnswer;
use App\Models\UserMateriProgress; // Added missing import

class MediaController extends Controller
{
    /**
     * Show specific materi content
     * GET /materi/{id} -> Shows specific material content
     */
    public function showMateri($id)
    {
        $user = Auth::user();

        // Find the materi
        $materi = Materi::findOrFail($id);

        // Get the matkul (class) for this materi
        $matkul = Matkul::findOrFail($materi->id_matkul);

        // Check if user has purchased this class
        if ($user) {
            $sudahDibeli = BeliMatkul::where('id_user', $user->id_user)
                ->where('id_matkul', $materi->id_matkul)
                ->exists();

            if (!$sudahDibeli) {
                return redirect()->route('kelas.beli', $materi->id_matkul)
                    ->with('error', 'Silakan beli kelas terlebih dahulu untuk mengakses materi ini.');
            }
        } else {
            return redirect()->route('login.view')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Check if materi is unlocked
        if (!$this->isMateriUnlocked($user->id_user, $materi->id_matkul, $id)) {
            return redirect()->route('kelas.detail.beli', $materi->id_matkul)
                ->with('error', 'Materi ini belum terbuka. Selesaikan materi sebelumnya terlebih dahulu.');
        }

        // Get videos for this materi
        $videos = Video::where('id_materi', $id)->get();

        // --- NEW LOGIC START ---

        // 1. Get User Progress to check if quiz is already passed
        $progress = null;
        if ($user) {
            $progress = UserMateriProgress::where('id_user', $user->id_user)
                ->where('id_materi', $id)
                ->first();
        }

        // 2. Find Next Materi (for the Next button)
        $nextMateri = Materi::where('id_matkul', $materi->id_matkul)
            ->where('id_materi', '>', $id)
            ->orderBy('id_materi', 'asc')
            ->first();

        // 3. Find Previous Materi (Optional, good for navigation)
        $prevMateri = Materi::where('id_matkul', $materi->id_matkul)
            ->where('id_materi', '<', $id)
            ->orderBy('id_materi', 'desc')
            ->first();

        // --- NEW LOGIC END ---

        return view('materi', [
            'materi' => $materi,
            'matkul' => $matkul,
            'videos' => $videos,
            'progress' => $progress,    // Pass progress to view
            'nextMateri' => $nextMateri, // Pass next materi to view
            'prevMateri' => $prevMateri
        ]);
    }

    /**
     * Check if materi is unlocked for user
     * First materi is always unlocked, others need previous materi to be completed
     */
    private function isMateriUnlocked($userId, $matkulId, $materiId)
    {
        try {
            // Get all materies for this matkul ordered by id
            $allMateri = Materi::where('id_matkul', $matkulId)
                ->orderBy('id_materi', 'asc')
                ->get();

            if ($allMateri->isEmpty()) {
                return false;
            }

            // Find current materi by ID (convert to ensure same type)
            $currentIndex = null;
            foreach ($allMateri as $idx => $m) {
                if ((int)$m->id_materi === (int)$materiId) {
                    $currentIndex = $idx;
                    break;
                }
            }

            // If not found, it doesn't exist
            if ($currentIndex === null) {
                return false;
            }

            // First materi is always unlocked
            if ($currentIndex === 0) {
                return true;
            }

            // For other materies, check if all previous materies are completed
            $previousMateri = $allMateri->slice(0, $currentIndex);
            $previousMateriIds = $previousMateri->pluck('id_materi')->toArray();

            $previousCompleted = UserMateriProgress::where('id_user', $userId)
                ->whereIn('id_materi', $previousMateriIds)
                ->where('quiz_passed', true)
                ->count();

            // All previous materies must be completed
            return $previousCompleted === count($previousMateriIds);
        } catch (\Exception $e) {
            // If there's any error, log it and return false for safety
            \Log::error('Error checking materi unlock', ['error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Show specific video content
     * GET /video/{id} -> Shows specific video content
     */
    public function showVideoDetail($id)
    {
        $user = Auth::user();

        // Find the video
        $video = Video::findOrFail($id);

        // Get the materi for this video
        $materi = Materi::findOrFail($video->id_materi);

        // Get the matkul (class) for this materi
        $matkul = Matkul::findOrFail($materi->id_matkul);

        // Check if user has purchased this class
        if ($user) {
            $sudahDibeli = BeliMatkul::where('id_user', $user->id_user)
                ->where('id_matkul', $materi->id_matkul)
                ->exists();

            if (!$sudahDibeli) {
                return redirect()->route('kelas.beli', $materi->id_matkul)
                    ->with('error', 'Silakan beli kelas terlebih dahulu untuk mengakses video ini.');
            }
        } else {
            return redirect()->route('login.view');
        }

        // Get related videos in the same materi
        $relatedVideos = Video::where('id_materi', $video->id_materi)
            ->where('id_video', '!=', $id)
            ->get();

        // Get questions for this materi
        $questions = Question::where('id_materi', $materi->id_materi)
            ->with('options')
            ->get();

        // Get user's previous answers (if any)
        $userAnswers = [];
        if ($user) {
            $answers = UserQuizAnswer::where('id_user', $user->id_user)
                ->where('id_materi', $materi->id_materi)
                ->get();
            foreach ($answers as $answer) {
                $userAnswers[$answer->id_question] = $answer->selected_option_id;
            }
        }

        return view('video', [
            'video' => $video,
            'materi' => $materi,
            'matkul' => $matkul,
            'relatedVideos' => $relatedVideos,
            'questions' => $questions,
            'userAnswers' => $userAnswers,
            'user' => $user
        ]);
    }

    // Legacy/Mock methods kept for compatibility if needed,
    // but typically these should be removed in production if unused.
    public function materi()
    {
        return view('materi', ['materi' => [
            'id' => 1,
            'title' => 'Kupas Tuntas Rumus Kalkulus Dasar: Limit',
            'video_id' => 1
        ]]);
    }

    public function video()
    {
        return view('video', ['video' => [
            'id' => 1,
            'title' => 'Limit',
            'description' => 'Belajar kalkulus untuk meraih perhitungan yang lebih akurat',
            'instructor' => 'Muhammad Ridho',
            'angkatan' => 2023
        ]]);
    }

    public function showImage($id)
    {
        $materi = [
            'id' => $id,
            'title' => 'Kupas Tuntas Rumus Kalkulus Dasar: Limit (ID: ' . $id . ')',
            'video_id' => $id
        ];
        return view('materi', ['materi' => $materi]);
    }

    public function showVideo($id)
    {
        $video = [
            'id' => $id,
            'title' => 'Limit (Video ' . $id . ')',
            'description' => 'Belajar kalkulus untuk meraih perhitungan yang lebih akurat',
            'instructor' => 'Muhammad Ridho',
            'angkatan' => 2023
        ];
        return view('video', ['video' => $video, 'videoId' => $id]);
    }
}
