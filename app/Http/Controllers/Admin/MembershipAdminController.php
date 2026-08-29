<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MembershipStatusMail;
use App\Models\Membership;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MembershipAdminController extends Controller
{
    public function index()
    {
        $memberships = Membership::latest()->get();
        return view('admin.memberships.index', compact('memberships'));
    }

    public function show($id)
    {
        $membership = Membership::findOrFail($id);
        return view('admin.memberships.show', compact('membership'));
    }

    public function verify($id)
    {
        return $this->transition($id, 'verified', 'Data anggota diverifikasi');
    }

    public function interview($id)
    {
        return $this->transition($id, 'interview', 'Calon anggota diundang interview');
    }

    public function accept($id)
    {
        return $this->transition($id, 'accepted', 'Calon anggota diterima');
    }

    public function reject($id)
    {
        return $this->transition($id, 'rejected', 'Pendaftaran anggota ditolak');
    }

    private function transition($id, string $status, string $message)
    {
        $membership = Membership::findOrFail($id);
        $membership->update(['status' => $status]);
        $this->notifyStatus($membership);

        return redirect()->route('admin.memberships.index')->with('success', $message);
    }

    private function notifyStatus(Membership $membership): void
    {
        try {
            Mail::to($membership->email)->send(new MembershipStatusMail($membership));
        } catch (\Throwable $e) {
            Log::error('Failed to send membership status email', [
                'membership_id' => $membership->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        Membership::where('id', $id)->delete();
        return redirect()->route('admin.memberships.index')->with('success', 'Pendaftaran anggota dihapus');
    }
}
