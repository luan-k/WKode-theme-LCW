<?php get_header();

$taxonomy = 'moto_nova_categoria';
$post_type = 'motos-novas';
$template_path = './template-parts/cards/new-bikes';
$bikes = [
    'post_type' => $post_type,
    'posts_per_page' => 36,
    'order_by' => 'date',
    'order' => 'desc',
    'paged' => 1
];

// Include the file containing the desired function
require_once 'filter/filter-front.php';

// Call the function from the included file
$filterData = filter_function($post_type, $taxonomy, $bikes);

$filterValue = $filterData['filterResult'];
$countArgs = $filterData['countArgs'];
$bikesArgs = $filterData['bikesArgs'];

$categories = get_terms(array(
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
    'parent' => 0, // Retrieve only parent terms
    'number' => 7, // Limit the number of terms to 7
));

$bikes = new WP_Query($bikesArgs);
$count = new WP_Query($countArgs);

?>

<section id="primary" class="wkode-archive content-area py-60 wkode-new-bikes">
    <h1 class="page-title text-left font-rubik text-white text-6xl font-semibold uppercase mb-36 container">
        Motos novas
    </h1>
    <div class="cat-wrapper text-white text-3xl container my-12">
        
    </div>
    <main id="main" class="wkode-archive__main site-main mb-60" role="main">

        <div class="category-filter">
            <div class="category taxonomies-list_item remove-filters  <?php if(!$filterValue): echo 'category--current'; endif; ?>">Todas</div>
            <?php foreach($categories as $index => $category) : ?>
                <div data-slug="<?= $category->slug; ?>" class="category taxonomies-list_item <?php if($filterValue[0] == $category->slug): echo 'category--current'; endif; ?>">
                    <?= $category->name; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="wkode-archive__grid filter-tiles" id="filter-tiles" template-path="<?= $template_path ?>" post-type="<?= $post_type ?>" taxonomy="<?= $taxonomy ?>">
            <?php if ($bikes->have_posts()) : ?>

                <?php while ($bikes->have_posts()) : $bikes->the_post(); 
                    get_template_part($template_path);
                endwhile; ?>

            <?php else : ?>
                <h2 class='md:col-span-3 text-center  mt-20 md:mt-20 text-4xl font-rubik font-semibold text-white mb-9'>Não existe nenhum produto com essas características</h2>
                <h3 class='md:col-span-3 text-center  mt-20 md:mt-0 text-3xl font-rubik font-semibold text-white'>Por favor, selecione uma nova combinação de filtros acima</h3>
            <?php endif; ?>
        </div>
        <div class="btn flex justify-center mt-36 w-full md:w-2/4 m-auto">
            <a style="<?php if($count->post_count < 36){ echo ' display: none; '; } ?> " href="#!" class="wkode-btn wkode-btn--solid-red text-center" id="load-more">Carregar Mais</a>
        </div>

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
        <a href="<?php echo esc_url(site_url('/produtos')); ?>" class="wkode-btn wkode-btn--solid-red m-auto text-center">Ver Todos</a>
    </div>
</section>

<?php get_footer(); ?>