<?php

function filter_function($post_type, $taxonomy){

    $currentURL = $_SERVER['REQUEST_URI'];
    $queryString = $_SERVER['QUERY_STRING'];
    $filterValue = null;

    if (strpos($queryString, 'filtro=') !== false) {
        parse_str($queryString, $params);
        if (isset($params['filtro'])) {
            $filterValue = $params['filtro'];
        }
    }

    $countArgs = [
        'post_type' => $post_type,
        'posts_per_page' => -1,
    ];


    if (!empty($filterValue)) {
        $bikes['tax_query'] = [
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
}
