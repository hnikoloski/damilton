<?php

/**
 * Contact Info Block
 */

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = "kd-block kd-contact-info-block  px-side-padding-mobile lg:px-side-padding-desktop";
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

?>

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?>">
    <div class="py-[4rem] border-b border-solid border-[#909090]">
        <ul class="block lg:flex items-center justify-between gap-[2.4rem]">
            <li class="flex items-center mb-[2.5rem] lg:mb-0">
                <?php
                $location_icon_url = get_template_directory_uri() . '/assets/icons/location-icon.svg';
                ?>
                <i class="block bg-contain bg-no-repeat bg-center w-[2.4rem] h-[2.4rem] mr-[1.2rem]" style="background-image: url('<?= $location_icon_url; ?>');">
                </i>
                <p class="text-brightBeige text-[1.4rem] leading-[1.5]">
                    Gjorche Petrov 146, Skopje
                </p>
            </li>
            <li class="flex items-center mb-[2.5rem] lg:mb-0">
                <?php
                $phone_icon_url = get_template_directory_uri() . '/assets/icons/phone-icon.svg';
                ?>
                <i class="block bg-contain bg-no-repeat bg-center w-[2.4rem] h-[2.4rem] mr-[1.2rem]" style="background-image: url('<?= $phone_icon_url; ?>');">
                </i>
                <p class="text-brightBeige text-[1.4rem] leading-[1.5]">
                    <a href="tel:+389702302310" class="text-brightBeige hover:text-white">070 302-310</a> // <a href="tel:+38971258153" class="text-brightBeige hover:text-white">071 258-153</a>
                </p>
            </li>
            <li class="flex items-center mb-[2.5rem] lg:mb-0">
                <?php
                $mail_icon_url = get_template_directory_uri() . '/assets/icons/mail-icon.svg';
                ?>
                <i class="block bg-contain bg-no-repeat bg-center w-[2.4rem] h-[2.4rem] mr-[1.2rem]" style="background-image: url('<?= $mail_icon_url; ?>');">
                </i>
                <p class="text-brightBeige text-[1.4rem] leading-[1.5]">
                    <a href="mailto:mail@damilton.com" class="text-brightBeige hover:text-white">
                        mail@damilton.com
                    </a>
                </p>
            </li>
            <li class="flex items-center">
                <?php
                $clock_icon_url = get_template_directory_uri() . '/assets/icons/clock-icon.svg';
                ?>
                <i class="block bg-contain bg-no-repeat bg-center w-[2.4rem] h-[2.4rem] mr-[1.2rem]" style="background-image: url('<?= $clock_icon_url; ?>');">
                </i>
                <p class="text-brightBeige text-[1.4rem] leading-[1.5]">
                    <?php pll_e('Mon. - Fri.: 08:30-20:30 // Sat: 09:00-17:00', 'starter'); ?>
                </p>
            </li>
        </ul>
    </div>
</div>