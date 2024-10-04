<?php

/**
 * Gallery Block
 */

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = "kd-block kd-gallery-block py-[3.7rem] lg:px-side-padding-desktop";
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

?>

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?>">
    <?php
    if (have_rows('gallery_images')): ?>
        <div class="kd-gallery-block__grid">
            <?php
            while (have_rows('gallery_images')) : the_row();
                $image = get_sub_field('image');
            ?>
                <div class="p-[.4rem] cursor-pointer">
                    <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>" class="!w-full !h-full object-cover object-center" data-fancybox="gallery" />
                </div>
            <?php
            endwhile;
            ?>
        </div>
    <?php
    endif;
    ?>
</div>