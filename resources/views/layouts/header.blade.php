<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $seoTitle = $title ?? 'MVP.N — Muda Visioner Penggerak Nasional';
        $seoDescription = $metaDescription ?? __('site.meta.description');
        $seoImage = $ogImage ?? asset('assets/img/mvpn.png');
        $seoUrl = $canonicalUrl ?? url()->current();
    @endphp
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <link rel="canonical" href="{{ $seoUrl }}">

    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:site_name" content="MVP.N">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:url" content="{{ $seoUrl }}">
    <meta property="og:locale" content="{{ str_replace('-', '_', app()->getLocale()) }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">
    <script>
        // Halaman ini sekarang satu halaman panjang (semua section jadi satu URL "/").
        // Setiap kali halaman dibuka/reload harus selalu mulai dari Beranda (atas),
        // jangan ikut lompat ke section lain gara-gara browser mengingat scroll
        // terakhir atau menyisakan "#section" lama di address bar.
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }
        if (location.hash) {
            history.replaceState(null, '', location.pathname + location.search);
        }
        window.scrollTo(0, 0);
        window.addEventListener('load', () => window.scrollTo(0, 0));
    </script>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/mvpn.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/mvpn.png') }}">
    <link rel="stylesheet" href="/css/style.css">

    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --color-primary-50: #FDECEC;
            --color-primary-100: #F9C7C7;
            --color-primary-300: #E4696B;
            --color-primary-500: #CE1126;
            --color-primary-600: #B00E20;
            --color-primary-700: #8C0B19;
            --color-primary-900: #4E0610;

            --color-navy-50: #EAF0F6;
            --color-navy-100: #C3D3E3;
            --color-navy-300: #5C7A9B;
            --color-navy-500: #12233B;
            --color-navy-700: #0A1526;
            --color-navy-900: #05090F;

            --color-gold-100: #FBEFD2;
            --color-gold-400: #E8B84B;
            --color-gold-500: #D4A017;
            --color-gold-600: #B3830D;

            --color-success: #1E8E5A;

            --font-display: 'Poppins', sans-serif;
            --font-body: 'Figtree', sans-serif;
        }

        body {
            font-family: var(--font-body);
        }

        h1, h2, h3, h4, h5, h6, .font {
            font-family: var(--font-display);
        }

        /* ============ Material-inspired design tokens ============ */
        :root {
            --shadow-sm: 0 2px 8px rgba(18,35,59,0.06);
            --shadow-md: 0 10px 28px rgba(18,35,59,0.10);
            --shadow-lg: 0 20px 48px rgba(18,35,59,0.16);
            --radius-md: 16px;
            --radius-lg: 22px;
            --ease-material: cubic-bezier(.22,.9,.3,1);
        }

        /* Material-style elevated card */
        .m-card {
            background: #fff;
            border: none;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            transition: transform .35s var(--ease-material), box-shadow .35s var(--ease-material);
        }

        .m-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
        }

        /* Gradient / outline buttons, Material "raised" + "text" button feel */
        .btn-gradient {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 30px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.95rem;
            color: #fff;
            border: none;
            background: linear-gradient(90deg, var(--color-primary-500), var(--color-primary-700));
            box-shadow: 0 10px 24px rgba(206,17,38,0.28);
            transition: transform .25s var(--ease-material), box-shadow .25s var(--ease-material), filter .25s;
        }

        .btn-gradient:hover {
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 16px 32px rgba(206,17,38,0.38);
            filter: brightness(1.05);
        }

        .btn-gradient:active {
            transform: translateY(-1px) scale(0.97);
        }

        /* Solid primary button — used for secondary CTAs so gradient stays
           reserved for the single hero CTA per page */
        .btn-solid {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 30px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.95rem;
            color: #fff;
            border: none;
            background: var(--color-primary-500);
            transition: background .25s var(--ease-material), transform .25s var(--ease-material), box-shadow .25s var(--ease-material);
        }

        .btn-solid:hover {
            color: #fff;
            background: var(--color-primary-600);
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(206,17,38,0.24);
        }

        .btn-solid:active {
            transform: translateY(-1px) scale(0.97);
        }

        .btn-outline-material {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 30px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.95rem;
            background: transparent;
            transition: transform .25s var(--ease-material), background .25s, border-color .25s;
        }

        .btn-outline-material:active {
            transform: scale(0.97);
        }

        /* Reveal-on-scroll: elements fade/slide in as they enter the viewport */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity .7s var(--ease-material), transform .7s var(--ease-material);
        }

        .reveal.reveal-in {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-delay-1 { transition-delay: .1s; }
        .reveal-delay-2 { transition-delay: .2s; }
        .reveal-delay-3 { transition-delay: .3s; }
        .reveal-delay-4 { transition-delay: .4s; }
        .reveal-delay-5 { transition-delay: .5s; }

        /* Directional variants — same trigger (.reveal-in), different origin */
        .reveal-left {
            opacity: 0;
            transform: translateX(-24px);
            transition: opacity .6s var(--ease-material), transform .6s var(--ease-material);
        }

        .reveal-left.reveal-in {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(24px);
            transition: opacity .6s var(--ease-material), transform .6s var(--ease-material);
        }

        .reveal-right.reveal-in {
            opacity: 1;
            transform: translateX(0);
        }

        @media (prefers-reduced-motion: reduce) {
            .reveal, .reveal-left, .reveal-right {
                opacity: 1;
                transform: none;
                transition: none;
            }
        }

        /* Block-level stagger (e.g. list items), same timing model as .stagger-word */
        .stagger-item {
            opacity: 0;
            transform: translateY(14px);
            transition: opacity .55s var(--ease-material), transform .55s var(--ease-material);
            transition-delay: calc(var(--i, 0) * 120ms);
        }

        .stagger-in .stagger-item {
            opacity: 1;
            transform: translateY(0);
        }

        @media (prefers-reduced-motion: reduce) {
            .stagger-item {
                opacity: 1;
                transform: none;
                transition: none;
            }
        }

        /* Word-by-word stagger reveal, used on headlines ("Design Blocks" style) */
        .stagger-wrap {
            display: inline;
        }

        .stagger-word {
            display: inline-block;
            opacity: 0;
            transform: translateY(0.35em);
            transition: opacity .6s var(--ease-material), transform .6s var(--ease-material);
            transition-delay: calc(var(--i, 0) * 55ms);
            will-change: transform, opacity;
        }

        .stagger-in .stagger-word {
            opacity: 1;
            transform: translateY(0);
        }

        @media (prefers-reduced-motion: reduce) {
            .stagger-word {
                opacity: 1;
                transform: none;
                transition: none;
            }
        }

        .section-eyebrow {
            display: inline-block;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-primary-600);
            background: var(--color-primary-50);
            padding: 6px 16px;
            border-radius: 999px;
            margin-bottom: 14px;
        }

        .section-eyebrow-light {
            color: var(--color-gold-500);
            background: rgba(255,255,255,0.12);
        }

        /* Icon badge used in feature/card grids (Material "avatar" icon) */
        .icon-badge {
            width: 58px;
            height: 58px;
            border-radius: var(--radius-md, 16px);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
            background: linear-gradient(135deg, var(--color-primary-500), var(--color-primary-700));
            box-shadow: 0 10px 22px rgba(206,17,38,0.28);
            margin-bottom: 18px;
        }

        .icon-badge.icon-badge-navy {
            background: linear-gradient(135deg, var(--color-navy-500), var(--color-navy-900));
            box-shadow: 0 10px 22px rgba(18,35,59,0.28);
        }

        /* Alternating full-bleed section backgrounds for visual rhythm */
        .section-tint {
            background: #F7F8FA;
        }

        .section-dark {
            background: linear-gradient(180deg, var(--color-navy-900), var(--color-navy-700));
            color: #fff;
        }

        .section-dark .section-eyebrow {
            color: var(--color-gold-500);
            background: rgba(255,255,255,0.1);
        }

        /* ============ Fixed / overlay navbar ============ */
        body {
            padding-top: 82px;
        }

        body.page-hero {
            padding-top: 0;
        }

        .navbar-custom {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            background: rgba(255,255,255,0.92);
            backdrop-filter: saturate(180%) blur(10px);
            -webkit-backdrop-filter: saturate(180%) blur(10px);
            box-shadow: var(--shadow-sm);
            border-bottom: 3px solid var(--color-primary-500);
            transition: box-shadow .3s var(--ease-material), background .3s var(--ease-material), border-color .3s;
        }

        .navbar-custom.navbar-scrolled {
            box-shadow: var(--shadow-md);
        }

        .navbar-custom.navbar-transparent {
            background: transparent;
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
            box-shadow: none;
            border-bottom-color: transparent;
        }

        .navbar-custom.navbar-transparent .navbar-nav .nav-link {
            color: #fff !important;
            text-shadow: 0 1px 6px rgba(0,0,0,0.35);
        }

        .navbar-custom.navbar-transparent .navbar-brand {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1031;
            margin: 0;
            background: #fff;
            padding: 16px 32px 16px 20px;
            border-radius: 0 0 36px 0;
            box-shadow: var(--shadow-md);
        }

        .navbar-custom.navbar-transparent .navbar-brand span {
            color: var(--color-navy-900);
        }

        /* Burger: 3 garis polos tanpa kotak (gaya Astra).
           Gelap di atas background terang, putih hanya saat hero transparan. */
        .navbar-custom .navbar-toggler {
            margin-left: auto;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border: none;
            background: transparent;
            box-shadow: none;
        }

        .navbar-custom .navbar-toggler-icon {
            width: 26px;
            height: 26px;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%2305090F' stroke-width='2.5' stroke-linecap='round' d='M4 8h22M4 15h22M4 22h22'/%3e%3c/svg%3e");
        }

        /* Putih hanya di atas hero gelap; halaman lain latarnya terang jadi tetap gelap */
        body.page-hero .navbar-custom:not(.navbar-scrolled) .navbar-toggler-icon {
            filter: invert(1) drop-shadow(0 1px 4px rgba(0,0,0,0.45));
        }

        /* Slide-in menu panel from the right (Astra-style rounded sheet) */
        .nav-offcanvas {
            width: min(72vw, 900px);
            background: var(--color-navy-900);
            border-radius: 40px 0 0 40px;
            padding: 28px 8px 24px;
            border-left: none;
            color: #fff;
        }

        .nav-offcanvas .btn-close {
            filter: invert(1);
            opacity: .8;
        }

        .nav-offcanvas .nav-link {
            color: #fff !important;
            text-shadow: none;
        }

        .nav-offcanvas .nav-link.active:not(.dropdown-toggle) {
            background: rgba(255,255,255,0.12);
            border-left-color: #fff;
            color: #fff !important;
        }

        .nav-offcanvas .lang-nav {
            border-top-color: rgba(255,255,255,0.15);
        }

        @media (max-width: 767.98px) {
            .nav-offcanvas {
                width: 100%;
                border-radius: 0;
            }
        }

        /* Brand hidden until the page is scrolled — only the hamburger shows on load */
        .navbar-brand {
            opacity: 0;
            transform: translateY(-8px);
            pointer-events: none;
            transition: opacity .35s var(--ease-material), transform .35s var(--ease-material);
        }

        .navbar-custom.navbar-scrolled .navbar-brand {
            opacity: 1;
            transform: none;
            pointer-events: auto;
        }

        .navbar-nav {
            align-items: flex-start;
            row-gap: 0;
        }

        .navbar-nav .nav-link {
            font-weight: 600;
            color: #222 !important;
            padding: 12px 14px;
            position: relative;
            transition: 0.25s;
            white-space: nowrap;
            border-radius: 8px;
            border-left: 3px solid transparent;
        }

        .nav-link.active:not(.dropdown-toggle) {
            color: var(--color-primary-500) !important;
            background: var(--color-primary-50);
            border-left-color: var(--color-primary-500);
            font-weight: 700;
        }

        .lang-dropdown .dropdown-menu {
            min-width: 10rem;
        }

        .navbar-brand img {
            width: 50px;
            height: auto;
        }

        .lang-nav {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid rgba(0,0,0,0.08);
        }
    </style>
