<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sistem Kebudayaan')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --maroon: #800000;
            --maroon-dark: #5a0000;
            --gold: #d4af37;
            --light-bg: #faf8f5;
            --text-dark: #2c2c2c;
            --text-light: #fff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
        }

        /* 🌟 Navbar */
        .navbar {
            background: linear-gradient(90deg, var(--maroon-dark), var(--maroon));
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }
        .navbar-brand {
            color: var(--gold) !important;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .nav-link {
            color: #f5d97b !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .nav-link:hover, .nav-link.active {
            color: #fff !important;
            transform: translateY(-2px);
        }
        .navbar-toggler {
            border-color: var(--gold);
        }

        /* ✨ Tombol */
        .btn, .btn-primary, .btn-outline-primary {
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--maroon), var(--maroon-dark));
            border: none;
            color: var(--text-light);
        }
        .btn-primary:hover {
            background: var(--maroon-dark);
            color: var(--gold);
        }
        .btn-outline-primary {
            border: 2px solid var(--maroon);
            color: var(--maroon);
        }
        .btn-outline-primary:hover {
            background: var(--maroon);
            color: var(--gold);
        }

        /* 💫 Card */
        .card {
            border-radius: 14px;
            border: 1px solid rgba(212,175,55,0.25);
            box-shadow: 0 4px 15px rgba(128,0,0,0.1);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 25px rgba(128,0,0,0.25);
        }
        .card-header {
            background: linear-gradient(90deg, var(--maroon), var(--maroon-dark));
            color: var(--gold);
            font-weight: 600;
            letter-spacing: 0.3px;
            text-align: center;
            border-bottom: none;
        }

        /* 🧾 Form & Input */
        .form-control, .input-group-text {
            border-radius: 10px;
            transition: 0.3s;
        }
        .form-control:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 0.25rem rgba(212,175,55,0.25);
        }
        .input-group-text {
            background-color: #fff;
            border-right: none;
            color: var(--maroon);
        }

        /* Dropdown */
        .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        .dropdown-item:hover {
            background-color: var(--gold);
            color: var(--maroon);
        }

        /* 📜 Footer */
        footer {
            background-color: var(--maroon-dark);
            color: var(--gold);
            padding: 20px 0;
            text-align: center;
            font-size: 0.9rem;
            margin-top: 40px;
            letter-spacing: 0.3px;
        }

        /* Animasi lembut */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animated {
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            .navbar-brand { font-size: 1rem; }
            footer { font-size: 0.8rem; }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- 🌹 Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-landmark me-2"></i> Sistem Kebudayaan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('auth.login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('auth.register') }}">Register</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                       <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- 💠 Konten -->
    <main class="py-5">
        <div class="container animated">
            @yield('content')
        </div>
    </main>

    <!-- 💛 Footer -->
    <footer>
        <p>© {{ date('Y') }} Sistem Kebudayaan — <span style="color:#fff;">Maroon</span> & <span style="color:var(--gold);">Gold</span> Theme</p>
    </footer>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.card').forEach((c, i) => {
                c.classList.add('animated');
                c.style.animationDelay = `${i * 0.1}s`;
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
