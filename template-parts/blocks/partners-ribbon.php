<?php

/**
 * Partners Ribbon Block - Swiper.js Slider
 */

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'kd-block kd-partners-ribbon-block swiper-container';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
?>

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?> bg-no-repeat bg-cover bg-center my-[5rem] overflow-hidden">
    <?php if (have_rows('partner_logos')) : ?>
        <div class="swiper-wrapper items-center justify-center">
            <?php while (have_rows('partner_logos')) : the_row();
                $logo = get_sub_field('partner_logo'); ?>
                <div class="swiper-slide w-auto h-[3.5rem] flex items-center justify-center">
                    <img src="<?= $logo['url']; ?>" alt="<?= $logo['alt']; ?>" class="w-full h-full object-contain object-center">
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>