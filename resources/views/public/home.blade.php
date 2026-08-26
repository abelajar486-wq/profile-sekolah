@extends('layouts.public')

@section('content')
<div class="min-vh-100 bg-white d-flex align-items-center">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold mb-3">{{ $settings['school_name'] ?? 'Sekolah Kami' }}</h1>
                <p class="lead text-muted mb-4">Mencetak Generasi Unggul, Berkarakter, dan Siap Kerja.</p>
                <p class="text-muted mb-4">Sebuah lembaga pendidikan yang berkomitmen memberikan pendidikan berkualitas dengan fasilitas memadai dan tenaga pengajar yang profesional.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('about') }}" class="btn btn-primary">Tentang Kami</a>
                    <a href="{{ route('gallery') }}" class="btn btn-outline-secondary">Galeri</a>
                    <a href="{{ route('ppdb.info') }}" class="btn btn-success">PPDB</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                @if(!empty($settings['school_logo']))
                    <img src="{{ asset('storage/' . $settings['school_logo']) }}" alt="Logo Sekolah" class="rounded-circle shadow" style="width: 200px; height: 200px; object-fit: cover;">
                @else
                    <div class="rounded-circle shadow bg-light d-inline-flex align-items-center justify-content-center" style="width: 200px; height: 200px;">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 2 6 3 6 3s6-1 6-3v-5"/></svg>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="min-vh-100 bg-light d-flex align-items-center">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Fasilitas Sekolah</h2>
            <p class="text-muted mx-auto" style="max-width: 500px;">Fasilitas yang tersedia untuk mendukung proses belajar mengajar.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <h5 class="fw-bold mb-1">Ruang Kelas</h5>
                        <p class="text-muted small mb-0">Ruang kelas yang nyaman dan bersih untuk proses belajar mengajar.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3h6v6H9zM9 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4M9 3v6h6V3"/></svg>
                        </div>
                        <h5 class="fw-bold mb-1">Laboratorium</h5>
                        <p class="text-muted small mb-0">Laboratorium komputer dan sains yang dilengkapi perangkat modern.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        </div>
                        <h5 class="fw-bold mb-1">Perpustakaan</h5>
                        <p class="text-muted small mb-0">Perpustakaan dengan koleksi buku yang lengkap dan nyaman untuk membaca.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="min-vh-100 bg-white d-flex align-items-center">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Galeri Kegiatan</h2>
            <p class="text-muted mx-auto" style="max-width: 500px;">Dokumentasi kegiatan sekolah.</p>
        </div>
        <div class="row g-4">
            @forelse($galleries as $item)
                <div class="col-md-4 col-sm-6">
                    <div class="card border-0 shadow-sm h-100">
                        @if(!empty($item->image))
                            <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-2">{{ $item->title }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($item->description, 80) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada foto galeri.</p>
                </div>
            @endforelse
        </div>
        @if($galleries->count() > 0)
            <div class="text-center mt-5">
                <a href="{{ route('gallery') }}" class="btn btn-outline-primary">Lihat Semua Galeri</a>
            </div>
        @endif
    </div>
</div>
@endsection
