<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 250px;
            --accent: #0d6efd;
            --accent-glow: rgba(13, 110, 253, 0.35);
        }

        html {
            scroll-behavior: smooth;
        }

        .nav-pills .nav-link,
        .btn,
        .form-control,
        .form-select,
        .card,
        .alert,
        .table tbody tr {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-pills .nav-link {
            position: relative;
            border-radius: 0.5rem;
            padding: 0.6rem 1rem;
            margin-bottom: 0.25rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-pills .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%) scaleY(0);
            width: 4px;
            height: 70%;
            background: var(--accent);
            border-radius: 0 4px 4px 0;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 0 10px var(--accent-glow);
        }

        .nav-pills .nav-link:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(4px);
            color: #fff !important;
        }

        .nav-pills .nav-link:hover::before {
            transform: translateY(-50%) scaleY(1);
        }

        .nav-pills .nav-link.active {
            background: rgba(13, 110, 253, 0.2);
            color: #fff !important;
            box-shadow: inset 0 0 20px rgba(13, 110, 253, 0.1);
        }

        .nav-pills .nav-link.active::before {
            transform: translateY(-50%) scaleY(1);
        }

        .card {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table tbody tr {
            transition: all 0.25s ease;
        }

        .table tbody tr:hover {
            background: rgba(13, 110, 253, 0.05);
            transform: scale(1.005);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        }

        .btn {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .btn:active {
            transform: translateY(0);
        }

        .alert {
            animation: slideInDown 0.4s ease forwards;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.25rem var(--accent-glow);
            transform: translateY(-1px);
        }

        .stat-card {
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>

<body class="bg-light">
    <div class="d-flex" style="min-height: 100vh;">
        
        <!-- SIDEBAR USER -->
        <div class="bg-dark text-white p-3 d-flex flex-column justify-content-between position-sticky top-0 vh-100" style="width: 250px; flex-shrink: 0; animation: slideInLeft 0.4s ease forwards;">
            <div>
                <h4 class="text-center">Dashboard User</h4>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('user.dashboard') }}" class="nav-link text-white {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                            <svg class="me-2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20v-6M6 20V10M18 20V4"/></svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer" class="nav-link text-white {{ request()->routeIs('home') ? 'active' : '' }}">
                            <svg class="me-2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.ppdb.status') }}" class="nav-link text-white {{ request()->routeIs('user.ppdb*') ? 'active' : '' }}">
                            <svg class="me-2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 2 6 3 6 3s6-1 6-3v-5"/></svg>
                            PPDB
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.profile') }}" class="nav-link text-white {{ request()->routeIs('user.profile*') ? 'active' : '' }}">
                            <svg class="me-2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Edit Profil
                        </a>
                    </li>
                </ul>
            </div>

            <div class="pt-3 border-top">
                <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-light w-100 mb-2">Lihat Web Public</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Logout</button>
                </form>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-grow-1 p-4" style="animation: fadeIn 0.4s ease forwards;">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            @yield('content')
        </div>

    </div>
</body>

</html>
