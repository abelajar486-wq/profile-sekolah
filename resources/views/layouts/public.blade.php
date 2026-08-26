<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@hasSection('title') @yield('title') - @endif{{ $settings['school_name'] ?? 'Website Profil Sekolah' }}</title>
    @if(!empty($settings['school_logo']))
        <link rel="icon" href="{{ asset('storage/' . $settings['school_logo']) }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('storage/' . $settings['school_logo']) }}" type="image/x-icon">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- AOS Animation CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* Glassmorphism Sticky Navbar */
        .navbar-sticky {
            position: sticky;
            top: 0;
            z-index: 1030;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            background-color: rgba(33, 37, 41, 0.92) !important;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .navbar-brand {
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.03);
        }

        .navbar-nav .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            width: 0;
            height: 2.5px;
            background: linear-gradient(90deg, #0d6efd, #0dcaf0);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after {
            width: 75%;
        }

        .navbar-nav .nav-link.active {
            font-weight: 600;
        }

        /* Smooth Card Hover Elevation & Zoom */
        .card {
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), 
                        box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1), 
                        border-color 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.1) !important;
        }

        /* Image Zoom Container */
        .img-zoom-container {
            overflow: hidden;
            border-radius: inherit;
        }

        .img-zoom-container img {
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .card:hover .img-zoom-container img,
        .img-zoom-container:hover img {
            transform: scale(1.08);
        }

        /* Buttons Smooth Hover */
        .btn {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.18);
        }

        .btn:active {
            transform: translateY(-1px);
        }

        /* Keyframes */
        @keyframes floatVertical {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }

        .animate-float {
            animation: floatVertical 4s ease-in-out infinite;
        }

        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.4); }
            50% { box-shadow: 0 0 0 14px rgba(13, 110, 253, 0); }
        }

        .animate-pulse-glow {
            animation: pulseGlow 2.5s infinite;
        }

        .icon-box-animate {
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.3s ease;
        }

        .card:hover .icon-box-animate,
        .icon-box-animate:hover {
            transform: scale(1.15) rotate(4deg);
        }

        /* Social Icon Hover */
        .social-link-hover {
            transition: all 0.3s ease;
        }
        .social-link-hover:hover {
            color: #fff !important;
            transform: translateY(-3px) scale(1.2);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark navbar-sticky">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}">
                @if(!empty($settings['school_logo']))
                    <img src="{{ asset('storage/' . $settings['school_logo']) }}" alt="Logo" style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover;">
                @endif
                {{ $settings['school_name'] ?? 'Profil Sekolah' }}
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('ppdb.*') ? 'active' : '' }}" href="{{ route('ppdb.info') }}">PPDB</a></li>
                </ul>

                <!-- Tombol Navigasi Auth -->
                <div class="d-flex gap-2 align-items-center">
                    @if(Auth::check())
                        @if(session('is_admin'))
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">Dashboard Admin</a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">Dashboard User</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm rounded-pill px-3 animate-pulse-glow">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Pembungkus konten utama -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <div class="container">
            @if(!empty($settings['facebook_url']) || !empty($settings['instagram_url']) || !empty($settings['linkedin_url']))
                <div class="d-flex justify-content-center gap-3 mb-2">
                    @if(!empty($settings['facebook_url']))
                        <a href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener noreferrer" class="text-white-50 text-decoration-none fs-5 social-link-hover" title="Facebook"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if(!empty($settings['instagram_url']))
                        <a href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener noreferrer" class="text-white-50 text-decoration-none fs-5 social-link-hover" title="Instagram"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if(!empty($settings['linkedin_url']))
                        <a href="{{ $settings['linkedin_url'] }}" target="_blank" rel="noopener noreferrer" class="text-white-50 text-decoration-none fs-5 social-link-hover" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    @endif
                </div>
            @endif
            <p class="m-0 small text-white-50">&copy; {{ date('Y') }} {{ $settings['school_name'] ?? 'Sekolah Kita' }}. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Library Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 50
            });
        });
    </script>
</body>
</html>