<?php
$footerBg = get_field('footer_background_image', 'option');
?>
<footer id="colophon" class="site-footer" style="--background-image: url('<?php echo $footerBg; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="site-info lg:pt-[3.5rem] lg:pb-[45.6rem] px-side-padding-mobile lg:px-side-padding-desktop">
        <div class="h-[1px] bg-[#909090] w-full"></div>
        <div class="flex justify-end items-center mt-[3.5rem]">
            <ul class="socials">
                <li class="mb-[2rem]">
                    <a href="<?php echo get_field('facebook', 'option'); ?>" class="social-link text-beige hover:text-white text-[1.4rem] leading-none font-semibold uppercase">
                        Facebook
                    </a>
                </li>
                <li class="mb-[2rem]">
                    <a href="<?php echo get_field('twitter', 'option'); ?>" class="social-link text-beige hover:text-white text-[1.4rem] leading-none font-semibold uppercase">
                        Twitter
                    </a>
                </li>
                <li class="mb-[2rem]">
                    <a href="<?php echo get_field('instagram', 'option'); ?>" class="social-link text-beige hover:text-white text-[1.4rem] leading-none font-semibold uppercase">
                        Instagram
                    </a>
                </li>
            </ul>
        </div>
    </div><!-- .site-info -->
    <div class="copy-bar px-side-padding-mobile lg:px-side-padding-desktop bg-[rgba(20,19,17,0.7)]">
        <div class="flex justify-end items-center py-[1.4rem]">
            <p class="text-[#909090] text-[0.8rem] leading-none text-[1.4rem] text-[#B7AB99]">© 2024 Damilton, All Rights Reserved</p>
        </div>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>