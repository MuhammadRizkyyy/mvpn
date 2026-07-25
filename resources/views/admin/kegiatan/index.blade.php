@extends('admin.layout')

@section('title', 'Program Kerja')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="font-display text-2xl font-semibold text-neutral-950">Program Kerja</h1>
        <p class="mt-1 text-sm text-neutral-500">Item checklist yang tampil di section Program Kerja pada landing page, per kategori.</p>
    </div>
    <a href="{{ route('admin.kegiatan.create') }}"
       class="inline-flex items-center gap-1.5 rounded-lg bg-primary-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-primary-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Program
    </a>
</div>

<div class="space-y-6">
@foreach(\App\Models\Kegiatan::CATEGORIES as $key => $label)
    @php $items = $kegiatans->get($key, collect()); @endphp

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
            <ul class="divide-y divide-neutral-100">
                @foreach($items as $item)
                    <li class="flex items-center justify-between gap-4 px-5 py-3">
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-neutral-950">{{ $item->title }}</p>
                            @if($item->description)
                                <p class="mt-0.5 line-clamp-1 text-xs text-neutral-500">{{ $item->description }}</p>
                            @endif
                        </div>
                        <div class="flex shrink-0 items-center gap-2">
                            <a href="{{ route('admin.kegiatan.edit', $item) }}"
                               class="inline-flex items-center gap-1 rounded-md border border-neutral-300 px-2.5 py-1.5 text-xs font-medium text-neutral-700 transition-colors hover:border-navy-500 hover:text-navy-500">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.kegiatan.destroy', $item) }}" onsubmit="return confirm('Hapus program kerja ini?');">
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
