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

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?> relative h-[81rem]" style="background-image: url('<?php echo $bgImgUrl; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <?php
    // image_cta_points repeater
    if (have_rows('image_cta_points')) :
        while (have_rows('image_cta_points')) : the_row();
            $dot_position_left = get_sub_field('dot_position_left');
            $dot_position_top = get_sub_field('dot_position_top');
            $card_sub_heading = get_sub_field('card')['sub_heading'];
            $card_heading = get_sub_field('card')['heading'];
            $card_image = get_sub_field('card')['image'];
            $card_link = get_sub_field('card')['link'];
            $side_to_show_the_card = get_sub_field('card')['side_to_show_the_card'];
            $card_classes = "";
            if ($side_to_show_the_card == 'right') {
                $card_classes = "left-[2.2rem]";
            } else {
                $card_classes = "right-[2.2rem]";
            }
            $arrow_right_path = get_template_directory_uri() . '/assets/icons/arrow--right.svg';
    ?>
            <div class="kd-hero-block__dot__wrapper absolute hidden lg:block" style="left: <?php echo $dot_position_left; ?>rem; top: <?php echo $dot_position_top; ?>rem;">
                <div class="kd-hero-block__dot__trigger absolute w-[1.4rem] h-[1.4rem] rounded-full flex items-center justify-center border-solid border-2 border-beige z-10 cursor-pointer hover:scale-110 transition-transform duration-300 ease-in-out">
                    <span class="w-[.8rem] h-[.8rem] bg-beige rounded-full block"></span>
                </div>
                <div class="kd-hero-block__dot__card hidden p-[.8rem] bg-[#0C0C0C] rounded-[16px] absolute top-half transform -translate-y-1/2 <?php echo $card_classes; ?>">
                    <div class="kd-hero-block__dot__card__image w-[17.2rem] h-[12.7rem]">
                        <img src="<?php echo $card_image['url']; ?>" alt="<?php echo $card_heading; ?>" class="w-full h-full object-cover rounded-[8px]">
                    </div>
                    <div class="kd-hero-block__dot__card__content mt-[.8rem]">
                        <h3 class="text-[1.2rem] text-brightBeige leading-none"><?php echo $card_sub_heading; ?></h3>
                        <h2 class="text-[1.8rem] font-semibold text-beige leading-1"><?php echo $card_heading; ?></h2>
                    </div>
                    <?php if ($card_link) : ?>
                        <a href="<?php echo $card_link['url']; ?>" class="group kd-hero-block__dot__card__link mt-[2.5rem] flex items-center text-[1.4rem] font-medium text-white">
                            <span><?php echo $card_link['title']; ?></span>
                            <img src="<?php echo $arrow_right_path; ?>" alt="Arrow Right" class="w-[1.7rem] h-[1.2rem] ml-[1.2rem] group-hover:ml-[1.4rem] transition-all duration-300 ease-in-out">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
    <?php endwhile;
    endif;
    ?>
</div>