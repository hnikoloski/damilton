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

    // Partners Ribbon Block
    acf_register_block_type(array(
        'name'              => 'partners-ribbon',
        'title'             => __('Partners Ribbon'),
        'description'       => __('A custom partners ribbon block.'),
        'render_template'   => 'template-parts/blocks/partners-ribbon.php',
        'category'          => 'kd',
        'icon'              => 'admin-comments',
        'keywords'          => array('partners', 'ribbon'),
    ));

    // Cta Section Block
    acf_register_block_type(array(
        'name'              => 'cta-section',
        'title'             => __('CTA Section'),
        'description'       => __('A custom CTA section block.'),
        'render_template'   => 'template-parts/blocks/cta-section.php',
        'category'          => 'kd',
        'icon'              => 'admin-comments',
        'keywords'          => array('cta', 'section'),
    ));

    // Categories slider block
    acf_register_block_type(array(
        'name'              => 'categories-slider',
        'title'             => __('Categories Slider'),
        'description'       => __('A custom categories slider block.'),
        'render_template'   => 'template-parts/blocks/categories-slider.php',
        'category'          => 'kd',
        'icon'              => 'admin-comments',
        'keywords'          => array('categories', 'slider'),
    ));
}

// Check if ACF is active
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_acf_block_types');
}

// add full alignment to blocks
add_theme_support('align-wide');
