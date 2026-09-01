@extends('layouts.public')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm border-0" style="animation: fadeInUp 0.6s ease forwards;">
                <div class="card-header bg-dark text-white text-center fw-bold py-3">Login Admin</div>
                <div class="card-body p-4">
                    @include('partials.alerts')

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="admin@sekolah.sch.id" value="{{ old('email') }}" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="loginPassword" class="form-control" placeholder="******" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="loginPassword" title="Lihat/Sembunyikan Password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 py-2 shadow-sm">Login</button>
                    </form>

                    <!-- Tombol kecil untuk pindah ke Register -->
                    <div class="text-center mt-3">
                        <small>Belum memiliki akun? <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold">Daftar / Register</a></small>
                    </div>
                </div>
            </div>
        </div>
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