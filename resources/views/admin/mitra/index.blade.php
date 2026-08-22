@extends('admin.layout')

@section('title', 'Mitra')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="font-display text-2xl font-semibold text-neutral-950">Mitra</h1>
        <p class="mt-1 text-sm text-neutral-500">Kelola logo mitra per kategori. Seret kartu pakai ikon titik-titik untuk mengubah urutan tampil.</p>
    </div>
    <a href="{{ route('admin.mitra.create') }}"
       class="inline-flex items-center gap-1.5 rounded-lg bg-primary-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-primary-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Mitra
    </a>
</div>

<div class="space-y-6">
@foreach(\App\Models\Mitra::CATEGORIES as $key => $label)
    @php $items = $mitras->get($key, collect()); @endphp

    <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white">
        <div class="flex items-center justify-between border-b border-neutral-200 px-5 py-3.5">
            <h2 class="text-sm font-semibold text-neutral-950">{{ $label }}</h2>
            <span class="text-xs text-neutral-500">{{ $items->count() }} logo</span>
        </div>

        @if($items->isEmpty())
            <div class="px-5 py-8 text-center">
                <p class="text-sm text-neutral-500">Belum ada mitra di kategori {{ $label }}.</p>
            </div>
        @else
            <div class="grid grid-cols-2 gap-3 p-5 sm:grid-cols-3 lg:grid-cols-4" data-reorder-url="{{ route('admin.mitra.reorder') }}" data-reorder-key="category" data-reorder-value="{{ $key }}">
                @foreach($items as $item)
                    <div class="js-reorder-item group relative overflow-hidden rounded-lg border border-neutral-200 bg-white transition-shadow" data-id="{{ $item->id }}" draggable="false">
                        <button type="button"
                                class="js-drag-handle touch-none absolute left-1.5 top-1.5 z-10 flex h-7 w-7 cursor-grab items-center justify-center rounded-md bg-white/90 text-neutral-400 shadow-sm hover:text-neutral-600 active:cursor-grabbing"
                                aria-label="Seret untuk mengubah urutan" title="Seret untuk mengubah urutan">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor"><circle cx="9" cy="6" r="1.4"/><circle cx="15" cy="6" r="1.4"/><circle cx="9" cy="12" r="1.4"/><circle cx="15" cy="12" r="1.4"/><circle cx="9" cy="18" r="1.4"/><circle cx="15" cy="18" r="1.4"/></svg>
                        </button>
                        <div class="flex h-20 items-center justify-center bg-neutral-50 p-3">
                            <img src="{{ $item->logo_url }}" alt="{{ $item->name ?: $label }}" class="max-h-full max-w-full object-contain" draggable="false">
                        </div>
                        <div class="flex items-center justify-between gap-2 px-2.5 py-2">
                            <p class="truncate text-xs font-medium text-neutral-700">{{ $item->name ?: '—' }}</p>
                            <div class="flex shrink-0 items-center gap-1.5 leading-none">
                                <a href="{{ route('admin.mitra.edit', $item) }}" class="text-xs font-medium leading-none text-navy-500 hover:text-navy-700">Edit</a>
                                <form method="POST" action="{{ route('admin.mitra.destroy', $item) }}" data-confirm="Hapus mitra ini?" class="leading-none">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="appearance-none border-0 bg-transparent p-0 text-xs font-medium leading-none text-primary-600 hover:text-primary-700">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endforeach
</div>


@endsection
