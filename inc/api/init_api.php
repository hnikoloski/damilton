<?php

$nameSpace = 'tamtam/v1';
define('API_NAMESPACE', $nameSpace);

// Register Custom Endpoints
add_action('rest_api_init', function () use ($nameSpace) {

    // Auto complete search endpoint
    register_rest_route($nameSpace, '/auto-complete-search', array(
        'methods' => 'GET',
        'callback' => 'auto_complete_search',
        'permission_callback' => '__return_true'
    ));

    // Get products endpoint
    register_rest_route($nameSpace, '/get-products', array(
        'methods' => 'GET',
        'callback' => 'get_products',
        'permission_callback' => '__return_true'
    ));

    // Get brands endpoint
    register_rest_route($nameSpace, '/get-brands', array(
        'methods' => 'GET',
        'callback' => 'get_brands',
        'permission_callback' => '__return_true'
    ));

    // Get Promotions
    register_rest_route($nameSpace, '/get-promotions', array(
        'methods' => 'GET',
        'callback' => 'get_promotions',
        'permission_callback' => '__return_true'
    ));

    // Contact form
    register_rest_route($nameSpace, '/contact-form', array(
        'methods' => 'POST',
        'callback' => 'send_contact_form_email',
        'permission_callback' => '__return_true',
    ));

    // Ask for price 
    register_rest_route($nameSpace, '/ask-for-price', array(
        'methods' => 'POST',
        'callback' => 'send_ask_for_price_email',
        'permission_callback' => '__return_true',
    ));
});


// Include all the callback files that are in the api_callbacks folder and are php files
foreach (glob(__DIR__ . '/api_callbacks/*.php') as $callback_file) {
    require_once $callback_file;
}
