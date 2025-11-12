@extends('layouts.master')

@section('title', 'Verifikasi Pendaftaran Sanggar')

@section('content')
<div class="container-fluid px-4 py-4 animate__animated animate__fadeIn">
    <h3 class="mb-4 fw-semibold text-gold">Verifikasi Pendaftaran Sanggar</h3>

    <!-- Pencarian -->
    <form method="GET" action="{{ route('verifikasi.index') }}" class="mb-4">
        <div class="row g-2 align-items-center" style="max-width: 500px;">
            <div class="col">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control rounded-pill shadow-sm" placeholder="Cari nama sanggar atau pimpinan...">
            </div>
            <div class="col-auto">
                <button class="btn btn-gold rounded-pill shadow-sm fw-semibold" type="submit">
                    <i class="fas fa-search me-1"></i> Cari
                </button>
            </div>
            <div class="col-auto">
                <a href="{{ route('verifikasi.index') }}" class="btn btn-secondary rounded-pill shadow-sm">
                    <i class="fas fa-rotate-left me-1"></i> Reset
                </a>
            </div>
        </div>
    </form>

    <!-- Pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-pill shadow-sm text-center" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tabel -->
    <div class="card shadow border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-gradient-maroon text-gold fw-semibold">
            Daftar Pendaftar
        </div>
        <div class="card-body bg-dark-maroon table-responsive p-3">
            <table class="table table-hover align-middle text-gold table-custom mb-0">
                <thead class="bg-maroon text-gold small text-uppercase">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Sanggar</th>
                        <th>Nama Pimpinan</th>
                        <th>Status</th>
                        <th>No Induk Kebudayaan</th>
                        <th>Keterangan Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sanggar as $index => $item)
                    <tr class="table-row-hover">
                        <td class="text-center">{{ $sanggar->firstItem() + $index }}</td>
                        <td>{{ $item->nama_sanggar }}</td>
                        <td>{{ $item->nama_pimpinan }}</td>
                        <td class="text-center">
                            @php
                                $statusClass = match($item->status) {
                                    'Menunggu' => 'bg-warning text-dark',
                                    'Disetujui' => 'bg-success text-white',
                                    'Ditolak' => 'bg-danger text-white',
                                    default => 'bg-secondary text-white'
                                };
                            @endphp
                            <span class="badge rounded-pill px-3 py-1 {{ $statusClass }}">{{ $item->status }}</span>
                        </td>
                        <td class="text-center">
                            {{ $item->status == 'Disetujui' ? ($item->nomor_induk_kebudayaan ?? '-') : '-' }}
                        </td>
                        <td class="text-center">
                            {{ $item->status == 'Ditolak' ? ($item->keterangan_status ?? '-') : '-' }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('verifikasi.show', $item->id) }}" class="btn btn-sm btn-outline-gold rounded-pill shadow-sm">
                                <i class="fas fa-eye text-gold"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-box-open me-2"></i> Belum ada data pendaftaran.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @if($sanggar->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                <small class="text-muted mb-2">
                    Menampilkan {{ $sanggar->firstItem() }} - {{ $sanggar->lastItem() }} dari {{ $sanggar->total() }} data
                </small>
                <div>
                    {{ $sanggar->links('pagination::bootstrap-5') }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
/* Warna & Tema */
.bg-maroon { background-color: #800000 !important; }
.text-maroon { color: #800000 !important; }
.text-gold { color: #f5e1b9 !important; }
.bg-gradient-maroon { background: linear-gradient(135deg, #800000, #b8860b); }
.bg-dark-maroon { background-color: #2b0000; }
.table-custom tbody tr.table-row-hover:hover { background-color: #5c0f0f; }

/* Tombol */
.btn-gold { background-color: #b8860b; color: #2b0000; border: none; }
.btn-gold:hover { background-color: #f5e1b9; color: #800000; }
.btn-outline-gold { border: 1px solid #f5e1b9; color: #f5e1b9; background-color: transparent; }
.btn-outline-gold:hover { background-color: #f5e1b9; color: #800000; }

.form-control, .form-select { border: 1px solid #800000; background-color: #4a0f0f; color: #f5e1b9; }
.form-control::placeholder, .form-select option { color: #f5e1b9; }

/* Badge */
.badge { font-weight: 500; }
</style>
@endpush
@endsection
