@php
    $title = 'MVP.N — Muda Visioner Penggerak Nasional';
    $metaDescription = __('site.meta.description');
@endphp
@include('layouts.header')

<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "Organization",
    "name": "MVP.N (Muda Visioner Penggerak Nasional)",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('assets/img/mvpn.png') }}",
    "description": {!! json_encode(__('site.meta.description')) !!},
    "foundingDate": "2023",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "Sukabumi",
        "addressCountry": "ID"
    }
}
</script>

@php
    $galleries = \Illuminate\Support\Facades\Cache::remember('home.galleries', 3600, fn () => App\Models\Gallery::orderBy('order')->latest('id')->take(3)->get());
    $galleriesTotal = \Illuminate\Support\Facades\Cache::remember('home.galleries.total', 3600, fn () => App\Models\Gallery::count());
@endphp

<style>
html {
    scroll-behavior: smooth;
}
</style>

{{-- ======================= BERANDA ======================= --}}
<style>
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero {
    min-height: 70vh; /* aman, ga ketiban header */
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.hero-inner h1 {
    opacity: 0;
    animation: fadeUp 1s ease-out forwards;
}

.hero-inner p {
    opacity: 0;
    animation: fadeUp 1s ease-out forwards;
    animation-delay: 0.3s;
}

.global-map {
    position: relative;
    height: 100vh;
    background: linear-gradient(180deg, var(--color-navy-900) 0%, var(--color-navy-700) 100%);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.map-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.35;
    filter: grayscale(100%) contrast(1.1);
}

.map-overlay {
    position: absolute;
    text-align: center;
    color: #fff;
    z-index: 2;
    animation: fadeUp 1s ease forwards;
    padding: 0 16px;
}

.map-title {
    font-size: clamp(40px, 7vw, 76px);
    font-weight: 800;
    letter-spacing: 1px;
    line-height: 1.05;
}

.map-subtitle {
    margin-top: 12px;
    font-size: clamp(12px, 2.5vw, 18px);
    letter-spacing: clamp(1px, 0.6vw, 3px);
    text-transform: uppercase;
    opacity: 0.85;
    padding: 0 16px;
}

.hero-stats-strip {
    position: relative;
    z-index: 5;
    max-width: 980px;
    margin: -64px auto 0;
    padding: 0 20px;
}

@media (max-width: 767.98px) {
    .hero-stats-strip {
        margin-top: -40px;
    }
}

.hero-stats {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: clamp(12px, 3vw, 20px);
    background: #fff;
    border-radius: var(--radius-lg, 22px);
    box-shadow: var(--shadow-lg);
    padding: clamp(20px, 4vw, 32px);
}

.hero-stat {
    flex: 1 1 140px;
    text-align: center;
    padding: clamp(10px, 2vw, 16px) clamp(12px, 2vw, 20px);
    border-radius: var(--radius-md, 16px);
    transition: transform .3s var(--ease-material, ease), background .3s;
}

.hero-stat:hover {
    transform: translateY(-4px);
    background: var(--color-primary-50);
}

.hero-stat-value {
    font-family: var(--font-display);
    font-weight: 800;
    font-size: clamp(1.8rem, 4vw, 2.6rem);
    color: var(--color-primary-500);
    line-height: 1;
}

.hero-stat-label {
    margin-top: 8px;
    font-size: clamp(0.7rem, 1.4vw, 0.82rem);
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--color-navy-500);
    font-weight: 600;
}

.hero-cta {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 16px;
    margin-top: clamp(28px, 4vw, 40px);
}

.hero-cta .btn-outline-material {
    color: #fff;
    border: 1.5px solid rgba(255,255,255,0.55);
}

.hero-cta .btn-outline-material:hover {
    background: rgba(255,255,255,0.12);
    border-color: #fff;
    color: #fff;
    transform: translateY(-3px);
}

@media (max-width: 991.98px) {
    .global-map {
        height: 90vh;
    }
}

@media (max-width: 575.98px) {
    .global-map {
        height: 80vh;
    }
}

@media (max-width: 575.98px) and (max-height: 600px) {
    .global-map {
        height: auto;
        min-height: 100vh;
        padding: 90px 0 40px;
    }
}

.global-map::after {
    content: '';
    position: absolute;
    width: 14px;
    height: 14px;
    background: var(--color-gold-500);
    border-radius: 50%;
    box-shadow: 0 0 25px rgba(212,160,23,0.9);
    bottom: 38%;
    right: 22%;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.6); opacity: 0.5; }
    100% { transform: scale(1); opacity: 1; }
}

.font {
    font-family: 'Poppins', sans-serif;
    font-weight: 650;
}
</style>

<section id="beranda" class="global-map">
    <div class="map-overlay">
        <h1 class="map-title reveal-stagger"><x-stagger-words :text="__('site.home.hero_title')" /></h1>
        <p class="map-subtitle">{{ __('site.home.hero_subtitle') }}</p>

        <div class="hero-cta">
            <a href="{{ request()->routeIs('index1') ? '#kerjasama' : '/#kerjasama' }}" class="btn-gradient">{{ __('site.home.cta_primary') }} <i class="bi bi-arrow-right"></i></a>
            <a href="{{ request()->routeIs('index1') ? '#proker' : '/#proker' }}" class="btn-outline-material">{{ __('site.home.cta_secondary') }}</a>
        </div>
    </div>

    <img
        src="{{ asset('assets/img/peta.png') }}"
        alt="Indonesia Global Map"
        class="map-image"
    >
</section>

<div class="hero-stats-strip">
    <div class="hero-stats">
        <div class="hero-stat">
            <div class="hero-stat-value">{{ __('site.home.stat_1_value') }}</div>
            <div class="hero-stat-label">{{ __('site.home.stat_1_label') }}</div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-value">{{ __('site.home.stat_2_value') }}</div>
            <div class="hero-stat-label">{{ __('site.home.stat_2_label') }}</div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-value">{{ __('site.home.stat_3_value') }}</div>
            <div class="hero-stat-label">{{ __('site.home.stat_3_label') }}</div>
        </div>
    </div>
</div>

{{-- ======================= TENTANG ======================= --}}
<style>
.tentang-title {
    font-size: clamp(1.8rem, 5vw, 3rem);
    font-weight: bold;
    color: #333;
}

.tentang-text {
    font-size: clamp(1rem, 2.2vw, 1.2rem);
    color: #555;
    line-height: 1.6;
    text-align: justify;
}

@media (max-width: 767.98px) {
    .tentang-text {
        text-align: left;
    }
}

.tentang-logo-wrap {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: clamp(30px, 6vw, 60px);
}

.tentang-logo-wrap::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle, var(--color-primary-50) 0%, rgba(253,236,236,0) 72%);
    border-radius: 50%;
    z-index: 0;
}

.tentang-logo {
    position: relative;
    z-index: 1;
    max-width: 100%;
    height: auto;
    width: 420px;
    filter: drop-shadow(0 20px 40px rgba(18,35,59,0.14));
}

@media (max-width: 575.98px) {
    .tentang-logo {
        width: 220px;
    }
}
</style>

<section id="tentang" class="py-5">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-7 reveal">
                @php
                    $about = \Illuminate\Support\Facades\Cache::remember('home.about', 3600, fn () => \App\Models\About::singleton());
                @endphp
                <span class="section-eyebrow">{{ __('site.nav.tentang') }}</span>
                <h2 class="tentang-title mb-4 reveal-stagger"><x-stagger-words :text="__('site.tentang.title')" /></h2>
                <p class="tentang-text">{{ $about->translated('paragraph_1') ?: __('site.tentang.p1') }}</p>
                <p class="tentang-text">{{ $about->translated('paragraph_2') ?: __('site.tentang.p2') }}</p>
                <p class="tentang-text">{{ $about->translated('paragraph_3') ?: __('site.tentang.p3') }}</p>
            </div>

            <div class="col-md-5 text-center reveal reveal-delay-2">
                <div class="tentang-logo-wrap">
                    <img src="{{ asset('assets/img/mvpn.png') }}"
                         alt="Logo"
                         loading="lazy"
                         class="tentang-logo">
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ======================= VISI & MISI ======================= --}}
<style>
.visimisi-title {
    font-size: clamp(1.8rem, 5vw, 3rem);
}

/* Contrast-block pairing: dark Visi panel + light Misi panel, same scale */
.vm-panel {
    height: 100%;
    border-radius: var(--radius-lg, 22px);
    padding: clamp(2rem, 4vw, 2.75rem);
    transition: transform .35s var(--ease-material, ease), box-shadow .35s var(--ease-material, ease);
}

.vm-panel:hover {
    transform: translateY(-6px);
}

.vm-label {
    display: inline-block;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 18px;
}

