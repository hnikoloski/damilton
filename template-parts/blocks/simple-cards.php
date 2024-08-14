<?php

/**
 * Simple Cards Block
 */

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = "kd-block kd-simple-cards-block";
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
?>

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?>">

    <?php if (have_rows('cards')) : ?>
        <div class="flex flex-wrap items-center justify-between">
            <?php while (have_rows('cards')) : the_row();
                $image = get_sub_field('image');
                $sub_heading = get_sub_field('sub_heading');
                $heading = get_sub_field('heading');
                $link = get_sub_field('link');

            ?>
                <div class="w-full bg-dark lg:w-[25%] border border-beige border-solid p-[2.4rem] lg:p-[4.8rem] scale-1 group hover:scale-[1.05] transition-all duration-300 ease-in-out shadow-none hover:shadow-cardShadow">
                    <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>" class="!w-full !h-[25.6rem] object-cover object-center mb-[.8rem]" />
                    <p class="text-[#93959E] text-[1.2rem] leading-[1.33] mb-0"><?= $sub_heading; ?></p>
                    <h2 class="text-beige text-[2.4rem] leading-[1.33] mb-[2.4rem] font-medium"><?= $heading; ?></h2>
                    <?php
                    $arrowUrl = get_template_directory_uri() . '/assets/icons/arrow--right.svg';
                    ?>

                    <a href="#" class="text-brightBeige text-[1.4rem] leading-[1.33] flex items-center group-hover:text-white transition-all duration-300 ease-in-out">
                        <?php pll_e('Learn More'); ?>
                        <i class="block bg-contain bg-no-repeat bg-center w-[2.4rem] h-[2.4rem] ml-[1.2rem]" style="background-image: url('<?= $arrowUrl; ?>');">
                        </i>
                    </a>

                </div>
            <?php endwhile; ?>
        </div>

    <?php endif; ?>
</div>