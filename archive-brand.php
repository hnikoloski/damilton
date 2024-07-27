<?php


get_header();
get_template_part('template-parts/inner-hero');
?>
<div class="px-side-padding-mobile lg:px-side-padding-desktop">
    <h2 class="text-[4.8rem] text-beige my-[4rem] relative inline-block pr-[1.2em] leading-none font-medium"><?php pll_e('Brands'); ?>
        <span class="leading-none brands-total-num text-white absolute -top-[1.2rem] right-0 bg-none text-[2rem] px-[1.2rem] py-[0.6rem] rounded-[100px] border border-solid border-beige"><?php echo wp_count_posts('brand')->publish; ?></span>
    </h2>

    <div class="flex flex-wrap items-stretch justify-between brands-results align-stretch">
        <?php
        $brands = get_posts(array(
            'post_type' => 'brand',
            'orderby' => 'date',
            'order' => 'ASC',
            'posts_per_page' => 4,
            'post_status' => 'publish',
        ));
        ?>

        <?php foreach ($brands as $brand) : ?>
            <div class="mb-[4.8rem] w-full lg:w-[calc(50%-4.8rem)] bg-[#313234] rounded-[20px] relative">
                <div class="flex flex-wrap p-[1.2rem] h-full">
                    <div class="w-full lg:w-1/2 pr-[2.4rem] pt-[2.8rem] pl-[1.2rem] pb-[1.2rem] order-2 lg:order-1">
                        <img src="<?= get_field('brand_logo', $brand->ID)['url']; ?>" alt="<?= $brand->post_title; ?>" class="w-auto h-[3.6rem] mb-[2.4rem] object-contain" />
                        <div class="text-[#F4F0EA] text-[1.4rem] leading-[1.2] mb-[6rem]">
                            <?php echo get_field('description', $brand->ID); ?>
                        </div>
                        <a href="<?php echo get_field('brand_link', $brand->ID); ?>" target="_blank" rel="noopener noreferrer" class="group flex items-center text-white rounded-[100px] pl-[2.4rem] pr-[6rem] py-[0.8rem] font-medium text-[1.4rem] cursor-pointer border border-solid border-beige bg-transparent transition-all duration-300 mb-[0.8rem] relative w-[fit-content]">
                            <?php
                            $arrowUrl = get_template_directory_uri() . '/assets/icons/arrow--right.svg';
                            ?>
                            <span><?php pll_e('Visit site', 'starter'); ?></span>
                            <img src="<?php echo $arrowUrl; ?>" alt="Arrow Right" class="!w-[1.7rem] !h-[1.2rem] ml-[1.2rem] group-hover:ml-[1.4rem] transition-all duration-300 ease-in-out absolute -translate-y-1/2 right-[2.4rem] top-[50%] group-hover:right-[1.6rem]">
                        </a>
                    </div>
                    <div class="w-full lg:w-1/2 order-1 lg:order-2">
                        <?php
                        $featuredImageUrl = get_the_post_thumbnail_url($brand->ID, 'full');
                        ?>
                        <img src="<?= $featuredImageUrl; ?>" alt="<?= $brand->post_title; ?>" class="w-full !h-[14.2rem] lg:!h-full object-cover object-center rounded-[10px]" />
                    </div>

                </div>
            </div>
        <?php endforeach; ?>


    </div>

    <div id="load-more-brands" class="rounded-full p-4 lg:p-0 w-[8rem] h-[8rem] lg:w-[16rem] lg:h-[16rem] cursor-pointer flex justify-center items-center bg-[#313234] mx-auto shadow-loadShadow mt-[4rem] lg:mt-[4.8rem] hover:shadow-none transition-all duration-300 ease-in-out hover:scale-105 active:scale-95" data-page="2">
        <span class="text-beige text-[1.4rem] lg:text-[1.6rem] uppercase w-full mx-auto text-center font-bold">
            <?php pll_e('Load More', 'starter'); ?>
        </span>
    </div>
</div>
<?php get_footer(); ?>