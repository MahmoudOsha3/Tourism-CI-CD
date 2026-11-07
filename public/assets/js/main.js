/**
 * AL-GEWAR Travel & Tourism – main.js
 * Vanilla JavaScript, no dependencies (Swiper is optional and only used if loaded).
 *
 * MODULES
 *  1. Sticky header
 *  2. Mobile menu
 *  3. Dropdowns (language, guests & rooms)
 *  4. Search tabs
 *  5. Guest / room steppers
 *  6. Date fields
 *  7. Smooth scroll
 *  8. Back to top
 *  9. Destination slider (Swiper)
 */
(() => {
    'use strict';

    const $  = (selector, context = document) => context.querySelector(selector);
    const $$ = (selector, context = document) => Array.from(context.querySelectorAll(selector));

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const scrollBehavior = () => (reducedMotion.matches ? 'auto' : 'smooth');

    /** Run `callback` at most once per animation frame (passive scroll helper). */
    const onScrollFrame = (callback) => {
        let queued = false;
        window.addEventListener('scroll', () => {
            if (queued) return;
            queued = true;
            requestAnimationFrame(() => {
                callback();
                queued = false;
            });
        }, { passive: true });
        callback();
    };

    /* 1. STICKY HEADER
       Positioning is pure CSS (position: sticky); JS only toggles the shadow state. */
    const initStickyHeader = () => {
        const header = $('[data-site-header]');
        if (!header) return;

        const topbar = $('.topbar', header);
        onScrollFrame(() => {
            header.classList.toggle('is-scrolled', window.scrollY > (topbar ? topbar.offsetHeight : 0));
        });
    };

    /* 2. MOBILE MENU */
    const initMobileMenu = () => {
        const toggle = $('[data-nav-toggle]');
        const menu   = $('[data-nav-menu]');
        if (!toggle || !menu) return;

        const desktop = window.matchMedia('(min-width: 992px)');

        const setOpen = (open) => {
            menu.classList.toggle('show', open);
            toggle.setAttribute('aria-expanded', String(open));

            const icon = $('i', toggle);
            if (icon) {
                icon.classList.toggle('bi-list', !open);
                icon.classList.toggle('bi-x-lg', open);
            }
        };

        const isOpen = () => toggle.getAttribute('aria-expanded') === 'true';

        toggle.addEventListener('click', () => setOpen(!isOpen()));

        menu.addEventListener('click', (event) => {
            if (event.target.closest('a') && !desktop.matches) setOpen(false);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && isOpen()) {
                setOpen(false);
                toggle.focus();
            }
        });

        desktop.addEventListener('change', (event) => {
            if (event.matches) setOpen(false);
        });
    };

    /* 3. DROPDOWNS
       Markup: [data-dropdown] > [data-dropdown-toggle] + [data-dropdown-menu][hidden] */
    const initDropdowns = () => {
        const dropdowns = $$('[data-dropdown]');
        if (!dropdowns.length) return;

        const parts = (dropdown) => ({
            toggle: $('[data-dropdown-toggle]', dropdown),
            menu: $('[data-dropdown-menu]', dropdown),
        });

        const close = (dropdown) => {
            const { toggle, menu } = parts(dropdown);
            if (!toggle || !menu || menu.hidden) return false;
            menu.hidden = true;
            toggle.setAttribute('aria-expanded', 'false');
            return true;
        };

        const open = (dropdown) => {
            dropdowns.forEach((other) => other !== dropdown && close(other));
            const { toggle, menu } = parts(dropdown);
            menu.hidden = false;
            toggle.setAttribute('aria-expanded', 'true');
        };

        dropdowns.forEach((dropdown) => {
            const { toggle, menu } = parts(dropdown);
            if (!toggle || !menu) return;
            toggle.addEventListener('click', () => (menu.hidden ? open(dropdown) : close(dropdown)));
        });

        document.addEventListener('click', (event) => {
            dropdowns.forEach((dropdown) => {
                if (!dropdown.contains(event.target)) close(dropdown);
            });
        });

        document.addEventListener('keydown', (event) => {
            if (event.key !== 'Escape') return;
            dropdowns.forEach((dropdown) => {
                if (close(dropdown)) parts(dropdown).toggle.focus();
            });
        });
    };

    /* 4. SEARCH TABS (WAI-ARIA tabs pattern with arrow-key support) */
    const initSearchTabs = () => {
        $$('[data-tabs]').forEach((list) => {
            const tabs = $$('[role="tab"]', list);

            const activate = (tab, focus = false) => {
                tabs.forEach((item) => {
                    const selected = item === tab;
                    const panel = document.getElementById(item.getAttribute('aria-controls'));

                    item.classList.toggle('is-active', selected);
                    item.setAttribute('aria-selected', String(selected));
                    item.tabIndex = selected ? 0 : -1;
                    if (panel) panel.hidden = !selected;
                });
                if (focus) tab.focus();
            };

            tabs.forEach((tab, index) => {
                tab.addEventListener('click', () => activate(tab));

                tab.addEventListener('keydown', (event) => {
                    const targets = {
                        ArrowRight: (index + 1) % tabs.length,
                        ArrowLeft: (index - 1 + tabs.length) % tabs.length,
                        Home: 0,
                        End: tabs.length - 1,
                    };
                    if (event.key in targets) {
                        event.preventDefault();
                        activate(tabs[targets[event.key]], true);
                    }
                });
            });
        });
    };

    /* 5. GUEST / ROOM STEPPERS */
    const initGuestPickers = () => {
        $$('[data-guest-picker]').forEach((picker) => {
            const guests  = $('[data-guest-input]', picker);
            const rooms   = $('[data-room-input]', picker);
            const summary = $('[data-guest-summary]', picker);
            if (!guests || !summary) return;

            const labels = picker.dataset;

            const clamp = (input) => {
                const min = Number(input.min) || 1;
                const max = Number(input.max) || 99;
                const parsed = parseInt(input.value, 10);
                input.value = Math.min(max, Math.max(min, Number.isNaN(parsed) ? min : parsed));
                return Number(input.value);
            };

            const format = (count, one, many) => `${count} ${count === 1 ? one : many}`;

            const render = () => {
                let text = format(clamp(guests), labels.labelGuestOne, labels.labelGuestMany);
                if (rooms) text += `, ${format(clamp(rooms), labels.labelRoomOne, labels.labelRoomMany)}`;
                summary.textContent = text;
            };

            picker.addEventListener('click', (event) => {
                const button = event.target.closest('[data-step]');
                if (!button) return;

                const input = $('input', button.parentElement);
                input.value = (parseInt(input.value, 10) || 0) + Number(button.dataset.step);
                render();
            });

            picker.addEventListener('change', render);
            render();
        });
    };

    /* 6. DATE FIELDS
       - Opens the native picker on click (the default indicator is hidden by CSS)
       - Keeps "to" >= "from" */
    const initDateFields = () => {
        $$('[data-search-form]').forEach((form) => {
            $$('input[type="date"]', form).forEach((input) => {
                input.addEventListener('click', () => {
                    try {
                        if (typeof input.showPicker === 'function') input.showPicker();
                    } catch (error) { /* picker unavailable – native fallback */ }
                });
            });

            const from = $('[data-date-from]', form);
            const to   = $('[data-date-to]', form);
            if (!from || !to) return;

            const sync = () => {
                if (!from.value) return;
                to.min = from.value;
                if (to.value && to.value < from.value) to.value = from.value;
            };

            from.addEventListener('change', sync);
            sync();
        });
    };

    /* 7. SMOOTH SCROLL (in-page anchors only; offset handled by CSS scroll-padding-top) */
    const initSmoothScroll = () => {
        document.addEventListener('click', (event) => {
            const link = event.target.closest('a[href*="#"]');
            if (!link) return;

            const url = new URL(link.href, window.location.href);
            const samePage = url.origin === window.location.origin && url.pathname === window.location.pathname;
            if (!samePage || url.hash.length < 2) return;

            const target = document.getElementById(decodeURIComponent(url.hash.slice(1)));
            if (!target) return;

            event.preventDefault();
            target.scrollIntoView({ behavior: scrollBehavior(), block: 'start' });
            history.pushState(null, '', url.hash);

            if (!target.hasAttribute('tabindex')) target.setAttribute('tabindex', '-1');
            target.focus({ preventScroll: true });
        });
    };

    /* 8. BACK TO TOP */
    const initBackToTop = () => {
        const button = $('[data-back-to-top]');
        if (!button) return;

        onScrollFrame(() => {
            button.hidden = window.scrollY < 400;
        });

        button.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: scrollBehavior() });
        });
    };

    /* 9. DESTINATION SLIDER (Swiper is loaded only on pages that need it) */
    const initDestinationSlider = () => {
        const container = $('[data-destination-slider]');
        if (!container || typeof window.Swiper === 'undefined') return;

        const wrapper = container.parentElement;

        new window.Swiper(container, {
            slidesPerView: 1,
            spaceBetween: 24,
            watchOverflow: true,
            keyboard: { enabled: true },
            a11y: { enabled: true },
            navigation: {
                nextEl: $('[data-slider-next]', wrapper),
                prevEl: $('[data-slider-prev]', wrapper),
            },
            breakpoints: {
                768:  { slidesPerView: 2 },
                992:  { slidesPerView: 3 },
                1200: { slidesPerView: 4 },
            },
        });
    };

    /* BOOT */
    const init = () => {
        initStickyHeader();
        initMobileMenu();
        initDropdowns();
        initSearchTabs();
        initGuestPickers();
        initDateFields();
        initSmoothScroll();
        initBackToTop();
        initDestinationSlider();
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
