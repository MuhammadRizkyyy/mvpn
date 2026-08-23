@extends('admin.layout')

@section('title', 'Tab Program Kerja')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="font-display text-2xl font-semibold text-neutral-950">Tab Program Kerja</h1>
        <p class="mt-1 text-sm text-neutral-500">Tab yang tampil di bagian Program Kerja pada halaman utama. Seret pakai ikon titik-titik untuk mengubah urutan.</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.kegiatan.index') }}"
           class="inline-flex items-center gap-1.5 rounded-lg border border-neutral-300 px-4 py-2 text-sm font-medium text-neutral-700 transition-colors hover:bg-neutral-50">
            Kelola Isi Program
        </a>
        <a href="{{ route('admin.kegiatan-categories.create') }}"
           class="inline-flex items-center gap-1.5 rounded-lg bg-primary-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-primary-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Tab
        </a>
    </div>
</div>

@if(session('error'))
    <div class="mb-5 rounded-lg border border-primary-300/40 bg-primary-50 px-3.5 py-2.5 text-sm text-primary-600">
        {{ session('error') }}
    </div>
@endif

<div class="max-w-3xl overflow-hidden rounded-xl border border-neutral-200 bg-white">
    <div class="flex items-center justify-between border-b border-neutral-200 px-5 py-3.5">
        <h2 class="text-sm font-semibold text-neutral-950">Daftar Tab</h2>
        <span class="text-xs text-neutral-500">{{ $categories->count() }} tab</span>
    </div>

    @if($categories->isEmpty())
        <div class="px-5 py-8 text-center">
            <p class="text-sm text-neutral-500">Belum ada tab. Tanpa tab, bagian Program Kerja tidak tampil di halaman utama.</p>
        </div>
    @else
        <ul class="divide-y divide-neutral-100" data-reorder-url="{{ route('admin.kegiatan-categories.reorder') }}">
            @foreach($categories as $category)
                <li class="js-reorder-item flex items-center justify-between gap-4 px-5 py-3" data-id="{{ $category->id }}">
                    <div class="flex min-w-0 items-center gap-3">
                        <button type="button"
                                class="js-drag-handle touch-none flex h-7 w-7 shrink-0 cursor-grab items-center justify-center rounded-md text-neutral-400 hover:text-neutral-600 active:cursor-grabbing"
                                aria-label="Seret untuk mengubah urutan" title="Seret untuk mengubah urutan">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><circle cx="9" cy="6" r="1.4"/><circle cx="15" cy="6" r="1.4"/><circle cx="9" cy="12" r="1.4"/><circle cx="15" cy="12" r="1.4"/><circle cx="9" cy="18" r="1.4"/><circle cx="15" cy="18" r="1.4"/></svg>
                        </button>
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-neutral-100 text-neutral-500">
                            <i class="bi {{ $category->icon }}"></i>
                        </span>
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-neutral-950">{{ $category->name }}</p>
                            <p class="truncate text-xs text-neutral-500">
                                {{ $category->kegiatans_count }} program
                                @if($category->show_language_pills) &middot; menampilkan kelas bahasa @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex shrink-0 items-center gap-2">
                        <a href="{{ route('admin.kegiatan-categories.edit', $category) }}"
                           class="inline-flex items-center gap-1 rounded-md border border-neutral-300 px-2.5 py-1.5 text-xs font-medium text-neutral-700 transition-colors hover:border-navy-500 hover:text-navy-500">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('admin.kegiatan-categories.destroy', $category) }}" data-confirm="Hapus tab ini?">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-1 rounded-md border border-primary-300 px-2.5 py-1.5 text-xs font-medium text-primary-600 transition-colors hover:bg-primary-50">
                                Hapus
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>

@endsection
