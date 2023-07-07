<?php get_header(); 

require_once 'filter/multiple-filter-front.php';

$taxonomy = 'moto_seminova_categoria';
$taxonomyModelos = 'moto_seminova_modelo';
$post_type = 'motos-seminovas';
$template_path = './template-parts/cards/used-bikes';
$bikes = [
    'post_type' => $post_type,
    'posts_per_page' => 36,
    'order_by' => 'date',
    'order' => 'desc',
    'paged' => 1
];

// get all of the taxonomies with this
/* ==================================== */
$taxonomies = get_object_taxonomies($post_type);

// Loop through the taxonomies
foreach ($taxonomies as $haha) {
    echo $haha . '<br>';
}
/* =================================== */

// Call the function from the included file
$filterData = multiple_filter_function($post_type, $taxonomy, $bikes);

$filterValue = $filterData['filterResult'];
$countArgs = $filterData['countArgs'];
$bikesArgs = $filterData['bikesArgs'];

var_dump($filterValue);

$categories = get_terms(array(
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
));
$models = get_terms(array(
    'taxonomy' => $taxonomyModelos,
    'hide_empty' => false,
));



$wow = array($taxonomy, $taxonomyModelos);

var_dump($wow);

echo "<br>";
echo gettype($taxonomy);
echo "<br>";
echo gettype($wow);


$bikes = new WP_Query($bikesArgs);
$count = new WP_Query($countArgs);

?>

<section id="primary" class="wkode-archive content-area py-60">
    <h1 class="page-title text-left font-rubik text-white text-6xl font-semibold uppercase mb-36 container">
        Motos novas
    </h1>
    <main id="main" class="wkode-archive__main site-main mb-60" role="main">

        <div class="filter bg-white text-black text-3xl">
            <div class="taxonomies-list_item remove-filters">Remover filtros</div>
            <ul class="cat-list">
                <?php foreach($categories as $category) : 
                    ?>
                    <li class="">
                        <input <?php
                         if($filterValue){
                            foreach($filterValue as $filter){
                                if($filter == $category->slug){
                                    echo 'checked';
                                }
                            }
                        }
                        ?> class='taxonomies-list_item taxonomies-list_item--brand' data-slug="<?= $category->slug; ?>" type='checkbox' value='<?php $category->slug ?>' id='<?php echo $category->term_taxonomy_id ?>' name='<?php echo $category->name; ?>'>
                        <label for="<?php echo $category->term_taxonomy_id ?>">
                            <?= $category->name; ?>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
            <ul class="cat-list mt-7 ">
                <?php foreach($models as $category) : 
                    ?>
                    <li class="">
                        <input <?php
                         if($filterValue){
                            foreach($filterValue as $filter){
                                if($filter == $category->slug){
                                    echo 'checked';
                                }
                            }
                        }
                        ?> class='taxonomies-list_item taxonomies-list_item--models' data-slug="<?= $category->slug; ?>" type='checkbox' value='<?php $category->slug ?>' id='<?php echo $category->term_taxonomy_id ?>' name='<?php echo $category->name; ?>'>
                        <label for="<?php echo $category->term_taxonomy_id ?>">
                            <?= $category->name; ?>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="wkode-archive__grid filter-multiple-tiles" id="multiple-filter-tiles" template-path="<?= $template_path ?>" post-type="<?= $post_type ?>" taxonomy="<?= $taxonomy ?>">
            <?php if ($bikes->have_posts()) : ?>

                <?php while ($bikes->have_posts()) : $bikes->the_post(); 
                    get_template_part($template_path);
                endwhile; ?>

            <?php else : ?>
                <h2 class='md:col-span-3 text-center  mt-20 md:mt-20 text-4xl font-rubik font-semibold text-white mb-9'>Não existe nenhum produto com essas características</h2>
                <h3 class='md:col-span-3 text-center  mt-20 md:mt-0 text-3xl font-rubik font-semibold text-white'>Por favor, selecione uma nova combinação de filtros acima</h3>
            <?php endif; ?>
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
    <div class="btn flex justify-center mt-36">
        <a href="" class="wkode-btn wkode-btn--solid-red m-auto">Ver Todos</a>
    </div>
</section>

<?php get_footer(); ?>