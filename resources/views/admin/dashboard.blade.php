@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Dashboard Admin</h2>
        <p class="text-muted mb-0">Selamat datang di panel admin. Berikut ringkasan statistik aplikasi dan galeri sekolah.</p>
    </div>
    <div>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary shadow-sm">
            <svg class="me-1" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Galeri Baru
        </a>
    </div>
</div>

<!-- Stat Cards Row -->
<div class="row g-3 mb-4">
    <!-- Stat Card: Total Galeri -->
    <div class="col-md">
        <div class="card text-white shadow-sm stat-card border-0" style="background: linear-gradient(135deg, #6f42c1 0%, #a100ff 100%);">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 text-uppercase fw-semibold mb-1" style="font-size: 0.75rem;">Total Galeri Foto</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalGallery }}</h2>
                        <small class="text-white-50 mt-1 d-block" style="font-size: 0.75rem;">
                            <span class="badge bg-white text-dark me-1">+{{ $galleryThisMonth }}</span> bulan ini
                        </small>
                    </div>
                    <div class="p-3 bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Card: Total User -->
    <div class="col-md">
        <div class="card bg-primary text-white shadow-sm stat-card border-0">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 text-uppercase fw-semibold mb-1" style="font-size: 0.75rem;">Total User</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalUsers }}</h2>
                        <small class="text-white-50 mt-1 d-block" style="font-size: 0.75rem;">Terdaftar di sistem</small>
                    </div>
                    <div class="p-3 bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Card: Pendaftar PPDB -->
    <div class="col-md">
        <div class="card bg-info text-white shadow-sm stat-card border-0">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 text-uppercase fw-semibold mb-1" style="font-size: 0.75rem;">Pendaftar PPDB</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalPpdb }}</h2>
                        <small class="text-white-50 mt-1 d-block" style="font-size: 0.75rem;">Calon siswa baru</small>
                    </div>
                    <div class="p-3 bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 2 6 3 6 3s6-1 6-3v-5"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Card: Admin -->
    <div class="col-md">
        <div class="card bg-success text-white shadow-sm stat-card border-0">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 text-uppercase fw-semibold mb-1" style="font-size: 0.75rem;">Admin</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalAdmins }}</h2>
                        <small class="text-white-50 mt-1 d-block" style="font-size: 0.75rem;">Pengelola sistem</small>
                    </div>
                    <div class="p-3 bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Card: Belum Verifikasi -->
    <div class="col-md">
        <div class="card bg-warning text-dark shadow-sm stat-card border-0">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-black-50 text-uppercase fw-semibold mb-1" style="font-size: 0.75rem;">Unverified Email</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalUnverified }}</h2>
                        <small class="text-black-50 mt-1 d-block" style="font-size: 0.75rem;">Perlu verifikasi</small>
                    </div>
                    <div class="p-3 bg-dark bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DEDICATED SECTION: STATISTIK & DOKUMENTASI GALERI -->
