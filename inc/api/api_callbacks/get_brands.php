<?php
function get_brands($request)
{
    $page = $request->get_param('page');
    $lang = $request->get_param('lang');

    $query = new WP_Query(array(
        'post_type' => 'brand',
        'orderby' => 'date',
        'order' => 'ASC',
        'posts_per_page' => 4,
        'post_status' => 'publish',
        'paged' => $page,
        'lang' => $lang,
    ));


    $brands = $query->posts;
    $results = array();

    if ($brands) {
        foreach ($brands as $brand) {
            $logo = get_field('brand_logo', $brand->ID) ? get_field('brand_logo', $brand->ID)['url'] : '';
            $results[] = array(
                'id' => $brand->ID,
                'title' => $brand->post_title,
                'description' => get_field('description', $brand->ID) ?: '',
                'logo' => $logo,
                'link' => get_field('brand_link', $brand->ID) ?: '',
                'featured_image' => get_the_post_thumbnail_url($brand->ID, 'full'),
                'arrow_right_path' => get_template_directory_uri() . '/assets/icons/arrow--right.svg',
                'link_text' => pll__('Visit site', 'starter'),
            );
        }
    }

    $response = array(
        'brands' => $results,
        'max_pages' => $query->max_num_pages
    );

    return new WP_REST_Response($response, 200);
}
