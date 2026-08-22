<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') — MVP.N</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/mvpn.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/mvpn.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-neutral-50 text-neutral-800 font-sans antialiased">

<div class="min-h-screen lg:flex">

    {{-- MOBILE TOPBAR (sidebar trigger) --}}
    <div class="flex items-center justify-between border-b border-neutral-200 bg-white px-4 py-3 lg:hidden">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
            <img src="{{ asset('assets/img/mvpn.png') }}" alt="Logo MVP.N" class="h-8 w-8 object-contain">
            <span class="font-display text-sm font-semibold tracking-wide text-neutral-950">MVP.N Admin</span>
        </a>
        <button type="button" onclick="document.getElementById('admin-sidebar').classList.toggle('hidden')"
                class="rounded-md p-2 text-neutral-500 hover:bg-neutral-100" aria-label="Buka menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="6" x2="20" y2="6"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="18" x2="20" y2="18"/></svg>
        </button>
    </div>

    {{-- SIDEBAR --}}
    <aside id="admin-sidebar" class="hidden w-full flex-col border-r border-neutral-200 bg-white lg:flex lg:w-64 lg:shrink-0 lg:sticky lg:top-0 lg:h-screen">
        <div class="hidden items-center gap-2 px-5 py-5 lg:flex">
            <img src="{{ asset('assets/img/mvpn.png') }}" alt="Logo MVP.N" class="h-9 w-9 object-contain">
            <div class="leading-tight">
                <p class="font-display text-sm font-semibold text-neutral-950">MVP.N Admin</p>
                <p class="text-xs text-neutral-400">Panel Operator</p>
            </div>
        </div>

        <nav class="flex-1 space-y-6 overflow-y-auto px-3 py-4 lg:py-0">

            <div>
                <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-neutral-400">Overview</p>
                <x-admin.nav-item :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9" rx="1.5"/><rect x="14" y="3" width="7" height="5" rx="1.5"/><rect x="14" y="12" width="7" height="9" rx="1.5"/><rect x="3" y="16" width="7" height="5" rx="1.5"/></svg>
                    </x-slot:icon>
                    Dashboard
                </x-admin.nav-item>
            </div>

            <div>
                <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-neutral-400">Konten Website</p>

                <x-admin.nav-item :href="route('admin.about.edit')" :active="request()->routeIs('admin.about.*')">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </x-slot:icon>
                    Tentang
                </x-admin.nav-item>

                <x-admin.nav-item :href="route('admin.visimisi.edit')" :active="request()->routeIs('admin.visimisi.*')">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-4.6-9.5-9.1C.7 8.4 2.4 5 6 5c2 0 3.3 1 4 2 .7-1 2-2 4-2 3.6 0 5.3 3.4 3.5 6.9C19 16.4 12 21 12 21Z"/></svg>
                    </x-slot:icon>
                    Visi &amp; Misi
                </x-admin.nav-item>

                <details class="group/struktur mb-0.5" @if(request()->routeIs('admin.pengurus.*') || request()->routeIs('admin.pengurus-sections.*')) open @endif>
                <summary class="flex cursor-pointer list-none items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-neutral-500 hover:bg-neutral-50 hover:text-neutral-800 [&::-webkit-details-marker]:hidden">
                    <span class="h-4 w-4 shrink-0 text-neutral-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="7" r="3"/><path d="M2 21v-1a6 6 0 0 1 6-6h2a6 6 0 0 1 6 6v1"/><circle cx="18" cy="8" r="2.2"/><path d="M22 21v-1a5 5 0 0 0-3.5-4.8"/></svg>
                    </span>
                    <span class="min-w-0 flex-1 truncate">Struktur Komunitas</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0 text-neutral-400 transition-transform group-open/struktur:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </summary>

                <div class="ml-[26px] mt-0.5 border-l border-neutral-200 pl-3">
                    <x-admin.nav-item :href="route('admin.pengurus.index')" :active="request()->routeIs('admin.pengurus.*')">
                        <x-slot:icon>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="3.2"/><path d="M5 21v-1.2A5.8 5.8 0 0 1 10.8 14h2.4A5.8 5.8 0 0 1 19 19.8V21"/></svg>
                        </x-slot:icon>
                        Anggota Pengurus
                    </x-admin.nav-item>

                    <x-admin.nav-item :href="route('admin.pengurus-sections.index')" :active="request()->routeIs('admin.pengurus-sections.*')">
                        <x-slot:icon>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="2" width="6" height="5" rx="1"/><rect x="2" y="16" width="6" height="5" rx="1"/><rect x="16" y="16" width="6" height="5" rx="1"/><path d="M12 7v4M5 16v-2h14v2"/></svg>
                        </x-slot:icon>
                        Divisi
                    </x-admin.nav-item>
                </div>
                </details>

                <x-admin.nav-item :href="route('admin.language-coordinators.index')" :active="request()->routeIs('admin.language-coordinators.*')">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="m12 2 8 4v6c0 5-3.4 8.4-8 10-4.6-1.6-8-5-8-10V6l8-4Z"/><path d="m9 12 2 2 4-4"/></svg>
                    </x-slot:icon>
                    PJ Kelas Bahasa
                </x-admin.nav-item>

                <details class="group/proker mb-0.5" @if(request()->routeIs('admin.kegiatan.*') || request()->routeIs('admin.kegiatan-categories.*')) open @endif>
                <summary class="flex cursor-pointer list-none items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-neutral-500 hover:bg-neutral-50 hover:text-neutral-800 [&::-webkit-details-marker]:hidden">
                    <span class="h-4 w-4 shrink-0 text-neutral-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11 3 6.5 9 2l6 4.5L9 11Z"/><path d="M9 11v11"/><path d="m15 6.5 6 4.5-6 4.5"/><path d="M15 11v11"/></svg>
                    </span>
                    <span class="min-w-0 flex-1 truncate">Program Kerja</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0 text-neutral-400 transition-transform group-open/proker:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </summary>

                <div class="ml-[26px] mt-0.5 border-l border-neutral-200 pl-3">
                    <x-admin.nav-item :href="route('admin.kegiatan.index')" :active="request()->routeIs('admin.kegiatan.*')">
                        <x-slot:icon>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                        </x-slot:icon>
                        Isi Program
                    </x-admin.nav-item>

                    <x-admin.nav-item :href="route('admin.kegiatan-categories.index')" :active="request()->routeIs('admin.kegiatan-categories.*')">
                        <x-slot:icon>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8a2 2 0 0 1 2-2h3l2 2h9a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z"/></svg>
                        </x-slot:icon>
                        Tab Program
                    </x-admin.nav-item>
                </div>
                </details>

                <x-admin.nav-item :href="route('admin.mitra.index')" :active="request()->routeIs('admin.mitra.*')">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18"/><path d="M8 4v5"/></svg>
                    </x-slot:icon>
                    Mitra
                </x-admin.nav-item>

                <x-admin.nav-item :href="route('admin.artikel.index')" :active="request()->routeIs('admin.artikel.*')">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v16H4z"/><line x1="8" y1="9" x2="16" y2="9"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="12" y2="17"/></svg>
                    </x-slot:icon>
                    Artikel
                </x-admin.nav-item>
            </div>

            <div>
                <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-neutral-400">Interaksi</p>

                <x-admin.nav-item :href="route('admin.partnerships.index')" :active="request()->routeIs('admin.partnerships.*')">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </x-slot:icon>
                    Pengajuan Kerjasama
                    @if(($pendingReviewCount ?? 0) > 0)
                        <x-slot:trailing><span class="rounded-full bg-gold-500 px-2 py-0.5 text-[10px] font-semibold text-navy-900">{{ $pendingReviewCount }}</span></x-slot:trailing>
                    @endif
                </x-admin.nav-item>

                <x-admin.nav-item href="{{ url('/admin/gallery') }}" :active="request()->is('admin/gallery*')">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="9.5" r="1.75"/><path d="m21 15-5-5-9 9"/></svg>
                    </x-slot:icon>
                    Galeri Dokumentasi
                </x-admin.nav-item>
            </div>
        </nav>

        <div class="border-t border-neutral-200 px-3 py-4">
            <div class="flex items-center gap-3 rounded-lg px-3 py-2">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-primary-50 text-sm font-semibold text-primary-600">A</span>
                <div class="min-w-0 flex-1 leading-tight">
                    <p class="truncate text-sm font-medium text-neutral-950">Admin</p>
                    <p class="truncate text-xs text-neutral-400">Operator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}" class="mt-1">
                @csrf
                <button type="submit" class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-neutral-500 transition-colors hover:bg-primary-50 hover:text-primary-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="flex min-w-0 flex-1 flex-col">
        <header class="hidden items-center justify-between border-b border-neutral-200 bg-white px-6 py-3 lg:flex">
            <nav class="text-sm text-neutral-500" aria-label="Breadcrumb">
                <span class="text-neutral-400">Admin</span>
                <span class="mx-1.5 text-neutral-300">/</span>
                <span class="font-medium text-neutral-800">@yield('title', 'Dashboard')</span>
            </nav>

            @if(($pendingReviewCount ?? 0) > 0)
                <a href="{{ route('admin.partnerships.index') }}" class="flex items-center gap-2 rounded-full border border-gold-500/40 bg-gold-100 px-3 py-1.5 text-xs font-semibold text-gold-600 transition-colors hover:bg-gold-400/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    {{ $pendingReviewCount }} pengajuan menunggu review
                </a>
            @endif
        </header>

        <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8 lg:py-8" @if(session('success')) data-flash-success="{{ session('success') }}" @endif>
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
