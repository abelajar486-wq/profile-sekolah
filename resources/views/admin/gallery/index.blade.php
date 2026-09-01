@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Manajemen Galeri</h2>
        <p class="text-muted mb-0">Kelola foto kegiatan, fasilitas, dan dokumentasi resmi sekolah.</p>
    </div>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary px-3 shadow-sm d-flex align-items-center gap-2">
        <i class="bi bi-plus-lg"></i> Tambah Foto
    </a>
</div>

<div class="row g-4">
    @forelse ($galleries as $index => $item)
    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index % 3 + 1) * 80 }}">
        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden admin-gallery-card">
            <div class="img-zoom-container position-relative">
                @if(!empty($item->image))
                    <img src="{{ url('optimized-image/' . $item->image) }}" alt="{{ $item->title }}" class="card-img-top" style="height: 200px; object-fit: cover;" loading="lazy" onload="this.classList.add('loaded');" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="bg-light d-none align-items-center justify-content-center" style="height: 200px; display: none;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    </div>
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    </div>
                @endif
            </div>
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="card-title fw-bold text-dark mb-0 flex-grow-1 me-2">{{ $item->title }}</h5>
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-1" style="font-size: 0.7rem;">
                        <i class="bi bi-calendar3 me-1"></i>{{ ($item->upload_date ?? $item->created_at)->format('d M Y') }}
                    </span>
                </div>
                <p class="card-text text-muted small mb-3">{{ Str::limit($item->description ?? 'Tidak ada deskripsi', 120) }}</p>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.gallery.edit', $item->id) }}" class="btn btn-sm btn-outline-warning px-3 py-2 rounded-pill flex-fill" title="Edit">
                        <i class="bi bi-pencil-square me-1"></i>Edit
                    </a>
                    <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" class="d-inline flex-fill" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger px-3 py-2 rounded-pill w-100" title="Hapus">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center text-muted py-5" data-aos="fade-up">
        <i class="bi bi-inbox fs-1 d-block mb-2 text-muted opacity-50"></i>
        Belum ada foto yang ditambahkan ke galeri.
    </div>
    @endforelse
</div>

@if($galleries->hasPages())
    <div class="mt-5 d-flex justify-content-center" data-aos="fade-up">
        {{ $galleries->links() }}
    </div>
@endif

<style>
    .admin-gallery-card {
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .admin-gallery-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.1) !important;
    }

    .admin-gallery-card img {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }

    .admin-gallery-card img.loaded {
        animation: none;
        background: none;
    }

    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
</style>
@endsection