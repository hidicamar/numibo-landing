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
