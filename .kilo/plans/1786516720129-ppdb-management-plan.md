# PPDB Registration Management Plan

## 1. Database

### Migration: `database/migrations/2026_08_20_000001_create_ppdb_registrations_table.php`
Table `ppdb_registrations` columns:
- `id` (PK, auto-increment)
- `user_id` (nullable FK to users.id, onDelete: set null) — pendaftar yang sudah login
- `nisn` (string, unique, required) — 10 digit
- `nama_lengkap` (string, required)
- `tempat_lahir` (string, required)
- `tanggal_lahir` (date, required)
- `jenis_kelamin` (enum: L/P, required)
- `alamat` (text, required)
- `asal_sekolah` (string, required)
- `nama_ortu` (string, required)
- `no_hp_ortu` (string, required)
- `jurusan_pilihan` (string, required) — misal: TKJ, RPL, AKL, OTKP
- `status_pendaftaran` (enum: pending/diterima/ditolak, default: pending)
- `catatan_admin` (text, nullable) — alasan diterima/ditolak
- `tanggal_daftar` (timestamp, nullable) — auto on create
- `timestamps`

### Model: `app/Models/PpdbRegistration.php`
- Fillable: semua kolom kecuali `id`, `timestamps`
- Casts: `tanggal_lahir` → date, `tanggal_daftar` → datetime
- Relationship: `user()` belongsTo User (nullable)

---

## 2. Controllers

### A. `app/Http/Controllers/PpdbController.php` (public + auth)
- `info()` → `public.ppdb.info` — halaman informasi/tutorial PPDB (jalur, syarat, biaya, jadwal, jurusan)
- `create()` → `public.ppdb.create` — form pendaftaran (wajib login, jika belum login redirect ke login dengan pesan)
- `store(Request $request)` — validasi lengkap, simpan pendaftaran, redirect dengan success message
- `status()` → `user.ppdb.status` — halaman user melihat status pendaftaran mereka (jika sudah daftar) atau mengisi form (jika belum)

### B. `app/Http/Controllers/Admin/PpdbController.php`
- `index()` → `admin.ppdb.index` — daftar semua pendaftar dengan filter status (semua/pending/diterima/ditolak), pagination
- `show($id)` → `admin.ppdb.show` — detail pendaftar + form aksi approve/reject
- `update(Request $request, $id)` — update status + catatan admin

---

## 3. Routes (`routes/web.php`)

### Public
```
GET  /ppdb              → PpdbController@info          (ppdb.info)
GET  /ppdb/daftar       → PpdbController@create         (ppdb.create)
POST /ppdb/daftar       → PpdbController@store          (ppdb.store)
```

### User (auth middleware)
```
GET  /user/ppdb         → PpdbController@status         (user.ppdb.status)
```

### Admin (admin middleware)
```
GET    /admin/ppdb              → Admin\PpdbController@index       (admin.ppdb.index)
GET    /admin/ppdb/{id}         → Admin\PpdbController@show        (admin.ppdb.show)
PUT    /admin/ppdb/{id}         → Admin\PpdbController@update      (admin.ppdb.update)
```

---

## 4. Views

### A. Public
- `resources/views/public/ppdb-info.blade.php`
  - Hero section: "Pendaftaran Peserta Didik Baru"
  - Tutorial sections: Syarat pendaftaran, Jalur pendaftaran, Biaya, Jadwal, Jurusan yang tersedia
  - Tombol CTA: "Daftar Sekarang" → route `ppdb.create`

- `resources/views/public/ppdb-daftar.blade.php`
  - Form dengan field: NISN, nama lengkap, TTL (tanggal), jenis kelamin, alamat, asal sekolah, nama ortu, no HP ortu, jurusan pilihan
  - Jika sudah pernah daftar, tampilkan alert bahwa mereka sudah mendaftar

### B. User
- `resources/views/user/ppdb.blade.php`
  - Jika BELUM daftar: tampilkan form pendaftaran (sama seperti public form, tapi pre-fill nama/email dari user)
  - Jika SUDAH daftar: tampilkan kartu status (pending/diterima/ditolak) + detail pendaftaran + catatan admin jika ada

### C. Admin
- `resources/views/admin/ppdb/index.blade.php`
  - Filter status (tab/semua/pending/diterima/ditolak)
  - Tabel daftar pendaftar: No, Nama, NISN, Asal Sekolah, Jurusan, Status, Tanggal Daftar, Aksi (view)
  - Pagination

- `resources/views/admin/ppdb/show.blade.php`
  - Detail lengkap pendaftar
  - Form aksi: pilih status (Diterima/Ditolak) + catatan admin
  - Tombol Kembali

---

## 5. Layout Updates

### A. `resources/views/layouts/public.blade.php`
- Tambah tombol "Daftar PPDB" di navbar sebelah kanan (setelah Register/Login)
- Gunakan style primary/outline-primary agar menonjol
- Link ke route `ppdb.info`

### B. `resources/views/layouts/user.blade.php`
- Tambah menu "PPDB" di sidebar dengan icon SVG (misal: bi-mortarboard atau custom SVG)
- Active state menggunakan `request()->routeIs('user.ppdb*')`

---

## 6. Validation Rules (PpdbController@store)
```
nisn           => required|string|size:10|unique:ppdb_registrations,nisn
nama_lengkap   => required|string|max:255
tempat_lahir   => required|string|max:255
tanggal_lahir  => required|date
jenis_kelamin  => required|in:L,P
alamat         => required|string
asal_sekolah   => required|string|max:255
nama_ortu      => required|string|max:255
no_hp_ortu     => required|string|max:20
jurusan_pilihan=> required|string|max:100
```

---

## 7. Security & Edge Cases
- Pendaftar yang sudah login: `user_id` diisi dari `Auth::id()`
- Pendaftar guest: form mengumpulkan data, tapi saat login sistem mencocokkan NISN — jika NISN sudah ada, gabungkan dengan akun user yang login
- Admin tidak bisa menghapus pendaftaran, hanya mengubah status
- Prevent user mendaftar 2x dengan NISN yang sama (unique constraint)
- Jika user login dan NISN-nya sudah terdaftar dengan user_id null, otomatis update user_id saat ini

---

## 8. Validation Steps
1. Public `/ppdb` menampilkan halaman info/tutorial
2. Tombol "Daftar PPDB" di navbar mengarah ke `/ppdb`
3. Tombol "Daftar Sekarang" mengarah ke `/ppdb/daftar`
4. Jika belum login, redirect ke `/login` dengan pesan
5. Form pendaftaran bisa diisi dan disimpan
6. User bisa melihat status pendaftaran di `/user/ppdb`
7. Admin bisa melihat daftar pendaftar di `/admin/ppdb`
8. Admin bisa approve/reject dengan catatan
9. Status berubah sesuai aksi admin
10. Sidebar user menampilkan menu PPDB aktif

---

## 9. Out of Scope
- Pembayaran / transaksi PPDB
- Upload dokumen (KK, ijazah, foto) — bisa ditambahkan setelah inti PPDB berjalan
- Notifikasi email saat status berubah
- Pengumuman hasil secara massal
- Multi-gelombang PPDB
