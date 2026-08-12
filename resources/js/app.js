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
