<footer class="footer-brand py-4 mt-auto">
    <div class="container text-center">
    <p class="mb-0">{{ __('site.footer.copyright', ['year' => date('Y')]) }}</p>
</footer>
<style>
    footer {
        margin-top: auto;
    }

    .footer-brand {
        background: var(--color-navy-900);
        color: #fff;
        border-top: 3px solid var(--color-gold-500);
    }

    .footer-brand p {
        opacity: 0.85;
        font-size: 0.9rem;
    }

    body, html {
        min-height: 100vh;
    }

    body {
        display: flex;
        flex-direction: column;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const navMenu = document.getElementById('navMenu');
    if (!navMenu) return;

    navMenu.querySelectorAll('.nav-link[data-section]').forEach(link => {
        link.addEventListener('click', (e) => {
            const target = document.getElementById(link.dataset.section);

            if (target) {
                // Scroll manual, tanpa mengubah URL jadi "#section" —
                // supaya address bar tetap bersih dan load berikutnya selalu dari Beranda.
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

            if (navMenu.classList.contains('show')) {
                bootstrap.Collapse.getOrCreateInstance(navMenu).hide();
            }
        });
    });
});
</script>
</body>
</html>
