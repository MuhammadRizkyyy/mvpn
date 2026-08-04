@php $mitra = $mitra ?? null; @endphp

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
        @foreach(\App\Models\Mitra::CATEGORIES as $key => $label)
            <option value="{{ $key }}" @selected(old('category', $mitra->category ?? '') === $key)>{{ $label }}</option>
        @endforeach
    </select>
</div>

<div>
    <label for="name" class="mb-1.5 block text-xs font-medium text-neutral-600">Nama Mitra <span class="font-normal text-neutral-400">(opsional)</span></label>
    <input type="text" name="name" id="name" value="{{ old('name', $mitra->name ?? '') }}"
           class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
</div>

<div>
    <label for="logo" class="mb-1.5 block text-xs font-medium text-neutral-600">Logo</label>
    @if(($mitra->logo ?? null))
        <img src="{{ $mitra->logo_url }}" class="mb-2 h-14 w-14 rounded-lg border border-neutral-200 object-contain p-1">
    @endif
    <input type="file" name="logo" id="logo" @if(!($mitra->logo ?? null)) required @endif
           class="block w-full rounded-lg border border-neutral-300 text-sm text-neutral-600 file:mr-3 file:rounded-md file:border-0 file:bg-navy-500 file:px-3 file:py-2 file:text-xs file:font-medium file:text-white hover:file:bg-navy-700">
</div>

<div>
    <label for="link" class="mb-1.5 block text-xs font-medium text-neutral-600">Link Mitra <span class="font-normal text-neutral-400">(opsional)</span></label>
    <input type="url" name="link" id="link" placeholder="https://" value="{{ old('link', $mitra->link ?? '') }}"
           class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
    <p class="mt-1 text-xs text-neutral-400">Jika diisi, logo mitra di halaman publik akan bisa diklik menuju link ini.</p>
</div>
