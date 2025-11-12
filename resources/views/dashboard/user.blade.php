@extends('layouts.master')

@section('title', 'Dashboard Saya')

@section('content')

<div class="container py-5 animate__animated animate__fadeIn" style="background-color:#3c0a0a; border-radius:20px;">

<!-- 🌸 Header -->
<div class="text-center mb-5">
    <h2 class="fw-bold text-gold mb-2">
        <i class="fas fa-user-circle text-gold me-2"></i> Dashboard Saya
    </h2>
    <p class="text-light opacity-75 mb-0">Pantau status pendaftaran semua sanggar dan nomor induk kebudayaanmu di sini.</p>
</div>

@if($sanggar->isEmpty())
    <!-- 🕊️ Belum ada data -->
    <div class="text-center py-5 text-light">
        <i class="fas fa-box-open fa-3x text-gold mb-3"></i>
        <h6 class="opacity-75 mb-3">Kamu belum mendaftarkan sanggar.</h6>
        <a href="{{ route('daftar.create') }}" class="btn btn-gold mt-2 rounded-pill px-4 py-2">
            <i class="fas fa-plus-circle me-1"></i> Daftar Sanggar Sekarang
        </a>
    </div>
@else
    <div class="row justify-content-center g-4">
        @foreach($sanggar as $item)
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 rounded-4 h-100 bg-dark-maroon text-light">
                    <div class="card-header bg-maroon text-gold fw-semibold py-3 text-center rounded-top-4">
                        <i class="fas fa-scroll me-2"></i> {{ $item->nama_sanggar }}
                    </div>

                    <div class="card-body p-4 text-center">

                        <!-- 🏞️ Foto -->
                        @if($item->foto)
    <img src="{{ asset('storage/' . $item->foto) }}"
         alt="Foto Sanggar"
         class="rounded-3 mb-3"
         style="width: 100%; max-width: 240px; height: 360px; object-fit: cover; display: block; margin: 0 auto;">
@endif


                        <!-- 🟡 Status -->
                        <div class="mb-3">
                            <span class="fw-semibold text-gold">Status Pendaftaran:</span><br>
                            @if(strtolower($item->status) == 'disetujui' || strtolower($item->status) == 'terverifikasi')
                                <span class="badge bg-success px-3 py-2 mt-2 fs-6">
                                    <i class="fas fa-check-circle me-1"></i> Disetujui
                                </span>
                            @elseif(strtolower($item->status) == 'ditolak')
                                <span class="badge bg-danger px-3 py-2 mt-2 fs-6">
                                    <i class="fas fa-times-circle me-1"></i> Ditolak
                                </span>
                            @else
                                <span class="badge bg-warning text-dark px-3 py-2 mt-2 fs-6">
                                    <i class="fas fa-hourglass-half me-1"></i> Menunggu Verifikasi
                                </span>
                            @endif
                        </div>

                        <!-- 🪪 Nomor Induk -->
                        @if(in_array(strtolower($item->status), ['disetujui', 'terverifikasi']))
                            <div class="mb-3">
                                <span class="fw-semibold text-gold">Nomor Induk Kebudayaan:</span><br>
                                <span class="fw-bold text-gold fs-5">{{ $item->nomor_induk_kebudayaan ?? '-' }}</span>
                            </div>
                        @endif

                        <!-- ❌ Keterangan Penolakan -->
                        @if(strtolower($item->status) == 'ditolak' && !empty($item->keterangan_status))
                            <div class="alert alert-danger border-0 rounded-3 mt-3 text-start">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Alasan Penolakan:</strong><br>
                                {{ $item->keterangan_status }}
                            </div>
                        @endif

                        <!-- 🗓️ Tanggal -->
                        <div class="mb-3">
                            <span class="fw-semibold text-gold">Tanggal Diajukan:</span><br>
                            <span class="opacity-75">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</span>
                        </div>

                        <hr class="mt-4 mb-4" style="border-color:#d4af37;opacity:0.4;">

                        <!-- 🔘 Tombol Aksi -->
                        <div class="d-flex justify-content-center flex-wrap gap-3 mt-2">
                            <a href="{{ route('daftar.show', $item->id) }}" class="btn btn-maroon rounded-pill px-4 py-2 text-gold border-0">
                                <i class="fas fa-eye me-1"></i> Detail
                            </a>

                            @if(strtolower($item->status) == 'menunggu')
                                <a href="{{ route('daftar.edit', $item->id) }}" class="btn btn-warning rounded-pill px-4 py-2 text-dark border-0">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                            @endif

                            @if(in_array(strtolower($item->status), ['disetujui', 'terverifikasi']))
                                <a href="{{ route('daftar.pdf', $item->id) }}" class="btn btn-gold rounded-pill px-4 py-2 border-0" download>
                                    <i class="fas fa-file-pdf me-1"></i> Cetak Bukti
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

</div>
@endsection

@push('styles')

<style>
    body { background-color:#2b0000 !important; }
    .bg-dark-maroon { background-color:#4a0f0f !important; }
    .bg-maroon { background-color:#7a0000 !important; }
    .text-gold { color:#d4af37 !important; }
    .btn-maroon {
        background:linear-gradient(135deg,#7a0000,#4a0f0f);
        color:#fff;
    }
    .btn-maroon:hover { background:#5c0000;color:#d4af37; }
    .btn-gold {
        background:linear-gradient(135deg,#d4af37,#f4d160);
        color:#4a0f0f;
        font-weight:600;
    }
    .btn-gold:hover { background:#e5c94e;color:#3c0a0a; }
    .img-4x6 {
    width: 100%;
    max-width: 240px; /* 4 cm */
    height: 360px;    /* 6 cm */
    object-fit: cover;
    border-radius: 0.5rem;
    display: block;
    margin: 0 auto;
}

</style>

@endpush
