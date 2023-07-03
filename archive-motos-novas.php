<?php get_header();
$categories = get_terms(array(
    'taxonomy' => 'moto_nova_categoria',
    'hide_empty' => false,
    'parent' => 0, // Retrieve only parent terms
    'number' => 7, // Limit the number of terms to 7
));

$bikes = new WP_Query([
    'post_type' => 'motos-novas',
    'posts_per_page' => -1,
    'order_by' => 'date',
    'order' => 'desc',
  ]);

?>

<section id="primary" class="wkode-archive content-area py-60 wkode-new-bikes">
    <h1 class="page-title text-left font-rubik text-white text-6xl font-semibold uppercase mb-36 container">
        Motos novas
    </h1>
    <div class="cat-wrapper text-white text-3xl container my-12">
        
    </div>
    <main id="main" class="wkode-archive__main site-main mb-60" role="main">

        <?php if ($bikes->have_posts()) : ?>
            <div class="category-filter">
                <div class="category cat-list_item category--current remove-filters">Todas</div>
                <?php foreach($categories as $index => $category) : ?>
                    <div data-slug="<?= $category->slug; ?>" class="category cat-list_item">
                        <?= $category->name; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="wkode-archive__grid project-tiles">

                <?php while ($bikes->have_posts()) : $bikes->the_post(); 
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
    <div class="btn flex justify-center mt-36 w-full md:w-2/4 m-auto">
        <a href="" class="wkode-btn wkode-btn--solid-red m-auto text-center">Ver Todos</a>
    </div>
</section>

<?php get_footer(); ?>