<?php
$footerBg = get_field('footer_background_image', 'option');
$footerBgMobile = get_field('footer_background_image_mob', 'option');
?>
<footer id="colophon" class="site-footer" style="--background-image: url('<?php echo $footerBg; ?>'); --background-image-mobile: url(<?php echo $footerBgMobile; ?>); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="site-info pt-[4rem] lg:pt-[3.5rem] pb-[19.4rem] lg:pb-[45.6rem] px-side-padding-mobile lg:px-side-padding-desktop">
        <div class="h-[1px] bg-[#909090] w-full"></div>
        <div class="menus flex flex-wrap flex-row justify-between items-center py-[3.5rem] lg:py-[4.8rem]">
            <div class="menu-col flex flex-row justify-between items-start lg:items-center gap-[4.8rem] lg:gap-[5.6rem] w-full lg:w-auto">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-2',
                        'menu_id'        => 'footer-menu-1',
                        'menu_class'     => 'footer-menu',
                        'container'      => '',
                    )
                );
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-3',
                        'menu_id'        => 'footer-menu-2',
                        'menu_class'     => 'footer-menu',
                        'container'      => '',
                    )
                );
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-4',
                        'menu_id'        => 'footer-menu-3',
                        'menu_class'     => 'footer-menu',
                        'container'      => '',
                    )
                );
                ?>
            </div>
            <div class="flex justify-end items-center mt-[3.5rem] w-full lg:w-auto">
                <ul class="socials flex flex-row lg:flex-col justify-between items-end gap-[4.8rem] lg:gap-[2rem] w-full lg:w-auto">
                    <?php if (get_field('facebook', 'option')) : ?>
                        <li>
                            <a href="<?php echo get_field('facebook', 'option'); ?>" class="social-link text-beige hover:text-white text-[1.4rem] leading-none font-semibold uppercase">
                                Facebook
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (get_field('twitter', 'option')) : ?>
                        <li>
                            <a href="<?php echo get_field('twitter', 'option'); ?>" class="social-link text-beige hover:text-white text-[1.4rem] leading-none font-semibold uppercase">
                                Twitter
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (get_field('instagram', 'option')) : ?>
                        <li>
                            <a href="<?php echo get_field('instagram', 'option'); ?>" class="social-link text-beige hover:text-white text-[1.4rem] leading-none font-semibold uppercase">
                                Instagram
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

    </div><!-- .site-info -->
    <div class="copy-bar px-side-padding-mobile lg:px-side-padding-desktop bg-[rgba(20,19,17,0.7)]">
        <div class="flex justify-center items-center py-[1rem] lg:py-[1.4rem] lg:justify-end">
            <p class="text-[#909090] text-[0.8rem] leading-none text-[1.4rem] text-[#B7AB99]"><?php pll_e('© 2024 Damilton, All Rights Reserved'); ?></p>
        </div>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>