<div class="card shadow-sm border-0 mb-4 overflow-hidden">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
        <div class="d-flex align-items-center">
            <div class="p-2 bg-purple bg-opacity-10 rounded text-purple me-2" style="color: #6f42c1;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            </div>
            <h5 class="fw-bold mb-0">Statistik & Dokumentasi Galeri Sekolah</h5>
        </div>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-sm btn-outline-primary">
            Lihat Kelola Galeri &rarr;
        </a>
    </div>
    <div class="card-body p-4">
        <div class="row g-4 align-items-center">
            <!-- Counter & Quick Info -->
            <div class="col-lg-4 border-end-lg">
                <div class="bg-light p-4 rounded-3 text-center mb-3">
                    <span class="text-uppercase fw-semibold text-muted d-block mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">Total Dokumentasi Foto</span>
                    <h1 class="display-3 fw-extrabold text-purple mb-1" style="color: #6f42c1;">{{ $totalGallery }}</h1>
                    <p class="text-muted mb-0">Foto kegiatan &amp; fasilitas sekolah</p>
                </div>
                <div class="d-flex justify-content-around text-center p-2 bg-white rounded border">
                    <div>
                        <small class="text-muted d-block">Bulan Ini</small>
                        <span class="fw-bold text-success">+{{ $galleryThisMonth }} Foto</span>
                    </div>
                    <div class="border-start"></div>
                    <div>
                        <small class="text-muted d-block">Status Galeri</small>
                        <span class="fw-bold text-primary">Aktif</span>
                    </div>
                </div>
            </div>

            <!-- Preview Galeri Terbaru -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-secondary">Foto Galeri Terbaru yang Diunggah</h6>
                    <small class="text-muted">Menampilkan {{ $recentGalleries->count() }} foto terakhir</small>
                </div>

                @if($recentGalleries->count() > 0)
                    <div class="row g-3">
                        @foreach($recentGalleries as $gallery)
                            <div class="col-6 col-sm-3">
                                <div class="card h-100 border-0 shadow-sm overflow-hidden position-relative group-hover">
                                    <div style="height: 110px; overflow: hidden; background-color: #f8f9fa;">
                                        <img src="{{ asset('storage/' . $gallery->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $gallery->title }}" onerror="this.src='https://via.placeholder.com/200x150?text=No+Image'">
                                    </div>
                                    <div class="p-2">
                                        <h6 class="card-title text-truncate mb-1 text-dark fw-bold" style="font-size: 0.825rem;" title="{{ $gallery->title }}">{{ $gallery->title }}</h6>
                                        <small class="text-muted d-block" style="font-size: 0.7rem;">
                                            <svg class="me-1" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                            {{ $gallery->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4 bg-light rounded border border-dashed">
                        <svg class="text-muted mb-2" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        <p class="text-muted mb-2">Belum ada foto galeri yang diunggah ke dalam sistem.</p>
                        <a href="{{ route('admin.gallery.create') }}" class="btn btn-sm btn-primary">
                            Upload Foto Pertama Sekarang
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="row g-3 mb-4">
    <!-- Chart: Tren Unggah Galeri & User -->
    <div class="col-lg-7">
        <div class="card shadow-sm border-0 chart-container h-100">
            <div class="card-header bg-white fw-bold py-3 border-bottom d-flex justify-content-between align-items-center">
                <span>📊 Tren Unggah Galeri & Registrasi User (6 Bulan Terakhir)</span>
            </div>
            <div class="card-body">
                <canvas id="activityTrendChart" style="max-height: 280px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart: Role & Verification Breakdown -->
    <div class="col-lg-5">
        <div class="card shadow-sm border-0 chart-container h-100">
            <div class="card-header bg-white fw-bold py-3 border-bottom">
                <span>👥 Distribusi Role & Verifikasi User</span>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6 text-center">
                        <small class="fw-bold d-block text-muted mb-2">Distribusi Role</small>
                        <div style="height: 180px; position: relative;">
                            <canvas id="roleChart"></canvas>
                        </div>
                    </div>
                    <div class="col-6 text-center">
                        <small class="fw-bold d-block text-muted mb-2">Verifikasi Email</small>
                        <div style="height: 180px; position: relative;">
                            <canvas id="emailChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Activity Trend Chart (Gallery Uploads & User Registrations)
        const trendCtx = document.getElementById('activityTrendChart').getContext('2d');
        new Chart(trendCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [
                    {
                        label: 'Foto Galeri Diunggah',
                        data: {!! json_encode($galleryMonthlyData) !!},
                        backgroundColor: 'rgba(111, 66, 193, 0.75)',
                        borderColor: '#6f42c1',
                        borderWidth: 1,
                        borderRadius: 4
                    },
                    {
                        label: 'User Regitsrasi',
                        data: {!! json_encode($monthlyData) !!},
                        backgroundColor: 'rgba(13, 110, 253, 0.65)',
                        borderColor: '#0d6efd',
                        borderWidth: 1,
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });

        // Role Distribution Pie Chart
        const roleCtx = document.getElementById('roleChart').getContext('2d');
        new Chart(roleCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($roleLabels) !!},
                datasets: [{
                    data: {!! json_encode($roleData) !!},
                    backgroundColor: ['#198754', '#0d6efd'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { boxWidth: 12 }
                    }
                }
            }
        });

        // Email Verification Doughnut Chart
        const emailCtx = document.getElementById('emailChart').getContext('2d');
        new Chart(emailCtx, {
            type: 'doughnut',
            data: {
                labels: ['Terverifikasi', 'Belum'],
                datasets: [{
                    data: [{{ $verifiedCount }}, {{ $unverifiedCount }}],
                    backgroundColor: ['#20c997', '#ffc107'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { boxWidth: 12 }
                    }
                }
            }
        });
    });
</script>
@endsection
