@extends('layouts.public')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm" style="animation: fadeInUp 0.6s ease forwards;">
                <div class="card-header bg-dark text-white text-center fw-bold">Login Admin</div>
                <div class="card-body p-4">
                    @if(session('error'))
                        <div class="alert alert-danger py-2">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="admin@sekolah.sch.id" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="******" required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Login</button>
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
@endsection