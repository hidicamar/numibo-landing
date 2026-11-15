import Swiper from 'swiper';
import { A11y, Autoplay, Keyboard, Pagination } from 'swiper/modules';
import 'swiper/css';

const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// The hero phone carousel. Swiper rather than a scroll-snap track because mouse
// dragging on laptops must work, not only touch swipes.
const mountScreenshotCarousels = () => {
    document.querySelectorAll('[data-screenshots]').forEach((root) => {
        const container = root.querySelector('.swiper');

        if (container.swiper) {
            return;
        }

        const caption = root.querySelector('[data-screenshot-caption]');

        new Swiper(container, {
            modules: [A11y, Autoplay, Keyboard, Pagination],
            loop: true,
            speed: reducedMotion ? 0 : 600,
            grabCursor: true,
            keyboard: { enabled: true, onlyInViewport: true },
            // Autoplay only until the visitor swipes or taps a dot: after that the
            // carousel is theirs and must not move under their thumb.
            autoplay: reducedMotion ? false : { delay: 4500, pauseOnMouseEnter: true, disableOnInteraction: true },
            pagination: { el: root.querySelector('.swiper-pagination'), clickable: true },
            on: {
                slideChange: (swiper) => {
                    const text = swiper.slides[swiper.activeIndex]?.dataset.caption;

                    if (caption && text) {
                        caption.textContent = text;
                    }
                },
            },
        });
    });
};

// Fires on the initial load and after every wire:navigate visit.
document.addEventListener('livewire:navigated', mountScreenshotCarousels);

// Cookie consent. Google Analytics is the only optional thing this site sets, so the
// choice is a single yes/no kept in a first-party cookie. gtag.js is never requested
// before a "granted" choice; <x-head.gtag /> only declares the ID and denies consent.
const CONSENT_COOKIE = 'numibo_consent';
const CONSENT_MAX_AGE = 60 * 60 * 24 * 180;

const analyticsId = () => document.querySelector('meta[name="analytics-id"]')?.content;

const readConsent = () => {
    const match = document.cookie.match(new RegExp(`(?:^|; )${CONSENT_COOKIE}=(granted|denied)(?:;|$)`));

    return match ? match[1] : null;
};

const storeConsent = (choice) => {
    const secure = window.location.protocol === 'https:' ? '; Secure' : '';

    document.cookie = `${CONSENT_COOKIE}=${choice}; Max-Age=${CONSENT_MAX_AGE}; Path=/; SameSite=Lax${secure}`;
};

let analyticsLoaded = false;

// The order matters: consent has to be granted before `config` is queued, otherwise
// the first page view goes out as a cookieless ping.
const loadAnalytics = () => {
    const id = analyticsId();

    if (! id || analyticsLoaded) {
        return;
    }

    analyticsLoaded = true;

    window.gtag('consent', 'update', { analytics_storage: 'granted' });
    window.gtag('js', new Date());
    window.gtag('config', id);

    const script = document.createElement('script');
    script.async = true;
    script.src = `https://www.googletagmanager.com/gtag/js?id=${id}`;
    document.head.appendChild(script);
};

// Google Analytics writes its cookies on the widest domain it can, so every parent
// domain of the current host is tried.
const clearAnalyticsCookies = () => {
    const names = document.cookie
        .split('; ')
        .map((cookie) => cookie.split('=')[0])
        .filter((name) => name === '_ga' || name.startsWith('_ga_'));

    const labels = window.location.hostname.split('.');
    const domains = labels.map((_, index) => labels.slice(index).join('.'));

    names.forEach((name) => {
        document.cookie = `${name}=; Max-Age=0; Path=/`;

        domains.forEach((domain) => {
            document.cookie = `${name}=; Max-Age=0; Path=/; Domain=${domain}`;
            document.cookie = `${name}=; Max-Age=0; Path=/; Domain=.${domain}`;
        });
    });
};

document.addEventListener('alpine:init', () => {
    window.Alpine.data('cookieConsent', () => ({
        open: false,

        init() {
            this.open = readConsent() === null;
        },

        accept() {
            storeConsent('granted');
            loadAnalytics();
            this.open = false;
        },

        reject() {
            storeConsent('denied');
            this.open = false;

            // Always cleared: cookies can outlive the choice that allowed them (an
            // earlier consent tool, or a choice that has since expired).
            clearAnalyticsCookies();

            // Withdrawing after gtag.js has loaded: a reload is the only reliable way
            // to get a page without the tracker running.
            if (analyticsLoaded) {
                window.location.reload();
            }
        },
    }));
});

// Returning visitors who already agreed.
if (readConsent() === 'granted') {
    loadAnalytics();
}
