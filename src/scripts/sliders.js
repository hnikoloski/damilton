// Import Swiper and the required modules
import Swiper from 'swiper/bundle';
import 'swiper/css';
import 'swiper/css/navigation';

jQuery(document).ready(function ($) {
    // Find all catalogue sliders and initialize Swiper for each
    $('.catalogue-slider').each(function () {
        const uniqueId = $(this).data('unique-id');
        new Swiper(`[data-unique-id="${uniqueId}"]`, {
            loop: true,
            slidesPerView: 1.25,
            spaceBetween: 48,
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
            },
        });
    });

    if ($(window).width() >= 1024) {
        $('.swiper-wrapper').on('mouseenter', function () {
            const $dragMe = $(this).find('.drag-me');
            $dragMe.removeClass('hidden').addClass('flex');

            $(this).on('mousemove', function (e) {
                $dragMe.css({
                    top: `${e.pageY - $(this).offset().top}px`,
                    left: `${e.pageX - $(this).offset().left}px`
                });
            });
        });

        $('.swiper-wrapper').on('mouseleave', function () {
            const $dragMe = $(this).find('.drag-me');
            $dragMe.removeClass('flex').addClass('hidden');
            $(this).off('mousemove');
        });
    }

    if ($('.kd-partners-ribbon-block').length) {
        const swiper = new Swiper('.kd-partners-ribbon-block', {
            slidesPerView: 3, // Automatically adjust to the width of the images
            loop: true,            // Infinite loop
            speed: 10000,          // Adjust speed to control ribbon speed
            spaceBetween: 80,       // No space between slides
            autoplay: {
                delay: 0,          // No delay for continuous scrolling
                disableOnInteraction: false, // Keep autoplay even after interaction
            },
            freeMode: true,         // No snap to slide effect
            freeModeMomentum: false, // Disable momentum for smooth continuous scrolling
            breakpoints: {
                1024: {
                    slidesPerView: 7,
                },

            },
        });
    }
});
