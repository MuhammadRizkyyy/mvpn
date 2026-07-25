@extends('admin.layout')

@section('title', 'Visi & Misi')

@section('content')

<div class="mb-6">
    <h1 class="font-display text-2xl font-semibold text-neutral-950">Visi &amp; Misi</h1>
    <p class="mt-1 text-sm text-neutral-500">Data ini tersimpan di database, belum otomatis tampil di landing page (lihat catatan di bawah).</p>
</div>

<div class="grid grid-cols-1 gap-5 lg:grid-cols-2">

    {{-- VISI --}}
    <div class="h-fit overflow-hidden rounded-xl border border-neutral-200 bg-white">
        <div class="border-b border-neutral-200 px-6 py-4">
            <h2 class="text-sm font-semibold text-neutral-950">Visi</h2>
        </div>
        <form method="POST" action="{{ route('admin.visimisi.update') }}" class="space-y-4 px-6 py-5">
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
                <label for="visi_text" class="mb-1.5 block text-xs font-medium text-neutral-600">Teks Visi</label>
                <textarea name="visi_text" id="visi_text" rows="5"
                          class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">{{ old('visi_text', $visiMisi->visi_text) }}</textarea>
            </div>

            <div class="flex justify-end border-t border-neutral-100 pt-4">
                <button type="submit"
                        class="rounded-lg bg-primary-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-primary-600">
                    Simpan Visi
                </button>
            </div>
        </form>
    </div>

    {{-- MISI --}}
    <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white">
        <div class="flex items-center justify-between border-b border-neutral-200 px-6 py-4">
            <h2 class="text-sm font-semibold text-neutral-950">Poin Misi</h2>
            <span class="text-xs text-neutral-500">{{ $misiItems->count() }} poin</span>
        </div>

        @if($misiItems->isEmpty())
            <div class="px-6 py-8 text-center">
                <p class="text-sm text-neutral-500">Belum ada poin misi.</p>
            </div>
        @else
            <ul class="divide-y divide-neutral-100">
                @foreach($misiItems as $item)
                    <li class="flex items-start justify-between gap-3 px-6 py-3">
                        <p class="min-w-0 text-sm text-neutral-800">{{ $item->text }}</p>
                        <div class="flex shrink-0 items-center gap-2">
                            <button type="button" onclick="document.getElementById('misi-edit-{{ $item->id }}').classList.toggle('hidden')"
                                    class="inline-flex items-center gap-1 rounded-md border border-neutral-300 px-2.5 py-1.5 text-xs font-medium text-neutral-700 transition-colors hover:border-navy-500 hover:text-navy-500">
                                Edit
                            </button>
                            <form method="POST" action="{{ route('admin.misi.destroy', $item) }}" onsubmit="return confirm('Hapus poin misi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1 rounded-md border border-primary-300 px-2.5 py-1.5 text-xs font-medium text-primary-600 transition-colors hover:bg-primary-50">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </li>
                    <li id="misi-edit-{{ $item->id }}" class="hidden bg-neutral-50 px-6 py-3">
                        <form method="POST" action="{{ route('admin.misi.update', $item) }}" class="flex items-end gap-2">
                            @csrf
                            @method('PUT')
                            <div class="flex-1">
                                <label class="mb-1 block text-[11px] font-medium text-neutral-500">Teks</label>
                                <input type="text" name="text" value="{{ $item->text }}" required
                                       class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
                            </div>
                            <div class="w-20">
                                <label class="mb-1 block text-[11px] font-medium text-neutral-500">Urutan</label>
                                <input type="number" name="order" value="{{ $item->order }}" min="0"
                                       class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
                            </div>
                            <button type="submit" class="rounded-lg bg-navy-500 px-3 py-2 text-xs font-semibold text-white hover:bg-navy-700">Simpan</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('admin.misi.store') }}" class="flex items-end gap-2 border-t border-neutral-200 px-6 py-4">
            @csrf
            <div class="flex-1">
                <label class="mb-1 block text-[11px] font-medium text-neutral-500">Tambah poin misi baru</label>
                <input type="text" name="text" required placeholder="Tulis poin misi..."
                       class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
            </div>
            <button type="submit" class="rounded-lg bg-primary-500 px-3.5 py-2 text-xs font-semibold text-white hover:bg-primary-600">Tambah</button>
        </form>
    </div>
</div>

<div class="mt-4 rounded-lg border border-gold-500/30 bg-gold-100 px-4 py-3 text-sm text-gold-600">
    Landing page saat ini menampilkan Visi &amp; Misi lewat file bahasa (4 bahasa: ID/EN/FR/ES). Menyambungkan form ini ke halaman publik memerlukan keputusan terpisah soal strategi terjemahan.
</div>

@endsection
