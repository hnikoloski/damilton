import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

jQuery(document).ready(function ($) {
    let numberOfColumns = 4;
    if ($(window).width() < 1024) {
        numberOfColumns = 2;
    }
    FlexMasonry.init('.kd-gallery-block__grid', {
        responsive: false,
        numCols: numberOfColumns,
    });

    Fancybox.bind('[data-fancybox="gallery"]', {
        dragToClose: false,
        Image: {
            zoom: false,
        },
    });
});