@extends('layouts.public')

@section('content')
<div class="py-5 bg-white">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-9" data-aos="fade-up">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-dark text-white text-center py-4">
                        <h4 class="fw-bold mb-1 text-white"><i class="bi bi-file-earmark-text text-primary me-2"></i> Formulir Pendaftaran PPDB Online</h4>
                        <p class="small text-white-50 mb-0">Isi data calon siswa secara lengkap dan akurat sesuai ijazah/kartu keluarga.</p>
                    </div>
                    <div class="card-body p-4 p-lg-5">
                        @if(session('error'))
                            <div class="alert alert-danger rounded-3" data-aos="fade-down">{{ session('error') }}</div>
                        @endif
                        @if(session('info'))
                            <div class="alert alert-info rounded-3" data-aos="fade-down">{{ session('info') }}</div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success rounded-3" data-aos="fade-down">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('ppdb.store') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6" data-aos="fade-right" data-aos-delay="100">
                                    <label class="form-label fw-bold">NISN <span class="text-danger">*</span></label>
                                    <input type="text" name="nisn" class="form-control rounded-3 p-2.5 @error('nisn') is-invalid @enderror" value="{{ old('nisn') }}" placeholder="10 digit NISN" maxlength="10" required>
                                    @error('nisn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6" data-aos="fade-left" data-aos-delay="100">
                                    <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_lengkap" class="form-control rounded-3 p-2.5 @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap', $user->name ?? '') }}" placeholder="Nama sesuai ijazah" required>
                                    @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6" data-aos="fade-right" data-aos-delay="150">
                                    <label class="form-label fw-bold">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" name="tempat_lahir" class="form-control rounded-3 p-2.5 @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" placeholder="Kota tempat lahir" required>
                                    @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6" data-aos="fade-left" data-aos-delay="150">
                                    <label class="form-label fw-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_lahir" class="form-control rounded-3 p-2.5 @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" required>
                                    @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6" data-aos="fade-right" data-aos-delay="200">
                                    <label class="form-label fw-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select name="jenis_kelamin" class="form-select rounded-3 p-2.5 @error('jenis_kelamin') is-invalid @enderror" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
                                    <label class="form-label fw-bold">Jurusan Pilihan <span class="text-danger">*</span></label>
                                    <select name="jurusan_pilihan" class="form-select rounded-3 p-2.5 @error('jurusan_pilihan') is-invalid @enderror" required>
                                        <option value="">-- Pilih Jurusan --</option>
                                        <option value="TKJ" {{ old('jurusan_pilihan') == 'TKJ' ? 'selected' : '' }}>TKJ - Teknik Komputer dan Jaringan</option>
                                        <option value="RPL" {{ old('jurusan_pilihan') == 'RPL' ? 'selected' : '' }}>RPL - Rekayasa Perangkat Lunak</option>
                                        <option value="AKL" {{ old('jurusan_pilihan') == 'AKL' ? 'selected' : '' }}>AKL - Akuntansi dan Keuangan Lembaga</option>
                                        <option value="OTKP" {{ old('jurusan_pilihan') == 'OTKP' ? 'selected' : '' }}>OTKP - Otomatisasi dan Tata Kelola Perkantoran</option>
                                    </select>
                                    @error('jurusan_pilihan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12" data-aos="fade-up" data-aos-delay="250">
                                    <label class="form-label fw-bold">Alamat Rumah <span class="text-danger">*</span></label>
                                    <textarea name="alamat" class="form-control rounded-3 @error('alamat') is-invalid @enderror" rows="2" placeholder="Alamat lengkap beserta RT/RW, Desa, Kecamatan, Kota" required>{{ old('alamat') }}</textarea>
                                    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6" data-aos="fade-right" data-aos-delay="300">
                                    <label class="form-label fw-bold">Asal Sekolah SMP/sederajat <span class="text-danger">*</span></label>
                                    <input type="text" name="asal_sekolah" class="form-control rounded-3 p-2.5 @error('asal_sekolah') is-invalid @enderror" value="{{ old('asal_sekolah') }}" placeholder="Nama SMP/MTs asal" required>
                                    @error('asal_sekolah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6" data-aos="fade-left" data-aos-delay="300">
                                    <label class="form-label fw-bold">Nama Orang Tua / Wali <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_ortu" class="form-control rounded-3 p-2.5 @error('nama_ortu') is-invalid @enderror" value="{{ old('nama_ortu') }}" placeholder="Nama Ayah/Ibu/Wali" required>
                                    @error('nama_ortu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6" data-aos="fade-right" data-aos-delay="350">
                                    <label class="form-label fw-bold">No HP Orang Tua / WA <span class="text-danger">*</span></label>
                                    <input type="text" name="no_hp_ortu" class="form-control rounded-3 p-2.5 @error('no_hp_ortu') is-invalid @enderror" value="{{ old('no_hp_ortu') }}" placeholder="Contoh: 08123456789" required>
                                    @error('no_hp_ortu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-top d-flex gap-3 align-items-center justify-content-end" data-aos="fade-up" data-aos-delay="400">
                                <a href="{{ route('ppdb.info') }}" class="btn btn-light rounded-pill px-4 py-2">Batal / Kembali</a>
                                <button type="submit" class="btn btn-success rounded-pill px-5 py-2.5 fw-bold shadow-sm">Kirim Pendaftaran <i class="bi bi-send me-1"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
