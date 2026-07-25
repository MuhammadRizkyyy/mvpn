@extends('admin.layout')

@section('title', 'Tentang')

@section('content')

<div class="mb-6">
    <h1 class="font-display text-2xl font-semibold text-neutral-950">Tentang</h1>
    <p class="mt-1 text-sm text-neutral-500">Konten deskripsi organisasi. Data ini tersimpan di database, belum otomatis tampil di landing page (lihat catatan di bawah).</p>
</div>

<div class="max-w-2xl overflow-hidden rounded-xl border border-neutral-200 bg-white">
    <div class="border-b border-neutral-200 px-6 py-4">
        <h2 class="text-sm font-semibold text-neutral-950">Konten Tentang</h2>
    </div>

    <form method="POST" action="{{ route('admin.about.update') }}" class="space-y-4 px-6 py-5">
        @csrf
        @method('PUT')

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
            <label for="title" class="mb-1.5 block text-xs font-medium text-neutral-600">Judul</label>
            <input type="text" name="title" id="title" value="{{ old('title', $about->title) }}"
                   class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
        </div>

        <div>
            <label for="paragraph_1" class="mb-1.5 block text-xs font-medium text-neutral-600">Paragraf 1</label>
            <textarea name="paragraph_1" id="paragraph_1" rows="3"
                      class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">{{ old('paragraph_1', $about->paragraph_1) }}</textarea>
        </div>

        <div>
            <label for="paragraph_2" class="mb-1.5 block text-xs font-medium text-neutral-600">Paragraf 2</label>
            <textarea name="paragraph_2" id="paragraph_2" rows="3"
                      class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">{{ old('paragraph_2', $about->paragraph_2) }}</textarea>
        </div>

        <div>
            <label for="paragraph_3" class="mb-1.5 block text-xs font-medium text-neutral-600">Paragraf 3</label>
            <textarea name="paragraph_3" id="paragraph_3" rows="3"
                      class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">{{ old('paragraph_3', $about->paragraph_3) }}</textarea>
        </div>

        <div class="flex justify-end border-t border-neutral-100 pt-4">
            <button type="submit"
                    class="rounded-lg bg-primary-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-primary-600">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<div class="mt-4 max-w-2xl rounded-lg border border-gold-500/30 bg-gold-100 px-4 py-3 text-sm text-gold-600">
    Landing page saat ini menampilkan teks Tentang lewat file bahasa (4 bahasa: ID/EN/FR/ES). Menyambungkan form ini ke halaman publik memerlukan keputusan terpisah soal strategi terjemahan.
</div>

@endsection
