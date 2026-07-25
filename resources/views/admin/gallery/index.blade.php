@extends('admin.layout')

@section('title', 'Galeri Dokumentasi')

@section('content')

<div class="mb-6">
    <h1 class="font-display text-2xl font-semibold text-neutral-950">Galeri Dokumentasi</h1>
    <p class="mt-1 text-sm text-neutral-500">Unggah dan kelola foto kegiatan yang tampil di halaman dokumentasi.</p>
</div>

<div class="grid grid-cols-1 gap-5 lg:grid-cols-[380px_1fr]">

    {{-- UPLOAD FORM --}}
    <div class="h-fit rounded-xl border border-neutral-200 bg-white p-5">
        <h2 class="text-sm font-semibold text-neutral-950">Unggah Foto</h2>
        <form action="/admin/gallery" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
            @csrf

            <div>
                <label for="image" class="mb-1.5 block text-xs font-medium text-neutral-600">Foto</label>
                <input type="file" name="image" id="image" required
                       class="block w-full rounded-lg border border-neutral-300 text-sm text-neutral-600 file:mr-3 file:rounded-md file:border-0 file:bg-navy-500 file:px-3 file:py-2 file:text-xs file:font-medium file:text-white hover:file:bg-navy-700">
            </div>

            <div>
                <label for="title" class="mb-1.5 block text-xs font-medium text-neutral-600">Judul</label>
                <input type="text" name="title" id="title" placeholder="Judul foto"
                       class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
            </div>

            <div>
                <label for="description" class="mb-1.5 block text-xs font-medium text-neutral-600">Deskripsi</label>
                <textarea name="description" id="description" rows="3" placeholder="Deskripsi singkat"
                          class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500"></textarea>
            </div>

            <button type="submit"
                    class="w-full rounded-lg bg-primary-500 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-primary-600">
                Upload Foto
            </button>
        </form>
    </div>

    {{-- INFO PANEL --}}
    <div class="rounded-xl border border-neutral-200 bg-white p-5">
        <h2 class="text-sm font-semibold text-neutral-950">Info Galeri</h2>
        <div class="mt-4 grid grid-cols-2 gap-3">
            <div class="rounded-lg bg-neutral-50 p-3.5">
                <p class="text-xs text-neutral-500">Total Foto</p>
                <p class="mt-1 font-display text-xl font-semibold text-neutral-950">{{ $galleries->count() }}</p>
            </div>
            <div class="rounded-lg bg-neutral-50 p-3.5">
                <p class="text-xs text-neutral-500">Format</p>
                <p class="mt-1 font-display text-xl font-semibold text-neutral-950">JPG / PNG</p>
            </div>
            <div class="rounded-lg bg-neutral-50 p-3.5">
                <p class="text-xs text-neutral-500">Ukuran Maks</p>
                <p class="mt-1 font-display text-xl font-semibold text-neutral-950">5 MB</p>
            </div>
            <div class="rounded-lg bg-neutral-50 p-3.5">
                <p class="text-xs text-neutral-500">Tips</p>
                <p class="mt-1 text-sm font-medium text-neutral-800">Orientasi landscape lebih rapi ditampilkan</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 border-t border-neutral-200 pt-6">
    <h2 class="mb-4 text-sm font-semibold text-neutral-950">Semua Foto ({{ $galleries->count() }})</h2>

    @if($galleries->isEmpty())
        <div class="rounded-xl border border-dashed border-neutral-300 px-5 py-12 text-center">
            <p class="text-sm font-medium text-neutral-800">Belum ada foto dokumentasi</p>
            <p class="mt-1 text-sm text-neutral-500">Unggah foto pertama lewat form di atas.</p>
        </div>
    @else
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
        @foreach($galleries as $item)
            <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white">
                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title ?? 'Foto kegiatan' }}" class="aspect-square w-full object-cover">
                <div class="p-3">
                    <p class="truncate text-sm font-medium text-neutral-950">{{ $item->title ?: 'Tanpa judul' }}</p>
                    @if($item->description)
                        <p class="mt-0.5 line-clamp-2 text-xs text-neutral-500">{{ $item->description }}</p>
                    @endif

                    <form action="/admin/gallery/{{ $item->id }}" method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="openDeleteModal(this)"
                                class="flex w-full items-center justify-center gap-1.5 rounded-md border border-primary-300 py-1.5 text-xs font-medium text-primary-600 transition-colors hover:bg-primary-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
        </div>
    @endif
</div>

{{-- DELETE CONFIRM MODAL --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-navy-900/50 p-4">
    <div class="w-full max-w-sm rounded-xl bg-white p-5 shadow-lg">
        <h3 class="text-base font-semibold text-neutral-950">Hapus Foto</h3>
        <p class="mt-1 text-sm text-neutral-500">Foto ini akan dihapus permanen dan tidak bisa dikembalikan.</p>
        <div class="mt-5 flex justify-end gap-2">
            <button type="button" onclick="closeDeleteModal()"
                    class="rounded-md border border-neutral-300 px-3.5 py-2 text-sm font-medium text-neutral-700 hover:bg-neutral-50">
                Batal
            </button>
            <button type="button" id="confirmDelete"
                    class="rounded-md bg-primary-500 px-3.5 py-2 text-sm font-semibold text-white hover:bg-primary-600">
                Hapus
            </button>
        </div>
    </div>
</div>

<script>
    let formToSubmit = null;

    function openDeleteModal(button) {
        formToSubmit = button.closest('form');
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        formToSubmit = null;
    }

    document.getElementById('confirmDelete').addEventListener('click', function () {
        if (formToSubmit) formToSubmit.submit();
    });
</script>

@endsection
