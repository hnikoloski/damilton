<?php
get_header();
get_template_part('template-parts/inner-hero');
?>
<?php
$catalogues = get_posts(array(
    'post_type' => 'catalogue',
    'orderby' => 'date',
    'order' => 'ASC',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'lang' => pll_current_language(),
));
?>
<div class="px-side-padding-mobile lg:px-side-padding-desktop">
    <h2 class="text-[4.8rem] text-beige my-[4rem] relative inline-block pr-[1.2em] leading-none font-medium"><?php pll_e('Catalogues'); ?>
        <span class="leading-none catalogue-total-num text-white absolute -top-[1.2rem] right-0 bg-none text-[2rem] px-[1.2rem] py-[0.6rem] rounded-[100px] border border-solid border-beige">
            <?php $catalogues_total_num = 0; ?>
            <?php foreach ($catalogues as $catalogue) :
                if (have_rows('catalogues', $catalogue->ID)) :
                    while (have_rows('catalogues', $catalogue->ID)) : the_row();
                        $catalogues_total_num++;
                    endwhile;
                endif;
            endforeach; ?>
            <?= $catalogues_total_num; ?>

        </span>
    </h2>

    <div class="flex flex-wrap items-stretch justify-between catalogues-results align-stretch">


        <?php foreach ($catalogues as $catalogue) : ?>
            <div class="pb-[4.8rem] [&:not(:first-of-type)]:pt-[4.8rem] [&:not(:last-of-type)]:border-b border-solid border-[#909090] w-full">
                <h2 class="text-[2.4rem] text-beige leading-[1.2] mb-[3.2rem]"><?= $catalogue->post_title; ?></h2>
                <?php
                if (have_rows('catalogues', $catalogue->ID)) :
                    $unique_id = uniqid();
                ?>
                    <div class="swiper catalogue-slider" data-unique-id="<?= $unique_id; ?>">

                        <div class="swiper-wrapper relative">
                            <div class="w-[8rem] h-[8rem] bg-beige drag-me  justify-center items-center absolute hidden pointer-events-none z-10 rounded-full shadow-loadShadow flex">
                                <p class="text-brown text-[1.4rem] leading-[1.2] text-center font-bold uppercase">
                                    <?php pll_e('Drag me', 'starter'); ?>
                                </p>
                            </div>
                            <?php
                            while (have_rows('catalogues', $catalogue->ID)) : the_row();
                                $catalogue_image = get_sub_field('catalogue_image');
                                $catalogue_file = get_sub_field('catalogue_file');
                                $catalogues_total_num++;
                            ?>
                                <a class="swiper-slide" href="<?= $catalogue_file['url']; ?>" target="_blank" rel="noopener noreferrer">
                                    <img src="<?= $catalogue_image['url']; ?>" alt="<?= $catalogue_image['alt']; ?>" class="w-full h-auto" />
                                </a>
                            <?php endwhile; ?>
                        </div>

                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="pdf-viewer fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <button id="pdf-viewer-close" class="pdf-viewer__close rounded-full bg-[#F9DCBC] bg-opacity-10  w-[4.8rem] h-[4.8rem] flex items-center justify-center transition-all duration-300 ease-in-out hover:bg-opacity-20 absolute top-[2.4rem] right-[2.4rem] cursor-pointer z-50">
        <?php
        $close_icon_url = get_template_directory_uri() . '/assets/icons/close-icon.svg';
        ?>
        <i class="block bg-contain bg-no-repeat bg-center w-[1.2rem] h-[1.2rem]" style="background-image: url('<?= $close_icon_url; ?>');"></i>
        <span class="screen-reader-text">Close</span>
    </button>
    <div class="pdf-viewer__content w-full h-full relative flex items-center justify-center px-side-padding-mobile lg:px-side-padding-desktop py-[8rem] lg:py-[4.8rem]">
        <div id="adobe-dc-view" class="h-[80vh]"></div> <!-- Container for PDF viewer -->
    </div>
</div>

<script src="https://acrobatservices.adobe.com/view-sdk/viewer.js"></script>
<?php get_footer(); ?>