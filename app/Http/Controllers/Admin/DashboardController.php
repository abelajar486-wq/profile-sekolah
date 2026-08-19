<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGallery = Gallery::count();

        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalRegularUsers = User::where('role', 'user')->count();
        $totalUnverified = User::whereNull('email_verified_at')->count();

        // Role distribution for pie chart
        $roleLabels = ['Admin', 'User'];
        $roleData = [$totalAdmins, $totalRegularUsers];

        // Registration trend for bar chart (last 6 months)
        $months = [];
        $monthlyData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M Y');
            $monthlyData[] = User::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        // Email verification status for doughnut chart
        $verifiedCount = User::whereNotNull('email_verified_at')->count();
        $unverifiedCount = User::whereNull('email_verified_at')->count();

        return view('admin.dashboard', compact(
            'totalGallery',
            'totalUsers',
            'totalAdmins',
            'totalRegularUsers',
            'totalUnverified',
            'roleLabels',
            'roleData',
            'months',
            'monthlyData',
            'verifiedCount',
            'unverifiedCount'
        ));
    }
}
