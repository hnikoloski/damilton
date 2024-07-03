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
});


// Include all the callback files that are in the api_callbacks folder and are php files
foreach (glob(__DIR__ . '/api_callbacks/*.php') as $callback_file) {
    require_once $callback_file;
}
