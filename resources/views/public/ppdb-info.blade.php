@extends('layouts.public')

@section('content')
<div class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Pendaftaran Peserta Didik Baru (PPDB)</h1>
            <p class="text-muted mx-auto" style="max-width: 600px;">Selamat datang di halaman pendaftaran siswa baru. Ikuti langkah-langkah di bawah ini untuk melakukan pendaftaran.</p>
            @auth
                <a href="{{ route('ppdb.create') }}" class="btn btn-primary btn-lg mt-3">Daftar Sekarang</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-3">Login untuk Daftar</a>
            @endauth
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                        </div>
                        <h5 class="fw-bold mb-1">1. Persiapan</h5>
                        <p class="text-muted small mb-0">Siapkan dokumen: NISN, ijazah, kartu keluarga, dan foto terbaru.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </div>
                        <h5 class="fw-bold mb-1">2. Isi Formulir</h5>
                        <p class="text-muted small mb-0">Login dan isi formulir pendaftaran online dengan data yang benar.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <h5 class="fw-bold mb-1">3. Cek Status</h5>
                        <p class="text-muted small mb-0">Pantau status pendaftaran di dashboard user. Admin akan memverifikasi data Anda.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-5">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-3">Syarat Pendaftaran</h4>
                <ul class="text-muted ps-3">
                    <li>NISN aktif dan terverifikasi</li>
                    <li>Ijazah SMP/sederajat</li>
                    <li>Kartu Keluarga</li>
                    <li>Pas foto terbaru (3x4)</li>
                    <li>Mengisi formulir pendaftaran secara online</li>
                </ul>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-5">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-3">Jurusan yang Tersedia</h4>
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded text-center">
                            <div class="fw-bold text-primary">TKJ</div>
                            <small class="text-muted">Teknik Komputer dan Jaringan</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded text-center">
                            <div class="fw-bold text-primary">RPL</div>
                            <small class="text-muted">Rekayasa Perangkat Lunak</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded text-center">
                            <div class="fw-bold text-primary">AKL</div>
                            <small class="text-muted">Akuntansi dan Keuangan Lembaga</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded text-center">
                            <div class="fw-bold text-primary">OTKP</div>
                            <small class="text-muted">Otomatisasi dan Tata Kelola Perkantoran</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            @auth
                <a href="{{ route('ppdb.create') }}" class="btn btn-primary btn-lg">Daftar Sekarang</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login untuk Daftar</a>
            @endauth
        </div>
    </div>
</div>
@endsection
