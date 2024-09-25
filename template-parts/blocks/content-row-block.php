<?php

/**
 * Content Row Block
 */

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'kd-block kd-content-row-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Retrieve ACF fields
$sub_heading = get_field('sub_heading');
$highlighted_texts = get_field('highlighted_text');
$description = get_field('description');
$about_us_link = get_field('about_us_link');
$remove_top_spacing_on_second_column = get_field('remove_top_spacing_on_second_column');
$full_width_highlighted_texts = get_field('full_width_highlighted_texts');
?>

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?> py-[3.7rem] lg:pt-[7.6rem] lg:pb-[9.6rem] px-side-padding-mobile lg:px-[22rem]">
    <div class="flex flex-col md:flex-row">
        <div class="text-left w-full <?php if (!$full_width_highlighted_texts) {
                                            echo 'lg:w-1/2 pr-[2rem]';
                                        } else {
                                            echo 'lg:w-full max-w-[93.6rem] lg:mx-auto text-center';
                                        } ?>">
            <h3 class="text-[3.2rem] lg:text-[4rem] italic text-[#799410]"><?php echo esc_html($sub_heading); ?></h3>
            <p class="text-[4rem] lg:text-[4.8rem] font-medium text-beige leading-[1.15]">
                <?php if ($highlighted_texts) : ?>
                    <?php foreach ($highlighted_texts as $highlighted_text) : ?>
                        <?php echo esc_html($highlighted_text['text_part']); ?>
                        <?php if ($highlighted_text['icon']) : ?>
                            <span class="relative top-[0.1em] inline-flex items-center w-[4rem] h-[4rem] ml-2" style="background-image: url(<?php echo esc_url($highlighted_text['icon']); ?>); background-size: contain;background-repeat: no-repeat;background-position: center;"></span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </p>
            <?php if (get_field('full_width_secondary_heading')) : ?>
                <h4 class="text-[3.6rem] lg:text-[4.8rem] italic text-[#799410] mt-[1.6rem] lg:mt-0"><?php echo get_field('full_width_secondary_heading'); ?></h4>
            <?php endif; ?>
        </div>
        <?php if (!$full_width_highlighted_texts) { ?>

            <div class="w-full lg:w-1/2  <?php
                                            if ($remove_top_spacing_on_second_column) {
                                                echo ' pt-0 lg:pl-[10rem]';
                                            } else {
                                                echo ' pt-[6.5rem] lg:pl-[4.8rem]';
                                            }
                                            ?>">
                <p class="text-beige text-[1.6rem] leading-[1.5]"><?php echo esc_html($description); ?></p>
                <?php if ($about_us_link) :
                    $arrow_right_path = get_template_directory_uri() . '/assets/icons/arrow--right.svg';
                    $arrow_right_brown_path = get_template_directory_uri() . '/assets/icons/arrow--right--brown.svg';
                ?>
                    <a href="<?php echo $about_us_link['url']; ?>" class="group kd-hero-block__dot__card__link mt-[3.2rem] flex items-center text-[1.4rem] font-medium text-brightBeige border border-beige border-solid w-fit px-[3.2rem] py-[1rem] rounded-[100px] hover:bg-beige hover:text-brown transition-all duration-300 ease-in-out">
                        <span><?php echo $about_us_link['title']; ?></span>
                        <img src="<?php echo $arrow_right_path; ?>" alt="Arrow Right" class="w-[1.7rem] h-[1.2rem] ml-[1.2rem] group-hover:hidden transition-all duration-300 ease-in-out">
                        <img src="<?php echo $arrow_right_brown_path; ?>" alt="Arrow Right" class="w-[1.7rem] h-[1.2rem] ml-[1.2rem] hidden group-hover:block transition-all duration-300 ease-in-out">
                    </a>

                <?php endif; ?>
            </div>
        <?php } ?>
    </div>
</div>