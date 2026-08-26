@extends('layouts.public')

@section('content')
<div class="py-5 bg-white position-relative overflow-hidden">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 text-center" data-aos="fade-right" data-aos-duration="1000">
                <div class="position-relative d-inline-block">
                    @if(!empty($settings['school_logo']))
                        <div class="p-3 bg-white rounded-circle shadow-lg animate-float">
                            <img src="{{ asset('storage/' . $settings['school_logo']) }}" alt="Logo Sekolah" class="rounded-circle" style="width: 240px; height: 240px; object-fit: cover;">
                        </div>
                    @else
                        <div class="rounded-circle shadow-lg bg-light d-inline-flex align-items-center justify-content-center animate-float" style="width: 240px; height: 240px;">
                            <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 2 6 3 6 3s6-1 6-3v-5"/></svg>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold mb-3 d-inline-flex align-items-center gap-2">
                    <i class="bi bi-building"></i> Profil Lengkap
                </span>
                <h1 class="fw-bold display-5 mb-3">Tentang {{ $settings['school_name'] ?? 'Sekolah Kami' }}</h1>
                <p class="text-secondary lead mb-3">Sekolah kami berkomitmen menyediakan pendidikan bermutu tinggi dengan fasilitas modern dan pengajar profesional.</p>
                <p class="text-muted mb-4 fs-6">Kami percaya bahwa setiap siswa memiliki potensi unik yang perlu dikembangkan secara maksimal. Dengan kurikulum terpadu, pembinaan akhlak mulia, dan metode pembelajaran inovatif berbasis teknologi, kami mempersiapkan generasi penerus bangsa yang unggul, berkarakter, dan siap menghadapi tantangan masa depan.</p>
                
                <div class="row g-3 mb-2">
                    <div class="col-sm-4" data-aos="zoom-in" data-aos-delay="300">
                        <div class="p-4 bg-light rounded-4 border-0 card-hover text-center h-100">
                            <div class="fw-extrabold fs-2 text-primary mb-1">500+</div>
                            <span class="text-muted small fw-semibold">Siswa Aktif</span>
                        </div>
                    </div>
                    <div class="col-sm-4" data-aos="zoom-in" data-aos-delay="400">
                        <div class="p-4 bg-light rounded-4 border-0 card-hover text-center h-100">
                            <div class="fw-extrabold fs-2 text-success mb-1">50+</div>
                            <span class="text-muted small fw-semibold">Tenaga Pengajar</span>
                        </div>
                    </div>
                    <div class="col-sm-4" data-aos="zoom-in" data-aos-delay="500">
                        <div class="p-4 bg-light rounded-4 border-0 card-hover text-center h-100">
                            <div class="fw-extrabold fs-2 text-warning mb-1">15+</div>
                            <span class="text-muted small fw-semibold">Program Keahlian</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold mb-2">Arah Pedoman</span>
            <h2 class="fw-bold display-6">Visi dan Misi Sekolah</h2>
            <p class="text-muted mx-auto" style="max-width: 500px;">Landasan utama kami dalam mencetak lulusan yang berdaya saing tinggi.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6" data-aos="fade-right" data-aos-delay="100">
                <div class="card border-0 shadow-sm card-hover h-100 rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center icon-box-animate" style="width: 55px; height: 55px;">
                                <i class="bi bi-eye-fill fs-4"></i>
                            </div>
                            <h4 class="fw-bold mb-0">Visi Sekolah</h4>
                        </div>
                        <p class="text-secondary fs-5 mb-0 lh-base">"Menjadi sekolah unggulan yang mampu mencetak generasi berkarakter, berprestasi nasional maupun internasional, dan siap bersaing di era global berbasis teknologi."</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
                <div class="card border-0 shadow-sm card-hover h-100 rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center icon-box-animate" style="width: 55px; height: 55px;">
                                <i class="bi bi-bullseye fs-4"></i>
                            </div>
                            <h4 class="fw-bold mb-0">Misi Sekolah</h4>
                        </div>
                        <ul class="text-secondary mb-0 ps-3 fs-6 d-flex flex-column gap-3">
                            <li class="d-flex align-items-start gap-2">
                                <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                <span>Menyelenggarakan pendidikan yang berkualitas tinggi berbasis teknologi informasi dan praktikum.</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                <span>Mengembangkan potensi bakat dan minat siswa di bidang akademik maupun non-akademik.</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                <span>Membentuk karakter siswa yang berakhlak mulia, disiplin, bertanggung jawab, dan berjiwa wirausaha.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
