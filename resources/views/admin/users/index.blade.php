@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Manajemen User</h2>
        <p class="text-muted mb-0">Kelola akun pengguna, hak akses role, dan status verifikasi email.</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary px-3 shadow-sm d-flex align-items-center gap-2">
        <i class="bi bi-person-plus-fill"></i> Tambah User
    </a>
</div>

<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body p-4">
        <form action="{{ route('admin.users.index') }}" method="GET" class="mb-4">
            <div class="input-group" style="max-width: 500px;">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, email, atau username..." value="{{ request('search') }}">
                <button class="btn btn-primary px-3" type="submit"><i class="bi bi-search me-1"></i> Cari</button>
                @if(request('search'))
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>

        <div class="table-responsive rounded-3 border">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;" class="text-center">No</th>
                        <th style="min-width: 150px;">Nama</th>
                        <th style="min-width: 120px;">Username</th>
                        <th style="min-width: 180px;">Email</th>
                        <th style="min-width: 180px;">Alamat</th>
                        <th style="width: 100px;" class="text-center">Role</th>
                        <th style="width: 190px;" class="text-center">Status Email</th>
                        <th style="width: 150px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $item)
                    <tr>
                        <td class="text-center fw-medium text-muted">{{ $users->firstItem() + $index }}</td>
                        <td class="fw-bold text-dark">{{ $item->name }}</td>
                        <td class="text-secondary small">{{ $item->username ?? '-' }}</td>
                        <td class="text-secondary small">{{ $item->email }}</td>
                        <td class="text-secondary small">{{ $item->alamat ?? '-' }}</td>
                        <td class="text-center">
                            <span class="badge {{ $item->role === 'admin' ? 'bg-danger-subtle text-danger border border-danger-subtle' : 'bg-primary-subtle text-primary border border-primary-subtle' }} px-2 py-1 rounded-pill">
                                {{ ucfirst($item->role) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                @if($item->email_verified_at)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill">Terverifikasi</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1 rounded-pill">Belum Verifikasi</span>
                                @endif
                                <form action="{{ route('admin.users.toggle-verification', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $item->email_verified_at ? 'btn-outline-secondary' : 'btn-outline-success' }} py-0 px-2" style="font-size: 0.75rem;" title="Ubah status verifikasi email">
                                        {{ $item->email_verified_at ? 'Batal' : 'Verifikasi' }}
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center gap-1">
                                <a href="{{ route('admin.users.edit', $item->id) }}" class="btn btn-sm btn-outline-warning px-2 py-1" title="Edit">
                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                </a>
                                @if($item->role !== 'admin')
                                    <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger px-2 py-1" title="Hapus">
                                            <i class="bi bi-trash me-1"></i>Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-people fs-1 d-block mb-2 text-muted opacity-50"></i>
                            Belum ada user yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="d-flex justify-content-end mt-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
