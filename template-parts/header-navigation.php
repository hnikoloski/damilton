<div class="fixed top-0 left-0 w-full h-screen bg-brown z-[2048] flex flex-wrap transition-all duration-300 ease-in-out transform -translate-y-[200%]" id="menu-overlay-wrap">
    <!-- flex direction column space between -->
    <div class="w-[43.2rem] bg-[#331603] px-[12rem] py-[3.2rem] flex flex-col justify-between">
        <?php
        $header_small_logo = get_field('header_small_logo', 'option');
        ?>
        <a href="<?= home_url(); ?>" class="logo-wrapper d-block w-[8.5rem] h-[7.3rem]">
            <img src="<?= $header_small_logo['url']; ?>" alt="<?= get_bloginfo(); ?>" class="h-full w-full object-contain">
        </a>
        <div>
            <p class="text-beige text-[1.4rem] font-bold w-full">
                Damilton
            </p>
            <p class="text-beige text-[1.4rem] w-full">Gjorche Petrov 146, Skopje</p>
            <p class="text-beige text-[1.4rem] font-bold w-full mt-[3rem]">
                <?php pll_e('Contact Us', 'starter'); ?>
            </p>
            <a href="tel:+38970302310" class="text-beige text-[1.4rem] block hover:text-white transition-all duration-300 ease-in-out">
                (389) 70 302-310 →</a>
            <a href="tel:+38971258153" class="text-beige text-[1.4rem] block hover:text-white transition-all duration-300 ease-in-out">(389) 71 258-153 →</a>
            <a href="mailto:mail@damilton.com" class="text-beige text-[1.4rem] block hover:text-white transition-all duration-300 ease-in-out">mail@damilton.com →</a>
        </div>
    </div>
    <div class="w-[calc(100%-43.2rem)] pt-[1.6rem] pb-[4.8rem] pl-[5.6rem] pr-[12rem] relative max-h-full overflow-y-auto">
        <div class="flex items-center justify-between mb-[5.5rem]">
            <p class="text-[#9D755A] text-[1.6rem] font-semibold tracking-[0.1rem]">
                <?php pll_e('Navigation', 'starter'); ?></p>
            <div class="flex items-center">
                <button id="search-trigger--secondary" class="search-trigger--secondary">
                    <?php
                    $search_icon_url = get_template_directory_uri() . '/assets/icons/search-icon.svg';
                    ?>
                    <i class="block bg-contain bg-no-repeat bg-center w-[1.6rem] h-[1.6rem] mr-[2.8rem]" style="background-image: url('<?= $search_icon_url; ?>');">
                    </i>
                    <span class="screen-reader-text">Search</span>
                </button>
                <button id="menu-close" class="menu-close rounded-full bg-[#F9DCBC] bg-opacity-10  w-[4.8rem] h-[4.8rem] flex items-center justify-center transition-all duration-300 ease-in-out hover:bg-opacity-20">
                    <?php
                    $close_icon_url = get_template_directory_uri() . '/assets/icons/close-icon.svg';
                    ?>
                    <i class=" block bg-contain bg-no-repeat bg-center w-[1.2rem] h-[1.2rem]" style="background-image: url('<?= $close_icon_url; ?>');">
                    </i>
                    <span class="screen-reader-text">Close</span>
                </button>
            </div>
        </div>

        <?php
        // Check if the menu location 'menu-1' exists and has a menu assigned
        $locations = get_nav_menu_locations();
        if (isset($locations['menu-1'])) {
            $menu_id = $locations['menu-1'];

            // Get menu items by menu ID
            $menu_items = wp_get_nav_menu_items($menu_id);
            if ($menu_items) {
                $counter = 1;
                echo '<ul class="menu-primary max-w-[calc(100%-20rem)]">';
                foreach ($menu_items as $item) {
                    echo '<li class="menu-item">';
                    echo '<a href="' . esc_url($item->url) . '" class="menu-link text-beige text-[5.6rem] leading-snug pr-[2.4rem]">';
                    echo esc_html($item->title);
                    echo '<span class="menu-item__number text-[1.6rem] text-[#9D755A] font-semibold tracking-[0.1rem]">' . sprintf('%02d', $counter) . '</span>';
                    echo '</a>';
                    echo '</li>';
                    $counter++;
                }
                echo '</ul>';
            }
        }
        ?>
        <ul class="socials flex flex-row justify-between items-center gap-[4.8rem] lg:gap-[2rem] fixed right-[12rem] bottom-[4.8rem]">
            <?php if (get_field('facebook', 'option')) : ?>
                <li>
                    <a href="<?php echo get_field('facebook', 'option'); ?>" class="social-link w-[2.4rem] h-[2.4rem] block">
                        <?php $fbIcon = get_template_directory_uri() . '/assets/icons/facebook.svg'; ?>
                        <i class="bg-contain bg-no-repeat bg-center w-full h-full block" style="background-image: url('<?= $fbIcon; ?>');"></i>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (get_field('instagram', 'option')) : ?>
                <li>
                    <a href="<?php echo get_field('instagram', 'option'); ?>" class="social-link social-link w-[2.4rem] h-[2.4rem] block">
                        <?php $instaIcon = get_template_directory_uri() . '/assets/icons/instagram.svg'; ?>
                        <i class="bg-contain bg-no-repeat bg-center w-full h-full block" style="background-image: url('<?= $instaIcon; ?>');"></i>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (get_field('twitter', 'option')) : ?>
                <li>
                    <a href="<?php echo get_field('twitter', 'option'); ?>" class="social-link social-link w-[2.4rem] h-[2.4rem] block">
                        <?php $xIcon = get_template_directory_uri() . '/assets/icons/x.svg'; ?>
                        <i class="bg-contain bg-no-repeat bg-center w-full h-full block" style="background-image: url('<?= $xIcon; ?>');"></i>
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    </div>
</div>