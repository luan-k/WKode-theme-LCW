<?php 

$dark_mode         = get_field( 'wkode_main_block_dark_mode' );
$bg_color          = get_field( 'wkode_overlay_card_bg' );
$title             = get_field( 'wkode_main_block_title' );
$description       = get_field( 'wkode_main_block_description' );
$btn               = get_field( 'wkode_main_block_btn' );
$img               = get_field( 'wkode_main_block_img' );
$block_direction   = get_field( 'wkode_main_block_direction' );

//dark mode handling
if($dark_mode){
    $current_mode = "wkode-overlay-card__dark-mode";
}else{
    $current_mode = "wkode-overlay-card__light-mode";
}

//bg color handling
if($bg_color){
    $current_bg = "wkode-overlay-card__dark-bg";
}else{
    $current_bg = "wkode-overlay-card__light-bg";
}

//block direction handling
if($block_direction){
    $current_direction = "wkode-overlay-card__inverted-direction";
}else{
    $current_direction = "wkode-overlay-card__normal-direction";
}

// if( isset( $block['data']['preview'] )  ) {    /* rendering in inserter preview  */ ?>
<!-- 
	<img src="<?php echo get_theme_file_uri('template-parts/blocks/preview/wkode-overlay-card.png'); ?>" style="width:100%; height:auto;">
    -->
<?php
//}else{ ?> 
<section class="wkode-overlay-card <?php echo $current_mode; echo " " . $current_direction; echo " " . $current_bg; ?>">
        <div class="wkode-overlay-card__wrapper container">
            <div class="wkode-overlay-card__content">
                <h2 class="wkode-overlay-card__title "><?php echo $title; ?></h2>
                <div class="wkode-overlay-card__text"><?php echo $description; ?></div>
                <?php if($btn["wkode_main_block_btn_url"] || $btn["wkode_main_block_btn_text"]){ ?>
                    <a href="<?php echo $btn["wkode_main_block_btn_url"]; ?>" class="<?php echo $btn["wkode_main_block_btn_style"]; ?>"><?php if($btn["wkode_main_block_btn_text"]){echo $btn["wkode_main_block_btn_text"]; }else{ echo 'Ver Mais';} ?></a>
                <?php } ?>
            </div>
            <div class="wkode-overlay-card__image ">
                <img class="wkode-overlay-card__img" src="<?php echo !empty($img['sizes']['wkode_main_block_card_overlay']) ? $img['sizes']['wkode_main_block_card_overlay'] : get_theme_file_uri('./assets/img/revisao-geral-fallback.png'); ?>" alt="" srcset="">
            </div>
        </div>
    </section>
    <style>
        @media (max-width: 1080px) {
            .wkode-overlay-card{
                background-image: url(<?php echo !empty($img['sizes']['wkode_main_block_card_overlay']) ? $img['sizes']['wkode_main_block_card_overlay'] : get_theme_file_uri('./assets/img/revisao-geral-fallback.png'); ?>);
            }
        }
    </style>
<?php
/* } */