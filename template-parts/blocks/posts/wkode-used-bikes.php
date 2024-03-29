<?php 

require_once get_template_directory() . '/inc/format_prices.php';
$posts = get_field( 'used_bikes_posts' );
$final_posts = false;

$standart_posts = new WP_Query([
    'post_type' => 'motos-seminovas',
    'orderby' => 'date',
    'order' => 'ASC',
    'posts_per_page' => 7,
]);

if($posts){
    if(count($posts) > 6){
        $final_posts = true;
    }
}else{
    $final_posts = false;
}

if( isset( $block['data']['preview'] )  ) {    /* rendering in inserter preview  */ ?>

	<img src="<?php echo get_theme_file_uri('template-parts/blocks/preview/wkode-used-bikes-block.png'); ?>" style="width:100%; height:auto;">

<?php
}else{ ?>


<section class="wkode-used-bikes__section">
        <h2 class="wkode-used-bikes__title title ">Seminovos em destaque</h2>
        
        <!-- <div class="wkode-used-bikes__category category-filter-container-wrapper grid grid-cols-3 gap-24 container"> -->
        <div class="wkode-used-bikes__category category-filter-container-wrapper wkode-used-bikes__slider   px-12 md:container">
        
        <?php 
            if($final_posts){
                foreach ($posts as $post) {
                    setup_postdata($post);
                    $table = get_field('wkode_single_used_table', $post->ID);
                    $year = '';
                    $km = '';
                    if($table){
                        $year = $table['wkode_single_used_table_year'];
                        $km = $table['wkode_single_used_table_km'];
                    }
                    $price = get_field('wkode_single_used_price', $post->ID);?>
                    <div class="wkode-used-bikes__card mx-2">
                        
                        <a class="wkode-used-bikes__card-link" href="<?php echo get_permalink($post->ID); ?>">
                            <img class="wkode-used-bikes__card-img" src="<?php echo has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID, 'motos_seminovas_card') : get_theme_file_uri('/images/standard.png');  ?>" alt="" srcset=""> 
                        </a>
                        <div class="wkode-used-bikes__card-body">
                            <h3 class="wkode-used-bikes__card-title ">
                                <a href="<?php echo get_permalink($post->ID); ?>">
                                    <?php echo wp_trim_words( get_the_title($post->ID) , 15); ?>
                                </a>
                            </h3>
                            <div class="wkode-used-bikes__card-info">
                                <div class="wkode-used-bikes__card-info-date">
                                    <img class="wkode-used-bikes__card-img" src="<?php echo get_theme_file_uri('./assets/img/svg/calendar-used.svg'); ?>" alt="" srcset=""> 
                                    <?php 
                                    if($year){
                                        echo $year; 
                                    }else{
                                        echo "23/23";
                                    }?>
                                </div>
                                <div class="wkode-used-bikes__card-info-km">
                                    <img class="wkode-used-bikes__card-img" src="<?php echo get_theme_file_uri('./assets/img/svg/km.svg'); ?>" alt="" srcset=""> 
                                    <?php
                                    if($km){
                                        echo $km; 
                                    }else{
                                        echo "1000";
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="wkode-used-bikes__card-footer">
                            <div class="wkode-used-bikes__card-footer-price">
                                <?php
                                if($price){
                                    echo 'R$ '. format_price($price);
                                }else{
                                    echo "consulte";
                                }
                                ?>
                            </div>
                            <div class="wkode-used-bikes__card-footer-btn"><a href="<?php echo get_permalink($post->ID); ?>" class="wkode-btn wkode-btn--outline-red">Ver Mais</a></div>
                        </div>
                    </div><?php 
                }
                wp_reset_postdata();
            }else{

                while($standart_posts->have_posts()){
                    $standart_posts->the_post();

                    get_template_part('./template-parts/cards/used-bikes');
                } wp_reset_postdata();
            }?>
        </div>
        
    </section>

<?php 
} ?>    