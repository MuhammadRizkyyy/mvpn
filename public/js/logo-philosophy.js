(() => {
    'use strict';

    const section = document.getElementById('filosofi-logo');
    if (!section) return;

    const items = [...section.querySelectorAll('[data-philosophy-item]')];
    const markers = [...section.querySelectorAll('[data-marker]')];
    const connectors = [...section.querySelectorAll('[data-connector]')];
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const desktop = window.matchMedia('(min-width: 992px)');
    const stories = section.querySelector('.philosophy-stories');
    const panels = items.map((item, index) => ({
        item,
        summary: item.querySelector('summary'),
        body: item.querySelector('.philosophy-item-body'),
        expanded: index === 0,
        animation: null,
    }));
    let selected = 0;
    let revealTimer = 0;

    function finishPanel(panel) {
        panel.item.open = panel.expanded;
        panel.animation?.cancel();
        panel.animation = null;
        panel.item.classList.remove('is-resizing');
    }

    function expandPanel(panel, expanded) {
        if (panel.expanded === expanded) return;
        const startHeight = panel.item.getBoundingClientRect().height;
        panel.animation?.cancel();
        panel.animation = null;
        panel.expanded = expanded;
        panel.summary.setAttribute('aria-expanded', String(expanded));
        panel.body.inert = !expanded;

        if (reducedMotion.matches || !panel.item.animate) {
            finishPanel(panel);
            return;
        }

        // Keep <details> open while shrinking, then close it when the animation ends.
        // A second click starts from the current rendered height, even mid-animation.
        panel.item.open = true;
        const style = getComputedStyle(panel.item);
        const borders = parseFloat(style.borderTopWidth) + parseFloat(style.borderBottomWidth);
        const endHeight = panel.summary.getBoundingClientRect().height + borders
            + (expanded ? panel.body.getBoundingClientRect().height : 0);
        panel.item.classList.add('is-resizing');
        const animation = panel.item.animate(
            [{ height: `${startHeight}px` }, { height: `${endHeight}px` }],
            { duration: 360, easing: 'cubic-bezier(.22, .68, .3, 1)', fill: 'both' },
        );
        panel.animation = animation;
        animation.onfinish = () => {
            if (panel.animation !== animation) return;
            finishPanel(panel);
            scheduleMeasure();
        };
    }

    function selectPanel(index, expanded = true) {
        selected = index;
        panels.forEach((panel, i) => expandPanel(panel, i === index && expanded));
        highlight(index);
    }

    function finishIntroduction() {
        clearTimeout(revealTimer);
        revealTimer = 0;
        section.classList.add('is-introduced', 'is-explained');
        stories.inert = false;
    }

    function presentLanding(landed) {
        // Once the text has appeared, keep it readable when scrolling back up.
        if (section.classList.contains('is-explained')) return;
        stories.inert = true;
        if (!landed) {
            clearTimeout(revealTimer);
            revealTimer = 0;
            section.classList.remove('is-introduced');
            return;
        }
        section.classList.add('is-introduced');
        // Match the connector's 650 ms draw before revealing the explanations.
        if (!revealTimer) revealTimer = window.setTimeout(finishIntroduction, 650);
    }

    function highlight(index) {
        markers.forEach((marker, i) => {
            marker.classList.toggle('is-active', i === index);
            if (i === index) marker.setAttribute('aria-current', 'true');
            else marker.removeAttribute('aria-current');
        });
        connectors.forEach((line, i) => line.classList.toggle('is-active', i === index));
    }

    // All explanations are expanded in the HTML so they remain readable without JS.
    panels.forEach((panel) => {
        panel.item.open = panel.expanded;
        panel.summary.setAttribute('aria-expanded', String(panel.expanded));
        panel.body.inert = !panel.expanded;
    });
    items.forEach((item, index) => {
        item.querySelector('summary').addEventListener('click', (event) => {
            event.preventDefault();
            selectPanel(index, !panels[index].expanded);
        });
        item.querySelector('summary').addEventListener('focus', () => highlight(index));
        item.addEventListener('pointerenter', (event) => { if (event.pointerType === 'mouse') highlight(index); });
        item.addEventListener('pointerleave', () => highlight(selected));
    });
    markers.forEach((marker, index) => {
        marker.addEventListener('click', async (event) => {
            event.preventDefault();
            selectPanel(index);
            if (!desktop.matches) {
                items[index].querySelector('summary').focus({ preventScroll: true });
                // Wait for the preceding panel to collapse before choosing a scroll target.
                await Promise.all(panels.map((panel) => panel.animation?.finished.catch(() => {})));
                await new Promise(requestAnimationFrame);
                if (selected === index && panels[index].expanded && !desktop.matches) {
                    const top = items[index].getBoundingClientRect().top + window.scrollY - 110;
                    window.scrollTo({ top, behavior: reducedMotion.matches ? 'instant' : 'smooth' });
                }
            }
        });
        marker.addEventListener('focus', () => highlight(index));
        marker.addEventListener('pointerenter', (event) => { if (event.pointerType === 'mouse') highlight(index); });
        marker.addEventListener('pointerleave', () => highlight(selected));
    });
    highlight(selected);

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
        const end = naturalTop - Math.max(stickyTop, window.innerHeight * 0.62 - target.height / 2);
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
        presentLanding(progress >= 1);
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
        const eligible = Boolean(source && desktop.matches && !reducedMotion.matches);
        enabled = Boolean(eligible && source.complete && source.naturalWidth);
        section.classList.toggle('has-flight', eligible && (!source.complete || source.naturalWidth > 0));
        panels.forEach(finishPanel);
        if (!enabled) {
            source?.classList.remove('philosophy-source-hidden');
            if (traveler) traveler.hidden = true;
            // Wait for a lazy-loaded logo without prematurely revealing the sequence.
            if (eligible && !source.complete) {
                stories.inert = true;
                return;
            }
            section.classList.add('is-landed');
            finishIntroduction();
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
    window.addEventListener('resize', () => {
        panels.forEach(finishPanel);
        scheduleMeasure();
    }, { passive: true });
    window.addEventListener('pageshow', scheduleMeasure);
    desktop.addEventListener('change', configure);
    reducedMotion.addEventListener('change', configure);
    source?.addEventListener('load', configure);
    source?.addEventListener('error', configure);
    destination.addEventListener('load', scheduleMeasure);
    if ('ResizeObserver' in window) {
        const resize = new ResizeObserver(scheduleMeasure);
        if (source) resize.observe(source);
        resize.observe(section);
        const about = document.getElementById('tentang');
        if (about) resize.observe(about);
    }
    document.fonts?.ready.then(() => {
        panels.forEach(finishPanel);
        scheduleMeasure();
    });
    configure();
})();
