<footer class="footer-brand pt-5 pb-4 mt-auto">
    <div class="container">
        <div class="row gy-4 align-items-start">
            <div class="col-12 col-md-5">
                <a href="/" class="d-inline-flex align-items-center text-white text-decoration-none mb-3">
                    <img src="{{ asset('assets/img/mvpn.png') }}" width="40" class="me-2" alt="MVP.N">
                    <span class="fw-bold fs-5 font">MVP.N</span>
                </a>
                <p class="footer-tagline mb-0">{{ __('site.home.hero_subtitle') }}</p>
            </div>

            <div class="col-6 col-md-3">
                <h6 class="footer-heading">{{ __('site.nav.beranda') }}</h6>
                <ul class="footer-links list-unstyled">
                    <li><a href="{{ request()->routeIs('index1') ? '#tentang' : '/#tentang' }}">{{ __('site.nav.tentang') }}</a></li>
                    <li><a href="{{ request()->routeIs('index1') ? '#visimisi' : '/#visimisi' }}">{{ __('site.nav.visi_misi') }}</a></li>
                    <li><a href="{{ request()->routeIs('index1') ? '#struktur' : '/#struktur' }}">{{ __('site.nav.struktur') }}</a></li>
                    <li><a href="{{ request()->routeIs('index1') ? '#proker' : '/#proker' }}">{{ __('site.nav.proker') }}</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-4">
                <h6 class="footer-heading">{{ __('site.nav.kemitraan') }}</h6>
                <ul class="footer-links list-unstyled">
                    <li><a href="{{ request()->routeIs('index1') ? '#dokumentasi' : '/#dokumentasi' }}">{{ __('site.nav.galeri') }}</a></li>
                    <li><a href="{{ request()->routeIs('index1') ? '#mitra' : '/#mitra' }}">{{ __('site.nav.kemitraan') }}</a></li>
                    <li><a href="{{ request()->routeIs('index1') ? '#kerjasama' : '/#kerjasama' }}">{{ __('site.nav.kerjasama') }}</a></li>
                </ul>
            </div>
        </div>

        <hr class="footer-divider">

        <p class="mb-0 text-center text-md-start footer-copy">{{ __('site.footer.copyright', ['year' => date('Y')]) }}</p>
    </div>
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

    .footer-tagline {
        color: rgba(255,255,255,0.6);
        font-size: 0.88rem;
        max-width: 320px;
        line-height: 1.6;
    }

    .footer-heading {
        color: #fff;
        font-weight: 700;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    .footer-links {
        margin: 0;
        padding: 0;
    }

    .footer-links li {
        margin-bottom: 10px;
    }

    .footer-links a {
        color: rgba(255,255,255,0.65);
        text-decoration: none;
        font-size: 0.92rem;
        transition: color .2s, padding-left .2s;
    }

    .footer-links a:hover {
        color: var(--color-gold-500);
        padding-left: 4px;
    }

    .footer-divider {
        border-color: rgba(255,255,255,0.12);
        margin: 32px 0 20px;
    }

    .footer-copy {
        opacity: 0.6;
        font-size: 0.85rem;
    }

    body, html {
        min-height: 100vh;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    .mvpn-spinner {
        display: inline-block;
        width: 0.9em;
        height: 0.9em;
        border: 2px solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        animation: mvpn-spin 0.6s linear infinite;
        vertical-align: -0.15em;
        margin-right: 6px;
    }

    @keyframes mvpn-spin {
        to { transform: rotate(360deg); }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('submit', function (event) {
    const form = event.target;
    if (!(form instanceof HTMLFormElement) || form.hasAttribute('data-no-loading')) {
        return;
    }

    const submitBtn = form.querySelector('button[type="submit"]:not(:disabled)');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="mvpn-spinner"></span>' + submitBtn.innerHTML;
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.querySelector('.navbar-custom');
    if (navbar) {
        const hasOverlay = navbar.classList.contains('navbar-transparent');
        const threshold = hasOverlay ? 80 : 8;
        const toggleScrolled = () => {
            const scrolled = window.scrollY > threshold;
            navbar.classList.toggle('navbar-scrolled', scrolled);
            if (hasOverlay) {
                navbar.classList.toggle('navbar-transparent', !scrolled);
            }
        };
        toggleScrolled();
        window.addEventListener('scroll', toggleScrolled, { passive: true });
    }

    const revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
    if (revealEls.length) {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal-in');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });

        revealEls.forEach(el => revealObserver.observe(el));
    }

    const staggerEls = document.querySelectorAll('.reveal-stagger');
    if (staggerEls.length) {
        const staggerObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('stagger-in');
                    staggerObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.4 });

        staggerEls.forEach(el => staggerObserver.observe(el));
    }
});
</script>
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
