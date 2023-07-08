<?php

function filter_function($post_type, $taxonomy, $wp_object){

    $currentURL = $_SERVER['REQUEST_URI'];
    $queryString = $_SERVER['QUERY_STRING'];
    $filterValue = null;

    if (strpos($queryString, 'filtro=') !== false) {
        parse_str(str_replace('?arg=', ',', $queryString), $params);
        if (isset($params['filtro'])) {
            $filterValue = explode(',', $params['filtro']);
        }
    }

    $countArgs = [
        'post_type' => $post_type,
        'posts_per_page' => -1,
    ];


    if (!empty($filterValue)) {
        $wp_object['tax_query'] = [
        [
            'taxonomy' => $taxonomy,
            'field' => 'slug', // Change 'slug' to 'term_id' if you are passing term IDs instead of slugs
            'terms' => $filterValue,
            //'operator' => 'IN'
        ],
        ];
        $countArgs['tax_query'] = [
        [
            'taxonomy' => $taxonomy,
            'field' => 'slug', // Change 'slug' to 'term_id' if you are passing term IDs instead of slugs
            'terms' => $filterValue,
            //'relation' => 'AND',
            //'operator' => 'IN'
        ],
        ];
    }


     // Return the filter result and count args
     return [
        'filterResult' => $filterValue,
        'countArgs' => $countArgs,
        'bikesArgs' => $wp_object,
    ];
}
