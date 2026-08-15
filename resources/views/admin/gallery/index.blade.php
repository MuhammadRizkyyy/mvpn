@extends('admin.layout')

@section('title', 'Galeri Dokumentasi')

@section('content')

<div class="mb-6">
    <h1 class="font-display text-2xl font-semibold text-neutral-950">Galeri Dokumentasi</h1>
    <p class="mt-1 text-sm text-neutral-500">Unggah dan kelola foto kegiatan yang tampil di halaman dokumentasi.</p>
</div>

<div class="grid grid-cols-1 gap-5 lg:grid-cols-[460px_1fr]">

    {{-- UPLOAD FORM --}}
    <div class="h-fit rounded-xl border border-neutral-200 bg-white p-5">
        <h2 class="text-sm font-semibold text-neutral-950">Unggah Foto</h2>
        <form action="/admin/gallery" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
            @csrf

            <div>
                <label for="image" class="mb-1.5 block text-xs font-medium text-neutral-600">Foto</label>
                <input type="file" name="image" id="image" accept="image/jpeg,image/png" required onchange="previewImage(this, 'image-preview')"
                       class="block w-full rounded-lg border border-neutral-300 text-sm text-neutral-600 file:mr-3 file:rounded-md file:border-0 file:bg-navy-500 file:px-3 file:py-2 file:text-xs file:font-medium file:text-white hover:file:bg-navy-700">
                <img id="image-preview" src="" alt="Preview foto" class="mt-3 hidden aspect-square w-full rounded-lg border border-neutral-200 bg-neutral-100 object-contain">
            </div>

            <div>
                <label for="title" class="mb-1.5 block text-xs font-medium text-neutral-600">Judul</label>
                <input type="text" name="title" id="title" placeholder="Judul foto"
                       class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
            </div>

            @include('admin.articles._content-editor', [
                'fieldId' => 'description',
                'name' => 'description',
                'label' => 'Deskripsi',
                'minHeight' => '260px',
            ])

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
    <h2 class="mb-1 text-sm font-semibold text-neutral-950">Semua Foto ({{ $galleries->count() }})</h2>

    @if($galleries->isEmpty())
        <div class="mt-4 rounded-xl border border-dashed border-neutral-300 px-5 py-12 text-center">
            <p class="text-sm font-medium text-neutral-800">Belum ada foto dokumentasi</p>
            <p class="mt-1 text-sm text-neutral-500">Unggah foto pertama lewat form di atas.</p>
        </div>
    @else
        <p class="mb-4 text-xs text-neutral-500">Seret pakai ikon titik-titik untuk mengubah urutan tampil.</p>

        <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-neutral-200 bg-neutral-50 text-xs uppercase text-neutral-500">
                    <tr>
                        <th class="w-10 px-3 py-3 font-medium"></th>
                        <th class="px-5 py-3 font-medium">Foto</th>
                        <th class="px-5 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="js-reorder-list divide-y divide-neutral-100">
                @foreach($galleries as $item)
                    <tr class="js-reorder-item" data-id="{{ $item->id }}">
                        <td class="px-3 py-3">
                            <button type="button"
                                    class="js-drag-handle touch-none flex h-7 w-7 shrink-0 cursor-grab items-center justify-center rounded-md text-neutral-400 hover:text-neutral-600 active:cursor-grabbing"
                                    aria-label="Seret untuk mengubah urutan" title="Seret untuk mengubah urutan">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><circle cx="9" cy="6" r="1.4"/><circle cx="15" cy="6" r="1.4"/><circle cx="9" cy="12" r="1.4"/><circle cx="15" cy="12" r="1.4"/><circle cx="9" cy="18" r="1.4"/><circle cx="15" cy="18" r="1.4"/></svg>
                            </button>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ $item->image }}" alt="{{ $item->title ?? 'Foto kegiatan' }}" class="h-10 w-14 shrink-0 rounded-md object-cover" draggable="false">
                                <div class="min-w-0">
                                    <p class="truncate font-medium text-neutral-800">{{ $item->title ?: 'Tanpa judul' }}</p>
                                    @if($item->description)
                                        <p class="mt-0.5 line-clamp-1 text-xs text-neutral-500">{{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($item->description), ENT_QUOTES), 120) }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <button type="button"
                                        onclick="openEditModal({{ $item->id }}, {{ Js::from($item->title) }}, {{ Js::from($item->description) }}, {{ Js::from($item->image) }})"
                                        class="text-xs font-medium text-navy-500 hover:text-navy-700">
                                    Edit
                                </button>
                                <form action="/admin/gallery/{{ $item->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="openDeleteModal(this)" class="text-xs font-medium text-primary-600 hover:text-primary-700">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

