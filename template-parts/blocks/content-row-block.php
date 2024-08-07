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
?>

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?> py-[3.7rem] px-side-padding-mobile lg:px-side-padding-desktop">
    <div class="flex flex-col md:flex-row">
        <div class="text-left w-full lg:w-1/2">
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
        </div>
        <div class="w-full lg:w-1/3 lg:pl-[4.8rem] <?php
                                                    if ($remove_top_spacing_on_second_column) {
                                                        echo ' pt-0';
                                                    } else {
                                                        echo ' pt-[6.5rem]';
                                                    }
                                                    ?>">
            <p class="text-beige text-[1.6rem] leading-[1.5]"><?php echo esc_html($description); ?></p>
            <?php if ($about_us_link) :
                $arrow_right_path = get_template_directory_uri() . '/assets/icons/arrow--right.svg';
            ?>
                <a href="<?php echo $about_us_link['url']; ?>" class="group kd-hero-block__dot__card__link mt-[3.2rem] flex items-center text-[1.4rem] font-medium text-brightBeige border border-beige border-solid w-fit px-[3.2rem] py-[1rem] rounded-[100px]">
                    <span><?php echo $about_us_link['title']; ?></span>
                    <img src="<?php echo $arrow_right_path; ?>" alt="Arrow Right" class="w-[1.7rem] h-[1.2rem] ml-[1.2rem] group-hover:ml-[1.4rem] transition-all duration-300 ease-in-out">
                </a>

            <?php endif; ?>
        </div>
    </div>
</div>