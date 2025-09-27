<?php 

$posts = get_field( 'new_bikes_posts' );
$final_posts = false;

$standart_posts = new WP_Query([
    'post_type' => 'motos-novas',
    'orderby' => 'date',
    'order' => 'ASC',
    'posts_per_page' => 9,
]);

require_once get_template_directory() . '/inc/format_prices.php';

if($posts){
    if(count($posts) > 6){
        $final_posts = true;
    }
}else{
    $final_posts = false;
}

if( isset( $block['data']['preview'] )  ) {    /* rendering in inserter preview  */ ?>

	<img src="<?php echo get_theme_file_uri('template-parts/blocks/preview/wkode-new-bikes-block.png'); ?>" style="width:100%; height:auto;">

<?php
}else{ ?>

<section class="wkode-new-bikes__section">
        <h2 class="wkode-new-bikes__title title ">Motos 0KM em destaque</h2>
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

$post_id = $post->ID;

$table = get_field('wkode_single_new_bikes_table', $post_id);
$year  = '';
$km    = '';
if (is_array($table)) {
    $year = isset($table['wkode_single_new_table_year']) ? (string)$table['wkode_single_new_table_year'] : '';
    $km   = isset($table['wkode_single_new_table_km'])   ? (string)$table['wkode_single_new_table_km']   : '';
}

$price = get_field('wkode_single_new_bikes_price', $post_id);
?>
<div class="wkode-used-bikes__card mx-2">

  <a class="wkode-used-bikes__card-link" href="<?php echo esc_url( get_permalink($post_id) ); ?>">
    <img
      class="wkode-used-bikes__card-img"
      src="<?php
        if ( has_post_thumbnail($post_id) ) {
          echo esc_url( get_the_post_thumbnail_url($post_id, 'motos_seminovas_card') );
        } else {
          echo esc_url( get_theme_file_uri('./assets/img/standart-used.png') );
        }
      ?>"
      alt="<?php echo esc_attr( get_the_title($post_id) ); ?>">
  </a>

  <div class="wkode-used-bikes__card-body">
    <h3 class="wkode-used-bikes__card-title">
      <a href="<?php echo esc_url( get_permalink($post_id) ); ?>">
        <?php echo esc_html( wp_trim_words( get_the_title($post_id), 15 ) ); ?>
      </a>
    </h3>

    <div class="wkode-used-bikes__card-info">
      <div class="wkode-used-bikes__card-info-date">
        <img class="wkode-used-bikes__card-img" src="<?php echo esc_url( get_theme_file_uri('./assets/img/svg/calendar-used.svg') ); ?>" alt="">
        <?php echo $year !== '' ? esc_html($year) : '23/23'; ?>
      </div>

      <div class="wkode-used-bikes__card-info-km">
        <img class="wkode-used-bikes__card-img" src="<?php echo esc_url( get_theme_file_uri('./assets/img/svg/km.svg') ); ?>" alt="">
        <?php echo $km !== '' ? esc_html($km) : '0'; ?>
      </div>
    </div>
  </div>

  <div class="wkode-used-bikes__card-footer">
    <div class="wkode-used-bikes__card-footer-price">
      <?php
      if ($price) {
        echo 'R$ ' . esc_html( format_price($price) );
      } else {
        echo 'consulte';
      }
      ?>
    </div>
    <div class="wkode-used-bikes__card-footer-btn">
      <a href="<?php echo esc_url( get_permalink($post_id) ); ?>" class="wkode-btn wkode-btn--outline-red">Ver Mais</a>
    </div>
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
            <a href="<?php echo esc_url(site_url('/motos-novas')); ?>" class="wkode-btn wkode-btn--outline-red m-auto">Ver Todos</a>
        </div>
    </section>

<?php 
} ?>
