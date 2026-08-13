@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

<div class="mb-6">
    <h1 class="font-display text-2xl font-semibold text-neutral-950">Dashboard</h1>
    <p class="mt-1 text-sm text-neutral-500">Ringkasan pengajuan kerjasama dan dokumentasi kegiatan.</p>
</div>

<div class="grid grid-cols-2 gap-4 sm:grid-cols-3">

    <div class="rounded-2xl border border-emerald-500/20 bg-emerald-50 p-4">
        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-white/70 text-emerald-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
        </span>
        <p class="mt-3 font-display text-2xl font-bold text-neutral-950">{{ $pengunjungHariIni }}</p>
        <p class="text-xs font-medium text-neutral-600">Pengunjung Hari Ini</p>
    </div>

    <div class="rounded-2xl border border-sky-500/20 bg-sky-50 p-4">
        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-white/70 text-sky-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
        </span>
        <p class="mt-3 font-display text-2xl font-bold text-neutral-950">{{ $totalPengunjung }}</p>
        <p class="text-xs font-medium text-neutral-600">Total Pengunjung</p>
    </div>

    <div class="rounded-2xl border border-gold-500/20 bg-gold-100 p-4">
        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-white/70 text-gold-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </span>
        <p class="mt-3 font-display text-2xl font-bold text-neutral-950">{{ $pendingReview }}</p>
        <p class="text-xs font-medium text-neutral-600">Menunggu Review</p>
    </div>

    <div class="rounded-2xl border border-primary-300/30 bg-primary-50 p-4">
        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-white/70 text-primary-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </span>
        <p class="mt-3 font-display text-2xl font-bold text-neutral-950">{{ $totalKerjasama }}</p>
        <p class="text-xs font-medium text-neutral-600">Total Kerjasama</p>
    </div>

    <div class="rounded-2xl border border-navy-100 bg-navy-50 p-4">
        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-white/70 text-navy-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="9.5" r="1.75"/><path d="m21 15-5-5-9 9"/></svg>
        </span>
        <p class="mt-3 font-display text-2xl font-bold text-neutral-950">{{ $totalGaleri }}</p>
        <p class="text-xs font-medium text-neutral-600">Total Galeri</p>
    </div>
</div>

<div class="mt-6 grid grid-cols-1 gap-5 lg:grid-cols-3">

    <div class="overflow-hidden rounded-2xl border border-neutral-200 bg-white lg:col-span-2">
        <div class="flex items-center justify-between border-b border-neutral-200 px-5 py-4">
            <h2 class="text-sm font-semibold text-neutral-950">Pengajuan Terbaru</h2>
            <a href="{{ route('admin.partnerships.index') }}" class="text-xs font-medium text-primary-500 hover:text-primary-600">Lihat semua</a>
        </div>

        @if($latestPartnerships->isEmpty())
            <div class="px-5 py-10 text-center">
                <p class="text-sm font-medium text-neutral-800">Belum ada pengajuan kerjasama</p>
                <p class="mt-1 text-sm text-neutral-500">Pengajuan baru dari halaman publik akan muncul di sini.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-neutral-200 text-xs font-semibold uppercase tracking-wide text-neutral-500">
                            <th class="px-5 py-2.5">Institusi</th>
                            <th class="px-5 py-2.5">PIC</th>
                            <th class="px-5 py-2.5">Email</th>
                            <th class="px-5 py-2.5">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100">
                    @foreach($latestPartnerships as $p)
                        <tr class="hover:bg-neutral-50">
                            <td class="px-5 py-2.5 font-medium text-neutral-950">{{ $p->institution_name }}</td>
                            <td class="px-5 py-2.5 text-neutral-600">{{ $p->pic_name }}</td>
                            <td class="px-5 py-2.5 text-neutral-600">{{ $p->email }}</td>
                            <td class="px-5 py-2.5">
                                <x-admin.status-badge :status="$p->status" />
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="flex flex-col justify-between rounded-2xl border border-neutral-200 bg-white p-5">
        <div>
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-semibold text-neutral-950">Perlu Ditinjau</h2>
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-gold-100 text-gold-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </span>
            </div>
            <p class="mt-3 font-display text-3xl font-bold text-neutral-950">{{ $pendingReview }}</p>
            <p class="text-sm text-neutral-500">pengajuan kerjasama belum diproses.</p>
        </div>
        <a href="{{ route('admin.partnerships.index') }}"
           class="mt-4 inline-flex w-full items-center justify-center rounded-lg bg-primary-500 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-primary-600">
            Tinjau Sekarang
        </a>
    </div>
</div>

@endsection
