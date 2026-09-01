@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Manajemen PPDB</h2>
        <p class="text-muted mb-0">Kelola berkas pendaftaran calon siswa baru, verifikasi status, dan ekspor data.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.ppdb.export.pdf', request()->query()) }}" class="btn btn-danger btn-sm px-3 shadow-sm d-flex align-items-center gap-1" target="_blank">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </a>
        <a href="{{ route('admin.ppdb.export.excel', request()->query()) }}" class="btn btn-success btn-sm px-3 shadow-sm d-flex align-items-center gap-1">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body p-4">
        <form action="{{ route('admin.ppdb.index') }}" method="GET" class="mb-4">
            <div class="input-group" style="max-width: 600px;">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, NISN, asal sekolah, jurusan..." value="{{ request('search') }}">
                <select name="status" class="form-select" style="max-width: 160px;">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <button class="btn btn-primary px-3" type="submit"><i class="bi bi-search me-1"></i> Cari</button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.ppdb.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>

        <div class="table-responsive rounded-3 border">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;" class="text-center">No</th>
                        <th style="min-width: 160px;">Nama Lengkap</th>
                        <th style="min-width: 110px;">NISN</th>
                        <th style="min-width: 160px;">Asal Sekolah</th>
                        <th style="min-width: 140px;">Jurusan</th>
                        <th style="width: 120px;" class="text-center">Status</th>
                        <th style="width: 150px;" class="text-center">Tanggal Daftar</th>
                        <th style="width: 150px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($registrations as $index => $item)
                    <tr>
                        <td class="text-center fw-medium text-muted">{{ $registrations->firstItem() + $index }}</td>
                        <td class="fw-bold text-dark">{{ $item->nama_lengkap }}</td>
                        <td class="text-secondary small">{{ $item->nisn }}</td>
                        <td class="text-secondary small">{{ $item->asal_sekolah }}</td>
                        <td class="text-secondary small">{{ $item->jurusan_pilihan }}</td>
                        <td class="text-center">
                            @if($item->status_pendaftaran == 'diterima')
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill">Diterima</span>
                            @elseif($item->status_pendaftaran == 'ditolak')
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-pill">Ditolak</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1 rounded-pill">Pending</span>
                            @endif
                        </td>
                        <td class="text-center text-muted small">{{ $item->tanggal_daftar ? $item->tanggal_daftar->format('d M Y H:i') : '-' }}</td>
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                @if($item->status_pendaftaran == 'pending')
                                    <form action="{{ route('admin.ppdb.update', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Terima pendaftaran {{ $item->nama_lengkap }}? Pesan ucapan selamat akan dikirimkan otomatis.')">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_pendaftaran" value="diterima">
                                        <button type="submit" class="btn btn-sm btn-outline-success px-3 py-1 fw-semibold d-flex flex-column align-items-center justify-content-center rounded-3 shadow-sm" style="min-width: 64px;" title="Terima Pendaftaran">
                                            <i class="bi bi-check-lg fs-6"></i>
                                            <span style="font-size: 0.75rem;">Terima</span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.ppdb.update', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tolak pendaftaran {{ $item->nama_lengkap }}? Pesan kata-kata semangat acak akan dikirimkan otomatis.')">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_pendaftaran" value="ditolak">
                                        <button type="submit" class="btn btn-sm btn-outline-danger px-3 py-1 fw-semibold d-flex flex-column align-items-center justify-content-center rounded-3 shadow-sm" style="min-width: 64px;" title="Tolak Pendaftaran">
                                            <i class="bi bi-x-lg fs-6"></i>
                                            <span style="font-size: 0.75rem;">Tolak</span>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.ppdb.show', $item->id) }}" class="btn btn-sm btn-outline-primary px-3 py-1 rounded-3 fw-medium d-flex align-items-center gap-1 shadow-sm" title="Lihat Detail & Ubah Status">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-file-earmark-person fs-1 d-block mb-2 text-muted opacity-50"></i>
                            Belum ada pendaftaran PPDB.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($registrations->hasPages())
            <div class="d-flex justify-content-end mt-4">
                {{ $registrations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
