@extends('admin.layout')

@section('title', 'Visi & Misi')

@section('content')

<div class="mb-6">
    <h1 class="font-display text-2xl font-semibold text-neutral-950">Visi &amp; Misi</h1>
    <p class="mt-1 text-sm text-neutral-500">Teks ini tampil langsung di halaman utama pada bagian "Visi & Misi".</p>
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
                          placeholder="{{ $visiMisi->visi_text }}"
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
            <p class="border-b border-neutral-100 px-6 py-2 text-xs text-neutral-500">Seret pakai ikon titik-titik untuk mengubah urutan tampil di halaman utama.</p>
            <ul class="js-reorder-grid divide-y divide-neutral-100">
                @foreach($misiItems as $item)
                    <li class="js-reorder-card flex items-start justify-between gap-3 bg-white px-6 py-3" data-id="{{ $item->id }}" draggable="false">
                        <button type="button"
                                class="js-drag-handle touch-none flex h-7 w-7 shrink-0 cursor-grab items-center justify-center rounded-md text-neutral-400 hover:text-neutral-600 active:cursor-grabbing"
                                aria-label="Seret untuk mengubah urutan" title="Seret untuk mengubah urutan">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor"><circle cx="9" cy="6" r="1.4"/><circle cx="15" cy="6" r="1.4"/><circle cx="9" cy="12" r="1.4"/><circle cx="15" cy="12" r="1.4"/><circle cx="9" cy="18" r="1.4"/><circle cx="15" cy="18" r="1.4"/></svg>
                        </button>
                        <p class="min-w-0 flex-1 text-sm text-neutral-800">{{ $item->text }}</p>
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
                            <input type="hidden" name="order" value="{{ $item->order }}">
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
    Teks di atas mengisi bagian "Visi & Misi" di halaman utama (bahasa Indonesia). Jika kosong, halaman publik otomatis kembali menampilkan teks default dari file bahasa.
</div>

<script>
document.querySelectorAll('.js-reorder-grid').forEach(function (grid) {
    let draggedCard = null;

    grid.querySelectorAll('.js-drag-handle').forEach(function (handle) {
        // MOUSE (native HTML5 drag-and-drop)
        handle.addEventListener('mousedown', function () {
            handle.closest('.js-reorder-card').draggable = true;
        });
        handle.addEventListener('mouseup', function () {
            handle.closest('.js-reorder-card').draggable = false;
        });

        // TOUCH (HTML5 DnD has no touch support, so this is a separate path)
        handle.addEventListener('touchstart', function () {
            draggedCard = handle.closest('.js-reorder-card');
            draggedCard.classList.add('opacity-40');
        }, { passive: true });

        handle.addEventListener('touchmove', function (e) {
            if (!draggedCard) return;
            e.preventDefault();
            const touch = e.touches[0];
            const target = document.elementFromPoint(touch.clientX, touch.clientY);
            const card = target && target.closest('.js-reorder-card');
            if (!card || card === draggedCard || !grid.contains(card)) return;
            const rect = card.getBoundingClientRect();
            const isAfter = touch.clientY > rect.top + rect.height / 2;
            card.parentNode.insertBefore(draggedCard, isAfter ? card.nextSibling : card);
        }, { passive: false });

        handle.addEventListener('touchend', function () {
            if (!draggedCard) return;
            draggedCard.classList.remove('opacity-40');
            persistOrder(grid);
            draggedCard = null;
        });
    });

    grid.addEventListener('dragstart', function (e) {
        const card = e.target.closest('.js-reorder-card');
        if (!card) return;
        draggedCard = card;
        e.dataTransfer.effectAllowed = 'move';
        setTimeout(function () { card.classList.add('opacity-40'); }, 0);
    });

    grid.addEventListener('dragover', function (e) {
        e.preventDefault();
        const card = e.target.closest('.js-reorder-card');
        if (!card || card === draggedCard || !draggedCard) return;
        const rect = card.getBoundingClientRect();
        const isAfter = e.clientY > rect.top + rect.height / 2;
        card.parentNode.insertBefore(draggedCard, isAfter ? card.nextSibling : card);
    });

    grid.addEventListener('dragend', function () {
        if (!draggedCard) return;
        draggedCard.classList.remove('opacity-40');
        draggedCard.draggable = false;
        persistOrder(grid);
        draggedCard = null;
    });

    function persistOrder(grid) {
        const ids = Array.from(grid.querySelectorAll('.js-reorder-card')).map(function (el) {
            return el.dataset.id;
        });

        fetch('{{ route("admin.misi.reorder") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ ids: ids }),
        });
    }
});
</script>

@endsection
