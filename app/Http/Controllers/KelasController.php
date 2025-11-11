<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Show the main kelas page (Kalkulus 2)
     */
    public function index()
    {
        // Pass mock data to the view
        $materiItems = [
            ['id' => 1, 'thumb' => 'https://placehold.co/600x400/0284c7/white?text=Fungsi', 'tag' => 'Teori', 'title' => 'Fungsi Transeden', 'instructor' => 'Nabila Rahadatul', 'progress' => 100, 'progress_text' => 'Finished'],
            ['id' => 2, 'thumb' => 'https://placehold.co/600x400/c026d3/white?text=Integrasi', 'tag' => 'Praktik', 'title' => 'Teknik Integrasi', 'instructor' => 'Nabila Rahadatul', 'progress' => 100, 'progress_text' => 'Finished'],
            ['id' => 3, 'thumb' => null, 'tag' => 'Praktik', 'title' => 'Integrasi Numerik', 'instructor' => 'Nabila Rahadatul', 'progress' => 71, 'progress_text' => 'Lesson 5 of 7'],
            ['id' => 4, 'thumb' => 'https://placehold.co/600x400/16a34a/white?text=Aplikasi', 'tag' => 'Praktik', 'title' => 'Aplikasi Integrasi Tertentu', 'instructor' => 'Nabila Rahadatul', 'progress' => 71, 'progress_text' => 'Lesson 5 of 7'],
            ['id' => 5, 'thumb' => 'https://placehold.co/600x400/d97706/white?text=Deret', 'tag' => 'Teori', 'title' => 'Deret Tak Terhingga', 'instructor' => 'Dr. Strange', 'progress' => 0, 'progress_text' => 'Lesson 0 of 5'],
            ['id' => 6, 'thumb' => null, 'tag' => 'Praktik', 'title' => 'Koordinat Kutub', 'instructor' => 'Tony Stark', 'progress' => 20, 'progress_text' => 'Lesson 1 of 5'],
        ];

        $videoItems = [
            ['id' => 1, 'thumb' => 'https://placehold.co/600x400/e11d48/white?text=QUIZ+1', 'title' => 'Video 1', 'instructor' => 'Ikhwanul Hafidz', 'progress' => 71, 'progress_text' => 'Lesson 5 of 7'],
            ['id' => 2, 'thumb' => 'https://placehold.co/600x400/f43f5e/white?text=QUIZ+2', 'title' => 'Video 2', 'instructor' => 'Nabila Rahadatul', 'progress' => 71, 'progress_text' => 'Lesson 5 of 7'],
            ['id' => 3, 'thumb' => null, 'title' => 'Video 3', 'instructor' => 'Muhammad Ridho', 'progress' => 71, 'progress_text' => 'Lesson 5 of 7'],
            ['id' => 4, 'thumb' => 'https://placehold.co/600x400/f97316/white?text=QUIZ+4', 'title' => 'Video 4', 'instructor' => 'Peter Parker', 'progress' => 0, 'progress_text' => 'Lesson 0 of 7'],
        ];

        return view('kelas', [
            'materiItems' => $materiItems,
            'videoItems' => $videoItems
        ]);
    }
}
