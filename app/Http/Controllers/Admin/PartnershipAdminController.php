<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partnership;

class PartnershipAdminController extends Controller
{
    public function index()
    {
        $partnerships = Partnership::latest()->get();
        return view('admin.partnerships.index', compact('partnerships'));
    }

    public function show($id)
    {
        $partnership = Partnership::findOrFail($id);
        return view('admin.partnerships.show', compact('partnership'));
    }

    public function approve($id)
    {
        Partnership::where('id', $id)->update(['status' => 'approved']);
        return redirect()->back();
    }

    public function reject($id)
    {
        Partnership::where('id', $id)->update(['status' => 'rejected']);
        return redirect()->back();
    }
}
