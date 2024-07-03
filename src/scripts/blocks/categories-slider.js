import Swiper from 'swiper/bundle';
import { Pagination, Autoplay, Navigation } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/pagination';

jQuery(document).ready(function ($) {

    $('.kd-categories-slider-block__slider .swiper-container').each(function (index, element) {
        var $this = $(this); // Current swiper container

        // Initialize Swiper
        var swiper = new Swiper(element, {
            modules: [Navigation],
            loop: true,
            slidesPerView: 2,
            spaceBetween: 20,
            initialSlide: 1,
            breakpoints: {
                768: {
                    slidesPerView: 3,
                    spaceBetween: 48,
                }
            },
        });
    });

});