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

            <!-- Preview & Input Gambar -->
            <div class="mb-3">
                <label class="form-label d-block">Gambar Saat Ini</label>
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="img-thumbnail" style="max-height: 150px; object-fit: cover;">
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