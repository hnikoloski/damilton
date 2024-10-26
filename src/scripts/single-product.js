// Import Swiper and the required modules
import Swiper from 'swiper/bundle';
import { Autoplay, Navigation } from 'swiper/modules';

import 'swiper/css';

jQuery(document).ready(function ($) {
    function updateSwiperDirection() {
        if ($('.single-product__content .product-slider').length === 0) {
            return;
        }
        if (window.innerWidth <= 768) { // Mobile devices
            swiperProductThumbs.changeDirection('horizontal');
            // Slides per view for mobile devices
            swiperProductThumbs.params.slidesPerView = 4;
            swiperProductThumbs.spaceBetween = 8;
        } else { // Desktop and tablets
            swiperProductThumbs.changeDirection('vertical');
            // Slides per view for desktop and tablets
            swiperProductThumbs.params.slidesPerView = 4;
            swiperProductThumbs.spaceBetween = 24;
        }
    }
    // Initialize the thumbnail slider
    const swiperProductThumbs = new Swiper('.single-product__content .product-slider-thumbs', {
        direction: "vertical",
        spaceBetween: 24, // Space between thumbnails
        slidesPerView: 4, // Number of visible thumbnails
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
    });
    // Initial check
    updateSwiperDirection();

    // Update on resize
    window.addEventListener('resize', updateSwiperDirection);
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

    const $pdfViewer = $('.pdf-viewer');
    const $techDetailsBtn = $('.tech-details-pdf-btn');
    const $pdfViewerClose = $('#pdf-viewer-close');
    const askForPriceModal = $(".ask-price-modal");
    const askFormPriceBtn = $(".ask-for-price-btn");
    const askForPriceModalClose = $("#ask-price-modal-close");
    const $body = $('body');

    // Function to toggle the PDF viewer's visibility and body overflow
    const togglePdfViewer = () => {
        $pdfViewer.toggleClass('hidden');
        updateBodyOverflow();
    };

    // Function to close the PDF viewer and update body overflow
    const closePdfViewer = () => {
        $pdfViewer.addClass('hidden');
        updateBodyOverflow();
    };

    // Handle "Tech Details PDF" button click
    $techDetailsBtn.on('click', function (e) {
        e.preventDefault();
        togglePdfViewer();
    });

    // Handle "Close" button click
    $pdfViewerClose.on('click', closePdfViewer);

    // Close the PDF viewer when the Escape key is pressed
    $(document).on('keydown', function (e) {
        if (e.key === 'Escape' && !$pdfViewer.hasClass('hidden')) {
            closePdfViewer();
        }
    });

    // Function to toggle the "Ask for Price" modal's visibility and body overflow
    const toggleAskForPriceModal = () => {
        askForPriceModal.toggleClass('hidden');
        updateBodyOverflow();
    };

    // Function to close the "Ask for Price" modal and update body overflow
    const closeAskForPriceModal = () => {
        askForPriceModal.addClass('hidden');
        updateBodyOverflow();
    };

    // Handle "Ask for Price" button click
    askFormPriceBtn.on('click', function (e) {
        e.preventDefault();
        toggleAskForPriceModal();
    });

    // Handle "Close" button click
    askForPriceModalClose.on('click', closeAskForPriceModal);

    // Close the "Ask for Price" modal when the Escape key is pressed
    $(document).on('keydown', function (e) {
        if (e.key === 'Escape' && !askForPriceModal.hasClass('hidden')) {
            closeAskForPriceModal();
        }
    });

    // Function to update the body's overflow property based on modal visibility
    const updateBodyOverflow = () => {
        if (!$pdfViewer.hasClass('hidden') || !askForPriceModal.hasClass('hidden')) {
            $body.addClass('overflow-hidden');
        } else {
            $body.removeClass('overflow-hidden');
        }
    };
});