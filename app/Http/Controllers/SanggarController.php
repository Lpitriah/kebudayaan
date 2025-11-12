<?php

namespace App\Http\Controllers;

use App\Models\Sanggar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SanggarImport;
use App\Exports\SanggarExport;

class SanggarController extends Controller
{
    // ✅ INDEX — dengan filter status & pencarian nama
public function index(Request $request)
{
    $query = Sanggar::query();

    // 🔍 Filter berdasarkan pilihan
    if ($request->filter_by === 'status' && $request->status) {
        // Filter berdasarkan status
        $query->where('status', $request->status);

    } elseif ($request->filter_by === 'nama_sanggar' && $request->search) {
        // Filter berdasarkan nama sanggar
        $query->where('nama_sanggar', 'like', '%' . $request->search . '%');

    } elseif ($request->filter_by === 'kecamatan' && $request->search) {
        // Filter berdasarkan kecamatan (fix bagian ini)
        $query->where('kecamatan', 'like', '%' . $request->search . '%');
    }

    $sanggar = $query->paginate(100)->appends($request->query());

    return view('sanggar.index', compact('sanggar'));
}




       public function create()
    {
        return view('sanggar.create');
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
            // 'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // // simpan foto ke storage/public/foto_sanggar
        // if ($request->hasFile('foto')) {
        //     $validated['foto'] = $request->file('foto')->store('foto_sanggar', 'public');
        // }

        // $validated['status'] = 'Menunggu';
        // $validated['user_id'] = Auth::id();

        Sanggar::create($validated);

        return redirect()->route('sanggar.index')
            ->with('success', 'Data Berhasil ditambahkan');
    }


    // ✅ UPDATE — proses ubah data
    public function update(Request $request, Sanggar $sanggar)
    {
        $request->validate([
            'nama_sanggar' => 'required|string|max:150',
            'nama_ketua' => 'required|string|max:150',
            'alamat' => 'required|string|max:255',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'kontak' => 'required|string|max:20',
            'jumlah_anggota' => 'nullable|integer|min:1',
            'tahun_berdiri' => 'nullable|integer|min:1900|max:' . date('Y'),
            'status' => 'required|in:menunggu,disetujui,ditolak',
            'foto' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only([
            'nama_sanggar',
            'nama_ketua',
            'alamat',
            'kecamatan_id',
            'kontak',
            'jumlah_anggota',
            'tahun_berdiri',
            'status',
        ]);

        // Update foto jika diubah
        if ($request->hasFile('foto')) {
            if ($sanggar->foto && Storage::exists('public/foto-sanggar/' . $sanggar->foto)) {
                Storage::delete('public/foto-sanggar/' . $sanggar->foto);
            }

            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto-sanggar', $filename);
            $data['foto'] = $filename;
        }

        $sanggar->update($data);

        return redirect()->route('sanggar.index')
            ->with('success', 'Data sanggar berhasil diperbarui.');
    }

    // ✅ DESTROY — hapus data sanggar
    public function destroy($id)
{
    try {
        $sanggar = \App\Models\Sanggar::findOrFail($id);
        $sanggar->delete();

        return redirect()->route('sanggar.index')->with('success', 'Data sanggar berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->route('sanggar.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
    }
}


public function downloadPdf(Request $request)
{
    $query = Sanggar::query();

    // 🔍 Terapkan filter yang sama seperti di index()
    if ($request->filter_by === 'status' && $request->status) {
        $query->where('status', $request->status);

    } elseif ($request->filter_by === 'nama_sanggar' && $request->search) {
        $query->where('nama_sanggar', 'like', '%' . $request->search . '%');

    } elseif ($request->filter_by === 'kecamatan' && $request->search) {
        $query->where('kecamatan', 'like', '%' . $request->search . '%');
    }

    // ⚡️ Ambil data tapi batasi kolom penting saja agar lebih ringan
    $sanggar = $query->select([
        'nama_sanggar',
        'jalan_rt_rw',
        'desa_kel',
        'kecamatan',
        'no_sk',
        'tahun_sk',
        'jabatan_penandatangan',
        'nama_penandatangan',
        'nama_pimpinan',
        'jenis_kelamin',
        'nik',
        'no_hp',
        'jumlah_anggota',
        'bidang_garapan_seni',
        'nomor_induk_kebudayaan',
        'status',
    ])->orderBy('kecamatan')->get();

    // 🔖 Label nama file
    if ($request->filter_by === 'status' && $request->status) {
        $fileName = 'daftar-sanggar-status-' . strtolower($request->status) . '.pdf';
    } elseif ($request->filter_by === 'nama_sanggar' && $request->search) {
        $fileName = 'data-sanggar-nama-' . strtolower(str_replace(' ', '_', $request->search)) . '.pdf';
    } elseif ($request->filter_by === 'kecamatan' && $request->search) {
        $fileName = 'daftar-sanggar-kecamatan-' . strtolower(str_replace(' ', '_', $request->search)) . '.pdf';
    } else {
        $fileName = 'daftar-sanggar-semua-data.pdf';
    }

    // ⚙️ Optimasi DOMPDF agar cepat
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('sanggar.pdf', compact('sanggar'))
        ->setPaper('A4', 'landscape') // gunakan portrait biar render lebih cepat
        ->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'dpi' => 96,
            'defaultFont' => 'sans-serif',
        ]);

    return $pdf->download($fileName);
}


public function importExcel(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv',
        
    ]);

    try {
        Excel::import(new SanggarImport, $request->file('file'));
        return redirect()->route('sanggar.index')->with('success', 'Data sanggar berhasil diimpor!');
    } catch (\Exception $e) {
        return redirect()->route('sanggar.index')->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
    }
}

public function edit(Sanggar $sanggar)
{
    // jika belum buat view, buat view sanggar.show
    return view('sanggar.edit', compact('sanggar'));
}

    // Ekspor Excel
public function exportExcel(Request $request)
{
    $query = Sanggar::query();

    if ($request->filter_by === 'status' && $request->status) {
        $query->where('status', $request->status);
    } elseif ($request->filter_by === 'nama_sanggar' && $request->search) {
        $query->where('nama_sanggar', 'like', '%' . $request->search . '%');
    } elseif ($request->filter_by === 'kecamatan' && $request->search) {
        $query->where('kecamatan', 'like', '%' . $request->search . '%');
    }

    $data = $query->get();

    if ($data->isEmpty()) {
        return back()->with('error', 'Tidak ada data yang sesuai dengan filter pencarian.');
    }

    // Penamaan file dinamis
    if ($request->filter_by === 'status' && $request->status) {
        $fileName = 'daftar-sanggar-status-' . strtolower($request->status) . '.xlsx';
    } elseif ($request->filter_by === 'nama_sanggar' && $request->search) {
        $fileName = 'daftar-sanggar-nama-' . strtolower(str_replace(' ', '_', $request->search)) . '.xlsx';
    } elseif ($request->filter_by === 'kecamatan' && $request->search) {
        $fileName = 'daftar-sanggar-kecamatan-' . strtolower(str_replace(' ', '_', $request->search)) . '.xlsx';
    } else {
        $fileName = 'daftar-sanggar-semua-data.xlsx';
    }

    return Excel::download(new SanggarExport($data), $fileName);
}




}