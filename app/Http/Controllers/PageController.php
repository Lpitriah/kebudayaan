<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sanggar;

class PageController extends Controller
{
    /**
     * Tampilkan halaman dashboard (untuk admin & user).
     */
    public function index()
    {
        $user = Auth::user();

        // Hitung total semua sanggar (untuk info umum)
        $totalSanggar = Sanggar::count();

        // Jika admin login → tampilkan data keseluruhan
        if ($user->level === 'admin') {
            $recentSanggar = Sanggar::latest()
                ->take(5)
                ->get();

            // Data tambahan (untuk dashboard admin)
            $menunggu = Sanggar::where('status', 'menunggu')->count();
            $disetujui = Sanggar::where('status', 'disetujui')->count();
            $ditolak   = Sanggar::where('status', 'ditolak')->count();

            return view('dashboard.index', [
                'title' => 'Dashboard Admin',
                'isAdmin' => true,
                'totalSanggar' => $totalSanggar,
                'recentSanggar' => $recentSanggar,
                'menunggu' => $menunggu,
                'disetujui' => $disetujui,
                'ditolak' => $ditolak,
            ]);
        }

        // Jika user biasa login → tampilkan hanya sanggar miliknya
        else {
            // pastikan user hanya melihat sanggarnya sendiri
            $sanggar = Sanggar::where('user_id', auth()->id())->get();


            return view('dashboard.index', [
                'title' => 'Dashboard User',
                'isAdmin' => false,
                'sanggar' => $sanggar,
            ]);
        }
    }
}
