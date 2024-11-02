<?php
function get_promotions($request)
{
    $page = $request->get_param('page') ?: 1;
    $lang = $request->get_param('lang') ?: 'en';

    $query = new WP_Query(array(
        'post_type' => 'promotion',
        'orderby' => 'date',
        'order' => 'ASC',
        'posts_per_page' => 6,
        'post_status' => 'publish',
        'paged' => $page,
        'lang' => $lang,
    ));

    $promotions = $query->posts;
    $results = array();

    if ($promotions) {
        foreach ($promotions as $promotion) {
            $promo_permalink = get_post_meta($promotion->ID, 'promotion_link', true) ?: '';
            $promo_products = get_post_meta($promotion->ID, 'promo_products', true) ?: array();

            if (!$promo_permalink && is_array($promo_products)) {
                // Assuming $promo_products holds an array of post IDs
                if ($lang !== 'en') {
                    $promo_permalink = '/' . $lang . '/продукти?promo_products=' . implode(',', $promo_products);
                } else {

                    $promo_permalink = '/products?promo_products=' . implode(',', $promo_products);
                }
            }

            $arrow_right_path = get_template_directory_uri() . '/assets/icons/arrow--right.svg';
            $results[] = array(
                'id' => $promotion->ID,
                'title' => $promotion->post_title,
                'subtitle' => get_post_meta($promotion->ID, 'subtitle', true) ?: '',
                'link' => $promo_permalink,
                'link_text' => pll__('Learn More', 'starter'),
                'image' => get_the_post_thumbnail_url($promotion->ID, 'full'),
                'discount_percentage' => get_post_meta($promotion->ID, 'discount_percentage', true) ?: '',
                'promo_products' => $promo_products,
                'arrow_right_path' => $arrow_right_path,
                'debug_link' => get_the_permalink($promotion->ID),
            );
        }
    }

    $response = array(
        'promotions' => $results,
        'max_pages' => $query->max_num_pages,
    );

    return new WP_REST_Response($response, 200);
}
