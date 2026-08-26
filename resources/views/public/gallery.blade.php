@extends('layouts.public')

@section('content')
<div class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Galeri Kegiatan</h1>
            <p class="text-muted mx-auto" style="max-width: 500px;">Dokumentasi berbagai kegiatan dan prestasi yang telah diraih oleh siswa dan guru.</p>
        </div>
        <div class="row g-4">
            @forelse($galleries as $item)
                <div class="col-md-4 col-sm-6">
                    <div class="card border-0 shadow-sm h-100">
                        @if(!empty($item->image))
                            <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 220px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 220px;">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-2">{{ $item->title }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($item->description, 100) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada foto galeri.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-4">
            {{ $galleries->links() }}
        </div>
    </div>
</div>
@endsection
