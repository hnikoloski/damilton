import axios from 'axios';

jQuery(document).ready(function ($) {
    const promotionsContainer = $('.promotions-results');
    const promotionsFetch = $('#load-more-promotions');

    // Promotion Card Component
    function promotionCardComponent(promotion) {
        // Define badge styles based on the discount percentage
        let promoTextColor, promoBackgroundColor, promoBorderColor;

        if (promotion.discount_percentage <= 10) {
            promoTextColor = '#42210B';
            promoBackgroundColor = '#E3DA11';
            promoBorderColor = '#FFF';
        } else if (promotion.discount_percentage > 10 && promotion.discount_percentage <= 30) {
            promoTextColor = '#F4F0EA';
            promoBackgroundColor = '#799410';
            promoBorderColor = '#F4F0EA';
        } else if (promotion.discount_percentage > 30 && promotion.discount_percentage <= 50) {
            promoTextColor = '#F4F0EA';
            promoBackgroundColor = '#C511E3';
            promoBorderColor = '#F4F0EA';
        } else {
            promoTextColor = '#F4F0EA';
            promoBackgroundColor = '#FB1993';
            promoBorderColor = '#FB1993';
        }

        return `
            <div class="product-card w-full lg:w-[calc(33.33%-4.8rem)] mb-[5.6rem]">
                <div class="product-image mb-[.8rem] w-full !h-[36.8rem] relative">
                    ${promotion.discount_percentage ? `
                        <div class="badge absolute top-[1.6rem] right-[1.6rem] z-10">
                            <span class="text-[1.4rem] font-medium px-[1.2rem] py-[.4rem] rounded-full border border-solid" style="color: ${promoTextColor}; background-color: ${promoBackgroundColor}; border-color: ${promoBorderColor}">
                                ${promotion.discount_percentage} %
                            </span>
                        </div>
                    ` : ''}
                    <img src="${promotion.image}" alt="${promotion.title}" class="!w-full !h-full object-cover object-center">
                </div>
                <div class="product-category text-[1.2rem] text-[#93959E] mb-0 leading-none lowercase">
                    ${promotion.subtitle}
                </div>
                <div class="product-title mb-[2.4rem] text-[2.4rem] text-beige font-semibold leading-[1.375]">
                    ${promotion.title}
                </div>
                <div class="product-link">
                    <a href="${promotion.link}" class="group flex items-center text-[1.4rem] font-medium text-brightBeige w-fit">
                        ${promotion.link_text}
                        <img src="${promotion.arrow_right_path}" alt="Arrow Right" class="!w-[1.7rem] !h-[1.2rem] ml-[1.2rem] group-hover:ml-[1.4rem] transition-all duration-300 ease-in-out">
                    </a>
                </div>
            </div>
        `;
    }

    // Fetch promotions from API
    function fetchPromotions(page) {
        let home_url = window.location.origin;
        let api_url = home_url + '/wp-json/tamtam/v1/get-promotions';
        return axios.get(`${api_url}?page=${page}`);
    }

    // Load more promotions on button click
    promotionsFetch.on('click', function () {
        const page = parseInt(promotionsFetch.attr('data-page'));
        if (promotionsFetch.hasClass('loading')) return;

        // Disable the button while loading
        promotionsFetch.addClass('cursor-wait opacity-50 loading').prop('disabled', true);

        fetchPromotions(page).then(response => {
            const data = response.data;
            const promotions = data.promotions;
            const maxPages = data.max_pages;

            promotions.forEach(promotion => {
                const promotionHtml = promotionCardComponent(promotion);
                promotionsContainer.append(promotionHtml);
            });

            // Increment the data-page attribute
            const nextPage = page + 1;
            promotionsFetch.attr('data-page', nextPage);

            // Hide the button if the last page is reached
            if (nextPage > maxPages) {
                promotionsFetch.hide();
            }
        }).then(() => {
            // Remove the loading class
            promotionsFetch.removeClass('cursor-wait opacity-50 loading').prop('disabled', false);
        }).catch(error => {
            console.error('Error fetching promotions:', error);

            // Enable the button if there was an error
            promotionsFetch.removeClass('cursor-wait opacity-50 loading').prop('disabled', false);
        });
    });
});
