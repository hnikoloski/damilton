<?php

/**
 * Hero Home Block
 */

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'kd-block kd-hero-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
$bgImg = get_field('background_image');
$bgImgUrl = esc_url($bgImg);

?>

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?> relative h-[81rem]" style="background-image: url('<?= $bgImgUrl; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <?php
    // image_cta_points repeater
    if (have_rows('image_cta_points')) :
        while (have_rows('image_cta_points')) : the_row();
            $dot_position_left = get_sub_field('dot_position_left');
            $dot_position_top = get_sub_field('dot_position_top');
    ?>
            <div class="kd-hero-block__dot__wrapper">
                <div class="kd-hero-block__dot__trigger absolute w-[1.4rem] h-[1.4rem] rounded-full flex items-center justify-center border-solid border-2 border-beige z-10 cursor-pointer" style="left: <?= $dot_position_left; ?>rem; top: <?= $dot_position_top; ?>rem;">
                    <span class="w-[.8rem] h-[.8rem] bg-beige rounded-full block"></span>
                </div>
            </div>
    <?php endwhile;
    endif;
    ?>
</div>