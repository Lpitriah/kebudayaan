<?php

namespace App\Imports;

use App\Models\Sanggar;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SanggarImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Generate kode unik untuk menghindari duplicate
        $kode = 'SGR' . now()->format('YmdHis') . rand(10,99);

        return new Sanggar([
            'kode_sanggar' => $kode,
            'nama_sanggar' => $row['nama_sanggar'] ?? $row['nama'] ?? null,
            'jalan_rt_rw' => $row['jalan_rt_rw'] ?? null,
            'desa_kel' => $row['desa_kel'] ?? null,
            'kecamatan' => $row['kecamatan'] ?? null,
            'no_sk' => $row['no_sk'] ?? null,
            'tahun_sk' => $row['tahun_sk'] ?? null,
            'jabatan_penandatangan' => $row['jabatan_penandatangan'] ?? null,
            'nama_penandatangan' => $row['nama_penandatangan'] ?? null,
            'nama_pimpinan' => $row['nama_pimpinan'] ?? null,
            'jenis_kelamin' => isset($row['jenis_kelamin']) ? strtoupper($row['jenis_kelamin']) : null,
            'nik' => $row['nik'] ?? null,
            'no_hp' => $row['no_hp'] ?? null,
            'jumlah_anggota' => $row['jumlah_anggota'] ?? null,
            'bidang_garapan_seni' => $row['bidang_garapan_seni'] ?? null,
            'status' => $row['status'] ?? 'Menunggu', // default aman
            'nomor_induk_kebudayaan' => $row['nomor_induk_kebudayaan'] ?? null,
            'user_id' => null, // tidak terikat pendaftar
        ]);
    }
}
