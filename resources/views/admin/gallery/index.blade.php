@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen Galeri</h2>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">+ Tambah Foto</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
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
                        @if(!empty($item->image))
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="img-thumbnail" style="max-height: 70px; object-fit: cover;">
                        @else
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        @endif
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

        <div class="d-flex justify-content-end">
            {{ $galleries->links() }}
        </div>
    </div>
</div>
@endsection