<?php get_header(); 
$consorcioRepeater           = get_field('consorcio_repeater');

?>

<div id="primary" class="wkode-single-page-template wkode-single-page-template--consorcio content-area">
    <main id="main" class="wkode-single-page-template__main site-main" role="main">

        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('wkode-single-page-template__article'); ?>>

                <div class="wkode-single-page-template__body py-60">
                    <header class="container mb-28">
                        <h1 class="text-6xl font-rubik font-extrabold text-left uppercase"><?php the_title(); ?></h1>
                    </header>
                    <div class="wkode-single-page-template__content entry-content"><!--  -->

                        <?php 

                        foreach ($consorcioRepeater as $item) {
                            $consorcioGroup = $item['consorcio_group'];
                            $consorcioMoto = $consorcioGroup['consorcio_moto'];
                            $consorcioRepeaterParcelas = $consorcioGroup['consorcio_repeater_parcelas'];
                            $subtitle = $consorcioGroup['consorcio_subtitle'];
                            $title = $consorcioGroup['consorcio_title'];
                            $image = $consorcioGroup['consorcio_image'];

                            ?>

                            <div class="wkode-used-bikes__card wkode-used-bikes__card--consorcio">
                                <a class="wkode-used-bikes__card-link" >
                                    <img class="wkode-used-bikes__card-img" src="<?php echo $image['sizes']['motos_seminovas_card']; ?>" alt="" srcset=""> 
                                </a>
                                <div class="wkode-used-bikes__card-body">
                                    <h3 class="wkode-used-bikes__card-title ">
                                        <a >
                                            <?php echo wp_trim_words( $title , 15); ?>
                                        </a>
                                    </h3>
                                    <h4 class="wkode-used-bikes__card-title wkode-used-bikes__card-title--subtitle">
                                            <?php echo $subtitle; ?>
                                    </h4>
                                    <div class="wkode-used-bikes__card-info">
                                        <?php
                                        // Iterating over consorcio_repeater_parcelas
                                        foreach ($consorcioRepeaterParcelas as $parcela) {
                                            $consorcioGroupParcelas = $parcela['consorcio_group_parcelas'];
                                            $consorcioQuantity = $consorcioGroupParcelas['consorcio_quantity'];
                                            $consorcioPrice = $consorcioGroupParcelas['consorcio_price']; ?>
                                            <div class="wkode-used-bike__card-prices"> 
                                                <h5 class="wkode-used-bike__card-prices-quantity">
                                                    <?php echo $consorcioQuantity; ?>X
                                                </h5>
                                                <h5 class="wkode-used-bike__card-prices-price">
                                                    R$ <?php echo $consorcioPrice; ?>
                                                </h5>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="wkode-used-bikes__card-footer ">
                                    <div class="wkode-used-bikes__card-footer-btn w-full ">
                                        <a href="<?php  ?>" class="wkode-btn wkode-btn--outline-red w-full text-center openModalBtnConsorcio">
                                            Solicitar cotação
                                        </a>
                                    </div>
                                </div>
                            </div>

                        <?php 
                        }
                        ?>
                    </div>
                </div>


            </article>
        <?php endwhile; ?>

    </main>

    <div class="wkode-single-used-bikes-template__form modal" id="myModalConsorcio">
        <h2 class="wkode-single-used-bikes-template__form-title">
            <span class="closeConsorcio">
                <img class="wkode-single-used-bikes__img" src="<?php echo get_theme_file_uri('/assets/img/svg/white-x-thick.svg'); ?>" alt="" srcset="">
            </span>
        </h2>
        <?php echo do_shortcode( '[wpforms id="308" title="false"]' ); ?>
    </div>
</div>

<?php get_footer(); ?>