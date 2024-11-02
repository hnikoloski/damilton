<?php
$current_lang = pll_current_language();
$suffix = ($current_lang !== 'en') ? "_{$current_lang}" : '';
if (is_archive()) {
    // Check if we are on the promotion archive page
    if (is_post_type_archive('promotion')) {
        $background_image = get_field('background_image_promotion' . $suffix, 'option');
        $title = get_field('title_promotion' . $suffix, 'option');
        $title_tag = get_field('title_tag_promotion' . $suffix, 'option');
    } else {
        // Use option fields if on an archive page
        $background_image = get_field('background_image' . $suffix, 'option');
        $title = get_field('title' . $suffix, 'option');
        $title_tag = get_field('title_tag' . $suffix, 'option');
    }
} else {
    // Use page-specific fields
    $page_id = get_the_ID();
    $background_image = get_field('background_image' . $suffix, $page_id);
    $title = get_field('title' . $suffix, $page_id);
    $title_tag = get_field('title_tag' . $suffix, $page_id);
}
?>
<div class="inner-hero w-full px-5 lg:pt-[18.8rem] lg:pb-[13.6rem] flex items-center justify-center lg:block min-h-[38rem] lg:min-h-[auto]"
    style="background-image: url('<?php echo $background_image['url']; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <?php if ($title) :
        printf('<%1$s class="inner-hero__text px-0 lg:px-0 text-beige text-[2.8rem] text-center">%2$s</%1$s>', $title_tag, $title);
    ?>
    <?php endif; ?>
</div>