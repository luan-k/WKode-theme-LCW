<?php get_header(); ?>

<div id="primary" class="wkode-single-page-template content-area">
    <main id="main" class="wkode-single-page-template__main site-main" role="main">

        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('wkode-single-page-template__article'); ?>>

                <div class="wkode-single-page-template__body py-60">
                    <header class="container mb-28">
                        <h1 class="text-6xl font-rubik font-extrabold text-left uppercase"><?php the_title(); ?></h1>
                    </header>
                    <div class="wkode-single-page-template__content entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>
                <?php get_template_part('./template-parts/maps'); ?>
               

            </article>
        <?php endwhile; ?>

    </main>
</div>

<?php get_footer(); ?>