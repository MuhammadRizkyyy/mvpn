@php
$payment=\App\Models\MembershipPayment::where('membership_id',$membership->id)->latest()->first();
$portal=\Illuminate\Support\Facades\URL::temporarySignedRoute('member.portal',now()->addDays(7),['membership'=>$membership->id]);
@endphp
<section class="mb-6 rounded-xl border bg-white p-6">
<h2 class="text-lg font-semibold">Keanggotaan & pembayaran</h2>
<p class="my-3">Status: {{ $membership->membership_state }} ? {{ $membership->member_number ?? 'Nomor belum diterbitkan' }}</p>
<p class="my-3"><a class="underline" href="{{ $portal }}">Buka akses pribadi anggota (berlaku 7 hari)</a></p>
<p class="text-sm text-neutral-500">Kirim tautan ini hanya kepada pemilik pendaftaran melalui kontak yang telah diverifikasi.</p>
@if($errors->any())<p class="my-3 text-red-700">{{ $errors->first() }}</p>@endif
@if($payment)
<p class="my-3">Rp {{ number_format($payment->amount,0,',','.') }} ? {{ $payment->status }} ? Batas {{ $payment->due_at->format('d M Y H:i') }}</p>
@foreach($payment->proofs ?? [] as $proof)<a class="mr-3 underline" href="{{ route('admin.memberships.proof',[$membership,$loop->index]) }}">Bukti {{ $loop->iteration }}</a>@endforeach
@endif
<form method="post" action="{{ route('admin.memberships.payment',$membership) }}" class="mt-4 grid gap-3">@csrf
<label>Tindakan<select name="action" class="block w-full rounded border p-2"><option value="invoice">Terbitkan tagihan</option><option value="paid">Konfirmasi dana masuk & aktifkan</option><option value="correction">Minta perbaikan bukti</option><option value="suspended">Tangguhkan</option><option value="active">Aktifkan kembali</option><option value="withdrawn">Mengundurkan diri</option><option value="revoked">Cabut keanggotaan</option></select></label>
<label>Nominal tagihan (rupiah)<input name="amount" type="number" min="1" class="block w-full rounded border p-2"></label>
<label>Instruksi transfer: bank, rekening, nama penerima<textarea name="instructions" class="block w-full rounded border p-2"></textarea></label>
<label>Batas pembayaran<input name="due_at" type="datetime-local" class="block w-full rounded border p-2"></label>
<label>Catatan / alasan<textarea name="note" class="block w-full rounded border p-2" placeholder="Untuk konfirmasi: referensi transaksi dana masuk"></textarea></label>
<button class="rounded bg-neutral-900 px-4 py-3 text-white">Simpan tindakan</button>
</form>
<details class="mt-4"><summary>Riwayat tindakan</summary>@foreach(\Illuminate\Support\Facades\DB::table('membership_events')->where('membership_id',$membership->id)->latest('id')->get() as $event)<p class="my-2 text-sm">{{ $event->created_at }} ? {{ $event->action }} ? {{ $event->note }}</p>@endforeach</details>
</section>