(() => {
    'use strict';

    const section = document.getElementById('filosofi-logo');
    if (!section) return;

    const items = [...section.querySelectorAll('[data-philosophy-item]')];
    const markers = [...section.querySelectorAll('[data-marker]')];
    const connectors = [...section.querySelectorAll('[data-connector]')];
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const desktop = window.matchMedia('(min-width: 992px)');
    let selected = 0;

    function highlight(index) {
        markers.forEach((marker, i) => {
            marker.classList.toggle('is-active', i === index);
            if (i === index) marker.setAttribute('aria-current', 'true');
            else marker.removeAttribute('aria-current');
        });
        connectors.forEach((line, i) => line.classList.toggle('is-active', i === index));
    }

    // All explanations are expanded in the HTML so they remain readable without JS.
    items.forEach((item, index) => { item.open = index === selected; });
    items.forEach((item, index) => {
        item.addEventListener('toggle', () => {
            if (!item.open) return;
            selected = index;
            items.forEach((other) => { if (other !== item) other.open = false; });
            highlight(index);
            scheduleMeasure();
        });
        item.querySelector('summary').addEventListener('focus', () => highlight(index));
        item.addEventListener('pointerenter', (event) => { if (event.pointerType === 'mouse') highlight(index); });
        item.addEventListener('pointerleave', () => highlight(selected));
    });
    markers.forEach((marker, index) => {
        marker.addEventListener('click', (event) => {
            event.preventDefault();
            selected = index;
            items[index].open = true;
            highlight(index);
            if (!desktop.matches) {
                items[index].querySelector('summary').focus({ preventScroll: true });
                items[index].scrollIntoView({ behavior: reducedMotion.matches ? 'instant' : 'smooth', block: 'nearest' });
            }
        });
        marker.addEventListener('focus', () => highlight(index));
        marker.addEventListener('pointerenter', (event) => { if (event.pointerType === 'mouse') highlight(index); });
        marker.addEventListener('pointerleave', () => highlight(selected));
    });
    highlight(selected);

    if ('IntersectionObserver' in window) {
        const reveal = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-visible');
                reveal.unobserve(entry.target);
            });
        }, { threshold: 0.12 });
        [section.querySelector('.philosophy-heading'), ...items].forEach((element) => reveal.observe(element));
    }

    const source = document.querySelector('#tentang .tentang-logo');
    const destination = section.querySelector('.philosophy-logo');
    const visual = section.querySelector('.philosophy-visual');
    const figure = section.querySelector('.philosophy-figure');
    let traveler;
    let geometry;
    let enabled = false;
    let frame = 0;
    let needsMeasure = true;

    function measure() {
        if (!enabled) return;
        const origin = source.getBoundingClientRect();
        const target = destination.getBoundingClientRect();
        const naturalTop = visual.getBoundingClientRect().top + window.scrollY;
        const stickyTop = parseFloat(getComputedStyle(figure).top) || 100;
        const sourceY = origin.top + window.scrollY;
        const start = sourceY + origin.height / 2 - window.innerHeight * 0.45;
        const end = naturalTop - Math.max(stickyTop, window.innerHeight * 0.52 - target.height / 2);
        geometry = { x: origin.left, y: sourceY, width: origin.width, start, end: Math.max(start + 1, end) };
        traveler.style.width = `${origin.width}px`;
        traveler.style.height = `${origin.height}px`;
    }

    function render() {
        frame = 0;
        if (!enabled) return;
        if (needsMeasure) { measure(); needsMeasure = false; }
        const progress = Math.min(1, Math.max(0, (window.scrollY - geometry.start) / (geometry.end - geometry.start)));
        const flying = progress > 0 && progress < 1;
        source.classList.toggle('philosophy-source-hidden', progress > 0);
        section.classList.toggle('is-landed', progress >= 1);
        traveler.hidden = !flying;
        if (!flying) return;

        // Smoothstep ties the entire flight to scroll, including reverse scrolling.
        const eased = progress * progress * (3 - 2 * progress);
        const target = destination.getBoundingClientRect();
        const x = geometry.x + (target.left - geometry.x) * eased;
        const y = geometry.y - window.scrollY + (target.top - (geometry.y - window.scrollY)) * eased;
        const scale = 1 + (target.width / geometry.width - 1) * eased;
        traveler.style.transform = `translate3d(${x}px, ${y}px, 0) scale(${scale})`;
    }

    function schedule() {
        if (!frame && enabled) frame = requestAnimationFrame(render);
    }

    function scheduleMeasure() { needsMeasure = true; schedule(); }

    function configure() {
        enabled = Boolean(source && source.complete && source.naturalWidth && desktop.matches && !reducedMotion.matches);
        section.classList.toggle('has-flight', enabled);
        if (!enabled) {
            source?.classList.remove('philosophy-source-hidden');
            section.classList.add('is-landed');
            if (traveler) traveler.hidden = true;
            return;
        }
        if (!traveler) {
            traveler = document.createElement('img');
            traveler.src = source.currentSrc || source.src;
            traveler.alt = '';
            traveler.setAttribute('aria-hidden', 'true');
            traveler.className = 'philosophy-traveler';
            traveler.hidden = true;
            document.body.append(traveler);
        }
        scheduleMeasure();
    }

    window.addEventListener('scroll', schedule, { passive: true });
    window.addEventListener('resize', scheduleMeasure, { passive: true });
    window.addEventListener('pageshow', scheduleMeasure);
    desktop.addEventListener('change', configure);
    reducedMotion.addEventListener('change', configure);
    source?.addEventListener('load', configure);
    destination.addEventListener('load', scheduleMeasure);
    if ('ResizeObserver' in window) {
        const resize = new ResizeObserver(scheduleMeasure);
        if (source) resize.observe(source);
        resize.observe(section);
        const about = document.getElementById('tentang');
        if (about) resize.observe(about);
    }
    document.fonts?.ready.then(scheduleMeasure);
    configure();
})();
