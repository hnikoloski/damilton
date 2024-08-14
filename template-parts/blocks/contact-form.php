<?php

/**
 * Contact Form Block
 */

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = "kd-block kd-contact-form-block  px-side-padding-mobile lg:px-side-padding-desktop";
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

$heading = get_field('heading');
$description = get_field('description');
$image = get_field('image');
?>

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?>">
    <div class="flex flex-wrap items-center justify-between py-[6.6rem] align-stretch">
        <div class="w-full lg:w-[calc(50%-4.8rem)]">
            <?php if ($heading) : ?>
                <h2 class="text-beige text-[4rem] lg:text-[4.8rem] font-medium mb-[1.6rem]">
                    <?php echo $heading; ?>
                </h2>
            <?php endif; ?>
            <?php if ($description) : ?>
                <p class="text-brightBeige text-[1.6rem] leading-[1.5] mb-[2.4rem] max-w-full lg:max-w-[35.8rem]">
                    <?php echo $description; ?>
                </p>
            <?php endif; ?>

            <form id="contact-form" class="w-full" novalidate>
                <div class="relative mb-[1.6rem]">
                    <input type="text" name="fullname" id="fullname" placeholder="<?php pll_e('Full Name'); ?>" class="w-full bg-[#313234] text-[#93959E] text-[1.4rem] leading-[1] px-[2.4rem] py-[1.8rem] border-2 border-solid border-[#4A4C4E] rounded-[4px] focus:outline-none focus:border-[#FFD700] transition-all duration-300 ease-in-out" required>
                </div>
                <div class="relative mb-[1.6rem]">
                    <input type="email" name="email" id="email" placeholder="<?php pll_e('Email'); ?>" class="w-full bg-[#313234] text-[#93959E] text-[1.4rem] leading-[1] px-[2.4rem] py-[1.8rem] border-2 border-solid border-[#4A4C4E] rounded-[4px] focus:outline-none focus:border-[#FFD700] transition-all duration-300 ease-in-out" required>
                </div>
                <div class="relative mb-[1.6rem]">
                    <textarea name="message" id="message" placeholder="<?php pll_e('Message'); ?>" class="w-full bg-[#313234] text-[#93959E] text-[1.4rem] leading-[1] px-[2.4rem] py-[1.8rem] border-2 border-solid border-[#4A4C4E] rounded-[4px] focus:outline-none focus:border-[#FFD700] transition-all duration-0 ease-in-out min-h-[20rem]" required></textarea>
                </div>

                <button type="submit" class="bg-beige py-[1rem] px-[2.4rem] text-brown flex items-center justify-center text-[1.6rem] font-medium rounded-[200px] space-x-[1.2rem] scale-100 hover:scale-105 transition-transform duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#FFD700]">
                    <span><?php pll_e('Send Message'); ?></span>
                    <?php
                    $send_icon_url = get_template_directory_uri() . '/assets/icons/send-icon.svg';
                    ?>
                    <i class="block bg-contain bg-no-repeat bg-center w-[2.4rem] h-[2.4rem]" style="background-image: url('<?= $send_icon_url; ?>');">
                    </i>
                </button>

                <p class="status-message text-[1.4rem] leading-[1.5] mt-[1.6rem] text-center font-medium border border-solid  rounded-[4px] py-[1.2rem] hidden">
                </p>
            </form>
        </div>
        <div class="w-full lg:w-[calc(50%-4.8rem)] h-inherit hidden lg:block">
            <div class="w-full h-full relative drop-shadow-contact-image kd-contact-form-block__image-wrapper">
                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>" class="!w-full !h-full object-cover object-center rounded-[12px]" />
            </div>
        </div>
    </div>
</div>