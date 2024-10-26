jQuery(document).ready(function ($) {
    if (!$('.catalogue-slider').length) return;

    const $pdfViewer = $('.pdf-viewer');
    const $pdfViewerClose = $('#pdf-viewer-close');
    const $body = $('body');

    // Function to open the PDF viewer and load the PDF
    const openPdfViewer = (pdfUrl, fileName) => {
        var adobeDCView = new AdobeDC.View({
            clientId: "c9c330ff863e40799dbda3ba4413bae0", // Your Adobe API key
            divId: "adobe-dc-view"
        });
        adobeDCView.previewFile({
            content: {
                location: {
                    url: pdfUrl
                }
            },
            metaData: {
                fileName: fileName
            }
        }, {
            embedMode: "FULL_WINDOW" // You can change to FULL_WINDOW if preferred
        });

        $pdfViewer.removeClass('hidden');
        $body.addClass('overflow-hidden');
    };

    // Function to close the PDF viewer
    const closePdfViewer = () => {
        $pdfViewer.addClass('hidden');
        $body.removeClass('overflow-hidden');
    };

    // Handle PDF catalogue link click to open the PDF in a popup
    $('.swiper-slide').on('click', function (e) {
        e.preventDefault();
        const pdfUrl = $(this).attr('href');
        const fileName = $(this).find('img').attr('alt') || 'Catalogue';
        openPdfViewer(pdfUrl, fileName);
    });

    // Handle "Close" button click for PDF viewer
    $pdfViewerClose.on('click', closePdfViewer);

    // Close PDF viewer when the Escape key is pressed
    $(document).on('keydown', function (e) {
        if (e.key === 'Escape' && !$pdfViewer.hasClass('hidden')) {
            closePdfViewer();
        }
    });
});