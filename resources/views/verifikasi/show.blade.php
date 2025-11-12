@extends('layouts.master')

@section('title', 'Detail Verifikasi')

@section('content')
<div class="container-fluid px-4 py-4 animate__animated animate__fadeIn">
    <h4 class="fw-semibold text-gold mb-4">Detail Pendaftaran Sanggar</h4>

    <!-- Detail Sanggar -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body bg-dark-maroon text-gold">
            <p><strong>Nama Sanggar:</strong> {{ $sanggar->nama_sanggar }}</p>
            <p><strong>Alamat Lengkap:</strong> 
            {{ $sanggar->jalan_rt_rw ?? '-' }}, 
            {{ $sanggar->desa_kel ?? '-' }}, 
            {{ $sanggar->kecamatan ?? '-' }}
        </p>
            <p><strong>Kecamatan:</strong> {{ $sanggar->kecamatan }}</p>
            <p><strong>No. SK:</strong> {{ $sanggar->no_sk }}</p>
            <p><strong>Tahun SK:</strong> {{ $sanggar->tahun_sk }}</p>
            <p><strong>Nama Pimpinan:</strong> {{ $sanggar->nama_pimpinan }}</p>
            <p><strong>Jumlah Anggota:</strong> {{ $sanggar->jumlah_anggota }}</p>
            <p><strong>Bidang Garapan Seni:</strong> {{ $sanggar->bidang_garapan_seni }}</p>

            <p><strong>Foto Sanggar:</strong></p>
            @if($sanggar->foto)
                <img src="{{ asset('storage/' . $sanggar->foto) }}" 
                     alt="Foto Sanggar" 
                     class="img-fluid rounded shadow-sm mb-3" 
                     style="max-width: 300px;">
            @else
                <p class="text-muted fst-italic">Belum ada foto yang diunggah.</p>
            @endif

            <p><strong>Status Saat Ini:</strong> 
                @php
                    $statusClass = match($sanggar->status) {
                        'Menunggu' => 'bg-warning text-dark',
                        'Disetujui' => 'bg-success text-dark',
                        'Ditolak' => 'bg-danger text-dark',
                        default => 'bg-secondary text-dark'
                    };
                @endphp
                <span class="badge rounded-pill px-3 py-1 {{ $statusClass }}">{{ $sanggar->status }}</span>
            </p>
        </div>
    </div>

    <!-- Form Verifikasi -->
    <form method="POST" action="{{ route('verifikasi.updateStatus', $sanggar->id) }}">
        @csrf
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-gradient-maroon text-gold fw-semibold">Form Verifikasi</div>
            <div class="card-body bg-dark-maroon text-gold">
                <div class="mb-3">
                    <label class="form-label">Ubah Status</label>
                    <select name="status" id="status" class="form-select rounded-pill shadow-sm" required>
                        <option value="Menunggu" {{ $sanggar->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Disetujui" {{ $sanggar->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Ditolak" {{ $sanggar->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="mb-3" id="nikb_field" style="display:none;">
                    <label class="form-label">Nomor Induk Kebudayaan</label>
                    <input type="text" name="nomor_induk_kebudayaan" class="form-control rounded-pill shadow-sm" value="{{ $sanggar->nomor_induk_kebudayaan }}">
                </div>

                <div class="mb-3" id="keterangan_field" style="display:none;">
                    <label class="form-label">Keterangan Penolakan</label>
                    <textarea name="keterangan_status" class="form-control rounded-pill shadow-sm" rows="3">{{ $sanggar->keterangan_status }}</textarea>
                </div>

                <button type="submit" class="btn btn-gold rounded-pill shadow-sm fw-semibold">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('verifikasi.index') }}" class="btn btn-secondary rounded-pill shadow-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const status = document.getElementById('status');
    const nikb = document.getElementById('nikb_field');
    const ket = document.getElementById('keterangan_field');

    function toggleFields() {
        const val = status.value;
        nikb.style.display = (val === 'Disetujui') ? 'block' : 'none';
        ket.style.display = (val === 'Ditolak') ? 'block' : 'none';
    }

    status.addEventListener('change', toggleFields);
    toggleFields(); // tampilkan sesuai status saat halaman dibuka
});
</script>

@push('styles')
<style>
/* Tombol & Warna Tema */
.btn-gold { background-color: #b8860b; color: #2b0000; border: none; }
.btn-gold:hover { background-color: #f5e1b9; color: #800000; }
.bg-maroon { background-color: #800000 !important; }
.text-maroon { color: #800000; }
.text-gold { color: #f5e1b9 !important; }
.bg-gradient-maroon { background: linear-gradient(135deg, #800000, #b8860b); }
.bg-dark-maroon { background-color: #2b0000; }

/* Form */
.form-control, .form-select { border: 1px solid #800000; background-color: #4a0f0f; color: #f5e1b9; }
.form-control::placeholder, .form-select option { color: #f5e1b9; }

/* Card */
.card { transition: all .3s ease; }
.card:hover { box-shadow: 0 6px 18px rgba(0,0,0,0.15); }

/* Badge */
.badge { font-weight: 500; }
</style>
@endpush
@endsection
