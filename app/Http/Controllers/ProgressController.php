<?php

/**
 * Author : Muhammad Fiqih Soetam Putra (NRP 5026231096)
 * File   : app/Http/Controllers/ProgressController.php
 * Desc   : controller untuk mengelola progress tracking pengguna
 * Date   : 01-12-2025
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserMateriProgress;
use App\Models\UserMatkulProgress;
use App\Models\Materi;
use App\Models\Matkul;

class ProgressController extends Controller
{
    /**
     * Record video watch progress
     * POST /api/progress/video/{materiId}
     */
    public function recordVideoWatch(Request $request, $materiId)
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'watched_duration' => 'required|integer|min:0',
            'total_duration' => 'required|integer|min:0',
            'completed' => 'required|boolean',
        ]);

        try {
            $materi = Materi::findOrFail($materiId);

            $progress = UserMateriProgress::updateOrCreate(
                ['id_user' => $userId, 'id_materi' => $materiId],
                [
                    'id_matkul' => $materi->id_matkul,
                    'status' => 'in_progress',
                    'video_watched_duration' => $validated['watched_duration'],
                    'video_total_duration' => $validated['total_duration'],
                    'video_completed' => $validated['completed'],
                    'last_accessed_at' => now(),
                    'started_at' => $progress->started_at ?? now(), // Set started_at only on first access
                ]
            );

            // If video is completed and content is read, mark materi as completed
            if ($progress->video_completed && $progress->content_read) {
                $progress->status = 'completed';
                $progress->completed_at = now();
                $progress->save();

                // Update matkul progress percentage
                $this->updateMatkulProgress($userId, $materi->id_matkul);
            }

            return response()->json([
                'success' => true,
                'progress' => $progress,
                'message' => 'Video watch progress recorded',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error recording video progress: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Record content read progress
     * POST /api/progress/content/{materiId}
     */
    public function recordContentRead(Request $request, $materiId)
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'scroll_depth' => 'required|integer|min:0|max:100',
            'content_read' => 'required|boolean',
        ]);

        try {
            $materi = Materi::findOrFail($materiId);

            $progress = UserMateriProgress::updateOrCreate(
                ['id_user' => $userId, 'id_materi' => $materiId],
                [
                    'id_matkul' => $materi->id_matkul,
                    'status' => 'in_progress',
                    'scroll_depth' => $validated['scroll_depth'],
                    'content_read' => $validated['content_read'],
                    'last_accessed_at' => now(),
                    'started_at' => $progress->started_at ?? now(), // Set started_at only on first access
                ]
            );

            // If video is completed and content is read, mark materi as completed
            if ($progress->video_completed && $progress->content_read) {
                $progress->status = 'completed';
                $progress->completed_at = now();
                $progress->save();

                // Update matkul progress percentage
                $this->updateMatkulProgress($userId, $materi->id_matkul);
            }

            return response()->json([
                'success' => true,
                'progress' => $progress,
                'message' => 'Content read progress recorded',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error recording content progress: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Complete materi
     * POST /api/materi/complete/{materiId}
     */
    public function completeMateri($materiId)
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $materi = Materi::findOrFail($materiId);

            // Get or create progress record
            $progress = UserMateriProgress::firstOrCreate(
                ['id_user' => $userId, 'id_materi' => $materiId],
                ['id_matkul' => $materi->id_matkul]
            );

            // Mark as completed
            $progress->status = 'completed';
            $progress->completed_at = now();
            $progress->video_completed = true;
            $progress->content_read = true;
            $progress->save();

            // Update matkul progress
            $this->updateMatkulProgress($userId, $materi->id_matkul);

            return response()->json([
                'success' => true,
                'message' => 'Materi marked as completed',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error completing materi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check if materi is unlocked for user
     * GET /api/progress/check-unlock/{materiId}
     */
    public function checkMateriUnlock($materiId)
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $materi = Materi::findOrFail($materiId);

            // Get all materi for this matkul ordered by id
            $allMateri = Materi::where('id_matkul', $materi->id_matkul)
                ->orderBy('id_materi', 'asc')
                ->get();

            // Find current materi index
            $currentIndex = $allMateri->search(function($m) use ($materiId) {
                return $m->id_materi === $materiId;
            });

            // Check if this is the first materi
            if ($currentIndex === 0) {
                return response()->json(['unlocked' => true, 'reason' => 'First materi']);
            }

            // Check if all previous materi are completed
            $previousMateri = $allMateri->slice(0, $currentIndex);
            $previousCompleted = UserMateriProgress::where('id_user', $userId)
                ->whereIn('id_materi', $previousMateri->pluck('id_materi'))
                ->where('status', 'completed')
                ->count();

            $isUnlocked = $previousCompleted === $previousMateri->count();

            return response()->json([
                'unlocked' => $isUnlocked,
                'message' => $isUnlocked ? 'Materi unlocked' : 'Complete previous materi to unlock this one',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error checking materi unlock: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user progress for a matkul
     * GET /api/progress/matkul/{matkulId}
     */
    public function getMatkulProgress($matkulId)
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $progress = UserMatkulProgress::where('id_user', $userId)
                ->where('id_matkul', $matkulId)
                ->first();

            if (!$progress) {
                // Create default progress record
                $progress = UserMatkulProgress::create([
                    'id_user' => $userId,
                    'id_matkul' => $matkulId,
                    'status' => 'di_ikuti',
                    'progress_percentage' => 0,
                ]);
            }

            return response()->json([
                'success' => true,
                'progress' => $progress,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error getting progress: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Record content scroll to bottom
     * POST /api/progress/scroll/{materiId}
     */
    public function recordContentScroll(Request $request, $materiId)
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'scroll_depth' => 'required|integer|min:0|max:100',
        ]);

        try {
            $materi = Materi::findOrFail($materiId);

            $scrolledToBottom = $validated['scroll_depth'] >= 90; // Consider 90% as bottom

            $progress = UserMateriProgress::updateOrCreate(
                ['id_user' => $userId, 'id_materi' => $materiId],
                [
                    'id_matkul' => $materi->id_matkul,
                    'status' => 'in_progress',
                    'scroll_depth' => $validated['scroll_depth'],
                    'content_read' => true,
                    'content_scrolled_to_bottom' => $scrolledToBottom,
                    'last_accessed_at' => now(),
                    'started_at' => isset($progress) ? $progress->started_at : now(),
                ]
            );

            return response()->json([
                'success' => true,
                'scrolled_to_bottom' => $scrolledToBottom,
                'progress' => $progress,
                'message' => $scrolledToBottom ? 'Content reading marked as complete' : 'Content scroll progress recorded',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error recording scroll progress: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Record video completion and update materi status
     * POST /api/progress/video-complete/{materiId}
     */
    public function recordVideoCompletion(Request $request, $materiId)
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'watch_percentage' => 'required|integer|min:0|max:100',
            'total_duration' => 'required|integer|min:0',
        ]);

        try {
            $materi = Materi::findOrFail($materiId);

            $progress = UserMateriProgress::updateOrCreate(
                ['id_user' => $userId, 'id_materi' => $materiId],
                [
                    'id_matkul' => $materi->id_matkul,
                    'video_watch_percentage' => $validated['watch_percentage'],
                    'video_total_duration' => $validated['total_duration'],
                    'video_completed' => $validated['watch_percentage'] >= 80, // 80% = watched
                    'last_accessed_at' => now(),
                ]
            );

            // Mark as completed if both content read and video watched
            if ($progress->content_scrolled_to_bottom && $progress->video_completed) {
                $progress->status = 'completed';
                $progress->is_completed = true;
                $progress->completed_at = now();
                $progress->save();

                // Update matkul progress
                $this->updateMatkulProgress($userId, $materi->id_matkul);
            }

            return response()->json([
                'success' => true,
                'video_completed' => $progress->video_completed,
                'progress' => $progress,
                'message' => 'Video watch recorded',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error recording video completion: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get progress for all materi in a matkul
     * GET /api/progress/matkul/{matkulId}/materi
     */
    public function getMateriProgressList($matkulId)
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $materiList = Materi::where('id_matkul', $matkulId)
                ->orderBy('id_materi', 'asc')
                ->get();

            $materiProgress = $materiList->map(function($materi) use ($userId) {
                $progress = UserMateriProgress::where('id_user', $userId)
                    ->where('id_materi', $materi->id_materi)
                    ->first();

                return [
                    'id_materi' => $materi->id_materi,
                    'nama_materi' => $materi->nama_materi,
                    'is_completed' => $progress ? $progress->is_completed : false,
                    'content_read' => $progress ? $progress->content_read : false,
                    'video_completed' => $progress ? $progress->video_completed : false,
                    'status_text' => $progress && $progress->is_completed ? 'Sudah dibaca' : 'Belum dibaca',
                ];
            });

            return response()->json([
                'success' => true,
                'materi_progress' => $materiProgress,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error getting materi progress list: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update matkul progress percentage and status
     * Helper method
     */
    private function updateMatkulProgress($userId, $matkulId)
    {
        $matkul = Matkul::findOrFail($matkulId);
        $totalMateri = Materi::where('id_matkul', $matkulId)->count();

        if ($totalMateri === 0) {
            $progressPercentage = 100;
        } else {
            $completedMateri = UserMateriProgress::where('id_user', $userId)
                ->where('id_matkul', $matkulId)
                ->where('is_completed', true)
                ->count();

            $progressPercentage = round(($completedMateri / $totalMateri) * 100);
        }

        // Get earliest started_at from all materi for this matkul
        $earliestStart = UserMateriProgress::where('id_user', $userId)
            ->where('id_matkul', $matkulId)
            ->whereNotNull('started_at')
            ->orderBy('started_at', 'asc')
            ->first()
            ->started_at ?? now();

        // Update or create progress record
        $matkulProgress = UserMatkulProgress::updateOrCreate(
            ['id_user' => $userId, 'id_matkul' => $matkulId],
            [
                'progress_percentage' => $progressPercentage,
                'status' => $progressPercentage === 100 ? 'selesai' : 'di_ikuti',
                'started_at' => $earliestStart,
                'completed_at' => $progressPercentage === 100 ? now() : null,
                'last_accessed_at' => now(),
            ]
        );

        return $matkulProgress;
    }
}
