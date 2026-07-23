<div id="mvpnSplash" class="mvpn-splash" aria-hidden="true">

    <video
        id="mvpnGarudaVideo"
        class="mvpn-splash-video"
        src="{{ asset('assets/video/garuda-intro.mp4') }}"
        autoplay
        muted
        playsinline
        preload="auto"
    ></video>

    <div class="mvpn-splash-vignette"></div>

    <div class="mvpn-splash-brand" id="mvpnSplashBrand">
        <img src="{{ asset('assets/img/mvpn.png') }}" alt="MVP.N" class="mvpn-splash-logo">
        <div class="mvpn-splash-name">MVP.N</div>
        <div class="mvpn-splash-tagline">{{ __('site.home.hero_subtitle') }}</div>
    </div>
</div>

<style>
    .mvpn-splash {
        position: fixed;
        inset: 0;
        z-index: 99999;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        overflow: hidden;
        background: #05090F;
        transition: opacity .7s ease, visibility .7s ease;
    }

    .mvpn-splash.mvpn-splash-hide {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    .mvpn-splash-video {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .mvpn-splash-vignette {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(to top, rgba(5,9,15,.92) 0%, rgba(5,9,15,.35) 32%, rgba(5,9,15,0) 60%),
            linear-gradient(to bottom, rgba(5,9,15,.55) 0%, rgba(5,9,15,0) 22%);
        pointer-events: none;
    }

    .mvpn-splash-brand {
        position: relative;
        z-index: 2;
        margin-bottom: 9vh;
        text-align: center;
        opacity: 0;
        transform: translateY(18px) scale(.96);
        transition: opacity .9s cubic-bezier(.22,.9,.3,1), transform .9s cubic-bezier(.22,.9,.3,1);
    }

    .mvpn-splash-brand.mvpn-brand-in {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    .mvpn-splash-logo {
        width: 60px;
        height: auto;
        filter: drop-shadow(0 0 18px rgba(212,160,23,.5));
        margin-bottom: 12px;
    }

    .mvpn-splash-name {
        font-family: var(--font-display, 'Poppins', sans-serif);
        font-weight: 800;
        letter-spacing: 4px;
        font-size: clamp(1.5rem, 4vw, 2.2rem);
        background: linear-gradient(120deg, #FBEFD2, #E8B84B 45%, #D4A017 70%, #FBEFD2);
        background-size: 220% auto;
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        animation: mvpnShimmer 2.8s linear infinite;
    }

    @keyframes mvpnShimmer {
        to { background-position: -220% center; }
    }

    .mvpn-splash-tagline {
        margin-top: 8px;
        color: rgba(255,255,255,.75);
        font-size: clamp(.65rem, 1.6vw, .82rem);
        letter-spacing: 3px;
        text-transform: uppercase;
    }

    @media (max-width: 575.98px) {
        .mvpn-splash-brand { margin-bottom: 7vh; }
    }

    @media (prefers-reduced-motion: reduce) {
        .mvpn-splash-brand { transition: none; }
    }

    body.mvpn-splash-lock { overflow: hidden; height: 100vh; }
</style>

<script>
(function () {
    var SPLASH_KEY = 'mvpnSplashShown';
    var splash = document.getElementById('mvpnSplash');
    if (!splash) return;

    if (sessionStorage.getItem(SPLASH_KEY)) {
        splash.remove();
        return;
    }
    sessionStorage.setItem(SPLASH_KEY, '1');

    document.body.classList.add('mvpn-splash-lock');

    var video = document.getElementById('mvpnGarudaVideo');
    var brand = document.getElementById('mvpnSplashBrand');
    var HOLD_MS = 2600;
    var HIDE_MS = 700;
    var SAFETY_MS = 11000;
    var finished = false;

    function showBrand() {
        brand.classList.add('mvpn-brand-in');
    }

    function finish() {
        if (finished) return;
        finished = true;
        showBrand();
        setTimeout(function () {
            splash.classList.add('mvpn-splash-hide');
            document.body.classList.remove('mvpn-splash-lock');
            setTimeout(function () {
                splash.remove();
            }, HIDE_MS);
        }, HOLD_MS);
    }

    function skip() {
        finished = true;
        splash.remove();
        document.body.classList.remove('mvpn-splash-lock');
    }

    video.addEventListener('timeupdate', function () {
        if (video.duration && video.currentTime >= video.duration - 1.2) {
            showBrand();
        }
    });

    video.addEventListener('ended', finish);
    video.addEventListener('error', skip);

    setTimeout(finish, SAFETY_MS);
})();
</script>
