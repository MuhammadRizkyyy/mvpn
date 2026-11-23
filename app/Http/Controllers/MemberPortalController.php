<?php
namespace App\Http\Controllers;
use App\Models\Membership;
use App\Models\MembershipPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class MemberPortalController extends Controller {
    public function show(Membership $membership) {
        return response()->view('pages.member-portal', ['member'=>$membership, 'payment'=>MembershipPayment::where('membership_id',$membership->id)->latest()->first()])->header('Cache-Control','no-store')->header('Referrer-Policy','no-referrer');
    }
    public function update(Request $request, Membership $membership) {
        $data=$request->validate(['display_name'=>'required|string|max:150','public_bio'=>'nullable|string|max:160','public_consent'=>'nullable|boolean','proof'=>'nullable|image|mimes:jpg,jpeg,png|max:5120']);
        DB::transaction(function () use ($request,$membership,$data) {
            $member=Membership::lockForUpdate()->findOrFail($membership->id);
            if ($request->hasFile('proof')) {
                $payment=MembershipPayment::where('membership_id',$member->id)->latest()->lockForUpdate()->first();
                abort_unless($payment && in_array($payment->status,['pending','correction']) && $payment->due_at->isFuture(),422,'Tagihan tidak dapat menerima bukti. Hubungi admin.');
                $path=$request->file('proof')->store('membership-proofs','local');
                abort_unless($path,500,'Bukti belum tersimpan. Silakan coba kembali.');
                $payment->update(['proofs'=>array_merge($payment->proofs ?? [],[$path]),'status'=>'review']);
                $this->event($member,'proof_uploaded','member');
            }
            $member->forceFill(['display_name'=>$data['display_name'],'public_bio'=>$data['public_bio'] ?? null,'public_consent'=>$request->boolean('public_consent')])->save();
        });
        return back()->with('success','Perubahan tersimpan.');
    }
    public function manage(Request $request, Membership $membership) {
        $data=$request->validate(['action'=>'required|in:invoice,paid,correction,suspended,active,withdrawn,revoked','amount'=>'required_if:action,invoice|nullable|integer|min:1|max:1000000000','instructions'=>'required_if:action,invoice|nullable|string|max:2000','due_at'=>'required_if:action,invoice|nullable|date|after:now','note'=>'required_unless:action,invoice|nullable|string|max:1000']);
        DB::transaction(function () use ($data,$membership) {
            $member=Membership::lockForUpdate()->findOrFail($membership->id);
            $payment=MembershipPayment::where('membership_id',$member->id)->latest()->lockForUpdate()->first();
            $action=$data['action'];
            if ($action==='invoice') {
                abort_unless($member->status==='accepted' && !$member->member_number,422,'Setujui pendaftaran sebelum menerbitkan tagihan.');
                abort_if($payment && ($payment->status==='review' || $payment->status==='paid' || ($payment->due_at->isFuture() && $payment->status!=='cancelled')),422,'Tagihan sebelumnya masih berlaku.');
                MembershipPayment::create(['membership_id'=>$member->id,'amount'=>$data['amount'],'instructions'=>$data['instructions'],'due_at'=>$data['due_at']]);
            } elseif (in_array($action,['paid','correction'])) {
                if ($action==='paid' && $payment?->status==='paid') return;
                abort_unless($payment && $payment->status==='review' && $member->status==='accepted',422,'Pembayaran belum siap diverifikasi.');
                $payment->update(['status'=>$action,'note'=>$data['note']]);
                if ($action==='correction') $payment->update(['due_at'=>now()->addDays(3)]);
                if ($action==='paid') $member->forceFill(['membership_state'=>'active','member_number'=>$member->member_number ?? 'MVPN-'.str_pad($member->id,6,'0',STR_PAD_LEFT),'activated_at'=>$member->activated_at ?? now()])->save();
            } else {
                abort_unless($member->member_number && ($action!=='active' || ($member->status==='accepted' && $payment?->status==='paid')),422,'Keanggotaan belum memenuhi syarat.');
                $member->forceFill(['membership_state'=>$action])->save();
            }
            $this->event($member,$action,'admin:'.(data_get(session('admin'),'id') ?? 'session'), $data['note'] ?? null);
        });
        return back()->with('success','Status berhasil diperbarui.');
    }
    public function proof(Membership $membership, int $index) {
        $payment=MembershipPayment::where('membership_id',$membership->id)->latest()->firstOrFail();
        $path=($payment->proofs ?? [])[$index] ?? null;
        abort_unless($path && Storage::disk('local')->exists($path),404);
        return Storage::disk('local')->download($path);
    }
    private function event($member,$action,$actor,$note=null): void {
        DB::table('membership_events')->insert(['membership_id'=>$member->id,'action'=>$action,'actor'=>$actor,'note'=>$note,'created_at'=>now()]);
    }
}
