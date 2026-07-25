@php $kegiatan = $kegiatan ?? null; @endphp

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
        @foreach(\App\Models\Kegiatan::CATEGORIES as $key => $label)
            <option value="{{ $key }}" @selected(old('category', $kegiatan->category ?? '') === $key)>{{ $label }}</option>
        @endforeach
    </select>
</div>

<div>
    <label for="title" class="mb-1.5 block text-xs font-medium text-neutral-600">Judul</label>
    <input type="text" name="title" id="title" required value="{{ old('title', $kegiatan->title ?? '') }}"
           placeholder="Contoh: Pendampingan PKBM"
           class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
</div>

<div>
    <label for="description" class="mb-1.5 block text-xs font-medium text-neutral-600">Deskripsi <span class="font-normal text-neutral-400">(opsional)</span></label>
    <textarea name="description" id="description" rows="3"
              class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">{{ old('description', $kegiatan->description ?? '') }}</textarea>
</div>

<div>
    <label for="order" class="mb-1.5 block text-xs font-medium text-neutral-600">Urutan Tampil</label>
    <input type="number" name="order" id="order" min="0" value="{{ old('order', $kegiatan->order ?? 0) }}"
           class="block w-32 rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
    <p class="mt-1 text-xs text-neutral-400">Angka lebih kecil tampil lebih dulu.</p>
</div>
