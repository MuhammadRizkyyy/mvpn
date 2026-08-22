@extends('admin.layout')

@section('title', 'Artikel')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="font-display text-2xl font-semibold text-neutral-950">Artikel</h1>
        <p class="mt-1 text-sm text-neutral-500">Kelola artikel, siaran pers, dan pengumuman yang tampil di beranda. Seret pakai ikon titik-titik untuk mengubah urutan tampil.</p>
    </div>
    <a href="{{ route('admin.artikel.create') }}"
       class="inline-flex items-center gap-1.5 rounded-lg bg-primary-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-primary-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Artikel
    </a>
</div>

<div class="overflow-hidden rounded-xl border border-neutral-200 bg-white">
    @if($articles->isEmpty())
        <div class="px-5 py-12 text-center">
            <p class="text-sm font-medium text-neutral-800">Belum ada artikel</p>
            <p class="mt-1 text-sm text-neutral-500">Tambahkan artikel pertama lewat tombol di atas.</p>
        </div>
    @else
        <table class="w-full text-left text-sm">
            <thead class="border-b border-neutral-200 bg-neutral-50 text-xs uppercase text-neutral-500">
                <tr>
                    <th class="w-10 px-3 py-3 font-medium"></th>
                    <th class="px-5 py-3 font-medium">Artikel</th>
                    <th class="px-5 py-3 font-medium">Kategori</th>
                    <th class="px-5 py-3 font-medium">Tanggal</th>
                    <th class="px-5 py-3 font-medium">Status</th>
                    <th class="px-5 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-100" data-reorder-url="{{ route('admin.artikel.reorder') }}">
                @foreach($articles as $item)
                    <tr class="js-reorder-item" data-id="{{ $item->id }}">
                        <td class="px-3 py-3">
                            <button type="button"
                                    class="js-drag-handle touch-none flex h-7 w-7 shrink-0 cursor-grab items-center justify-center rounded-md text-neutral-400 hover:text-neutral-600 active:cursor-grabbing"
                                    aria-label="Seret untuk mengubah urutan" title="Seret untuk mengubah urutan">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><circle cx="9" cy="6" r="1.4"/><circle cx="15" cy="6" r="1.4"/><circle cx="9" cy="12" r="1.4"/><circle cx="15" cy="12" r="1.4"/><circle cx="9" cy="18" r="1.4"/><circle cx="15" cy="18" r="1.4"/></svg>
                            </button>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ $item->image }}" alt="{{ $item->title }}" class="h-10 w-14 shrink-0 rounded-md object-cover" draggable="false">
                                <div class="min-w-0">
                                    <span class="line-clamp-2 font-medium text-neutral-800">{{ $item->title }}</span>
                                    @if($item->is_external)
                                        <span class="mt-0.5 inline-flex items-center gap-1 text-xs text-navy-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                            {{ $item->source_name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-neutral-600">{{ \App\Models\Article::CATEGORIES[$item->category] ?? $item->category }}</td>
                        <td class="px-5 py-3 whitespace-nowrap text-neutral-600">{{ $item->published_at?->format('d M Y') ?? '—' }}</td>
                        <td class="px-5 py-3">
                            @if($item->is_published)
                                <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-600">Tayang</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-neutral-100 px-2.5 py-0.5 text-xs font-medium text-neutral-500">Draf</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('admin.artikel.edit', $item) }}" class="text-xs font-medium text-navy-500 hover:text-navy-700">Edit</a>
                                <form method="POST" action="{{ route('admin.artikel.destroy', $item) }}" data-confirm="Hapus artikel ini?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-medium text-primary-600 hover:text-primary-700">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>


@endsection
