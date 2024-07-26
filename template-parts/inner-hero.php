<?php
$page_id = get_the_ID();
$background_image = get_field('background_image', $page_id);
$title = get_field('title', $page_id);
$title_tag = get_field('title_tag', $page_id);
?>
<div class="inner-hero w-full px-5 pt-[18.8rem] pb-[13.6rem]" style="background-image: url('<?php echo $background_image['url']; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <?php if ($title) :
        printf('<%1$s class="text-beige text-[2.8rem] text-center">%2$s</%1$s>', $title_tag, $title);
    ?>
    <?php endif; ?>
</div>