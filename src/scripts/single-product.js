// Import Swiper and the required modules
import Swiper from 'swiper/bundle';
import { Autoplay, Navigation } from 'swiper/modules';

import 'swiper/css';

jQuery(document).ready(function ($) {

    // Initialize the thumbnail slider
    const swiperProductThumbs = new Swiper('.single-product__content .product-slider-thumbs', {
        direction: "vertical",
        spaceBetween: 24, // Space between thumbnails
        slidesPerView: 4, // Number of visible thumbnails
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
    });

    // Initialize the main slider
    const swiperProduct = new Swiper('.single-product__content .product-slider', {
        modules: [Navigation],
        slidesPerView: 1,
        loop: true,
        thumbs: {
            swiper: swiperProductThumbs, // Sync with the thumbnail slider
        },
        navigation: {
            nextEl: '.single-product__content .swiper-button-next',
            prevEl: '.single-product__content .swiper-button-prev',
        },

    });
});