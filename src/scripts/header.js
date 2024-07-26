jQuery(document).ready(function ($) {
    // $("#page").css("padding-top", $("#masthead").outerHeight());
    // $(window).scroll(function () {
    //     var sticky = $("#masthead .top-bar"),
    //         scroll = $(window).scrollTop();

    //     if (scroll >= 100) {
    //         sticky.slideUp();
    //         if ($(window).width() > 768) {
    //             $("#to-top").slideDown();
    //         }
    //         $("#masthead").addClass("sticky");
    //     } else {
    //         sticky.slideDown();
    //         if ($(window).width() > 768) {
    //             $("#to-top").slideUp();
    //         }
    //         $("#masthead").removeClass("sticky");
    //     }
    // });
    const searchTrigger = $("#masthead #search-trigger");
    const searchForm = $("#masthead .search-form");
    const searchClose = $("#masthead .search-close");

    $(searchTrigger).on("click", function (e) {
        e.preventDefault();
        $(searchTrigger).toggle();
        $(searchForm).removeClass("hidden").addClass("mr-4");
        $('#menu-trigger').hide();
    });

    $(searchClose).on("click", function (e) {
        e.preventDefault();
        $(searchTrigger).toggle();
        $(searchForm).addClass("hidden").removeClass("mr-4");
        $('#menu-trigger').show();
    });

    const menuOverlayWrap = $("#menu-overlay-wrap");

    $("#menu-trigger").on("click", function () {
        $(menuOverlayWrap).removeClass("-translate-y-[300%]").addClass("translate-y-0");
        $('body').addClass('overflow-hidden');
    });

    $('#menu-close').on("click", function () {
        $(menuOverlayWrap).removeClass("translate-y-0").addClass("-translate-y-[300%]");
        $('body').removeClass('overflow-hidden');
    });

    $('#search-trigger--secondary').on("click", function () {
        $('#menu-close').trigger("click");
        $(searchTrigger).trigger("click");

        // Add pulse animation to the search form
        $(searchForm).addClass('pulse');

        // Remove pulse animation after 2 seconds
        setTimeout(function () {
            $(searchForm).removeClass('pulse');
        }, 1500);
    });

    // Temporarily open the menu on load
    // $('#menu-trigger').trigger("click");

});
