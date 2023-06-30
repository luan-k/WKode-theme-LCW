<?php get_header(); 

$images = get_field('wkode_single_services_imgs', get_the_ID());

?>

<div id="primary" class="wkode-single-used-bikes-template wkode-single-services content-area">
    <main id="main" class="wkode-single-used-bikes-template__main site-main" role="main">

        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('wkode-single-used-bikes-template__article'); ?>>

                <div class="wkode-single-used-bikes-template__wrapper">
                    <h1 class="wkode-single-used-bikes-template__title "><?php the_title(); ?></h1>
                    <div class="wkode-single-used-bikes-template__image featured-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'wkode_single_product_bikes'); ?>
                            <!-- <div class="f-carousel" id="myServicesCarousel">
                                <div class="f-carousel__slide" data-thumb-src="<?php echo $thumbnail_url; ?>" data-fancybox="galleryServices">
                                    <img class="wkode-single-used-bikes__img" data-lazy-src="<?php echo $thumbnail_url; ?>" />
                                </div> -->
                            <div class="f-carousel" id="myServicesCarousel">
                                <a class="f-carousel__slide" data-thumb-src="<?php echo $thumbnail_url; ?>" data-fancybox="galleryServices" href="<?php echo $thumbnail_url; ?>">
                                    <img class="wkode-single-used-bikes__img" data-lazy-src="<?php echo $thumbnail_url; ?>" src="<?php echo $thumbnail_url; ?>" />
                                </a>
                                <?php
                                if($images) : 
                                    foreach ($images as $image) : ?>
                                        <?php $image_url = $image['url']; ?>
                                        <a class="f-carousel__slide" data-thumb-src="<?php echo $image_url; ?>" data-fancybox="galleryServices" href="<?php echo $image_url; ?>">
                                            <img class="wkode-single-used-bikes__img" data-lazy-src="<?php echo $image_url; ?>" src="<?php echo $image_url; ?>" />
                                        </a>
                                    <?php 
                                    endforeach; 
                                endif;
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="wkode-single-used-bikes-template__body">
                    <h4 class="wkode-single-used-bikes-template__description-title">
                        Descrição
                    </h4>
                    <div class="wkode-single-used-bikes-template__content entry-content">
                        <?php the_content(); ?>
                    </div>

                </div>

                
            </article>

               
        <?php endwhile; ?>

    </main>
</div>

<?php get_footer(); ?>