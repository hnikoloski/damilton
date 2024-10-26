<?php
function get_promotions($request)
{
    $page = $request->get_param('page');
    $lang = $request->get_param('lang');
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
            $promo_permalink = get_field('promotion_link', $promotion->ID);
            $promo_products = get_field('promo_products', $promotion->ID);
            if (!$promo_permalink) {
                // Convert the array of post objects to an array of post IDs
                $promo_products_ids = array_map(function ($product) {
                    return $product->ID;
                }, $promo_products);
                $promo_permalink = '/products?promo_products=' . implode(',', $promo_products_ids);
            }
            $arrow_right_path = get_template_directory_uri() . '/assets/icons/arrow--right.svg';
            $results[] = array(
                'id' => $promotion->ID,
                'title' => $promotion->post_title,
                'subtitle' => get_field('subtitle', $promotion->ID) ?: '',
                'link' => $promo_permalink,
                'link_text' => pll__('Learn More', 'starter'),
                'image' => get_the_post_thumbnail_url($promotion->ID, 'full'),
                'discount_percentage' => get_field('discount_percentage', $promotion->ID) ?: '',
                'promo_products' => get_field('promo_products', $promotion->ID) ?: '',
                'arrow_right_path' => $arrow_right_path,
            );
        }
    }

    $response = array(
        'promotions' => $results,
        'max_pages' => $query->max_num_pages
    );

    return new WP_REST_Response($response, 200);
}
