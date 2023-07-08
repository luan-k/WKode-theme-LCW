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

$brandsValue = $filterData['brandsResult'];
$modelsValue = $filterData['modelsResult'];
$countArgs = $filterData['countArgs'];
$bikesArgs = $filterData['bikesArgs'];

$categories = get_terms(array(
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
));
$models = get_terms(array(
    'taxonomy' => $taxonomyModelos,
    'hide_empty' => false,
));


$bikes = new WP_Query($bikesArgs);
$count = new WP_Query($countArgs);
var_dump($count);

?>

<section id="primary" class="wkode-archive wkode-archive--seminovas content-area py-60">
    <h1 class="page-title text-left font-rubik text-white text-6xl font-semibold uppercase mb-0 lg:mb-36 container">
        Motos novas
    </h1>
    <main id="main" class="wkode-archive__main site-main mb-60" role="main">

        <div class="filter filter-desktop bg-white text-black text-3xl" id="cats-wrapper">
            <h3 class="wkode-archive__filter-title">
                Filtros
                <?php
                if(wp_is_mobile()){ ?>
                    <span class="close-mobile-filters">x</span>
                <?php } ?>
            </h3>
           <!--  <div class="taxonomies-list_item remove-filters">Remover filtros</div> -->
            <div class="wrapper-cat-list">
                <h4 class="title-taxonomy">
                    Marcas
                    <img class="title-taxonomy-arrow" src="<?php echo get_theme_file_uri('./assets/img/svg/filters-arrow.svg'); ?>" alt="" srcset=""> 
                </h4>
                <ul class="cat-list">
                    <?php foreach($categories as $category) : 
                        ?>
                        <li class="">
                            <input <?php
                            if($brandsValue){
                                foreach($brandsValue as $filter){
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
            </div>
            <div class="wrapper-cat-list">
                <h4 class="title-taxonomy">
                    Modelos
                    <img class="title-taxonomy-arrow" src="<?php echo get_theme_file_uri('./assets/img/svg/filters-arrow.svg'); ?>" alt="" srcset=""> 
                </h4>
                <ul class="cat-list mt-7 ">
                    <?php foreach($models as $category) : 
                        ?>
                        <li class="">
                            <input <?php
                            if($modelsValue){
                                foreach($modelsValue as $filter){
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
            <?php if(wp_is_mobile()){ ?>
			<h3 class="title-filters title-filters__footer-filters">
				<div class="btn__wrapper w-full px-7 m-auto col-span-12">
					<a href="#!" class="btn-input items-center justify-center wkode-btn wkode-btn--solid-red load-more w-full block text-center" id="">
						Filtrar Produtos
					</a>
				</div>
			</h3>
		    <?php } ?>
        </div>

        <?php
        if(wp_is_mobile()){ ?>
            <div class="btn__wrapper w-full px-7 m-auto my-36 col-span-12">
                <a href="#!" class="btn-input items-center justify-center wkode-btn wkode-btn--solid-red load-more w-full block text-center" id="open-filters">
                    filtros
                </a>
            </div>
        <?php }
        ?>

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

        <div class="btn flex justify-center mt-36 w-full md:w-2/4 m-auto col-span-12">
            <a style="<?php if($count->post_count < 36){ echo ' display: none; '; } ?> " href="#!" class="wkode-btn wkode-btn--solid-red text-center load-more-unique" id="load-more">Carregar Mais</a>
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