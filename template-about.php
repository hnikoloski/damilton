<?php
// Template Name: About Us
get_header();
get_template_part('template-parts/inner-hero');
?>
<div class="about-us-page-content pt-[7.2rem]">
    <div class="about-us-page-content__intro px-side-padding-mobile lg:px-side-padding-desktop mb-[9.6rem]">
        <?php
        // Get the fields
        $sub_heading = get_field('sub_heading');
        $heading = get_field('heading');
        $heading_tag = get_field('heading_tag');
        $heading_icon = get_field('heading_icon');

        if ($heading_icon) {
            $heading_with_icon = str_replace('{icon}', '<i class="inline-block bg-contain bg-no-repeat bg-center w-[4rem] h-[4rem] lg:w-[5.2rem] lg:h-[5.2rem] mx-[1rem] lg:mx-[1.6rem] lg:mt-[1rem]" style="background-image: url(' . $heading_icon . ');"></i>', $heading);
        } else {
            $heading_with_icon = $heading;
        }
        ?>

        <?php if ($sub_heading): ?>
            <p class="text-[1.6rem] text-brightBeige mb-[.6rem] text-center"><?= $sub_heading; ?></p>
        <?php endif; ?>

        <?php if ($heading):
            printf('<%1$s class="text-[4rem] lg:text-[4.8rem] text-center text-beige font-medium mb-[4rem] lg:px-[2.5rem] lg:px-0 block lg:flex items-center justify-center">%2$s</%1$s>', $heading_tag, $heading_with_icon);
        ?>
        <?php endif; ?>
        <div class="max-w-full lg:max-w-[78.4rem] mx-auto lg:flex flex-wrap items-start justify-between">
            <div class="w-full lg:w-[calc(50%-2.4rem)] mb-[2.4rem] lg:mb-0 leading-[1.5] about-us-page-content__column-content">
                <?php
                $content_1 = get_field('column_1');
                if ($content_1) {
                    echo $content_1;
                }
                ?>
            </div>
            <div class="w-full lg:w-[calc(50%-2.4rem)] mb-[2.4rem] lg:mb-0 leading-[1.5] about-us-page-content__column-content">
                <?php
                $content_2 = get_field('column_2');
                if ($content_2) {
                    echo $content_2;
                }
                ?>
            </div>
        </div>
    </div>
    <div class="about-us-page-content__ribbon-image-content px-side-padding-mobile lg:px-side-padding-desktop mb-[9.6rem]">
        <?php
        $ribbon_image_url = get_field('ribbon_background_image')['url'];
        $top_content = get_field('top_content');
        // Find the words wraped in {large} {/large} tags and replace them with the span tag
        $top_content = preg_replace('/{large}(.*?){\/large}/', '<span class="text-[9.6rem] block text-beige">$1</span>', $top_content);
        $bottom_content = get_field('bottom_content');
        // Find the words wraped in {large} {/large} tags and replace them with the span tag
        $bottom_content = preg_replace('/{large}(.*?){\/large}/', '<span class="text-[9.6rem] block text-beige">$1</span>', $bottom_content);
        ?>
        <div class="relative w-full h-[40rem] lg:h-[50rem] min-h-[68rem] lg:min-h-[89rem] bg-cover bg-no-repeat bg-center rounded-[20px] lg-[1.5rem] px-[1.5rem] lg:px-[20.8rem] py-[7.2rem] lg:py-[5.6rem] flex flex-col" style="background-image: url('<?= $ribbon_image_url; ?>');">
            <?php
            $ribbon_words = get_field('ribbon_words');
            if ($ribbon_words) { ?>
                <div class="overflow-hidden absolute top-[50%] -left-[1.5rem] lg:-left-[12rem] right-0 transform -translate-y-1/2 w-[200%]">
                    <div class="flex whitespace-nowrap animate-ribbonAnim ribbon-words">
                        <?php foreach ($ribbon_words as $word) {
                            $word_text = $word['word']; ?>
                            <!-- Uppercase -->
                            <span class="ribbon-word mx-[5rem] text-beige text-[6.4rem] inline-block text-center leading-[1] uppercase"><?= esc_html($word_text); ?></span>
                        <?php } ?>
                        <!-- Duplicate the words to create an infinite loop effect -->
                        <?php foreach ($ribbon_words as $word) {
                            $word_text = $word['word']; ?>
                            <span class="ribbon-word mx-[5rem] text-beige text-[6.4rem] inline-block text-center leading-[1] uppercase"><?= esc_html($word_text); ?></span>
                        <?php } ?>
                    </div>
                </div>
            <?php }
            ?>

            <div class="lg:ml-auto max-w-[36.8rem] about-us-page-content__ribbon-image-content__top-content">
                <?php if ($top_content): ?>
                    <?php echo $top_content; ?>
                <?php endif; ?>
            </div>
            <div class="mr-auto mt-auto max-w-[36.8rem] about-us-page-content__ribbon-image-content__bottom-content">
                <?php if ($bottom_content): ?>
                    <?php echo $bottom_content; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="about-us-page-content__footer mb-[9.6rem] px-side-padding-mobile lg:px-side-padding-desktop">
        <?php
        $footer_heading = get_field('footer_heading');
        $footer_heading_tag = get_field('footer_heading_tag');
        ?>

        <?php if ($footer_heading): ?>
            <?php printf('<%1$s class="text-[4rem] lg:text-[4.8rem] text-beige font-medium mb-[4rem] lg:mb-[9.6rem] max-w-[78.4rem] mx-auto leading-[1.2] uppercase">%2$s</%1$s>', $footer_heading_tag, $footer_heading); ?>
        <?php endif; ?>

        <div class="flex flex-wrap items-start justify-between max-w-[88.2rem] mx-auto">
            <div class="w-full h-[34rem] lg:h-auto lg:w-[calc(50%-2.4rem)] mb-[2.4rem] lg:mb-0 leading-[1.5] about-us-page-content__column-content order-2 lg:order-1">
                <?php
                $footer_column_image = get_field('footer_column_image');
                if ($footer_column_image) {
                    $footer_column_image_url = $footer_column_image['url'];
                    $footer_column_image_alt = $footer_column_image['alt']; ?>
                    <img src="<?= $footer_column_image_url; ?>" alt="<?= $footer_column_image_alt; ?>" class="w-full h-full rounded-[12px] object-cover object-center ">
                <?php
                }
                ?>
            </div>
            <div class="w-full lg:w-[calc(50%-2.4rem)] mb-[2.4rem] lg:mb-0 leading-[1.5] about-us-page-content__column-content order-1 lg:order-2">
                <?php
                $footer_column_content = get_field('footer_column_content');
                if ($footer_column_content) {
                    echo $footer_column_content;
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    get_footer();
