# 🏫 Website Profile Sekolah & Sistem PPDB Online

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

Aplikasi web modern, responsif, dan kaya fitur untuk **Website Profil Sekolah & Sistem Penerimaan Peserta Didik Baru (PPDB) Online** berbasis **Laravel Framework**. Aplikasi ini dirancang untuk menyajikan informasi profil sekolah secara profesional sekaligus mengelola proses pendaftaran calon siswa baru secara efektif.

---

## ✨ Fitur Utama (Key Features)

### 🌐 1. Halaman Publik (Public Portal)
- **Beranda (Home)**: Tampilan hero banner interaktif, keunggulan sekolah, sambutan kepala sekolah, dan ringkasan galeri terbaru.
- **Tentang Kami (About)**: Informasi lengkap profil sekolah, sejarah singkat, serta Visi & Misi lembaga.
- **Galeri Foto (Gallery)**: Katalog foto kegiatan dan fasilitas sekolah dengan tata letak grid responsif & *pagination*.
- **Kontak (Contact)**: Alamat sekolah, kontak telepon, email, serta peta lokasi.
- **Informasi PPDB**: Informasi alur pendaftaran, persyaratan, serta jadwal penerimaan siswa baru.
- **Formulir PPDB Online**: Formulir pendaftaran mandiri calon siswa baru yang terintegrasi secara *real-time*.

### 👤 2. Portal Siswa / Calon Pendaftar (User Portal)
- **Autentikasi User**: Fitur Register & Login akun calon siswa.
- **User Dashboard**: Pemantauan status pendaftaran PPDB secara *real-time* (`Pending`, `Diterima`, atau `Ditolak`).
- **Kelola Profil Pengguna**: Fitur pembaruan informasi profil akun pribadi.

### 🛡️ 3. Panel Administrator (Admin Dashboard & Management)
- **Dashboard Overview**: Ringkasan statistik jumlah pendaftar PPDB, galeri foto, dan total akun terdaftar.
- **Manajemen Galeri**: Tambah, edit, dan hapus foto dokumentasi kegiatan sekolah (CRUD).
- **Manajemen Pengguna**: Pengelolaan akun admin & user (Role-Based Access Control).
- **Pengaturan Sekolah (Dynamic Settings)**: Pengaturan Nama Sekolah, Alamat, No. Telepon, Email, Visi, Misi, dan Logo yang terintegrasi secara otomatis ke seluruh halaman web & cetakan dokumen.
- **Manajemen PPDB & Seleksi**:
  - Filter data pendaftar berdasarkan status seleksi (`Pending`, `Diterima`, `Ditolak`).
  - Fitur pencarian cepat (Nama, NISN, Asal Sekolah, Jurusan).
  - Verifikasi pendaftaran dan pemberian catatan khusus dari admin/panitia.
  - **Export PDF Profesional**: Cetak rekapitulasi data pendaftar ke format PDF (A4 Landscape) dengan Kop Surat Resmi Sekolah, Kartu Ringkasan Data, dan tabel rapi (`barryvdh/laravel-dompdf`).
  - **Export Excel Custom**: Download data pendaftar ke file Excel (`.xlsx`) berformat rapi lengkap dengan header sekolah (`maatwebsite/excel`).

---

## 🛠️ Teknologi & Depedensi (Tech Stack)

- **Backend Framework**: [Laravel 11 / 12](https://laravel.com) (PHP 8.3+)
- **Frontend**: Blade Templating Engine, Custom CSS / Bootstrap & SB Admin 2
- **Database**: MySQL / MariaDB / SQLite
- **Export PDF**: `barryvdh/laravel-dompdf`
- **Export Excel**: `maatwebsite/excel`
- **Asset Bundler**: Vite / NPM

---

## 📁 Struktur Direktori Utama

```
profile-sekolah/
├── app/
│   ├── Exports/            # Class Export Excel (PpdbExport)
│   ├── Http/
│   │   ├── Controllers/   # PublicController, AuthController, UserController, Admin Controllers
│   │   └── Middleware/    # AdminAuth & Auth Middleware
│   └── Models/            # User, Gallery, Setting, PpdbRegistration
├── database/
│   ├── migrations/        # Skema Database (Users, Galleries, Settings, PPDB)
│   └── seeders/           # Seeder Data Awal
├── public/                # Asset Publik (Gambar Upload, CSS, JS)
├── resources/
│   ├── views/
│   │   ├── admin/         # View Dashboard Admin (Gallery, PPDB, Settings, Users)
│   │   ├── public/        # View Website Publik (Home, About, Gallery, Contact)
│   │   └── user/          # View Dashboard User/Siswa
├── routes/
│   └── web.php            # Routing Aplikasi (Public, Auth, User, Admin)
└── storage/               # File Storage (Upload Foto & Dokumen Export)
```

---

## 🚀 Panduan Instalasi (Getting Started)

Ikuti langkah-langkah di bawah ini untuk menjalankan project ini di komputer lokal Anda:

### 1. Prasyarat Sistem
- PHP >= 8.3
- Composer >= 2.x
- Node.js & NPM
- Database MySQL / MariaDB

### 2. Clone Repository
```bash
git clone https://github.com/username/repository-name.git
cd profile-sekolah
```

### 3. Install Dependensi PHP & NPM
```bash
composer install
npm install
```

### 4. Konfigurasi Environment (`.env`)
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Buka file `.env` dan sesuaikan konfigurasi koneksi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_profile_sekolah
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Migrasi & Seeder Database
Jalankan migrasi database dan seeder untuk membuat tabel serta akun Admin default:
```bash
php artisan migrate --seed
```

### 7. Buat Symbolic Link Storage
Agar file upload (foto galeri & logo sekolah) dapat diakses di halaman web:
```bash
php artisan storage:link
```

### 8. Jalankan Server Lokal
Jalankan server aplikasi Laravel dan asset bundler Vite:
```bash
php artisan serve
```
Buka terminal kedua dan jalankan:
```bash
npm run dev
```

Akses aplikasi melalui browser di alamat: `http://127.0.0.1:8000`

---

## 🔑 Akun Akses Default (Default Credentials)

Untuk mengakses halaman **Dashboard Admin**, gunakan akun default yang telah disediakan pada database (seeder):

- **URL Login**: `http://127.0.0.1:8000/login`
- **Email**: `admin@sekolah.sch.id`
- **Password**: `password123`
- **Role**: `admin`

> [!NOTE]
> Pendaftaran akun baru secara mandiri melalui halaman `/register` publik secara otomatis mendapatkan role **`user`**. Untuk membuat akun admin baru tambahan, gunakan akun admin di atas lalu masuk ke menu **Admin Panel -> Users -> Tambah User** (pilih Role: `admin`).

---

## 📄 Fitur Ekspor Dokumen PPDB

Aplikasi dilengkapi dengan sistem rekapitulasi data pendaftar yang siap cetak:

1. **Pencetakan PDF**:
   - Format kertas A4 Landscape.
   - Kop Surat Resmi Sekolah dinamis (Nama Sekolah, Alamat, Kontak dari Pengaturan).
   - Ringkasan Statistik Data (Total Pendaftar, Diterima, Pending, Ditolak).
2. **Ekspor Excel**:
   - Format `.xlsx` berdesain bersih.
   - Format angka NISN & No HP dipertahankan sebagai teks agar tidak berubah format.

---

## 📝 Lisensi

Aplikasi ini bersifat open-source di bawah lisensi [MIT License](LICENSE).

---
<p align="center">Dibuat untuk mendukung digitalisasi sistem informasi sekolah 🚀</p>
