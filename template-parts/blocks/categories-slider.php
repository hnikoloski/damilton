<?php

/**
 * Categories Slider Block
 */

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'kd-block kd-categories-slider-block px-side-padding-mobile lg:px-side-padding-desktop my-[4rem]';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
$sub_heading = get_field('sub_heading');
$heading = get_field('heading');
$woo_product_categories = get_terms('product_cat', array(
    'orderby'    => 'name',
    'order'      => 'ASC',
    'hide_empty' => true,
));

?>

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?>">
    <div class="kd-categories-slider-block__header mb-[2.4rem] lg:mb-[4rem]">
        <?php if ($sub_heading) : ?>
            <p class="text-brightBeige text-[1.6rem] relative before:absolute before:content-['/'] before:text-[1.6rem] before:text-brightBeige before:font-light before:leading-[1.375] before:top-[50%] before:transform before:-translate-y-1/2 before:left-0 pl-[1rem] leading-[1.375]">
                <?php echo $sub_heading; ?>
            </p>
        <?php endif; ?>
        <?php if ($heading) : ?>
            <h3 class="text-beige text-[3.6rem] lg:text-[4.8rem] leading-[1.56] uppercase ">
                <?php echo $heading; ?>
            </h3>
        <?php endif; ?>
    </div>
    <div class="kd-categories-slider-block__slider lg:h-[47.5rem]">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="w-[8rem] h-[8rem] bg-beige drag-me  justify-center items-center absolute hidden pointer-events-none z-10 rounded-full shadow-loadShadow flex">
                    <p class="text-brown text-[1.4rem] leading-[1.2] text-center font-bold uppercase">
                        <?php pll_e('Drag me', 'starter'); ?>
                    </p>
                </div>
                <?php foreach ($woo_product_categories as $category) :
                    $thumbnail_id = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
                    $thumbnail_url = wp_get_attachment_url($thumbnail_id);
                    $home_url = get_home_url();
                    // Category Link is home_url + /products?category=category_slug
                    $category_link = $home_url . '/products?category=' . $category->slug;
                    $category_name = $category->name;
                ?>
                    <div class="swiper-slide">
                        <a href="<?php echo $category_link; ?>" class="kd-categories-slider-block__slide">
                            <div class="kd-categories-slider-block__slide__image h-[20.5rem] lg:h-[38rem] lg:hover:h-[42rem] transition-all duration-300 ease-in-out">
                                <img src="<?php echo $thumbnail_url; ?>" alt="<?php echo $category_name; ?>" class="block w-full h-full object-cover object-center" />
                            </div>
                            <div class="kd-categories-slider-block__slide__content mt-[1.6rem]">
                                <h4 class="text-beige text-[1.8rem] lg:text-[2.4rem] leading-[1.56] font-bold">
                                    <?php echo $category_name; ?>
                                </h4>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>