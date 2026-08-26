@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen PPDB</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.ppdb.export.pdf', request()->query()) }}" class="btn btn-danger btn-sm" target="_blank">
            <svg class="me-1" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
            Export PDF
        </a>
        <a href="{{ route('admin.ppdb.export.excel', request()->query()) }}" class="btn btn-success btn-sm">
            <svg class="me-1" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
            Export Excel
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.ppdb.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, NISN, asal sekolah, jurusan..." value="{{ request('search') }}">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.ppdb.index') }}" class="btn btn-outline-danger">Reset</a>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;" class="text-center">No</th>
                        <th>Nama Lengkap</th>
                        <th>NISN</th>
                        <th>Asal Sekolah</th>
                        <th>Jurusan</th>
                        <th>Status</th>
                        <th>Tanggal Daftar</th>
                        <th style="width: 120px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($registrations as $index => $item)
                    <tr>
                        <td class="text-center">{{ $registrations->firstItem() + $index }}</td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>{{ $item->nisn }}</td>
                        <td>{{ $item->asal_sekolah }}</td>
                        <td>{{ $item->jurusan_pilihan }}</td>
                        <td>
                            @if($item->status_pendaftaran == 'diterima')
                                <span class="badge bg-success">Diterima</span>
                            @elseif($item->status_pendaftaran == 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>
                        <td>{{ $item->tanggal_daftar ? $item->tanggal_daftar->format('d-m-Y H:i') : '-' }}</td>
                        <td class="text-center">
    @if($item->status_pendaftaran == 'pending')
        <form action="{{ route('admin.ppdb.update', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Terima pendaftaran ini?')">
            @csrf
            @method('PUT')
            <input type="hidden" name="status_pendaftaran" value="diterima">
            <input type="hidden" name="catatan_admin" value="">
            <button type="submit" class="btn btn-sm btn-success me-1">Terima</button>
        </form>
        <form action="{{ route('admin.ppdb.update', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tolak pendaftaran ini?')">
            @csrf
            @method('PUT')
            <input type="hidden" name="status_pendaftaran" value="ditolak">
            <input type="hidden" name="catatan_admin" value="">
            <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
        </form>
    @else
        <a href="{{ route('admin.ppdb.show', $item->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
    @endif
</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Belum ada pendaftaran PPDB.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $registrations->links() }}
        </div>
    </div>
</div>
@endsection
