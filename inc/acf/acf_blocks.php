<?php

// Path: inc\acf-blocks.php
if (!defined('ABSPATH')) {
    exit;
}
add_filter('block_categories_all', function ($categories) {

    // Adding a new category.
    $categories[] = array(
        'slug'  => 'kd',
        'title' => 'KD Blocks',
        // icon the logo
        'icon'  => 'tamtam-logo',
        'order' => 1,
    );

    return $categories;
});

// Register ACF Blocks
function register_acf_block_types()
{

    // Hero Block
    acf_register_block_type(array(
        'name'              => 'hero',
        'title'             => __('Hero'),
        'description'       => __('A custom hero block.'),
        'render_template'   => 'template-parts/blocks/hero-block.php',
        'category'          => 'kd',
        'icon'              => 'admin-comments',
        'keywords'          => array('hero', 'quote'),
    ));

    // Content row block
    acf_register_block_type(array(
        'name'              => 'content-row',
        'title'             => __('Content Row'),
        'description'       => __('A custom content row block.'),
        'render_template'   => 'template-parts/blocks/content-row-block.php',
        'category'          => 'kd',
        'icon'              => 'admin-comments',
        'keywords'          => array('content', 'row'),
    ));
}

// Check if ACF is active
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_acf_block_types');
}

// add full alignment to blocks
add_theme_support('align-wide');
