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
});
