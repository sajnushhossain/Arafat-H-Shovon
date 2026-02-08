import './bootstrap';

import Alpine from 'alpinejs';
import Swiper from 'swiper';
import { EffectFlip, Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/effect-flip';
import 'swiper/css/pagination';
import 'swiper/css/navigation';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenuItems = document.getElementById('mobile-menu-items');
    const topBar = document.getElementById('top-bar');
    const middleBar = document.getElementById('middle-bar');
    const bottomBar = document.getElementById('bottom-bar');

    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', function () {
            mobileMenuItems.classList.toggle('hidden');
            const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            mobileMenuButton.setAttribute('aria-expanded', !isExpanded);

            topBar.classList.toggle('rotate-45');
            topBar.classList.toggle('translate-y-2.5');
            middleBar.classList.toggle('opacity-0');
            bottomBar.classList.toggle('-rotate-45');
            bottomBar.classList.toggle('-translate-y-2.5');
        });
    }

    const testimonialSwiper = new Swiper('.testimonial-swiper', {
        modules: [EffectFlip, Navigation, Pagination],
        effect: 'flip',
        grabCursor: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});