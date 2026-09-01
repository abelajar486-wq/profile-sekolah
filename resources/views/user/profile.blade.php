@extends('layouts.user')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 p-4" style="max-width: 600px; margin: 0 auto;">
        <h2 class="fw-bold mb-1">Edit Profil</h2>
        <p class="text-muted small">Kelola informasi akun dan kata sandi Anda.</p>
        <hr>
        
        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            
            <hr>
            <h5 class="fw-bold">Ubah Password (Opsional)</h5>
            
            <div class="mb-3">
                <label class="form-label fw-semibold">Password Saat Ini</label>
                <div class="input-group">
                    <input type="password" name="current_password" id="userCurrentPassword" class="form-control">
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="userCurrentPassword" title="Lihat/Sembunyikan Password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label fw-semibold">Password Baru</label>
                <div class="input-group">
                    <input type="password" name="password" id="userNewPassword" class="form-control">
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="userNewPassword" title="Lihat/Sembunyikan Password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                <div class="input-group">
                    <input type="password" name="password_confirmation" id="userConfirmPassword" class="form-control">
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="userConfirmPassword" title="Lihat/Sembunyikan Password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4 shadow-sm">Simpan Perubahan</button>
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-password').forEach(function(button) {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    });
});
</script>
@endsection