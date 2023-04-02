<?php get_header();?>

<div class="wkode-slider-container">
  <div class="wkode-slider">
    <div class="wkode-slider-slide" style="background-color: black;">
      <img src="<?php echo get_theme_file_uri('assets/img/screenshot.png'); ?>" alt="" srcset="">
    </div>
    <div class="wkode-slider-slide" style="background-color: black;">
      <img src="<?php echo get_theme_file_uri('assets/img/first-slider.png'); ?>" alt="" srcset="">
    </div>
    <div class="wkode-slider-slide" style="background-color: #e91e63;">
      <img src="<?php echo get_theme_file_uri('assets/img/second-slider.png'); ?>" alt="" srcset="">
    </div>
    <div class="wkode-slider-slide" style="background-color: #9c27b0;">
      <img src="<?php echo get_theme_file_uri('assets/img/third-slider.png'); ?>" alt="" srcset="">
    </div>
    <div class="wkode-slider-slide" style="background-color: #607d8b;">
      <img src="<?php echo get_theme_file_uri('assets/img/fourth.png'); ?>" alt="" srcset="">
    </div>
  </div>
  <button class="wkode-slider-prev"><i class="fa-solid fa-chevron-left"></i></button>
  <button class="wkode-slider-next"><i class="fa-solid fa-chevron-right"></i></button>
  <div class="wkode-slider-dots"></div>
  <div class="wkode-slider-progress">
    <div class="wkode-slider-progress-bar">bru</div>
  </div>
</div>
<?php

$ua = strtolower($_SERVER['HTTP_USER_AGENT']);

if (strpos($ua, 'mobile') !== false || strpos($ua, 'tablet') !== false) {
  // Apply mobile styles
  echo '<style>
         .wkode-slider-slide {
           max-width: 100%;
         }
       </style>';
} else {
  // Apply desktop styles
  echo '<style>
         .wkode-slider-slide {
           max-width: calc(100vw - 1rem) ;
         }
       </style>';
}

?>

  <main id="main" class="text-white text-center p-7 container rounded-3xl my-11">

    <h1 class="bg-red bg-gray-500 text-6xl">Home Page</h1>

    <p class="bg-green-950 text-5xl">This content is hard-coded into the `index.php` file in the root of the theme directory.</p>

  </main>

<?php get_footer(); ?>