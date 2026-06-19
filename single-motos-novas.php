<?php get_header(); 

require_once 'inc/format_prices.php';
$table = get_field('wkode_single_new_bikes_table', get_the_ID());
$price = get_field('wkode_single_new_bikes_price', get_the_ID());
$images = wkode_get_vehicle_gallery_images(get_the_ID(), 'wkode_single_new_bikes_image_gallery');

?>

<div id="primary" class="wkode-single-used-bikes-template content-area">
    <main id="main" class="wkode-single-used-bikes-template__main site-main" role="main">

        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('wkode-single-used-bikes-template__article wkode-single-panzoom-reference'); ?>>

                <div class="wkode-single-used-bikes-template__wrapper">
                    <h1 class="wkode-single-used-bikes-template__title wkode-single-used-bikes-template__title--mobile"><?php the_title(); ?></h1>
                    <div class="wkode-single-used-bikes-template__image featured-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'wkode_single_used_bikes'); ?>
                            <div class="f-carousel" id="myCarousel">
                                <div class="f-carousel__slide" data-thumb-src="<?php echo esc_url($thumbnail_url); ?>">
                                    <img class="wkode-single-used-bikes__img" data-lazy-src="<?php echo esc_url($thumbnail_url); ?>" />
                                </div>
                                <?php
                                if($images && is_array($images)) : 
                                    foreach ($images as $image) : ?>
                                        <?php $image_url = isset($image['url']) ? $image['url'] : ''; ?>
                                        <?php if ($image_url) : ?>
                                            <div class="f-carousel__slide" data-thumb-src="<?php echo esc_url($image_url); ?>">
                                                <img class="wkode-single-used-bikes__img" data-lazy-src="<?php echo esc_url($image_url); ?>" />
                                            </div>
                                        <?php endif; ?>
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
                            if ($table && is_array($table)) {
                                $cellClass = 'table-cell';
                                $titleCellClass = $cellClass . ' table-cell--title';
                                $contentCellClass = $cellClass . ' table-cell--content';
                                $row_count = 0;
                                $has_visible_rows = false;
                                
                                
                                ob_start();
                                ?>
                                <?php if (!empty($table['wkode_single_new_table_state'])) : ?>
                                    <div class="table-row <?php echo ($row_count % 2 === 0) ? 'table-row--dark' : ''; ?>">
                                        <div class="<?php echo esc_attr($titleCellClass); ?>">Estado:</div>
                                        <div class="<?php echo esc_attr($contentCellClass); ?>"><?php echo esc_html($table['wkode_single_new_table_state']); ?></div>
                                    </div>
                                    <?php $row_count++; $has_visible_rows = true; ?>
                                <?php endif; ?>
                                
                                <?php if (!empty($table['wkode_single_new_table_year'])) : ?>
                                    <div class="table-row <?php echo ($row_count % 2 === 0) ? 'table-row--dark' : ''; ?>">
                                        <div class="<?php echo esc_attr($titleCellClass); ?>">Ano:</div>
                                        <div class="<?php echo esc_attr($contentCellClass); ?>"><?php echo esc_html($table['wkode_single_new_table_year']); ?></div>
                                    </div>
                                    <?php $row_count++; $has_visible_rows = true; ?>
                                <?php endif; ?>
                                
                                <?php if (!empty($table['wkode_single_new_table_km'])) : ?>
                                    <div class="table-row <?php echo ($row_count % 2 === 0) ? 'table-row--dark' : ''; ?>">
                                        <div class="<?php echo esc_attr($titleCellClass); ?>">Quilometragem:</div>
                                        <div class="<?php echo esc_attr($contentCellClass); ?>"><?php echo esc_html($table['wkode_single_new_table_km']); ?></div>
                                    </div>
                                    <?php $row_count++; $has_visible_rows = true; ?>
                                <?php endif; ?>
                                
                                <?php if (!empty($table['wkode_single_new_table_license'])) : ?>
                                    <div class="table-row <?php echo ($row_count % 2 === 0) ? 'table-row--dark' : ''; ?>">
                                        <div class="<?php echo esc_attr($titleCellClass); ?>">Placa Final:</div>
                                        <div class="<?php echo esc_attr($contentCellClass); ?>"><?php echo esc_html($table['wkode_single_new_table_license']); ?></div>
                                    </div>
                                    <?php $row_count++; $has_visible_rows = true; ?>
                                <?php endif; ?>
                                
                                <?php if (!empty($table['wkode_single_new_table_fuel'])) : ?>
                                    <div class="table-row <?php echo ($row_count % 2 === 0) ? 'table-row--dark' : ''; ?>">
                                        <div class="<?php echo esc_attr($titleCellClass); ?>">Combustível:</div>
                                        <div class="<?php echo esc_attr($contentCellClass); ?>"><?php echo esc_html($table['wkode_single_new_table_fuel']); ?></div>
                                    </div>
                                    <?php $row_count++; $has_visible_rows = true; ?>
                                <?php endif; ?>
                                
                                <?php if (!empty($table['wkode_single_new_table_transmission']) || !empty($table['wkode_single_used_new_transmission'])) : ?>
                                    <div class="table-row <?php echo ($row_count % 2 === 0) ? 'table-row--dark' : ''; ?>">
                                        <div class="<?php echo esc_attr($titleCellClass); ?>">Câmbio:</div>
                                        <div class="<?php echo esc_attr($contentCellClass); ?>"><?php echo esc_html(!empty($table['wkode_single_new_table_transmission']) ? $table['wkode_single_new_table_transmission'] : $table['wkode_single_used_new_transmission']); ?></div>
                                    </div>
                                    <?php $row_count++; $has_visible_rows = true; ?>
                                <?php endif; ?>
                                
                                <?php if (!empty($table['wkode_single_new_table_color'])) : ?>
                                    <div class="table-row <?php echo ($row_count % 2 === 0) ? 'table-row--dark' : ''; ?>">
                                        <div class="<?php echo esc_attr($titleCellClass); ?>">Cor:</div>
                                        <div class="<?php echo esc_attr($contentCellClass); ?>"><?php echo esc_html($table['wkode_single_new_table_color']); ?></div>
                                    </div>
                                    <?php $row_count++; $has_visible_rows = true; ?>
                                <?php endif; ?>
                                <?php
                                $repeater_rows = isset($table['wkode_single_new_table_repeater']) && is_array($table['wkode_single_new_table_repeater']) ? $table['wkode_single_new_table_repeater'] : [];
                                if (!empty($repeater_rows)) :
                                    foreach ($repeater_rows as $index => $row) :
                                        if (!is_array($row)) { continue; }
                                        
                                        
                                        $row_group = [];
                                        if (isset($row['wkode_single_new_table_repeater_group']) && is_array($row['wkode_single_new_table_repeater_group'])) {
                                            $row_group = $row['wkode_single_new_table_repeater_group'];
                                        } elseif (isset($row['wkode_single_used_table_repeater_group']) && is_array($row['wkode_single_used_table_repeater_group'])) {
                                            $row_group = $row['wkode_single_used_table_repeater_group'];
                                        }
                                        
                                        
                                        $title = '';
                                        $field = '';
                                        
                                        if (!empty($row_group['wkode_single_new_table_repeater_title'])) {
                                            $title = $row_group['wkode_single_new_table_repeater_title'];
                                        } elseif (!empty($row_group['wkode_single_used_table_repeater_title'])) {
                                            $title = $row_group['wkode_single_used_table_repeater_title'];
                                        }
                                        
                                        if (!empty($row_group['wkode_single_new_table_repeater_field'])) {
                                            $field = $row_group['wkode_single_new_table_repeater_field'];
                                        } elseif (!empty($row_group['wkode_single_used_table_repeater_field'])) {
                                            $field = $row_group['wkode_single_used_table_repeater_field'];
                                        }
                                        
                                        
                                        if ($title !== '' && $field !== '') :
                                            $rowClass = ($row_count % 2 === 0) ? 'table-row--dark' : '';
                                            ?>
                                            <div class="table-row <?php echo esc_attr($rowClass); ?>">
                                                <div class="<?php echo esc_attr($titleCellClass); ?>"><?php echo esc_html($title); ?></div>
                                                <div class="<?php echo esc_attr($contentCellClass); ?>"><?php echo esc_html($field); ?></div>
                                            </div>
                                            <?php $row_count++; $has_visible_rows = true; ?>
                                        <?php endif; ?>
                                    <?php
                                    endforeach;
                                endif;

                                $table_content = ob_get_clean();

                                if ($has_visible_rows) {
                                    echo $table_content;
                                }
                            }
                            ?>
                        </div>

                        <div class="wkode-single-used-bikes-template__price">
                            <?php
                            if($price){ ?>
                                Por apenas
                                <h3>
                                    <?php
                                        echo 'R$ '. format_price($price);
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


                        <div class="wkode-single-used-bikes-template__btn mt-12">
                            <a href="" class="wkode-btn wkode-btn--outline-red" id="openModalBtn">
                                Solicite uma cotação
                            </a>
                        </div>

                    </div>
                </div>

                <div class="wkode-single-used-bikes-template__body mt-9 container">
                    <h4 class="wkode-single-used-bikes-template__description-title">Descrição</h4>
                    <div class="wkode-single-used-bikes-template__content entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>

                <div class="wkode-single-used-bikes-template__random-used mb-48 mt-52">
                    <?php
                        $related_bikes = new WP_Query([
                            'post_type' => 'motos-novas',
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
                                    get_template_part('./template-parts/cards/new-bikes');
                                } wp_reset_postdata();
                            }
                        ?>
                        </div>
                    <div class="btn flex justify-center mt-36">
                        <a href="<?php echo esc_url(site_url('/motos-novas')); ?>" class="wkode-btn wkode-btn--solid-red m-auto">Ver Todos</a>
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
                        <a href="<?php echo esc_url(site_url('/produtos')); ?>" class="wkode-btn wkode-btn--solid-red m-auto">Ver Todos</a>
                    </div>
                </div>
            </article>

            <div class="wkode-single-used-bikes-template__form modal" id="myModal">
                <h2 class="wkode-single-used-bikes-template__form-title">
                    <?php the_title(); ?>
                    <span class="close">
                        <img class="wkode-single-used-bikes__img" src="<?php echo esc_url(get_theme_file_uri('/assets/img/svg/white-x-thick.svg')); ?>" alt="">
                    </span>
                </h2>
                <?php echo do_shortcode( '[wpforms id="308" title="false"]' ); ?>
            </div>
               
        <?php endwhile; ?>

    </main>
</div>



<?php get_footer(); ?>