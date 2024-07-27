import axios from 'axios';

jQuery(document).ready(function ($) {

    const brandsContainer = $('.brands-results');
    const brandsFetch = $('#load-more-brands');

    // Brand Card Component
    function brandCardComponent(brand) {
        return `
            <div class="mb-[4.8rem] w-full lg:w-[calc(50%-2.4rem)] bg-[#313234] rounded-[20px] relative">
                <div class="flex flex-wrap p-[1.2rem] h-full">
                    <div class="w-full lg:w-1/2 pr-[2.4rem] pt-[2.8rem] pl-[1.2rem] pb-[1.2rem] order-2 lg:order-1">
                        <img src="${brand.logo}" alt="${brand.title}" class="w-auto h-[3.6rem] mb-[2.4rem] object-contain" />
                        <div class="text-[#F4F0EA] text-[1.4rem] leading-[1.2] mb-[6rem]">
                            ${brand.description}
                        </div>
                        <a href="${brand.link}" target="_blank" rel="noopener noreferrer" class="group flex items-center text-white rounded-[100px] pl-[2.4rem] pr-[6rem] py-[0.8rem] font-medium text-[1.4rem] cursor-pointer border border-solid border-beige bg-transparent transition-all duration-300 mb-[0.8rem] relative w-[fit-content]">
                            <span>${brand.link_text}</span>
                            <img src="${brand.arrow_right_path}" alt="Arrow Right" class="!w-[1.7rem] !h-[1.2rem] ml-[1.2rem] group-hover:ml-[1.4rem] transition-all duration-300 ease-in-out absolute -translate-y-1/2 right-[2.4rem] top-[50%] group-hover:right-[1.6rem]">
                        </a>
                    </div>
                    <div class="w-full lg:w-1/2 order-1 lg:order-2">
                        <img src="${brand.featured_image}" alt="${brand.title}" class="w-full !h-[14.2rem] lg:!h-full object-cover object-center rounded-[10px]" />
                    </div>
                </div>
            </div>
        `;
    }

    // Fetch brands from API
    function fetchBrands(page) {
        let home_url = window.location.origin;
        let api_url = home_url + '/wp-json/tamtam/v1/get-brands';
        return axios.get(`${api_url}?page=${page}`);
    }

    // Load more brands on button click
    brandsFetch.on('click', function () {
        const page = parseInt(brandsFetch.attr('data-page'));
        if (brandsFetch.hasClass('loading')) return;

        // Disable the button while loading
        brandsFetch.addClass('cursor-wait opacity-50 loading').prop('disabled', true);

        fetchBrands(page).then(response => {
            const data = response.data;
            const brands = data.brands;
            const maxPages = data.max_pages;

            brands.forEach(brand => {
                const brandHtml = brandCardComponent(brand);
                brandsContainer.append(brandHtml);
            });

            // Increment the data-page attribute
            const nextPage = page + 1;
            brandsFetch.attr('data-page', nextPage);

            // Hide the button if the last page is reached
            if (nextPage > maxPages) {
                brandsFetch.hide();
            }
        }).then(() => {
            // Remove the loading class
            brandsFetch.removeClass('cursor-wait opacity-50 loading').prop('disabled', false);
        }).catch(error => {
            console.error('Error fetching brands:', error);

            // Enable the button if there was an error
            brandsFetch.removeClass('cursor-wait opacity-50 loading').prop('disabled', false);
        });
    });
});
