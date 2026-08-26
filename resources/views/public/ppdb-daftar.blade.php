@extends('layouts.public')

@section('content')
<div class="py-5 bg-white">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white text-center fw-bold">Formulir Pendaftaran PPDB</div>
                    <div class="card-body p-4">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if(session('info'))
                            <div class="alert alert-info">{{ session('info') }}</div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('ppdb.store') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">NISN <span class="text-danger">*</span></label>
                                    <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn') }}" placeholder="10 digit NISN" maxlength="10" required>
                                    @error('nisn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap', $user->name ?? '') }}" placeholder="Nama sesuai ijazah" required>
                                    @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" placeholder="Kota tempat lahir" required>
                                    @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" required>
                                    @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Jurusan Pilihan <span class="text-danger">*</span></label>
                                    <select name="jurusan_pilihan" class="form-select @error('jurusan_pilihan') is-invalid @enderror" required>
                                        <option value="">-- Pilih Jurusan --</option>
                                        <option value="TKJ" {{ old('jurusan_pilihan') == 'TKJ' ? 'selected' : '' }}>TKJ - Teknik Komputer dan Jaringan</option>
                                        <option value="RPL" {{ old('jurusan_pilihan') == 'RPL' ? 'selected' : '' }}>RPL - Rekayasa Perangkat Lunak</option>
                                        <option value="AKL" {{ old('jurusan_pilihan') == 'AKL' ? 'selected' : '' }}>AKL - Akuntansi dan Keuangan Lembaga</option>
                                        <option value="OTKP" {{ old('jurusan_pilihan') == 'OTKP' ? 'selected' : '' }}>OTKP - Otomatisasi dan Tata Kelola Perkantoran</option>
                                    </select>
                                    @error('jurusan_pilihan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold">Alamat <span class="text-danger">*</span></label>
                                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2" placeholder="Alamat lengkap" required>{{ old('alamat') }}</textarea>
                                    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Asal Sekolah <span class="text-danger">*</span></label>
                                    <input type="text" name="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror" value="{{ old('asal_sekolah') }}" placeholder="Nama SMP/sederajat" required>
                                    @error('asal_sekolah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nama Orang Tua <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_ortu" class="form-control @error('nama_ortu') is-invalid @enderror" value="{{ old('nama_ortu') }}" placeholder="Nama orang tua/wali" required>
                                    @error('nama_ortu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">No HP Orang Tua <span class="text-danger">*</span></label>
                                    <input type="text" name="no_hp_ortu" class="form-control @error('no_hp_ortu') is-invalid @enderror" value="{{ old('no_hp_ortu') }}" placeholder="Contoh: 08123456789" required>
                                    @error('no_hp_ortu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="mt-4 d-flex gap-2">
                                <button type="submit" class="btn btn-success">Kirim Pendaftaran</button>
                                <a href="{{ route('ppdb.info') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
