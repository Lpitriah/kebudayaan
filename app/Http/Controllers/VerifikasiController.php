<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sanggar;

class VerifikasiController extends Controller
{
    // Hanya admin yang bisa mengakses halaman verifikasi
    public function index(Request $request)
    {
        if (auth()->user()->level !== 'admin') {
            abort(403, 'Akses ditolak — hanya admin yang bisa mengakses halaman ini.');
        }

        $query = Sanggar::query();

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_sanggar', 'like', "%{$search}%")
                  ->orWhere('nama_pimpinan', 'like', "%{$search}%");
        }

        $sanggar = $query->orderBy('created_at', 'desc')
                         ->paginate(100)
                         ->withQueryString();

        return view('verifikasi.index', compact('sanggar'));
    }

    // Detail sanggar
    public function show($id)
    {
        if (auth()->user()->level !== 'admin') {
            abort(403, 'Akses ditolak — hanya admin yang bisa mengakses halaman ini.');
        }

        $sanggar = Sanggar::findOrFail($id);
        return view('verifikasi.show', compact('sanggar'));
    }

    // Update status verifikasi
    public function updateStatus(Request $request, $id)
    {
        if (auth()->user()->level !== 'admin') {
            abort(403, 'Akses ditolak — hanya admin yang bisa memperbarui status.');
        }

        $sanggar = Sanggar::findOrFail($id);

        // Validasi
        $rules = [
            'status' => 'required|in:Menunggu,Disetujui,Ditolak',
            'keterangan_status' => 'nullable|string|max:255',
            'nomor_induk_kebudayaan' => 'nullable|string|max:50',
        ];

        if ($request->status === 'Disetujui') {
            $rules['nomor_induk_kebudayaan'] = 'required|string|max:50';
        }

        if ($request->status === 'Ditolak') {
            $rules['keterangan_status'] = 'required|string|max:255';
        }

        $validated = $request->validate($rules);

        // Update data sesuai status
        $sanggar->status = $validated['status'];
        $sanggar->nomor_induk_kebudayaan = $validated['status'] === 'Disetujui'
            ? $validated['nomor_induk_kebudayaan']
            : null;
        $sanggar->keterangan_status = $validated['status'] === 'Ditolak'
            ? $validated['keterangan_status']
            : null;

        $sanggar->save();

        return redirect()->route('verifikasi.index')->with('success', 'Status verifikasi berhasil diperbarui.');
    }
}
