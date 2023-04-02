<?php 

$slider        = get_field( 'slider_repeater' );
$slider_mobile = get_field( 'slider_repeater_mobile' );
$is_mobile     = get_field( 'is_this_mobile' );


if( isset( $block['data']['preview'] )  ) {    /* rendering in inserter preview  */ ?>

	<img src="<?php echo get_theme_file_uri('template-parts/blocks/preview/wkode-slider.png'); ?>" style="width:100%; height:auto;">

<?php
}else{ ?>

  <div class="wkode-slider-container <?php if(!empty($is_mobile)){ echo " there-is-mobile "; }else{ echo " there-is-no-mobile ";} ?>" id="wkode-slider-container">
    <div class="wkode-slider">
      <?php
      if($slider){
        foreach($slider as $slide){
          if(!empty($slide['slider_image'])){
            ?>
            <div class="wkode-slider-slide">
              <img src="<?php echo $slide['slider_image']; ?>" alt="" srcset="">
            </div>
            <?php
          }else{?>
            <div class="wkode-slider-slide" style="background-color: black;">
              <img src="<?php echo get_theme_file_uri('assets/img/screenshot.png'); ?>" alt="" srcset="">
            </div>
          <?php
          }
        }
      }else{?>
        <div class="wkode-slider-slide" style="background-color: black;">
          <img src="<?php echo get_theme_file_uri('assets/img/screenshot.png'); ?>" alt="" srcset="">
        </div>
      <?php
      }
      ?>
    </div>
    <button class="wkode-slider-prev"><i class="fa-solid fa-chevron-left"></i></button>
    <button class="wkode-slider-next"><i class="fa-solid fa-chevron-right"></i></button>
    <div class="wkode-slider-dots"></div>
    <div class="wkode-slider-progress">
      <div class="wkode-slider-progress-bar"></div>
    </div>
  </div>
  <?php 
  if(!empty($is_mobile)){ ?>
    <div class="wkode-slider-container wkode-slider-container-mobile" id="wkode-slider-container-mobile">
      <div class="wkode-slider">
        <?php
        if($slider_mobile){
          foreach($slider_mobile as $slide){
            if(!empty($slide['slider_image_mobile'])){
              ?>
              <div class="wkode-slider-slide">
                <img src="<?php echo $slide['slider_image_mobile']; ?>" alt="" srcset="">
              </div>
              <?php
            }else{?>
              <div class="wkode-slider-slide" style="background-color: black;">
                <img src="<?php echo get_theme_file_uri('assets/img/screenshot-mobile.png'); ?>" alt="" srcset="">
              </div>
            <?php
            }
          }
        }else{?>
          <div class="wkode-slider-slide" style="background-color: black;">
            <img src="<?php echo get_theme_file_uri('assets/img/screenshot-mobile.png'); ?>" alt="" srcset="">
          </div>
        <?php
        }
        ?>
      </div>
      <button class="wkode-slider-prev"><i class="fa-solid fa-chevron-left"></i></button>
      <button class="wkode-slider-next"><i class="fa-solid fa-chevron-right"></i></button>
      <div class="wkode-slider-dots"></div>
      <div class="wkode-slider-progress">
        <div class="wkode-slider-progress-bar"></div>
      </div>
    </div>
  <?php
  }

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
}