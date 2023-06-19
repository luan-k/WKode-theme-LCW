<?php get_header(); ?>

<div id="primary" class="wkode-single-page-template content-area">
    <main id="main" class="wkode-single-page-template__main site-main" role="main">

        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('wkode-single-page-template__article'); ?>>

                <div class="wkode-single-page-template__image featured-image">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('single_page_featured_image'); ?>
                    <?php endif; ?>
                </div>

                <div class="wkode-single-page-template__body">
                    <header class="wkode-single-page-template__title-header entry-header">
                        <h1 class="wkode-single-page-template__title entry-title"><?php the_title(); ?></h1>
                    </header>

                    <div class="wkode-single-page-template__content entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>
               

            </article>
        <?php endwhile; ?>

    </main>
</div>

<?php get_footer(); ?>