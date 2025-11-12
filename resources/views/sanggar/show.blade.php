@extends('layouts.master')

@section('title', 'Detail Data Sanggar/Komunitas Budaya')

@section('content')
<div class="container-fluid px-4">
    <div class="card animate__animated animate__fadeIn shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-landmark me-2"></i> Detail Sanggar - {{ $sanggar->nama_sanggar }}
                </h5>
                @if($sanggar->status == 'disetujui')
                    <span class="badge bg-success bg-opacity-20 text-white rounded-pill">
                        <i class="fas fa-check-circle me-1"></i> Disetujui
                    </span>
                @elseif($sanggar->status == 'ditolak')
                    <span class="badge bg-danger bg-opacity-20 text-white rounded-pill">
                        <i class="fas fa-times-circle me-1"></i> Ditolak
                    </span>
                @else
                    <span class="badge bg-warning bg-opacity-20 text-dark rounded-pill">
                        <i class="fas fa-hourglass-half me-1"></i> Menunggu
                    </span>
                @endif
            </div>
        </div>

        <div class="card-body p-4">
            <div class="row">
                <!-- Informasi Sanggar -->
                <div class="col-lg-8">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr class="border-bottom">
                                    <th width="30%" class="text-muted fw-normal py-3">Kode Sanggar</th>
                                    <td class="py-3">
                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">
                                            <i class="fas fa-barcode me-2"></i>{{ $sanggar->kode_sanggar }}
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Nama Sanggar/Komunitas</th>
                                    <td class="py-3 fw-semibold">
                                        <i class="fas fa-landmark text-muted me-2"></i>{{ $sanggar->nama_sanggar }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Alamat Sekretariat</th>
                                    <td class="py-3">
                                        <i class="fas fa-map-marker-alt text-muted me-2"></i>{{ $sanggar->alamat }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Kecamatan</th>
                                    <td class="py-3">
                                        <i class="fas fa-map text-muted me-2"></i>
                                        {{ $sanggar->kecamatan->nama_kecamatan ?? '-' }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Tahun Berdiri</th>
                                    <td class="py-3">
                                        <i class="fas fa-calendar-alt text-muted me-2"></i>
                                        {{ $sanggar->tahun_berdiri ?? '-' }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Bidang Kegiatan Budaya</th>
                                    <td class="py-3">
                                        <i class="fas fa-theater-masks text-muted me-2"></i>
                                        {{ $sanggar->bidang_kegiatan ?? '-' }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Ketua Sanggar</th>
                                    <td class="py-3">
                                        <i class="fas fa-user-tie text-muted me-2"></i>
                                        {{ $sanggar->nama_ketua }} 
                                        <small class="text-muted ms-2">(KTP: {{ $sanggar->no_ktp_ketua ?? '-' }})</small>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Sekretaris</th>
                                    <td class="py-3">
                                        <i class="fas fa-user text-muted me-2"></i>
                                        {{ $sanggar->nama_sekretaris ?? '-' }} 
                                        <small class="text-muted ms-2">(KTP: {{ $sanggar->no_ktp_sekretaris ?? '-' }})</small>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Kontak / WhatsApp</th>
                                    <td class="py-3">
                                        <i class="fas fa-phone text-muted me-2"></i>{{ $sanggar->kontak ?? '-' }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Email</th>
                                    <td class="py-3">
                                        <i class="fas fa-envelope text-muted me-2"></i>{{ $sanggar->email ?? '-' }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Nomor Induk Kebudayaan </th>
                                    <td class="py-3">
                                        <i class="fas fa-id-card text-muted me-2"></i>
                                        {{ $sanggar->no_induk_kebudayaan ?? 'Belum diterbitkan' }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Tanggal Pengajuan</th>
                                    <td class="py-3">
                                        <i class="fas fa-calendar-day text-muted me-2"></i>
                                        {{ $sanggar->tanggal_pengajuan ? \Carbon\Carbon::parse($sanggar->tanggal_pengajuan)->format('d/m/Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-normal py-3">Tanggal Verifikasi</th>
                                    <td class="py-3">
                                        <i class="far fa-clock text-muted me-2"></i>
                                        {{ $sanggar->tanggal_verifikasi ? \Carbon\Carbon::parse($sanggar->tanggal_verifikasi)->format('d/m/Y') : '-' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Foto Sanggar dan Aksi -->
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0 fw-semibold">
                                <i class="fas fa-image me-2"></i> Foto/Logo Sanggar
                            </h6>
                        </div>
                        <div class="card-body text-center p-4">
                            @if ($sanggar->foto)
                                <img src="{{ asset('storage/foto-sanggar/'.$sanggar->foto) }}" 
                                     alt="{{ $sanggar->nama_sanggar }}" 
                                     class="img-fluid rounded-3 shadow" style="max-height: 250px;">
                            @else
                                <div class="bg-light rounded-3 p-5 text-center">
                                    <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">Tidak ada foto</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Aksi -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0 fw-semibold">
                                <i class="fas fa-cog me-2"></i> Aksi
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-3">
                                @if(auth()->user()->role == 'admin')
                                <a href="{{ route('sanggar.edit', $sanggar->id) }}" 
                                   class="btn btn-outline-warning rounded-pill text-start">
                                    <i class="fas fa-edit me-2"></i> Edit Data Sanggar
                                </a>
                                <form action="{{ route('sanggar.destroy', $sanggar->id) }}" method="POST" class="d-grid">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger rounded-pill text-start" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash-alt me-2"></i> Hapus Sanggar
                                    </button>
                                </form>
                                @endif
                                <a href="{{ route('sanggar.index') }}" class="btn btn-outline-secondary rounded-pill text-start">
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
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    .card-header {
        border-bottom: none;
    }
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0ea5e9, #6366f1);
    }
    .table th {
        font-weight: 500;
    }
    .img-thumbnail {
        border-radius: 10px;
        max-height: 250px;
        object-fit: contain;
    }
    .badge {
        font-weight: 500;
    }
</style>
@endpush
