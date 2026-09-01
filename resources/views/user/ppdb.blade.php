@extends('layouts.user')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4" style="max-width: 850px; margin: 0 auto;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold mb-1">Status Pendaftaran PPDB</h3>
                <p class="text-muted small mb-0">Informasi hasil verifikasi pendaftaran calon siswa baru.</p>
            </div>
            @if($registration)
                @if($registration->status_pendaftaran == 'diterima')
                    <span class="badge bg-success px-3 py-2 rounded-pill fs-6 fw-bold shadow-sm d-flex align-items-center gap-1">
                        <i class="bi bi-check-circle-fill"></i> Diterima
                    </span>
                @elseif($registration->status_pendaftaran == 'ditolak')
                    <span class="badge bg-danger px-3 py-2 rounded-pill fs-6 fw-bold shadow-sm d-flex align-items-center gap-1">
                        <i class="bi bi-x-circle-fill"></i> Ditolak
                    </span>
                @else
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fs-6 fw-bold shadow-sm d-flex align-items-center gap-1">
                        <i class="bi bi-hourglass-split"></i> Pending
                    </span>
                @endif
            @endif
        </div>
        <hr class="my-3 opacity-25">

        @if($registration)
            <!-- Status Alert Box -->
            @if($registration->status_pendaftaran == 'diterima')
                <div class="card border-0 rounded-4 p-4 mb-4 text-white shadow-sm" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-circle bg-white text-success d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 48px; height: 48px;">
                            <i class="bi bi-trophy-fill fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-2">Selamat! Pendaftaran Anda Diterima 🎉</h4>
                            @if($registration->catatan_admin)
                                <div class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-25 mt-2">
                                    <p class="mb-0 fst-italic text-white" style="font-size: 0.95rem; line-height: 1.5;">
                                        <i class="bi bi-quote fs-5 me-1"></i>{{ $registration->catatan_admin }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @elseif($registration->status_pendaftaran == 'ditolak')
                <div class="card border-0 rounded-4 p-4 mb-4 text-white shadow-sm" style="background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);">
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-circle bg-white text-danger d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 48px; height: 48px;">
                            <i class="bi bi-heart-fill fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-2">Pesan Semangat Untukmu 💪</h4>
                            @if($registration->catatan_admin)
                                <div class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-25 mt-2">
                                    <p class="mb-0 fst-italic text-white" style="font-size: 0.95rem; line-height: 1.5;">
                                        <i class="bi bi-quote fs-5 me-1"></i>{{ $registration->catatan_admin }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="card border-0 rounded-4 p-4 mb-4 bg-warning bg-opacity-10 border border-warning border-opacity-25 text-warning-emphasis shadow-sm">
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-circle bg-warning bg-opacity-25 text-warning-emphasis d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px;">
                            <i class="bi bi-clock-history fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Berkas Sedang Diverifikasi</h5>
                            <p class="mb-0 small">Pendaftaran Anda telah diterima dan saat ini sedang dalam proses pemeriksaan oleh panitia PPDB sekolah. Silakan periksa halaman ini secara berkala untuk update hasil seleksi.</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="mb-4">
                <h5 class="fw-bold mb-3 text-dark">Detail Data Pendaftar</h5>
                <div class="table-responsive rounded-3 border">
                    <table class="table table-striped align-middle mb-0">
                        <tr><th width="32%" class="bg-light ps-3">NISN</th><td class="fw-bold">{{ $registration->nisn }}</td></tr>
                        <tr><th class="bg-light ps-3">Nama Lengkap</th><td class="fw-bold text-primary">{{ $registration->nama_lengkap }}</td></tr>
                        <tr><th class="bg-light ps-3">Tempat, Tanggal Lahir</th><td>{{ $registration->tempat_lahir }}, {{ $registration->tanggal_lahir ? $registration->tanggal_lahir->format('d M Y') : '-' }}</td></tr>
                        <tr><th class="bg-light ps-3">Jenis Kelamin</th><td>{{ $registration->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                        <tr><th class="bg-light ps-3">Alamat</th><td>{{ $registration->alamat }}</td></tr>
                        <tr><th class="bg-light ps-3">Asal Sekolah</th><td>{{ $registration->asal_sekolah }}</td></tr>
                        <tr><th class="bg-light ps-3">Nama Orang Tua</th><td>{{ $registration->nama_ortu }}</td></tr>
                        <tr><th class="bg-light ps-3">No HP Orang Tua</th><td>{{ $registration->no_hp_ortu }}</td></tr>
                        <tr><th class="bg-light ps-3">Jurusan Pilihan</th><td><span class="badge bg-secondary-subtle text-secondary px-2 py-1">{{ $registration->jurusan_pilihan }}</span></td></tr>
                        <tr><th class="bg-light ps-3">Tanggal Terdaftar</th><td>{{ $registration->tanggal_daftar ? $registration->tanggal_daftar->format('d M Y H:i') : '-' }}</td></tr>
                    </table>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center p-4 mb-3" style="width: 80px; height: 80px;">
                    <i class="bi bi-file-earmark-person fs-1 text-muted"></i>
                </div>
                <h4 class="fw-bold mb-2">Belum Mendaftar PPDB</h4>
                <p class="text-muted mb-4" style="max-width: 450px; margin: 0 auto;">Anda belum mengisi formulir penerimaan siswa baru. Silakan klik tombol di bawah untuk mendaftar.</p>
                <a href="{{ route('ppdb.create') }}" class="btn btn-primary btn-lg px-4 shadow-sm rounded-pill fw-semibold">
                    <i class="bi bi-pencil-square me-2"></i>Daftar Sekarang
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
