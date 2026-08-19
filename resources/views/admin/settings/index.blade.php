@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h2>Setting Profil Sekolah</h2>
    <p class="text-muted">Kelola pengaturan sekolah dan galeri foto.</p>
</div>

<!-- School Settings Form -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-white fw-bold">Profil Sekolah</div>
    <div class="card-body">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">Logo Sekolah</label>
                @if(!empty($settings['school_logo']))
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $settings['school_logo']) }}" alt="Logo Sekolah" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover;">
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

            <div class="mb-3">
                <label class="form-label fw-bold">Lokasi Sekolah</label>
                <textarea name="address" class="form-control" rows="3" required>{{ $settings['address'] ?? '' }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
        </form>
    </div>
</div>

<!-- Gallery Management -->
<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
        <span>Manajemen Galeri</span>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-sm btn-primary">+ Tambah Foto</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;" class="text-center">No</th>
                        <th style="width: 120px;" class="text-center">Gambar</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th style="width: 160px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($galleries as $index => $item)
                    <tr>
                        <td class="text-center">{{ $galleries->firstItem() + $index }}</td>
                        <td class="text-center">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="img-thumbnail" style="max-height: 70px; object-fit: cover;">
                        </td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->description ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.gallery.edit', $item->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                            <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada foto yang ditambahkan ke galeri.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $galleries->links() }}
        </div>
    </div>
</div>
@endsection