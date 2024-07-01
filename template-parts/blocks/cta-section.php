<?php

/**
 * CTA Section Block
 */

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = "kd-block kd-cta-section-block py-[3.7rem] lg:px-side-padding-desktop";
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

$background_image = get_field('background_image');
$background_image_mobile = get_field('background_image_mobile') ? get_field('background_image_mobile') : $background_image;
?>

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?>" style="--bg-url: url('<?php echo $background_image; ?>'); --bg-mob-url: url('<?php echo $background_image_mobile; ?>');">
    <div class="flex flex-wrap items-center justify-between px-[2rem] lg:px-[20rem]">
        <?php if (get_field('text_content')) : ?>
            <div class="w-full lg:w-[55rem] mb-[3.5rem] lg:mb-0">
                <h2 class="text-beige text-[4rem] lg:text-[4.8rem] leading-[1.2] font-medium text-center lg:text-left">
                    <?php echo get_field('text_content'); ?>
                </h2>
            </div>
        <?php endif; ?>

        <?php if (get_field('secondary_image')) : ?>
            <div class="w-auto h-[6.9rem] lg:[23.2rem] lg:h-[10.3rem] mx-auto lg:mx-0">
                <img src="<?php echo get_field('secondary_image')['url']; ?>" alt="<?php echo get_field('secondary_image')['alt']; ?>" class="w-full h-full object-contain object-center" />
            </div>
        <?php endif; ?>

    </div>
</div>