<?php

function multiple_filter_posts() {
    $template_path = $_POST['templatePath'];
    $post_type = $_POST['postType'];
    $taxonomy = $_POST['taxonomy'];
    $catSlug = $_POST['category'];
    $paged = $_POST['currentPage'];

    $taxonomyModels = 'moto_seminova_modelo';
    $modelsTerms = $_POST['models'];

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

    $query_args = [
      'post_type' => $post_type,
      'posts_per_page' => 36,
      'paged' => $paged,
      'order_by' => 'date',
      'order' => 'desc',
      'tax_query' => $taxonomies,
    ];
    $countArgs = [
      'post_type' => $post_type,
      'posts_per_page' => -1,
	  ];


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
        'cat' => $catSlug
    ];

  
    echo json_encode($result);
    exit;
  }
  add_action('wp_ajax_multiple_filter_posts', 'multiple_filter_posts');
  add_action('wp_ajax_nopriv_multiple_filter_posts', 'multiple_filter_posts');