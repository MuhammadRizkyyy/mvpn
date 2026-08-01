@php $article = $article ?? null; @endphp

<div class="overflow-hidden rounded-xl border border-neutral-200 bg-white">
    <div class="border-b border-neutral-200 px-6 py-4">
        <h2 class="font-display text-lg font-semibold text-neutral-950">Tulis Artikel Sendiri</h2>
        <p class="mt-1 text-xs text-neutral-500">Artikel yang ditulis langsung oleh admin MVP.N.</p>
    </div>

    <form method="POST" action="{{ route('admin.artikel.store') }}" enctype="multipart/form-data" class="space-y-4 px-6 py-5"
          onsubmit="this.querySelector('button[type=submit]').disabled = true;">
        @csrf

        @if($errors->any() && !old('source_url'))
            <div class="rounded-lg border border-primary-300/40 bg-primary-50 px-3.5 py-2.5 text-sm text-primary-600">
                <ul class="list-inside list-disc space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label for="own_category" class="mb-1.5 block text-xs font-medium text-neutral-600">Kategori</label>
            <select name="category" id="own_category" required
                    class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
                @foreach(\App\Models\Article::CATEGORIES as $key => $label)
                    <option value="{{ $key }}" @selected(old('category', $article->category ?? '') === $key)>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="own_title" class="mb-1.5 block text-xs font-medium text-neutral-600">Judul</label>
            <input type="text" name="title" id="own_title" required value="{{ old('title', $article->title ?? '') }}"
                   class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
        </div>

        <div>
            <label for="own_slug" class="mb-1.5 block text-xs font-medium text-neutral-600">Slug <span class="font-normal text-neutral-400">(opsional, otomatis dari judul)</span></label>
            <input type="text" name="slug" id="own_slug" value="{{ old('slug', $article->slug ?? '') }}" placeholder="contoh-judul-artikel"
                   class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
        </div>

        <div>
            <label for="own_excerpt" class="mb-1.5 block text-xs font-medium text-neutral-600">Ringkasan</label>
            <textarea name="excerpt" id="own_excerpt" rows="2" required maxlength="255" placeholder="Ringkasan singkat yang tampil di kartu artikel"
                      class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
        </div>

        @include('admin.articles._content-editor', [
            'fieldId' => 'own_content',
            'value' => $article->content ?? '',
            'label' => 'Isi Artikel',
        ])

        <div>
            <label for="own_image" class="mb-1.5 block text-xs font-medium text-neutral-600">Gambar Sampul</label>
            @if($article->image ?? null)
                <img src="{{ $article->image }}" class="mb-2 h-28 w-full rounded-lg border border-neutral-200 object-cover">
            @endif
            <input type="file" name="image" id="own_image" @if(!($article->image ?? null)) required @endif
                   class="block w-full rounded-lg border border-neutral-300 text-sm text-neutral-600 file:mr-3 file:rounded-md file:border-0 file:bg-navy-500 file:px-3 file:py-2 file:text-xs file:font-medium file:text-white hover:file:bg-navy-700">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="own_published_at" class="mb-1.5 block text-xs font-medium text-neutral-600">Tanggal Terbit</label>
                <input type="datetime-local" name="published_at" id="own_published_at"
                       value="{{ old('published_at', isset($article->published_at) ? $article->published_at->format('Y-m-d\TH:i') : '') }}"
                       class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
            </div>

            <div class="flex items-end pb-2.5">
                <label class="flex items-center gap-2 text-sm font-medium text-neutral-700">
                    <input type="checkbox" name="is_published" value="1"
                           @checked(old('is_published', $article->is_published ?? true))
                           class="rounded border-neutral-300 text-primary-500 focus:ring-primary-500">
                    Tayangkan artikel
                </label>
            </div>
        </div>

        <div class="flex justify-end border-t border-neutral-100 pt-4">
            <button type="submit"
                    class="rounded-lg bg-primary-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-primary-600">
                Simpan Artikel
            </button>
        </div>
    </form>
</div>
