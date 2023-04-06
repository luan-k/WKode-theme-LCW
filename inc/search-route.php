<?php

add_action('rest_api_init', 'WkodeRegisterSearch');

function WkodeRegisterSearch(){
    register_rest_route('wk/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'WkodeSearchResults',
		'permission_callback' => '__return_true'
    ));
}

function WkodeSearchResults($data){
    $mainQuery = new WP_Query(array(
        'post_type' => array('product'),
        's' => sanitize_text_field($data['term']),
		'posts_per_page' => 36,
    ));
    $results = array(
        'products' => array(),
    );

    while($mainQuery->have_posts()){
        $mainQuery ->the_post();

        if(get_post_type() == 'product'){
            array_push($results['products'], array(

                'title' => wp_trim_words( get_the_title(), 4),
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0, 'ProductImageList'),
                'descricao' => wp_trim_words(get_the_content(), 24)
            ));
        }
    }

    return $results;
}
