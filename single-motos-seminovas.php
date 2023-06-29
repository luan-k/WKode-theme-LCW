<?php get_header(); 

$table = get_field('wkode_single_used_table', get_the_ID());
$price = get_field('wkode_single_used_price', get_the_ID());
$images = get_field('wkode_single_used_imgs', get_the_ID());

?>

<div id="primary" class="wkode-single-used-bikes-template content-area">
    <main id="main" class="wkode-single-used-bikes-template__main site-main" role="main">

        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('wkode-single-used-bikes-template__article'); ?>>

                <div class="wkode-single-used-bikes-template__wrapper">
                    <h1 class="wkode-single-used-bikes-template__title wkode-single-used-bikes-template__title--mobile"><?php the_title(); ?></h1>
                    <div class="wkode-single-used-bikes-template__image featured-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'wkode_single_used_bikes'); ?>
                            <div class="f-carousel" id="myCarousel">
                                <div class="f-carousel__slide" data-thumb-src="<?php echo $thumbnail_url; ?>">
                                    <img class="wkode-single-used-bikes__img" data-lazy-src="<?php echo $thumbnail_url; ?>" />
                                </div>
                                <?php
                                if($images) : 
                                    foreach ($images as $image) : ?>
                                        <?php $image_url = $image['url']; ?>
                                        <div class="f-carousel__slide" data-thumb-src="<?php echo $image_url; ?>">
                                            <img class="wkode-single-used-bikes__img" data-lazy-src="<?php echo $image_url; ?>" />
                                        </div>
                                    <?php 
                                    endforeach; 
                                endif;
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="wkode-single-used-bikes-template__entry-content">
                        <h1 class="wkode-single-used-bikes-template__title wkode-single-used-bikes-template__title--desktop"><?php the_title(); ?></h1>

                        <div class="table-container">
                            <?php
                            if ($table) {
                                $cellClass = 'table-cell';
                                $titleCellClass = $cellClass . ' table-cell--title';
                                $contentCellClass = $cellClass . ' table-cell--content';
                                ?>
                                <div class="table-row table-row--dark">
                                    <div class="<?php echo $titleCellClass; ?>">Estado:</div>
                                    <div class="<?php echo $contentCellClass; ?>"><?php echo !empty($table['wkode_single_used_table_state']) ? $table['wkode_single_used_table_state'] : ''; ?></div>
                                </div>
                                <div class="table-row">
                                    <div class="<?php echo $titleCellClass; ?>">Ano:</div>
                                    <div class="<?php echo $contentCellClass; ?>"><?php echo !empty($table['wkode_single_used_table_year']) ? $table['wkode_single_used_table_year'] : ''; ?></div>
                                </div>
                                <div class="table-row table-row--dark">
                                    <div class="<?php echo $titleCellClass; ?>">Quilometragem:</div>
                                    <div class="<?php echo $contentCellClass; ?>"><?php echo !empty($table['wkode_single_used_table_km']) ? $table['wkode_single_used_table_km'] : ''; ?></div>
                                </div>
                                <div class="table-row">
                                    <div class="<?php echo $titleCellClass; ?>">Place Final:</div>
                                    <div class="<?php echo $contentCellClass; ?>"><?php echo !empty($table['wkode_single_used_table_license']) ? $table['wkode_single_used_table_license'] : ''; ?></div>
                                </div>
                                <div class="table-row table-row--dark">
                                    <div class="<?php echo $titleCellClass; ?>">Combustível:</div>
                                    <div class="<?php echo $contentCellClass; ?>"><?php echo !empty($table['wkode_single_used_table_fuel']) ? $table['wkode_single_used_table_fuel'] : ''; ?></div>
                                </div>
                                <div class="table-row">
                                    <div class="<?php echo $titleCellClass; ?>">Câmbio:</div>
                                    <div class="<?php echo $contentCellClass; ?>"><?php echo !empty($table['wkode_single_used_table_transmission']) ? $table['wkode_single_used_table_transmission'] : ''; ?></div>
                                </div>
                                <div class="table-row table-row--dark">
                                    <div class="<?php echo $titleCellClass; ?>">Cor:</div>
                                    <div class="<?php echo $contentCellClass; ?>"><?php echo !empty($table['wkode_single_used_table_color']) ? $table['wkode_single_used_table_color'] : ''; ?></div>
                                </div>
                                <?php
                                $repeater_rows = $table['wkode_single_used_table_repeater'];
                                if ($repeater_rows) :
                                    foreach ($repeater_rows as $index => $row) :
                                        $title = !empty($row['wkode_single_used_table_repeater_group']['wkode_single_used_table_repeater_title']) ? $row['wkode_single_used_table_repeater_group']['wkode_single_used_table_repeater_title'] : '';
                                        $field = !empty($row['wkode_single_used_table_repeater_group']['wkode_single_used_table_repeater_field']) ? $row['wkode_single_used_table_repeater_group']['wkode_single_used_table_repeater_field'] : '';
                                        $rowClass = ($index % 2 === 1) ? 'table-row--dark' : '';
                                        ?>
                                        <div class="table-row <?php echo $rowClass; ?>">
                                            <div class="<?php echo $titleCellClass; ?>"><?php echo $title; ?></div>
                                            <div class="<?php echo $contentCellClass; ?>"><?php echo $field; ?></div>
                                        </div>
                                    <?php
                                    endforeach;
                                endif;
                            }
                            ?>
                        </div>

                        <div class="wkode-single-used-bikes-template__price">
                            <?php
                            if($price){ ?>
                                Por apenas
                                <h3>
                                    <?php
                                        echo $price;
                                    ?>
                                </h3>
                                à vista
                                <?php
                            }else{?>
                                <h3>
                                    CONSULTE
                                </h3>
                            <?php } ?>
                        </div>

                        <div class="wkode-single-used-bikes-template__btn">
                            <a href="" class="wkode-btn wkode-btn--outline-red" id="openModalBtn">
                                Solicite uma cotação
                            </a>
                        </div>

                        

                    </div>
                </div>

                <div class="wkode-single-used-bikes-template__body">
                    <h4 class="wkode-single-used-bikes-template__description-title">
                        Descrição
                    </h4>
                    <div class="wkode-single-used-bikes-template__content entry-content">
                        <?php the_content(); ?>
                    </div>

                </div>

                <div class="wkode-single-used-bikes-template__random-used mb-48 mt-52">
                    <?php
                        $related_bikes = new WP_Query([
                            'post_type' => 'motos-seminovas',
                            'orderby' => 'rand',
                            'posts_per_page' => 12,
                        ]);        
                    ?>
                        <h3 class="text-center font-rubik text-5xl font-semibold uppercase mb-36 text-lcw-primary-blue">ofertas similares</h3>
                        <div class="wkode-used-bikes__category category-filter-container-wrapper wkode-used-bikes__slider   px-12 md:container">
                        <?php
                            if ($related_bikes->have_posts()) {
                                while($related_bikes->have_posts()){
                                    $related_bikes->the_post();
                
                                    get_template_part('./template-parts/cards/used-bikes');
                                } wp_reset_postdata();
                            }
                        ?>
                        </div>
                    <div class="btn flex justify-center mt-36">
                        <a href="" class="wkode-btn wkode-btn--solid-red m-auto">Ver Todos</a>
                    </div>
                </div>

                <div class="wkode-single-used-bikes-template__random-products pb-36">
                    <?php
                        $random_posts = new WP_Query([
                            'post_type' => 'produtos',
                            'orderby' => 'rand',
                            'posts_per_page' => 12,
                        ]);        
                    ?>
                    <h3 class="text-center font-rubik text-lcw-primary-blue text-5xl font-semibold uppercase mb-36">ACESSÓRIOS</h3>
                    <div class="wkode-archive__related">
                        <?php
                            if ($random_posts->have_posts()) {
                                while ($random_posts->have_posts()) {
                                    $random_posts->the_post();
                                    get_template_part('./template-parts/cards/products');
                                }
                            }wp_reset_postdata();
                        ?>
                    </div>
                    <div class="btn flex justify-center mt-36">
                        <a href="" class="wkode-btn wkode-btn--solid-red m-auto">Ver Todos</a>
                    </div>
                </div>
            </article>

            <div class="wkode-single-used-bikes-template__form modal" id="myModal">
                <h2 class="wkode-single-used-bikes-template__form-title">
                    <?php the_title(); ?>
                    <span class="close">
                        <img class="wkode-single-used-bikes__img" src="<?php echo get_theme_file_uri('/assets/img/svg/white-x-thick.svg'); ?>" alt="" srcset="">
                    </span>
                </h2>
                <?php echo do_shortcode( '[wpforms id="308" title="false"]' ); ?>
            </div>
               
        <?php endwhile; ?>

    </main>
</div>

<?php get_footer(); ?>