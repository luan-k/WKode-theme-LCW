<?php

  /** Theme setup */
  require_once( 'inc/theme-setup.php' );
  require_once( 'inc/custom-post-types.php' );
  require get_theme_file_path('/inc/search-route.php');

  function enqueue_wkode_scripts() {
    wp_enqueue_style('wkode_main_styles', get_stylesheet_uri());
    wp_enqueue_style('main-css', get_template_directory_uri() . '/dist/main.min.css');
    wp_enqueue_script('main-js', get_theme_file_uri('/dist/main.min.js'), NULL, '1.0', true);
    wp_enqueue_script('wkode-font_awesome', '//kit.fontawesome.com/fde7c29e46.js', NULL, '1.0', true);

    //for the search
    wp_localize_script('main-js', 'WKodeData', array(
        'root_url' => get_site_url()
    ));
  }
  add_action( 'wp_enqueue_scripts', 'enqueue_wkode_scripts' );

  //queing the styles and scripts in the blocks preview
  add_action( 'enqueue_block_editor_assets', 'enqueue_wkode_scripts' );

  // Enable ACF JSON
  add_filter('acf/settings/save_json', 'my_acf_json_save_point');
  function my_acf_json_save_point( $path ) {
      // update path
      $path = get_stylesheet_directory() . '/acf-json';
      // return
      return $path;
  }

// Load ACF JSON
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
      // remove original path (optional)
      unset($paths[0]);
      // append path
      $paths[] = get_stylesheet_directory() . '/acf-json';
      // return
      return $paths;
}




//megamenu styles config   
function add_megamenu_wrapper($args) {
    if($args['theme_location'] === 'main_menu') { 
        $args['walker'] = new Megamenu_Walker();
    }
    return $args;
}
add_filter('wp_nav_menu_args', 'add_megamenu_wrapper');

class Megamenu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $sub_menu_class = ($depth > 0) ? 'sub-menu' : 'sub-menu megamenu';
        $output .= "\n$indent<div class='$sub_menu_class'><ul>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $li_attributes = '';
        $class_names = $value = '';
    
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        if ($args->walker->has_children) {
            $classes[] = 'menu-item-has-children';
        }
        $classes[] = 'menu-item-' . $item->ID;
        if ($depth && $args->walker->has_children) {
            $classes[] = 'dropdown-submenu';
        }
        if ($depth === 0) {
            $classes[] = 'top-level-menu-item megamenu-custom-top-level-class';
        }
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="' . esc_attr($class_names) . '"';
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';
        $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';
    
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
    
        // Add SVG arrow icon to top-level menu items
        if ($depth === 0 && $args->walker->has_children) {
            $item_output .= '<span class="menu-item-arrow">' . $this->get_svg_arrow() . '</span>';
        }
    
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
    
        // If this is a linked post type, add the featured image in a nested div with an <a> tag
        if (get_post_type($item->object_id) == 'motos-novas') {
            $custom_field_value = get_field('wkode_motorcycles_post_colors', $item->object_id);
            $first_custom_field = $custom_field_value[0];
            $postImg = $first_custom_field['wkode_motorcycles_post_img'];
            $image_url = get_the_post_thumbnail_url($item->object_id, 'full'); 
            if($postImg){
                $actual_image = $postImg;
            }else{
                $actual_image = $image_url;
            }
            $item_output .= '<div class="menu-item-image">';
            $item_output .= '<img src="' . esc_url($actual_image) . '" />' . '<a class="wkode-btn--solid-main-red w-1/3" href="' . esc_url(get_permalink($item->object_id)) . '">Ver Mais</a>';
            $item_output .= '</div>';
        }
    
        $item_output .= $args->after;
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    // Helper function to get SVG arrow icon from file
    function get_svg_arrow() {
        $svg_file_path = get_template_directory() . './assets/img/svg/megamenu-arrow-light.svg';

        if (file_exists($svg_file_path)) {
            $svg_content = file_get_contents($svg_file_path);
            return $svg_content;
        }

        return ''; // Return an empty string if the SVG file doesn't exist or cannot be read
    }
    

}

function custom_rewrite_rule() {
    add_rewrite_rule('^motos-novas/?$', 'index.php?post_type=motos-novas', 'top');
  }
add_action('init', 'custom_rewrite_rule', 10, 0);

function custom_rewrite_tag() {
    add_rewrite_tag('%filtro%', '([^&]+)');
}
add_action('init', 'custom_rewrite_tag', 10, 0);

function filter_projects() {
    $catSlug = $_POST['category'];

    $query_args = [
        'post_type' => 'motos-novas',
        'posts_per_page' => -1,
        'order_by' => 'date',
        'order' => 'desc',
    ];

    if (!empty($catSlug)) {
        $query_args['tax_query'] = [
          [
            'taxonomy' => 'moto_nova_categoria',
            'field' => 'slug', // Change 'slug' to 'term_id' if you are passing term IDs instead of slugs
            'terms' => $catSlug,
            //'operator' => 'IN'
          ],
        ];
    }
  
    $ajaxposts = new WP_Query($query_args);
    $response = '';


    if($ajaxposts->have_posts()) {
		ob_start();
			while($ajaxposts->have_posts()) : $ajaxposts->the_post();
                $response .= get_template_part('./template-parts/cards/new-bikes');
			endwhile;
		$output = ob_get_contents();
		ob_end_clean();
    } else {
		$output = "<h2 class='md:col-span-3 text-center  mt-20 md:mt-20 text-4xl font-rubik font-semibold text-white'>Não existe nenhum produto com essas características</h2>
			<h3 class='md:col-span-3 text-center  mt-20 md:mt-0 text-3xl font-rubik font-semibold text-white'>Por favor, selecione uma nova combinação de filtros ao lado</h3>";
    }
    $result = [
        //'max' => $max_pages,
        //'current_number_posts' => $ajaxposts->post_count,
        //'total_number_posts' => $count->post_count,
        'html' => $output,
        'test' => 'test',
    ];

  
    echo json_encode($result);
    exit;
  }
  add_action('wp_ajax_filter_projects', 'filter_projects');
  add_action('wp_ajax_nopriv_filter_projects', 'filter_projects');

?>