</head>

<body class="{{ request()->routeIs('index1') ? 'page-hero' : '' }}">

@if(request()->routeIs('index1'))
    @include('layouts.splash')
    @include('layouts.join-popup')
@endif

<nav class="navbar navbar-custom navbar-transparent">
    <div class="container-fluid px-3 px-lg-4">

        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('assets/img/mvpn.png') }}" class="me-2">
            <span class="fw-bold">MVP.N</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navMenu" aria-controls="navMenu" aria-label="Menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end nav-offcanvas" tabindex="-1" id="navMenu" aria-labelledby="navMenuLabel">
            <div class="offcanvas-header pt-0">
                <span class="visually-hidden" id="navMenuLabel">Menu</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body pt-0">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('index1') ? 'active' : '' }}" data-section="beranda" href="{{ request()->routeIs('index1') ? '#beranda' : '/#beranda' }}">{{ __('site.nav.beranda') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-section="tentang" href="{{ request()->routeIs('index1') ? '#tentang' : '/#tentang' }}">{{ __('site.nav.tentang') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-section="visimisi" href="{{ request()->routeIs('index1') ? '#visimisi' : '/#visimisi' }}">{{ __('site.nav.visi_misi') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-section="struktur" href="{{ request()->routeIs('index1') ? '#struktur' : '/#struktur' }}">{{ __('site.nav.struktur') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-section="proker" href="{{ request()->routeIs('index1') ? '#proker' : '/#proker' }}">{{ __('site.nav.proker') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-section="dokumentasi" href="{{ request()->routeIs('index1') ? '#dokumentasi' : '/#dokumentasi' }}">{{ __('site.nav.galeri') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-section="mitra" href="{{ request()->routeIs('index1') ? '#mitra' : '/#mitra' }}">{{ __('site.nav.kemitraan') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-section="artikel" href="{{ request()->routeIs('index1') ? '#artikel' : '/#artikel' }}">{{ __('site.nav.artikel') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-section="kerjasama" href="{{ request()->routeIs('index1') ? '#kerjasama' : '/#kerjasama' }}">{{ __('site.nav.kerjasama') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('keanggotaan.*') ? 'active' : '' }}" href="{{ route('keanggotaan.form') }}">{{ __('site.nav.keanggotaan') }}</a>
                </li>
            </ul>

            <ul class="navbar-nav lang-nav">
                <li class="nav-item dropdown lang-dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('site.nav.alih_bahasa') }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown">
                        <li><a class="dropdown-item" href="{{ route('lang.switch', 'id') }}">Bahasa Indonesia</a></li>
                        <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a></li>
                        <li><a class="dropdown-item" href="{{ route('lang.switch', 'fr') }}">Français</a></li>
                        <li><a class="dropdown-item" href="{{ route('lang.switch', 'es') }}">Español</a></li>
                    </ul>
                </li>
            </ul>
            </div>
        </div>

    </div>
</nav>

