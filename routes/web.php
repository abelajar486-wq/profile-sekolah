<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\GalleryController as AdminGallery;
use App\Http\Controllers\Admin\SettingController as AdminSetting;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\PpdbController as AdminPpdb;

// ==========================================
// 1. PUBLIC ROUTES
// ==========================================
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/gallery', [PublicController::class, 'gallery'])->name('gallery');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');

// PPDB Public Routes
Route::get('/ppdb', [PpdbController::class, 'info'])->name('ppdb.info');
Route::get('/ppdb/daftar', [PpdbController::class, 'create'])->name('ppdb.create');
Route::post('/ppdb/daftar', [PpdbController::class, 'store'])->name('ppdb.store');

// ==========================================
// 2. AUTH ROUTES (Custom Auth)
// ==========================================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// 3. USER ROUTES (Terproteksi Auth - Role User)
// ==========================================
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/ppdb', [PpdbController::class, 'status'])->name('ppdb.status');
});

// ==========================================
// 4. ADMIN ROUTES (Terproteksi AdminAuth)
// ==========================================
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    // CRUD Gallery
    Route::resource('gallery', AdminGallery::class);

    // Manajemen User
    Route::resource('users', AdminUser::class);

    // Setting Sekolah
    Route::get('/settings', [AdminSetting::class, 'index'])->name('settings.index');
    Route::put('/settings', [AdminSetting::class, 'update'])->name('settings.update');

    // Manajemen PPDB
    Route::get('/ppdb', [AdminPpdb::class, 'index'])->name('ppdb.index');
    Route::get('/ppdb/{ppdb}', [AdminPpdb::class, 'show'])->name('ppdb.show');
    Route::put('/ppdb/{ppdb}', [AdminPpdb::class, 'update'])->name('ppdb.update');
    Route::get('/ppdb/export/pdf', [AdminPpdb::class, 'exportPdf'])->name('ppdb.export.pdf');
    Route::get('/ppdb/export/excel', [AdminPpdb::class, 'exportExcel'])->name('ppdb.export.excel');
});