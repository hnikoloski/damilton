<?php


get_header();
get_template_part('template-parts/inner-hero');
?>
<div class="px-side-padding-mobile lg:px-side-padding-desktop">
    <h2 class="text-[4.8rem] text-beige my-[4rem] relative inline-block pr-[1.2em] leading-none font-medium"><?php pll_e('Promotions'); ?>
        <span class="leading-none promotions-total-num text-white absolute -top-[1.2rem] right-0 bg-none text-[2rem] px-[1.2rem] py-[0.6rem] rounded-[100px] border border-solid border-beige"><?php echo wp_count_posts('promotion')->publish; ?></span>
    </h2>

    <div class="flex flex-wrap items-stretch justify-around promotions-results align-stretch">
        <?php
        $promotions = get_posts(array(
            'post_type' => 'promotion',
            'orderby' => 'date',
            'order' => 'ASC',
            'posts_per_page' => 6,
            'post_status' => 'publish',
        ));
        ?>

        <?php foreach ($promotions as $promotion) :
            $promo_id = $promotion->ID;
            $promo_badge_num = get_field('discount_percentage', $promo_id);

            // 10 or less
            if ($promo_badge_num <= 10) {
                $promo_text_color = '#42210B';
                $promo_background_color = '#E3DA11';
                $promo_border_color = '#FFF';
            } elseif ($promo_badge_num > 10 && $promo_badge_num <= 30) {
                $promo_text_color = '#F4F0EA';
                $promo_background_color = '#799410';
                $promo_border_color = '#F4F0EA';
            } elseif ($promo_badge_num > 30 && $promo_badge_num <= 50) {
                $promo_text_color = '#F4F0EA';
                $promo_background_color = '#C511E3';
                $promo_border_color = '#F4F0EA';
            } else {
                $promo_text_color = '#F4F0EA';
                $promo_background_color = '#FB1993';
                $promo_border_color = '#FB1993';
            }

            $promo_image_url = get_the_post_thumbnail_url($promo_id, 'full');
            $promo_title = $promotion->post_title;
            $promo_subtitle = get_field('subtitle', $promo_id) ?: '';
            $promo_permalink = get_field('promotion_link', $promo_id);
            $promo_products = get_field('promo_products', $promo_id); // relation field
            // If promo_permalink is empty, set it to the /products?products=id1,id2,id3...
            if (!$promo_permalink) {
                // Convert the array of post objects to an array of post IDs
                $promo_products_ids = array_map(function ($product) {
                    return $product->ID;
                }, $promo_products);
                $promo_permalink = '/products?promo_products=' . implode(',', $promo_products_ids);
            }
        ?>
            <div class="product-card w-full lg:w-[calc(33.33%-4.8rem)] mb-[5.6rem]">
                <div class="product-image mb-[.8rem] w-full !h-[36.8rem] relative">
                    <?php if ($promo_badge_num) { ?>
                        <div class="badge absolute top-[1.6rem] right-[1.6rem] z-10">
                            <span class="text-[1.4rem] font-medium px-[1.2rem] py-[.4rem] rounded-full border border-solid" style="color: <?php echo $promo_text_color; ?>; background-color: <?php echo $promo_background_color; ?>; border-color: <?php echo $promo_border_color; ?>">
                                <?php echo $promo_badge_num; ?> %
                            </span>
                        </div>
                    <?php } ?>
                    <img src="<?php echo $promo_image_url; ?>" alt="<?php echo $promo_title; ?>" class="!w-full !h-full object-cover object-center">
                </div>
                <div class="product-category text-[1.2rem] text-[#93959E] mb-0 leading-none lowercase">
                    <?php echo $promo_subtitle; ?>
                </div>
                <div class="product-title mb-[2.4rem] text-[2.4rem] text-beige font-semibold leading-[1.375]">
                    <?php echo $promo_title; ?>
                </div>
                <div class="product-link">
                    <a href="<?php echo $promo_permalink; ?>" class="group flex items-center text-[1.4rem] font-medium text-brightBeige w-fit">
                        <?php
                        $arrowUrl = get_template_directory_uri() . '/assets/icons/arrow--right.svg';
                        ?>
                        <span><?php pll_e('Learn More', 'starter'); ?></span>
                        <img src="<?php echo $arrowUrl; ?>" alt="Arrow Right" class="!w-[1.7rem] !h-[1.2rem] ml-[1.2rem] group-hover:ml-[1.4rem] transition-all duration-300 ease-in-out">
                    </a>
                </div>
            </div>
        <?php endforeach; ?>


    </div>

    <div id="load-more-promotions" class="rounded-full p-4 lg:p-0 w-[8rem] h-[8rem] lg:w-[16rem] lg:h-[16rem] cursor-pointer flex justify-center items-center bg-[#313234] mx-auto shadow-loadShadow mt-[4rem] lg:mt-[4.8rem] hover:shadow-none transition-all duration-300 ease-in-out hover:scale-105 active:scale-95" data-page="2">
        <span class="text-beige text-[1.4rem] lg:text-[1.6rem] uppercase w-full mx-auto text-center font-bold">
            <?php pll_e('Load More', 'starter'); ?>
        </span>
    </div>
</div>
<?php get_footer(); ?>