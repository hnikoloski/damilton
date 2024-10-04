<?php

// Template Name: Products

get_header();
get_template_part('template-parts/inner-hero');
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?php
// Get product categories
$product_categories = get_terms('product_cat', array(
    'orderby'    => 'name',
    'order'      => 'ASC',
    'hide_empty' => true,
));

// Get brands (assuming your custom post type for brands is 'brand')
$brands = get_posts(array(
    'post_type' => 'brand',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
));

?>

<div class="px-side-padding-mobile lg:px-side-padding-desktop">
    <h2 class="text-[4.8rem] text-beige my-[4rem] relative inline-block pr-[1.2em] leading-none font-medium"><?php echo get_the_title(); ?>
        <span class="leading-none products-total-num text-white absolute -top-[1.2rem] right-0 bg-none text-[2rem] px-[1.2rem] py-[0.6rem] rounded-[100px] border border-solid border-beige"><?php echo wp_count_posts('product')->publish; ?></span>
    </h2>

    <div class="products-filters block lg:flex">
        <form class="hidden products-filters__params">
            <input type="hidden" name="category" value="*">
            <input type="hidden" name="brand" value="*">
            <input type="hidden" name="sort" value="a-z">
        </form>
        <div class="products-filters__categories">
            <ul class="flex gap-x-[1.6rem] gap-y-[1rem] flex-wrap w-full lg:w-auto">
                <li class="products-filters__category text-brown bg-beige rounded-[100px] px-[2.4rem] py-[0.8rem] font-medium text-[1.4rem] cursor-pointer border border-solid border-beige hover:bg-beige hover:text-brown transition-all duration-300 mb-[0.8rem]" data-category="*">
                    All (<span class="products-filters__category__number"><?php echo wp_count_posts('product')->publish; ?></span>)
                </li>
                <?php foreach ($product_categories as $category) :
                ?>
                    <li class="products-filters__category text-white rounded-[100px] px-[2.4rem] py-[0.8rem] font-medium text-[1.4rem] cursor-pointer border border-solid border-beige hover:bg-beige hover:text-brown transition-all duration-300 mb-[0.8rem]" data-category="<?php echo $category->slug; ?>">
                        <?php echo $category->name; ?> (<span class="products-filters__category__number"><?php echo $category->count; ?></span>)
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="products-filters__dropdowns flex ml-auto space-x-[1.6rem] mt-[3.2rem] lg:mt-0">
            <div class="products-filters__dropdown">
                <select class="products-filters__brand text-white rounded-[100px] pl-[2.4rem] pr-[6rem] py-[0.8rem] font-medium text-[1.4rem] cursor-pointer border border-solid border-beige bg-transparent transition-all duration-300 mb-[0.8rem]">
                    <option selected disabled class="hidden">
                        <?php pll_e('Select Brand'); ?>
                    </option>
                    <?php foreach ($brands as $brand) : ?>
                        <option value="<?php echo $brand->ID; ?>"><?php echo $brand->post_title; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="products-filters__dropdown">
                <select class="products-filters__sort text-white rounded-[100px] pl-[2.4rem] pr-[6rem] py-[0.8rem] font-medium text-[1.4rem] cursor-pointer border border-solid border-beige bg-transparent transition-all duration-300 mb-[0.8rem]">
                    <option selected disabled class="hidden">
                        <?php pll_e('Sort By'); ?>
                    </option>
                    <option value="date">
                        <?php pll_e('Date'); ?>
                    </option>
                    <option value="a-z">
                        <?php pll_e('A-Z'); ?>
                    </option>
                    <option value="z-a">
                        <?php pll_e('Z-A'); ?>
                    </option>
                </select>
            </div>
        </div>
    </div>

    <div class="filtered-products-container relative min-h-[30rem] flex flex-wrap mt-[4rem] lg:mt-[6.4rem] items-start justify-between">
        <!-- Product cards will be appended here -->
    </div>
</div>

<?php
get_footer();
