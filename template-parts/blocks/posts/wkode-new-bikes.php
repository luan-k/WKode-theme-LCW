<?php 

$posts = get_field( 'new_bikes_posts' );
$final_posts;

$standart_posts = new WP_Query([
    'post_type' => 'motos-novas',
    'orderby' => 'date',
    'order' => 'ASC',
    'posts_per_page' => 9,
]);

if($posts){
    if(count($posts) > 6){
        $final_posts = 1;
    }
}else{
    $final_posts = 0;
}

?>


<section class="wkode-new-bikes__section">
        <h2 class="wkode-new-bikes__title title ">Modelos em destaque</h2>
        <div class="wkode-new-bikes__category category-filter-container-wrapper ">
            <?php
            //sorry... no time
            //<div class="category-filter">
            //    <div class="category category--current">Todas</div>
            //    <div class="category">Street</div>
            //    <div class="category">Adventure</div>
            //    <div class="category">Off Road</div>
            //    <div class="category">Sport</div>
            //    <div class="category">Touring</div>
            //</div>
            ?>
            <div class="wkode-new-bikes__carousel">
                <div class="carousel-container">
                    <div class="carousel-wrapper">
                        <div class="carousel trial-slider">
                            <?php 
                            if($final_posts){
                                foreach ($posts as $post) {
                                    setup_postdata($post);
                                    ?>
                                    <div class="wkode-new-bikes__card carousel-image">
                                        <h3 class="wkode-new-bikes__card-title ">
                                            <a href="<?php echo get_permalink($post->ID); ?>">
                                                <?php echo wp_trim_words(get_the_title($post->ID), 15); ?>
                                            </a>
                                        </h3>
                                        <a href="<?php echo get_permalink($post->ID); ?>">
                                            <?php
                                            $custom_field_value = get_field('wkode_motorcycles_post_colors', $post->ID);
                                            if ($custom_field_value) {
                                                foreach ($custom_field_value as $index => $field) {
                                                    $postImg = $field['wkode_motorcycles_post_img'];
                                                    if ($index == 0) {
                                                        ?>
                                                        <img class="wkode-new-bikes__card-img active-color-image" src="<?php echo has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID, 'full') : get_theme_file_uri('/images/standard.png'); ?>" alt="" srcset="">
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <img class="wkode-new-bikes__card-img" src="<?php echo $postImg; ?>" alt="" srcset="">
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </a>
                                        <div class="wkode-new-bikes__card-colors text-black">
                                            <?php
                                            if ($custom_field_value) {
                                                foreach ($custom_field_value as $index => $field) {
                                                    $postColor = $field['wkode_motorcycles_post_color'];
                                                    $biOrTri = $field['wkode_motorcycles_bicolor_ou_tricolor'];
                                                    $secondColor = $field['wkode_motorcycles_post_color_two'];
                                                    $thirdColor = $field['wkode_motorcycles_post_color_three'];
            
                                                    if ($biOrTri == 'bicolor') {
                                                        $biOrTriClass = "wkode-new-bikes__card-color--bicolor";
                                                    } elseif ($biOrTri == 'tricolor') {
                                                        $biOrTriClass = "wkode-new-bikes__card-color--tricolor";
                                                    } else {
                                                        $biOrTriClass = "wkode-new-bikes__card-color--unique";
                                                    }
                                                    if ($index == 0) {
                                                        $active_color = "active-color";
                                                    } else {
                                                        $active_color = "";
                                                    }
                                                    ?>
                                                    <span class="wkode-new-bikes__card-color <?php echo $active_color ?>">
                                                        <span class="<?php echo $biOrTriClass ?>" style="background-color: <?php echo $postColor; ?>"></span>
                                                        <?php
                                                        if ($biOrTri == 'bicolor') {
                                                            ?>
                                                            <span class="<?php echo $biOrTriClass ?>" style="background-color: <?php echo $secondColor; ?>"></span>
                                                            <?php
                                                        }
                                                        if ($biOrTri == 'tricolor') {
                                                            ?>
                                                            <span class="<?php echo $biOrTriClass ?>" style="background-color: <?php echo $secondColor; ?>"></span>
                                                            <span class="<?php echo $biOrTriClass ?>" style="background-color: <?php echo $thirdColor; ?>"></span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </span>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                wp_reset_postdata();
                            }else{
                                while($standart_posts->have_posts()){
                                    $standart_posts->the_post();
                                    
                                    get_template_part('./template-parts/cards/new-bikes');
                                    
                                } wp_reset_postdata();
                            }?>
                        </div>
                    </div>
                    
                    <!-- <button class="arrow-button left-arrow" style="background-image: url(<?php //echo get_theme_file_uri('assets/img/svg/new-carrousel-left.svg'); ?>);"></button>
                    <button class="arrow-button right-arrow" style="background-image: url(<?php //echo get_theme_file_uri('assets/img/svg/new-carrousel-right.svg'); ?>);"></button> -->
                </div>
                <!-- <div class="trial-slider">
                    <?php
                        // while($standart_posts->have_posts()){
                        //    $standart_posts->the_post();
                        //    
                        //    get_template_part('./template-parts/cards/new-bikes');
                        //    
                        //} wp_reset_postdata();
                    ?>
                </div> -->
            </div>

        </div>
        <div class="btn flex justify-center mt-36">
            <a href="" class="wkode-btn wkode-btn--outline-red m-auto">Ver Todos</a>
        </div>
    </section>