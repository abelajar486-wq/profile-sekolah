@extends('layouts.public')

@section('content')
<div class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Hubungi Kami</h1>
            <p class="text-muted mx-auto" style="max-width: 500px;">Silakan hubungi kami untuk informasi lebih lanjut mengenai pendaftaran, program studi, atau fasilitas sekolah.</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.8.36 1.6.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c1.21.34 2.01.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <h5 class="fw-bold mb-1">Nomor Kontak</h5>
                        <p class="text-muted mb-0">{{ $settings['contact_number'] ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <h5 class="fw-bold mb-1">Alamat</h5>
                        <p class="text-muted mb-0">{{ $settings['address'] ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <h5 class="fw-bold mb-1">Email</h5>
                        <p class="text-muted mb-0">{{ $settings['school_email'] ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="ratio ratio-16x9 rounded-top overflow-hidden">
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
                        <h5 class="fw-bold mb-1">Lokasi Sekolah</h5>
                        <p class="text-muted small mb-0">{{ $settings['address'] ?? 'Alamat sekolah belum diatur.' }}</p>
                    </div>
                    @if(!empty($settings['facebook_url']) || !empty($settings['instagram_url']) || !empty($settings['linkedin_url']))
                        <div class="d-flex gap-2">
                            @if(!empty($settings['facebook_url']))
                                <a href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary btn-sm"><i class="bi bi-facebook me-1"></i> Facebook</a>
                            @endif
                            @if(!empty($settings['instagram_url']))
                                <a href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm"><i class="bi bi-instagram me-1"></i> Instagram</a>
                            @endif
                            @if(!empty($settings['linkedin_url']))
                                <a href="{{ $settings['linkedin_url'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-secondary btn-sm"><i class="bi bi-linkedin me-1"></i> LinkedIn</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
