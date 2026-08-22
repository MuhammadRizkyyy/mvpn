@extends('admin.layout')

@section('title', 'Program Kerja')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="font-display text-2xl font-semibold text-neutral-950">Program Kerja</h1>
        <p class="mt-1 text-sm text-neutral-500">Item checklist yang tampil di section Program Kerja pada landing page, per kategori. Seret pakai ikon titik-titik untuk mengubah urutan tampil.</p>
    </div>
    <a href="{{ route('admin.kegiatan.create') }}"
       class="inline-flex items-center gap-1.5 rounded-lg bg-primary-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-primary-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Program
    </a>
</div>

<div class="space-y-6">
@foreach($categories as $category)
    @php $key = $category->slug; $label = $category->name; $items = $kegiatans->get($key, collect()); @endphp

    <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white">
        <div class="flex items-center justify-between border-b border-neutral-200 px-5 py-3.5">
            <h2 class="text-sm font-semibold text-neutral-950">{{ $label }}</h2>
            <span class="text-xs text-neutral-500">{{ $items->count() }} item</span>
        </div>

        @if($items->isEmpty())
            <div class="px-5 py-8 text-center">
                <p class="text-sm text-neutral-500">Belum ada item di kategori {{ $label }}.</p>
            </div>
        @else
            <ul class="divide-y divide-neutral-100" data-reorder-url="{{ route('admin.kegiatan.reorder') }}" data-reorder-key="category" data-reorder-value="{{ $key }}">
                @foreach($items as $item)
                    <li class="js-reorder-item flex items-center justify-between gap-4 bg-white px-5 py-3" data-id="{{ $item->id }}" draggable="false">
                        <button type="button"
                                class="js-drag-handle touch-none flex h-7 w-7 shrink-0 cursor-grab items-center justify-center rounded-md text-neutral-400 hover:text-neutral-600 active:cursor-grabbing"
                                aria-label="Seret untuk mengubah urutan" title="Seret untuk mengubah urutan">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor"><circle cx="9" cy="6" r="1.4"/><circle cx="15" cy="6" r="1.4"/><circle cx="9" cy="12" r="1.4"/><circle cx="15" cy="12" r="1.4"/><circle cx="9" cy="18" r="1.4"/><circle cx="15" cy="18" r="1.4"/></svg>
                        </button>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-neutral-950">
                                {{ $item->title }}
                                @if($item->is_coming_soon)
                                    <span class="ml-1.5 inline-flex items-center rounded-full border border-dashed border-gold-500/50 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wide text-gold-600">Segera Hadir</span>
                                @endif
                            </p>
                            @if($item->description)
                                <p class="mt-0.5 line-clamp-1 text-xs text-neutral-500">{{ html_entity_decode(strip_tags($item->description)) }}</p>
                            @endif
                        </div>
                        <div class="flex shrink-0 items-center gap-2">
                            <a href="{{ route('admin.kegiatan.edit', $item) }}"
                               class="inline-flex items-center gap-1 rounded-md border border-neutral-300 px-2.5 py-1.5 text-xs font-medium text-neutral-700 transition-colors hover:border-navy-500 hover:text-navy-500">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.kegiatan.destroy', $item) }}" data-confirm="Hapus program kerja ini?">
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
@endforeach
</div>


@endsection
