<?php

namespace App\Http\Controllers;

use App\Models\Partnership;
use App\Models\Gallery;
use App\Models\Visit;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalKerjasama = Partnership::count();
        $pendingReview  = Partnership::where('status', 'pending')->count();
        $totalGaleri    = Gallery::count();
        $pengunjungHariIni = Visit::todayCount();
        $totalPengunjung   = Visit::totalUniqueCount();

        $latestPartnerships = Partnership::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalKerjasama',
            'pendingReview',
            'totalGaleri',
            'pengunjungHariIni',
            'totalPengunjung',
            'latestPartnerships'
        ));
    }
}
