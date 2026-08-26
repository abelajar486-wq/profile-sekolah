<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - {{ $settings['school_name'] ?? 'Website Profil Sekolah' }}</title>
    @if(!empty($settings['school_logo']))
        <link rel="icon" href="{{ asset('storage/' . $settings['school_logo']) }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('storage/' . $settings['school_logo']) }}" type="image/x-icon">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
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

        /* Sidebar Link Animation */
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

        /* Card Entrance */
        .card {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }

        .stat-card {
            animation-delay: 0.05s;
        }
        .stat-card:nth-of-type(2) { animation-delay: 0.1s; }
        .stat-card:nth-of-type(3) { animation-delay: 0.15s; }
        .stat-card:nth-of-type(4) { animation-delay: 0.2s; }

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

        /* Table Row Hover */
        .table tbody tr {
            transition: all 0.25s ease;
        }

        .table tbody tr:hover {
            background: rgba(13, 110, 253, 0.05);
            transform: scale(1.005);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        }

        /* Button Animations */
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

        /* Alert Slide In */
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

        /* Input Focus Animation */
        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.25rem var(--accent-glow);
            transform: translateY(-1px);
        }

        /* Chart Container */
        .chart-container {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Stat Card Hover */
        .stat-card {
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body class="bg-light">
    <div class="d-flex" style="min-height: 100vh;">
        
        <!-- SIDEBAR (Cukup 1 div ini saja) -->
        <div class="bg-dark text-white p-3 d-flex flex-column justify-content-between position-sticky top-0 vh-100" style="width: 250px; flex-shrink: 0; animation: slideInLeft 0.4s ease forwards;">
            <div>
                <h4 class="text-center">Admin Panel</h4>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <svg class="me-2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20v-6M6 20V10M18 20V4"/></svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.gallery.index') }}" class="nav-link text-white {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                            <svg class="me-2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            Gallery
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link text-white {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <svg class="me-2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.ppdb.index') }}" class="nav-link text-white {{ request()->routeIs('admin.ppdb.*') ? 'active' : '' }}">
                            <svg class="me-2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 2 6 3 6 3s6-1 6-3v-5"/></svg>
                            PPDB
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.settings.index') }}" class="nav-link text-white {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                            <svg class="me-2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                            Setting Sekolah
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Tombol Logout & Kembali ke Public -->
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
            
            @yield('content')
        </div>

    </div>
</body>

</html>