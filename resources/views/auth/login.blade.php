@extends('layouts.loginmaster')

@section('title', 'Login - SINDRA CIREBON | Sistem Informasi Pendaftaran Sanggar dan Komunitas Budaya')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="color:#7B3F00;">
                    Selamat Datang di <span style="color:#B87333;">SINDRA CIREBON</span>
                </h2>
                <p class="text-muted">
                    Sistem Informasi Pendaftaran Sanggar, Padepokan, dan Komunitas Seni Budaya Kabupaten Cirebon.<br>
                    Mari lestarikan budaya melalui pendataan dan registrasi resmi.
                </p>
            </div>

            <div class="card auth-card animated shadow-sm">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-semibold">{{ __('Login Akun') }}</h4>
                        <i class="fas fa-drum fa-lg" style="color:#7B3F00;"></i>
                    </div>
                </div>

                <div class="card-body p-4">

                    {{-- ✅ ALERT NOTIFIKASI LOGIN GAGAL --}}
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login_proses') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label fw-medium">{{ __('Email') }}</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope" style="color:#7B3F00;"></i>
                                </span>
                                <input id="email" name="email" type="email" 
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus
                                       placeholder="Masukkan email Anda">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="password" class="form-label fw-medium">{{ __('Kata Sandi') }}</label>
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none small" href="{{ route('password.request') }}" style="color:#7B3F00;">
                                        {{ __('Lupa Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock" style="color:#7B3F00;"></i>
                                </span>
                                <input id="password" name="password" type="password" 
                                       class="form-control @error('password') is-invalid @enderror"
                                       required autocomplete="current-password"
                                       placeholder="Masukkan kata sandi Anda">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" 
                                       id="remember" {{ old('remember') ? 'checked' : '' }}
                                       style="border-color:#7B3F00;">
                                <label class="form-check-label" for="remember">
                                    {{ __('Ingat Saya') }}
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mb-4">
                            <button type="submit" class="btn btn-primary btn-lg" 
                                    style="background-color:#7B3F00; border-color:#7B3F00;">
                                <i class="fas fa-sign-in-alt me-2"></i>{{ __('Masuk') }}
                            </button>
                        </div>

                        <div class="position-relative my-4">
                            <hr>
                            <div class="position-absolute top-50 start-50 translate-middle px-3 bg-white">
                                <span class="text-muted">ATAU</span>
                            </div>
                        </div>

                        <div class="text-center"> 
                            <p class="mb-3">Belum memiliki akun sanggar atau komunitas?</p> 
                            <a href="{{ route('auth.register') }}" 
                            class="btn btn-primary btn-lg d-inline-flex align-items-center justify-content-center"
                            style="
                                    background-color:#7B3F00; 
                                    border-color:#7B3F00; 
                                    color:#d4af37; 
                                    width: 100%; 
                                    font-weight: 500;
                                    transition: all 0.3s ease;
                                "
                            onmouseover="this.style.backgroundColor='#5E2F00'; this.style.transform='scale(1.02)';"
                            onmouseout="this.style.backgroundColor='#7B3F00'; this.style.transform='scale(1)';">
                                <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                            </a> 
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
