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
        <header id="masthead" class="site-header px-side-padding-mobile lg:px-side-padding-desktop pb-[1.3rem] pt-[1.3rem] lg:pt-[0] flex justify-between items-stretch fixed left-0 top-0 right-0 z-50 <?php echo $userLoggedIn ? 'mt-[32px]' : ''; ?>">
            <a href="<?= home_url(); ?>" class="logo-wrapper hidden lg:block w-[18.2rem] h-[6.7rem]">
                <img src="<?= $logoUrl[0]; ?>" alt="<?= get_bloginfo(); ?>" class="full-size-img full-size-img-contain d-block">
            </a>
            <a href="<?= home_url(); ?>" class="logo-wrapper lg:hidden block w-[5.4rem] h-[4.8rem] mt-0">
                <?php $header_small_logo = get_field('header_small_logo', 'option'); ?>
                <img src="<?= $header_small_logo['url']; ?>" alt="<?= get_bloginfo(); ?>" class="full-size-img full-size-img-contain d-block">
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
                    <form role="search" method="get" class="search-form w-[80vw] lg:w-[50rem] flex items-center justify-between hidden" action="<?php echo home_url('/'); ?>">
                        <label class="block w-full relative max-w-[80vw] lg:max-w-full">
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
                <div class="lang-switcher relative rounded-[16px] border border-solid border-beige flex items-center justify-center mr-[2.8rem] transition-all duration-300 ease-in-out">
                    <?php
                    $currentLang = pll_current_language();
                    $languages = pll_the_languages(array('raw' => 1));
                    ?>
                    <div id="current-lang" class="lang-switcher__current-lang flex items-center px-[1.8rem] py-[1.2rem] justify-center cursor-pointer">
                        <span class="text-white text-[1.6rem] font-bold uppercase"><?= $currentLang; ?></span>
                        <?php
                        $chevron_down_icon_url = get_template_directory_uri() . '/assets/icons/chevron-down.svg';
                        ?>
                        <i class="block bg-contain bg-no-repeat bg-center w-[2.4rem] h-[2.4rem] ml-[.8rem]" style="background-image: url('<?= $chevron_down_icon_url; ?>');"></i>
                    </div>
                    <ul id="lang-dropdown" class="lang-switcher__dropdown absolute bg-dark border border-solid border-beige top-[100%] left-0 w-[100%] z-10 rounded-b-[16px] transition-all duration-300 ease-in-out scale-y-0 transform origin-top">
                        <?php foreach ($languages as $lang) :
                            // Skip the current language
                            if ($currentLang === $lang['slug']) {
                                continue;
                            }
                        ?>
                            <li class="lang-switcher__dropdown-item p-[1rem]">
                                <a href="<?= $lang['url']; ?>" class="block text-beige text-[1.6rem] font-bold text-center uppercase"><?= $lang['slug']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
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