/* Visi panel: dark gradient, single decorative glow, no clutter */
.visi-panel {
    position: relative;
    overflow: hidden;
    background: linear-gradient(155deg, var(--color-navy-700), var(--color-navy-900));
    color: #fff;
    box-shadow: 0 20px 44px rgba(5,9,15,0.28);
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.visi-panel::after {
    content: '';
    position: absolute;
    width: 260px;
    height: 260px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(212,160,23,0.22), rgba(212,160,23,0) 70%);
    top: -60px;
    right: -60px;
    pointer-events: none;
}

.visi-panel .vm-label {
    color: var(--color-gold-500);
}

.visi-panel-text {
    position: relative;
    z-index: 1;
    font-size: clamp(1.35rem, 2.4vw, 1.85rem);
    font-weight: 700;
    line-height: 1.4;
    margin: 0;
}

/* Misi panel: light card with numbered checklist */
.misi-panel {
    background-color: #fff;
    box-shadow: var(--shadow-sm);
}

.misi-panel:hover {
    box-shadow: var(--shadow-lg);
}

.misi-panel .vm-label {
    color: var(--color-primary-600);
}

.misi-list {
    list-style: none;
    padding: 0;
    margin: 0;
    counter-reset: misi-counter;
}

.misi-list li {
    counter-increment: misi-counter;
    position: relative;
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 12px 4px;
    border-radius: 10px;
    font-size: clamp(0.95rem, 1.8vw, 1.05rem);
    line-height: 1.55;
    color: #444;
    transition: background .25s var(--ease-material, ease), padding-left .25s var(--ease-material, ease);
}

.misi-list li + li {
    border-top: 1px solid #eee;
}

.misi-list li:hover {
    background: var(--color-primary-50);
    padding-left: 10px;
}

.misi-list li::before {
    content: counter(misi-counter);
    flex: 0 0 auto;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    font-weight: 700;
    color: #fff;
    background: var(--color-primary-500);
}
</style>

@php
    $visiMisi = \Illuminate\Support\Facades\Cache::remember('home.visimisi', 3600, fn () => \App\Models\VisiMisi::singleton());
    $misiItems = \Illuminate\Support\Facades\Cache::remember('home.misiitems', 3600, fn () => \App\Models\MisiItem::orderBy('order')->get());
@endphp
<section id="visimisi" class="section-tint py-5">
    <div class="container">
        <div class="text-center reveal">
            <span class="section-eyebrow">{{ __('site.nav.visi_misi') }}</span>
            <h2 class="fw-bold mb-5 visimisi-title reveal-stagger"><x-stagger-words :text="__('site.visimisi.title')" /></h2>
        </div>

        <div class="row g-4 align-items-stretch">

            <!-- Visi -->
            <div class="col-md-6">
                <div class="vm-panel visi-panel reveal-left">
                    <span class="vm-label">{{ __('site.visimisi.visi_label') }}</span>
                    <p class="visi-panel-text">{{ $visiMisi->translated('visi_text') ?: __('site.visimisi.visi_text') }}</p>
                </div>
            </div>

            <!-- Misi -->
            <div class="col-md-6">
                <div class="vm-panel misi-panel reveal-right">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <span class="vm-label mb-0">{{ __('site.visimisi.misi_label') }}</span>
                        <div class="icon-badge icon-badge-navy" style="margin-bottom:0"><i class="bi bi-rocket-takeoff-fill"></i></div>
                    </div>
                    <ul class="misi-list reveal-stagger">
                        @forelse($misiItems as $item)
                            <li class="stagger-item" style="--i:{{ $loop->index }}">{{ $item->translated('text') }}</li>
                        @empty
                            <li class="stagger-item" style="--i:0">{{ __('site.visimisi.misi_1') }}</li>
                            <li class="stagger-item" style="--i:1">{{ __('site.visimisi.misi_2') }}</li>
                            <li class="stagger-item" style="--i:2">{{ __('site.visimisi.misi_3') }}</li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ======================= STRUKTUR ======================= --}}
<style>
.struktur-page {
    padding-top: 60px;
}

.struktur-wrapper {
    max-width: 920px;
    margin: 0 auto;
}

@media (max-width: 575.98px) {
    .struktur-page {
        padding-top: 40px;
    }

    .accordion-button {
        padding: 14px 16px;
        font-size: 0.95rem;
    }

    .member-photo {
        height: 220px;
    }

    .member-info {
        padding: 14px;
    }
}

