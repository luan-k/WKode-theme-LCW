<?php get_header(); ?>

<section id="primary" class="wkode-archive content-area">
    <main id="main" class="wkode-archive__main site-main py-60" role="main">

        <?php if (have_posts()) : ?>
            <!-- <header class="page-header">
                <h1 class="page-title">
                   Motos novas
                </h1>
            </header> -->
            <div class="filter bg-white h-24 text-black text-3xl">Filter</div>

            <div class="wkode-archive__grid">

                <?php while (have_posts()) : the_post(); 
                    get_template_part('./template-parts/cards/new-bikes');
                endwhile; ?>
            </div>

        <?php else : ?>
            <p><?php esc_html_e('No posts found.', 'text-domain'); ?></p>
        <?php endif; ?>

    </main>

    <?php
        $random_posts = new WP_Query([
            'post_type' => 'produtos',
            'orderby' => 'rand',
            'posts_per_page' => 12,
        ]);        
    ?>
    <div class="wkode-archive__related">
        <?php
            if ($random_posts->have_posts()) {
                while ($random_posts->have_posts()) {
                    $random_posts->the_post();
                    get_template_part('./template-parts/cards/products');
                }
            }
        ?>
    </div>
</section>

<!-- <?php get_sidebar(); ?> -->
<?php get_footer(); ?>