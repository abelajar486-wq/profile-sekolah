<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['school_name'] ?? 'Website Profil Sekolah' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }

        .navbar {
            transition: all 0.3s ease;
            animation: fadeInDown 0.5s ease forwards;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .navbar-nav .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: #fff;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after {
            width: 80%;
        }

        .navbar-nav .nav-link.active {
            font-weight: 600;
        }

        .btn {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .card {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        footer {
            animation: fadeIn 0.8s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<!-- Tambahkan class Flexbox di tag body agar footer selalu di bawah -->
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}">
            @if(!empty($settings['school_logo']))
                <img src="{{ asset('storage/' . $settings['school_logo']) }}" alt="Logo" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover;">
            @endif
            {{ $settings['school_name'] ?? 'Profil Sekolah' }}
        </a>
        
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
            </ul>

            <!-- Tombol Navigasi Auth -->
            <div class="d-flex gap-2">
                @if(Auth::check())
                    @if(session('is_admin'))
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm">Dashboard Admin</a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-light btn-sm">Dashboard User</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
                @endif
            </div>
        </div>
    </div>
</nav>

    <!-- Pembungkus konten utama diberikan class flex-grow-1 -->
    <main class="flex-grow-1 py-4" style="animation: fadeIn 0.5s ease forwards;">
        @yield('content')
    </main>

    <!-- Class mt-auto akan mendorong footer ke posisi paling bawah layar -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="m-0">&copy; {{ date('Y') }} {{ $settings['school_name'] ?? 'Sekolah Kita' }}. All rights reserved.</p>
    </footer>

</body>
</html>