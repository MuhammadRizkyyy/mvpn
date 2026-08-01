@php $article = $article ?? null; @endphp

<div class="overflow-hidden rounded-xl border border-navy-100 bg-navy-50/40">
    <div class="border-b border-navy-100 px-6 py-4">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-navy-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            <h2 class="font-display text-lg font-semibold text-neutral-950">Tambah Liputan Eksternal</h2>
        </div>
        <p class="mt-1 text-xs text-neutral-500">Artikel yang merupakan liputan dari media lain (bukan tulisan admin MVP.N sendiri).</p>
    </div>

    <form method="POST" action="{{ route('admin.artikel.store') }}" enctype="multipart/form-data" class="space-y-4 px-6 py-5"
          onsubmit="this.querySelector('button[type=submit]').disabled = true;">
        @csrf

        @if($errors->any() && old('source_url'))
            <div class="rounded-lg border border-primary-300/40 bg-primary-50 px-3.5 py-2.5 text-sm text-primary-600">
                <ul class="list-inside list-disc space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label for="ext_category" class="mb-1.5 block text-xs font-medium text-neutral-600">Kategori</label>
            <select name="category" id="ext_category" required
                    class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
                @foreach(\App\Models\Article::CATEGORIES as $key => $label)
                    <option value="{{ $key }}" @selected(old('category') === $key)>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="ext_title" class="mb-1.5 block text-xs font-medium text-neutral-600">Judul</label>
            <input type="text" name="title" id="ext_title" required value="{{ old('title') }}"
                   class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
        </div>

        <div>
            <label for="ext_excerpt" class="mb-1.5 block text-xs font-medium text-neutral-600">Ringkasan</label>
            <textarea name="excerpt" id="ext_excerpt" rows="2" required maxlength="255" placeholder="Ringkasan singkat yang tampil di kartu artikel"
                      class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">{{ old('excerpt') }}</textarea>
        </div>

        <div>
            <label for="ext_source_url" class="mb-1.5 block text-xs font-medium text-neutral-600">Link Berita</label>
            <input type="url" name="source_url" id="ext_source_url" required value="{{ old('source_url') }}"
                   placeholder="https://topikpubliknews.com/..."
                   class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
        </div>

        <div>
            <label for="ext_source_name" class="mb-1.5 block text-xs font-medium text-neutral-600">Nama Sumber</label>
            <input type="text" name="source_name" id="ext_source_name" required value="{{ old('source_name') }}"
                   placeholder="topikpubliknews.com"
                   class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
        </div>

        <div>
            <label for="ext_image" class="mb-1.5 block text-xs font-medium text-neutral-600">Gambar Sampul</label>
            <input type="file" name="image" id="ext_image" required
                   class="block w-full rounded-lg border border-neutral-300 text-sm text-neutral-600 file:mr-3 file:rounded-md file:border-0 file:bg-navy-500 file:px-3 file:py-2 file:text-xs file:font-medium file:text-white hover:file:bg-navy-700">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="ext_published_at" class="mb-1.5 block text-xs font-medium text-neutral-600">Tanggal Terbit</label>
                <input type="datetime-local" name="published_at" id="ext_published_at" value="{{ old('published_at') }}"
                       class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
            </div>

            <div class="flex items-end pb-2.5">
                <label class="flex items-center gap-2 text-sm font-medium text-neutral-700">
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', true))
                           class="rounded border-neutral-300 text-primary-500 focus:ring-primary-500">
                    Tayangkan
                </label>
            </div>
        </div>

        <div class="flex justify-end border-t border-navy-100 pt-4">
            <button type="submit"
                    class="rounded-lg bg-navy-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-navy-700">
                Simpan Liputan
            </button>
        </div>
    </form>
</div>
