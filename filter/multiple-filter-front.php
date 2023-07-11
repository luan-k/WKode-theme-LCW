<?php

function multiple_filter_function($post_type, $taxonomy, $wp_object){
    $brandsValue = '';
    $modelsValue = '';

    $currentURL = $_SERVER['REQUEST_URI'];
    $queryString = $_SERVER['QUERY_STRING'];
    $filterValue = null;

    $brandsValue = [];
    $modelsValue = [];
    $stylesValue = [];
    $minimumPrice = null;
    $maximumPrice = null;

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
                if (strpos($segment, 'taxstyle=') !== false) {
                    $styleValue = explode(',', substr($segment, strpos($segment, '=') + 1));
                    $stylesValue = array_merge($stylesValue, $styleValue);
                }
                if (strpos($segment, 'minprice=') !== false) {
                  $minimumPrice = intval(substr($segment, strpos($segment, '=') + 1));
                }
                if (strpos($segment, 'maxprice=') !== false) {
                  $maximumPrice = intval(substr($segment, strpos($segment, '=') + 1));
                }
            }
        }
    }

    $taxonomyModels = 'moto_seminova_modelo';
    $taxonomyStyles = 'moto_seminova_estilos';

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
    if($stylesValue){
      $stylesPosts = array(
          'taxonomy' => $taxonomyStyles,
          'field'    => 'slug',
          'terms'    => $stylesValue,
      );
      array_push($taxonomies, $stylesPosts);
    }

    $acf_numbers = array(
      'relation' => 'AND',
    );
    if($minimumPrice){
      $minimumPosts = array(
        'key' => 'wkode_single_used_price',
        'value' => $minimumPrice,
        'compare' => '>=',
        'type' => 'NUMERIC',
      );
      array_push($acf_numbers, $minimumPosts);
    }
    if($maximumPrice){
      $maximumPosts = array(
        'key' => 'wkode_single_used_price',
        'value' => $maximumPrice,
        'compare' => '<=',
        'type' => 'NUMERIC',
      );
      array_push($acf_numbers, $maximumPosts);
    }

    $wp_object = [
      'post_type' => $post_type,
      'posts_per_page' => 36,
      'order_by' => 'date',
      'order' => 'desc',
      'tax_query' => $taxonomies,
      'paged' => 1,
      'meta_query' => $acf_numbers
    ];
    $countArgs = [
      'post_type' => $post_type,
      'posts_per_page' => -1,
      'order_by' => 'date',
      'order' => 'desc',
      'tax_query' => $taxonomies,
      'meta_query' => $acf_numbers
	  ];




     // Return the filter result and count args
    return [
        'brandsResult' => $brandsValue,
        'modelsResult' => $modelsValue,
        'stylesResult' => $stylesValue,
        'minPrice' => $minimumPrice,
        'maxPrice' => $maximumPrice,
        'countArgs' => $countArgs,
        'bikesArgs' => $wp_object,
    ];
}
