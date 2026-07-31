<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        // SEKARANG: Hanya menampilkan data milik user yang sedang login saja
        // Sesuai permintaan: Jika dia Superadmin, dia hanya lihat rekap absen dia sendiri.
        $attendances = Attendance::where('user_id', Auth::id())
                                ->orderBy('tanggal', 'desc')
                                ->get();

        return view('attendance.index', compact('attendances'));
    }

    public function store(Request $request)
    {
        $exists = Attendance::where('user_id', Auth::id())
                            ->whereDate('tanggal', now()->toDateString())
                            ->exists();

        if ($exists) {
            return redirect()->route('attendance.index')->with('error', 'Sesi hari ini sudah tercatat.');
        }

        Attendance::create([
            'user_id'   => Auth::id(),
            'tanggal'   => now()->toDateString(),
            'jam_masuk' => now()->toTimeString(),
            'status'    => 'hadir', // Status hadir jika klik tombol
        ]);

        return redirect()->route('attendance.index')->with('success', 'Presensi berhasil dicatat!');
    }
}