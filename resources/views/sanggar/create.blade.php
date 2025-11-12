@extends('layouts.master')

@section('title', 'Tambah Data Sanggar / Komunitas Budaya')

@section('content')

<div class="container-fluid px-4 py-3">
    <div class="card shadow border-0 rounded-4 animate__animated animate__fadeIn" style="background-color:#2b0000; color:#f5e1b9;">
        <div class="card-header bg-gradient-maroon text-gold py-3 rounded-top-4 border-0">
            <h5 class="mb-0 fw-semibold d-flex align-items-center">
                <i class="fas fa-landmark me-2"></i> Data Sanggar / Komunitas Budaya
            </h5>
        </div>

    <div class="card-body p-4">

        <!-- <div class="alert border-0 shadow-sm rounded-4 mb-4" style="background-color:#4a0f0f; color:#ffd88a;">
            <i class="fas fa-info-circle me-2 text-warning"></i>
            <strong>Perhatian:</strong> Mohon lengkapi seluruh data pada formulir ini dengan benar dan lengkap.
            Data yang tidak lengkap dapat menghambat proses verifikasi dan <strong>pengajuan Nomor Induk Kebudayaan tidak dapat disetujui (ACC)</strong>.
        </div> -->

        <form action="{{ route('sanggar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">

                <div class="col-12">
                    <h5 class="fw-bold border-bottom border-gold pb-2 mb-3">
                        <i class="fas fa-users me-2"></i> Data Umum Sanggar / Komunitas
                    </h5>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold text-gold">Kode Sanggar <span class="text-danger">*</span></label>
                    <input type="text" name="kode_sanggar" class="form-control bg-light-gold text-dark" 
                           value="{{ 'SGR-' . strtoupper(substr(uniqid(), -5)) }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold text-gold">Nama Sanggar / Komunitas <span class="text-danger">*</span></label>
                    <input type="text" name="nama_sanggar" class="form-control bg-light-gold text-dark" value="{{ old('nama_sanggar') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold text-gold">Bidang / Jenis Garapan Seni</label>
                    <input type="text" name="bidang_garapan_seni" class="form-control bg-light-gold text-dark" value="{{ old('bidang_garapan_seni') }}">
                </div>

                <div class="col-12">
                    <h5 class="fw-bold border-bottom border-gold pb-2 mt-4 mb-3">
                        <i class="fas fa-map-marker-alt me-2"></i> Alamat Sanggar
                    </h5>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold text-gold">Jalan / RT / RW</label>
                    <input type="text" name="jalan_rt_rw" class="form-control bg-light-gold text-dark" value="{{ old('jalan_rt_rw') }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold text-gold">Desa / Kelurahan</label>
                    <input type="text" name="desa_kel" class="form-control bg-light-gold text-dark" value="{{ old('desa_kel') }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold text-gold">Kecamatan</label>
                    <input type="text" name="kecamatan" class="form-control bg-light-gold text-dark" value="{{ old('kecamatan') }}">
                </div>

                <div class="col-12">
                    <h5 class="fw-bold border-bottom border-gold pb-2 mt-4 mb-3">
                        <i class="fas fa-file-signature me-2"></i> SK Pembuatan
                    </h5>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-gold">No. SK</label>
                    <input type="text" name="no_sk" class="form-control bg-light-gold text-dark" value="{{ old('no_sk') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-gold">Tahun SK</label>
                    <input type="number" name="tahun_sk" class="form-control bg-light-gold text-dark" value="{{ old('tahun_sk') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-gold">Jabatan Penandatangan</label>
                    <input type="text" name="jabatan_penandatangan" class="form-control bg-light-gold text-dark" value="{{ old('jabatan_penandatangan') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-gold">Nama Pejabat Penandatangan</label>
                    <input type="text" name="nama_penandatangan" class="form-control bg-light-gold text-dark" value="{{ old('nama_penandatangan') }}">
                </div>

                <div class="col-12">
                    <h5 class="fw-bold border-bottom border-gold pb-2 mt-4 mb-3">
                        <i class="fas fa-user-tie me-2"></i> Data Pimpinan Sanggar
                    </h5>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold text-gold">Nama Pimpinan <span class="text-danger">*</span></label>
                    <input type="text" name="nama_pimpinan" class="form-control bg-light-gold text-dark" value="{{ old('nama_pimpinan') }}" required>
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold text-gold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select bg-light-gold text-dark rounded-lg">
                        <option value="">Pilih</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-gold">NIK</label>
                    <input type="text" name="nik" class="form-control bg-light-gold text-dark" value="{{ old('nik') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-gold">No. HP</label>
                    <input type="text" name="no_hp" class="form-control bg-light-gold text-dark" value="{{ old('no_hp') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-gold">Jumlah Anggota</label>
                    <input type="number" name="jumlah_anggota" class="form-control bg-light-gold text-dark" value="{{ old('jumlah_anggota') }}">
                </div>

                <!-- <div class="col-12 mt-4">
                    <h5 class="fw-bold border-bottom border-gold pb-2 mb-3">
                        <i class="fas fa-image me-2"></i> Unggah Foto
                    </h5>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold text-gold"> Pas Photo Diri </label>
                    <input type="file" name="foto" class="form-control bg-light-gold text-dark rounded-lg" accept="image/*">
                    <small class="text-muted d-block mt-1 text-gold">Format: JPG, PNG, Max 2MB</small>
                </div> -->

                <div class="col-12 mt-4 text-end">
                    <a href="{{ route('sanggar.index') }}" class="btn btn-outline-gold rounded-pill px-4">
                        <i class="fas fa-arrow-left me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-maroon rounded-pill px-4 shadow-sm">
                        <i class="fas fa-paper-plane me-1"></i> Tambah Data
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

</div>
@endsection

@push('styles')

<style>
.text-gold { color: #f5e1b9 !important; }
.border-gold { border-color: #f5e1b9 !important; }
.bg-light-gold { background-color: #fff7f0 !important; }
.btn-outline-gold {
    color: #f5e1b9;
    border: 1px solid #f5e1b9;
}
.btn-outline-gold:hover {
    background-color: #f5e1b9;
    color: #800000;
}
</style>

@endpush
