<?php 
$posts = get_field( 'products_posts' );
$final_posts = false;

$standart_posts = new WP_Query([
    'post_type' => 'produtos',
    'orderby' => 'date',
    'order' => 'ASC',
    'posts_per_page' => 8,
]);

if($posts){
    if(count($posts) == 8){
        $final_posts = true;
    }
}else{
    $final_posts = false;
}

?>


<section class="wkode-products bg-lcw-primary-blue py-48">
    <h2 class="wkode-new-bikes__title title ">Produtos</h2>
    <div class="wkode-products-wrapper container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  xl:grid-cols-4 gap-7">
        
        <?php 
            if($final_posts){
                foreach ($posts as $post) {
                    setup_postdata($post);
                     ?>
                     <div class="wkode-products__card">
                        <a href="<?php echo get_permalink($post->ID); ?>">
                            <img class="wkode-products__card-img active-color-image" src="<?php echo has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID, 'products_card') : get_theme_file_uri('/images/default-product.png');  ?>" alt="" srcset=""> 
                        </a>
                        <h3 class="wkode-products__card-title ">
                            <a href="<?php echo get_permalink($post->ID); ?>">
                                <?php echo wp_trim_words( get_the_title($post->ID) , 15); ?>
                            </a>
                        </h3>
                    </div>
                    <?php 
                }
                wp_reset_postdata();
            }else{

                while($standart_posts->have_posts()){
                    $standart_posts->the_post();

                    get_template_part('./template-parts/cards/products');
                } wp_reset_postdata();
            }?>
        </div>
    <div class="btn flex justify-center mt-36">
        <a href="" class="wkode-btn wkode-btn--outline-red m-auto text-center">Ver Todos</a>
    </div>
</section>