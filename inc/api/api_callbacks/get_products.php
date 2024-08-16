<?php
function get_products($request)
{
    $category = $request->get_param('category');
    $brand = $request->get_param('brand');
    $sort = $request->get_param('sort');
    $image_size = $request->get_param('image_size') ?: 'product';
    $promo_products = $request->get_param('promo_products'); // Comma-separated list of product IDs


    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    );

    // If there are promo_products return only those
    if (!empty($promo_products)) {
        $promo_products_ids = explode(',', $promo_products);
        $args['post__in'] = $promo_products_ids;

        $query = new WP_Query($args);

        $results = array();
        $total = $query->found_posts;
        $arrow_right_path = get_template_directory_uri() . '/assets/icons/arrow--right.svg';

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $product = wc_get_product(get_the_ID());

                $image_id = $product->get_image_id();
                $image_url = wp_get_attachment_image_src($image_id, $image_size)[0];

                $results[] = array(
                    'id' => $product->get_id(),
                    'title' => $product->get_name(),
                    'permalink' => $product->get_permalink(),
                    'image' => $image_url,
                    'price' => $product->get_price(),
                    'category' => wp_get_post_terms(get_the_ID(), 'product_cat', array('fields' => 'names'))[0],
                    'badge' => get_field('badge', get_the_ID()) ?: '',
                    'button_text' => '<span>' . pll__('Learn More', 'starter') . '</span> <img src="' . $arrow_right_path . '" alt="Arrow Right" class="w-[1.7rem] h-[1.2rem] ml-[1.2rem] group-hover:ml-[1.4rem] transition-all duration-300 ease-in-out">',
                );
            }
            wp_reset_postdata();
        }

        $response = array(
            'results' => $results,
            'total' => $total,
        );

        if ($response['total'] === 0) {
            $response['message'] = pll__('No products found.', 'starter');
        }

        return $response;
    }

    if (!empty($category) && $category !== '*') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    }

    if (!empty($brand) && $brand !== '*') {
        $args['meta_query'] = array(
            array(
                'key' => 'brand',
                'value' => $brand,
                'compare' => 'LIKE', // Use 'LIKE' for relationship fields storing array of IDs
            ),
        );
    }

    if ($sort === 'a-z') {
        $args['orderby'] = 'title';
        $args['order'] = 'ASC';
    } elseif ($sort === 'z-a') {
        $args['orderby'] = 'title';
        $args['order'] = 'DESC';
    } elseif ($sort === 'date') {
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
    }

    $query = new WP_Query($args);

    $results = array();
    $total = $query->found_posts;
    $arrow_right_path = get_template_directory_uri() . '/assets/icons/arrow--right.svg';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_ID());

            $image_id = $product->get_image_id();
            $image_url = wp_get_attachment_image_src($image_id, $image_size)[0];

            $results[] = array(
                'id' => $product->get_id(),
                'title' => $product->get_name(),
                'permalink' => $product->get_permalink(),
                'image' => $image_url,
                'price' => $product->get_price(),
                'category' => wp_get_post_terms(get_the_ID(), 'product_cat', array('fields' => 'names'))[0],
                'badge' => get_field('badge', get_the_ID()) ?: '',
                'button_text' => '<span>' . pll__('Learn More', 'starter') . '</span> <img src="' . $arrow_right_path . '" alt="Arrow Right" class="w-[1.7rem] h-[1.2rem] ml-[1.2rem] group-hover:ml-[1.4rem] transition-all duration-300 ease-in-out">',
            );
        }
        wp_reset_postdata();
    }

    $response = array(
        'results' => $results,
        'total' => $total,
    );

    if ($response['total'] === 0) {
        $response['message'] = pll__('No products found.', 'starter');
    }

    return $response;
}
