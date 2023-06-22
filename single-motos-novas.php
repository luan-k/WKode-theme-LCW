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
                    <div class="wkode-single-new-bikes-template__form">
                        <h2 class="wkode-single-new-bikes-template__form-title"><?php the_title(); ?></h2>
                        <?php echo do_shortcode( '[wpforms id="308" title="false"]' ); ?>
                    </div>
                </div>
                
                <div class="wkode-single-new-bikes-template__body">
                    <header class="wkode-single-new-bikes-template__title-header entry-header">
                        <h1 class="wkode-single-new-bikes-template__title entry-title"><?php the_title(); ?></h1>
                    </header>

                    <div class="wkode-single-new-bikes-template__content entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>
               

            </article>
        <?php endwhile; ?>

    </main>
</div>

<?php get_footer(); ?>