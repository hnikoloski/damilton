<?php
if (is_archive()) {
    // Check if we are on the promotion archive page
    if (is_post_type_archive('promotion')) {
        $background_image = get_field('background_image_promotion', 'option');
        $title = get_field('title_promotion', 'option');
        $title_tag = get_field('title_tag_promotion', 'option');
    } else {
        // Use option fields if on an archive page
        $background_image = get_field('background_image', 'option');
        $title = get_field('title', 'option');
        $title_tag = get_field('title_tag', 'option');
    }
} else {
    // Use page-specific fields
    $page_id = get_the_ID();
    $background_image = get_field('background_image', $page_id);
    $title = get_field('title', $page_id);
    $title_tag = get_field('title_tag', $page_id);
}
?>
<div class="inner-hero w-full px-5 pt-[18.8rem] pb-[13.6rem]" style="background-image: url('<?php echo $background_image['url']; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <?php if ($title) :
        printf('<%1$s class="inner-hero__text px-[1rem] lg:px-0 text-beige text-[2.8rem] text-center">%2$s</%1$s>', $title_tag, $title);
    ?>
    <?php endif; ?>
</div>