<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@hasSection('title') @yield('title') - @endif{{ $settings['school_name'] ?? 'Website Profil Sekolah' }}</title>
    @if(!empty($settings['school_logo']))
        <link rel="icon" href="{{ url('optimized-image/' . $settings['school_logo']) }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ url('optimized-image/' . $settings['school_logo']) }}" type="image/x-icon">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- AOS Animation CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <style>
        :root {
            --ease-out-expo: cubic-bezier(0.16, 1, 0.3, 1);
            --ease-spring: cubic-bezier(0.34, 1.56, 0.64, 1);
            --ease-smooth: cubic-bezier(0.65, 0, 0.35, 1);
            --shadow-sm: 0 1px 2px 0 rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Glassmorphism Sticky Navbar */
        .navbar-sticky {
            position: sticky;
            top: 0;
            z-index: 1030;
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(33, 37, 41, 0.88) !important;
            transition: all 0.5s var(--ease-out-expo);
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.12);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .navbar-sticky.scrolled {
            background-color: rgba(33, 37, 41, 0.95) !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
            transform: translateY(0);
        }

        .navbar-brand {
            transition: transform 0.4s var(--ease-spring), opacity 0.3s ease;
            letter-spacing: -0.02em;
        }

        .navbar-brand:hover {
            transform: scale(1.04);
        }

        .navbar-nav .nav-link {
            position: relative;
            transition: color 0.35s var(--ease-smooth), font-weight 0.35s ease;
            font-weight: 500;
            letter-spacing: 0.01em;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #0d6efd, #0dcaf0);
            transition: all 0.4s var(--ease-out-expo);
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after {
            width: 80%;
        }

        .navbar-nav .nav-link.active {
            font-weight: 700;
            color: #fff !important;
        }

        /* Smooth Card Hover Elevation & 3D Lift */
        .card {
            transition: transform 0.5s var(--ease-out-expo),
                        box-shadow 0.5s var(--ease-out-expo),
                        border-color 0.4s ease;
            will-change: transform;
        }

        .card-hover:hover {
            transform: translateY(-10px) scale(1.01);
            box-shadow: var(--shadow-xl) !important;
        }

        /* Image Zoom Container */
        .img-zoom-container {
            overflow: hidden;
            border-radius: inherit;
        }

        .img-zoom-container img {
            transition: transform 0.7s var(--ease-out-expo), filter 0.5s ease;
            will-change: transform;
        }

        .card:hover .img-zoom-container img,
        .img-zoom-container:hover img {
            transform: scale(1.1);
            filter: brightness(1.05);
        }

        /* Buttons Smooth Hover */
        .btn {
            transition: all 0.4s var(--ease-out-expo);
            letter-spacing: 0.02em;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.2);
        }

        .btn:active {
            transform: translateY(-1px) scale(0.98);
            transition: all 0.15s ease;
        }

        .btn > * {
            position: relative;
            z-index: 1;
        }

        /* Keyframes */
        @keyframes floatVertical {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-14px) rotate(0.5deg); }
            50% { transform: translateY(-10px) rotate(0deg); }
            75% { transform: translateY(-16px) rotate(-0.5deg); }
        }

        .animate-float {
            animation: floatVertical 6s ease-in-out infinite;
        }

        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.35), 0 0 0 0 rgba(13, 110, 253, 0.2); }
            50% { box-shadow: 0 0 0 16px rgba(13, 110, 253, 0), 0 0 0 6px rgba(13, 110, 253, 0); }
        }

        .animate-pulse-glow {
            animation: pulseGlow 3s infinite;
        }

        .icon-box-animate {
            transition: transform 0.5s var(--ease-spring), background-color 0.4s ease, box-shadow 0.4s ease;
            will-change: transform;
        }

        .card:hover .icon-box-animate,
        .icon-box-animate:hover {
            transform: scale(1.18) rotate(6deg);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        /* Social Icon Hover */
        .social-link-hover {
            transition: all 0.4s var(--ease-spring);
            display: inline-block;
        }

        .social-link-hover:hover {
            color: #fff !important;
            transform: translateY(-4px) scale(1.25);
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
        }

        /* Alert Custom Minimalist Styling */
        .alert {
            border-radius: 14px !important;
            border: 1px solid transparent !important;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05) !important;
            animation: slideInDown 0.5s var(--ease-out-expo) forwards;
            backdrop-filter: blur(8px);
        }

        .alert-success {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%) !important;
            border-color: rgba(16, 185, 129, 0.3) !important;
            color: #065f46 !important;
        }

        .alert-info {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%) !important;
            border-color: rgba(56, 189, 248, 0.3) !important;
            color: #0369a1 !important;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%) !important;
            border-color: rgba(245, 158, 11, 0.3) !important;
            color: #92400e !important;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%) !important;
            border-color: rgba(239, 68, 68, 0.3) !important;
            color: #991b1b !important;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-24px) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Image Loading Skeleton */
        img {
            background: linear-gradient(90deg, #f0f0f0 25%, #e8e8e8 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite ease-in-out;
        }

        img.loaded {
            animation: none;
            background: none;
            transition: opacity 0.4s ease;
        }

        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Stagger Animation for Grid Items */
        .stagger-item {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s var(--ease-out-expo), transform 0.7s var(--ease-out-expo);
        }

        .stagger-item.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0d6efd, #0dcaf0);
            color: #fff;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            box-shadow: 0 8px 24px rgba(13, 110, 253, 0.35);
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px) scale(0.8);
            transition: all 0.5s var(--ease-spring);
            z-index: 1050;
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .back-to-top:hover {
            transform: translateY(-4px) scale(1.1);
            box-shadow: 0 12px 32px rgba(13, 110, 253, 0.45);
        }

        /* Smooth Section Reveal */
        .section-reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.9s var(--ease-out-expo), transform 0.9s var(--ease-out-expo);
        }

        .section-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* Badge subtle shine */
        .badge {
            transition: transform 0.35s var(--ease-spring), box-shadow 0.35s ease;
        }

        .badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* Modal smooth transition */
        .modal.fade .modal-dialog {
            transition: transform 0.5s var(--ease-out-expo), opacity 0.5s var(--ease-out-expo);
        }

        .modal.show .modal-dialog {
            transform: translateY(0) scale(1);
        }

        /* Smooth input focus */
        .form-control, .form-select {
            transition: all 0.35s var(--ease-out-expo);
            border: 1px solid #e2e8f0;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
            transform: translateY(-1px);
        }

        /* Spinner smooth */
        .spinner-border {
            animation: spinner-border 0.75s linear infinite;
        }

        @keyframes spinner-border {
            to { transform: rotate(360deg); }
        }

        /* Table row hover */
        .table-hover tbody tr {
            transition: all 0.3s ease;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.04);
            transform: scale(1.005);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark navbar-sticky">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}">
                @if(!empty($settings['school_logo']))
                    <img src="{{ url('optimized-image/' . $settings['school_logo']) }}" alt="Logo" style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover;">
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
                duration: 900,
                easing: 'ease-out-cubic',
                once: true,
                offset: 60,
                disable: 'phone'
            });

            const navbar = document.querySelector('.navbar-sticky');
            const backToTop = document.createElement('button');
            backToTop.className = 'back-to-top';
            backToTop.innerHTML = '<i class="bi bi-chevron-up"></i>';
            backToTop.setAttribute('aria-label', 'Back to top');
            backToTop.title = 'Kembali ke atas';
            document.body.appendChild(backToTop);

            function updateNavbar() {
                if (window.scrollY > 20) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }

                if (window.scrollY > 500) {
                    backToTop.classList.add('show');
                } else {
                    backToTop.classList.remove('show');
                }
            }

            updateNavbar();
            window.addEventListener('scroll', updateNavbar, { passive: true });

            backToTop.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            const observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        entry.target.classList.add('revealed');
                    }
                });
            }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

            document.querySelectorAll('.stagger-item, .section-reveal').forEach(function (el) {
                observer.observe(el);
            });

            const cards = document.querySelectorAll('.card-hover');
            cards.forEach(function (card) {
                card.addEventListener('mouseenter', function () {
                    card.style.transition = 'transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.5s cubic-bezier(0.16, 1, 0.3, 1)';
                });
                card.addEventListener('mouseleave', function () {
                    card.style.transition = 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.5s cubic-bezier(0.16, 1, 0.3, 1)';
                });
            });

            const sections = document.querySelectorAll('section, .py-5, .min-vh-100');
            sections.forEach(function (section) {
                section.classList.add('section-reveal');
                observer.observe(section);
            });
        });
    </script>
</body>
</html>