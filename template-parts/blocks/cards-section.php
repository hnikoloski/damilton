<?php

/**
 * Cards section block
 */

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = "kd-block kd-cards-section-block py-[3.7rem] px-side-padding-mobile lg:px-side-padding-desktop";
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
$sub_heading = get_field('sub_heading');
$heading = get_field('heading');
?>

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?>">
    <?php if ($sub_heading) : ?>
        <p class="text-brightBeige text-[1.6rem] relative before:absolute before:content-['/'] before:text-[1.6rem] before:text-brightBeige before:font-light before:leading-[1.375] before:top-[50%] before:transform before:-translate-y-1/2 before:left-0 pl-[1rem] leading-[1.375]">
            <?php echo $sub_heading; ?>
        </p>
    <?php endif; ?>

    <?php if ($heading) : ?>
        <h3 class="text-beige text-[3.6rem] lg:text-[3.6rem] leading-[1.56] uppercase mb-[4rem]">
            <?php echo $heading; ?>
        </h3>
    <?php endif; ?>

    <?php
    $total_cards = count(get_field('cards'));
    if ($total_cards < 1) {
        $total_cards = 1;
    }
    $total_cards = 100 / $total_cards;
    ?>
    <?php if (have_rows('cards')) : ?>
        <div class="flex flex-wrap items-center justify-between">
            <?php while (have_rows('cards')) : the_row();
                $image = get_sub_field('image');
                $title = get_sub_field('title');
                $description = get_sub_field('description');
                $link = get_sub_field('link');
            ?>
                <div class="w-full lg:w-[calc(33%-4.8rem)] mb-[3.5rem] ">
                    <?php if ($link) : ?>
                        <a href="<?= $link['url']; ?>" class="block">
                        <?php endif; ?>
                        <div class="w-full h-[42rem] mb-[1.6rem]">
                            <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>" class="!w-full !h-full object-cover object-center" />
                        </div>
                        <h2 class="text-beige text-[2.4rem] font-semibold leading-[1.2] mb-[1.6rem]"><?= $title; ?></h2>

                        <div class="text-brightBeige text-[1.6rem] leading-[1.5]">
                            <?php echo $description; ?>
                        </div>
                        <?php if ($link) : ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>