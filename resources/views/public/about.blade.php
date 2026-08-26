@extends('layouts.public')

@section('content')
<div class="py-5 bg-white">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 text-center">
                @if(!empty($settings['school_logo']))
    <img src="{{ asset('storage/' . $settings['school_logo']) }}" alt="Logo Sekolah" class="rounded-circle shadow" style="width: 220px; height: 220px; object-fit: cover;">
@else
    <div class="rounded-circle shadow bg-light d-inline-flex align-items-center justify-content-center" style="width: 220px; height: 220px;">
        <svg width="90" height="90" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 2 6 3 6 3s6-1 6-3v-5"/></svg>
    </div>
@endif
            </div>
            <div class="col-lg-7">
                <h1 class="fw-bold mb-3">Tentang {{ $settings['school_name'] ?? 'Sekolah Kami' }}</h1>
                <p class="text-muted mb-3">Sekolah kami berkomitmen menyediakan pendidikan bermutu tinggi dengan fasilitas modern dan pengajar profesional.</p>
                <p class="text-muted mb-4">Kami percaya bahwa setiap siswa memiliki potensi unik yang perlu dikembangkan. Dengan kurikulum terpadu dan metode pembelajaran inovatif, kami mempersiapkan generasi penerus bangsa yang unggul, berkarakter, dan siap menghadapi tantangan global.</p>
                <div class="row g-3 mb-4">
                    <div class="col-sm-4">
                        <div class="p-3 bg-light rounded">
                            <div class="fw-bold fs-4 text-primary">500+</div>
                            <small class="text-muted">Siswa Aktif</small>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 bg-light rounded">
                            <div class="fw-bold fs-4 text-primary">50+</div>
                            <small class="text-muted">Tenaga Pengajar</small>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 bg-light rounded">
                            <div class="fw-bold fs-4 text-primary">15+</div>
                            <small class="text-muted">Program Keahlian</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Visi dan Misi</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Visi</h5>
                        <p class="text-muted mb-0">Menjadi sekolah unggulan yang mampu mencetak generasi berkarakter, berprestasi, dan siap bersaing di era global.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Misi</h5>
                        <ul class="text-muted mb-0 ps-3">
                            <li>Menyelenggarakan pendidikan yang berkualitas dan berbasis teknologi.</li>
                            <li>Mengembangkan potensi siswa di bidang akademik maupun non-akademik.</li>
                            <li>Membentuk karakter siswa yang berakhlak mulia dan bertanggung jawab.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
