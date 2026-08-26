<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\User;
use App\Models\PpdbRegistration;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Galeri
        $totalGallery = Gallery::count();
        $galleryThisMonth = Gallery::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $recentGalleries = Gallery::latest()->take(4)->get();

        // Statistik User & Admin
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalRegularUsers = User::where('role', 'user')->count();
        $totalUnverified = User::whereNull('email_verified_at')->count();

        // Statistik PPDB
        $totalPpdb = PpdbRegistration::count();

        // Distribusi Role untuk Pie Chart
        $roleLabels = ['Admin', 'User / Siswa'];
        $roleData = [$totalAdmins, $totalRegularUsers];

        // Tren 6 Bulan Terakhir (User & Upload Galeri)
        $months = [];
        $monthlyData = [];
        $galleryMonthlyData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M Y');
            $monthlyData[] = User::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $galleryMonthlyData[] = Gallery::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        // Status Verifikasi Email untuk Doughnut Chart
        $verifiedCount = User::whereNotNull('email_verified_at')->count();
        $unverifiedCount = User::whereNull('email_verified_at')->count();

        return view('admin.dashboard', compact(
            'totalGallery',
            'galleryThisMonth',
            'recentGalleries',
            'totalUsers',
            'totalAdmins',
            'totalRegularUsers',
            'totalUnverified',
            'totalPpdb',
            'roleLabels',
            'roleData',
            'months',
            'monthlyData',
            'galleryMonthlyData',
            'verifiedCount',
            'unverifiedCount'
        ));
    }
}
