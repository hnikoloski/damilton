import Swiper from 'swiper/bundle';
import { Pagination, Autoplay, Navigation } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/pagination';

jQuery(document).ready(function ($) {

    $('.kd-categories-slider-block__slider .swiper-container').each(function (index, element) {
        var $this = $(this); // Current swiper container

        // Create unique class selectors for the navigation elements
        // var nextButton = '.swiper-button-next-' + index;
        // var prevButton = '.swiper-button-prev-' + index;

        // Add unique classes to navigation buttons within this container
        // $this.find('.swiper-button-next').addClass('swiper-button-next-' + index);
        // $this.find('.swiper-button-prev').addClass('swiper-button-prev-' + index);

        // Initialize Swiper
        var swiper = new Swiper(element, {
            modules: [Navigation],
            loop: true,
            slidesPerView: 2,
            spaceBetween: 20,
            breakpoints: {
                768: {
                    slidesPerView: 3,
                    spaceBetween: 48,
                }
            },
        });
    });

});