<?php

function multiple_filter_function($post_type, $taxonomy, $wp_object){
    $brandsValue = '';
    $modelsValue = '';

    $currentURL = $_SERVER['REQUEST_URI'];
    $queryString = $_SERVER['QUERY_STRING'];
    $filterValue = null;

    $brandsValue = [];
    $modelsValue = [];

    if (strpos($queryString, 'filtro=') !== false) {
        parse_str(str_replace('?arg=', ',', $queryString), $params);
        if (isset($params['filtro'])) {
            $filtroValue = $params['filtro'];
            $filtroSegments = explode('?', $filtroValue);
            foreach ($filtroSegments as $segment) {
                if (strpos($segment, 'taxbrand=') !== false) {
                    $brandValue = explode(',', substr($segment, strpos($segment, '=') + 1));
                    $brandsValue = array_merge($brandsValue, $brandValue);
                }
                if (strpos($segment, 'taxmodel=') !== false) {
                    $modelValue = explode(',', substr($segment, strpos($segment, '=') + 1));
                    $modelsValue = array_merge($modelsValue, $modelValue);
                }
            }
        }
    }

    $taxonomyModels = 'moto_seminova_modelo';

    $taxonomies = array(
      'relation' => 'AND',
    );

    if($brandsValue){
      $catPosts = array(
        'taxonomy' => $taxonomy,
        'field' => 'slug', // Change 'slug' to 'term_id' if you are passing term IDs instead of slugs
        'terms' => $brandsValue,
      );
      array_push($taxonomies, $catPosts);
    }
    if($modelsValue){
      $modelsPosts = array(
          'taxonomy' => $taxonomyModels,
          'field'    => 'slug',
          'terms'    => $modelsValue,
      );
      array_push($taxonomies, $modelsPosts);
    }

    $wp_object = [
      'post_type' => $post_type,
      'posts_per_page' => 36,
      'order_by' => 'date',
      'order' => 'desc',
      'tax_query' => $taxonomies,
      'paged' => 1,
    ];
    $countArgs = [
      'post_type' => $post_type,
      'posts_per_page' => -1,
      'order_by' => 'date',
      'order' => 'desc',
      'tax_query' => $taxonomies,
	  ];




     // Return the filter result and count args
    return [
        'brandsResult' => $brandsValue,
        'modelsResult' => $modelsValue,
        'countArgs' => $countArgs,
        'bikesArgs' => $wp_object,
    ];
}
