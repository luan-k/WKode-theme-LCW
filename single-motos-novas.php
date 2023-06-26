<?php get_header(); 

$hero_image = get_field( 'wkode_motorcycles_hero_image' );

?>

<div id="primary" class="wkode-single-new-bikes-template content-area">
    <main id="main" class="wkode-single-new-bikes-template__main site-main" role="main">

        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('wkode-single-new-bikes-template__article'); ?>>

                <div class="wkode-single-new-bikes-template__image featured-image">
                    <?php if (has_post_thumbnail()) : ?>
                       <img class="wkode-single-new-bikes__img" src="<?php echo has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID, 'wkode_single_new_bikes') : get_theme_file_uri('/images/standard.png'); ?>" alt="" srcset="">
                    <?php endif; ?>
                    <div class="wkode-single-new-bikes-template__form" id="wkode-single-new-bikes-template__form">
                        <h2 class="wkode-single-new-bikes-template__form-title"><?php the_title(); ?></h2>
                        <?php echo do_shortcode( '[wpforms id="308" title="false"]' ); ?>
                    </div>
                </div>
                
                <div class="wkode-single-new-bikes-template__body">
                    <header class="wkode-single-new-bikes-template__title-header entry-header md:container">
                        <h1 class="wkode-single-new-bikes-template__title entry-title px-12 md:px-0"><?php the_title(); ?></h1>
                    </header>

                    <section class="wkode-single-new-bikes-template__intro-block">
                        <?php 

                        // intro block
                        $intro_block = get_field('wkode_new_motorcycles_hero_image_intro_block');

                        if($intro_block):
                        $intro_dark_mode         = $intro_block['wkode_main_block_dark_mode'] ;
                        $intro_title             = $intro_block['wkode_main_block_title'];
                        $intro_description       = $intro_block['wkode_main_block_description'];
                        $intro_img               = $intro_block['wkode_main_block_img'];
                        $intro_block_direction   = $intro_block['wkode_main_block_direction'];

                        //dark mode handling
                        if($intro_dark_mode){
                            $intro_current_mode = "wkode-single-new-bikes-template-block__dark-mode";
                        }else{
                            $intro_current_mode = "wkode-single-new-bikes-template-block__light-mode";
                        }

                        //block direction handling
                        if($intro_block_direction){
                            $intro_current_direction = "wkode-single-new-bikes-template-block__inverted-direction";
                        }else{
                            $intro_current_direction = "wkode-single-new-bikes-template-block__normal-direction";
                        }
                        ?>

                        <section class="wkode-single-new-bikes-template-block <?php echo $intro_current_mode; echo " " . $intro_current_direction; ?>">
                            <div class="wkode-single-new-bikes-template-block__wrapper">
                                <div class="wkode-single-new-bikes-template-block__content">
                                    <h2 class="wkode-single-new-bikes-template-block__title "><?php echo $intro_title; ?></h2>
                                    <div class="wkode-single-new-bikes-template-block__text"><?php echo $intro_description; ?></div>

                                </div>
                                <div class="wkode-single-new-bikes-template-block__image ">
                                    <img class="wkode-single-new-bikes-template-block__img" src="<?php echo !empty($intro_img['sizes']['wkode_single_image_blocks']) ? $intro_img['sizes']['wkode_single_image_blocks'] : get_theme_file_uri('./assets/img/main-fallback.jpg'); ?>" alt="" srcset="">
                                </div>
                            </div>
                        </section>
                        <?php endif ?>
                    </section>

                    <section class="wkode-single-new-bikes-template__bikes-colors bg-white relative">
                        <div class="wkode-single-new-bikes-template__bikes-colors-wrapper container py-48">
                        <?php
                        // Get the value of the custom field for the current post 
                        $custom_field_value = get_field('wkode_motorcycles_post_colors', get_the_ID());

                        foreach ($custom_field_value as $index => $field) {
                            $postImg = $field['wkode_motorcycles_post_img'];
                            if($index == 0){ ?>

                                <img class="wkode-new-bikes__card-img active-color-image" src="<?php echo $postImg; ?>" alt="" srcset=""><?php
                            }else{  ?>
                                <img class="wkode-new-bikes__card-img" src="<?php echo $postImg; ?>" alt="" srcset=""> <?php
                            }

                        }?>
                        <div class="wkode-new-bikes__card-colors text-black container">
                            <?php

                            foreach ($custom_field_value as $index => $field) {
                                $postColor = $field['wkode_motorcycles_post_color'];
                                $biOrTri = $field['wkode_motorcycles_bicolor_ou_tricolor'];
                                $secondColor = $field['wkode_motorcycles_post_color_two'];
                                $thirdColor = $field['wkode_motorcycles_post_color_three'];

                                if($biOrTri == 'bicolor'){
                                    $biOrTriClass = "wkode-new-bikes__card-color--bicolor";
                                }elseif($biOrTri == 'tricolor'){
                                    $biOrTriClass = "wkode-new-bikes__card-color--tricolor";
                                }else{
                                    $biOrTriClass = "wkode-new-bikes__card-color--unique";
                                }
                                if($index == 0){ 
                                    $active_color = "active-color";
                                }else{ 
                                    $active_color = "";
                                } ?>
                                <span class="wkode-new-bikes__card-color <?php echo $active_color ?>">
                                    <span class="<?php echo $biOrTriClass ?>" style="background-color: <?php echo $postColor; ?>"></span>
                                    <?php
                                    if($biOrTri == 'bicolor'){ ?>
                                        <span class="<?php echo $biOrTriClass ?>" style="background-color: <?php echo $secondColor; ?>"></span><?php 
                                    }if($biOrTri == 'tricolor'){?>
                                        <span class="<?php echo $biOrTriClass ?>" style="background-color: <?php echo $secondColor; ?>"></span>
                                        <span class="<?php echo $biOrTriClass ?>" style="background-color: <?php echo $thirdColor; ?>"></span><?php 
                                    }
                                    ?>
                                </span> <?php
                            }
                        
                        ?>
                        </div>
                        </div>
                    </section>

                    <section class="wkode-single-new-bikes-template__intro-block">
                        <?php 

                        // intro block
                        $standart_block = get_field('wkode_new_motorcycles_standart_descriptive_block');

                        if($standart_block):
                        $standart_dark_mode         = $standart_block['wkode_main_block_dark_mode'] ;
                        $standart_title             = $standart_block['wkode_main_block_title'];
                        $standart_description       = $standart_block['wkode_main_block_description'];
                        $standart_img               = $standart_block['wkode_main_block_img'];
                        $standart_block_direction   = $standart_block['wkode_main_block_direction'];

                        //dark mode handling
                        if($standart_dark_mode){
                            $standart_current_mode = "wkode-single-new-bikes-template-block__dark-mode";
                        }else{
                            $standart_current_mode = "wkode-single-new-bikes-template-block__light-mode";
                        }

                        //block direction handling
                        if($standart_block_direction){
                            $standart_current_direction = "wkode-single-new-bikes-template-block__inverted-direction";
                        }else{
                            $standart_current_direction = "wkode-single-new-bikes-template-block__normal-direction";
                        }
                        ?>

                        <section class="wkode-single-new-bikes-template-block <?php echo $standart_current_mode; echo " " . $standart_current_direction; ?>">
                            <div class="wkode-single-new-bikes-template-block__wrapper">
                                <div class="wkode-single-new-bikes-template-block__content">
                                    <h2 class="wkode-single-new-bikes-template-block__title "><?php echo $standart_title; ?></h2>
                                    <div class="wkode-single-new-bikes-template-block__text"><?php echo $standart_description; ?></div>

                                </div>
                                <div class="wkode-single-new-bikes-template-block__image ">
                                    <img class="wkode-single-new-bikes-template-block__img" src="<?php echo !empty($standart_img['sizes']['wkode_single_image_standart_block']) ? $standart_img['sizes']['wkode_single_image_standart_block'] : get_theme_file_uri('./assets/img/standart_image.png'); ?>" alt="" srcset="">
                                </div>
                            </div>
                        </section>
                        <?php endif ?>
                    </section>

                    <section class="wkode-single-new-bikes-template__intro-block">
                        <?php 

                        // intro block
                        $standart_second_block = get_field('wkode_new_motorcycles_standart_descriptive_block_2');

                        if($standart_second_block):
                        $standart_second_dark_mode         = $standart_second_block['wkode_main_block_dark_mode'] ;
                        $standart_second_title             = $standart_second_block['wkode_main_block_title'];
                        $standart_second_description       = $standart_second_block['wkode_main_block_description'];
                        $standart_second_img               = $standart_second_block['wkode_main_block_img'];
                        $standart_second_block_direction   = $standart_second_block['wkode_main_block_direction'];

                        //dark mode handling
                        if($standart_second_dark_mode){
                            $standart_second_current_mode = "wkode-single-new-bikes-template-block__dark-mode";
                        }else{
                            $standart_second_current_mode = "wkode-single-new-bikes-template-block__light-mode";
                        }

                        //block direction handling
                        if($standart_second_block_direction){
                            $standart_second_current_direction = "wkode-single-new-bikes-template-block__inverted-direction";
                        }else{
                            $standart_second_current_direction = "wkode-single-new-bikes-template-block__normal-direction";
                        }
                        ?>

                        <section class="wkode-single-new-bikes-template-block <?php echo $standart_second_current_mode; echo " " . $standart_second_current_direction; ?>">
                            <div class="wkode-single-new-bikes-template-block__wrapper">
                                <div class="wkode-single-new-bikes-template-block__content">
                                    <h2 class="wkode-single-new-bikes-template-block__title "><?php echo $standart_second_title; ?></h2>
                                    <div class="wkode-single-new-bikes-template-block__text"><?php echo $standart_second_description; ?></div>

                                </div>
                                <div class="wkode-single-new-bikes-template-block__image ">
                                    <img class="wkode-single-new-bikes-template-block__img" src="<?php echo !empty($standart_second_img['sizes']['wkode_single_image_standart_block']) ? $standart_second_img['sizes']['wkode_single_image_standart_block'] : get_theme_file_uri('./assets/img/standart_image.png'); ?>" alt="" srcset="">
                                </div>
                            </div>
                        </section>
                        <?php endif ?>

                       
                    </section>

                    <section class="wkode-single-new-bikes-template__slider">
                        <?php 

                        // intro block
                        $slides_block              = get_field('wkode_new_motorcycles_repeater_group');

                        if($slides_block):

                        $slides_main_title         = $slides_block['wkode_new_motorcycles_repeater_title'];
                        $slides_repeater           = $slides_block['wkode_new_motorcycles_repeater'];
                        ?>
                            <section class="wkode-single-new-bikes-template-block wkode-single-new-bikes__slides wkode-single-new-bikes-template-block__dark-mode wkode-single-new-bikes-template-block__normal-direction">
                                <div class="wkode-single-new-bikes-template-block__wrapper" >
                                    <div class="wkode-single-new-bikes-template-block__content">
                                        <h2 class="wkode-single-new-bikes-template-block__title--main <?php echo $slides_main_title; ?>"><?php echo $slides_main_title; ?></h2>
                                        <div class="wkode-single-new-bikes-template-block__title-wrapper">
                                            <?php
                                            foreach($slides_repeater as $i => $slide){
                                                $slide_real            = $slide['wkode_new_motorcycles_standart_descriptive_block_repeater'];
                                                $slide_title           = $slide_real['wkode_main_block_title'];
                                                $active_title = ($i == 0) ? 'active-title' : '';
                                                ?>
                                                    <h3 class="wkode-single-new-bikes-template-block__title <?php echo $active_title; ?>"><?php echo $slide_title; ?></h3>
                                                <?php 
                                            }?>
                                        </div>
                                        <?php
                                        foreach($slides_repeater as $i => $slide){
                                            $slide_real            = $slide['wkode_new_motorcycles_standart_descriptive_block_repeater'];
                                            $slide_description     = $slide_real['wkode_main_block_description'];
                                            $active_description = ($i == 0) ? 'active-description' : ''; ?>
                                                <div class="wkode-single-new-bikes-template-block__text <?php echo $active_description; ?>"><?php echo $slide_description; ?></div>
                                            <?php 
                                        }?>
                                    </div>
                                    <div class="wkode-single-new-bikes-template-block__image ">
                                        <?php
                                        foreach($slides_repeater as $i => $slide){
                                            $slide_real            = $slide['wkode_new_motorcycles_standart_descriptive_block_repeater'];
                                            $slide_image           = $slide_real['wkode_main_block_img'];
                                            $active_image = ($i == 0) ? 'active-image' : '';
                                             ?>
                                                <img class="wkode-single-new-bikes-template-block__img <?php echo $active_image; ?>" src="<?php echo !empty($slide_image['sizes']['wkode_single_new_slide_bg']) ? $slide_image['sizes']['wkode_single_new_slide_bg'] : get_theme_file_uri('./assets/img/standart_image.png'); ?>" alt="" srcset="">
                                               
                                            <?php 
                                        }?>
                                    </div>
                                </div>
                            </section>
                        <?php endif ?>

                    </section>
                    
                    <section class="wkode-new-bikes-single__gallery">
                        
                        <?php
                        $gallery              = get_field('wkode_new_motorcycles_gallery');
                        if($gallery){ ?>
                            <div class="wkode-new-bikes-single__gallery-outer-wrapper grid grid-cols-1 md:grid-cols-12">
                                <?php foreach ($gallery as $i => $image):

                                    $current_class = "";
                                    $image_url = "";
                                    if($i == 0 || $i == 1 || $i == 3 || $i == 4 || $i == 6){
                                        $current_class = "col-span-1 md:col-span-2";
                                        $image_url = wp_get_attachment_image_src($image['ID'], 'wkode_new_bikes_single__gallery_two_cols');
                                    }else if($i == 2){
                                        $current_class = "col-span-1 md:col-span-6";
                                        $image_url = wp_get_attachment_image_src($image['ID'], 'wkode_new_bikes_single__gallery_six_cols');
                                    }else if($i == 5 || $i == 7){
                                        $current_class = "col-span-1 md:col-span-4";
                                        $image_url = wp_get_attachment_image_src($image['ID'], 'wkode_new_bikes_single__gallery_four_cols');
                                    }if (wp_is_mobile()) { // Retrieve screen width from cookie
                                        $current_class_second = " col-span-1";
                                        $image_url = wp_get_attachment_image_src($image['ID'], 'wkode_new_bikes_single__gallery_one_by_one');
                                    }
                                    $image_alt = get_post_meta($image['ID'], '_wp_attachment_image_alt', true);
                                    ?>
                                    <div class="<?php echo $current_class . $current_class_second ?> wkode-new-bikes-single__gallery-wrapper">
                                        <a href="<?php echo esc_url($image['url']); ?>" class="gallery-image wkode-new-bikes-single__gallery-link" data-fancybox="gallery">
                                            <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="wkode-new-bikes-single__gallery-img">
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php } ?>
                    </section>

                    <section class="wkode-new-bikes-single__accordion" style="background-image: url( <?php if (has_post_thumbnail()) { echo get_the_post_thumbnail_url($post->ID, 'wkode_single_new_bikes'); } ?>)">
                        <section class="wkode-new-bikes-single__accordion-wrapper">
                            <?php
                            $accordion = get_field('wkode_new_motorcycles_accordion');
                            if ($accordion) {
                                ?>
                                <div class="accordion">
                                    <h2 class="wkode-new-bikes-single__accordion-title">Especificações</h2>
                                    <?php foreach ($accordion as $x => $accordion_item) : ?>
                                        <div class="accordion-item <?php if($x == 0){echo ' active ';} ?>">
                                            <h3 class="accordion-title">
                                                <?php echo $accordion_item['wkode_new_motorcycles_accordion_title']; ?>
                                                <span class="accordion-arrow">
                                                <img src="<?php echo get_theme_file_uri('/assets/img/svg/accordion-arrow.svg'); ?>" alt="" class="wkode-new-bikes-single__accordion-arrow">
                                                </span>
                                            </h3>
                                            <div class="accordion-content">
                                                <?php foreach ($accordion_item['wkode_new_motorcycles_accordion_repeater'] as $y => $inner_item) : ?>
                                                <div class="accordion-inner-item">
                                                    <h4 class="accordion-inner-title"><?php echo $inner_item['wkode_new_motorcycles_accordion_inner_title']; ?></h4>
                                                    <div class="accordion-inner-text"><?php echo $inner_item['wkode_new_motorcycles_accordion_inner_text']; ?></div>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php } ?>
                        </section>
                    </section>

                    <div class="wkode-single-new-bikes-template__content entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>
               

            </article>
        <?php endwhile; ?>

    </main>
</div>

<?php get_footer(); ?>