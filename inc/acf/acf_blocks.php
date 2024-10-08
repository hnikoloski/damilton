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

    // Simple Cards Block
    acf_register_block_type(array(
        'name'              => 'simple-cards',
        'title'             => __('Simple Cards'),
        'description'       => __('A custom simple cards block.'),
        'render_template'   => 'template-parts/blocks/simple-cards.php',
        'category'          => 'kd',
        'icon'              => 'admin-comments',
        'keywords'          => array('simple', 'cards'),
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

    // Cards section block
    acf_register_block_type(array(
        'name'              => 'cards-section',
        'title'             => __('Cards Section'),
        'description'       => __('A custom cards section block.'),
        'render_template'   => 'template-parts/blocks/cards-section.php',
        'category'          => 'kd',
        'icon'              => 'admin-comments',
        'keywords'          => array('cards', 'section'),
    ));

    // Map Hero Block
    acf_register_block_type(array(
        'name'              => 'map-hero',
        'title'             => __('Map Hero'),
        'description'       => __('A custom map hero block.'),
        'render_template'   => 'template-parts/blocks/map-hero.php',
        'category'          => 'kd',
        'icon'              => 'admin-comments',
        'keywords'          => array('map', 'hero'),
        'enqueue_script'    => 'https://maps.googleapis.com/maps/api/js?key=' . get_field('google_maps_api_key', 'option') . '&callback=initMap',
    ));

    // Contact Info Block
    acf_register_block_type(array(
        'name'              => 'contact-info',
        'title'             => __('Contact Info'),
        'description'       => __('A custom contact info block.'),
        'render_template'   => 'template-parts/blocks/contact-info.php',
        'category'          => 'kd',
        'icon'              => 'admin-comments',
        'keywords'          => array('contact', 'info'),
    ));

    // Contact Form Block
    acf_register_block_type(array(
        'name'              => 'contact-form',
        'title'             => __('Contact Form'),
        'description'       => __('A custom contact form block.'),
        'render_template'   => 'template-parts/blocks/contact-form.php',
        'category'          => 'kd',
        'icon'              => 'admin-comments',
        'keywords'          => array('contact', 'form'),
    ));

    // Gallery Block
    acf_register_block_type(array(
        'name'              => 'gallery',
        'title'             => __('Gallery'),
        'description'       => __('A custom gallery block.'),
        'render_template'   => 'template-parts/blocks/gallery.php',
        'category'          => 'kd',
        'icon'              => 'admin-comments',
        'keywords'          => array('gallery', 'images'),
        'enqueue_style'     => 'https://unpkg.com/flexmasonry/dist/flexmasonry.css',
        'enqueue_script'    => 'https://unpkg.com/flexmasonry/dist/flexmasonry.js',
    ));
}

// Check if ACF is active
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_acf_block_types');
}

// add full alignment to blocks
add_theme_support('align-wide');
