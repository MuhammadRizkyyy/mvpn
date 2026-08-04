<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PartnershipStatusMail;
use App\Models\Partnership;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
        $partnership = Partnership::findOrFail($id);
        $partnership->update(['status' => 'approved']);
        $this->notifyStatus($partnership);

        return redirect()->route('admin.partnerships.index')->with('success', 'Pengajuan kerjasama disetujui');
    }

    public function reject($id)
    {
        $partnership = Partnership::findOrFail($id);
        $partnership->update(['status' => 'rejected']);
        $this->notifyStatus($partnership);

        return redirect()->route('admin.partnerships.index')->with('success', 'Pengajuan kerjasama ditolak');
    }

    private function notifyStatus(Partnership $partnership): void
    {
        try {
            Mail::to($partnership->email)->send(new PartnershipStatusMail($partnership));
        } catch (\Throwable $e) {
            Log::error('Failed to send partnership status email', [
                'partnership_id' => $partnership->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        Partnership::where('id', $id)->delete();
        return redirect()->route('admin.partnerships.index')->with('success', 'Pengajuan kerjasama dihapus');
    }
}