.accordion-item {
    border: none;
    margin-bottom: 16px;
    border-radius: var(--radius-md, 16px);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.accordion-button {
    font-weight: 700;
    padding: 18px 24px;
    background: #fff;
    transition: 0.3s;
}

.accordion-button:not(.collapsed) {
    background: var(--color-navy-50);
    color: var(--color-navy-900);
}

.accordion-body {
    animation: fadeSlide 0.6s ease;
}

.member-card {
    background: #fff;
    border: 1px solid #e4e4e4;
    border-radius: var(--radius-md, 16px);
    overflow: hidden;
    transition: 0.35s var(--ease-material, ease);
    box-shadow: var(--shadow-sm);
}

.member-card:hover {
    border-color: var(--color-primary-300);
    transform: translateY(-6px);
    box-shadow: var(--shadow-lg);
}

.member-info::before {
    content: "";
    display: block;
    width: 36px;
    height: 3px;
    background: var(--color-gold-500);
    margin: 0 auto 12px;
}

.member-photo {
    width: 100%;
    height: 280px;
    object-fit: contain;
    object-position: center top;
    background: #f2f2f2;
}

.member-info {
    padding: 18px;
    text-align: center;
}

.member-info h4 {
    font-weight: 700;
    margin-bottom: 4px;
    font-size: 1.25rem;
}

.member-info p {
    color: #777;
    margin-bottom: 10px;
}

.ig-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: linear-gradient(45deg, #feda75, #d62976, #4f5bd5);
    color: #fff;
    font-size: 1.1rem;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.ig-btn:hover {
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 6px 14px rgba(214,41,118,0.35);
}

.member-socials {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.li-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #0A66C2;
    color: #fff;
    font-size: 1.1rem;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.li-btn:hover {
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 6px 14px rgba(10,102,194,0.35);
}

@keyframes fadeSlide {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

@php
    $pengurusBySection = \Illuminate\Support\Facades\Cache::remember('home.pengurus', 3600, fn () => \App\Models\Pengurus::orderBy('section')->orderBy('order')->get()->groupBy('section'));
    $strukturSectionLabels = [
        'bod' => __('site.struktur.bod'),
        'sekretaris' => __('site.struktur.sekretaris_section'),
        'ekonomi' => __('site.struktur.ekonomi_section'),
        'internasional' => __('site.struktur.internasional_section'),
        'kerjasama_id_jerman' => __('site.struktur.kerjasama_id_jerman_section'),
        'itdev' => __('site.struktur.itdev_section'),
    ];
@endphp

<section id="struktur" class="container py-5 struktur-page">
    <div class="text-center reveal">
        <span class="section-eyebrow">{{ __('site.nav.struktur') }}</span>
        <h2 class="fw-bold mb-5 reveal-stagger"><x-stagger-words :text="__('site.struktur.title')" /></h2>
    </div>

    <div class="struktur-wrapper reveal">
        <div class="accordion" id="strukturAccordion">
            @php $firstOpened = false; @endphp
            @foreach(\App\Models\Pengurus::SECTIONS as $sectionKey => $fallbackLabel)
                @php $members = $pengurusBySection->get($sectionKey, collect()); @endphp
                @continue($members->isEmpty())
                @php $isFirst = ! $firstOpened; $firstOpened = true; @endphp

                <div class="accordion-item">
                    <h3 class="accordion-header">
                        <button class="accordion-button @unless($isFirst) collapsed @endunless" data-bs-toggle="collapse" data-bs-target="#{{ $sectionKey }}">
                            {{ $strukturSectionLabels[$sectionKey] ?? $fallbackLabel }}
                        </button>
                    </h3>
                    <div id="{{ $sectionKey }}" class="accordion-collapse collapse @if($isFirst) show @endif" data-bs-parent="#strukturAccordion">
                        <div class="accordion-body">
                            <div class="row justify-content-center g-4">
                                @foreach($members as $member)
                                    <div class="col-12 col-sm-8 col-md-5">
                                        <div class="member-card">
                                            @if($member->photo)
                                                <img class="member-photo" src="{{ $member->photo }}" alt="{{ $member->name }}" loading="lazy">
                                            @else
                                                <div class="member-photo d-flex align-items-center justify-content-center text-uppercase fw-bold" style="font-size:2.5rem;color:#bbb;">
                                                    {{ substr($member->name, 0, 1) }}
                                                </div>
                                            @endif
                                            <div class="member-info">
                                                <h4>{{ $member->name }}</h4>
                                                <p>{{ $member->position }}</p>
                                                <div class="member-socials">
                                                    @if($member->instagram_url)
                                                        <a href="{{ $member->instagram_url }}" class="ig-btn" title="{{ __('site.struktur.instagram') }}" target="_blank" rel="noopener"><i class="bi bi-instagram"></i></a>
                                                    @endif
                                                    @if($member->linkedin_url)
                                                        <a href="{{ $member->linkedin_url }}" class="li-btn" title="{{ __('site.struktur.linkedin') }}" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ======================= PROKER ======================= --}}
<style>
.proker-wrapper {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 20px;
}

.proker-title {
    text-align: center;
    font-size: clamp(1.8rem, 5vw, 3rem);
    font-weight: 700;
}

@media (max-width: 575.98px) {
    .proker-wrapper {
        padding: 0 16px;
    }
}

.proker-shell {
    margin-top: 40px;
}

/* Segmented pill tab bar */
.proker-tabbar {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 8px;
    background: #fff;
    border: 1px solid #e9e9e9;
    border-radius: 999px;
    padding: 6px;
    max-width: fit-content;
    margin: 0 auto;
    box-shadow: var(--shadow-sm);
}

@media (max-width: 575.98px) {
    .proker-tabbar-wrap {
        position: relative;
        margin: 0 -16px;
        padding: 0 16px;
    }

    .proker-tabbar-wrap::after {
        content: "";
        position: absolute;
        top: 0;
        right: 16px;
        bottom: 0;
        width: 36px;
        border-radius: 0 var(--radius-md, 16px) var(--radius-md, 16px) 0;
        background: linear-gradient(to right, rgba(255, 255, 255, 0), #fff 70%);
        pointer-events: none;
    }

    .proker-tabbar {
        max-width: 100%;
        border-radius: var(--radius-md, 16px);
        justify-content: flex-start;
        overflow-x: auto;
        flex-wrap: nowrap;
        scroll-snap-type: x proximity;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .proker-tabbar::-webkit-scrollbar {
        display: none;
    }

    .proker-pill {
        scroll-snap-align: start;
        padding: 9px 16px;
        font-size: 0.85rem;
    }
}

.proker-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
    border: none;
    background: transparent;
    color: #555;
    font-weight: 600;
    font-size: 0.9rem;
    padding: 10px 20px;
    border-radius: 999px;
    transition: background .25s var(--ease-material, ease), color .25s var(--ease-material, ease);
}

.proker-pill:hover {
    color: var(--color-primary-600);
}

.proker-pill.active {
    background: var(--color-primary-500);
    color: #fff;
}

/* Content panel — single cohesive card under the tab bar */
.proker-panel {
    background: #fff;
    border-radius: var(--radius-lg, 22px);
    box-shadow: var(--shadow-sm);
    padding: clamp(2rem, 4vw, 2.75rem);
    margin-top: 20px;
}

.proker-panel-desc {
    color: #666;
    font-size: 1rem;
    margin-bottom: 20px;
}

.tab-content {
    display: none;
    opacity: 0;
    transform: translateY(10px);
    transition: opacity .25s var(--ease-material, ease), transform .25s var(--ease-material, ease);
}

.tab-content.active {
    display: block;
}

.tab-content.tab-in {
    opacity: 1;
    transform: translateY(0);
}

.checklist {
    list-style: none;
    padding-left: 0;
}

.checklist > li {
    position: relative;
    padding-left: 32px;
    margin-bottom: 12px;
}

.checklist > li::before {
    content: "\2713";
    position: absolute;
    left: 0;
    top: 1px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: var(--color-primary-500);
    color: #fff;
    font-size: 0.65rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
}

.checklist > li .proker-item-desc {
    display: block;
    margin-top: 4px;
    font-size: 0.85rem;
    font-weight: 400;
    color: var(--color-neutral-500, #6b7280);
}
.checklist > li .proker-item-desc p {
    margin: 0 0 6px;
}
.checklist > li .proker-item-desc p:last-child {
    margin-bottom: 0;
}
.checklist > li .proker-item-desc ul,
.checklist > li .proker-item-desc ol {
    margin: 4px 0 6px;
    padding-left: 1.25em;
}
.checklist > li .proker-item-desc li {
    margin-bottom: 2px;
}

/* Language tags — pill grid instead of a nested bullet list */
.lang-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 10px;
}

.lang-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    font-weight: 500;
    font-family: inherit;
    color: var(--color-navy-700);
    background: var(--color-navy-50);
    border: 1px solid transparent;
    border-radius: 999px;
    padding: 6px 14px;
    cursor: pointer;
    transition: background-color .15s ease, border-color .15s ease;
}

button.lang-pill:hover,
button.lang-pill:focus-visible {
    background: var(--color-navy-100, #dbe4f0);
    border-color: var(--color-gold-500, #c9a227);
}

.lang-pill-soon {
    color: #999;
    background: transparent;
    border: 1px dashed #ccc;
}

.lang-pill-soon .lang-pill-tag {
    font-size: 0.68rem;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: var(--color-gold-600);
}

.soon-badge {
    display: inline-block;
    margin-left: 8px;
    padding: 2px 10px;
    border: 1px dashed #ccc;
    border-radius: 999px;
    font-size: 0.68rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: var(--color-gold-600);
    vertical-align: middle;
}
</style>

@php
    $kegiatans = \Illuminate\Support\Facades\Cache::remember('home.kegiatans', 3600, fn () => \App\Models\Kegiatan::orderBy('category')->orderBy('order')->get()->groupBy('category'));
    $languageCoordinators = \Illuminate\Support\Facades\Cache::remember('home.language_coordinators', 3600, fn () => \App\Models\LanguageClassCoordinator::orderBy('language')->orderBy('order')->get()->groupBy('language'));
    $languageCoordinatorsJson = collect(\App\Models\LanguageClassCoordinator::LANGUAGES)->mapWithKeys(function ($label, $key) use ($languageCoordinators) {
        $members = $languageCoordinators->get($key, collect());

        return [$key => [
            'label' => $label,
            'certificate' => optional($members->first(fn ($p) => $p->certificate))->certificate,
            'people' => $members->map(fn ($p) => [
                'name' => $p->name,
                'role' => $p->role,
                'photo' => $p->photo,
                'period' => $p->period,
            ])->values(),
        ]];
    });
@endphp
<section id="proker" class="section-tint py-5">
    <div class="proker-wrapper">
    <div class="text-center reveal">
        <span class="section-eyebrow">{{ __('site.nav.proker') }}</span>
        <h2 class="proker-title reveal-stagger"><x-stagger-words :text="__('site.proker.title')" /></h2>
    </div>

    <div class="proker-shell reveal">
        <div class="proker-tabbar-wrap">
            <div class="proker-tabbar" role="tablist">
                <button type="button" class="proker-pill tab-btn active" data-tab="pendidikan">
                    <i class="bi bi-mortarboard-fill"></i> {{ __('site.proker.tab_pendidikan') }}
                </button>
                <button type="button" class="proker-pill tab-btn" data-tab="wirausaha">
                    <i class="bi bi-graph-up-arrow"></i> {{ __('site.proker.tab_wirausaha') }}
                </button>
                <button type="button" class="proker-pill tab-btn" data-tab="sdm">
                    <i class="bi bi-people-fill"></i> {{ __('site.proker.tab_sdm') }}
                </button>
            </div>
        </div>

        <div class="proker-panel">
            <div class="tab-content active" id="pendidikan">
                <p class="proker-panel-desc">{{ __('site.proker.card_pendidikan_desc') }}</p>
                <h2>{{ __('site.proker.pendidikan_title') }}</h2>
                <ul class="checklist">
                    @forelse($kegiatans->get('pendidikan', collect()) as $item)
                        <li>{{ $item->translatedTitle() }}@if($item->is_coming_soon) <span class="soon-badge">{{ __('site.proker.coming_soon_badge') }}</span> @endif @if($item->description)<div class="proker-item-desc">{!! $item->translatedDescriptionHtml() !!}</div>@endif</li>
                    @empty
                        <li>{{ __('site.proker.pkbm') }}</li>
                        <li>{{ __('site.proker.self_improvement') }}</li>
                    @endforelse
                        <li>{{ __('site.proker.bahasa_asing') }}
                            <div class="lang-pills">
                                <button type="button" class="lang-pill" data-language="inggris">{{ __('site.proker.lang_inggris') }}</button>
                                <button type="button" class="lang-pill" data-language="jerman">{{ __('site.proker.lang_jerman') }}</button>
                                <button type="button" class="lang-pill" data-language="prancis">{{ __('site.proker.lang_prancis') }}</button>
                                <button type="button" class="lang-pill" data-language="mandarin">{{ __('site.proker.lang_mandarin') }}</button>
                                <button type="button" class="lang-pill" data-language="arab">{{ __('site.proker.lang_arab') }}</button>
                                <button type="button" class="lang-pill" data-language="turki">{{ __('site.proker.lang_turki') }}</button>
                                <button type="button" class="lang-pill" data-language="korea">{{ __('site.proker.lang_korea') }}</button>
                                <span class="lang-pill lang-pill-soon">{{ __('site.proker.lang_thailand') }} <span class="lang-pill-tag">{{ __('site.proker.coming_soon') }}</span></span>
                                <span class="lang-pill lang-pill-soon">{{ __('site.proker.lang_isyarat') }} <span class="lang-pill-tag">{{ __('site.proker.coming_soon') }}</span></span>
                                <span class="lang-pill lang-pill-soon">{{ __('site.proker.lang_urdu') }} <span class="lang-pill-tag">{{ __('site.proker.coming_soon') }}</span></span>
                            </div>
                        </li>
                </ul>
            </div>

            <div class="tab-content" id="wirausaha">
                <p class="proker-panel-desc">{{ __('site.proker.card_wirausaha_desc') }}</p>
                <h2>{{ __('site.proker.wirausaha_title') }}</h2>
                <ul class="checklist">
                    @forelse($kegiatans->get('wirausaha', collect()) as $item)
                        <li>{{ $item->translatedTitle() }}@if($item->is_coming_soon) <span class="soon-badge">{{ __('site.proker.coming_soon_badge') }}</span> @endif @if($item->description)<div class="proker-item-desc">{!! $item->translatedDescriptionHtml() !!}</div>@endif</li>
                    @empty
                        <li>{{ __('site.proker.umkm_export') }}</li>
                        <li>{{ __('site.proker.business_matching') }}</li>
                    @endforelse
                </ul>
            </div>

            <div class="tab-content" id="sdm">
                <p class="proker-panel-desc">{{ __('site.proker.card_sdm_desc') }}</p>
                <h2>{{ __('site.proker.sdm_title') }}</h2>
                <ul class="checklist">
                    @forelse($kegiatans->get('sdm', collect()) as $item)
                        <li>{{ $item->translatedTitle() }}@if($item->is_coming_soon) <span class="soon-badge">{{ __('site.proker.coming_soon_badge') }}</span> @endif @if($item->description)<div class="proker-item-desc">{!! $item->translatedDescriptionHtml() !!}</div>@endif</li>
                    @empty
                        <li>{{ __('site.proker.sdm_1') }}</li>
                        <li>{{ __('site.proker.sdm_2') }}</li>
                        <li>{{ __('site.proker.sdm_3') }}</li>
                        <li>{{ __('site.proker.sdm_4') }}</li>
                        <li>{{ __('site.proker.sdm_5') }}</li>
                        <li>{{ __('site.proker.sdm_6') }}</li>
                        <li>{{ __('site.proker.sdm_7') }}</li>
                        <li>{{ __('site.proker.sdm_8') }}</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    </div>
</section>

{{-- ======================= PJ KELAS BAHASA (MODAL) ======================= --}}
<style>
.lang-modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(12, 22, 45, .55);
    backdrop-filter: blur(2px);
    opacity: 0;
    visibility: hidden;
    transition: opacity .25s ease, visibility 0s linear .25s;
    z-index: 1055;
}

.lang-modal-backdrop.show {
    opacity: 1;
    visibility: visible;
    transition: opacity .25s ease;
}

.lang-modal {
    position: fixed;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1056;
    width: 100%;
    max-height: 85vh;
    display: flex;
    flex-direction: column;
    background: #fff;
    border-radius: 20px 20px 0 0;
    box-shadow: 0 -10px 40px rgba(16, 33, 63, .25);
    transform: translateY(100%);
    transition: transform .3s cubic-bezier(.32, .72, 0, 1);
    padding-bottom: env(safe-area-inset-bottom, 0);
}

.lang-modal.show {
    transform: translateY(0);
}

.lang-modal-handle {
    width: 40px;
    height: 4px;
    border-radius: 999px;
    background: var(--color-navy-100, #dbe4f0);
    margin: 10px auto 0;
    flex-shrink: 0;
}

@media (min-width: 576px) {
    .lang-modal {
        left: 50%;
        right: auto;
        bottom: auto;
        top: 50%;
        width: 92vw;
        max-width: 440px;
        max-height: 82vh;
        border-radius: 18px;
        transform: translate(-50%, -46%) scale(.97);
        opacity: 0;
        transition: transform .25s ease, opacity .25s ease;
    }

    .lang-modal.show {
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
    }

    .lang-modal-handle {
        display: none;
    }
}

.lang-modal-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    border-bottom: 1px solid var(--color-navy-100, #e5e9f0);
    padding: 1rem 1.25rem;
    flex-shrink: 0;
}

.lang-modal-title {
    font-family: var(--font-display, inherit);
    color: var(--color-navy-900, #10213f);
    font-size: 1.05rem;
    font-weight: 700;
    margin: 0;
    line-height: 1.35;
}

.lang-modal-period {
    display: inline-block;
    font-size: .7rem;
    font-weight: 600;
    letter-spacing: .3px;
    color: var(--color-gold-700, #8a6a14);
    background: var(--color-gold-50, #fbf3dd);
    border-radius: 999px;
    padding: 2px 10px;
    margin-top: 6px;
}

.lang-modal-close {
    flex-shrink: 0;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: none;
    background: var(--color-navy-50, #eef2f8);
    color: var(--color-navy-700, #33507c);
    font-size: 1.1rem;
    line-height: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background-color .15s ease;
}

.lang-modal-close:hover {
    background: var(--color-navy-100, #dbe4f0);
}

.lang-modal-body {
    padding: .5rem 1.25rem 1.25rem;
    overflow-y: auto;
}

.lang-coordinator-card {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 0;
    border-bottom: 1px solid var(--color-navy-100, #eef1f6);
}

.lang-coordinator-card:last-child {
    border-bottom: none;
}

.lang-coordinator-photo {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
    border: 2px solid var(--color-gold-500, #c9a227);
}

.lang-coordinator-photo-fallback {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--color-navy-50, #eef2f8);
    color: var(--color-navy-500, #3a5a99);
    font-weight: 600;
    font-size: 1.05rem;
}

.lang-coordinator-name {
    font-weight: 600;
    color: var(--color-navy-900, #10213f);
    font-size: .92rem;
}

.lang-coordinator-role {
    font-size: .78rem;
    color: var(--color-navy-500, #5c6b85);
    margin-top: 1px;
}

.lang-coordinator-empty {
    padding: 1.75rem 0;
    text-align: center;
    color: #999;
    font-size: .88rem;
}

body.lang-modal-open {
    overflow: hidden;
}

.lang-cert-banner {
    display: flex;
    align-items: center;
    gap: 12px;
    width: calc(100% - 2.5rem);
    margin: .9rem 1.25rem 0;
    padding: 8px 12px;
    background: linear-gradient(135deg, var(--color-gold-50, #fbf3dd), #fff);
    border: 1px solid var(--color-gold-200, #ecd694);
    border-radius: 12px;
    cursor: pointer;
    text-align: left;
    font-family: inherit;
    transition: border-color .15s ease, box-shadow .15s ease, transform .15s ease;
}

.lang-cert-banner:hover {
    border-color: var(--color-gold-500, #c9a227);
    box-shadow: 0 4px 14px rgba(201, 162, 39, .18);
    transform: translateY(-1px);
}

.lang-cert-thumb {
    flex-shrink: 0;
    width: 52px;
    height: 36px;
    border-radius: 6px;
    overflow: hidden;
    border: 1px solid var(--color-gold-300, #ddc16a);
    background: #fff;
}

.lang-cert-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.lang-cert-text {
    flex: 1;
    min-width: 0;
}

.lang-cert-label {
    display: block;
    font-size: .82rem;
    font-weight: 700;
    color: var(--color-navy-900, #10213f);
}

.lang-cert-sub {
    display: block;
    font-size: .72rem;
    color: var(--color-navy-500, #5c6b85);
    margin-top: 1px;
}

.lang-cert-icon {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: var(--color-gold-500, #c9a227);
    color: #fff;
}

.lang-cert-lightbox {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 1070;
    background: rgba(8, 14, 28, .85);
    padding: 24px;
    align-items: center;
    justify-content: center;
}

.lang-cert-lightbox.is-open {
    display: flex;
}

.lang-cert-lightbox-box {
    position: relative;
    max-width: 900px;
    width: 100%;
    max-height: 90vh;
}

.lang-cert-lightbox-img {
    width: 100%;
    height: 100%;
    max-height: 90vh;
    object-fit: contain;
    border-radius: 10px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, .45);
}

.lang-cert-lightbox-close {
    position: absolute;
    top: -14px;
    right: -14px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: none;
    background: #fff;
    font-size: 20px;
    line-height: 1;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .25);
}
</style>

<div class="lang-modal-backdrop" id="lang-offcanvas-backdrop"></div>
<div class="lang-modal" id="lang-offcanvas" role="dialog" aria-modal="true" tabindex="-1" aria-labelledby="lang-offcanvas-label">
    <div class="lang-modal-handle"></div>
    <div class="lang-modal-header">
        <h5 class="lang-modal-title" id="lang-offcanvas-label">
            <span id="lang-offcanvas-name">Penanggung Jawab Kelas Bahasa</span>
            <span id="lang-offcanvas-period" class="lang-modal-period" hidden></span>
        </h5>
        <button type="button" class="lang-modal-close" id="lang-offcanvas-close" aria-label="Tutup">&times;</button>
    </div>
    <button type="button" class="lang-cert-banner" id="lang-offcanvas-cert" hidden>
        <span class="lang-cert-thumb"><img id="lang-offcanvas-cert-thumb" src="" alt="Sertifikat kelulusan"></span>
        <span class="lang-cert-text">
            <span class="lang-cert-label">Sertifikat Kelulusan Tim</span>
            <span class="lang-cert-sub">Ketuk untuk melihat ukuran penuh</span>
        </span>
        <span class="lang-cert-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
        </span>
    </button>
    <div class="lang-modal-body" id="lang-offcanvas-body"></div>
</div>

<div class="lang-cert-lightbox" id="lang-cert-lightbox">
    <div class="lang-cert-lightbox-box">
        <button type="button" class="lang-cert-lightbox-close" id="lang-cert-lightbox-close" aria-label="Tutup">&times;</button>
        <img class="lang-cert-lightbox-img" id="lang-cert-lightbox-img" src="" alt="Sertifikat kelulusan">
    </div>
</div>

<script>
(function () {
    var languageData = @json($languageCoordinatorsJson);
    var modalEl = document.getElementById('lang-offcanvas');
    var backdropEl = document.getElementById('lang-offcanvas-backdrop');
    if (!modalEl || !backdropEl) return;

    var nameEl = document.getElementById('lang-offcanvas-name');
    var periodEl = document.getElementById('lang-offcanvas-period');
    var bodyEl = document.getElementById('lang-offcanvas-body');
    var closeBtn = document.getElementById('lang-offcanvas-close');
    var certBanner = document.getElementById('lang-offcanvas-cert');
    var certThumb = document.getElementById('lang-offcanvas-cert-thumb');
    var certLightbox = document.getElementById('lang-cert-lightbox');
    var certLightboxImg = document.getElementById('lang-cert-lightbox-img');
    var certLightboxClose = document.getElementById('lang-cert-lightbox-close');

    function openCertLightbox(src) {
        certLightboxImg.src = src;
        certLightbox.classList.add('is-open');
    }

    function closeCertLightbox() {
        certLightbox.classList.remove('is-open');
    }

    certLightboxClose.addEventListener('click', closeCertLightbox);
    certLightbox.addEventListener('click', function (e) {
        if (e.target === certLightbox) closeCertLightbox();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && certLightbox.classList.contains('is-open')) closeCertLightbox();
    });

    function openModal() {
        modalEl.classList.add('show');
        backdropEl.classList.add('show');
        document.body.classList.add('lang-modal-open');
    }

    function closeModal() {
        modalEl.classList.remove('show');
        backdropEl.classList.remove('show');
        document.body.classList.remove('lang-modal-open');
    }

    closeBtn.addEventListener('click', closeModal);
    backdropEl.addEventListener('click', closeModal);
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modalEl.classList.contains('show') && !certLightbox.classList.contains('is-open')) closeModal();
    });

    document.querySelectorAll('.lang-pill[data-language]').forEach(function (pill) {
        pill.addEventListener('click', function () {
            var lang = pill.dataset.language;
            var entry = languageData[lang];

            nameEl.textContent = 'Penanggung Jawab Kelas Bahasa ' + (entry ? entry.label : '');

            var people = entry ? entry.people : [];
            if (people.length && people[0].period) {
                periodEl.textContent = 'Periode ' + people[0].period;
                periodEl.hidden = false;
            } else {
                periodEl.hidden = true;
            }

            if (entry && entry.certificate) {
                certThumb.src = entry.certificate;
                certBanner.hidden = false;
                certBanner.onclick = function () { openCertLightbox(entry.certificate); };
            } else {
                certBanner.hidden = true;
                certBanner.onclick = null;
            }

            bodyEl.innerHTML = '';

            if (!people.length) {
                var empty = document.createElement('div');
                empty.className = 'lang-coordinator-empty';
                empty.textContent = 'Belum ada penanggung jawab untuk kelas ini.';
                bodyEl.appendChild(empty);
            } else {
                people.forEach(function (person) {
                    var card = document.createElement('div');
                    card.className = 'lang-coordinator-card';

                    var photoEl;
                    if (person.photo) {
                        photoEl = document.createElement('img');
                        photoEl.className = 'lang-coordinator-photo';
                        photoEl.src = person.photo;
                        photoEl.alt = person.name;
                    } else {
                        photoEl = document.createElement('span');
                        photoEl.className = 'lang-coordinator-photo-fallback';
                        photoEl.textContent = person.name.charAt(0).toUpperCase();
                    }

                    var info = document.createElement('div');
                    var nameLine = document.createElement('div');
                    nameLine.className = 'lang-coordinator-name';
                    nameLine.textContent = person.name;
                    var roleLine = document.createElement('div');
                    roleLine.className = 'lang-coordinator-role';
                    roleLine.textContent = person.role;
                    info.appendChild(nameLine);
                    info.appendChild(roleLine);

                    card.appendChild(photoEl);
                    card.appendChild(info);
                    bodyEl.appendChild(card);
                });
            }

            openModal();
        });
    });
})();
</script>

{{-- ======================= GALERI / DOKUMENTASI ======================= --}}
<style>
.gallery-section {
    padding: 80px 0;
    background: #fff;
}

@media (max-width: 575.98px) {
    .gallery-section {
        padding: 50px 0;
    }
}

.gallery-container {
    max-width: 1100px;
    margin: auto;
    padding: 0 20px;
}

.gallery-title {
    text-align: center;
    font-weight: 700;
    font-size: 32px;
    margin-bottom: 8px;
}

.gallery-title-line {
    width: 60px;
    height: 4px;
    background: #000;
    margin: 0 auto 50px;
    border-radius: 2px;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 28px;
}

@media (max-width: 400px) {
    .gallery-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}

.gallery-card {
    display: flex;
    flex-direction: column;
    height: 100%;
    background: #fff;
    border-radius: var(--radius-md, 16px);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: .35s var(--ease-material, ease);
    cursor: pointer;
}

.gallery-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-lg);
}

.gallery-img {
    aspect-ratio: 4 / 3;
    overflow: hidden;
    background: #f2f2f2;
}

.gallery-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: .4s ease;
}

.gallery-card:hover img {
    transform: scale(1.06);
}

.gallery-title-line {
    background: linear-gradient(90deg, var(--color-primary-500), var(--color-gold-500));
}

.gallery-body {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding: 18px 20px;
}

.gallery-body h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 6px;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;
}

.gallery-body p {
    font-size: 14px;
    color: #666;
    margin: 0;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
    overflow: hidden;
}

.btn-outline-gallery {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 28px;
    border: 1.5px solid var(--color-primary-500, #000);
    color: var(--color-primary-500, #000);
    font-weight: 600;
    font-size: 14px;
    border-radius: 999px;
    transition: .3s var(--ease-material, ease);
}

.btn-outline-gallery:hover {
    background: var(--color-primary-500, #000);
    color: #fff;
}

.home-gallery-lightbox {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 1050;
    background: rgba(0, 0, 0, 0.8);
    padding: 24px;
    align-items: center;
    justify-content: center;
}

.home-gallery-lightbox.is-open {
    display: flex;
}

.home-gallery-lightbox-box {
    position: relative;
    background: #fff;
    border-radius: 14px;
    overflow: hidden;
    max-width: 720px;
    width: 100%;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
}

.home-gallery-lightbox-img {
    width: 100%;
    max-height: 60vh;
    background: #f2f2f2;
    object-fit: contain;
}

.home-gallery-lightbox-body {
    padding: 20px 24px;
    overflow-y: auto;
}

.home-gallery-lightbox-body h5 {
    font-weight: 700;
    font-size: 20px;
    margin-bottom: 8px;
}

.home-gallery-lightbox-body p {
    font-size: 14px;
    color: #555;
    line-height: 1.6;
    margin: 0;
    white-space: pre-line;
}

.home-gallery-lightbox-close {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: none;
    background: rgba(255, 255, 255, 0.9);
    font-size: 20px;
    line-height: 1;
    cursor: pointer;
}

.home-gallery-lightbox-close:hover {
    background: #fff;
}
</style>

<section id="dokumentasi" class="gallery-section">
    <div class="gallery-container">
        <div class="text-center reveal">
            <span class="section-eyebrow">{{ __('site.nav.galeri') }}</span>
            <h2 class="gallery-title reveal-stagger"><x-stagger-words :text="__('site.dokumentasi.title')" /></h2>
            <div class="gallery-title-line"></div>
        </div>

        <div class="gallery-grid">
@foreach($galleries as $item)
    <div class="gallery-card reveal reveal-delay-{{ ($loop->index % 5) + 1 }}"
         onclick="openHomeGalleryLightbox({{ Js::from($item->image) }}, {{ Js::from($item->translatedTitle() ?? __('site.dokumentasi.default_title')) }}, {{ Js::from($item->translatedDescriptionPlain()) }})">
        <div class="gallery-img">
            <img src="{{ $item->image }}" alt="{{ $item->translatedTitle() }}" loading="lazy">
        </div>
        <div class="gallery-body">
            <h3>{{ $item->translatedTitle() ?? __('site.dokumentasi.default_title') }}</h3>
            <p>{{ \Illuminate\Support\Str::limit($item->translatedDescriptionPlain(), 120) }}</p>
        </div>
    </div>
@endforeach
        </div>

        @if($galleriesTotal > 3)
            <div class="text-center reveal" style="margin-top: 40px;">
                <a href="{{ route('galeri.index') }}" class="btn-outline-gallery">
                    {{ __('site.dokumentasi.view_all') }}
                </a>
            </div>
        @endif
    </div>
</section>

<div class="home-gallery-lightbox" id="homeGalleryLightbox" onclick="if(event.target === this) closeHomeGalleryLightbox()">
    <div class="home-gallery-lightbox-box">
        <button type="button" class="home-gallery-lightbox-close" onclick="closeHomeGalleryLightbox()" aria-label="Tutup">&times;</button>
        <img class="home-gallery-lightbox-img" id="homeGalleryLightboxImg" src="" alt="">
        <div class="home-gallery-lightbox-body">
            <h5 id="homeGalleryLightboxTitle"></h5>
            <p id="homeGalleryLightboxDescription"></p>
        </div>
    </div>
</div>

<script>
    function openHomeGalleryLightbox(image, title, description) {
        document.getElementById('homeGalleryLightboxImg').src = image;
        document.getElementById('homeGalleryLightboxImg').alt = title;
        document.getElementById('homeGalleryLightboxTitle').textContent = title;
        document.getElementById('homeGalleryLightboxDescription').textContent = description || '';
        document.getElementById('homeGalleryLightbox').classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function closeHomeGalleryLightbox() {
        document.getElementById('homeGalleryLightbox').classList.remove('is-open');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeHomeGalleryLightbox();
    });
</script>

{{-- ======================= KEMITRAAN ======================= --}}
{{-- Judul+deskripsi center di atas, lalu tiap kategori jadi baris:
     label kategori di kiri, SEMUA logo mitra kategori itu di kanan
     (tidak dipotong), reveal berjenjang per baris saat discroll. --}}
@php
    $mitraCategories = \Illuminate\Support\Facades\Cache::remember('home.mitra', 3600, fn () => \App\Models\Mitra::orderBy('category')->orderBy('order')->get()
        ->groupBy('category')
        ->map(fn ($items, $key) => ['key' => $key, 'logos' => $items])
        ->values());
@endphp
<style>
.mitra-heading {
    font-size: clamp(1.8rem, 4vw, 2.6rem);
    font-weight: 800;
    margin: 14px 0 16px;
}

.mitra-intro {
    max-width: 560px;
    margin: 0 auto 20px;
}

.mitra-desc {
    color: #666;
    font-size: 1rem;
    line-height: 1.65;
}

.mitra-list {
    margin-top: 44px;
}

.mitra-row {
    display: grid;
    grid-template-columns: 240px 1fr;
    gap: 32px;
    align-items: start;
    padding: 34px 0;
}

.mitra-row-label {
    position: sticky;
    top: 110px;
}

@media (max-width: 991.98px) {
    .mitra-row {
        grid-template-columns: 160px 1fr;
    }
}

.mitra-row + .mitra-row {
    border-top: 1px solid rgba(0,0,0,0.07);
}

@media (max-width: 767.98px) {
    .mitra-row {
        grid-template-columns: 1fr;
        gap: 14px;
        padding: 20px 0;
    }

    .mitra-row-label {
        position: static;
    }
}

@media (max-width: 575.98px) {
    .mitra-list {
        margin-top: 28px;
    }

    .mitra-row {
        padding: 16px 0;
    }

    .mitra-row-count {
        margin-bottom: 2px;
    }
}

.mitra-row-label h3 {
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 4px;
}

.mitra-row-count {
    font-size: 0.8rem;
    color: #999;
}

.mitra-row-logos {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
}

.mitra-logo {
    width: 128px;
    height: 86px;
    flex: 0 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border-radius: 14px;
    box-shadow: var(--shadow-sm);
    padding: 14px;
    transition: transform .25s var(--ease-material, ease), box-shadow .25s var(--ease-material, ease);
}

a.mitra-logo {
    cursor: pointer;
    text-decoration: none;
}

.mitra-logo:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

.mitra-logo img {
    max-width: 82%;
    max-height: 82%;
    object-fit: contain;
    filter: grayscale(45%);
    opacity: 0.85;
    transition: filter .25s var(--ease-material, ease), opacity .25s var(--ease-material, ease);
}

.mitra-logo:hover img {
    filter: grayscale(0);
    opacity: 1;
}

@media (max-width: 575.98px) {
    .mitra-row-logos {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .mitra-logo {
        width: 100%;
        height: 66px;
        padding: 10px;
    }
}
</style>

<section id="mitra" class="section-tint py-5">
    <div class="container">
        <div class="text-center reveal mitra-intro">
            <span class="section-eyebrow">{{ __('site.nav.kemitraan') }}</span>
            <h2 class="mitra-heading reveal-stagger"><x-stagger-words :text="__('site.mitra.title')" /></h2>
            <p class="mitra-desc">{{ __('site.mitra.description') }}</p>
        </div>

        <div class="mitra-list">
            @foreach($mitraCategories as $i => $category)
                <div class="mitra-row reveal reveal-delay-{{ ($i % 5) + 1 }}">
                    <div class="mitra-row-label">
                        <h3>{{ __('site.mitra.'.$category['key']) }}</h3>
                        <span class="mitra-row-count">{{ $category['logos']->count() }} {{ __('site.mitra.partner_unit') }}</span>
                    </div>
                    <div class="mitra-row-logos">
                        @foreach($category['logos'] as $logo)
                            @if($logo->link)
                                <a href="{{ $logo->link }}" target="_blank" rel="noopener noreferrer" class="mitra-logo" aria-label="{{ $logo->name ?: __('site.mitra.'.$category['key']) }}">
                                    <img src="{{ $logo->logo_url }}" alt="{{ $logo->name ?: __('site.mitra.'.$category['key']) }}" loading="lazy">
                                </a>
                            @else
                                <div class="mitra-logo">
                                    <img src="{{ $logo->logo_url }}" alt="{{ $logo->name ?: __('site.mitra.'.$category['key']) }}" loading="lazy">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ======================= ARTIKEL ======================= --}}
@php
    $latestArticles = \Illuminate\Support\Facades\Cache::remember('home.articles', 300, fn () => \App\Models\Article::published()->orderBy('order')->latest('id')->take(3)->get());
@endphp
<style>
.artikel-section {
    padding: 88px 0;
    background: #fff;
}

.artikel-intro {
    max-width: 640px;
    margin: 0 auto 48px;
}

.artikel-desc {
    color: #666;
    font-size: 1.02rem;
    line-height: 1.7;
    margin-top: 10px;
}

.artikel-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 28px;
    align-items: stretch;
}

@media (max-width: 991.98px) {
    .artikel-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 575.98px) {
    .artikel-grid {
        grid-template-columns: 1fr;
    }
}

.artikel-card {
    display: flex;
    flex-direction: column;
    color: inherit;
    text-decoration: none;
    background: #fff;
    border-radius: var(--radius-lg, 22px);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: transform .35s var(--ease-material), box-shadow .35s var(--ease-material);
}

.artikel-card:hover {
    color: inherit;
    transform: translateY(-6px);
    box-shadow: var(--shadow-lg);
}

.artikel-card-img {
    aspect-ratio: 16 / 10;
    overflow: hidden;
    background: var(--color-navy-50);
}

.artikel-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .5s var(--ease-material);
}

.artikel-card:hover .artikel-card-img img {
    transform: scale(1.06);
}

.artikel-card-body {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding: 22px 24px 24px;
}

.artikel-meta {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 12px;
    flex-wrap: wrap;
}

.artikel-badge {
    display: inline-block;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.6px;
    text-transform: uppercase;
    color: var(--color-primary-600);
    background: var(--color-primary-50);
    padding: 4px 12px;
    border-radius: 999px;
}

.artikel-date {
    font-size: 0.82rem;
    color: #888;
    white-space: nowrap;
}

.artikel-title {
    font-weight: 700;
    font-size: 1.05rem;
    line-height: 1.4;
    margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.artikel-excerpt {
    color: #666;
    font-size: 0.92rem;
    line-height: 1.6;
    margin-bottom: 14px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.artikel-readmore {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--color-navy-500);
    margin-top: auto;
}

.artikel-readmore i {
    transition: transform .25s var(--ease-material);
}

.artikel-card:hover .artikel-readmore i {
    transform: translateX(4px);
}

.artikel-cta-wrap {
    text-align: center;
    margin-top: 44px;
}

.artikel-empty {
    text-align: center;
    padding: 60px 20px;
    color: #888;
    border: 1px dashed var(--color-navy-100);
    border-radius: var(--radius-lg, 22px);
}

@media (max-width: 575.98px) {
    .artikel-section { padding: 56px 0; }
}

.artikel-heading {
    font-size: clamp(1.8rem, 5vw, 3rem);
    font-weight: 700;
}
</style>
<section id="artikel" class="artikel-section">
    <div class="container">
        <div class="text-center reveal artikel-intro">
            <span class="section-eyebrow">{{ __('site.nav.artikel') }}</span>
            <h2 class="artikel-heading reveal-stagger"><x-stagger-words :text="__('site.artikel.title')" /></h2>
            <p class="artikel-desc">{{ __('site.artikel.description') }}</p>
        </div>

        @if($latestArticles->isEmpty())
            <div class="artikel-empty reveal">{{ __('site.artikel.empty') }}</div>
        @else
            <div class="artikel-grid">
                @foreach($latestArticles as $i => $item)
                    <a href="{{ $item->url }}" @if($item->is_external) target="_blank" rel="noopener" @endif class="artikel-card reveal reveal-delay-{{ $i + 1 }}">
                        <div class="artikel-card-img">
                            <img src="{{ $item->image }}" alt="{{ $item->translated('title') }}" loading="lazy">
                        </div>
                        <div class="artikel-card-body">
                            <div class="artikel-meta">
                                <span class="artikel-badge">{{ $item->is_external ? $item->source_name : (\App\Models\Article::CATEGORIES[$item->category] ?? $item->category) }}</span>
                                <span class="artikel-date">{{ $item->published_at?->translatedFormat('d M Y') }}</span>
                            </div>
                            <h3 class="artikel-title">{{ $item->translated('title') }}</h3>
                            <p class="artikel-excerpt">{{ $item->translated('excerpt') }}</p>
                            <span class="artikel-readmore">{{ __('site.artikel.read_more') }} <i class="bi {{ $item->is_external ? 'bi-box-arrow-up-right' : 'bi-arrow-right' }}"></i></span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="artikel-cta-wrap reveal">
                <a href="{{ route('artikel.index') }}" class="btn-gradient">{{ __('site.artikel.view_all') }} <i class="bi bi-arrow-right"></i></a>
            </div>
        @endif
    </div>
</section>

{{-- ======================= KERJASAMA ======================= --}}
<style>
.kerjasama-section {
    background: #fff;
    color: inherit;
    padding: 88px 0;
    overflow: hidden;
    position: relative;
}

.kerjasama-inner {
    max-width: 1140px;
    margin: 0 auto;
    padding: 0 24px;
}

.kerjasama-grid {
    display: grid;
    grid-template-columns: minmax(0, 0.85fr) minmax(0, 1fr);
    gap: clamp(2.5rem, 6vw, 5rem);
    align-items: center;
}

@media (max-width: 991.98px) {
    .kerjasama-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
}

.kerjasama-headline {
    font-size: clamp(2rem, 4.5vw, 3rem);
    font-weight: 800;
    line-height: 1.15;
    margin: 14px 0 18px;
}

.kerjasama-headline .accent-dot {
    color: var(--color-primary-500);
}

.kerjasama-desc {
    color: #666;
    font-size: 1.02rem;
    line-height: 1.7;
    max-width: 440px;
    margin-bottom: 34px;
}

.kerjasama-points {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.kerjasama-points li {
    display: flex;
    align-items: center;
    gap: 14px;
    color: #333;
    font-size: 0.96rem;
}

.kerjasama-point-icon {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--color-primary-50);
    border: 1px solid rgba(0,0,0,0.05);
    color: var(--color-primary-600);
    font-size: 1.05rem;
}

.partnership-card {
    background: #fff;
    border: 1px solid #eee;
    border-radius: var(--radius-md, 16px);
    padding: clamp(1.5rem, 3vw, 2.25rem);
    box-shadow: var(--shadow-md);
    position: relative;
}

@media (max-width: 767.98px) {
    .kerjasama-section {
        padding: 60px 0;
    }
}

.hp-field {
    position: absolute;
    left: -9999px;
    top: -9999px;
    width: 1px;
    height: 1px;
    overflow: hidden;
}

.partnership-wrapper .form-control,
.kerjasama-section .form-control {
    border-radius: 10px;
    padding: 14px 16px;
    background: #fff;
    border: 1.5px solid #e4e4e4;
    color: inherit;
    transition: border-color .2s, box-shadow .2s, background .2s;
}

.kerjasama-section .form-control::placeholder {
    color: #999;
}

.kerjasama-section .form-control:focus {
    background: #fff;
    border-color: var(--color-primary-500);
    box-shadow: 0 0 0 4px var(--color-primary-50);
    color: inherit;
}

.kerjasama-section .invalid-feedback {
    color: var(--color-primary-600);
}

.kerjasama-section .is-invalid {
    border-color: var(--color-primary-500) !important;
}

.kerjasama-section .text-muted {
    color: #888 !important;
}

.form-field {
    margin-bottom: 18px;
}

.form-field textarea.form-control {
    min-height: 130px;
    resize: none;
}

.btn-submit {
    padding: 16px 22px;
    border-radius: 10px;
    margin-top: 8px;
    width: 100%;
    border: none;
    background: var(--color-primary-500);
    color: #fff;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-weight: 600;
}

.btn-submit:hover {
    color: #fff;
}

.btn-submit-arrow {
    display: inline-flex;
    transition: transform .25s var(--ease-material, ease);
}

.btn-submit:hover .btn-submit-arrow {
    transform: translateX(4px);
}

.btn-submit:hover {
    background: var(--color-primary-600);
    box-shadow: 0 12px 28px rgba(206,17,38,0.32);
}

.btn-submit:disabled {
    cursor: not-allowed;
    opacity: 0.85;
    transform: none;
}

.btn-submit-spinner {
    display: none;
    width: 18px;
    height: 18px;
    border: 2.5px solid rgba(255,255,255,0.4);
    border-top-color: #fff;
    border-radius: 50%;
    animation: spin 0.7s linear infinite;
}

.btn-submit.is-loading .btn-submit-spinner {
    display: inline-block;
}

.btn-submit.is-loading .btn-submit-label,
.btn-submit.is-loading .btn-submit-arrow {
    opacity: 0.85;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.success-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    animation: fadeInOverlay 0.3s ease;
}

.success-card {
    background: #fff;
    border-radius: var(--radius-lg, 22px);
    padding: 36px 32px 28px;
    text-align: center;
    width: 360px;
    max-width: 90vw;
    animation: popUp 0.4s ease;
    position: relative;
    overflow: hidden;
}

@media (max-width: 575.98px) {
    .success-overlay {
        padding: 16px;
    }

    .success-card {
        width: 100%;
        padding: 28px 20px 22px;
    }
}

.success-card-dots {
    position: absolute;
    inset: 0;
    pointer-events: none;
    background-image: radial-gradient(var(--color-success) 1.5px, transparent 1.5px);
    background-size: 20px 20px;
    -webkit-mask-image: radial-gradient(circle at 50% 0%, black, transparent 65%);
    mask-image: radial-gradient(circle at 50% 0%, black, transparent 65%);
    opacity: 0.08;
}

.success-card-progress {
    position: relative;
    margin-top: 18px;
    height: 3px;
    border-radius: 999px;
    background: var(--color-primary-50);
    overflow: hidden;
}

.success-card-progress span {
    display: block;
    width: 0%;
    height: 100%;
    background: var(--color-primary-500);
    transition: width linear;
}

.success-card h4 {
    margin-top: 18px;
    font-weight: 700;
}

.success-card p {
    color: #666;
    font-size: 14px;
    margin-bottom: 20px;
}

.success-card button {
    background: var(--color-primary-500);
    color: #fff;
    border: none;
    padding: 12px 20px;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
}

.checkmark svg {
    width: 72px;
    height: 72px;
    stroke: var(--color-success);
    stroke-width: 4;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.checkmark circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    animation: drawCircle 0.6s ease forwards;
}

.checkmark path {
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    animation: drawCheck 0.4s ease forwards 0.5s;
}

@keyframes drawCircle {
    to { stroke-dashoffset: 0; }
}

@keyframes drawCheck {
    to { stroke-dashoffset: 0; }
}

@keyframes popUp {
    from { transform: scale(0.85); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

@keyframes fadeInOverlay {
    from { opacity: 0; }
    to { opacity: 1; }
}

.error-toast {
    position: relative;
    background: #fff8f8;
    border-left: 4px solid var(--color-primary-500);
    border-radius: 12px;
    padding: 16px 44px 16px 16px;
    margin-bottom: 24px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    animation: toastIn 0.4s cubic-bezier(.22,.9,.3,1) forwards;
}

.error-toast.error-toast-hide {
    animation: toastOut 0.35s ease forwards;
}

.error-toast-icon {
    flex-shrink: 0;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: var(--color-primary-50);
    color: var(--color-primary-600);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 16px;
}

.error-toast-body h6 {
    font-weight: 700;
    margin-bottom: 4px;
    font-size: 14px;
}

.error-toast-body p {
    margin: 0;
    font-size: 13px;
    color: #666;
    line-height: 1.4;
}

.error-toast-close {
    position: absolute;
    top: 10px;
    right: 12px;
    border: none;
    background: none;
    color: #999;
    font-size: 18px;
    line-height: 1;
    cursor: pointer;
    padding: 4px;
}

.error-toast-close:hover {
    color: #333;
}

@keyframes toastIn {
    from { opacity: 0; transform: translateY(-16px) scale(.97); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

@keyframes toastOut {
    from { opacity: 1; transform: translateY(0) scale(1); }
    to { opacity: 0; transform: translateY(-16px) scale(.97); }
}
</style>

<section id="kerjasama" class="kerjasama-section">
    <div class="kerjasama-inner">
        <div class="kerjasama-grid">

            <div class="kerjasama-info reveal-left">
                <span class="section-eyebrow">{{ __('site.nav.kerjasama') }}</span>
                <h2 class="kerjasama-headline reveal-stagger">
                    <x-stagger-words :text="__('site.kerjasama.title')" /><span class="accent-dot">.</span>
                </h2>
                <p class="kerjasama-desc">{{ __('site.kerjasama.subtitle') }}</p>

                <ul class="kerjasama-points">
                    <li>
                        <span class="kerjasama-point-icon"><i class="bi bi-people-fill"></i></span>
                        {{ __('site.kerjasama.point_1') }}
                    </li>
                    <li>
                        <span class="kerjasama-point-icon"><i class="bi bi-lightning-charge-fill"></i></span>
                        {{ __('site.kerjasama.point_2') }}
                    </li>
                    <li>
                        <span class="kerjasama-point-icon"><i class="bi bi-diagram-3-fill"></i></span>
                        {{ __('site.kerjasama.point_3') }}
                    </li>
                </ul>
            </div>

            <div class="reveal-right">
                <form method="POST"
                  action="{{ route('partnership.store') }}#kerjasama"
                  enctype="multipart/form-data">
                @csrf

                    <div class="partnership-card">

                        @if ($errors->any())
                            <div class="error-toast" id="errorToast">
                                <div class="error-toast-icon">!</div>
                                <div class="error-toast-body">
                                    @if ($errors->has('proposal_file'))
                                        <h6>{{ __('site.kerjasama.toast_upload_title') }}</h6>
                                        <p>{{ $errors->first('proposal_file') }}</p>
                                    @else
                                        <h6>{{ __('site.kerjasama.toast_error_title') }}</h6>
                                        <p>{{ $errors->first() }}</p>
                                    @endif
                                </div>
                                <button type="button" class="error-toast-close" onclick="closeErrorToast()" aria-label="Close">&times;</button>
                            </div>
                        @endif

                        {{-- Honeypot: hidden from real users, bots tend to fill every field --}}
                        <div class="hp-field" aria-hidden="true">
                            <label for="website">Website</label>
                            <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="form-field">
                            <input type="text" name="institution_name" value="{{ old('institution_name') }}" placeholder="{{ __('site.kerjasama.nama_institusi') }}" aria-label="{{ __('site.kerjasama.nama_institusi') }}" class="form-control @error('institution_name') is-invalid @enderror" maxlength="150" required>
                            @error('institution_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-field">
                            <input type="text" name="pic_name" value="{{ old('pic_name') }}" placeholder="{{ __('site.kerjasama.nama_pic') }}" aria-label="{{ __('site.kerjasama.nama_pic') }}" class="form-control @error('pic_name') is-invalid @enderror" maxlength="100" required>
                            @error('pic_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-field">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('site.kerjasama.email') }}" aria-label="{{ __('site.kerjasama.email') }}" class="form-control @error('email') is-invalid @enderror" maxlength="150" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-field">
                            <input type="file" name="proposal_file" class="form-control @error('proposal_file') is-invalid @enderror" accept=".pdf,.doc,.docx" aria-label="{{ __('site.kerjasama.proposal') }}">
                            @error('proposal_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small class="text-muted">{{ __('site.kerjasama.proposal') }} — PDF, DOC, atau DOCX. Maks 5MB.</small>
                            @enderror
                        </div>

                        <div class="form-field">
                            <textarea name="summary" placeholder="{{ __('site.kerjasama.rangkuman') }}" aria-label="{{ __('site.kerjasama.rangkuman') }}" class="form-control @error('summary') is-invalid @enderror" maxlength="2000" required>{{ old('summary') }}</textarea>
                            @error('summary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn-submit" id="kerjasamaSubmitBtn">
                            <span class="btn-submit-label">{{ __('site.kerjasama.submit') }}</span>
                            <i class="bi bi-arrow-right btn-submit-arrow" aria-hidden="true"></i>
                            <span class="btn-submit-spinner" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    </form>
</section>
@if(session('success'))
<div class="success-overlay" id="successOverlay">
    <div class="success-card">
        <div class="success-card-dots" aria-hidden="true"></div>
        <div class="checkmark">
            <svg viewBox="0 0 52 52">
                <circle cx="26" cy="26" r="25" fill="none"/>
                <path fill="none" d="M14 27l7 7 17-17"/>
            </svg>
        </div>
        <h4>{{ __('site.kerjasama.success_title') }}</h4>
        <p>{{ __('site.kerjasama.success_text') }}</p>
        <button onclick="closeSuccess()">{{ __('site.kerjasama.close') }}</button>
        <div class="success-card-progress"><span id="successProgressBar"></span></div>
    </div>
</div>
@endif

<script>
function closeSuccess() {
    document.getElementById('successOverlay').remove();
}

function closeErrorToast() {
    var toast = document.getElementById('errorToast');
    if (!toast) return;
    toast.classList.add('error-toast-hide');
    setTimeout(function () { toast.remove(); }, 350);
}

(function () {
    var toast = document.getElementById('errorToast');
    if (!toast) return;
    setTimeout(closeErrorToast, 6000);
})();

(function () {
    var bar = document.getElementById('successProgressBar');
    if (!bar) return;
    var duration = 8000;
    requestAnimationFrame(function () {
        bar.style.transitionDuration = duration + 'ms';
        bar.style.width = '100%';
    });
    setTimeout(closeSuccess, duration);
})();

(function () {
    var form = document.querySelector('#kerjasama form');
    var btn = document.getElementById('kerjasamaSubmitBtn');
    if (!form || !btn) return;
    form.addEventListener('submit', function () {
        if (!form.checkValidity()) return;
        btn.classList.add('is-loading');
        btn.disabled = true;
    });
})();
</script>

{{-- Tab switching (Proker) --}}
<script>
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        if (btn.classList.contains('active')) return;

        const current = document.querySelector('.tab-content.active');
        const next = document.getElementById(btn.dataset.tab);

        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const swap = () => {
            if (current) {
                current.classList.remove('active', 'tab-in');
            }
            next.classList.add('active');
            requestAnimationFrame(() => next.classList.add('tab-in'));
        };

        if (current) {
            current.classList.remove('tab-in');
            setTimeout(swap, 180);
        } else {
            swap();
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const activeTab = document.querySelector('.tab-content.active');
    if (activeTab) requestAnimationFrame(() => activeTab.classList.add('tab-in'));
});
</script>

{{-- Scrollspy: highlight nav link of section currently in view --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link[data-section]');

    if (!sections.length || !navLinks.length) return;

    const setActive = (id) => {
        navLinks.forEach(link => {
            link.classList.toggle('active', link.dataset.section === id);
        });
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                setActive(entry.target.id);
            }
        });
    }, { rootMargin: '-40% 0px -55% 0px', threshold: 0 });

    sections.forEach(section => observer.observe(section));
});
</script>

@include('layouts.footer')
