<?php

function custom_rewrite_rule() {
    add_rewrite_rule('^motos-novas/?$', 'index.php?post_type=motos-novas', 'top');
  }
add_action('init', 'custom_rewrite_rule', 10, 0);

function custom_rewrite_tag() {
    add_rewrite_tag('%filtro%', '([^&]+)');
}
add_action('init', 'custom_rewrite_tag', 10, 0);

function filter_posts() {
    $template_path = $_POST['templatePath'];
    $post_type = $_POST['postType'];
    $taxonomy = $_POST['taxonomy'];
    $catSlug = $_POST['category'];
    $paged = $_POST['currentPage'];
    $minimumPrice = $_POST['minimumPrice'];
    $maximumPrice = $_POST['maximumPrice'];

    $taxonomyModels = 'moto_nova_categoria';
    $modelsTerms = $_POST['models'];
    $taxonomyStyles = 'moto_nova_estilos';
    $stylesTerms = $_POST['styles'];

    $query_args = [
        'post_type' => $post_type,
        'posts_per_page' => 36,
        'paged' => $paged,
        'order_by' => 'date',
        'order' => 'desc',
    ];
    $countArgs = [
		'post_type' => $post_type,
		'posts_per_page' => -1,
	];

    $taxonomies = array(
      'relation' => 'AND',
    );

    if($catSlug){
      $catPosts = array(
        'taxonomy' => $taxonomy,
        'field' => 'slug', // Change 'slug' to 'term_id' if you are passing term IDs instead of slugs
        'terms' => $catSlug,
      );
      array_push($taxonomies, $catPosts);
    }
    if($modelsTerms){
      $modelsPosts = array(
          'taxonomy' => $taxonomyModels,
          'field'    => 'slug',
          'terms'    => $modelsTerms,
      );
      array_push($taxonomies, $modelsPosts);
    }
    if($stylesTerms){
      $stylesPosts = array(
          'taxonomy' => $taxonomyStyles,
          'field'    => 'slug',
          'terms'    => $stylesTerms,
      );
      array_push($taxonomies, $stylesPosts);
    }
    
    $acf_numbers = array(
      'relation' => 'AND',
    );
    if($minimumPrice){
      $minimumPosts = array(
        'key' => 'wkode_single_new_bikes_price',
        'value' => $minimumPrice,
        'compare' => '>=',
        'type' => 'NUMERIC',
      );
      array_push($acf_numbers, $minimumPosts);
    }
    if($maximumPrice){
      $maximumPosts = array(
        'key' => 'wkode_single_new_bikes_price',
        'value' => $maximumPrice,
        'compare' => '<=',
        'type' => 'NUMERIC',
      );
      array_push($acf_numbers, $maximumPosts);
    }

    $query_args['tax_query'] = $taxonomies;
    $query_args['meta_query'] = $acf_numbers;
    $countArgs['tax_query'] = $taxonomies;
    $countArgs['meta_query'] = $acf_numbers;

    if (!empty($catSlug)) {
    }

    if (!empty($catSlug) || !empty($modelsTerms) || !empty($stylesTerms) || !empty($minimumPrice) || !empty($maximumPrice)) {
        // Tax query and meta query are already set above
    }
    
  
    $ajaxposts = new WP_Query($query_args);
    $count = new WP_Query($countArgs);
    $max_pages = $ajaxposts->max_num_pages;
    $response = '';
    
    if($ajaxposts->have_posts()) {
		  ob_start();
			while($ajaxposts->have_posts()) : $ajaxposts->the_post();
        $response .= get_template_part($template_path);
			endwhile;
		  $output = ob_get_contents();
		  ob_end_clean();
    } else {
		$output = "<h2 class='md:col-span-3 text-center  mt-20 md:mt-20 text-4xl font-rubik font-semibold text-white'>Não existe nenhum produto com essas características</h2>
			<h3 class='md:col-span-3 text-center  mt-20 md:mt-0 text-3xl font-rubik font-semibold text-white'>Por favor, selecione uma nova combinação de filtros ao lado</h3>";
    }
    $result = [
        'max' => $max_pages,
        'current_number_posts' => $ajaxposts->post_count,
        'total_number_posts' => $count->post_count,
        'html' => $output,
        'paged' => $paged,
        'cat' => $catSlug,
        'minPrice' => $minimumPrice,
        'maxPrice' => $maximumPrice,
        'acfNumber' => $acf_numbers,
    ];

  
    echo json_encode($result);
    exit;
  }
  add_action('wp_ajax_filter_posts', 'filter_posts');
  add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');