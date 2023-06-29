<?php get_header(); ?>

<section id="primary" class="wkode-archive content-area py-60">
    <h1 class="page-title text-left font-rubik text-white text-6xl font-semibold uppercase mb-36 container">
        Motos novas
    </h1>
    <main id="main" class="wkode-archive__main site-main mb-60" role="main">

        <?php if (have_posts()) : ?>
            
            <div class="filter bg-white h-24 text-black text-3xl">Filter</div>

            <div class="wkode-archive__grid">

                <?php while (have_posts()) : the_post(); 
                    get_template_part('./template-parts/cards/used-bikes');
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
    <h3 class="text-center font-rubik text-white text-5xl font-semibold uppercase mb-36">ACESSÓRIOS</h3>
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
    <div class="btn flex justify-center mt-36">
        <a href="" class="wkode-btn wkode-btn--solid-red m-auto">Ver Todos</a>
    </div>
</section>

<?php get_footer(); ?>