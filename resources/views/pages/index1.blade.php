@include('layouts.header')

@php
    $galleries = App\Models\Gallery::latest()->get();
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

@media (max-width: 575.98px) {
    .global-map {
        height: 80vh;
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
                <span class="section-eyebrow">{{ __('site.nav.tentang') }}</span>
                <h1 class="tentang-title mb-4 reveal-stagger"><x-stagger-words :text="__('site.tentang.title')" /></h1>
                <p class="tentang-text">{{ __('site.tentang.p1') }}</p>
                <p class="tentang-text">{{ __('site.tentang.p2') }}</p>
                <p class="tentang-text">{{ __('site.tentang.p3') }}</p>
            </div>

            <div class="col-md-5 text-center reveal reveal-delay-2">
                <div class="tentang-logo-wrap">
                    <img src="{{ asset('assets/img/mvpn.png') }}"
                         alt="Logo"
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
                    <p class="visi-panel-text">{{ __('site.visimisi.visi_text') }}</p>
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
                        <li class="stagger-item" style="--i:0">{{ __('site.visimisi.misi_1') }}</li>
                        <li class="stagger-item" style="--i:1">{{ __('site.visimisi.misi_2') }}</li>
                        <li class="stagger-item" style="--i:2">{{ __('site.visimisi.misi_3') }}</li>
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

.member-info h5 {
    font-weight: 700;
    margin-bottom: 4px;
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

<section id="struktur" class="container py-5 struktur-page">
    <div class="text-center reveal">
        <span class="section-eyebrow">{{ __('site.nav.struktur') }}</span>
        <h2 class="fw-bold mb-5 reveal-stagger"><x-stagger-words :text="__('site.struktur.title')" /></h2>
    </div>

    <div class="struktur-wrapper reveal">
        <div class="accordion" id="strukturAccordion">

            {{-- BOD --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#bod">
                        {{ __('site.struktur.bod') }}
                    </button>
                </h2>
                <div id="bod" class="accordion-collapse collapse show" data-bs-parent="#strukturAccordion">
                    <div class="accordion-body">
                        <div class="row justify-content-center g-4">
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/pres1.png') }}">
                                    <div class="member-info">
                                        <h5>Indra A. Oktariawan</h5>
                                        <p>{{ __('site.struktur.president') }}</p>
                                        <a href="https://www.instagram.com/oktariawanindra?igsh=MWNkZG1kZGE1NHZrZg==" class="ig-btn" title="{{ __('site.struktur.instagram') }}"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/wapres.png') }}">
                                    <div class="member-info">
                                        <h5>Ani Yuliani</h5>
                                        <p>{{ __('site.struktur.vice_president') }}</p>
                                        <a href="https://www.instagram.com/aniyuliani2020?igsh=MWRwMWR4emJqY3E0aQ==
" class="ig-btn" title="{{ __('site.struktur.instagram') }}"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SEKRETARIS --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sekretaris">
                        {{ __('site.struktur.sekretaris_section') }}
                    </button>
                </h2>
                <div id="sekretaris" class="accordion-collapse collapse" data-bs-parent="#strukturAccordion">
                    <div class="accordion-body">
                        <div class="row justify-content-center g-4">
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/sekre1.png') }}">
                                    <div class="member-info">
                                        <h5>Putri Wardhany</h5>
                                        <p>{{ __('site.struktur.sekretaris') }}</p>
                                        <a href="https://www.instagram.com/__putriwardha?igsh=MXh6NThjZWxha3BhaA==" class="ig-btn" title="{{ __('site.struktur.instagram') }}"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/sekre2_v2.png') }}">
                                    <div class="member-info">
                                        <h5>Maria C. Maharani</h5>
                                        <p>{{ __('site.struktur.wakil_sekretaris') }}</p>
                                        <a href="https://www.instagram.com/raanisti?igsh=MWEyMmN0N3JuOXY0Zg==
" class="ig-btn" title="{{ __('site.struktur.instagram') }}"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- EKONOMI --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#ekonomi">
                        {{ __('site.struktur.ekonomi_section') }}
                    </button>
                </h2>
                <div id="ekonomi" class="accordion-collapse collapse" data-bs-parent="#strukturAccordion">
                    <div class="accordion-body">
                        <div class="row justify-content-center g-4">
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/direktorat.png') }}">
                                    <div class="member-info">
                                        <h5>Susanty</h5>
                                        <p>{{ __('site.struktur.direktorat') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/wakildirektorat.png') }}">
                                    <div class="member-info">
                                        <h5>Ajeng Fimara</h5>
                                        <p>{{ __('site.struktur.wakil_direktorat') }}</p>
                                        <a href="https://www.instagram.com/ajengfsbtr_?igsh=Y3oxaThqZWJ3dnJ1
" class="ig-btn" title="{{ __('site.struktur.instagram') }}"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- INTERNASIONAL --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#internasional">
                        {{ __('site.struktur.internasional_section') }}
                    </button>
                </h2>
                <div id="internasional" class="accordion-collapse collapse" data-bs-parent="#strukturAccordion">
                    <div class="accordion-body">
                        <div class="row justify-content-center g-4">
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/hi asean.jpeg') }}">
                                    <div class="member-info">
                                        <h5>DR.(C). Ramdani Murdiana</h5>
                                        <p>{{ __('site.struktur.hi_asean') }}</p>
                                        <a href="https://www.instagram.com/walikutay?igsh=dDB0YTNvd3A3cWJh
" class="ig-btn" title="{{ __('site.struktur.instagram') }}"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/hi tim.png') }}">
                                    <div class="member-info">
                                        <h5>Budi Suranto</h5>
                                        <p>{{ __('site.struktur.hi_timteng') }}</p>
                                        <a href="#" class="ig-btn" title="{{ __('site.struktur.instagram') }}"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- IT DEVELOPMENT --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#itdev">
                        {{ __('site.struktur.itdev_section') }}
                    </button>
                </h2>
                <div id="itdev" class="accordion-collapse collapse" data-bs-parent="#strukturAccordion">
                    <div class="accordion-body">
                        <div class="row justify-content-center g-4">
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/it.jpeg') }}">
                                    <div class="member-info">
                                        <h5>Fardin Muhammad Azis</h5>
                                        <p>{{ __('site.struktur.frontend_dev') }}</p>
                                        <a href="https://www.instagram.com/swsevrydy_/" class="ig-btn" title="{{ __('site.struktur.instagram') }}"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    .proker-tabbar {
        max-width: 100%;
        border-radius: var(--radius-md, 16px);
        justify-content: flex-start;
        overflow-x: auto;
        flex-wrap: nowrap;
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
    color: var(--color-navy-700);
    background: var(--color-navy-50);
    border: 1px solid transparent;
    border-radius: 999px;
    padding: 6px 14px;
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
</style>

<section id="proker" class="section-tint py-5">
    <div class="proker-wrapper">
    <div class="text-center reveal">
        <span class="section-eyebrow">{{ __('site.nav.proker') }}</span>
        <h1 class="proker-title reveal-stagger"><x-stagger-words :text="__('site.proker.title')" /></h1>
    </div>

    <div class="proker-shell reveal">
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

        <div class="proker-panel">
            <div class="tab-content active" id="pendidikan">
                <p class="proker-panel-desc">{{ __('site.proker.card_pendidikan_desc') }}</p>
                <h2>{{ __('site.proker.pendidikan_title') }}</h2>
                <ul class="checklist">
                    <li>{{ __('site.proker.pkbm') }}</li>
                    <li>{{ __('site.proker.self_improvement') }}</li>
                    <li>{{ __('site.proker.bahasa_asing') }}
                        <div class="lang-pills">
                            <span class="lang-pill">{{ __('site.proker.lang_inggris') }}</span>
                            <span class="lang-pill">{{ __('site.proker.lang_jerman') }}</span>
                            <span class="lang-pill">{{ __('site.proker.lang_prancis') }}</span>
                            <span class="lang-pill">{{ __('site.proker.lang_mandarin') }}</span>
                            <span class="lang-pill">{{ __('site.proker.lang_arab') }}</span>
                            <span class="lang-pill">{{ __('site.proker.lang_turki') }}</span>
                            <span class="lang-pill">{{ __('site.proker.lang_korea') }}</span>
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
                    <li>{{ __('site.proker.umkm_export') }}</li>
                    <li>{{ __('site.proker.business_matching') }}</li>
                </ul>
            </div>

            <div class="tab-content" id="sdm">
                <p class="proker-panel-desc">{{ __('site.proker.card_sdm_desc') }}</p>
                <h2>{{ __('site.proker.sdm_title') }}</h2>
                <ul class="checklist">
                    <li>{{ __('site.proker.sdm_1') }}</li>
                    <li>{{ __('site.proker.sdm_2') }}</li>
                    <li>{{ __('site.proker.sdm_3') }}</li>
                    <li>{{ __('site.proker.sdm_4') }}</li>
                    <li>{{ __('site.proker.sdm_5') }}</li>
                    <li>{{ __('site.proker.sdm_6') }}</li>
                    <li>{{ __('site.proker.sdm_7') }}</li>
                    <li>{{ __('site.proker.sdm_8') }}</li>
                </ul>
            </div>
        </div>
    </div>
    </div>
</section>

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
    background: #fff;
    border-radius: var(--radius-md, 16px);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: .35s var(--ease-material, ease);
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
    padding: 18px 20px;
}

.gallery-body h5 {
    font-weight: 600;
    margin-bottom: 6px;
}

.gallery-body p {
    font-size: 14px;
    color: #666;
    margin: 0;
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
    <div class="gallery-card reveal reveal-delay-{{ ($loop->index % 5) + 1 }}">
        <div class="gallery-img">
            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}">
        </div>
        <div class="gallery-body">
            <h5>{{ $item->title ?? __('site.dokumentasi.default_title') }}</h5>
            <p>{{ $item->description }}</p>
        </div>
    </div>
@endforeach
        </div>
    </div>
</section>

{{-- ======================= KEMITRAAN ======================= --}}
{{-- Judul+deskripsi center di atas, lalu tiap kategori jadi baris:
     label kategori di kiri, SEMUA logo mitra kategori itu di kanan
     (tidak dipotong), reveal berjenjang per baris saat discroll. --}}
@php
    $mitraCategories = \App\Models\Mitra::orderBy('category')->orderBy('order')->get()
        ->groupBy('category')
        ->map(fn ($items, $key) => ['key' => $key, 'logos' => $items])
        ->values();
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
        gap: 16px;
        padding: 24px 0;
    }

    .mitra-row-label {
        position: static;
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

.mitra-logo:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

.mitra-logo img {
    max-width: 100%;
    max-height: 100%;
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
    .mitra-logo {
        width: 100px;
        height: 68px;
    }
}
</style>

<section id="mitra" class="section-tint py-5">
    <div class="container">
        <div class="text-center reveal mitra-intro">
            <span class="section-eyebrow">{{ __('site.nav.kemitraan') }}</span>
            <h1 class="mitra-heading reveal-stagger"><x-stagger-words :text="__('site.mitra.title')" /></h1>
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
                            <div class="mitra-logo">
                                <img src="{{ $logo->logo_url }}" alt="{{ $logo->name ?: __('site.mitra.'.$category['key']) }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
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
    animation: popUp 0.4s ease;
    position: relative;
    overflow: hidden;
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
