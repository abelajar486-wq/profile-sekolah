@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen PPDB</h2>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.ppdb.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <button class="btn btn-outline-secondary" type="submit">Filter</button>
                @if(request('status'))
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
                            <a href="{{ route('admin.ppdb.show', $item->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
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
