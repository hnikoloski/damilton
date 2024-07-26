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
        <header id="masthead" class="site-header px-side-padding-mobile lg:px-side-padding-desktop pb-[1.3rem] flex justify-between items-stretch fixed left-0 top-0 right-0 z-50 <?php echo $userLoggedIn ? 'mt-[32px]' : ''; ?>">
            <a href="<?= home_url(); ?>" class="logo-wrapper d-block w-[18.2rem] h-[6.7rem]">
                <img src="<?= $logoUrl[0]; ?>" alt="<?= get_bloginfo(); ?>" class="full-size-img full-size-img-contain d-block">
            </a>
            <div class="flex items-center">
                <div class="flex items-center h-inherit">
                    <button id="search-trigger" class="search-trigger">
                        <?php
                        $search_icon_url = get_template_directory_uri() . '/assets/icons/search-icon.svg';
                        ?>
                        <i class="block bg-contain bg-no-repeat bg-center w-[1.6rem] h-[1.6rem] mr-[2.8rem]" style="background-image: url('<?= $search_icon_url; ?>');">
                        </i>
                        <span class="screen-reader-text">Search</span>
                    </button>
                    <form role="search" method="get" class="search-form w-[50rem] flex items-center justify-between hidden" action="<?php echo home_url('/'); ?>">
                        <label class="block w-full relative">
                            <span class="screen-reader-text">Search for:</span>
                            <input type="search" placeholder="Search …" value="<?php echo get_search_query(); ?>" name="s" title="Search for:" autocomplete="off" class="search-field w-full h-[4rem] px-[1rem] text-[1.6rem] border border-solid border-beige bg-transparent text-beige rounded-[100px]">
                        </label>
                        <button class="search-close ml-[1.8rem] rounded-full bg-[#F9DCBC] flex-none w-[3.5rem] h-[3.5rem] block bg-opacity-10 hover:bg-opacity-20 flex items-center justify-center transition-all duration-300 ease-in-out">
                            <?php
                            $close_icon_url = get_template_directory_uri() . '/assets/icons/close-icon.svg';
                            ?>
                            <i class="block bg-contain bg-no-repeat bg-center w-[1.2rem] h-[1.2rem]" style="background-image: url('<?= $close_icon_url; ?>'); background-size: contain; background-repeat: no-repeat;">
                            </i>
                            <span class="screen-reader-text">Close</span>
                        </button>
                    </form>
                </div>
                <button id="menu-trigger" class="menu-trigger rounded-full bg-beige w-[4.8rem] h-[4.8rem] flex items-center justify-center ">
                    <div class="w-[1.8rem] h-[1rem] relative">
                        <span class="menu-trigger__line w-1/2 top-0 right-0"></span>
                        <span class="menu-trigger__line w-full top-[50%] transform -translate-y-1/2 left-0"></span>
                        <span class="menu-trigger__line w-1/2 bottom-0 left-0"></span>
                    </div>
                </button>
            </div>
            <?php
            // Include the header-navigation.php file
            get_template_part('template-parts/header-navigation');
            ?>
        </header><!-- #masthead -->