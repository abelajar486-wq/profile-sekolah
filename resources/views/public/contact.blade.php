@extends('layouts.public')

@section('content')
<div class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold mb-2">Layanan Informasi</span>
            <h1 class="fw-bold display-5">Hubungi Kami</h1>
            <p class="text-muted mx-auto" style="max-width: 550px;">Silakan hubungi tim kami untuk informasi pendaftaran PPDB, program keahlian, atau konsultasi fasilitas sekolah.</p>
        </div>

        <!-- Kartu Kontak Utama -->
        <div class="row g-4 mb-5">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm card-hover h-100 rounded-4">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-3 icon-box-animate" style="width: 60px; height: 60px;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.8.36 1.6.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c1.21.34 2.01.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <h5 class="fw-bold mb-2">Nomor Telepon & WA</h5>
                        <p class="text-muted mb-0 font-monospace fs-6">{{ $settings['contact_number'] ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm card-hover h-100 rounded-4">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-3 icon-box-animate" style="width: 60px; height: 60px;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <h5 class="fw-bold mb-2">Alamat Sekolah</h5>
                        <p class="text-muted mb-0 fs-6">{{ $settings['address'] ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm card-hover h-100 rounded-4">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-3 icon-box-animate" style="width: 60px; height: 60px;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <h5 class="fw-bold mb-2">Email Resmi</h5>
                        <p class="text-muted mb-0 fs-6">{{ $settings['school_email'] ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Media Sosial Resmi -->
        @if(!empty($settings['facebook_url']) || !empty($settings['instagram_url']) || !empty($settings['linkedin_url']))
        <div class="mb-5" data-aos="fade-up">
            <h4 class="fw-bold mb-4 text-center">Kanal Media Sosial Resmi</h4>
            <div class="row g-3 justify-content-center">
                @if(!empty($settings['facebook_url']))
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                    <a href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener noreferrer" class="card border-0 shadow-sm card-hover text-decoration-none h-100 rounded-4 overflow-hidden">
                        <div class="card-body d-flex align-items-center p-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3 flex-shrink-0 icon-box-animate" style="width: 50px; height: 50px;">
                                <i class="bi bi-facebook fs-4"></i>
                            </div>
                            <div class="overflow-hidden">
                                <h6 class="fw-bold mb-0 text-dark">Facebook</h6>
                                <small class="text-muted text-truncate d-block">{{ $settings['facebook_url'] }}</small>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

                @if(!empty($settings['instagram_url']))
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                    <a href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener noreferrer" class="card border-0 shadow-sm card-hover text-decoration-none h-100 rounded-4 overflow-hidden">
                        <div class="card-body d-flex align-items-center p-3">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center me-3 flex-shrink-0 icon-box-animate" style="width: 50px; height: 50px; background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);">
                                <i class="bi bi-instagram fs-4"></i>
                            </div>
                            <div class="overflow-hidden">
                                <h6 class="fw-bold mb-0 text-dark">Instagram</h6>
                                <small class="text-muted text-truncate d-block">{{ $settings['instagram_url'] }}</small>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

                @if(!empty($settings['linkedin_url']))
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                    <a href="{{ $settings['linkedin_url'] }}" target="_blank" rel="noopener noreferrer" class="card border-0 shadow-sm card-hover text-decoration-none h-100 rounded-4 overflow-hidden">
                        <div class="card-body d-flex align-items-center p-3">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center me-3 flex-shrink-0 icon-box-animate" style="width: 50px; height: 50px; background-color: #0a66c2;">
                                <i class="bi bi-linkedin fs-4"></i>
                            </div>
                            <div class="overflow-hidden">
                                <h6 class="fw-bold mb-0 text-dark">LinkedIn</h6>
                                <small class="text-muted text-truncate d-block">{{ $settings['linkedin_url'] }}</small>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Embed Maps Card -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
            <div class="card-body p-0">
                <div class="ratio ratio-21x9">
                    @if(!empty($settings['maps_embed']))
                        @if(str_contains($settings['maps_embed'], '<iframe'))
                            {!! $settings['maps_embed'] !!}
                        @else
                            <iframe src="{{ $settings['maps_embed'] }}" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        @endif
                    @else
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126828.43371582487!2d106.71271834999999!3d-6.2293868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sMonas%2C%20Jakarta!5e0!3m2!1sid!2sid!4v1709123456789!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @endif
                </div>
                <div class="p-4 bg-light d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h5 class="fw-bold mb-1">Lokasi Peta Digital</h5>
                        <p class="text-muted small mb-0">{{ $settings['address'] ?? 'Alamat sekolah belum diatur.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