{{-- EDIT MODAL --}}
<div id="editModal" class="invisible fixed inset-0 z-50 flex items-center justify-center bg-navy-900/50 p-4 opacity-0 transition-opacity">
    <div class="w-full max-w-lg rounded-xl bg-white p-5 shadow-lg max-h-[90vh] overflow-y-auto">
        <h3 class="text-base font-semibold text-neutral-950">Edit Foto</h3>

        <form id="editForm" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="edit-image" class="mb-1.5 block text-xs font-medium text-neutral-600">Ganti Foto (opsional)</label>
                <input type="file" name="image" id="edit-image" accept="image/jpeg,image/png" onchange="previewImage(this, 'edit-image-preview')"
                       class="block w-full rounded-lg border border-neutral-300 text-sm text-neutral-600 file:mr-3 file:rounded-md file:border-0 file:bg-navy-500 file:px-3 file:py-2 file:text-xs file:font-medium file:text-white hover:file:bg-navy-700">
                <img id="edit-image-preview" src="" alt="Preview foto" class="mt-3 hidden aspect-square w-full rounded-lg border border-neutral-200 bg-neutral-100 object-contain">
            </div>

            <div>
                <label for="edit-title" class="mb-1.5 block text-xs font-medium text-neutral-600">Judul</label>
                <input type="text" name="title" id="edit-title" placeholder="Judul foto"
                       class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
            </div>

            @include('admin.articles._content-editor', [
                'fieldId' => 'edit-description',
                'name' => 'description',
                'label' => 'Deskripsi',
                'minHeight' => '260px',
            ])

            <div class="flex justify-end gap-2 pt-1">
                <button type="button" onclick="closeEditModal()"
                        class="rounded-md border border-neutral-300 px-3.5 py-2 text-sm font-medium text-neutral-700 hover:bg-neutral-50">
                    Batal
                </button>
                <button type="submit"
                        class="rounded-md bg-primary-500 px-3.5 py-2 text-sm font-semibold text-white hover:bg-primary-600">
                    Simpan
                </button>
            </div>
        </form>
    </div>
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
    function updateCounter(input, counterId) {
        document.getElementById(counterId).textContent = input.value.length;
    }

    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);

        if (!input.files || !input.files[0]) {
            preview.src = '';
            preview.classList.add('hidden');
            return;
        }

        preview.src = URL.createObjectURL(input.files[0]);
        preview.classList.remove('hidden');
    }

    function openEditModal(id, title, description, image) {
        const form = document.getElementById('editForm');
        form.action = '/admin/gallery/' + id;

        const titleInput = document.getElementById('edit-title');
        const descriptionInput = document.getElementById('edit-description');
        titleInput.value = title || '';
        descriptionInput.value = description || '';

        const descriptionQuill = window.__quillEditors && window.__quillEditors['edit-description'];
        if (descriptionQuill) {
            descriptionQuill.setText('');
            if (description) {
                descriptionQuill.clipboard.dangerouslyPasteHTML(description);
            }
        }

        document.getElementById('edit-image').value = '';

        const preview = document.getElementById('edit-image-preview');
        preview.src = image || '';
        preview.classList.toggle('hidden', !image);

        const modal = document.getElementById('editModal');
        modal.classList.remove('invisible', 'opacity-0');
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('invisible', 'opacity-0');
    }

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

    document.querySelectorAll('.js-reorder-list').forEach(function (list) {
        let draggedItem = null;

        function moveItem(item) {
            if (!item || item === draggedItem || !list.contains(item)) return;
            const items = Array.from(list.children);
            const draggedIndex = items.indexOf(draggedItem);
            const targetIndex = items.indexOf(item);
            if (draggedIndex < targetIndex) {
                item.after(draggedItem);
            } else {
                item.before(draggedItem);
            }
        }

        list.querySelectorAll('.js-drag-handle').forEach(function (handle) {
            // MOUSE (native HTML5 drag-and-drop)
            handle.addEventListener('mousedown', function () {
                handle.closest('.js-reorder-item').draggable = true;
            });
            handle.addEventListener('mouseup', function () {
                handle.closest('.js-reorder-item').draggable = false;
            });

            // TOUCH (HTML5 DnD has no touch support, so this is a separate path)
            handle.addEventListener('touchstart', function () {
                draggedItem = handle.closest('.js-reorder-item');
                draggedItem.classList.add('opacity-40');
            }, { passive: true });

            handle.addEventListener('touchmove', function (e) {
                if (!draggedItem) return;
                e.preventDefault();
                const touch = e.touches[0];
                const target = document.elementFromPoint(touch.clientX, touch.clientY);
                const item = target && target.closest('.js-reorder-item');
                moveItem(item);
            }, { passive: false });

            handle.addEventListener('touchend', function () {
                if (!draggedItem) return;
                draggedItem.classList.remove('opacity-40');
                persistOrder(list);
                draggedItem = null;
            });
        });

        list.addEventListener('dragstart', function (e) {
            const item = e.target.closest('.js-reorder-item');
            if (!item) return;
            draggedItem = item;
            e.dataTransfer.effectAllowed = 'move';
            setTimeout(function () { item.classList.add('opacity-40'); }, 0);
        });

        list.addEventListener('dragover', function (e) {
            e.preventDefault();
            const item = e.target.closest('.js-reorder-item');
            moveItem(item);
        });

        list.addEventListener('dragend', function () {
            if (!draggedItem) return;
            draggedItem.classList.remove('opacity-40');
            draggedItem.draggable = false;
            persistOrder(list);
            draggedItem = null;
        });

        function persistOrder(list) {
            const ids = Array.from(list.querySelectorAll('.js-reorder-item')).map(function (el) {
                return el.dataset.id;
            });

            fetch('{{ route("gallery.reorder") }}', {
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
