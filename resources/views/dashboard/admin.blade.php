@extends('layouts.master')

@section('title', 'Dashboard Admin Sindra')

@section('content')
<div class="container-fluid mt-5">
    <!-- Header -->
    <div class="text-center border-bottom border-gold mb-5">
        <h2 class="fw-bold text-gold">
            <i class="fas fa-torii-gate me-2 text-gold"></i> Dashboard Admin Kebudayaan
        </h2>
        <p class="text-muted text-gold">Pantau data pendaftaran sanggar dan proses verifikasi kebudayaan daerah</p>
    </div>

    <!-- Statistik -->
    <div class="row g-4 justify-content-center">
        <!-- Total Sanggar -->
        <div class="col-md-3 col-sm-6">
            <div class="card stat-card bg-maroon text-gold">
                <div class="card-body text-center">
                    <i class="fas fa-landmark fa-2x mb-3"></i>
                    <h5>Total Sanggar</h5>
                    <h2>{{ $totalSanggar ?? 0 }}</h2>
                    <a href="{{ route('sanggar.index') }}" class="btn btn-outline-maroon btn-sm rounded-pill fw-semibold mt-2">
                        <i class="fas fa-eye me-1 text-maroon"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <!-- Menunggu Verifikasi -->
        <div class="col-md-3 col-sm-6">
            <div class="card stat-card bg-gold text-maroon">
                <div class="card-body text-center">
                    <i class="fas fa-hourglass-half fa-2x mb-3"></i>
                    <h5>Menunggu Verifikasi</h5>
                    <h2>{{ $menunggu ?? 0 }}</h2>
                    <a href="{{ route('verifikasi.index', ['status' => 'Menunggu']) }}" class="btn btn-outline-maroon btn-sm rounded-pill fw-semibold mt-2">
                        <i class="fas fa-eye me-1 text-maroon"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <!-- Disetujui -->
        <div class="col-md-3 col-sm-6">
            <div class="card stat-card bg-success-gradient text-white">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle fa-2x mb-3"></i>
                    <h5>Disetujui</h5>
                    <h2>{{ $disetujui ?? 0 }}</h2>
                    <a href="{{ route('verifikasi.index', ['status' => 'Disetujui']) }}" class="btn btn-outline-maroon btn-sm rounded-pill fw-semibold mt-2">
                        <i class="fas fa-eye me-1 text-success"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <!-- Ditolak -->
        <div class="col-md-3 col-sm-6">
            <div class="card stat-card bg-danger-gradient text-white">
                <div class="card-body text-center">
                    <i class="fas fa-times-circle fa-2x mb-3"></i>
                    <h5>Ditolak</h5>
                    <h2>{{ $ditolak ?? 0 }}</h2>
                    <a href="{{ route('verifikasi.index', ['status' => 'Ditolak']) }}" class="btn btn-outline-maroon btn-sm rounded-pill fw-semibold mt-2">
                        <i class="fas fa-eye me-1 text-danger"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    :root {
        --maroon: #800000;
        --maroon-dark: #5a0000;
        --gold: #d4af37;
        --gold-light: #f5e1a4;
    }

    body {
        background-color: #3c0a0a; !important;
        font-family: 'Poppins', sans-serif;
    }

    .text-maroon { color: var(--maroon) !important; }
    .text-gold { color: var(--gold) !important; }
    .border-gold { border-color: var(--gold) !important; }

    /* Kartu Statistik */
    .stat-card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
        padding: 1.8rem;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(128, 0, 0, 0.25);
    }

    .bg-maroon {
        background: linear-gradient(135deg, var(--maroon-dark), var(--maroon));
        color: var(--gold-light);
    }

    .bg-gold {
        background: linear-gradient(135deg, var(--gold), var(--gold-light));
        color: var(--maroon);
    }

    .bg-success-gradient {
        background: linear-gradient(135deg, #1e8449, #27ae60);
    }

    .bg-danger-gradient {
        background: linear-gradient(135deg, #a93226, #e74c3c);
    }

    /* Tombol */
    .btn-outline-maroon {
        border: 1px solid var(--maroon);
        color: var(--maroon);
        background-color: white;
    }
    .btn-outline-maroon:hover {
        background-color: var(--maroon);
        color: white;
    }

</style>
@endpush
@endsection
