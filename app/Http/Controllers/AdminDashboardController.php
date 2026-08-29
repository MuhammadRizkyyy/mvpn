<?php

namespace App\Http\Controllers;

use App\Models\Partnership;
use App\Models\Gallery;
use App\Models\Visit;
use App\Models\Membership;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalKerjasama = Partnership::count();
        $pendingReview  = Partnership::where('status', 'pending')->count();
        $totalGaleri    = Gallery::count();
        $pengunjungHariIni = Visit::todayCount();
        $totalPengunjung   = Visit::totalUniqueCount();
        $pendingMembership = Membership::whereNotIn('status', ['accepted', 'rejected'])->count();

        $latestPartnerships = Partnership::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalKerjasama',
            'pendingReview',
            'totalGaleri',
            'pengunjungHariIni',
            'totalPengunjung',
            'pendingMembership',
            'latestPartnerships'
        ));
    }
}
