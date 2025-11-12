@extends('layouts.master')

@section('title', 'Daftar Layanan')

@section('content')
<div class="container-fluid px-4">
    <div class="card animate__animated animate__fadeIn shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-users me-2"></i>Daftar Layanan
                    </h5>
                </div>
                <a href="{{ route('layanan_laundry.create') }}" class="btn btn-light btn-sm rounded-pill">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Baru
                </a>
            </div>
        <!-- </div>
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif -->

            <!-- Tombol Download dan Form Search Sejajar -->
            <!-- <div class="row mb-3 align-items-center">
                <div class="col-md-6">
                    <a href="{{ route('customers.pdf') }}" class="btn btn-success btn-md rounded-pill">
                        <i class="fas fa-file-alt me-2"></i>Download Data Layanan
                    </a> -->
                <!-- </div> -->
                <!-- Tombol Search-->
                <!-- <div class="col-md-6 d-flex justify-content-end">
                    <form action="{{ route('layanan_laundry.index') }}" method="GET" class="d-flex align-items-center">
                        <input type="text" 
                            name="search" 
                            class="form-control form-control-sm rounded-pill me-2" 
                            placeholder="Cari kode layanan..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary btn-sm rounded-pill me-2">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('layanan_laundry.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                                <i class="fas fa-times"></i> Reset
                            </a>
                        @endif
                    </form>
                </div>
            </div> -->
            <!-- Akhir Tombol search-->

            <div class="table-responsive rounded-3 overflow-hidden">
                <table class="table table-hover align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th class="fw-semibold text-muted text-center">No</th>
                            <th class="fw-semibold text-muted text-center">Kode Layanan</th>
                            <th class="fw-semibold text-muted text-center">Nama Layanan</th>
                            <th class="fw-semibold text-muted text-center">Deskripsi</th>
                            <th class="fw-semibold text-muted text-center">Estimasi Hari</th>
                            <th class="fw-semibold text-muted text-center">Harga perKg</th>
                            <th class="fw-semibold text-muted text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($layanan_laundrys as $layanan_laundry)
                    <tr class="border-bottom">
                        <td class="text-center">{{ $loop->iteration }}</td>

                        <td class="text-center">
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">
                                {{ $layanan_laundry->kode_layanan }}
                            </span>
                        </td>

                        <td class="text-center">{{ $layanan_laundry->nama_layanan }}</td>

                        <td class="text-center">{{ $layanan_laundry->deskripsi ?? '-' }}</td>

                        <td class="text-center">{{ $layanan_laundry->estimasi_hari }} hari</td>

                        <td class="text-center">Rp {{ number_format($layanan_laundry->harga_per_kg, 2, ',', '.') }}</td>

                        <td class="text-center">
                            @if(auth()->user()->level == 'admin') 
                            <div class="btn-group" role="group">
                                <a href="{{ route('layanan_laundry.show', $layanan_laundry->id) }}" class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('layanan_laundry.edit', $layanan_laundry->id) }}" class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('layanan_laundry.destroy', $layanan_laundry->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                            @else 
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill">Admin Only</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="d-flex flex-column align-items-center">
                                <i class="fas fa-users-slash text-muted fa-3x mb-3"></i>
                                <h6 class="fw-semibold text-muted">Belum ada data layanan</h6>
                                <a href="{{ route('layanan_laundry.create') }}" class="btn btn-sm btn-primary mt-2 rounded-pill">
                                    <i class="fas fa-plus me-1"></i> Tambah Layanan
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        @if($layanan_laundrys->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted small">
                Menampilkan <span class="fw-semibold">{{ $layanan_laundrys->firstItem() }}</span> sampai 
                <span class="fw-semibold">{{ $layanan_laundrys->lastItem() }}</span> dari 
                <span class="fw-semibold">{{ $layanan_laundrys->total() }}</span> layanan
            </div>
            <div>
                {{ $layanan_laundrys->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 12px;
        overflow: hidden;
        border: none;
    }

    .card-header {
        border-bottom: none;
        padding: 1.25rem 1.5rem;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #0ea5e9, #6366f1);
    }

    .table th {
        padding: 1rem 1.5rem;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .table td {
        padding: 1rem 1.5rem;
        vertical-align: middle;
    }

    .avatar {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-sm {
        width: 36px;
        height: 36px;
    }

    .btn-group .btn {
        border-radius: 0;
    }

    .btn-group .btn:first-child {
        border-top-left-radius: 6px;
        border-bottom-left-radius: 6px;
    }

    .btn-group .btn:last-child {
        border-top-right-radius: 6px;
        border-bottom-right-radius: 6px;
    }

    .empty-state {
        padding: 3rem 0;
    }

    .table thead {
        background-color: #0ea5e9;
    }

    .table thead th {
        color: white !important;
        border-bottom: none;
    }

    .table thead th:hover {
        background-color: #0c8fd1;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    })
</script>
@endpush
