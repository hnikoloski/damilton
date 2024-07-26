<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * 
 */

get_header();
?>
<div class="px-side-padding-mobile lg:px-side-padding-desktop pt-[19.2rem]">
    <div class="single-product__content flex ">
        <div class="single-product__content__gallery flex flex-wrap w-full lg:w-[70rem] h-[55.2rem]">
            <?php
            $product_image = get_the_post_thumbnail_url();
            $product_image_gallery = get_post_meta(get_the_ID(), '_product_image_gallery', true);

            // Split the gallery IDs into an array
            $gallery_ids = !empty($product_image_gallery) ? explode(',', $product_image_gallery) : [];

            $all_image_urls = [];

            // Add main product image to the array
            if ($product_image) {
                $all_image_urls[] = $product_image;
            }

            // Loop through gallery IDs and add their URLs to the array
            foreach ($gallery_ids as $id) {
                $image_url = wp_get_attachment_url($id);
                if ($image_url) {
                    $all_image_urls[] = $image_url;
                }
            }

            if (!empty($all_image_urls)) { ?>
                <div class="product-slider-thumbs swiper w-[12rem] max-h-full" thumbsSlider="">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($all_image_urls as $url) {
                        ?>
                            <div class="swiper-slide !w-[12rem] !h-[12rem]">
                                <img src="<?php echo $url; ?>" alt="Product Image" class="!w-full !h-full object-cover">
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="product-slider swiper w-[calc(100%-12rem-2.4rem)] h-full">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($all_image_urls as $url) {
                        ?>
                            <div class="swiper-slide">
                                <img src="<?php echo $url; ?>" alt="Product Image" class="!w-full !h-full object-cover">
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                </div>

            <?php }
            ?>
        </div>

        <div class="single-product__content__info w-full lg:w-[calc(100%-70rem)] lg:pl-[8.8rem]">
            <h1 class="single-product__content__info__title text-beige font-semibold text-[3.6rem] leading-tight mb-[2.4rem]"><?php the_title(); ?></h1>
            <?php
            // Description
            if (!empty(get_the_content())) {
            ?>
                <div class="single-product__content__info__description text-brightBeige"><?php the_content(); ?></div>
            <?php
            }
            ?>
            <div class="my-[5rem] flex flex-wrap justify-between">
                <a href="#techdetails" class="group flex items-center text-white rounded-[100px] pl-[2.4rem] pr-[6rem] py-[0.8rem] font-medium text-[1.4rem] cursor-pointer border border-solid border-beige bg-transparent transition-all duration-300 mb-[0.8rem] relative">
                    <?php
                    $arrowUrl = get_template_directory_uri() . '/assets/icons/arrow--right.svg';
                    ?>
                    <span><?php pll_e('Technical Details', 'starter'); ?></span>
                    <img src="<?php echo $arrowUrl; ?>" alt="Arrow Right" class="!w-[1.7rem] !h-[1.2rem] ml-[1.2rem] group-hover:ml-[1.4rem] transition-all duration-300 ease-in-out absolute -translate-y-1/2 right-[2.4rem] top-[50%] group-hover:right-[1.6rem]">
                </a>
                <a href="#ask-price" class="group flex items-center text-brown rounded-[100px] pl-[2.4rem] pr-[6rem] py-[0.8rem] font-medium text-[1.4rem] cursor-pointer border border-solid border-beige bg-beige transition-all duration-300 mb-[0.8rem] relative">
                    <?php
                    $arrowUrl = get_template_directory_uri() . '/assets/icons/arrow--right--brown.svg';
                    ?>
                    <span><?php pll_e('Ask for Price', 'starter'); ?></span>
                    <img src="<?php echo $arrowUrl; ?>" alt="Arrow Right" class="!w-[1.7rem] !h-[1.2rem] ml-[1.2rem] group-hover:ml-[1.4rem] transition-all duration-300 ease-in-out absolute -translate-y-1/2 right-[2.4rem] top-[50%] group-hover:right-[1.6rem]">
                </a>
            </div>
            <table class="single-product__content__info__table w-full">
                <tbody>
                    <?php
                    // Sku
                    if (get_post_meta(get_the_ID(), '_sku', true)) {
                    ?>
                        <tr>
                            <td class="single-product__content__info__table__label text-brightBeige font-semibold text-[1.4rem] w-[8.8rem] pb-[3rem]">
                                <?php pll_e('SKU:'); ?>
                            </td>
                            <td class="single-product__content__info__table__value text-brightBeige  text-[1.4rem] pb-[3rem]"><?php echo get_post_meta(get_the_ID(), '_sku', true); ?></td>
                        </tr>
                    <?php
                    }
                    // Categories
                    $categories = wp_get_post_terms(get_the_ID(), 'product_cat', array('fields' => 'names'));
                    if (!empty($categories)) {
                    ?>
                        <tr>
                            <td class="single-product__content__info__table__label text-brightBeige font-semibold text-[1.4rem] w-[8.8rem] pb-[3rem]"><?php pll_e('Category:'); ?></td>
                            <td class="single-product__content__info__table__value text-brightBeige  text-[1.4rem] pb-[3rem]">
                                <?php echo implode(', ', $categories); ?></td>
                        </tr>
                    <?php
                    } ?>
                    <tr>
                        <td class="text-brightBeige font-semibold text-[1.4rem] w-[8.8rem] pb-[3rem]"><?php pll_e('Share:'); ?></td>
                        <td class="text-brightBeige text-[1.4rem] table-cell align-middle pb-[3rem]">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="w-[2.4rem] h-[2.4rem] mr-[1.6rem] inline-block">
                                <?php $facebookIcon = get_template_directory_uri() . '/assets/icons/facebook.svg'; ?>
                                <i class="bg-contain bg-no-repeat bg-center w-full h-full block" style="background-image: url('<?= $facebookIcon; ?>');"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" class="w-[2.4rem] h-[2.4rem] inline-block">
                                <?php $xIcon = get_template_directory_uri() . '/assets/icons/x.svg'; ?>
                                <i class="bg-contain bg-no-repeat bg-center w-full h-full block" style="background-image: url('<?= $xIcon; ?>');"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>
    <?php
    $related_products = get_field('related_products');

    if ($related_products) :
    ?>
        <div class="related-products mt-[11.2rem]">
            <p class="text-brightBeige text-[1.6rem] relative before:absolute before:content-['/'] before:text-[1.6rem] before:text-brightBeige before:font-light before:leading-[1.375] before:top-[50%] before:transform before:-translate-y-1/2 before:left-0 pl-[1rem] leading-[1.375]">
                <?php pll_e('Explore a few'); ?>
            </p>
            <h3 class="text-beige text-[3.6rem] lg:text-[4.8rem] leading-[1.56] uppercase ">
                <?php pll_e('Related Products'); ?>
            </h3>
        </div>
        <div class="flex flex-wrap justify-between mt-[4rem]">
            <?php
            foreach ($related_products as $product) {
                $product_id = $product->ID;
                $product_title = $product->post_title;
                $product_permalink = get_permalink($product_id);
                $product_image_id = get_post_thumbnail_id($product_id);
                $product_image_url = wp_get_attachment_image_src($product_image_id, 'full')[0];
                $product_price = get_post_meta($product_id, '_price', true);
                $product_category = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'names'))[0];
                $product_badge = get_field('badge', $product_id) ?: '';
            ?>
                <div class="product-card w-full lg:w-[calc(33.33%-4.8rem)] mb-[5.6rem]">
                    <div class="product-image mb-[.8rem] w-full !h-[36.8rem] relative">
                        <?php if ($product_badge) { ?>
                            <div class="badge absolute top-[1.6rem] right-[1.6rem] z-10">
                                <span class="text-[1.4rem] text-brown font-medium bg-beige px-[1.2rem] py-[.4rem] rounded-full border border-brown border-solid">
                                    <?php echo $product_badge; ?>
                                </span>
                            </div>
                        <?php } ?>
                        <img src="<?php echo $product_image_url; ?>" alt="<?php echo $product_title; ?>" class="!w-full !h-full object-cover object-center">
                    </div>
                    <div class="product-category text-[1.2rem] text-[#93959E] mb-0 leading-none lowercase">
                        <?php echo $product_category; ?>
                    </div>
                    <div class="product-title mb-[2.4rem] text-[2.4rem] text-beige font-semibold leading-[1.375]">
                        <?php echo $product_title; ?>
                    </div>
                    <div class="product-link">
                        <a href="<?php echo $product_permalink; ?>" class="group flex items-center text-[1.4rem] font-medium text-brightBeige w-fit">
                            <?php
                            $arrowUrl = get_template_directory_uri() . '/assets/icons/arrow--right.svg';
                            ?>
                            <span><?php pll_e('Learn More', 'starter'); ?></span>
                            <img src="<?php echo $arrowUrl; ?>" alt="Arrow Right" class="!w-[1.7rem] !h-[1.2rem] ml-[1.2rem] group-hover:ml-[1.4rem] transition-all duration-300 ease-in-out">
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    <?php endif; ?>
</div>
<?php
get_footer();
