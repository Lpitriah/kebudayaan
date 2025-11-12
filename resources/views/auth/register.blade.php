@extends('layouts.loginmaster')

@section('title', 'Register - Sistem Kebudayaan')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="color: var(--primary-600);">Daftarkan Akun Anda</h2>
                <p class="text-muted">Bergabunglah dengan sistem kebudayaan untuk mengelola sanggar, komunitas, dan padepokan dengan mudah</p>
            </div>
            
            <div class="card auth-card animated">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-semibold">{{ __('Buat Akun Baru') }}</h4>
                        <i class="fas fa-tshirt fa-lg"></i>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('auth.register') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label fw-medium">{{ __('Nama Lengkap') }}</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user" style="color: var(--primary-milk-brown);"></i>
                                </span>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                       placeholder="Masukkan nama lengkap Anda">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-medium">{{ __('Email') }}</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope" style="color: var(--primary-milk-brown);"></i>
                                </span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="email"
                                       placeholder="Masukkan email Anda">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-medium">{{ __('Kata Sandi') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock" style="color: var(--primary-milk-brown);"></i>
                                        </span>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                               name="password" required autocomplete="new-password"
                                               placeholder="Buat kata sandi">
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <small class="form-text text-muted">Minimal 8 karakter</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="password-confirm" class="form-label fw-medium">{{ __('Konfirmasi Kata Sandi') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock" style="color: var(--primary-milk-brown);"></i>
                                        </span>
                                        <input id="password-confirm" type="password" class="form-control" 
                                               name="password_confirmation" required autocomplete="new-password"
                                               placeholder="Ulangi kata sandi">
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="terms" required
                                       style="border-color: var(--primary-milk-brown);">
                                <label class="form-check-label" for="terms">
                                    Saya menyetujui <a href="#" style="color: var(--primary-milk-brown);">Syarat & Ketentuan</a> dan 
                                    <a href="#" style="color: var(--primary-milk-brown);">Kebijakan Privasi</a>
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mb-4">
                            <button type="submit" class="btn btn-primary btn-lg" 
                                    style="background-color: var(--primary-milk-brown); border-color: var(--primary-milk-brown);">
                                <i class="fas fa-user-plus me-2"></i>{{ __('Daftar Sekarang') }}
                            </button>
                        </div>

                        <div class="position-relative my-4">
                            <hr>
                            <div class="position-absolute top-50 start-50 translate-middle px-3 bg-white">
                                <span class="text-muted">ATAU</span>
                            </div>
                        </div>

                        <div class="text-center">
                            <p class="mb-3">Sudah punya akun?</p>
                            <a href="{{ route('auth.login') }}" class="btn btn-outline-primary w-100"
                               style="color: var(--primary-milk-brown); border-color: var(--primary-milk-brown);">
                                <i class="fas fa-sign-in-alt me-2"></i>{{ __('Masuk Sekarang') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <p class="text-muted small">© {{ date('Y') }}  <strong>SINDRA CIREBON</strong> — Sistem Informasi Pendaftaran No Induk Kebudayaan Sanggar, Komunitas, dan Padepokan Seni Budaya.<br></p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const passwordInput = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    });
</script>
@endpush
@endsection
