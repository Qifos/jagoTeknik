<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Show the materi listing page (for /kelas/materi)
     */
    public function materi()
    {
        // This route isn't for a specific item, so we pass default data
        return view('materi', ['materi' => [
            'id' => 1,
            'title' => 'Kupas Tuntas Rumus Kalkulus Dasar: Limit',
            'video_id' => 1
        ]]);
    }

    /**
     * Show the video listing page (for /kelas/video)
     */
    public function video()
    {
        // This route isn't for a specific item, so we pass default data
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
            'video_id' => $id // Pass a video ID to the teaser
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
