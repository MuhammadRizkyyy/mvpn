<?php

namespace App\Http\Controllers;

use App\Models\Partnership;
use App\Models\Gallery;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalKerjasama = Partnership::count();
        $pendingReview  = Partnership::where('status', 'pending')->count();
        $totalGaleri    = Gallery::count();

        $latestPartnerships = Partnership::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalKerjasama',
            'pendingReview',
            'totalGaleri',
            'latestPartnerships'
        ));
    }
}
