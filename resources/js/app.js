import './bootstrap';

import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const flashEl = document.querySelector('[data-flash-success]');
    const message = flashEl?.dataset.flashSuccess;

    if (message) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: message,
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toastEl) => {
                toastEl.addEventListener('mouseenter', Swal.stopTimer);
                toastEl.addEventListener('mouseleave', Swal.resumeTimer);
            },
        });
    }
});

document.addEventListener('submit', function (event) {
    const form = event.target;
    if (!(form instanceof HTMLFormElement) || form.hasAttribute('data-confirm') || form.hasAttribute('data-no-loading')) {
        return;
    }

    const submitBtn = form.querySelector('button[type="submit"]:not(:disabled)');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="mvpn-spinner"></span>' + submitBtn.innerHTML;
    }
});

document.addEventListener('submit', function (event) {
    const form = event.target;
    if (!(form instanceof HTMLFormElement) || !form.hasAttribute('data-confirm')) {
        return;
    }

    event.preventDefault();

    Swal.fire({
        title: form.dataset.confirm || 'Anda yakin?',
        text: form.dataset.confirmText || 'Tindakan ini tidak dapat dibatalkan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: form.dataset.confirmButton || 'Ya, hapus',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});

// Reorder drag-and-drop generik: pasang `data-reorder-url` pada list-nya,
// tiap baris `.js-reorder-item[data-id]` dengan pegangan `.js-drag-handle`.
// List yang diurutkan per kelompok menambahkan `data-reorder-key` +
// `data-reorder-value` (mis. section/language) yang ikut dikirim ke server.
document.querySelectorAll('[data-reorder-url]').forEach(function (list) {
    let draggedItem = null;

    function moveItem(item) {
        if (!item || item === draggedItem || !list.contains(item)) return;
        const items = Array.from(list.children);
        if (items.indexOf(draggedItem) < items.indexOf(item)) {
            item.after(draggedItem);
        } else {
            item.before(draggedItem);
        }
    }

    function persistOrder() {
        const ids = Array.from(list.querySelectorAll('.js-reorder-item')).map((el) => el.dataset.id);

        const payload = { ids: ids };
        if (list.dataset.reorderKey) {
            payload[list.dataset.reorderKey] = list.dataset.reorderValue;
        }

        fetch(list.dataset.reorderUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify(payload),
        });
    }

    list.querySelectorAll('.js-drag-handle').forEach(function (handle) {
        const item = handle.closest('.js-reorder-item');

        // MOUSE (native HTML5 drag-and-drop)
        handle.addEventListener('mousedown', () => { item.draggable = true; });
        handle.addEventListener('mouseup', () => { item.draggable = false; });

        // TOUCH (HTML5 DnD tidak mendukung sentuhan, jadi jalur terpisah)
        handle.addEventListener('touchstart', function () {
            draggedItem = item;
            item.classList.add('opacity-40');
        }, { passive: true });

        handle.addEventListener('touchmove', function (e) {
            if (!draggedItem) return;
            e.preventDefault();
            const touch = e.touches[0];
            const target = document.elementFromPoint(touch.clientX, touch.clientY);
            moveItem(target && target.closest('.js-reorder-item'));
        }, { passive: false });

        handle.addEventListener('touchend', function () {
            if (!draggedItem) return;
            draggedItem.classList.remove('opacity-40');
            persistOrder();
            draggedItem = null;
        });
    });

    list.addEventListener('dragstart', function (e) {
        const item = e.target.closest('.js-reorder-item');
        if (!item) return;
        draggedItem = item;
        e.dataTransfer.effectAllowed = 'move';
        setTimeout(() => item.classList.add('opacity-40'), 0);
    });

    list.addEventListener('dragover', function (e) {
        e.preventDefault();
        if (draggedItem) moveItem(e.target.closest('.js-reorder-item'));
    });

    list.addEventListener('dragend', function () {
        if (!draggedItem) return;
        draggedItem.classList.remove('opacity-40');
        draggedItem.draggable = false;
        persistOrder();
        draggedItem = null;
    });
});
