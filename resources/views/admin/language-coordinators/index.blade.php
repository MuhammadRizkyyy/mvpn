@extends('admin.layout')

@section('title', 'Penanggung Jawab Kelas Bahasa')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="font-display text-2xl font-semibold text-neutral-950">Penanggung Jawab Kelas Bahasa</h1>
        <p class="mt-1 text-sm text-neutral-500">Kelola penanggung jawab per program kelas bahasa. Seret pakai ikon titik-titik untuk mengubah urutan tampil.</p>
    </div>
    <a href="{{ route('admin.language-coordinators.create') }}"
       class="inline-flex items-center gap-1.5 rounded-lg bg-primary-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-primary-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Penanggung Jawab
    </a>
</div>

<div class="space-y-6">
@foreach(\App\Models\LanguageClassCoordinator::LANGUAGES as $key => $label)
    @php $items = $coordinators->get($key, collect()); @endphp

    <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white">
        <div class="flex items-center justify-between border-b border-neutral-200 px-5 py-3.5">
            <h2 class="text-sm font-semibold text-neutral-950">{{ $label }}</h2>
            <span class="text-xs text-neutral-500">{{ $items->count() }} orang</span>
        </div>

        @if($items->isEmpty())
            <div class="px-5 py-8 text-center">
                <p class="text-sm text-neutral-500">Belum ada penanggung jawab untuk kelas {{ $label }}.</p>
            </div>
        @else
            <ul class="divide-y divide-neutral-100" data-reorder-url="{{ route('admin.language-coordinators.reorder') }}" data-reorder-key="language" data-reorder-value="{{ $key }}">
                @foreach($items as $item)
                    <li class="js-reorder-item flex items-center justify-between gap-4 px-5 py-3" data-id="{{ $item->id }}">
                        <div class="flex min-w-0 items-center gap-3">
                            <button type="button"
                                    class="js-drag-handle touch-none flex h-7 w-7 shrink-0 cursor-grab items-center justify-center rounded-md text-neutral-400 hover:text-neutral-600 active:cursor-grabbing"
                                    aria-label="Seret untuk mengubah urutan" title="Seret untuk mengubah urutan">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><circle cx="9" cy="6" r="1.4"/><circle cx="15" cy="6" r="1.4"/><circle cx="9" cy="12" r="1.4"/><circle cx="15" cy="12" r="1.4"/><circle cx="9" cy="18" r="1.4"/><circle cx="15" cy="18" r="1.4"/></svg>
                            </button>
                            @if($item->photo)
                                <img src="{{ $item->photo }}" alt="{{ $item->name }}" class="h-10 w-10 shrink-0 rounded-full object-cover" draggable="false">
                            @else
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-neutral-100 text-xs font-semibold text-neutral-400">{{ strtoupper(substr($item->name, 0, 1)) }}</span>
                            @endif
                            <div class="min-w-0">
                                <p class="truncate text-sm font-medium text-neutral-950">{{ $item->name }}</p>
                                <p class="truncate text-xs text-neutral-500">{{ $item->role }}@if($item->period) &middot; {{ $item->period }}@endif</p>
                            </div>
                            @if($item->certificate)
                                <span class="inline-flex shrink-0 items-center gap-1 rounded-full bg-gold-50 px-2 py-0.5 text-[10px] font-medium text-gold-700" title="Sertifikat kelulusan tim tersedia">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M9 14l-2 7 5-3 5 3-2-7"/></svg>
                                    Sertifikat
                                </span>
                            @endif
                        </div>
                        <div class="flex shrink-0 items-center gap-2">
                            <a href="{{ route('admin.language-coordinators.edit', $item) }}"
                               class="inline-flex items-center gap-1 rounded-md border border-neutral-300 px-2.5 py-1.5 text-xs font-medium text-neutral-700 transition-colors hover:border-navy-500 hover:text-navy-500">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.language-coordinators.destroy', $item) }}" data-confirm="Hapus penanggung jawab ini?">
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
