@extends('layouts.user')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm p-4 mb-4">
        <h2>Dashboard User</h2>
        <p class="lead">Selamat datang, <strong>{{ Auth::user()->name ?? 'User' }}</strong>!</p>
        <hr>
        <div class="d-flex gap-2">
            <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
            <a href="{{ route('user.profile') }}" class="btn btn-secondary">Edit Profil</a>
            <a href="{{ route('user.ppdb.status') }}" class="btn btn-success">PPDB</a>
        </div>
    </div>

    <div class="card shadow-sm p-4">
        <h4>Informasi Sekolah</h4>
        <hr>
        <div class="row">
            <div class="col-md-4 mb-3">
               @if(!empty($settings['school_logo']))
    <img src="{{ asset('storage/' . $settings['school_logo']) }}" alt="Logo Sekolah" class="img-fluid" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
@else
    <div class="bg-light d-flex align-items-center justify-content-center rounded-circle" style="width: 150px; height: 150px; margin: 0 auto;">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 2 6 3 6 3s6-1 6-3v-5"/></svg>
    </div>
@endif
            </div>
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Nama Sekolah</th>
                        <td>{{ $settings['school_name'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Kontak</th>
                        <td>{{ $settings['contact_number'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $settings['address'] ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection