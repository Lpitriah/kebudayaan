@extends('layouts.master')

@section('title', 'Detail Data Sanggar / Komunitas Budaya')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="card shadow border-0 rounded-4 animate__animated animate__fadeIn">
        <div class="card-header bg-gradient-maroon text-gold py-3 rounded-top-4 border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-landmark me-2"></i> Detail Data Sanggar / Komunitas - {{ $sanggar->nama_sanggar }}
                </h5>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="row">
                <!-- DETAIL DATA -->
                <div class="col-lg-8">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle table-custom">
                            <tbody>
                                <tr class="border-bottom">
                                    <th width="35%" class="text-gold fw-normal py-3" bg>Kode Sanggar</th>
                                    <td class="py-3">
                                        <span class="badge bg-light-gold text-maroon rounded-pill px-3 py-1">
                                            <i class="fas fa-key me-2"></i>{{ $sanggar->kode_sanggar }}
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-gold fw-normal py-3">Nama Sanggar / Komunitas</th>
                                    <td class="py-3 fw-semibold">
                                        <i class="fas fa-user text-gold me-2"></i>{{ $sanggar->nama_sanggar }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-gold fw-normal py-3">Bidang Garapan Seni</th>
                                    <td class="py-3">{{ $sanggar->bidang_garapan_seni ?? '-' }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-gold fw-normal py-3">Alamat</th>
                                    <td class="py-3">
                                        <i class="fas fa-map-marker-alt text-gold me-2"></i>
                                        {{ $sanggar->jalan_rt_rw ?? '-' }}, 
                                        {{ $sanggar->desa_kel ?? '-' }}, 
                                        {{ $sanggar->kecamatan ?? '-' }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-gold fw-normal py-3">No. SK</th>
                                    <td class="py-3">{{ $sanggar->no_sk ?? '-' }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-gold fw-normal py-3">Tahun SK</th>
                                    <td class="py-3">{{ $sanggar->tahun_sk ?? '-' }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-gold fw-normal py-3">Nama Penandatangan</th>
                                    <td class="py-3">{{ $sanggar->nama_penandatangan ?? '-' }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-gold fw-normal py-3">Jabatan Penandatangan</th>
                                    <td class="py-3">{{ $sanggar->jabatan_penandatangan ?? '-' }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-gold fw-normal py-3">Nama Pimpinan</th>
                                    <td class="py-3">{{ $sanggar->nama_pimpinan ?? '-' }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-gold fw-normal py-3">Jenis Kelamin Pimpinan</th>
                                    <td class="py-3">
                                        @if($sanggar->jenis_kelamin == 'L') Laki-laki
                                        @elseif($sanggar->jenis_kelamin == 'P') Perempuan
                                        @else - @endif
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-gold fw-normal py-3">NIK</th>
                                    <td class="py-3">{{ $sanggar->nik ?? '-' }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-gold fw-normal py-3">No. HP</th>
                                    <td class="py-3">{{ $sanggar->no_hp ?? '-' }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-gold fw-normal py-3">Jumlah Anggota</th>
                                    <td class="py-3">{{ $sanggar->jumlah_anggota ?? '-' }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-gold fw-normal py-3">Foto Sanggar</th>
                                    <td class="py-3">
                                        @if($sanggar->foto)
                                            <img src="{{ asset('storage/' . $sanggar->foto) }}"
                                                 alt="Foto Sanggar"
                                                 class="img-fluid rounded-3 shadow-sm border"
                                                 style="max-width: 250px; max-height: 200px; object-fit: cover;">
                                        @else
                                            <span class="text-gold fst-italic">Belum ada foto</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-gold fw-normal py-3">Status Pendaftaran</th>
                                    <td class="py-3">
                                        <span class="badge 
                                            @if($sanggar->status == 'Menunggu') bg-warning text-dark 
                                            @elseif($sanggar->status == 'Disetujui') bg-success 
                                            @elseif($sanggar->status == 'Ditolak') bg-danger 
                                            @endif
                                            rounded-pill px-3 py-1">
                                            {{ ucfirst($sanggar->status) }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- KOLOM AKSI -->
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-maroon text-gold">
                            <h6 class="mb-0 fw-semibold">
                                <i class="fas fa-cog me-2"></i> Aksi
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-3">
                                <a href="{{ route('daftar.index') }}" class="btn btn-outline-gold rounded-pill text-start">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@push('styles')

<style>
/* .text-gold { color: #f5e1b9 !important; }
.border-gold { border-color: #f5e1b9 !important; }
.bg-light-gold { background-color: #fff7f0 !important; } */
.btn-outline-gold {
    color: #f5e1b9;
    border: 1px solid #f5e1b9;
}
.btn-outline-gold:hover {
    background-color: #f5e1b9;
    color: #800000;
}

/* 🔥 Tambahan untuk ubah background tabel jadi maroon */
.table-custom {
    background-color: #5e0f0f !important;
    color: #f5e1b9 !important;
    border-radius: 8px;
}
.table-custom th, 
.table-custom td {
    background-color: transparent !important;
    color: #f5e1b9 !important;
    border-color: rgba(245, 225, 185, 0.2);
}
.table-custom tr.border-bottom {
    border-bottom: 1px solid rgba(245, 225, 185, 0.2) !important;
}
</style>

@endpush