<?php
if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.1');
}


/**
 * starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * 
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.1');
}

if (!function_exists('starter_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function starter_setup()
    {
        /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on starter, use a find and replace
		 * to change 'starter' to the name of your theme in all the template files.
		 */
        load_theme_textdomain('starter', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support('title-tag');

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-1' => esc_html__('Primary', 'starter'),
                'menu-2' => esc_html__('Footer 1', 'starter'),
                'menu-3' => esc_html__('Footer 2', 'starter'),
                'menu-4' => esc_html__('Footer 3', 'starter'),
            )
        );

        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'starter_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );
    }
endif;
add_action('after_setup_theme', 'starter_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function starter_content_width()
{
    $GLOBALS['content_width'] = apply_filters('starter_content_width', 640);
}
add_action('after_setup_theme', 'starter_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function starter_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'starter'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'starter'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'starter_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function starter_scripts()
{
    wp_register_style('style', get_template_directory_uri() . '/dist/css/app.css', [], 1, 'all');
    wp_enqueue_style('style');

    wp_register_script('app', get_template_directory_uri() . '/dist/js/app.js', ['jquery'], 1, true);
    wp_enqueue_script('app');
}
add_action('wp_enqueue_scripts', 'starter_scripts');

// Enque the css in the admin area after the other styles so it can override them
function admin_style()
{
    $current_screen = get_current_screen();

    // Check if the current screen supports the block editor
    if ($current_screen && $current_screen->is_block_editor()) {
        wp_register_style('admin-styles', get_template_directory_uri() . '/dist/css/app.css');
        wp_enqueue_style('admin-styles');
    }
}
add_action('admin_enqueue_scripts', 'admin_style');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Acf blocks
 */
require get_template_directory() . '/inc/acf/acf_blocks.php';

// Api Endpoints
require get_template_directory() . '/inc/api/init_api.php';

// custom image size for products
add_image_size('product', 368, 368, true);
// Ensure the custom size is available in the REST API
add_filter('wp_prepare_attachment_for_js', function ($response, $attachment, $meta) {
    if (isset($meta['sizes']['product'])) {
        $response['sizes']['product'] = array(
            'url' => $meta['sizes']['product']['url'],
            'width' => $meta['sizes']['product']['width'],
            'height' => $meta['sizes']['product']['height'],
            'orientation' => $meta['sizes']['product']['width'] > $meta['sizes']['product']['height'] ? 'landscape' : 'portrait',
        );
    }
    return $response;
}, 10, 3);


function my_acf_google_map_api($api)
{
    $api['key'] = get_field('google_maps_api_key', 'option');
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


// Get acf repeater field from options page
$translationsField = get_field('translation_strings', 'option');

// Loop through repeater field
foreach ($translationsField as $translation) {
    // Register Polylang String
    pll_register_string('tamtam', $translation['string'], 'tamtam');
}
