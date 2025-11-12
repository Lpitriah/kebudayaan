@extends('layouts.master')

@section('title', 'Edit Layanan Laundry')

@section('content')
<div class="container-fluid px-4">
    <div class="card animate__animated animate__fadeIn shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-user-edit me-2"></i>Edit Layanan Laundry - {{ $layanan_laundry->nama_layanan }}
                </h5>
            </div>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('layanan_laundry.update', $layanan_laundry->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kode_layanan" class="form-label fw-semibold text-muted">Kode Layanan</label>
                            <input type="text" class="form-control rounded-lg bg-light" id="kode_layanan" name="kode_layanan" 
                                   value="{{ old('kode_layanan', $layanan_laundry->kode_layanan) }}" readonly>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_layanan" class="form-label fw-semibold text-muted">Nama Layanan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-lg" id="nama_layanan" name="nama_layanan" 
                                   value="{{ old('nama_layanan', $layanan_laundry->nama_layanan) }}" required>
                            @error('nama_layanan')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="deskripsi" class="form-label fw-semibold text-muted">Deskripsi</label>
                            <input type="deskripsi" class="form-control rounded-lg" id="deskrispi" name="deskripsi" 
                                   value="{{ old('email', $layanan_laundry->deskripsi) }}">
                            @error('deskripsi')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estimasi_hari" class="form-label fw-semibold text-muted">Estimasi Hari</label>
                            <input type="text" class="form-control rounded-lg" id="estimasi_hari" name="estimasi_hari" 
                                   value="{{ old('estimasi_hari', $layanan_laundry->estimasi_hari) }}">
                            @error('estimasi_hari')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group">
                            <label for="harga_per_kg" class="form-label fw-semibold text-muted">Harga perKg</label>
                            <textarea class="form-control rounded-lg" id="harga_per_kg" name="harga_per_kg" rows="3">{{ old('harga_per_kg', $layanan_laundry->harga_per_kg) }}</textarea>
                            @error('harga_per_kg')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('layanan_laundry.index', $layanan_laundry->id) }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
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
    
    .form-control {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.15);
    }
    
    .form-control[readonly] {
        background-color: #f8fafc;
    }
    
    .rounded-lg {
        border-radius: 8px;
    }
    
    .btn {
        border-radius: 50px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background-color: #0ea5e9;
        border-color: #0ea5e9;
    }
    
    .btn-primary:hover {
        background-color: #0c8fd1;
        border-color: #0c8fd1;
        transform: translateY(-2px);
    }
    
    .btn-outline-secondary:hover {
        transform: translateY(-2px);
    }
    
    .form-label {
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }
</style>
@endpush