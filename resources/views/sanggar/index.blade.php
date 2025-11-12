@extends('layouts.master')

@section('title', 'Data Sanggar / Komunitas')

@section('content')

<div class="container-fluid px-4 py-4 animate__animated animate__fadeIn">
    <div class="card shadow border-0 rounded-4 overflow-hidden">

    {{-- Header --}}
    <div class="card-header bg-gradient-maroon text-gold py-3 px-4 text-center">
        <h5 class="mb-0 fw-semibold text-uppercase">
            DAFTAR SANGGAR, PADEPOKAN, KOMUNITAS DI PROVINSI JAWA BARAT
        </h5>
        <h5 class="fw-normal text-gold">KABUPATEN CIREBON</h5>
    </div>

    <div class="card-body bg-dark-maroon p-4">

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-pill shadow-sm text-center" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Filter Pencarian --}}
        <form action="{{ route('sanggar.index') }}" method="GET" class="mb-4">
            <div class="row g-2 align-items-center">
                <div class="col-md-3">
                    <select name="filter_by" id="filter_by" class="form-select rounded-pill shadow-sm" onchange="toggleInput()">
                        <option value="">-- Pilih Filter --</option>
                        <option value="nama_sanggar" {{ request('filter_by') == 'nama_sanggar' ? 'selected' : '' }}>Nama Sanggar</option>
                        <option value="kecamatan" {{ request('filter_by') == 'kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                        <option value="status" {{ request('filter_by') == 'status' ? 'selected' : '' }}>Status Sanggar</option>
                    </select>
                </div>

                <div class="col-md-3" id="textFilter" style="{{ request('filter_by') == 'status' ? 'display:none;' : '' }}">
                    <input type="text" name="search" class="form-control rounded-pill shadow-sm" placeholder="Masukkan nama sanggar atau kecamatan..." value="{{ request('search') }}">
                </div>

                <div class="col-md-3" id="statusFilter" style="{{ request('filter_by') == 'status' ? '' : 'display:none;' }}">
                    <select name="status" class="form-select rounded-pill shadow-sm">
                        <option value="">-- Pilih Status --</option>
                        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="col-auto">
                    <button class="btn btn-gold-outline rounded-pill fw-semibold shadow-sm">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </div>
                <div class="col-auto">
                    <a href="{{ route('sanggar.index') }}" class="btn btn-secondary rounded-pill shadow-sm">
                        <i class="fas fa-rotate-left me-1"></i> Reset
                    </a>
                </div>
            </div>
        </form>

       {{-- Tombol Aksi (Tambah & Unduh) --}}
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    @if(auth()->user()->level == 'admin')
        <a href="{{ route('sanggar.create') }}" class="btn btn-gold btn-sm rounded-pill fw-semibold shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Data Sanggar
        </a>
    @endif

    <div class="d-flex gap-2">
        <a href="{{ route('sanggar.download.pdf', request()->query()) }}" 
            class="btn btn-gold btn-sm rounded-pill fw-semibold shadow-sm d-flex align-items-center"
            id="downloadBtn">
            <i class="fas fa-file-pdf me-1"></i> Unduh PDF
        </a>
        <a href="{{ route('sanggar.exportExcel',request()->query()) }}"
            class="btn btn-success btn-sm rounded-pill fw-semibold shadow-sm d-flex align-items-center">
            <i class="bi bi-file-earmark-excel me-1"></i> Unduh Excel
        </a>
    </div>
</div>

        {{-- Tabel Data --}}
        <div class="table-responsive shadow-sm rounded-4">
            <table class="table table-bordered align-middle text-gold table-custom mb-0">
                <thead class="bg-maroon text-gold small text-uppercase text-center align-middle">
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Nama Sanggar / Komunitas</th>
                        <th colspan="3">Alamat</th>
                        <th colspan="2">SK Pembuatan</th>
                        <th colspan="2">Pejabat Penandatangan</th>
                        <th colspan="4">Pimpinan Sanggar / Komunitas</th>
                        <th rowspan="2">Jumlah<br>Anggota</th>
                        <th rowspan="2">Jenis / Bidang Garapan Seni</th>
                        <th rowspan="2">No. Induk<br>Kebudayaan</th>
                        <th rowspan="2">Status</th>
                        @if(auth()->user()->level == 'admin')
                            <th rowspan="2">Aksi</th>
                        @endif
                    </tr>
                    <tr>
                        <th>Jalan / RT-RW</th>
                        <th>Desa / Kelurahan</th>
                        <th>Kecamatan</th>
                        <th>No. SK</th>
                        <th>Tahun</th>
                        <th>Jabatan</th>
                        <th>Nama Pejabat</th>
                        <th>Nama</th>
                        <th>L/P</th>
                        <th>NIK</th>
                        <th>No. HP</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                    @forelse($sanggar as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($sanggar->currentPage() - 1) * $sanggar->perPage() }}</td>
                        <td class="fw-semibold text-start">{{ $item->nama_sanggar }}</td>
                        <td>{{ $item->jalan_rt_rw ?? '-' }}</td>
                        <td>{{ $item->desa_kel ?? '-' }}</td>
                        <td>{{ $item->kecamatan ?? '-' }}</td>
                        <td>{{ $item->no_sk ?? '-' }}</td>
                        <td>{{ $item->tahun_sk ?? '-' }}</td>
                        <td>{{ $item->jabatan_penandatangan ?? '-' }}</td>
                        <td>{{ $item->nama_penandatangan ?? '-' }}</td>
                        <td>{{ $item->nama_pimpinan ?? '-' }}</td>
                        <td>{{ $item->jenis_kelamin ?? '-' }}</td>
                        <td>{{ $item->nik ?? '-' }}</td>
                        <td>{{ $item->no_hp ?? '-' }}</td>
                        <td>{{ $item->jumlah_anggota ?? '-' }}</td>
                        <td>{{ $item->bidang_garapan_seni ?? '-' }}</td>
                        <td>{{ $item->nomor_induk_kebudayaan ?? '-' }}</td>
                        <td>
                            @if($item->status == 'Disetujui' || $item->status == 'Terverifikasi')
                                <span class="badge bg-success text-dark rounded-pill px-3 py-1">Disetujui</span>
                            @elseif($item->status == 'Menunggu')
                                <span class="badge bg-warning text-dark rounded-pill px-3 py-1">Menunggu</span>
                            @else
                                <span class="badge bg-danger text-dark rounded-pill px-3 py-1">Ditolak</span>
                            @endif
                        </td>

                        @if(auth()->user()->level == 'admin')
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('sanggar.edit', $item->id) }}" class="btn btn-sm btn-outline-gold rounded-pill shadow-sm">
                                    <i class="fas fa-edit text-gold"></i>
                                </a>
                                <form action="{{ route('sanggar.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-gold rounded-pill shadow-sm">
                                        <i class="fas fa-trash text-gold"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ auth()->user()->level == 'admin' ? '18' : '17' }}" class="text-center text-muted py-4">
                            <i class="fas fa-box-open me-2"></i> Tidak ada data ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        {{-- Pagination --}}
        @if($sanggar->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
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

<script>
    function toggleInput() {
        let filter = document.getElementById('filter_by').value;
        document.getElementById('textFilter').style.display = (filter === 'status') ? 'none' : '';
        document.getElementById('statusFilter').style.display = (filter === 'status') ? '' : 'none';
    }
</script>

@endsection

@push('styles')

<style>
.bg-maroon { background-color: #800000 !important; }
.text-gold { color: #f5e1b9 !important; }
.text-maroon { color: #800000 !important; }
.bg-gradient-maroon { background: linear-gradient(135deg, #800000, #b8860b); }
.bg-dark-maroon { background-color: #2b0000; }

.badge { font-weight: 500; }
.btn-gold { background-color: #b8860b; color: #2b0000; border: none; }
.btn-gold:hover { background-color: #f5e1b9; color: #800000; }
.btn-gold-outline { background-color: transparent; color: #f5e1b9; border: 1px solid #f5e1b9; }
.btn-gold-outline:hover { background-color: #f5e1b9; color: #800000; }

.form-select, 
.form-control {
    border: 1px solid #bb3535ff;
    background-color: #4a0f0f !important; /* tetap maroon */
    color: #f5e1b9 !important;
    caret-color: #f5e1b9; /* warna kursor */
}

/* Warna placeholder */
.form-select option, 
.form-control::placeholder {
    color: #f5e1b9 !important;
    opacity: 0.8;
}

/* Saat fokus atau aktif */
.form-control:focus, 
.form-select:focus {
    background-color: #800000 !important;
    color: #f5e1b9 !important;
    border-color: #b8860b;
    box-shadow: 0 0 5px rgba(184, 134, 11, 0.5);
}

/* Perbaikan autofill Chrome agar tidak jadi putih */
input:-webkit-autofill,
input:-webkit-autofill:hover, 
input:-webkit-autofill:focus, 
textarea:-webkit-autofill, 
textarea:-webkit-autofill:hover, 
textarea:-webkit-autofill:focus, 
select:-webkit-autofill, 
select:-webkit-autofill:hover, 
select:-webkit-autofill:focus {
    -webkit-box-shadow: 0 0 0px 1000px #800000 inset !important;
    -webkit-text-fill-color: #f5e1b9 !important;
    caret-color: #f5e1b9;
    transition: background-color 5000s ease-in-out 0s;
}


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
