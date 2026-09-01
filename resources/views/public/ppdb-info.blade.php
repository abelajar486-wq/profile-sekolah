@extends('layouts.public')

@section('content')
<div class="py-5 bg-white section-reveal">
    <div class="container py-4">
        <!-- Hero Section PPDB -->
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold mb-3 stagger-item">Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</span>
            <h1 class="fw-bold display-5 mb-3 stagger-item" style="transition-delay: 80ms;">Pendaftaran Peserta Didik Baru (PPDB)</h1>
            <p class="text-muted mx-auto fs-5 stagger-item" style="max-width: 650px; transition-delay: 160ms;">Selamat datang calon siswa unggulan! Bergabunglah bersama {{ $settings['school_name'] ?? 'Sekolah Kami' }} dan raih masa depan gemilang dengan pendidikan berkualitas.</p>
            <div class="mt-4 stagger-item" style="transition-delay: 240ms;" data-aos="zoom-in" data-aos-delay="200">
                @auth
                    <a href="{{ route('ppdb.create') }}" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-sm animate-pulse-glow">
                        <i class="bi bi-pencil-square me-2"></i> Isi Formulir Pendaftaran
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-sm animate-pulse-glow">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Login Untuk Mendaftar
                    </a>
                @endauth
            </div>
        </div>

        <!-- Alur Pendaftaran -->
        <div class="row g-4 mb-5">
            <div class="col-md-4 stagger-item" style="transition-delay: 0ms;" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm card-hover h-100 rounded-4">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-3 icon-box-animate" style="width: 65px; height: 65px;">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                        </div>
                        <h5 class="fw-bold mb-2">1. Persiapan Dokumen</h5>
                        <p class="text-muted small mb-0">Siapkan kelengkapan berkas: NISN, Ijazah SMP/sederajat, Kartu Keluarga, dan Pas Foto terbaru 3x4.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stagger-item" style="transition-delay: 120ms;" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm card-hover h-100 rounded-4">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-success bg-opacity-10 text-success d-inline-flex align-items-center justify-content-center mb-3 icon-box-animate" style="width: 65px; height: 65px;">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </div>
                        <h5 class="fw-bold mb-2">2. Isi Formulir Online</h5>
                        <p class="text-muted small mb-0">Buat akun / Login pada sistem web, pilih jurusan yang diminati, dan lengkapi identitas pendaftaran.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stagger-item" style="transition-delay: 240ms;" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm card-hover h-100 rounded-4">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-inline-flex align-items-center justify-content-center mb-3 icon-box-animate" style="width: 65px; height: 65px;">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <h5 class="fw-bold mb-2">3. Verifikasi & Pembayaran</h5>
                        <p class="text-muted small mb-0">Admin verifikasi data pendaftaran. Pantau pengumuman kelulusan & status pada Dashboard User.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION UTAMA: RINCIAN BIAYA PENDIDIKAN DAN PEMBAYARAN -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5" data-aos="fade-up">
            <div class="card-header bg-dark text-white p-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h3 class="fw-bold mb-1 text-white"><i class="bi bi-wallet2 text-warning me-2"></i> Rincian Biaya Pendidikan & Pembayaran Sekolah</h3>
                    <p class="mb-0 text-white-50 small">Informasi transparan mengenai biaya pendaftaran, uang pangkal, dan SPP bulanan.</p>
                </div>
                <span class="badge bg-success px-3 py-2 rounded-pill fs-6"><i class="bi bi-check-circle me-1"></i> Tanpa Biaya Tersembunyi</span>
            </div>
            <div class="card-body p-4 p-lg-5 bg-light">

                <div class="row g-4 mb-4">
                    <!-- Biaya Pendaftaran -->
                    <div class="col-md-4 stagger-item" style="transition-delay: 0ms;" data-aos="zoom-in" data-aos-delay="100">
                        <div class="card border-0 shadow-sm card-hover rounded-4 h-100 bg-white">
                            <div class="card-body p-4 text-center">
                                <div class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill fw-bold mb-3">Biaya Form Pendaftaran</div>
                                <h2 class="fw-bold text-dark mb-1">Rp 150.000</h2>
                                <p class="text-success small fw-semibold mb-3"><i class="bi bi-gift-fill me-1"></i> GRATIS untuk Gelombang 1</p>
                                <hr class="my-3 opacity-10">
                                <ul class="list-unstyled text-start small text-muted mb-0 d-flex flex-column gap-2">
                                    <li><i class="bi bi-check-lg text-primary me-2"></i>Formulir Pendaftaran Online</li>
                                    <li><i class="bi bi-check-lg text-primary me-2"></i>Kartu Ujian / Seleksi Masuk</li>
                                    <li><i class="bi bi-check-lg text-primary me-2"></i>Konsultasi Peminatan Jurusan</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Uang Pangkal / Biaya Masuk -->
                    <div class="col-md-4 stagger-item" style="transition-delay: 120ms;" data-aos="zoom-in" data-aos-delay="200">
                        <div class="card border-primary border-2 shadow card-hover rounded-4 h-100 bg-white position-relative overflow-hidden">
                            <div class="position-absolute top-0 end-0 bg-primary text-white text-uppercase px-3 py-1 fw-bold small rounded-bl">Populer</div>
                            <div class="card-body p-4 text-center">
                                <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold mb-3">Uang Pangkal / Biaya Masuk</div>
                                <h2 class="fw-bold text-primary mb-1">Rp 2.500.000</h2>
                                <p class="text-muted small fw-semibold mb-3"><i class="bi bi-clock-history me-1"></i> Dapat Diangsur 3x - 6x</p>
                                <hr class="my-3 opacity-10">
                                <ul class="list-unstyled text-start small text-secondary mb-0 d-flex flex-column gap-2">
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Seragam Lengkap 5 Pasang</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Jas Almamater & Atribut Sekolah</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Modul & Buku Kit Pembelajaran</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Kegiatan OSIS & Eskul 1 Tahun</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Pengembangan Lab & Komputer</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- SPP Bulanan -->
                    <div class="col-md-4 stagger-item" style="transition-delay: 240ms;" data-aos="zoom-in" data-aos-delay="300">
                        <div class="card border-0 shadow-sm card-hover rounded-4 h-100 bg-white">
                            <div class="card-body p-4 text-center">
                                <div class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold mb-3">SPP Per Bulan</div>
                                <h2 class="fw-bold text-success mb-1">Rp 350.000</h2>
                                <p class="text-muted small fw-semibold mb-3">s/d Rp 400.000 / bulan</p>
                                <hr class="my-3 opacity-10">
                                <ul class="list-unstyled text-start small text-muted mb-0 d-flex flex-column gap-2">
                                    <li><i class="bi bi-check-lg text-success me-2"></i>Bebas Biaya Ujian Semester</li>
                                    <li><i class="bi bi-check-lg text-success me-2"></i>Bebas Internet Wi-Fi Kampus</li>
                                    <li><i class="bi bi-check-lg text-success me-2"></i>Penggunaan Lab & Praktikum</li>
                                    <li><i class="bi bi-check-lg text-success me-2"></i>Bimbingan Konseling & Karir</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Skema Gelombang Pendaftaran & Diskon -->
                <div class="bg-white p-4 rounded-4 shadow-sm mb-4 stagger-item" style="transition-delay: 100ms;" data-aos="fade-up" data-aos-delay="100">
                    <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-calendar-event text-primary me-2"></i> Jadwal Gelombang Pendaftaran & Potongan Khusus</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Gelombang</th>
                                    <th>Periode Pendaftaran</th>
                                    <th>Potongan Uang Pangkal</th>
                                    <th>Biaya Formulir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge bg-success rounded-pill">Gelombang 1 (Early Bird)</span></td>
                                    <td>1 Oktober - 31 Desember</td>
                                    <td class="fw-bold text-success">Diskon Rp 500.000</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success">GRATIS</span></td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-primary rounded-pill">Gelombang 2</span></td>
                                    <td>1 Januari - 31 Maret</td>
                                    <td class="fw-bold text-primary">Diskon Rp 250.000</td>
                                    <td>Rp 150.000</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-secondary rounded-pill">Gelombang 3</span></td>
                                    <td>1 April - 30 Juni</td>
                                    <td>Tarif Reguler</td>
                                    <td>Rp 150.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Metode Pembayaran & Rekening Bank -->
                <div class="row g-4">
                    <div class="col-md-6 stagger-item" style="transition-delay: 0ms;" data-aos="fade-right" data-aos-delay="200">
                        <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                            <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-bank text-primary me-2"></i> Metode & Kanal Pembayaran</h5>
                            <p class="text-muted small mb-3">Pembayaran dapat dilakukan secara tunai melalui loket keuangan sekolah atau transfer ke rekening resmi:</p>
                            <div class="d-flex flex-column gap-2">
                                <div class="p-3 bg-light rounded-3 d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="fw-bold d-block text-dark">Bank BRI</span>
                                        <small class="font-monospace text-muted">No. Rek: 1234-01-000567-53-0</small>
                                    </div>
                                    <span class="badge bg-primary bg-opacity-10 text-primary">A.N {{ $settings['school_name'] ?? 'Yayasan Sekolah' }}</span>
                                </div>
                                <div class="p-3 bg-light rounded-3 d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="fw-bold d-block text-dark">Bank BNI / Mandiri</span>
                                        <small class="font-monospace text-muted">Virtual Account & QRIS Sekolah</small>
                                    </div>
                                    <span class="badge bg-success bg-opacity-10 text-success">Otomatis Terverifikasi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Program Beasiswa & Bantuan -->
                    <div class="col-md-6 stagger-item" style="transition-delay: 120ms;" data-aos="fade-left" data-aos-delay="300">
                        <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                            <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-award text-warning me-2"></i> Program Beasiswa & Potongan Khusus</h5>
                            <ul class="list-unstyled mb-0 text-secondary small d-flex flex-column gap-3">
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-star-fill text-warning mt-1"></i>
                                    <div>
                                        <strong class="text-dark d-block">Beasiswa Prestasi Akademik & Non-Akademik</strong>
                                        Diskon SPP hingga 50% - 100% bagi siswa peraih juara lomba OSN, O2SN, FLS2N, atau peringkat 1-3 di kelas.
                                    </div>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-heart-fill text-danger mt-1"></i>
                                    <div>
                                        <strong class="text-dark d-block">Beasiswa KIP / Kurang Mampu</strong>
                                        Bantuan pendidikan bagi pemegang Kartu Indonesia Pintar (KIP) atau Program Keluarga Harapan (PKH).
                                    </div>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-people-fill text-info mt-1"></i>
                                    <div>
                                        <strong class="text-dark d-block">Potongan Saudara Kandung</strong>
                                        Diskon SPP sebesar 15% jika memiliki kakak/adik yang masih aktif bersekolah di lembaga kami.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Syarat Pendaftaran Card -->
        <div class="card border-0 shadow-sm rounded-4 mb-5" data-aos="fade-up">
            <div class="card-body p-4 p-lg-5">
                <h4 class="fw-bold mb-3"><i class="bi bi-file-earmark-check text-success me-2"></i> Syarat & Ketentuan Pendaftaran</h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <ul class="text-secondary mb-0 ps-3 fs-6 d-flex flex-column gap-2">
                            <li>NISN (Nomor Induk Siswa Nasional) aktif dan terverifikasi di Verval PD.</li>
                            <li>Fotokopi Ijazah SMP/MTs/sederajat atau Surat Keterangan Lulus (SKL).</li>
                            <li>Fotokopi Kartu Keluarga (KK) dan Akta Kelahiran.</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="text-secondary mb-0 ps-3 fs-6 d-flex flex-column gap-2">
                            <li>Pas foto berwarna ukuran 3x4 terbaru (background merah/biru) 3 lembar.</li>
                            <li>Fotokopi KIP / PKH / Piagam Prestasi (jika memiliki).</li>
                            <li>Mengisi formulir pendaftaran secara online dengan benar.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jurusan Pilihan Card -->
        <div class="card border-0 shadow-sm rounded-4 mb-5" data-aos="fade-up">
            <div class="card-body p-4 p-lg-5">
                <h4 class="fw-bold mb-4 text-center"><i class="bi bi-journal-bookmark text-primary me-2"></i> Program Keahlian / Jurusan Yang Tersedia</h4>
                <div class="row g-3">
                    <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="p-4 bg-light rounded-4 card-hover text-center h-100 border-0">
                            <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3 icon-box-animate" style="width: 50px; height: 50px;">
                                <i class="bi bi-hdd-network fs-4"></i>
                            </div>
                            <div class="fw-bold text-primary fs-5 mb-1">TKJ</div>
                            <small class="text-muted d-block">Teknik Komputer dan Jaringan</small>
                            <span class="badge bg-primary bg-opacity-10 text-primary mt-2">SPP Rp 400.000</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="p-4 bg-light rounded-4 card-hover text-center h-100 border-0">
                            <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-3 icon-box-animate" style="width: 50px; height: 50px;">
                                <i class="bi bi-code-slash fs-4"></i>
                            </div>
                            <div class="fw-bold text-success fs-5 mb-1">RPL</div>
                            <small class="text-muted d-block">Rekayasa Perangkat Lunak</small>
                            <span class="badge bg-success bg-opacity-10 text-success mt-2">SPP Rp 400.000</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="p-4 bg-light rounded-4 card-hover text-center h-100 border-0">
                            <div class="rounded-circle bg-warning text-white d-inline-flex align-items-center justify-content-center mb-3 icon-box-animate" style="width: 50px; height: 50px;">
                                <i class="bi bi-calculator fs-4"></i>
                            </div>
                            <div class="fw-bold text-warning fs-5 mb-1">AKL</div>
                            <small class="text-muted d-block">Akuntansi & Keuangan Lembaga</small>
                            <span class="badge bg-warning bg-opacity-10 text-warning mt-2">SPP Rp 350.000</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="p-4 bg-light rounded-4 card-hover text-center h-100 border-0">
                            <div class="rounded-circle bg-danger text-white d-inline-flex align-items-center justify-content-center mb-3 icon-box-animate" style="width: 50px; height: 50px;">
                                <i class="bi bi-building-gear fs-4"></i>
                            </div>
                            <div class="fw-bold text-danger fs-5 mb-1">OTKP</div>
                            <small class="text-muted d-block">Otomatisasi & Tata Kelola Perkantoran</small>
                            <span class="badge bg-danger bg-opacity-10 text-danger mt-2">SPP Rp 350.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center" data-aos="fade-up">
            @auth
                <a href="{{ route('ppdb.create') }}" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-sm animate-pulse-glow">Daftar Sekarang Juga</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-sm animate-pulse-glow">Login Untuk Mendaftar</a>
            @endauth
        </div>
    </div>
</div>
@endsection
