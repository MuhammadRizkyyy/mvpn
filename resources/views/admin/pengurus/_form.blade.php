@php $pengurus = $pengurus ?? null; @endphp

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
    <label for="section" class="mb-1.5 block text-xs font-medium text-neutral-600">Divisi</label>
    <select name="section" id="section" required
            class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
        @foreach(\App\Models\Pengurus::SECTIONS as $key => $label)
            <option value="{{ $key }}" @selected(old('section', $pengurus->section ?? '') === $key)>{{ $label }}</option>
        @endforeach
    </select>
</div>

<div>
    <label for="name" class="mb-1.5 block text-xs font-medium text-neutral-600">Nama</label>
    <input type="text" name="name" id="name" required value="{{ old('name', $pengurus->name ?? '') }}"
           class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
</div>

<div>
    <label for="position" class="mb-1.5 block text-xs font-medium text-neutral-600">Jabatan</label>
    <input type="text" name="position" id="position" required value="{{ old('position', $pengurus->position ?? '') }}"
           placeholder="Contoh: Presiden"
           class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
</div>

<div>
    <label for="photo" class="mb-1.5 block text-xs font-medium text-neutral-600">Foto <span class="font-normal text-neutral-400">(opsional)</span></label>
    @if(($pengurus->photo ?? null))
        <img src="{{ asset('storage/'.$pengurus->photo) }}" class="mb-2 h-16 w-16 rounded-full object-cover">
    @endif
    <input type="file" name="photo" id="photo"
           class="block w-full rounded-lg border border-neutral-300 text-sm text-neutral-600 file:mr-3 file:rounded-md file:border-0 file:bg-navy-500 file:px-3 file:py-2 file:text-xs file:font-medium file:text-white hover:file:bg-navy-700">
</div>

<div>
    <label for="instagram_url" class="mb-1.5 block text-xs font-medium text-neutral-600">Link Instagram <span class="font-normal text-neutral-400">(opsional)</span></label>
    <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $pengurus->instagram_url ?? '') }}"
           placeholder="https://www.instagram.com/username"
           class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
</div>

<div>
    <label for="order" class="mb-1.5 block text-xs font-medium text-neutral-600">Urutan Tampil</label>
    <input type="number" name="order" id="order" min="0" value="{{ old('order', $pengurus->order ?? 0) }}"
           class="block w-32 rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
</div>
