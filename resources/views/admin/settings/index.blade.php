@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold mb-1">Setting Profil Sekolah</h2>
    <p class="text-muted mb-0">Kelola profil, logo, dan informasi kontak resmi sekolah.</p>
</div>

<!-- School Settings Form -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white fw-bold py-3 border-bottom">Profil Sekolah</div>
    <div class="card-body p-4">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

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
                <input type="file" name="logo" class="form-control" accept="image/*">
                @if(!empty($settings['school_logo']))
                    <div class="form-text">Kosongkan jika tidak ingin mengganti logo.</div>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Sekolah</label>
                <input type="text" name="school_name" class="form-control" value="{{ $settings['school_name'] ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Nomor Contact</label>
                <input type="text" name="contact_number" class="form-control" value="{{ $settings['contact_number'] ?? '' }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Lokasi Sekolah</label>
                <textarea name="address" class="form-control" rows="3" required>{{ $settings['address'] ?? '' }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                Simpan Pengaturan
            </button>
        </form>
    </div>
</div>
@endsection