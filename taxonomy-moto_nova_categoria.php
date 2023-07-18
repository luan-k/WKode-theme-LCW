<?php get_header(); ?>

<section id="primary" class="wkode-archive content-area py-60 wkode-new-bikes">
    <h1 class="page-title text-left font-rubik text-white text-6xl font-semibold uppercase mb-36 container">
        <?php
        // Get the current term slug for the 'moto_nova_categoria' taxonomy
        $term_slug = get_query_var('term');

        // Get the term object using the term slug and taxonomy
        $term = get_term_by('slug', $term_slug, 'moto_nova_categoria');

        // Check if the term exists and display the taxonomy name
        if ($term && !is_wp_error($term)) {
            // Display the taxonomy name
            echo $term->name;
        }
        ?>
    </h1>
    <main id="main" class="wkode-archive__main site-main mb-60" role="main">

        <?php if (have_posts()) : ?>

            <div class="wkode-archive__grid">

                <?php while (have_posts()) : the_post();
                    get_template_part('./template-parts/cards/new-bikes');
                endwhile; ?>
            </div>

        <?php else : ?>
            <h2 class='md:col-span-3 text-center  mt-20 md:mt-20 text-4xl font-rubik font-semibold text-white mb-9'>Não existe nenhum produto com essas características</h2>
        <?php endif; ?>

    </main>

</section>

<?php get_footer(); ?>