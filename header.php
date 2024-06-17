<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * 
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
    <?php
    $userLoggedIn = is_user_logged_in();
    ?>
</head>

<body <?php body_class('bg-dark'); ?>>
    <?php wp_body_open();
    // require('template-parts/preloader.php');
    $custom_logo_id = get_theme_mod('custom_logo');
    $logoUrl = wp_get_attachment_image_src($custom_logo_id, 'full');
    ?>
    <div id="page" class="site">
        <header id="masthead" class="site-header px-side-padding-desktop pb-[1.3rem] flex justify-between items-start fixed left-0 top-0 right-0 z-50 <?php echo $userLoggedIn ? 'mt-[32px]' : ''; ?>">
            <a href="<?= home_url(); ?>" class="logo-wrapper d-block w-[18.2rem] h-[6.7rem]">
                <img src="<?= $logoUrl[0]; ?>" alt="<?= get_bloginfo(); ?>" class="full-size-img full-size-img-contain d-block">
            </a>

            <nav id="site-navigation" class="main-navigation">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'primary-menu',
                    )
                );
                ?>
            </nav><!-- #site-navigation -->
        </header><!-- #masthead -->