@php $article = $article ?? null; @endphp

@if($errors->any())
    <div class="rounded-lg border border-primary-300/40 bg-primary-50 px-3.5 py-2.5 text-sm text-primary-600">
        <ul class="list-inside list-disc space-y-0.5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div>
    <label for="category" class="mb-1.5 block text-xs font-medium text-neutral-600">Kategori</label>
    <select name="category" id="category" required
            class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
        @foreach(\App\Models\Article::CATEGORIES as $key => $label)
            <option value="{{ $key }}" @selected(old('category', $article->category ?? '') === $key)>{{ $label }}</option>
        @endforeach
    </select>
</div>

<div>
    <label for="title" class="mb-1.5 block text-xs font-medium text-neutral-600">Judul</label>
    <input type="text" name="title" id="title" required value="{{ old('title', $article->title ?? '') }}"
           class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
</div>

<div>
    <label for="slug" class="mb-1.5 block text-xs font-medium text-neutral-600">Slug <span class="font-normal text-neutral-400">(opsional, otomatis dari judul)</span></label>
    <input type="text" name="slug" id="slug" value="{{ old('slug', $article->slug ?? '') }}" placeholder="contoh-judul-artikel"
           class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
</div>

<div>
    <label for="excerpt" class="mb-1.5 block text-xs font-medium text-neutral-600">Ringkasan</label>
    <textarea name="excerpt" id="excerpt" rows="2" required maxlength="255" placeholder="Ringkasan singkat yang tampil di kartu artikel"
              class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
</div>

@include('admin.articles._content-editor', [
    'fieldId' => 'content',
    'value' => $article->content ?? '',
    'help' => '(kosongkan jika ini liputan eksternal — isi link di panel kanan)',
])

<div>
    <label for="image" class="mb-1.5 block text-xs font-medium text-neutral-600">Gambar Sampul</label>
    <img id="image-preview" src="{{ $article->image ?? '' }}"
         class="mb-2 h-32 w-48 rounded-lg border border-neutral-200 object-cover {{ ($article->image ?? null) ? '' : 'hidden' }}">
    <input type="file" name="image" id="image" accept="image/jpeg,image/png" onchange="previewCoverImage(this)" @if(!($article->image ?? null)) required @endif
           class="block w-full rounded-lg border border-neutral-300 text-sm text-neutral-600 file:mr-3 file:rounded-md file:border-0 file:bg-navy-500 file:px-3 file:py-2 file:text-xs file:font-medium file:text-white hover:file:bg-navy-700">
    @if($article->image ?? null)
        <p class="mt-1 text-xs text-neutral-400">Kosongkan jika tidak ingin mengganti gambar.</p>
    @endif
</div>

<script>
    function previewCoverImage(input) {
        const preview = document.getElementById('image-preview');
        if (!input.files || !input.files[0]) return;
        preview.src = URL.createObjectURL(input.files[0]);
        preview.classList.remove('hidden');
    }
</script>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label for="published_at" class="mb-1.5 block text-xs font-medium text-neutral-600">Tanggal Terbit</label>
        <input type="datetime-local" name="published_at" id="published_at"
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
