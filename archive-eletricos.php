<?php get_header(); ?>

<section id="primary" class="wkode-archive content-area py-60 wkode-archive--electrics">
    <h1 class="page-title text-left font-rubik text-white text-6xl font-semibold uppercase mb-36 container">
        Elétricos
    </h1>
    <main id="main" class="wkode-archive__main site-main mb-60" role="main">

        <?php if (have_posts()) : ?>

            <div class="wkode-archive__grid">

                <?php while (have_posts()) : the_post(); 
                    get_template_part('./template-parts/cards/products');
                endwhile; ?>
            </div>

        <?php else : ?>
            <p><?php esc_html_e('No posts found.', 'text-domain'); ?></p>
        <?php endif; ?>

    </main>

    
</section>

<?php get_footer(); ?>