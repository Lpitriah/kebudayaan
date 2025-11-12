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

```
    <div class="card-body p-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="table-responsive">
                    <table class="table table-borderless align-middle table-custom mb-4">
                        <tbody>
                            <tr class="border-bottom">
                                <th class="bg-dark-maroon text-gold py-3 px-3">Kode Sanggar</th>
                                <td class="bg-dark-maroon text-gold py-3 px-3">
                                    <span class="badge bg-light-gold text-maroon rounded-pill px-3 py-1">
                                        <i class="fas fa-key me-2"></i>{{ $sanggar->kode_sanggar }}
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="bg-dark-maroon text-gold py-3 px-3">Nama Sanggar / Komunitas</th>
                                <td class="bg-dark-maroon text-gold py-3 px-3">
                                    <i class="fas fa-user text-gold me-2"></i>{{ $sanggar->nama_sanggar }}
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="bg-dark-maroon text-gold py-3 px-3">Bidang Garapan Seni</th>
                                <td class="bg-dark-maroon text-gold py-3 px-3">{{ $sanggar->bidang_garapan_seni ?? '-' }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="bg-dark-maroon text-gold py-3 px-3">Alamat</th>
                                <td class="bg-dark-maroon text-gold py-3 px-3">
                                    <i class="fas fa-map-marker-alt text-gold me-2"></i>
                                    {{ $sanggar->jalan_rt_rw ?? '-' }}, 
                                    {{ $sanggar->desa_kel ?? '-' }}, 
                                    {{ $sanggar->kecamatan ?? '-' }}
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="bg-dark-maroon text-gold py-3 px-3">No. SK</th>
                                <td class="bg-dark-maroon text-gold py-3 px-3">{{ $sanggar->no_sk ?? '-' }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="bg-dark-maroon text-gold py-3 px-3">Tahun SK</th>
                                <td class="bg-dark-maroon text-gold py-3 px-3">{{ $sanggar->tahun_sk ?? '-' }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="bg-dark-maroon text-gold py-3 px-3">Nama Penandatangan</th>
                                <td class="bg-dark-maroon text-gold py-3 px-3">{{ $sanggar->nama_penandatangan ?? '-' }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="bg-dark-maroon text-gold py-3 px-3">Jabatan Penandatangan</th>
                                <td class="bg-dark-maroon text-gold py-3 px-3">{{ $sanggar->jabatan_penandatangan ?? '-' }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="bg-dark-maroon text-gold py-3 px-3">Nama Pimpinan</th>
                                <td class="bg-dark-maroon text-gold py-3 px-3">{{ $sanggar->nama_pimpinan ?? '-' }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="bg-dark-maroon text-gold py-3 px-3">Jenis Kelamin Pimpinan</th>
                                <td class="bg-dark-maroon text-gold py-3 px-3">
                                    @if($sanggar->jenis_kelamin == 'L') Laki-laki
                                    @elseif($sanggar->jenis_kelamin == 'P') Perempuan
                                    @else - @endif
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="bg-dark-maroon text-gold py-3 px-3">NIK</th>
                                <td class="bg-dark-maroon text-gold py-3 px-3">{{ $sanggar->nik ?? '-' }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="bg-dark-maroon text-gold py-3 px-3">No. HP</th>
                                <td class="bg-dark-maroon text-gold py-3 px-3">{{ $sanggar->no_hp ?? '-' }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="bg-dark-maroon text-gold py-3 px-3">Jumlah Anggota</th>
                                <td class="bg-dark-maroon text-gold py-3 px-3">{{ $sanggar->jumlah_anggota ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- STATUS SAAT INI -->
                <p class="mt-3 mb-0">
                    <strong class="text-gold">Status Saat Ini:</strong>
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

        <!-- FORM VERIFIKASI -->
        <form method="POST" action="{{ route('verifikasi.updateStatus', $sanggar->id) }}" class="mt-4">
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
                        <textarea name="keterangan_status" class="form-control rounded-3 shadow-sm" rows="3">{{ $sanggar->keterangan_status }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-gold rounded-pill shadow-sm fw-semibold">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('sanggar.index') }}" class="btn btn-secondary rounded-pill shadow-sm">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
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
    toggleFields(); 
});
</script>

@push('styles')

<style>
.btn-gold { background-color: #b8860b; color: #2b0000; border: none; }
.btn-gold:hover { background-color: #f5e1b9; color: #800000; }
.bg-maroon { background-color: #4a0f0f !important; }
.bg-dark-maroon { background-color: #2b0000 !important; }
.text-maroon { color: #800000; }
.text-gold { color: #f5e1b9 !important; }
.bg-gradient-maroon { background: linear-gradient(135deg, #800000, #b8860b); }
.bg-dark-maroon { background-color: #2b0000; }
.form-control, .form-select { border: 1px solid #800000; background-color: #4a0f0f; color: #f5e1b9; }
.form-control::placeholder, .form-select option { color: #f5e1b9; }
.card { transition: all .3s ease; }
.card:hover { box-shadow: 0 6px 18px rgba(0,0,0,0.15); }
.badge { font-weight: 500; }
</style>

@endpush
@endsection
