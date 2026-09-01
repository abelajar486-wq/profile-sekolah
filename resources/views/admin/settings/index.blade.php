@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold mb-1">Setting Profil Sekolah</h2>
    <p class="text-muted mb-0">Kelola profil, logo, lokasi, email, dan akun media sosial resmi sekolah.</p>
</div>

<!-- School Settings Form -->
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Card 1: Informasi Umum & Logo -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white fw-bold py-3 border-bottom">Profil & Logo Sekolah</div>
        <div class="card-body p-4">
            <div class="mb-4">
                <label class="form-label fw-bold">Logo Sekolah</label>
                @if(!empty($settings['school_logo']))
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $settings['school_logo']) }}" alt="Logo Sekolah" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover;" class="border shadow-sm">
                    </div>
                @else
                    <div class="mb-2">
                        <div class="bg-light d-flex align-items-center justify-content-center rounded-circle border" style="width: 120px; height: 120px;">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 2 6 3 6 3s6-1 6-3v-5"/></svg>
                        </div>
                    </div>
                @endif
                <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                @error('logo')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <div class="form-text mt-1">Maksimal ukuran file logo: <strong>5 MB (5120 KB)</strong>. Format: JPG, JPEG, PNG, WEBP, GIF, SVG. @if(!empty($settings['school_logo'])) Kosongkan jika tidak ingin mengganti logo. @endif</div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nama Sekolah <span class="text-danger">*</span></label>
                    <input type="text" name="school_name" class="form-control @error('school_name') is-invalid @enderror" value="{{ old('school_name', $settings['school_name'] ?? '') }}" required>
                    @error('school_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Email Sekolah</label>
                    <input type="email" name="school_email" class="form-control @error('school_email') is-invalid @enderror" placeholder="info@sekolah.sch.id" value="{{ old('school_email', $settings['school_email'] ?? '') }}">
                    @error('school_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nomor Kontak / WhatsApp <span class="text-danger">*</span></label>
                    <input type="text" name="contact_number" class="form-control @error('contact_number') is-invalid @enderror" value="{{ old('contact_number', $settings['contact_number'] ?? '') }}" required>
                    @error('contact_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Lokasi Sekolah -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white fw-bold py-3 border-bottom">Lokasi Sekolah</div>
        <div class="card-body p-4">
            <div class="mb-3">
                <label class="form-label fw-bold">Alamat Lengkap <span class="text-danger">*</span></label>
                <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{ old('address', $settings['address'] ?? '') }}</textarea>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Embed Google Maps (Src Iframe / Link Google Maps)</label>
                <textarea name="maps_embed" class="form-control @error('maps_embed') is-invalid @enderror" rows="3" placeholder="https://www.google.com/maps/embed?... atau kode <iframe>">{{ old('maps_embed', $settings['maps_embed'] ?? '') }}</textarea>
                @error('maps_embed')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Masukkan URL Google Maps Embed (dari Google Maps: Bagikan -&gt; Sematkan Peta -&gt; salin link `src="..."`).</div>
            </div>
        </div>
    </div>

    <!-- Card 3: Media Sosial -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white fw-bold py-3 border-bottom">Media Sosial Sekolah</div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Facebook URL</label>
                    <input type="text" name="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror" placeholder="https://facebook.com/sekolah" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}">
                    @error('facebook_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Instagram URL</label>
                    <input type="text" name="instagram_url" class="form-control @error('instagram_url') is-invalid @enderror" placeholder="https://instagram.com/sekolah" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}">
                    @error('instagram_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">LinkedIn URL</label>
                    <input type="text" name="linkedin_url" class="form-control @error('linkedin_url') is-invalid @enderror" placeholder="https://linkedin.com/company/sekolah" value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}">
                    @error('linkedin_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary px-4 shadow-sm mb-5">
        Simpan Pengaturan
    </button>
</form>
@endsection