<?php 

$standart_posts = new WP_Query([
    'post_type' => 'motos-novas',
    'orderby' => 'title',
    'order' => 'ASC',
    'posts_per_page' => 36,
]);

?>


<section class="wkode-new-bikes__section">
        <h2 class="wkode-new-bikes__title title ">Modelos em destaque</h2>
        <div class="wkode-new-bikes__category category-filter-container-wrapper ">
            <div class="category-filter">
                <div class="category category--current">Todas</div>
                <div class="category">Street</div>
                <div class="category">Adventure</div>
                <div class="category">Off Road</div>
                <div class="category">Sport</div>
                <div class="category">Touring</div>
            </div>
            <div class="wkode-new-bikes__carousel">
            <?php 
            while($standart_posts->have_posts()){
                $standart_posts->the_post();
                
                 // Get the value of the custom field for the current post
                $custom_field_value = get_field('wkode_motorcycles_post_colors', get_the_ID());
                    ?>
                        <div class="wkode-new-bikes__card ">
                            <h3 class="wkode-new-bikes__card-title ">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo wp_trim_words( the_title() , 15); ?>
                                </a>
                            </h3>
                            <a href="<?php the_permalink(); ?>">
                                <!-- <img class="wkode-new-bikes__card-img active-color-image" src="<?php if(has_post_thumbnail()){ the_post_thumbnail_url('full'); } else {/*  echo get_theme_file_uri('/images/standard.png'); */ }  ?>" alt="" srcset=""> -->
                                <?php
                                foreach ($custom_field_value as $index => $field) {
                                    $postImg = $field['wkode_motorcycles_post_img'];
                                    if($index == 0){ ?>
                                        <img class="wkode-new-bikes__card-img active-color-image" src="<?php if(has_post_thumbnail()){ the_post_thumbnail_url('full'); } else {/*  echo get_theme_file_uri('/images/standard.png'); */ }  ?>" alt="" srcset=""> <?php
                                    }else{  ?>
                                        <img class="wkode-new-bikes__card-img" src="<?php echo $postImg; ?>" alt="" srcset=""> <?php
                                    }
                                
                                }
                                ?>
                            </a>
                            <div class="wkode-new-bikes__card-colors text-black">
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
                <?php
            } ?>
            </div>

        </div>
        <div class="btn"></div>
    </section>