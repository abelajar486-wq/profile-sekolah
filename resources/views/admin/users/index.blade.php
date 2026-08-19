@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen User</h2>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Tambah User</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.users.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, email, atau username..." value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                @if(request('search'))
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-danger">Reset</a>
                @endif
            </div>
        </form>

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width: 50px;" class="text-center">No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Role</th>
                    <th>Status Email</th>
                    <th style="width: 160px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $item)
                <tr>
                    <td class="text-center">{{ $users->firstItem() + $index }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->username ?? '-' }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->alamat ?? '-' }}</td>
                    <td>
                        <span class="badge {{ $item->role === 'admin' ? 'bg-danger' : 'bg-primary' }}">
                            {{ ucfirst($item->role) }}
                        </span>
                    </td>
                    <td>
                        @if($item->email_verified_at)
                            <span class="badge bg-success">Terverifikasi</span>
                        @else
                            <span class="badge bg-warning text-dark">Belum Verifikasi</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.users.edit', $item->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                        <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">Belum ada user yang terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
