@php $category = $category ?? null; @endphp

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
    <label for="name" class="mb-1.5 block text-xs font-medium text-neutral-600">Nama tab</label>
    <input type="text" name="name" id="name" required value="{{ old('name', $category->name ?? '') }}"
           placeholder="Contoh: Pengembangan SDM"
           class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
    <p class="mt-1 text-xs text-neutral-400">Dipakai sebagai label tab sekaligus judul di dalam panel.</p>
</div>

<div>
    <label for="icon" class="mb-1.5 block text-xs font-medium text-neutral-600">Ikon</label>
    <select name="icon" id="icon" required
            class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
        @foreach([
            'bi-mortarboard-fill' => 'Topi wisuda (pendidikan)',
            'bi-graph-up-arrow' => 'Grafik naik (wirausaha)',
            'bi-people-fill' => 'Orang (SDM)',
            'bi-briefcase-fill' => 'Koper (kerja)',
            'bi-heart-fill' => 'Hati (sosial)',
            'bi-globe2' => 'Globe (internasional)',
            'bi-lightbulb-fill' => 'Bohlam (inovasi)',
            'bi-book-fill' => 'Buku (literasi)',
            'bi-stars' => 'Bintang (umum)',
        ] as $value => $label)
            <option value="{{ $value }}" @selected(old('icon', $category->icon ?? 'bi-stars') === $value)>{{ $label }}</option>
        @endforeach
    </select>
</div>

<div>
    <label for="description" class="mb-1.5 block text-xs font-medium text-neutral-600">Deskripsi panel <span class="font-normal text-neutral-400">(opsional)</span></label>
    <textarea name="description" id="description" rows="3" maxlength="500"
              placeholder="Kalimat pengantar yang tampil di atas daftar program kerja."
              class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">{{ old('description', $category->description ?? '') }}</textarea>
</div>

<label class="flex items-start gap-2.5">
    <input type="hidden" name="show_language_pills" value="0">
    <input type="checkbox" name="show_language_pills" value="1" @checked(old('show_language_pills', $category->show_language_pills ?? false))
           class="mt-0.5 rounded border-neutral-300 text-primary-500 focus:ring-primary-500">
    <span class="text-sm text-neutral-700">
        Tampilkan daftar kelas bahasa
        <span class="block text-xs text-neutral-400">Menambahkan tombol bahasa (Inggris, Jerman, dst.) yang membuka info PJ Kelas Bahasa.</span>
    </span>
</label>
