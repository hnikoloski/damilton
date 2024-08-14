<?php

/**
 * Partners Ribbon Block
 */

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'kd-block kd-partners-ribbon-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
?>

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?> bg-no-repeat bg-cover bg-center my-[5rem] overflow-hidden">
    <?php if (have_rows('partner_logos')) : ?>
        <div class="flex w-[350%] lg:w-[200%] animate-ribbonMobileAnim md:animate-ribbonAnim">
            <ul class="flex items-center justify-evenly gap-[8rem] min-w-full">
                <?php while (have_rows('partner_logos')) : the_row();
                    $logo = get_sub_field('partner_logo'); ?>
                    <li class="w-auto h-[3.5rem]">
                        <img src="<?= $logo['url']; ?>" alt="<?= $logo['alt']; ?>" class="w-full h-full object-contain object-center">
                    </li>
                <?php endwhile; ?>
            </ul>
            <ul class="flex items-center justify-evenly gap-[8rem] min-w-full ml-[8rem]">
                <?php while (have_rows('partner_logos')) : the_row();
                    $logo = get_sub_field('partner_logo'); ?>
                    <li class="w-auto h-[3.5rem]">
                        <img src="<?= $logo['url']; ?>" alt="<?= $logo['alt']; ?>" class="w-full h-full object-contain object-center">
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>