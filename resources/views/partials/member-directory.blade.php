@php
$publicMembers=\App\Models\Membership::where('membership_state','active')->where('public_consent',true)->whereNotNull('display_name')->select(['id','display_name','public_bio','photo','interest_fields','activated_at'])->orderBy('activated_at','desc')->paginate(12,['*'],'anggota_page')->fragment('anggota');
@endphp
<link rel="stylesheet" href="{{ asset('css/members.css') }}">
<section id="anggota" class="members-section">
<div class="container">
<header class="members-heading"><div><span class="section-eyebrow">ANGGOTA MVPN</span><h2>Berbagai langkah.<br><em>Satu arah gerak.</em></h2></div><p>Ruang bertemu bagi mereka yang ingin ikut mengambil peran. Kenali orang-orang di balik gerakan MVPN.</p></header>
<div class="members-rule" aria-hidden="true"><span></span><img src="{{ asset('assets/img/mvpn.png') }}" alt="" width="70" height="70"><span></span></div>
<div class="members-grid">
@forelse($publicMembers as $person)
<article class="member-portrait" style="--delay:{{ ($loop->index % 4)*80 }}ms">
<div class="member-photo">@if($person->photo)<img src="{{ $person->photo }}" alt="{{ $person->display_name }}" loading="lazy" width="400" height="480">@else<span>{{ mb_substr($person->display_name,0,1) }}</span>@endif</div>
<div class="member-caption"><p class="member-since">ANGGOTA SEJAK {{ $person->activated_at?->format('Y') }}</p><h3>{{ $person->display_name }}</h3><p>{{ implode(' ? ',array_slice($person->interestFieldLabels(),0,3)) }}</p>@if($person->public_bio)<p class="member-bio">{{ $person->public_bio }}</p>@endif</div>
</article>
@empty
<div class="members-empty"><h3>Gerakan ini terbuka untuk Anda.</h3><p>Daftar, kenali komunitasnya, dan ambil bagian sesuai minat Anda. Profil anggota yang memilih untuk tampil akan hadir di sini.</p></div>
@endforelse
</div>
@if($publicMembers->hasPages())<nav class="members-pagination" aria-label="Halaman anggota">@if($publicMembers->previousPageUrl())<a href="{{ $publicMembers->previousPageUrl() }}">Sebelumnya</a>@endif<span>{{ $publicMembers->currentPage() }} / {{ $publicMembers->lastPage() }}</span>@if($publicMembers->nextPageUrl())<a href="{{ $publicMembers->nextPageUrl() }}">Berikutnya</a>@endif</nav>@endif
<footer class="members-footer"><div><h3>Ambil tempat dalam gerakan.</h3><p>Keanggotaan seumur hidup. Identitas anggota, jejaring komunitas, dan kesempatan berkontribusi.</p></div><a href="{{ route('keanggotaan.form') }}">Daftar keanggotaan</a></footer>
</div></section>
<script> (()=>{const s=document.getElementById('anggota');if(!('IntersectionObserver' in window))return;const o=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting){e.target.classList.add('members-visible');o.unobserve(e.target)}})},{threshold:.08});o.observe(s)})(); </script>