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
    font-size: clamp(36px, 6vw, 64px);
    font-weight: 800;
    letter-spacing: 1px;
}

.map-subtitle {
    margin-top: 12px;
    font-size: clamp(12px, 2.5vw, 18px);
    letter-spacing: clamp(1px, 0.6vw, 3px);
    text-transform: uppercase;
    opacity: 0.85;
    padding: 0 16px;
}

.hero-stats {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: clamp(24px, 6vw, 64px);
    margin-top: clamp(32px, 5vw, 48px);
    padding-top: clamp(24px, 4vw, 32px);
    border-top: 1px solid rgba(255,255,255,0.18);
}

.hero-stat-value {
    font-family: var(--font-display);
    font-weight: 800;
    font-size: clamp(1.6rem, 4vw, 2.4rem);
    color: var(--color-gold-500);
    line-height: 1;
}

.hero-stat-label {
    margin-top: 6px;
    font-size: clamp(0.65rem, 1.4vw, 0.8rem);
    text-transform: uppercase;
    letter-spacing: 1px;
    opacity: 0.8;
}

.hero-cta {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 16px;
    margin-top: clamp(28px, 4vw, 40px);
}

.btn-hero {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 28px;
    border-radius: 999px;
    font-weight: 600;
    font-size: 0.95rem;
    text-decoration: none;
    transition: 0.25s ease;
}

.btn-hero-primary {
    background: var(--color-primary-500);
    color: #fff;
    border: 1.5px solid var(--color-primary-500);
}

.btn-hero-primary:hover {
    background: var(--color-primary-600);
    border-color: var(--color-primary-600);
    color: #fff;
    transform: translateY(-2px);
}

.btn-hero-secondary {
    background: transparent;
    color: #fff;
    border: 1.5px solid rgba(255,255,255,0.55);
}

