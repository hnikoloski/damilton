import axios from 'axios';

jQuery(document).ready(function ($) {
    // $('.products-filters__dropdown select').select2({
    //     // not searchable
    //     minimumResultsForSearch: -1
    // });
    const productsCategory = $('.products-filters__category');
    const productsSort = $('.products-filters__sort');
    const productsBrand = $('.products-filters__brand');
    const productsContainer = $('.filtered-products-container');
    // Return if no products container
    if (productsContainer.length === 0) {
        return
    }
    productsCategory.on('click', function () {
        if ($(this).hasClass('active')) {
            return;
        }
        let category = $(this).attr('data-category');
        productsCategory.removeClass('active text-brown bg-beige');
        productsCategory.addClass('text-white bg-transparent hover:bg-beige hover:text-brown');
        $(this).addClass('active text-brown bg-beige');
        $(this).removeClass('text-white bg-transparent hover:bg-beige hover:text-brown');

        $('.products-filters__params').find('input[name="category"]').val(category);

        // If promo_products is set, remove it from URL
        const urlParams = new URLSearchParams(window.location.search);
        const promoProducts = urlParams.get('promo_products');
        if (promoProducts) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }

        fetchProducts();
    });

    productsSort.on('change', function () {
        let sort = $(this).val();
        $('.products-filters__params').find('input[name="sort"]').val(sort);


        fetchProducts();
    });

    productsBrand.on('change', function () {
        let brand = $(this).val();
        $('.products-filters__params').find('input[name="brand"]').val(brand);

        // If promo_products is set, remove it from URL
        const urlParams = new URLSearchParams(window.location.search);
        const promoProducts = urlParams.get('promo_products');
        if (promoProducts) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
        fetchProducts();
    });
    // Check if ?category is set in URL and activate the corresponding category
    const urlParams = new URLSearchParams(window.location.search);
    const urlCategory = urlParams.get('category');
    if (urlCategory) {
        setTimeout(() => {
            console.log('urlCategory:', urlCategory);
            // Simulate click on category
            $(`.products-filters__category[data-category="${urlCategory}"]`).click();
            console.log('category clicked');
        }, 200);
    }


    // Fetch products 
    function fetchProducts() {
        productsContainer.addClass('loading');
        let home_url = window.location.origin;
        // http://damilton.test/products/?promo_products=222,223,226
        // Get promo_products from URL
        const urlParams = new URLSearchParams(window.location.search);
        const promoProducts = urlParams.get('promo_products');
        let params;
        if (promoProducts) {
            productsCategory.removeClass('active text-brown bg-beige');
            productsCategory.addClass('text-white bg-transparent hover:bg-beige hover:text-brown');
            params = {
                promo_products: promoProducts
            }
        } else {
            params = {
                category: $('.products-filters__params').find('input[name="category"]').val(),
                brand: $('.products-filters__params').find('input[name="brand"]').val(),
                sort: $('.products-filters__params').find('input[name="sort"]').val(),
            }
        }
        axios.get(home_url + '/wp-json/tamtam/v1/get-products', {
            params: params
        })
            .then(response => {
                const products = response.data.results;
                productsContainer.empty();

                products.forEach(product => {
                    productsContainer.append(productCardComponent(product));
                });
                $('.products-total-num').text(response.data.total);

                if (response.data.total === 0) {
                    let responseMsg = response.data.message;
                    productsContainer.append(`
                        <div class="w-full text-center text-[3.6rem] text-beige mt-[5.6rem] font-medium response-msg">
                            ${responseMsg}
                        </div>
                    `);
                } else {
                    if ($('.response-msg').length > 0) {
                        $('.response-msg').remove();
                    }
                }
            }).then(() => {
                productsContainer.removeClass('loading');
            })
            .catch(error => {
                console.error('Error fetching products:', error);
            })
    }

    // Products Card Component
    function productCardComponent(product) {
        let badge = '';
        if (product.badge) {
            badge = `
                <div class="badge absolute top-[1.6rem] right-[1.6rem] z-10">
                    <span class="text-[1.4rem] text-brown font-medium bg-beige px-[1.2rem] py-[.4rem] rounded-full border border-brown border-solid">
                    ${product.badge}
                    </span>
                </div>
            `;
        }

        return `
            <div class="product-card w-full lg:w-[calc(33.33%-2.4rem)] mb-[5.6rem]">
                <div class="product-image mb-[.8rem] w-full h-[36.8rem] relative">
                    ${badge}
                    <img src="${product.image}" alt="${product.title}" class="w-full h-full object-cover object-center">
                </div>
                <div class="product-category text-[1.2rem] text-[#93959E] mb-0 leading-none lowercase">
                    ${product.category}
                </div>
                <div class="product-title mb-[2.4rem] text-[2.4rem] text-beige font-semibold leading-[1.375]">
                    ${product.title}
                </div>
                <div class="product-link">
                    <a href="${product.permalink}" class="group kd-hero-block__dot__card__link flex items-center text-[1.4rem] font-medium text-brightBeige w-fit">
                    ${product.button_text}
                    </a>
                </div>
            </div>
        `;
    }

    // Fetch products on page load
    fetchProducts();
});



