@extends('layouts.user')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm p-4" style="max-width: 800px; margin: 0 auto;">
        <h2>Status Pendaftaran PPDB</h2>
        <hr>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        @if($registration)
            <div class="mb-4">
                <h4 class="fw-bold">Data Pendaftaran</h4>
                <table class="table table-bordered">
                    <tr><th width="30%">NISN</th><td>{{ $registration->nisn }}</td></tr>
                    <tr><th>Nama Lengkap</th><td>{{ $registration->nama_lengkap }}</td></tr>
                    <tr><th>Tempat Lahir</th><td>{{ $registration->tempat_lahir }}</td></tr>
                    <tr><th>Tanggal Lahir</th><td>{{ $registration->tanggal_lahir->format('d-m-Y') }}</td></tr>
                    <tr><th>Jenis Kelamin</th><td>{{ $registration->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                    <tr><th>Alamat</th><td>{{ $registration->alamat }}</td></tr>
                    <tr><th>Asal Sekolah</th><td>{{ $registration->asal_sekolah }}</td></tr>
                    <tr><th>Nama Orang Tua</th><td>{{ $registration->nama_ortu }}</td></tr>
                    <tr><th>No HP Orang Tua</th><td>{{ $registration->no_hp_ortu }}</td></tr>
                    <tr><th>Jurusan Pilihan</th><td>{{ $registration->jurusan_pilihan }}</td></tr>
                    <tr><th>Tanggal Daftar</th><td>{{ $registration->tanggal_daftar ? $registration->tanggal_daftar->format('d-m-Y H:i') : '-' }}</td></tr>
                </table>
            </div>

            <div class="alert alert-{{ $registration->status_pendaftaran == 'diterima' ? 'success' : ($registration->status_pendaftaran == 'ditolak' ? 'danger' : 'warning') }}">
                <h5 class="fw-bold">Status: {{ ucfirst($registration->status_pendaftaran) }}</h5>
                @if($registration->catatan_admin)
                    <p class="mb-0"><strong>Catatan Admin:</strong> {{ $registration->catatan_admin }}</p>
                @endif
            </div>
        @else
            <div class="text-center py-5">
                <p class="text-muted mb-4">Anda belum mengisi formulir pendaftaran PPDB.</p>
                <a href="{{ route('ppdb.create') }}" class="btn btn-primary btn-lg">Daftar Sekarang</a>
            </div>
        @endif
    </div>
</div>
@endsection
