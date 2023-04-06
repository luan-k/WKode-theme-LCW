<?php

  /** Theme setup */
  require_once( 'inc/theme-setup.php' );
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

?>
