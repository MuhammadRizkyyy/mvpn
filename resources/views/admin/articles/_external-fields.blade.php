@php $article = $article ?? null; @endphp

<div class="h-fit rounded-xl border border-navy-100 bg-navy-50/40 p-5">
    <div class="mb-1 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-navy-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        <h2 class="text-sm font-semibold text-neutral-950">Liputan Media Eksternal</h2>
    </div>
    <p class="mb-4 text-xs text-neutral-500">Isi bagian ini untuk artikel yang merupakan liputan dari media lain (bukan tulisan admin MVP.N sendiri).</p>

    <div class="space-y-4">
        <div>
            <label for="source_url" class="mb-1.5 block text-xs font-medium text-neutral-600">Link Berita</label>
            <input type="url" name="source_url" id="source_url" value="{{ old('source_url', $article->source_url ?? '') }}"
                   placeholder="https://topikpubliknews.com/..."
                   class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
        </div>

        <div>
            <label for="source_name" class="mb-1.5 block text-xs font-medium text-neutral-600">Nama Sumber</label>
            <input type="text" name="source_name" id="source_name" value="{{ old('source_name', $article->source_name ?? '') }}"
                   placeholder="topikpubliknews.com"
                   class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
        </div>
    </div>

    <p class="mt-4 border-t border-navy-100 pt-3 text-xs text-neutral-500">
        Jika link diisi, kartu artikel akan menampilkan nama sumber (bukan kategori) dan tombol "Baca Selengkapnya" langsung membuka link ini di tab baru.
    </p>
</div>
