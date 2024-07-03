jQuery(document).ready(function ($) {

    const heroCardTrigger = $('.kd-hero-block__dot__trigger');

    $(heroCardTrigger).on('click', function (e) {
        const card = $(this).siblings('.kd-hero-block__dot__card');

        if ($(card).is(':visible')) {
            $(card).hide();
        } else {
            $('.kd-hero-block__dot__card').hide();
            $(card).show();
        }
    });
});
