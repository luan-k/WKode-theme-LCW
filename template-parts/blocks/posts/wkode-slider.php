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
              <img src="<?php echo $slide['slider_image']['sizes']['slider']; ?>" alt="" srcset="">
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
    <div class="wkode-slider-navigation">
      <button class="wkode-slider-prev" style="background-image: url(<?php echo get_theme_file_uri('assets/img/svg/arrow-left.svg'); ?>);">
      </button>
      <div class="wkode-slider-dots"></div>
      <button class="wkode-slider-next" style="background-image: url(<?php echo get_theme_file_uri('assets/img/svg/arrow-right.svg'); ?>);"> 
      </button>
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
                <img src="<?php echo $slide['slider_image_mobile']['sizes']['slider_mobile']; ?>" alt="" srcset="">
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
      <div class="wkode-slider-navigation">
        <button class="wkode-slider-prev" style="background-image: url(<?php echo get_theme_file_uri('assets/img/svg/arrow-left.svg'); ?>);">
        </button>
        <div class="wkode-slider-dots"></div>
        <button class="wkode-slider-next" style="background-image: url(<?php echo get_theme_file_uri('assets/img/svg/arrow-right.svg'); ?>);"> 
        </button>
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
?>
<style>
   .wkode-slider-progress-bar {
      height: 100%;
      background-color: white;
      width: 0%;
      transition: none;
      border-radius: 44px;
    }
</style>