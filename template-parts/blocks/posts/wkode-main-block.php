<?php 

$dark_mode         = get_field( 'wkode_main_block_dark_mode' );
$title             = get_field( 'wkode_main_block_title' );
$description       = get_field( 'wkode_main_block_description' );
$btn               = get_field( 'wkode_main_block_btn' );
$img               = get_field( 'wkode_main_block_img' );
$block_direction   = get_field( 'wkode_main_block_direction' );

//dark mode handling
if($dark_mode){
    $current_mode = "wkode-main-block__dark-mode";
}else{
    $current_mode = "wkode-main-block__light-mode";
}

//block direction handling
if($block_direction){
    $current_direction = "wkode-main-block__inverted-direction";
}else{
    $current_direction = "wkode-main-block__normal-direction";
}

if( isset( $block['data']['preview'] )  ) {    /* rendering in inserter preview  */ ?>

	<img src="<?php echo get_theme_file_uri('template-parts/blocks/preview/wkode-main-block.png'); ?>" style="width:100%; height:auto;">

<?php
}else{ ?>
<section class="wkode-main-block <?php echo $current_mode; echo " " . $current_direction; ?>">
        <div class="wkode-main-block__wrapper">
            <div class="wkode-main-block__content">
                <h2 class="wkode-main-block__title "><?php echo $title; ?></h2>
                <div class="wkode-main-block__text"><?php echo $description; ?></div>
                <a href="<?php echo $btn["wkode_main_block_btn_url"]; ?>" class="<?php echo $btn["wkode_main_block_btn_style"]; ?>"><?php echo $btn["wkode_main_block_btn_text"]; ?></a>
            </div>
            <div class="wkode-main-block__image ">
                <img class="wkode-main-block__img" src="<?php echo !empty($img['sizes']['wkode_main_block']) ? $img['sizes']['wkode_main_block'] : get_theme_file_uri('./assets/img/main-fallback.jpg'); ?>" alt="" srcset="">
            </div>
        </div>
    </section>
    <style>
        @media (max-width: 1080px) {
            .wkode-main-block__image{
                background-image: url(<?php echo !empty($img['sizes']['wkode_main_block_mobile']) ? $img['sizes']['wkode_main_block_mobile'] : get_theme_file_uri('./assets/img/main-fallback-mob.jpg'); ?>);
            }
        }
    </style>
<?php
}