<?php

/**
 * Map Hero Block
 */

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = "kd-block kd-map-hero-block h-[38.5rem]";
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

$location = get_field('location');
?>

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?>">
    <div id="hero-map" class="w-full h-full" data-lat="<?= $location['lat']; ?>" data-lng="<?= $location['lng']; ?>" data-zoom="<?= $location['zoom']; ?>"></div>
</div>