<div class="mvpn-join-pop" id="mvpnJoinPop" hidden>
    <div class="mvpn-join-card" role="dialog" aria-modal="true" aria-labelledby="mvpnJoinTitle">
        <button type="button" class="mvpn-join-close" id="mvpnJoinClose" aria-label="Tutup">&times;</button>

        <div class="mvpn-join-body">
            <img src="{{ asset('assets/img/mvpn.png') }}" alt="MVP.N" class="mvpn-join-logo">
            <div class="mvpn-join-eyebrow">MVP.N</div>
            <h2 class="mvpn-join-title" id="mvpnJoinTitle">{{ __('site.keanggotaan.title') }}</h2>
            <p class="mvpn-join-text">{{ __('site.keanggotaan.subtitle') }}</p>
        </div>

        <a href="{{ route('keanggotaan.form') }}" class="mvpn-join-cta">
            {{ __('site.nav.keanggotaan') }} <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</div>

<style>
    .mvpn-join-pop {
        position: fixed;
        inset: 0;
        z-index: 99998;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(5,9,15,.72);
        backdrop-filter: blur(4px);
        opacity: 0;
        transition: opacity .4s var(--ease-material, ease);
    }

    .mvpn-join-pop.mvpn-join-in { opacity: 1; }

    .mvpn-join-card {
        position: relative;
        width: min(92vw, 420px);
        aspect-ratio: 4 / 5;
        max-height: 88vh;
        border-radius: 24px;
        overflow: hidden;
        background: #12233B url("{{ asset('assets/img/join-keanggotaan.png') }}") right center / cover no-repeat;
        box-shadow: 0 30px 70px rgba(0,0,0,.55);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transform: translateY(24px) scale(.96);
        transition: transform .5s var(--ease-material, ease);
    }

    .mvpn-join-in .mvpn-join-card { transform: none; }

    /* Scrim kiri supaya teks tetap terbaca di atas ilustrasi */
    .mvpn-join-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(100deg, rgba(5,9,15,.92) 0%, rgba(5,9,15,.7) 45%, rgba(5,9,15,0) 78%);
    }

    .mvpn-join-body {
        position: relative;
        padding: 30px 26px 0;
        max-width: 72%;
        color: #fff;
    }

    .mvpn-join-logo {
        width: 44px;
        height: auto;
        filter: drop-shadow(0 0 14px rgba(212,160,23,.45));
    }

    .mvpn-join-eyebrow {
        margin-top: 8px;
        font-size: .68rem;
        font-weight: 700;
        letter-spacing: 3px;
        color: var(--color-gold-400, #E8B84B);
    }

    .mvpn-join-title {
        margin: 10px 0 0;
        font-family: var(--font-display, 'Poppins', sans-serif);
        font-weight: 800;
        font-size: clamp(1.35rem, 5.2vw, 1.75rem);
        line-height: 1.15;
    }

    .mvpn-join-text {
        margin: 12px 0 0;
        font-size: .88rem;
        line-height: 1.5;
        color: rgba(255,255,255,.8);
    }

    .mvpn-join-cta {
        position: relative;
        margin: 0 22px 22px;
        padding: 15px 20px;
        border-radius: 999px;
        text-align: center;
        font-weight: 700;
        color: #fff;
        background: var(--color-primary-500, #CE1126);
        box-shadow: 0 14px 30px rgba(206,17,38,.45);
        transition: transform .25s var(--ease-material, ease), background .25s;
    }

    .mvpn-join-cta:hover {
        color: #fff;
        background: var(--color-primary-600, #B00E20);
        transform: translateY(-2px);
    }

    .mvpn-join-close {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 3;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 50%;
        font-size: 1.4rem;
        line-height: 1;
        color: #fff;
        background: rgba(255,255,255,.16);
    }

    .mvpn-join-close:hover { background: rgba(255,255,255,.3); }

    @media (max-width: 400px) {
        .mvpn-join-body { max-width: 82%; padding: 24px 20px 0; }
    }

    @media (prefers-reduced-motion: reduce) {
        .mvpn-join-pop, .mvpn-join-card { transition: none; }
    }
</style>

<script>
(function () {
    var POP_KEY = 'mvpnJoinPopShown';
    var pop = document.getElementById('mvpnJoinPop');
    if (!pop || sessionStorage.getItem(POP_KEY)) {
        if (pop) pop.remove();
        return;
    }

    function open() {
        sessionStorage.setItem(POP_KEY, '1');
        pop.hidden = false;
        requestAnimationFrame(function () { pop.classList.add('mvpn-join-in'); });
    }

    function close() {
        pop.classList.remove('mvpn-join-in');
        setTimeout(function () { pop.remove(); }, 400);
    }

    document.getElementById('mvpnJoinClose').addEventListener('click', close);
    pop.addEventListener('click', function (e) { if (e.target === pop) close(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') close(); });

    // Muncul setelah splash video garuda selesai; kalau splash tidak ada, muncul sebentar setelah load.
    if (document.getElementById('mvpnSplash')) {
        document.addEventListener('mvpn:splash-done', open, { once: true });
    } else {
        setTimeout(open, 900);
    }
})();
</script>
