@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h2>Dashboard Admin</h2>
    <p class="text-muted">Selamat datang di panel admin. Berikut ringkasan data aplikasi.</p>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white shadow-sm stat-card">
            <div class="card-body">
                <h6 class="card-title">Total User</h6>
                <h3 class="mb-0">{{ $totalUsers }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white shadow-sm stat-card">
            <div class="card-body">
                <h6 class="card-title">Admin</h6>
                <h3 class="mb-0">{{ $totalAdmins }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white shadow-sm stat-card">
            <div class="card-body">
                <h6 class="card-title">User / Siswa</h6>
                <h3 class="mb-0">{{ $totalRegularUsers }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark shadow-sm stat-card">
            <div class="card-body">
                <h6 class="card-title">Email Belum Verifikasi</h6>
                <h3 class="mb-0">{{ $totalUnverified }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row 1 -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm chart-container">
            <div class="card-header bg-white fw-bold">Distribusi Role</div>
            <div class="card-body">
                <canvas id="roleChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm chart-container">
            <div class="card-header bg-white fw-bold">Status Verifikasi Email</div>
            <div class="card-body">
                <canvas id="emailChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm chart-container">
            <div class="card-header bg-white fw-bold">Total Galeri</div>
            <div class="card-body d-flex align-items-center justify-content-center" style="min-height: 250px;">
                <div class="text-center">
                    <h1 class="display-4 fw-bold text-primary">{{ $totalGallery }}</h1>
                    <p class="text-muted mb-0">Foto Galeri</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Registration Trend Chart -->
<div class="row g-3">
    <div class="col-md-12">
        <div class="card shadow-sm chart-container">
            <div class="card-header bg-white fw-bold">Tren Registrasi 6 Bulan Terakhir</div>
            <div class="card-body">
                <canvas id="registrationChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Role Distribution Pie Chart
        const roleCtx = document.getElementById('roleChart').getContext('2d');
        new Chart(roleCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($roleLabels) !!},
                datasets: [{
                    data: {!! json_encode($roleData) !!},
                    backgroundColor: ['#dc3545', '#0d6efd'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Email Verification Doughnut Chart
        const emailCtx = document.getElementById('emailChart').getContext('2d');
        new Chart(emailCtx, {
            type: 'doughnut',
            data: {
                labels: ['Terverifikasi', 'Belum Verifikasi'],
                datasets: [{
                    data: [{{ $verifiedCount }}, {{ $unverifiedCount }}],
                    backgroundColor: ['#198754', '#ffc107'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Registration Trend Bar Chart
        const regCtx = document.getElementById('registrationChart').getContext('2d');
        new Chart(regCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [{
                    label: 'Jumlah Registrasi',
                    data: {!! json_encode($monthlyData) !!},
                    backgroundColor: 'rgba(13, 110, 253, 0.7)',
                    borderColor: 'rgba(13, 110, 253, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endsection
