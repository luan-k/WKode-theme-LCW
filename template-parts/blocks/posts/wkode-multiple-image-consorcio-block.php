<?php 

$dark_mode         = get_field( 'wkode_main_block_dark_mode' );
$title             = get_field( 'wkode_main_block_title' );
$description       = get_field( 'wkode_main_block_description' );
$btn               = get_field( 'wkode_main_block_btn' );
$img               = get_field( 'wkode_main_block_img' );
$img2              = get_field( 'wkode_multiple_image_second' );
$img3              = get_field( 'wkode_multiple_image_third' );
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

//if( isset( $block['data']['preview'] )  ) {    /* rendering in inserter preview  */ ?>

	<!-- <img src="<?php echo get_theme_file_uri('template-parts/blocks/preview/wkode-main-block.png'); ?>" style="width:100%; height:auto;"> -->

<?php
//}else{ ?>
<section class="wkode-main-block <?php echo $current_mode; echo " " . $current_direction; ?> wkode-multiple-image">
        <div class="wkode-main-block__wrapper ">
            <div class="wkode-main-block__content col-span-1">
                <h2 class="wkode-main-block__title "><?php echo $title; ?></h2>
                <div class="wkode-main-block__text"><?php echo $description; ?></div>
                <?php if($btn["wkode_main_block_btn_url"] || $btn["wkode_main_block_btn_text"]){ ?>
                    <a href="<?php echo $btn["wkode_main_block_btn_url"]; ?>" class="<?php echo $btn["wkode_main_block_btn_style"]; ?>"><?php if($btn["wkode_main_block_btn_text"]){echo $btn["wkode_main_block_btn_text"]; }else{ echo 'Ver Mais';} ?></a>
                <?php } ?>
            </div>
            <div class="wkode-main-block__image col-span-1">
                <div class="composition h-full">
                    <img srcset="<?php echo !empty($img['sizes']['wkode_main_block']) ? $img['sizes']['wkode_main_block'] : get_theme_file_uri('./assets/img/main-fallback_first.jpg'); ?> 300w, <?php echo !empty($img['sizes']['wkode_main_block']) ? $img['sizes']['wkode_main_block'] : get_theme_file_uri('./assets/img/main-fallback_first.jpg'); ?>1000w"
                        sizes="(max-width: 56.25em) 20vw, (max-width: 37.5em) 30vw, 300px"
                        alt="Photo 1"
                        class="composition__photo composition__photo--p1"
                        src="<?php echo !empty($img['sizes']['wkode_main_block']) ? $img['sizes']['wkode_main_block'] : get_theme_file_uri('./assets/img/main-fallback_first.jpg'); ?>">
                    <img srcset="<?php echo !empty($img2['sizes']['wkode_main_block']) ? $img2['sizes']['wkode_main_block'] : get_theme_file_uri('./assets/img/main-fallback_second.jpg'); ?> 300w, <?php echo !empty($img2['sizes']['wkode_main_block']) ? $img2['sizes']['wkode_main_block'] : get_theme_file_uri('./assets/img/main-fallback_second.jpg'); ?> 1000w"
                                    sizes="(max-width: 56.25em) 20vw, (max-width: 37.5em) 30vw, 300px"
                        alt="Photo 2"
                        class="composition__photo composition__photo--p2"
                        src="<?php echo !empty($img2['sizes']['wkode_main_block']) ? $img2['sizes']['wkode_main_block'] : get_theme_file_uri('./assets/img/main-fallback_second.jpg'); ?>">

                    <img srcset="<?php echo !empty($img3['sizes']['wkode_main_block']) ? $img3['sizes']['wkode_main_block'] : get_theme_file_uri('./assets/img/main-fallback_third.jpg'); ?> 300w, <?php echo !empty($img3['sizes']['wkode_main_block']) ? $img3['sizes']['wkode_main_block'] : get_theme_file_uri('./assets/img/main-fallback_third.jpg'); ?> 1000w"
                        sizes="(max-width: 56.25em) 20vw, (max-width: 37.5em) 30vw, 300px"
                        alt="Photo 3"
                        class="composition__photo composition__photo--p3"
                        src="<?php echo !empty($img3['sizes']['wkode_main_block']) ? $img3['sizes']['wkode_main_block'] : get_theme_file_uri('./assets/img/main-fallback_third.jpg'); ?>">

                </div>
            </div>
        </div>
    </section>
   
<?php
//}