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
            return redirect()->route('login.view');
        }

        // Get videos for this materi
        $videos = Video::where('id_materi', $id)->get();

        return view('materi', [
            'materi' => $materi,
            'matkul' => $matkul,
            'videos' => $videos
        ]);
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

        return view('video', [
            'video' => $video,
            'materi' => $materi,
            'matkul' => $matkul,
            'relatedVideos' => $relatedVideos
        ]);
    }

    /**
     * Show materi listing page (legacy)
     */
    public function materi()
    {
        return view('materi', ['materi' => [
            'id' => 1,
            'title' => 'Kupas Tuntas Rumus Kalkulus Dasar: Limit',
            'video_id' => 1
        ]]);
    }

    /**
     * Show video listing page (legacy)
     */
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

    /**
     * Show an image/material by id (for /media/image/{id})
     */
    public function showImage($id)
    {
        // Mock data for the specific material
        $materi = [
            'id' => $id,
            'title' => 'Kupas Tuntas Rumus Kalkulus Dasar: Limit (ID: ' . $id . ')',
            'video_id' => $id
        ];
        return view('materi', ['materi' => $materi]);
    }

    /**
     * Show a video by id (for /media/video/{id})
     */
    public function showVideo($id)
    {
        // Mock data for the specific video
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