.btn-hero-secondary:hover {
    background: rgba(255,255,255,0.1);
    border-color: #fff;
    color: #fff;
    transform: translateY(-2px);
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
        <h1 class="map-title">{{ __('site.home.hero_title') }}</h1>
        <p class="map-subtitle">{{ __('site.home.hero_subtitle') }}</p>

        <div class="hero-cta">
            <a href="{{ request()->routeIs('index1') ? '#kerjasama' : '/#kerjasama' }}" class="btn-hero btn-hero-primary">{{ __('site.home.cta_primary') }} <i class="bi bi-arrow-right"></i></a>
            <a href="{{ request()->routeIs('index1') ? '#proker' : '/#proker' }}" class="btn-hero btn-hero-secondary">{{ __('site.home.cta_secondary') }}</a>
        </div>

        <div class="hero-stats">
            <div>
                <div class="hero-stat-value">{{ __('site.home.stat_1_value') }}</div>
                <div class="hero-stat-label">{{ __('site.home.stat_1_label') }}</div>
            </div>
            <div>
                <div class="hero-stat-value">{{ __('site.home.stat_2_value') }}</div>
                <div class="hero-stat-label">{{ __('site.home.stat_2_label') }}</div>
            </div>
            <div>
                <div class="hero-stat-value">{{ __('site.home.stat_3_value') }}</div>
                <div class="hero-stat-label">{{ __('site.home.stat_3_label') }}</div>
            </div>
        </div>
    </div>

    <img
        src="{{ asset('assets/img/peta.png') }}"
        alt="Indonesia Global Map"
        class="map-image"
    >
</section>

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

.tentang-logo {
    max-width: 100%;
    height: auto;
    width: 550px;
}

@media (max-width: 575.98px) {
    .tentang-logo {
        width: 260px;
    }
}

@keyframes fadeInLeft {
    0% { opacity: 0; transform: translateX(-50px); }
    100% { opacity: 1; transform: translateX(0); }
}

@keyframes fadeInUp {
    0% { opacity: 0; transform: translateY(50px); }
    100% { opacity: 1; transform: translateY(0); }
}
</style>

<section id="tentang" class="py-5">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-7" style="animation: fadeInLeft 1.5s ease forwards; opacity: 0;">
                <h1 class="tentang-title mb-4">{{ __('site.tentang.title') }}</h1>
                <p class="tentang-text">{{ __('site.tentang.p1') }}</p>
                <p class="tentang-text">{{ __('site.tentang.p2') }}</p>
                <p class="tentang-text">{{ __('site.tentang.p3') }}</p>
            </div>

            <div class="col-md-5 text-center"
                 style="animation: fadeInUp 1.5s ease forwards; opacity: 0;">
                <img src="{{ asset('assets/img/mvpn.png') }}"
                     alt="Logo"
                     class="tentang-logo">
            </div>

        </div>
    </div>
</section>

{{-- ======================= VISI & MISI ======================= --}}
<style>
.visimisi-title {
    font-size: clamp(1.8rem, 5vw, 3rem);
}

.visimisi-box {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    padding: 2rem;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: start;
    border-left: 4px solid transparent;
}

.visimisi-box.visi {
    border-left-color: var(--color-primary-500);
}

.visimisi-box.misi {
    border-left-color: var(--color-navy-500);
}

.visimisi-heading {
    font-size: clamp(1.3rem, 3.5vw, 1.8rem);
}

.visimisi-text {
    text-align: justify;
    font-size: clamp(0.95rem, 2vw, 1.1rem);
    line-height: 1.6;
}

@media (max-width: 575.98px) {
    .visimisi-box {
        padding: 1.4rem;
    }

    .visimisi-text {
        text-align: left;
    }
}

@keyframes fadeInRight {
    0% { opacity: 0; transform: translateX(50px); }
    100% { opacity: 1; transform: translateX(0); }
}

@keyframes fadeInDown {
    0% { opacity: 0; transform: translateY(-30px); }
    100% { opacity: 1; transform: translateY(0); }
}

.visimisi-box:hover {
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    transform: translateY(-5px);
    transition: transform 0.3s, box-shadow 0.3s;
}
</style>

<section id="visimisi" class="container py-5" style="min-height: 70vh;">
    <h2 class="text-center fw-bold mb-5 visimisi-title" style="animation: fadeInDown 1s ease forwards; opacity: 0;">{{ __('site.visimisi.title') }}</h2>

    <div class="row justify-content-center g-4 d-flex align-items-stretch">

        <!-- Visi -->
        <div class="col-md-6 d-flex">
            <div class="visimisi-box visi" style="cursor: pointer; opacity: 0; animation: fadeInLeft 1s ease forwards;">
                <h3 class="fw-bold mb-3 visimisi-heading">{{ __('site.visimisi.visi_label') }}</h3>
                <p class="visimisi-text">
                    {{ __('site.visimisi.visi_text') }}
                </p>
            </div>
        </div>

        <!-- Misi -->
        <div class="col-md-6 d-flex">
            <div class="visimisi-box misi" style="cursor: pointer; opacity: 0; animation: fadeInRight 1s ease forwards;">
                <h3 class="fw-bold mb-3 visimisi-heading">{{ __('site.visimisi.misi_label') }}</h3>
                <ul class="visimisi-text" style="padding-left: 1.2rem;">
                    <li>{{ __('site.visimisi.misi_1') }}</li>
                    <li>{{ __('site.visimisi.misi_2') }}</li>
                    <li>{{ __('site.visimisi.misi_3') }}</li>
                </ul>
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
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
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
    border-radius: 14px;
    overflow: hidden;
    transition: 0.35s ease;
    box-shadow: 0 4px 14px rgba(0,0,0,0.04);
}

.member-card:hover {
    border-color: var(--color-primary-300);
    transform: translateY(-6px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.1);
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
    <h2 class="text-center fw-bold mb-5">{{ __('site.struktur.title') }}</h2>

    <div class="struktur-wrapper">
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
    padding: 60px 20px;
    font-family: 'Segoe UI', sans-serif;
}

.proker-title {
    text-align: center;
    font-size: clamp(1.8rem, 5vw, 3rem);
    font-weight: 700;
}

@media (max-width: 575.98px) {
    .proker-wrapper {
        padding: 40px 16px;
    }
}

.proker-title-line {
    width: 80px;
    height: 4px;
    background: var(--color-primary-500);
    margin: 15px auto 40px;
}

.proker-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 48px;
}

.proker-card {
    cursor: pointer;
    text-align: left;
    background: #fff;
    border: 1px solid #e4e4e4;
    border-radius: 14px;
    padding: 28px 24px;
    transition: 0.25s ease;
}

