<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>{{ config('app.name', 'SINDRA CIREBON') }} - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo_sandika.png') }}">

    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    @stack('styles')
    
<style>
    :root {
        --primary-50: #fdf5f5;
        --primary-100: #f8dada;
        --primary-200: #f1a9a9;
        --primary-300: #e17979;
        --primary-400: #b84f4f;
        --primary-500: #800000;
        --primary-600: #6e0000;
        --primary-700: #5c0000;
        --primary-800: #450000;
        --primary-900: #2e0000;
        --primary-950: #1a0000;

        --secondary-500: #d4af37;

        --dark-color: #1e1e1e;
        --light-color: #fdfcfb;

        --header-height: 70px;
        --footer-height: 60px;

        --transition: all 0.3s ease-in-out;
        --border-radius: 12px;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--light-color);
        color: #2e2e2e;
        overflow-x: hidden;
        overflow-y: auto;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Header */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: linear-gradient(135deg, var(--primary-700), var(--primary-900));
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        height: var(--header-height);
        z-index: 1000;
        border-bottom: 2px solid var(--secondary-600);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 2rem;
    }

    .navbar-brand {
        font-weight: 700;
        color: var(--secondary-500);
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        letter-spacing: 0.5px;
    }

    .navbar-brand img {
        height: 40px;
        width: auto;
    }

    .navbar-brand:hover {
        color: var(--text-light);
        transform: scale(1.02);
        transition: var(--transition);
    }

    .navbar-brand .logo-icon {
        font-size: 1.5rem;
        color: var(--secondary-500);
    }

    /* Main Content */
    .main-content {
        flex: 1;
        margin-top: var(--header-height);
        margin-bottom: var(--footer-height);
        padding: 2rem;
        background-color: #f8f4f0;
        overflow-y: auto;
    }

    .content-wrapper {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Card */
    .card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        background: white;
        transition: var(--transition);
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-600), var(--primary-800));
        color: var(--secondary-500);
        font-weight: 600;
        border-bottom: none;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    /* Button */
    .btn {
        border-radius: var(--border-radius);
        padding: 0.5rem 1.25rem;
        font-weight: 500;
        transition: var(--transition);
        border: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-600), var(--primary-800));
        color: var(--secondary-500);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--primary-700), var(--primary-900));
        color: white;
        transform: translateY(-2px);
    }

    /* Table */
    .table thead th {
        background-color: var(--primary-700);
        color: var(--secondary-500);
        border-bottom: none;
    }

    .table-hover tbody tr:hover {
        background-color: #fce9d2;
    }

    /* Input */
    .form-control:focus {
        border-color: var(--secondary-500);
        box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.2);
    }

    /* Footer */
    footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: var(--footer-height);
        background: var(--primary-900);
        color: var(--secondary-500);
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 2rem;
        border-top: 2px solid var(--secondary-500);
        z-index: 1000;
    }

    /* Floating Button */
    .fab {
        position: fixed;
        bottom: calc(var(--footer-height) + 20px);
        right: 20px;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-600), var(--primary-800));
        color: var(--secondary-500);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 20px rgba(128, 0, 0, 0.3);
        cursor: pointer;
        transition: var(--transition);
    }

    .fab:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 6px 25px rgba(128, 0, 0, 0.5);
        color: white;
    }
</style>


</head>
<body>
<nav class="navbar">
    <a href="#" class="navbar-brand">
        <img src="{{ asset('images/logo_sandika.png') }}" alt="Logo Aplikasi">
        <span>SINDRA</span>
    </a>
</nav>


    <!-- Scrollable Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Floating Action Button -->
    <!-- <div class="fab ripple" id="fabButton">
        <i class="fas fa-plus"></i>
    </div> -->

   <!-- Fixed Footer -->
<footer class="animate__animated animate__fadeInUp" style="color: #d4af37;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="container text-center">
                <p class="small" style="color: #d4af37;">
                    © {{ date('Y') }} <strong>SINDRA CIREBON</strong> — Sistem Informasi Pendaftaran No Induk Kebudayaan Sanggar, Komunitas, dan Padepokan Seni Budaya.<br>
                    Dikembangkan oleh <strong>Laelatul Pitriah</strong>.
                </p>
            </div>
        </div>
    </div>
</footer>
                
            
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS animation
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Mobile sidebar toggle
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
            
            // Add overlay when sidebar is open on mobile
            if (document.querySelector('.sidebar').classList.contains('show')) {
                const overlay = document.createElement('div');
                overlay.className = 'sidebar-overlay';
                overlay.style.position = 'fixed';
                overlay.style.top = '0';
                overlay.style.left = '0';
                overlay.style.right = '0';
                overlay.style.bottom = '0';
                overlay.style.backgroundColor = 'rgba(0,0,0,0.5)';
                overlay.style.zIndex = '1035';
                overlay.addEventListener('click', function() {
                    document.querySelector('.sidebar').classList.remove('show');
                    document.body.removeChild(overlay);
                });
                document.body.appendChild(overlay);
            } else {
                const overlay = document.querySelector('.sidebar-overlay');
                if (overlay) {
                    document.body.removeChild(overlay);
                }
            }
        });
        
        // Close sidebar when clicking on a link (mobile)
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 992) {
                    document.querySelector('.sidebar').classList.remove('show');
                    const overlay = document.querySelector('.sidebar-overlay');
                    if (overlay) {
                        document.body.removeChild(overlay);
                    }
                }
            });
        });
        
        // Adjust main content height on resize
        function adjustMainContentHeight() {
            const headerHeight = document.querySelector('.navbar').offsetHeight;
            const footerHeight = document.querySelector('footer').offsetHeight;
            document.documentElement.style.setProperty('--header-height', `${headerHeight}px`);
            document.documentElement.style.setProperty('--footer-height', `${footerHeight}px`);
        }
        
        window.addEventListener('resize', adjustMainContentHeight);
        window.addEventListener('load', adjustMainContentHeight);
        
        // Ripple effect
        document.querySelectorAll('.ripple').forEach(element => {
            element.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                ripple.className = 'ripple-effect';
                
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = `${size}px`;
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
        
        // Floating action button click
        document.getElementById('fabButton').addEventListener('click', function() {
            // Show a toast notification
            const toast = document.createElement('div');
            toast.className = 'position-fixed bottom-0 end-0 p-3';
            toast.style.zIndex = '1100';
            
            const toastContent = document.createElement('div');
            toastContent.className = 'toast show';
            toastContent.role = 'alert';
            toastContent.setAttribute('aria-live', 'assertive');
            toastContent.setAttribute('aria-atomic', 'true');
            
            toastContent.innerHTML = `
                <div class="toast-header bg-primary text-white">
                    <strong class="me-auto">Notification</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    New action triggered from FAB!
                </div>
            `;
            
            toast.appendChild(toastContent);
            document.body.appendChild(toast);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                toast.remove();
            }, 3000);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
    @if($message = Session::get('success'))
        <script>
            Swal.fire({
                title: "{{ $message }}",
                icon: "success",
                showConfirmButton: false,
                timer: 2000,
                background: 'var(--primary-50)',
                backdrop: `
                    rgba(14,165,233,0.2)
                    url("/images/nyan-cat.gif")
                    left top
                    no-repeat
                `
            }); 
        </script>
    @endif
    @if($message = Session::get('failed'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ $message }}",
                background: 'var(--primary-50)'
            });
        </script>
    @endif
</body>
</html>