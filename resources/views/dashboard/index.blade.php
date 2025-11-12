@extends('layouts.master')

@section('title', 'Dashboard Kebudayaan')

@section('content')
<div class="container-fluid px-4">


    <!-- Header Sambutan -->
    <!-- <div class="py-4 text-center">
        <h2 class="fw-bold text-gradient animate__animated animate__fadeInDown">
            Hai, {{ Auth::user()->name }}! Selamat Datang di Sistem Informasi Pendaftaran Nomor Induk Kebudayaan 🎭
        </h2>
        <p class="text-muted">Pantau data sanggar budaya dan aktivitas kebudayaan di daerahmu.</p>
    </div> -->

    <!-- Card Dashboard -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white">
            <h5 class="mb-0 fw-semibold">
                <i class="fas fa-home me-2"></i> Dashboard
            </h5>
        </div>

        <div class="card-body p-4">
            @if(auth()->user()->level == 'admin')
                {{-- Dashboard untuk Admin --}}
                @include('dashboard.admin')
            @else
                {{-- Dashboard untuk User --}}
                @include('dashboard.user')
            @endif
        </div>
    </div>

</div>
@endsection


@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    .text-gradient {
        background: linear-gradient(45deg, #00c6ff, #0072ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .card-stat {
        border-radius: 1rem;
        background: #fff;
        transition: all 0.3s ease-in-out;
    }

    .card-stat:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .icon-circle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
    }

    .bg-soft-blue {
        background: rgba(0, 123, 255, 0.1);
    }

    .bg-soft-green {
        background: rgba(40, 167, 69, 0.1);
    }

    .bg-soft-orange {
        background: rgba(255, 193, 7, 0.1);
    }
</style>
@endpush
