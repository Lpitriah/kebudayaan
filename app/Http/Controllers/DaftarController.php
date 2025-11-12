<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sanggar;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;

class DaftarController extends Controller
{
    // 🧭 INDEX: tampilkan daftar sanggar
// Di DaftarController.php
public function index(Request $request)
{
    $user = auth()->user();

    // admin lihat semua, user lihat miliknya
    $query = $user->level === 'admin'
        ? Sanggar::query()
        : Sanggar::where('user_id', $user->id);

    // pencarian
    if ($request->filled('search')) {
        $query->where('nama_sanggar', 'like', '%' . $request->search . '%');
    }

    // ambil data terbaru dari database (paginate)
    $sanggar = $query->orderByDesc('updated_at')->paginate(10);

    return view('daftar.index', compact('sanggar'));
}



    // 📝 FORM CREATE
    public function create()
    {
        return view('daftar.create');
    }

    // 💾 SIMPAN DATA
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_sanggar' => 'required|string|max:150',
            'jalan_rt_rw' => 'nullable|string|max:150',
            'desa_kel' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'no_sk' => 'nullable|string|max:50',
            'tahun_sk' => 'nullable|digits:4',
            'jabatan_penandatangan' => 'nullable|string|max:100',
            'nama_penandatangan' => 'nullable|string|max:100',
            'nama_pimpinan' => 'required|string|max:100',
            'jenis_kelamin' => 'nullable|in:L,P',
            'nik' => 'nullable|string|max:20',
            'no_hp' => 'nullable|string|max:20',
            'jumlah_anggota' => 'nullable|integer',
            'bidang_garapan_seni' => 'nullable|string|max:150',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // simpan foto ke storage/public/foto_sanggar
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_sanggar', 'public');
        }

        $validated['status'] = 'Menunggu';
        $validated['user_id'] = Auth::id();

        Sanggar::create($validated);

        return redirect()->route('daftar.index')
            ->with('success', 'Pendaftaran berhasil dikirim. Tunggu verifikasi admin.');
    }

    // 🔍 DETAIL
    public function show($id)
    {
        $sanggar = Sanggar::findOrFail($id);
        return view('daftar.show', compact('sanggar'));
    }

    // ✏️ EDIT
    public function edit($id)
    {
        $sanggar = Sanggar::findOrFail($id);
        return view('daftar.edit', compact('sanggar'));
    }

    // 🔁 UPDATE DATA
    public function update(Request $request, $id)
    {
        $sanggar = Sanggar::findOrFail($id);

        $validated = $request->validate([
            'nama_sanggar' => 'required|string|max:150',
            'nama_pimpinan' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // hapus foto lama jika ada
            if ($sanggar->foto && Storage::disk('public')->exists($sanggar->foto)) {
                Storage::disk('public')->delete($sanggar->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto_sanggar', 'public');
        }

        $sanggar->update($validated);

        return redirect()->route('daftar.index')
            ->with('success', 'Data sanggar berhasil diperbarui.');
    }

    // 🗑️ HAPUS
    public function destroy($id)
    {
        $sanggar = Sanggar::findOrFail($id);

        if ($sanggar->foto && Storage::disk('public')->exists($sanggar->foto)) {
            Storage::disk('public')->delete($sanggar->foto);
        }

        $sanggar->delete();

        return redirect()->route('daftar.index')
            ->with('success', 'Data sanggar berhasil dihapus.');
    }

    // 📄 CETAK PDF
    public function cetakBukti($id)
    {
        $sanggar = Sanggar::findOrFail($id);
        $pdf = PDF::loadView('daftar.pdf', compact('sanggar'))
            ->setPaper('A4', 'portrait');

        $namaFile = 'Bukti_Data_Sanggar_' . preg_replace('/\s+/', '_', $sanggar->nama_sanggar) . '.pdf';
        return $pdf->download($namaFile);
    }

    // ⚙️ UPDATE STATUS (AJAX atau biasa)
public function updateStatus(Request $request, $id)
{
    $sanggar = Sanggar::findOrFail($id);
    $sanggar->status = $request->status;
    $sanggar->save();

    return redirect()->route('daftar.index')->with('success', 'Status berhasil diperbarui!');
}

}
