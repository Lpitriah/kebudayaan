@extends('layouts.master')

@php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
@endphp

@section('title', 'Data Sanggar / Komunitas')

@section('content')

<div class="container-fluid px-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header py-3" style="background: linear-gradient(135deg, #5c0000, #7b1e1e); color: #d4af37;">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-landmark me-2"></i> Data Sanggar / Komunitas Budaya
                </h5>
                @if(auth()->user()->level == 'user')
                    <a href="{{ route('daftar.create') }}" class="btn btn-gold btn-sm rounded-pill shadow-sm">
                        <i class="fas fa-plus-circle me-1"></i> Tambah Data Sanggar
                    </a>
                @endif
            </div>
        </div>

    <div class="card-body p-4" style="background-color: #3c0a0a;">
        {{-- Notifikasi sukses --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-pill shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Pencarian --}}
        <div class="row mb-3">
            <div class="col-md-4 ms-auto">
                <form action="{{ route('daftar.index') }}" method="GET">
                    <div class="input-group shadow-sm">
                        <input type="text" name="search" class="form-control rounded-start-pill" placeholder="Cari nama sanggar..." value="{{ request('search') }}">
                        <button class="btn btn-maroon text-white rounded-end-pill" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="text-end mb-3">
            <a href="{{ route('daftar.index') }}" class="btn btn-outline-light btn-sm rounded-pill border-0 shadow-sm" style="background-color:#5c0000; color:#d4af37;">
                <i class="fas fa-sync-alt me-1"></i> Perbarui Status
            </a>
        </div>

        {{-- Tabel data --}}
        <div class="table-responsive rounded-4 shadow-sm">
  <table class="table table-hover align-middle mb-0 text-gold table-custom">
                    <thead class="bg-maroon text-gold small text-uppercase">
                    <tr>
                        <th>No</th>
                        <th>Nama Sanggar</th>
                        <!-- <th>Jalan RT/RW</th>
                        <th>Desa / Kel</th> -->
                        <th>Kecamatan</th>
                        <!-- <th>No. SK</th>
                        <th>Tahun SK</th>
                        <th>Nama Pejabat Penandatangan</th> -->
                        <th>Nama Pimpinan</th>
                        <!-- <th>L/P</th>
                        <th>NIK</th>
                        <th>No. HP</th> -->
                        <th>Jumlah Anggota</th>
                        <th>Bidang Garapan Seni</th>
                        <!-- <th>Foto</th> -->
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($sanggar as $item)
                    <tr class="table-row-hover">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_sanggar }}</td>
                        <!-- <td>{{ $item->jalan_rt_rw ?? '-' }}</td>
                        <td>{{ $item->desa_kel ?? '-' }}</td> -->
                        <td>{{ $item->kecamatan ?? '-' }}</td>
                        <!-- <td>{{ $item->no_sk ?? '-' }}</td>
                        <td>{{ $item->tahun_sk ?? '-' }}</td>
                        <td>{{ $item->nama_penandatangan ?? '-' }}</td> -->
                        <td>{{ $item->nama_pimpinan ?? '-' }}</td>
                        <!-- <td>{{ $item->jenis_kelamin ?? '-' }}</td>
                        <td>{{ $item->nik ?? '-' }}</td>
                        <td>{{ $item->no_hp ?? '-' }}</td> -->
                        <td>{{ $item->jumlah_anggota ?? '-' }}</td>
                        <td>{{ $item->bidang_garapan_seni ?? '-' }}</td>

                        {{-- Kolom Foto --}}
                        <!-- <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Sanggar" width="70" class="rounded shadow-sm border border-gold">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td> -->

                        {{-- Kolom Status --}}
                        <td>
                            @if(auth()->user()->level == 'admin')
                                <form action="{{ route('daftar.updateStatus', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm text-center fw-semibold border-0 shadow-sm"
                                            style="background-color: #3c0a0a; color: #d4af37;" onchange="this.form.submit()">
                                        <option value="Menunggu" {{ $item->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="disetujui" {{ $item->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                        <option value="Ditolak" {{ $item->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </form>
                            @else
                                @if($item->status == 'Disetujui')
                                    <span class="badge rounded-pill px-3 py-2" style="background-color:#d4af37; color:#3c0a0a;">Disetujui</span>
                                @elseif($item->status == 'Menunggu')
                                    <span class="badge rounded-pill px-3 py-2" style="background-color:#7b1e1e; color:#f5e1b9;">Menunggu</span>
                                @else
                                    <span class="badge rounded-pill px-3 py-2" style="background-color:#a94442; color:#fff;">Ditolak</span>
                                @endif
                            @endif
                        </td>

                        {{-- Kolom Aksi --}}
                        <td>
                            <a href="{{ route('daftar.show', $item->id) }}" class="btn btn-sm" style="background-color:#5c0000; color:#d4af37;">
                                <i class="fas fa-eye"></i>
                            </a>

                            @if($item->status == 'Menunggu' && auth()->user()->level == 'user')
                                <a href="{{ route('daftar.edit', $item->id) }}" class="btn btn-sm btn-warning mx-1 text-dark">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('daftar.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="17" class="text-center py-4 text-muted">Belum ada data sanggar terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($sanggar->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4 text-light">
                <small>Menampilkan {{ $sanggar->firstItem() }} - {{ $sanggar->lastItem() }} dari {{ $sanggar->total() }} data</small>
                <div>{{ $sanggar->links('pagination::bootstrap-5') }}</div>
            </div>
        @endif
    </div>
</div>


{{-- Script AJAX --}}
<script>
function updateStatus(id, status) {
    fetch(`/daftar/update-status/${id}`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ status: status })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const alertBox = document.createElement('div');
            alertBox.className = 'alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow';
            alertBox.innerHTML = `
                <i class="fas fa-check-circle me-2"></i> Status berhasil diperbarui!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(alertBox);
            setTimeout(() => alertBox.remove(), 2500);
        }
    })
    .catch(err => console.error(err));
}
</script>
@endsection
@push('styles')
<style>
/* Warna Utama */
.bg-maroon { background-color: #800000 !important; }
.text-gold { color: #f5e1b9 !important; }
.text-maroon { color: #800000 !important; }
.border-maroon { border: 1px solid #800000 !important; }
.bg-gradient-maroon { background: linear-gradient(135deg, #800000, #b8860b); }

/* Card & Table */
.bg-dark-maroon { background-color: #2b0000; }
.table-dark-maroon tbody tr { background-color: #4a0f0f; }
.table-dark-maroon tbody tr td, .table-dark-maroon tbody tr th { color: #f5e1b9; }
.table-dark-maroon tbody tr.table-row-hover:hover { background-color: #5c0f0f; }
/* Tombol */
.btn-gold { background-color: #b8860b; color: #2b0000; border: none; }
.btn-gold:hover { background-color: #f5e1b9; color: #800000; }
.btn-gold-outline { background-color: transparent; color: #f5e1b9; border: 1px solid #f5e1b9; }
.btn-gold-outline:hover { background-color: #f5e1b9; color: #800000; }

/* Form */
.form-select, .form-control { border: 1px solid #800000; background-color: #4a0f0f; color: #f5e1b9; }
.form-select option, .form-control::placeholder { color: #f5e1b9; }

/* Typography & Misc */
table th, table td { vertical-align: middle; }
table thead th { letter-spacing: .5px; font-weight: 600; }
.card { transition: all .3s ease; }
.card:hover { box-shadow: 0 6px 18px rgba(0,0,0,0.15); }

@media (max-width: 768px) {
    .card-header h5 { font-size: 1rem; }
    .table { font-size: .875rem; }
}
</style>
@endpush

