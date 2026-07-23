<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'MVP.N' }}</title>
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




    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .navbar-custom {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .navbar-nav {
            align-items: center;
            flex-wrap: wrap;
            justify-content: center;
            row-gap: 4px;
        }

        .navbar-nav .nav-link {
            font-weight: 600;
            color: #222 !important;
            padding: 12px 14px;
            position: relative;
            transition: 0.25s;
            white-space: nowrap;
        }

        @media (min-width: 992px) and (max-width: 1399.98px) {
            .navbar-nav .nav-link {
                padding: 10px 6px;
                font-size: 0.78rem;
                letter-spacing: -0.01em;
            }
        }

        @media (min-width: 1400px) and (max-width: 1599.98px) {
            .navbar-nav .nav-link {
                padding: 12px 9px;
                font-size: 0.88rem;
            }
        }

        /* Underline effect (excludes the dropdown toggle so its caret stays intact) */
        .nav-link:not(.dropdown-toggle)::after {
            content: "";
            position: absolute;
            left: 10px;
            right: 10px;
            bottom: 6px;
            width: 0;
            height: 2px;
            background: #000;
            transition: .3s;
        }

        .nav-link:not(.dropdown-toggle):hover::after {
            width: calc(100% - 20px);
        }

        .nav-link.active:not(.dropdown-toggle) {
            color: #000 !important;
        }

        .nav-link.active:not(.dropdown-toggle)::after {
            width: calc(100% - 20px);
        }

        .lang-dropdown .dropdown-menu {
            min-width: 10rem;
        }

        .navbar-brand img {
            width: 50px;
            height: auto;
        }

        @media (max-width: 991.98px) {
            .navbar-nav {
                justify-content: flex-start;
                row-gap: 0;
            }

            .lang-nav {
                margin-top: 10px;
                padding-top: 10px;
                border-top: 1px solid rgba(0,0,0,0.08);
            }

            .nav-link:not(.dropdown-toggle)::after {
                display: none;
            }

            .nav-link:not(.dropdown-toggle) {
                border-radius: 8px;
                border-left: 3px solid transparent;
            }

            .nav-link.active:not(.dropdown-toggle) {
                background: #f1f1f1;
                border-left-color: #000;
                font-weight: 700;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid px-3 px-lg-4">

        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('assets/img/mvpn.png') }}" class="me-2">
            <span class="fw-bold">MVP.N</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto">

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
                    <a class="nav-link" data-section="kerjasama" href="{{ request()->routeIs('index1') ? '#kerjasama' : '/#kerjasama' }}">{{ __('site.nav.kerjasama') }}</a>
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
</nav>

