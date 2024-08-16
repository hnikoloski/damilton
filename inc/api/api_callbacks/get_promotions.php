<?php
function get_promotions($request)
{
    $page = $request->get_param('page');

    $query = new WP_Query(array(
        'post_type' => 'promotion',
        'orderby' => 'date',
        'order' => 'ASC',
        'posts_per_page' => 6,
        'post_status' => 'publish',
        'paged' => $page,
    ));

    $promotions = $query->posts;
    $results = array();

    if ($promotions) {
        foreach ($promotions as $promotion) {
            $results[] = array(
                'id' => $promotion->ID,
                'title' => $promotion->post_title,
                'subtitle' => get_field('subtitle', $promotion->ID) ?: '',
                'link' => get_field('promotion_link', $promotion->ID) ?: '',
                'link_text' => pll__('Learn More', 'starter'),
                'image' => get_the_post_thumbnail_url($promotion->ID, 'full'),
                'discount_percentage' => get_field('discount_percentage', $promotion->ID) ?: '',
                'promo_products' => get_field('promo_products', $promotion->ID) ?: '',
            );
        }
    }

    $response = array(
        'promotions' => $results,
        'max_pages' => $query->max_num_pages
    );

    return new WP_REST_Response($response, 200);
}
