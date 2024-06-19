<?php

/**
 * CTA Section Block
 */

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = "kd-block kd-cta-section-block py-[3.7rem] px-side-padding-mobile lg:px-side-padding-desktop";
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

$background_image = get_field('background_image');
?>

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?>" style="background: url('<?php echo $background_image; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="flex flex-wrap items-center justify-between px-[20rem]">
        <?php if (get_field('text_content')) : ?>
            <div class="w-full lg:w-[55rem]">
                <h2 class="text-beige text-[2.4rem] lg:text-[4.8rem] leading-[1.2] font-medium"><?php echo get_field('text_content'); ?></h2>
            </div>
        <?php endif; ?>

        <?php if (get_field('secondary_image')) : ?>
            <div class="w-auto lg:[23.2rem] h-[10.3rem]">
                <img src="<?php echo get_field('secondary_image')['url']; ?>" alt="<?php echo get_field('secondary_image')['alt']; ?>" class="w-full h-full object-contain object-center" />
            </div>
        <?php endif; ?>

    </div>
</div>