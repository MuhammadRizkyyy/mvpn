@extends('admin.layout')

@section('title', 'Divisi Struktur')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="font-display text-2xl font-semibold text-neutral-950">Divisi Struktur Komunitas</h1>
        <p class="mt-1 text-sm text-neutral-500">Divisi yang tampil sebagai akordeon di bagian Struktur Komunitas. Nama otomatis diterjemahkan ke bahasa lain.</p>
    </div>
    <a href="{{ route('admin.pengurus.index') }}"
       class="inline-flex items-center gap-1.5 rounded-lg border border-neutral-300 px-4 py-2 text-sm font-medium text-neutral-700 hover:bg-neutral-50">
        Kelola Pengurus
    </a>
</div>

@if(session('error'))
    <div class="mb-5 rounded-lg border border-primary-300/40 bg-primary-50 px-3.5 py-2.5 text-sm text-primary-600">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-5 rounded-lg border border-primary-300/40 bg-primary-50 px-3.5 py-2.5 text-sm text-primary-600">
        <ul class="list-inside list-disc space-y-0.5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="max-w-3xl space-y-6">
    <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white">
        <div class="border-b border-neutral-200 px-5 py-3.5">
            <h2 class="text-sm font-semibold text-neutral-950">Tambah Divisi</h2>
        </div>
        <form method="POST" action="{{ route('admin.pengurus-sections.store') }}" class="flex flex-wrap items-end gap-3 px-5 py-4">
            @csrf
            <div class="min-w-[16rem] flex-1">
                <label for="name" class="mb-1.5 block text-xs font-medium text-neutral-600">Nama divisi</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}"
                       placeholder="Contoh: Direktorat Hubungan Masyarakat"
                       class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
            </div>
            <button type="submit"
                    class="rounded-lg bg-primary-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-primary-600">
                Tambah
            </button>
        </form>
    </div>

    <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white">
        <div class="flex items-center justify-between border-b border-neutral-200 px-5 py-3.5">
            <div>
                <h2 class="text-sm font-semibold text-neutral-950">Daftar Divisi</h2>
                <p class="mt-0.5 text-xs text-neutral-500">Seret pakai ikon titik-titik untuk mengubah urutan tampil.</p>
            </div>
            <span class="text-xs text-neutral-500">{{ $sections->count() }} divisi</span>
        </div>

        @if($sections->isEmpty())
            <div class="px-5 py-8 text-center">
                <p class="text-sm text-neutral-500">Belum ada divisi.</p>
            </div>
        @else
            <ul class="divide-y divide-neutral-100" data-reorder-url="{{ route('admin.pengurus-sections.reorder') }}">
                @foreach($sections as $section)
                    <li class="js-reorder-item flex items-center gap-3 px-5 py-3" data-id="{{ $section->id }}">
                        <button type="button"
                                class="js-drag-handle touch-none flex h-7 w-7 shrink-0 cursor-grab items-center justify-center rounded-md text-neutral-400 hover:text-neutral-600 active:cursor-grabbing"
                                aria-label="Seret untuk mengubah urutan" title="Seret untuk mengubah urutan">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><circle cx="9" cy="6" r="1.4"/><circle cx="15" cy="6" r="1.4"/><circle cx="9" cy="12" r="1.4"/><circle cx="15" cy="12" r="1.4"/><circle cx="9" cy="18" r="1.4"/><circle cx="15" cy="18" r="1.4"/></svg>
                        </button>

                        <form method="POST" action="{{ route('admin.pengurus-sections.update', $section) }}"
                              class="flex min-w-0 flex-1 items-center gap-3">
                            @csrf
                            @method('PUT')
                            <div class="min-w-0 flex-1">
                                <input type="text" name="name" required value="{{ $section->name }}"
                                       class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
                                <p class="mt-1 text-xs text-neutral-400">{{ $section->pengurus_count }} pengurus</p>
                            </div>
                            <button type="submit"
                                    class="shrink-0 rounded-md border border-neutral-300 px-2.5 py-2 text-xs font-medium text-neutral-700 transition-colors hover:border-navy-500 hover:text-navy-500">
                                Simpan
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.pengurus-sections.destroy', $section) }}"
                              data-confirm="Hapus divisi ini?" class="shrink-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-1 rounded-md border border-primary-300 px-2.5 py-1.5 text-xs font-medium text-primary-600 transition-colors hover:bg-primary-50">
                                Hapus
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

@endsection
