@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<div class="min-vh-100 bg-white d-flex align-items-center position-relative overflow-hidden py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold mb-3 d-inline-flex align-items-center gap-2" data-aos="fade-down" data-aos-delay="100">
                    <i class="bi bi-stars"></i> Selamat Datang di Website Resmi
                </span>
                <h1 class="display-4 fw-bold mb-3 text-dark lh-sm">{{ $settings['school_name'] ?? 'Sekolah Kami' }}</h1>
                <p class="lead text-secondary mb-4 fs-5">Mencetak Generasi Unggul, Berkarakter, dan Siap Kerja di Era Digital.</p>
                <p class="text-muted mb-4 fs-6">Sebuah lembaga pendidikan unggulan yang berkomitmen memberikan pendidikan berkualitas tinggi dengan sarana prasarana modern serta tenaga pengajar profesional dan berpengalaman.</p>
                <div class="d-flex flex-wrap gap-3" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('about') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">
                        <i class="bi bi-info-circle me-1"></i> Tentang Kami
                    </a>
                    <a href="{{ route('gallery') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold">
                        <i class="bi bi-images me-1"></i> Galeri
                    </a>
                    <a href="{{ route('ppdb.info') }}" class="btn btn-success rounded-pill px-4 py-2 fw-semibold animate-pulse-glow">
                        <i class="bi bi-person-plus me-1"></i> Info PPDB
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="position-relative d-inline-block">
                    @if(!empty($settings['school_logo']))
                        <div class="p-3 bg-white rounded-circle shadow-lg animate-float">
                            <img src="{{ asset('storage/' . $settings['school_logo']) }}" alt="Logo Sekolah" class="rounded-circle" style="width: 240px; height: 240px; object-fit: cover;">
                        </div>
                    @else
                        <div class="rounded-circle shadow-lg bg-gradient bg-light d-inline-flex align-items-center justify-content-center animate-float" style="width: 240px; height: 240px;">
                            <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#0d6efd" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 2 6 3 6 3s6-1 6-3v-5"/></svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Fasilitas Sekolah Section -->
<div class="min-vh-100 bg-light d-flex align-items-center py-5">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold mb-2">Fasilitas Unggulan</span>
            <h2 class="fw-bold display-6">Fasilitas Sekolah Kami</h2>
            <p class="text-muted mx-auto" style="max-width: 550px;">Fasilitas modern yang lengkap dan terawat untuk menunjang seluruh proses kegiatan belajar mengajar.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm card-hover h-100 rounded-4 overflow-hidden">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-4 icon-box-animate" style="width: 65px; height: 65px;">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <h5 class="fw-bold mb-2">Ruang Kelas AC & Proyektor</h5>
                        <p class="text-muted small mb-0">Ruang kelas ber-AC yang nyaman, dilengkapi proyektor digital dan pencahayaan optimal untuk pembelajaran interaktif.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm card-hover h-100 rounded-4 overflow-hidden">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-success bg-opacity-10 text-success d-inline-flex align-items-center justify-content-center mb-4 icon-box-animate" style="width: 65px; height: 65px;">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3h6v6H9zM9 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4M9 3v6h6V3"/></svg>
                        </div>
                        <h5 class="fw-bold mb-2">Laboratorium Komputer & Sains</h5>
                        <p class="text-muted small mb-0">Laboratorium multimedia dengan perangkat spesifikasi tinggi dan akses internet super cepat untuk praktik langsung.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm card-hover h-100 rounded-4 overflow-hidden">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-inline-flex align-items-center justify-content-center mb-4 icon-box-animate" style="width: 65px; height: 65px;">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        </div>
                        <h5 class="fw-bold mb-2">Perpustakaan Digital</h5>
                        <p class="text-muted small mb-0">Perpustakaan modern dengan ribuan pustaka cetak dan E-Book interaktif untuk memperluas wawasan siswa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Galeri Kegiatan Section -->
<div class="min-vh-100 bg-white d-flex align-items-center py-5">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold mb-2">Dokumentasi</span>
            <h2 class="fw-bold display-6">Galeri Kegiatan Sekolah</h2>
            <p class="text-muted mx-auto" style="max-width: 500px;">Momen inspiratif dan ragam kegiatan positif siswa di sekolah.</p>
        </div>
        <div class="row g-4">
            @forelse($galleries as $index => $item)
                <div class="col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="{{ ($index % 3 + 1) * 100 }}">
                    <div class="card border-0 shadow-sm card-hover h-100 rounded-4 overflow-hidden">
                        <div class="img-zoom-container position-relative">
                            @if(!empty($item->image))
                                <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 220px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 220px;">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                </div>
                            @endif
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-2">{{ $item->title }}</h5>
                            <p class="card-text text-muted small mb-0">{{ Str::limit($item->description, 85) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5" data-aos="fade-up">
                    <p class="text-muted">Belum ada foto galeri.</p>
                </div>
            @endforelse
        </div>
        @if($galleries->count() > 0)
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('gallery') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold">
                    <i class="bi bi-arrow-right-circle me-1"></i> Lihat Semua Galeri
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