.proker-card:hover {
    border-color: var(--color-primary-300);
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    transform: translateY(-4px);
}

.proker-card.active {
    border-color: var(--color-primary-500);
    box-shadow: 0 10px 25px rgba(206,17,38,0.12);
}

.proker-card h3 {
    font-size: 1.1rem;
    margin-bottom: 8px;
}

.proker-card p {
    color: #555;
    font-size: 0.92rem;
    line-height: 1.5;
    margin-bottom: 14px;
}

.proker-card .card-cta {
    color: var(--color-primary-500);
    font-weight: 600;
    font-size: 0.88rem;
}

@media (max-width: 767.98px) {
    .proker-cards {
        grid-template-columns: 1fr;
        gap: 16px;
        margin-bottom: 32px;
    }
}

.tab-wrapper {
    position: relative;
}

.tab-content {
    display: none;
    animation: fadeSlideProker .5s ease;
}

.tab-content.active {
    display: block;
}

.checklist {
    list-style: none;
    padding-left: 0;
}

.checklist > li {
    position: relative;
    padding-left: 28px;
    margin-bottom: 10px;
}

.checklist > li::before {
    content: "✔";
    position: absolute;
    left: 0;
    top: 0;
    color: var(--color-primary-500);
    font-weight: bold;
}

.checklist ul {
    list-style: none;
    margin-top: 8px;
    padding-left: 22px;
}

.checklist ul li {
    position: relative;
    padding-left: 22px;
    margin-bottom: 6px;
    font-size: 0.95rem;
}

.checklist ul li::before {
    content: "–";
    position: absolute;
    left: 0;
    color: #666;
}

.soon {
    font-size: 0.85rem;
    color: #999;
}

@keyframes fadeSlideProker {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<section id="proker" class="proker-wrapper">
    <h1 class="proker-title">{{ __('site.proker.title') }}</h1>
    <div class="proker-title-line"></div>

    <div class="proker-cards">
        <div class="proker-card tab-btn active" data-tab="pendidikan">
            <h3>{{ __('site.proker.tab_pendidikan') }}</h3>
            <p>{{ __('site.proker.card_pendidikan_desc') }}</p>
            <span class="card-cta">{{ __('site.proker.card_cta') }} &rarr;</span>
        </div>
        <div class="proker-card tab-btn" data-tab="wirausaha">
            <h3>{{ __('site.proker.tab_wirausaha') }}</h3>
            <p>{{ __('site.proker.card_wirausaha_desc') }}</p>
            <span class="card-cta">{{ __('site.proker.card_cta') }} &rarr;</span>
        </div>
        <div class="proker-card tab-btn" data-tab="sdm">
            <h3>{{ __('site.proker.tab_sdm') }}</h3>
            <p>{{ __('site.proker.card_sdm_desc') }}</p>
            <span class="card-cta">{{ __('site.proker.card_cta') }} &rarr;</span>
        </div>
    </div>

    <div class="tab-wrapper">
        <div class="tab-content active" id="pendidikan">
            <h2>{{ __('site.proker.pendidikan_title') }}</h2>
            <ul class="checklist">
                <li>{{ __('site.proker.pkbm') }}</li>
                <li>{{ __('site.proker.self_improvement') }}</li>
                <li>{{ __('site.proker.bahasa_asing') }}
                    <ul>
                        <li>{{ __('site.proker.lang_inggris') }}</li>
                        <li>{{ __('site.proker.lang_jerman') }}</li>
                        <li>{{ __('site.proker.lang_prancis') }}</li>
                        <li>{{ __('site.proker.lang_mandarin') }}</li>
                        <li>{{ __('site.proker.lang_arab') }}</li>
                        <li>{{ __('site.proker.lang_turki') }}</li>
                        <li>{{ __('site.proker.lang_korea') }}</li>
                        <li>{{ __('site.proker.lang_thailand') }} <span class="soon">{{ __('site.proker.coming_soon') }}</span></li>
                        <li>{{ __('site.proker.lang_isyarat') }} <span class="soon">{{ __('site.proker.coming_soon') }}</span></li>
                        <li>{{ __('site.proker.lang_urdu') }} <span class="soon">{{ __('site.proker.coming_soon') }}</span></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="wirausaha">
            <h2>{{ __('site.proker.wirausaha_title') }}</h2>
            <ul class="checklist">
                <li>{{ __('site.proker.umkm_export') }}</li>
                <li>{{ __('site.proker.business_matching') }}</li>
            </ul>
        </div>

        <div class="tab-content" id="sdm">
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
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    transition: .35s ease;
    opacity: 0;
    transform: translateY(30px);
    animation: fadeUpGallery .6s ease forwards;
}

