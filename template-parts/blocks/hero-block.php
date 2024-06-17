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

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?> h-[81rem]" style="background-image: url('<?= $bgImgUrl; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <h1>HERO</h1>
</div>