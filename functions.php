<?php

  function enqueue_webpack_scripts() {
    wp_enqueue_style('wkode_main_styles', get_stylesheet_uri());
    wp_enqueue_style('main-css', get_template_directory_uri() . '/dist/main.min.css');
    wp_enqueue_script('main-js', get_theme_file_uri('/dist/main.min.js'), NULL, '1.0', true);
  }
  add_action( 'wp_enqueue_scripts', 'enqueue_webpack_scripts' );

?>