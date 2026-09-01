@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h2>Detail Pendaftaran PPDB</h2>
    <a href="{{ route('admin.ppdb.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h4 class="fw-bold mb-3">Data Pendaftar</h4>
        <table class="table table-bordered">
            <tr><th width="30%">NISN</th><td>{{ $ppdb->nisn }}</td></tr>
            <tr><th>Nama Lengkap</th><td>{{ $ppdb->nama_lengkap }}</td></tr>
            <tr><th>Tempat Lahir</th><td>{{ $ppdb->tempat_lahir }}</td></tr>
            <tr><th>Tanggal Lahir</th><td>{{ $ppdb->tanggal_lahir->format('d-m-Y') }}</td></tr>
            <tr><th>Jenis Kelamin</th><td>{{ $ppdb->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
            <tr><th>Alamat</th><td>{{ $ppdb->alamat }}</td></tr>
            <tr><th>Asal Sekolah</th><td>{{ $ppdb->asal_sekolah }}</td></tr>
            <tr><th>Nama Orang Tua</th><td>{{ $ppdb->nama_ortu }}</td></tr>
            <tr><th>No HP Orang Tua</th><td>{{ $ppdb->no_hp_ortu }}</td></tr>
            <tr><th>Jurusan Pilihan</th><td>{{ $ppdb->jurusan_pilihan }}</td></tr>
            <tr><th>Tanggal Daftar</th><td>{{ $ppdb->tanggal_daftar ? $ppdb->tanggal_daftar->format('d-m-Y H:i') : '-' }}</td></tr>
            <tr><th>Akun Terhubung</th><td>{{ $ppdb->user ? $ppdb->user->email : '-' }}</td></tr>
        </table>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold">Aksi Admin</div>
    <div class="card-body">
        <form action="{{ route('admin.ppdb.update', $ppdb->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">Status Pendaftaran <span class="text-danger">*</span></label>
                <select name="status_pendaftaran" class="form-select @error('status_pendaftaran') is-invalid @enderror" required>
                    <option value="pending" {{ old('status_pendaftaran', $ppdb->status_pendaftaran) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diterima" {{ old('status_pendaftaran', $ppdb->status_pendaftaran) == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ old('status_pendaftaran', $ppdb->status_pendaftaran) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                @error('status_pendaftaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Catatan / Pesan untuk Pendaftar</label>
                <textarea name="catatan_admin" class="form-control @error('catatan_admin') is-invalid @enderror" rows="3" placeholder="Tulis catatan jika ada pesan khusus...">{{ old('catatan_admin', $ppdb->catatan_admin) }}</textarea>
                <div class="form-text text-muted"><i class="bi bi-info-circle me-1"></i>Jika dikosongkan, sistem akan otomatis mengirimkan kata-kata semangat acak (bila ditolak) atau pesan ucapan selamat (bila diterima) kepada pendaftar.</div>
                @error('catatan_admin')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.ppdb.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
