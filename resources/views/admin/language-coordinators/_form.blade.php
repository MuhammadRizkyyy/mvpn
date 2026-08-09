@php $coordinator = $coordinator ?? null; @endphp

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
    <label for="language" class="mb-1.5 block text-xs font-medium text-neutral-600">Bahasa</label>
    <select name="language" id="language" required
            class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
        @foreach(\App\Models\LanguageClassCoordinator::LANGUAGES as $key => $label)
            <option value="{{ $key }}" @selected(old('language', $coordinator->language ?? '') === $key)>{{ $label }}</option>
        @endforeach
    </select>
</div>

<div>
    <label for="name" class="mb-1.5 block text-xs font-medium text-neutral-600">Nama</label>
    <input type="text" name="name" id="name" required value="{{ old('name', $coordinator->name ?? '') }}"
           class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
</div>

<div>
    <label for="role" class="mb-1.5 block text-xs font-medium text-neutral-600">Jabatan</label>
    <input type="text" name="role" id="role" required value="{{ old('role', $coordinator->role ?? '') }}"
           placeholder="Contoh: Ketua Penanggung Jawab"
           class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
</div>

<div>
    <label for="period" class="mb-1.5 block text-xs font-medium text-neutral-600">Periode <span class="font-normal text-neutral-400">(opsional)</span></label>
    <input type="text" name="period" id="period" value="{{ old('period', $coordinator->period ?? '') }}"
           placeholder="Contoh: 2026-2027"
           class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
</div>

<div>
    <label for="photo" class="mb-1.5 block text-xs font-medium text-neutral-600">Foto <span class="font-normal text-neutral-400">(opsional)</span></label>
    @if(($coordinator->photo ?? null))
        <img src="{{ $coordinator->photo }}" class="mb-2 h-16 w-16 rounded-full object-cover">
    @endif
    <input type="file" name="photo" id="photo"
           class="block w-full rounded-lg border border-neutral-300 text-sm text-neutral-600 file:mr-3 file:rounded-md file:border-0 file:bg-navy-500 file:px-3 file:py-2 file:text-xs file:font-medium file:text-white hover:file:bg-navy-700">
</div>

<div>
    <label for="certificate" class="mb-1.5 block text-xs font-medium text-neutral-600">Sertifikat Kelulusan Tim <span class="font-normal text-neutral-400">(opsional)</span></label>
    <p class="mb-2 text-xs text-neutral-400">Sertifikat berlaku untuk satu tim/periode. Cukup unggah sekali di salah satu anggota — akan tampil untuk seluruh tim bahasa &amp; periode ini.</p>
    @if(($coordinator->certificate ?? null))
        <img src="{{ $coordinator->certificate }}" class="mb-2 h-24 w-auto rounded-md border border-neutral-200 object-cover">
    @endif
    <input type="file" name="certificate" id="certificate"
           class="block w-full rounded-lg border border-neutral-300 text-sm text-neutral-600 file:mr-3 file:rounded-md file:border-0 file:bg-navy-500 file:px-3 file:py-2 file:text-xs file:font-medium file:text-white hover:file:bg-navy-700">
</div>
