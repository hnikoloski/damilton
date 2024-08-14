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
                <h2 class="text-[2.4rem] text-beige font-semibold leading-[1.2] mb-[3.2rem]"><?= $catalogue->post_title; ?></h2>
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
<?php get_footer(); ?>