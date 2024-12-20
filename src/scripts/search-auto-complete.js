import axios from 'axios';

jQuery(document).ready(function ($) {
    let home_url = window.location.origin;
    let api_url = home_url + '/wp-json/tamtam/v1/auto-complete-search';
    // Check if mobile 
    let searchInput;
    if ($(window).width() < 769) {
        searchInput = $('#masthead .search-field');
    } else {
        searchInput = $('#masthead .search-form input');
    }

    function debounce(func, wait) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    function handleSearch() {
        let searchValue = $(this).val();
        searchInput.removeClass('has-results');
        if (searchValue.length > 2) {
            let searchResults = searchInput.parent().find('.search-results');
            if (searchResults.length === 0) {
                searchResults = searchInput.parent().append('<ul class="search-results"></ul>').find('.search-results');
            }
            searchInput.addClass('has-results');
            searchResults.empty();
            // Add Loading Spinner
            searchResults.append('<li class="search-results-item loading"><div class="img-wrapper"><div class="spinner"></div></div><div class="title">Loading...</div></li>');

            axios.get(api_url, {
                params: {
                    search_term: searchValue,
                    post_type: 'product'
                }
            })
                .then(function (response) {
                    let data = response.data;
                    searchResults.empty();
                    if (data.length > 0) {
                        searchResults.show();
                        data.forEach(function (item) {
                            searchResults.append('<li class="search-results-item" data-href="' + item.permalink + '"><div class="img-wrapper"><img src="' + item.image + '" alt="' + item.title + '"></div><div class="title">' + item.title + '</div></li>');
                        });

                    } else {
                        searchResults.hide();
                        // Remove the loading class
                        searchInput.removeClass('has-results');
                    }
                }).then(() => {
                    $('.search-results-item').on('click', function () {
                        if ($(this).hasClass('loading')) return false;
                        let productTitle = $(this).find('.title').text();

                        searchInput.val(productTitle);
                        searchInput.parent().submit();
                        searchInput.parent().find('.search-results').remove();

                        // Redirect to the product page
                        let productUrl = $(this).attr('data-href');

                        window.location.href = productUrl;
                    });
                })
                .catch(function (error) {
                    console.log(error);
                });
        } else {
            searchInput.parent().find('.search-results').remove();
        }
    }

    const debouncedHandleSearch = debounce(handleSearch, 400);

    // also console log the search value
    searchInput.on('keyup', debouncedHandleSearch);

    searchInput.on('change', function () {
        let searchValue = $(this).val();
        console.log('searchValue:', searchValue);
        if (searchValue.length < 3) {
            searchInput.parent().find('.search-results').remove();
        }
    });
});
