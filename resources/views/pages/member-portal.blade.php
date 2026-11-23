@include('layouts.header')
<main class="container" style="padding-top:140px;padding-bottom:80px;max-width:800px">
<p class="section-eyebrow">RUANG ANGGOTA</p><h1>Halo, {{ $member->nickname ?: $member->full_name }}.</h1>
<p>Pendaftaran: {{ $member->status }} ? Keanggotaan: {{ $member->membership_state }}</p>
@if(session('success'))<p role="status">{{ session('success') }}</p>@endif
@if($errors->any())<p role="alert">{{ $errors->first() }}</p>@endif
@if($member->membership_state==='active')
<article class="member-pass" style="background:#12233b;color:white;padding:32px;margin:32px 0;border-bottom:5px solid #ce1126">
<p>MVP.N / KARTU ANGGOTA</p><h2>{{ $member->full_name }}</h2><p>{{ $member->member_number }}</p><p>Bergabung {{ $member->activated_at?->format('d M Y') }} ? Berlaku seumur hidup</p>
</article><button type="button" class="btn btn-outline-dark mb-4" onclick="window.print()">Cetak / simpan kartu sebagai PDF</button>
@endif
<form method="post" enctype="multipart/form-data" action="{{ \Illuminate\Support\Facades\URL::temporarySignedRoute('member.update',\Carbon\Carbon::createFromTimestamp(request('expires')),['membership'=>$member->id]) }}">@csrf
@if($payment)
<h2>Pembayaran</h2><p>Rp {{ number_format($payment->amount,0,',','.') }} ? {{ $payment->status }}</p>
<p style="white-space:pre-line">{{ $payment->instructions }}</p><p>Batas pembayaran {{ $payment->due_at->format('d M Y H:i') }}</p>
@if($payment->note)<p>{{ $payment->note }}</p>@endif
@if(in_array($payment->status,['pending','correction']) && $payment->due_at->isFuture())<label class="d-block mb-4">Bukti transfer (JPG/PNG, maksimal 5 MB)<input class="form-control" type="file" name="proof" accept="image/jpeg,image/png"></label>@elseif($payment->status!=='paid' && $payment->due_at->isPast())<p>Tagihan melewati batas waktu. Hubungi admin untuk tindak lanjut.</p>@endif
@else<p>Admin akan mengirim instruksi pembayaran setelah pendaftaran disetujui.</p>@endif
<h2 class="mt-4">Profil publik</h2><p>Hanya foto pendaftaran, nama tampilan, bidang minat, bio, dan tahun bergabung yang ditampilkan.</p>
<label class="d-block mb-3">Nama tampilan<input class="form-control" name="display_name" required maxlength="150" value="{{ old('display_name',$member->display_name ?: $member->full_name) }}"></label>
<label class="d-block mb-3">Bio singkat<textarea class="form-control" name="public_bio" maxlength="160">{{ old('public_bio',$member->public_bio) }}</textarea></label>
<label class="d-block mb-4"><input type="checkbox" name="public_consent" value="1" @checked(old('public_consent',$member->public_consent))> Saya setuju foto dan profil ini ditampilkan di website MVPN. Saya dapat menyembunyikannya kembali.</label>
<button class="btn btn-dark">Simpan perubahan</button>
</form></main>
<style>@media print{body *{visibility:hidden}.member-pass,.member-pass *{visibility:visible}.member-pass{position:absolute;left:0;top:0;width:100%;print-color-adjust:exact}}</style>
@include('layouts.footer')