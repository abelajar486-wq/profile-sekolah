@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h2>Edit Foto Galeri</h2>
</div>

<div class="card shadow-sm col-md-8">
    <div class="card-body">
        <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Judul Foto -->
            <div class="mb-3">
                <label class="form-label">Judul Foto</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $gallery->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label">Deskripsi (Opsional)</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $gallery->description) }}</textarea>
            </div>

            <!-- Tanggal Upload -->
            <div class="mb-3">
                <label class="form-label">Tanggal Upload</label>
                <input type="date" name="upload_date" class="form-control" value="{{ old('upload_date', ($gallery->upload_date ?? $gallery->created_at)->format('Y-m-d')) }}">
            </div>

            <!-- Preview & Input Gambar -->
            <div class="mb-3">
                <label class="form-label d-block">Gambar Saat Ini</label>
                <div class="mb-2">
                    @if(!empty($gallery->image))
                        <img src="{{ url('optimized-image/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="img-thumbnail" style="max-height: 150px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center rounded" style="width: 150px; height: 150px;">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        </div>
                    @endif
                </div>
                <label class="form-label text-muted">Ganti Gambar (Biarkan kosong jika tidak ingin mengubah gambar)</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection