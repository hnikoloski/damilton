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
        $(searchForm).removeClass("hidden");
    });

    $(searchClose).on("click", function (e) {
        e.preventDefault();
        $(searchTrigger).toggle();
        $(searchForm).addClass("hidden");
    });



});
