@extends('admin.layout')

@section('title', 'Struktur Pengurus')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="font-display text-2xl font-semibold text-neutral-950">Struktur Pengurus</h1>
        <p class="mt-1 text-sm text-neutral-500">Kelola anggota pengurus per divisi.</p>
    </div>
    <a href="{{ route('admin.pengurus.create') }}"
       class="inline-flex items-center gap-1.5 rounded-lg bg-primary-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-primary-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Pengurus
    </a>
</div>

<div class="space-y-6">
@foreach(\App\Models\Pengurus::SECTIONS as $key => $label)
    @php $items = $pengurus->get($key, collect()); @endphp

    <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white">
        <div class="flex items-center justify-between border-b border-neutral-200 px-5 py-3.5">
            <h2 class="text-sm font-semibold text-neutral-950">{{ $label }}</h2>
            <span class="text-xs text-neutral-500">{{ $items->count() }} orang</span>
        </div>

        @if($items->isEmpty())
            <div class="px-5 py-8 text-center">
                <p class="text-sm text-neutral-500">Belum ada pengurus di divisi {{ $label }}.</p>
            </div>
        @else
            <ul class="divide-y divide-neutral-100">
                @foreach($items as $item)
                    <li class="flex items-center justify-between gap-4 px-5 py-3">
                        <div class="flex min-w-0 items-center gap-3">
                            @if($item->photo)
                                <img src="{{ asset('storage/'.$item->photo) }}" alt="{{ $item->name }}" class="h-10 w-10 shrink-0 rounded-full object-cover">
                            @else
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-neutral-100 text-xs font-semibold text-neutral-400">{{ strtoupper(substr($item->name, 0, 1)) }}</span>
                            @endif
                            <div class="min-w-0">
                                <p class="truncate text-sm font-medium text-neutral-950">{{ $item->name }}</p>
                                <p class="truncate text-xs text-neutral-500">{{ $item->position }}</p>
                            </div>
                        </div>
                        <div class="flex shrink-0 items-center gap-2">
                            <a href="{{ route('admin.pengurus.edit', $item) }}"
                               class="inline-flex items-center gap-1 rounded-md border border-neutral-300 px-2.5 py-1.5 text-xs font-medium text-neutral-700 transition-colors hover:border-navy-500 hover:text-navy-500">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.pengurus.destroy', $item) }}" onsubmit="return confirm('Hapus pengurus ini?');">
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

<div class="mt-4 rounded-lg border border-gold-500/30 bg-gold-100 px-4 py-3 text-sm text-gold-600">
    Landing page saat ini menampilkan Struktur Pengurus dengan data hardcoded di template, dan label jabatan lewat file bahasa (4 bahasa). Menyambungkan data ini ke halaman publik memerlukan keputusan terpisah soal strategi terjemahan jabatan.
</div>

@endsection
