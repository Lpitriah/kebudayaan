<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SINDRA CIREBON') }} - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo_sandika.png') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    

    <style>
    :root {
        --primary-500: #7b1e1e; /* maroon lembut */
        --primary-600: #5c0000; /* maroon gelap */
        --accent-gold: #d4af37; /* emas */
        --accent-gold-light: #f1d87c;
        --light-bg: #3c0a0a; /* latar belakang dashboard */
        --card-bg: #4a0f0f; /* kartu konten */
        --text-light: #fdf6e3;
        --radius: 14px;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: var(--light-bg);
        color: var(--text-light);
        margin: 0;
        padding-bottom: 70px;
    }

    /* Navbar */
    .navbar {
        background: linear-gradient(135deg, var(--primary-600), var(--primary-500));
        height: 70px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.3);
    }

    .navbar-brand {
        color: var(--accent-gold);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .navbar-brand img {
        height: 40px;
        border-radius: 50%;
    }

    .navbar small {
        color: #f7e5b8;
        font-size: 0.8rem;
    }

    .navbar-nav .nav-link {
        color: var(--text-light) !important;
    }

    /* Sidebar */
    .sidebar {
        width: 240px;
        position: fixed;
        top: 70px;
        left: 0;
        height: calc(100vh - 70px);
        background: #2d0606;
        border-right: 1px solid #652323;
        padding-top: 20px;
    }

    .sidebar .nav-link {
        color: #f5e1b9;
        font-weight: 500;
        padding: 12px 20px;
        margin: 6px 12px;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
        color: var(--accent-gold);
    }

    /* Main content */
    .main-content {
        margin-left: 240px;
        padding: 100px 30px 40px;
        min-height: calc(100vh - 100px);
        background: var(--light-bg);
    }

    /* Card */
    .card {
        background: var(--card-bg);
        border: none;
        border-radius: var(--radius);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        transition: all 0.3s ease;
        color: var(--text-light);
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.4);
    }

    .card-header {
        background: var(--primary-500);
        color: var(--accent-gold);
        font-weight: 600;
    }

    /* Buttons */
    .btn-maroon {
        background: var(--primary-500);
        color: var(--accent-gold);
        border: none;
    }
    .btn-maroon:hover {
        background: var(--primary-600);
        color: #fff;
    }
    .btn-gold {
        background: var(--accent-gold);
        color: #4a0f0f;
    }
    .btn-gold:hover {
        background: var(--accent-gold-light);
        color: #3c0a0a;
    }

    /* Footer */
    footer {
        background: var(--primary-600);
        color: var(--accent-gold);
        text-align: center;
        padding: 14px;
        width: 100%;
        position: fixed;
        bottom: 0;
        left: 0;
        box-shadow: 0 -2px 10px rgba(0,0,0,0.3);
        letter-spacing: 0.4px;
    }

    footer p {
        margin: 0;
        font-size: 0.9rem;
    }

    @media (max-width: 992px) {
        .sidebar { display: none; }
        .main-content { margin-left: 0; }
    }

/* Table theme maroon - gold */
.table-custom {
    width: 100%;
    border-collapse: separate !important;
    border-spacing: 0;
}

.table-custom thead th {
    background: linear-gradient(135deg, #5c0000, #800000) !important; /* gradasi maroon */
    color: #f5e1b9 !important; /* gold */
    border: none !important;
    font-weight: 600;
}

.table-custom tbody tr {
    background-color: #4a0f0f !important; /* baris gelap */
    color: #f5e1b9 !important; /* teks gold */
}

.table-custom tbody tr td {
    background-color: transparent !important; /* hapus putih bawaan */
    color: inherit !important;
}

.table-custom tbody tr:hover {
    background-color: #5c0f0f !important; /* hover lebih terang */
    color: #fff !important;
}

/* responsive wrapper */
.table-responsive {
    background-color: transparent !important;
}



</style>


    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar fixed-top px-4">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                <img src="{{ asset('images/logo_dinas.jpg') }}" alt="Logo Dinas">
                <img src="{{ asset('images/logo_sandika.png') }}" alt="Logo Aplikasi">
                <div class="d-flex flex-column lh-sm">
                    <span class="fw-semibold text-uppercase" style="font-size: 1.1rem;">SINDRA CIREBON</span>
                    <small>Sistem Informasi Pendaftaran No Induk Kebudayaan</small>
                </div>
            </a>

            <ul class="navbar-nav ms-auto pe-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name ?? 'Pengguna' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profil</a></li>
                        <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('sanggar') ? 'active' : '' }}" href="{{ route('sanggar.index') }}">
                    <i class="fas fa-users me-2"></i> Sanggar / Komunitas
                </a>
            </li>
            @if(Auth::check() && Auth::user()->level === 'user')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('daftar') ? 'active' : '' }}" href="{{ route('daftar.index') }}">
                        <i class="fas fa-id-card me-2"></i> Daftar No Induk Kebudayaan
                    </a>
                </li>
            @endif
            @if(Auth::check() && Auth::user()->level === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('verifikasi') ? 'active' : '' }}" href="{{ route('verifikasi.index') }}">
                        <i class="fas fa-check-circle me-2"></i> Verifikasi
                    </a>
                </li>
            @endif
        </ul>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p>
            © {{ date('Y') }} <strong>SINDRA CIREBON</strong> — Sistem Informasi Pendaftaran No Induk Kebudayaan Sanggar, Komunitas, dan Padepokan Seni Budaya.<br>
            Dikembangkan oleh <strong>Laelatul Pitriah</strong>.
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
