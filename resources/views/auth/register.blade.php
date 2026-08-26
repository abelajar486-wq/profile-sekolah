@extends('layouts.public')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm" style="animation: fadeInUp 0.6s ease forwards;">
                <div class="card-header bg-dark text-white text-center fw-bold">Registrasi Akun Baru</div>
                <div class="card-body p-4">
                    <form action="{{ route('register.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama" value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan username (opsional)" value="{{ old('username') }}">
                            @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@email.com" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2" placeholder="Masukkan alamat (opsional)">{{ old('alamat') }}</textarea>
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 6 karakter" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Daftar Sebagai (Role)</label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User / Siswa</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin Sekolah</option>
                            </select>
                            @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status Verifikasi Email</label>
                            <select name="is_verified" class="form-select @error('is_verified') is-invalid @enderror">
                                <option value="0" {{ old('is_verified', '0') == '0' ? 'selected' : '' }}>Belum Verifikasi</option>
                                <option value="1" {{ old('is_verified') == '1' ? 'selected' : '' }}>Langsung Terverifikasi</option>
                            </select>
                            @error('is_verified')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn btn-dark w-100">Daftar Sekarang</button>
                    </form>

                    <!-- Tombol kecil untuk pindah ke Login -->
                    <div class="text-center mt-3">
                        <small>Sudah punya akun? <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">Masuk / Login</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection