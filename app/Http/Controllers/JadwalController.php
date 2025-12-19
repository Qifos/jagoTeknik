<?php
/**
 * Author : Akhtar Zia Faizarrobbi (NRP 5026231095)
 * File   : app/Http/Controllers/JadwalController.php
  * Date   : 04-11-2025
 */
namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class JadwalController extends Controller
{
    /**
     * Tampilkan halaman jadwal + data bulan berjalan.
     * Query optional:
     *  - month=YYYY-MM
     *  - date=YYYY-MM-DD
     */
    public function index(Request $request)
    {
        $month = $request->input('month');
        $date  = $request->input('date');

        $start = $month
            ? Carbon::createFromFormat('Y-m', $month)->startOfMonth()
            : now()->startOfMonth();

        $end   = (clone $start)->endOfMonth();

        $events = Jadwal::whereBetween('tanggal', [$start->toDateString(), $end->toDateString()])
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        $selectedDate   = $date ? Carbon::parse($date)->toDateString() : null;
        $eventsOfTheDay = $selectedDate ? $events->where('tanggal', $selectedDate) : collect();

        return view('jadwalview', compact('events', 'eventsOfTheDay', 'start', 'end', 'selectedDate'));
    }

    /**
     * Simpan jadwal baru.
     * (Semua kolom selain PK bersifat nullable sesuai tabelmu.)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kelas'    => ['nullable','integer'],
            'tanggal'     => ['nullable','date'],
            'jam_mulai'   => ['nullable','date_format:H:i'],
            'jam_selesai' => ['nullable','date_format:H:i'],
        ]);

        $jadwal = Jadwal::create($data);
        return redirect()->route('jadwal.show', $jadwal->id_jadwal)
            ->with('success', 'Jadwal dibuat.');
    }

    /**
     * Detail (opsional).
     */
    public function show(Jadwal $jadwal)
    {
        return view('jadwal.show', compact('jadwal'));
    }

    /**
     * Update jadwal.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $data = $request->validate([
            'id_kelas'    => ['nullable','integer'],
            'tanggal'     => ['nullable','date'],
            'jam_mulai'   => ['nullable','date_format:H:i'],
            'jam_selesai' => ['nullable','date_format:H:i'],
        ]);

        $jadwal->update($data);
        return back()->with('success', 'Jadwal diperbarui.');
    }

    /**
     * Hapus jadwal.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwalview')->with('success', 'Jadwal dihapus.');
    }

    /**
     * API sederhana untuk kalender per bulan.
     * GET /api/jadwal/bulan?month=2025-06
     */
    public function byMonth(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));
        $start = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $end   = (clone $start)->endOfMonth();

        $events = Jadwal::whereBetween('tanggal', [$start->toDateString(), $end->toDateString()])
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get()
            ->map(function ($e) {
                return [
                    'id'          => $e->id_jadwal,
                    'id_kelas'    => $e->id_kelas,
                    'tanggal'     => optional($e->tanggal)->toDateString(),
                    'jam_mulai'   => $e->jam_mulai,
                    'jam_selesai' => $e->jam_selesai,
                ];
            });

        return response()->json([
            'month'  => $start->format('Y-m'),
            'events' => $events,
        ]);
    }
}
