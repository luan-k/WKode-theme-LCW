<div class="wkode-products__card">
    <a href="<?php the_permalink(); ?>">
        <img class="wkode-products__card-img active-color-image" src="<?php if(has_post_thumbnail()){ the_post_thumbnail_url('products_card'); } else { echo get_theme_file_uri('./assets/img/default-product.png'); }  ?>" alt=" <?php echo wp_trim_words( the_title() , 15); ?> Featured Image" srcset=""> 
    </a>
    <h3 class="wkode-products__card-title ">
        <a href="<?php the_permalink(); ?>">
            <?php echo wp_trim_words( the_title() , 15); ?>
        </a>
    </h3>
</div>