.gallery-card:nth-child(2) { animation-delay: .1s; }
.gallery-card:nth-child(3) { animation-delay: .2s; }
.gallery-card:nth-child(4) { animation-delay: .3s; }
.gallery-card:nth-child(5) { animation-delay: .4s; }
.gallery-card:nth-child(6) { animation-delay: .5s; }

.gallery-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
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

@keyframes fadeUpGallery {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<section id="dokumentasi" class="gallery-section">
    <div class="gallery-container">
        <h2 class="gallery-title">{{ __('site.dokumentasi.title') }}</h2>
        <div class="gallery-title-line"></div>

        <div class="gallery-grid">
@foreach($galleries as $item)
    <div class="gallery-card">
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
<style>
.kemitraan {
    max-width: 1100px;
    margin: 0 auto;
    padding: 60px 30px;
    text-align: center;
}

.kemitraan h1 {
    font-size: clamp(1.5rem, 5vw, 32px);
    margin-bottom: 40px;
    position: relative;
    text-align: center;
    font-weight: bold;
}

@media (max-width: 575.98px) {
    .kemitraan {
        padding: 40px 16px;
    }

    .partner-row img {
        height: 60px;
        max-width: 120px;
    }
}

.partner-section {
    margin-bottom: 60px;
}

.partner-title {
    text-align: center;
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 24px;
}

.partner-row {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
}

.partner-row img {
    height: 80px;
    max-width: 160px;
    object-fit: contain;
}

.partner-row img:hover {
    filter: grayscale(0);
    opacity: 1;
    transform: scale(1.05);
}
</style>

<section id="mitra" class="kemitraan">
    <h1>{{ __('site.mitra.title') }}</h1>

    {{-- MEDIA PARTNER --}}
    <div class="partner-section">
        <div class="partner-title">{{ __('site.mitra.media') }}</div>
        <div class="partner-row">
            <img src="{{ asset('assets/img/MEDIA1.png') }}">
            <img src="{{ asset('assets/img/media2.jpeg') }}">
            <img src="{{ asset('assets/img/media3.jpeg') }}">
            <img src="{{ asset('assets/img/med.png') }}">
        </div>
    </div>

    {{-- COMMUNITY PARTNER --}}
    <div class="partner-section">
        <div class="partner-title">{{ __('site.mitra.community') }}</div>
        <div class="partner-row">
            <img src="{{ asset('assets/img/com1-image.jpeg') }}">
            <img src="{{ asset('assets/img/com2-image.jpeg') }}">
            <img src="{{ asset('assets/img/com3-image.jpeg') }}">
            <img src="{{ asset('assets/img/com4-image.jpeg') }}">
            <img src="{{ asset('assets/img/com5-image.jpeg') }}">
            <img src="{{ asset('assets/img/com6-image.png') }}">
        </div>
    </div>

    {{-- GOVERNMENT PARTNERSHIP --}}
    <div class="partner-section">
        <div class="partner-title">{{ __('site.mitra.government') }}</div>
        <div class="partner-row">
            <img src="{{ asset('assets/img/gov1.jpeg') }}">
            <img src="{{ asset('assets/img/gov2.jpeg') }}">
            <img src="{{ asset('assets/img/gov3.png') }}">
            <img src="{{ asset('assets/img/gov4.jpeg') }}">
            <img src="{{ asset('assets/img/gov5.jpeg') }}">
            <img src="{{ asset('assets/img/gov6.jpeg') }}">
            <img src="{{ asset('assets/img/gov7.jpeg') }}">
            <img src="{{ asset('assets/img/gov8.jpeg') }}">
            <img src="{{ asset('assets/img/gov9.jpeg') }}">
        </div>
    </div>

    {{-- HOSPITALITY & CAMPUS PARTNERSHIP --}}
    <div class="partner-section">
        <div class="partner-title">{{ __('site.mitra.hospitality_campus') }}</div>
        <div class="partner-row">
            <img src="{{ asset('assets/img/hc1.jpeg') }}">
            <img src="{{ asset('assets/img/hc5.jpeg') }}">
        </div>
    </div>

    {{-- HOTEL PARTNERSHIP --}}
    <div class="partner-section">
        <div class="partner-title">{{ __('site.mitra.hotel') }}</div>
        <div class="partner-row">
            <img src="{{ asset('assets/img/hotel1.jpeg') }}">
            <img src="{{ asset('assets/img/hotel2.jpeg') }}">
            <img src="{{ asset('assets/img/hotel3.jpeg') }}">
            <img src="{{ asset('assets/img/hotel4.jpeg') }}">
            <img src="{{ asset('assets/img/hotel5.jpeg') }}">
        </div>
    </div>

    {{-- BRAND PARTNERSHIP --}}
    <div class="partner-section">
        <div class="partner-title">{{ __('site.mitra.brand') }}</div>
        <div class="partner-row">
            <img src="{{ asset('assets/img/brand1.jpeg') }}">
            <img src="{{ asset('assets/img/brand2.jpeg') }}">
            <img src="{{ asset('assets/img/brand3.jpeg') }}">
            <img src="{{ asset('assets/img/brand4.jpeg') }}">
            <img src="{{ asset('assets/img/brand5.jpeg') }}">
            <img src="{{ asset('assets/img/brand6.jpeg') }}">
            <img src="{{ asset('assets/img/brand7.jpeg') }}">
            <img src="{{ asset('assets/img/brand8.jpeg') }}">
            <img src="{{ asset('assets/img/brand9.jpeg') }}">
            <img src="{{ asset('assets/img/brand10.jpeg') }}">
            <img src="{{ asset('assets/img/brand11.jpeg') }}">
            <img src="{{ asset('assets/img/brand12.jpeg') }}">
            <img src="{{ asset('assets/img/brand13.jpeg') }}">
            <img src="{{ asset('assets/img/brand14.jpeg') }}">
            <img src="{{ asset('assets/img/brand15.jpeg') }}">
            <img src="{{ asset('assets/img/brand16.jpeg') }}">
            <img src="{{ asset('assets/img/brand17.png') }}">
            <img src="{{ asset('assets/img/brand18.png') }}">
            <img src="{{ asset('assets/img/brand19.png') }}">
            <img src="{{ asset('assets/img/brand20.png') }}">
            <img src="{{ asset('assets/img/brand21.png') }}">
            <img src="{{ asset('assets/img/brand22.jpeg') }}">
            <img src="{{ asset('assets/img/brand23.png') }}">
            <img src="{{ asset('assets/img/brand24.png') }}">
            <img src="{{ asset('assets/img/brand25.png') }}">
            <img src="{{ asset('assets/img/brand26.jpeg') }}">
        </div>
    </div>

    {{-- LAW PARTNERSHIP --}}
    <div class="partner-section">
        <div class="partner-title">{{ __('site.mitra.law') }}</div>
        <div class="partner-row">
            <img src="{{ asset('assets/img/law1.jpeg') }}">
            <img src="{{ asset('assets/img/law2.jpeg') }}">
        </div>
    </div>

    {{-- INTERNATIONAL PROMOTION TRADE CENTER PARTNERSHIP --}}
    <div class="partner-section">
        <div class="partner-title">{{ __('site.mitra.ip_trade') }}</div>
        <div class="partner-row">
            <img src="{{ asset('assets/img/ip1.png') }}">
            <img src="{{ asset('assets/img/ip2.png') }}">
            <img src="{{ asset('assets/img/ip3.jpeg') }}">
            <img src="{{ asset('assets/img/ip4.jpeg') }}">
            <img src="{{ asset('assets/img/ip5.png') }}">
            <img src="{{ asset('assets/img/ip6.jpeg') }}">
            <img src="{{ asset('assets/img/ip7.jpeg') }}">
        </div>
    </div>
</section>

{{-- ======================= KERJASAMA ======================= --}}
<style>
.partnership-wrapper {
    max-width: 1100px;
    margin: 60px auto;
    padding: 0 24px;
}

.partnership-card {
    background: #fff;
    border-radius: 18px;
    padding: 36px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    animation: fadeUpKerjasama 0.6s ease forwards;
}

.partnership-title {
    text-align: center;
    font-size: clamp(1.6rem, 5vw, 38px);
    font-weight: 700;
    margin-bottom: 10px;
}

.partnership-subtitle {
    text-align: center;
    color: #666;
    margin-bottom: 40px;
}

@media (max-width: 767.98px) {
    .partnership-wrapper {
        margin: 40px auto;
        padding: 0 16px;
    }

    .partnership-card {
        padding: 22px;
    }

    .partnership-subtitle {
        margin-bottom: 28px;
    }
}

.partnership-wrapper .form-control {
    border-radius: 12px;
    padding: 14px 16px;
}

.form-col {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.form-field {
    margin-bottom: 20px;
}

.form-field-grow {
    display: flex;
    flex-direction: column;
    flex: 1 1 auto;
    margin-bottom: 20px;
}

.form-field-grow textarea.form-control {
    flex: 1 1 auto;
    min-height: 160px;
    resize: none;
}

.btn-submit {
    padding: 16px;
    border-radius: 14px;
    font-weight: 600;
    transition: 0.25s;
    margin-top: 8px;
    background-color: var(--color-primary-500);
    border-color: var(--color-primary-500);
}

.btn-submit:hover {
    background-color: var(--color-primary-600);
    border-color: var(--color-primary-600);
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(206,17,38,0.35);
}

@keyframes fadeUpKerjasama {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
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
    border-radius: 18px;
    padding: 36px 32px;
    text-align: center;
    width: 360px;
    animation: popUp 0.4s ease;
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
</style>

<section id="kerjasama" class="partnership-wrapper">
    <h2 class="partnership-title">{{ __('site.kerjasama.title') }}</h2>
    <p class="partnership-subtitle">
        {{ __('site.kerjasama.subtitle') }}
    </p>

    <form method="POST"
      action="{{ route('partnership.store') }}#kerjasama"
      enctype="multipart/form-data">
    @csrf

        <div class="partnership-card">
            <div class="row g-4">

                {{-- KIRI: informasi identitas --}}
                <div class="col-md-6 form-col">
                    <div class="form-field">
                        <label class="form-label fw-semibold">{{ __('site.kerjasama.nama_institusi') }}</label>
                        <input type="text" name="institution_name" class="form-control" required>
                    </div>

                    <div class="form-field">
                        <label class="form-label fw-semibold">{{ __('site.kerjasama.nama_pic') }}</label>
                        <input type="text" name="pic_name" class="form-control" required>
                    </div>

                    <div class="form-field">
                        <label class="form-label fw-semibold">{{ __('site.kerjasama.email') }}</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-field">
                        <label class="form-label fw-semibold">{{ __('site.kerjasama.proposal') }}</label>
                        <input type="file" name="proposal_file" class="form-control">
                    </div>
                </div>

                {{-- KANAN: detail kerjasama --}}
                <div class="col-md-6 form-col">
                    <div class="form-field-grow">
                        <label class="form-label fw-semibold">{{ __('site.kerjasama.rangkuman') }}</label>
                        <textarea name="summary" class="form-control" required></textarea>
                    </div>
                </div>

            </div>

            <button class="btn btn-primary w-100 btn-submit">
                {{ __('site.kerjasama.submit') }}
            </button>
        </div>
    </form>
</section>
@if(session('success'))
<div class="success-overlay" id="successOverlay">
    <div class="success-card">
        <div class="checkmark">
            <svg viewBox="0 0 52 52">
                <circle cx="26" cy="26" r="25" fill="none"/>
                <path fill="none" d="M14 27l7 7 17-17"/>
            </svg>
        </div>
        <h4>{{ __('site.kerjasama.success_title') }}</h4>
        <p>{{ __('site.kerjasama.success_text') }}</p>
        <button onclick="closeSuccess()">{{ __('site.kerjasama.close') }}</button>
    </div>
</div>
@endif

<script>
function closeSuccess() {
    document.getElementById('successOverlay').remove();
}
</script>

{{-- Tab switching (Proker) --}}
<script>
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

        btn.classList.add('active');
        document.getElementById(btn.dataset.tab).classList.add('active');
    });
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
