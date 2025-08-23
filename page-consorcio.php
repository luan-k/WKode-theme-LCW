<?php
get_header();

$consorcioRepeater = get_field('consorcio_repeater');
if (!is_array($consorcioRepeater)) {
    $consorcioRepeater = [];
}
?>

<div id="primary" class="wkode-single-page-template wkode-single-page-template--consorcio content-area">
    <main id="main" class="wkode-single-page-template__main site-main" role="main">

        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('wkode-single-page-template__article'); ?>>

                <div class="wkode-single-page-template__body py-60">
                    <header class="container mb-28">
                        <h1 class="text-6xl font-rubik font-extrabold text-left uppercase"><?php echo esc_html(get_the_title()); ?></h1>
                    </header>

                    <div class="wkode-single-page-template__content entry-content">
                        <?php foreach ($consorcioRepeater as $item) :
                            if (!is_array($item)) { continue; }

                            $consorcioGroup = isset($item['consorcio_group']) && is_array($item['consorcio_group']) ? $item['consorcio_group'] : [];

                            $title   = isset($consorcioGroup['consorcio_title']) ? (string) $consorcioGroup['consorcio_title'] : '';
                            $subtitle = isset($consorcioGroup['consorcio_subtitle']) ? (string) $consorcioGroup['consorcio_subtitle'] : '';
                            $image    = $consorcioGroup['consorcio_image'] ?? null;

                            $img_url = '';
                            $img_alt = '';

                            if (is_array($image)) {
                                $img_url = isset($image['sizes']['motos_seminovas_card']) ? $image['sizes']['motos_seminovas_card'] : ($image['url'] ?? '');
                                $img_alt = $image['alt'] ?? '';
                            } elseif (is_numeric($image)) {
                                $img_url = wp_get_attachment_image_url((int)$image, 'motos_seminovas_card');
                                if (!$img_url) {
                                    $img_url = wp_get_attachment_image_url((int)$image, 'large');
                                }
                                if (!$img_url) {
                                    $img_url = wp_get_attachment_url((int)$image);
                                }
                                $img_alt = get_post_meta((int)$image, '_wp_attachment_image_alt', true);
                            } elseif (is_string($image)) {
                                $img_url = $image;
                            }

                            $consorcioRepeaterParcelas = [];
                            if (isset($consorcioGroup['consorcio_repeater_parcelas']) && is_array($consorcioGroup['consorcio_repeater_parcelas'])) {
                                $consorcioRepeaterParcelas = $consorcioGroup['consorcio_repeater_parcelas'];
                            }
                            ?>
                            <div class="wkode-used-bikes__card wkode-used-bikes__card--consorcio">
                                <a class="wkode-used-bikes__card-link">
                                    <?php if (!empty($img_url)) : ?>
                                        <img class="wkode-used-bikes__card-img" src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt ?: wp_strip_all_tags($title)); ?>">
                                    <?php endif; ?>
                                </a>

                                <div class="wkode-used-bikes__card-body">
                                    <h3 class="wkode-used-bikes__card-title">
                                        <a>
                                            <?php echo esc_html(wp_trim_words($title, 15)); ?>
                                        </a>
                                    </h3>

                                    <?php if ($subtitle !== '') : ?>
                                        <h4 class="wkode-used-bikes__card-title wkode-used-bikes__card-title--subtitle">
                                            <?php echo esc_html($subtitle); ?>
                                        </h4>
                                    <?php endif; ?>

                                    <?php if (!empty($consorcioRepeaterParcelas)) : ?>
                                        <div class="wkode-used-bikes__card-info">
                                            <?php foreach ($consorcioRepeaterParcelas as $parcela) :
                                                if (!is_array($parcela)) { continue; }
                                                $consorcioGroupParcelas = isset($parcela['consorcio_group_parcelas']) && is_array($parcela['consorcio_group_parcelas'])
                                                    ? $parcela['consorcio_group_parcelas']
                                                    : [];

                                                $consorcioQuantity = isset($consorcioGroupParcelas['consorcio_quantity']) ? (string)$consorcioGroupParcelas['consorcio_quantity'] : '';
                                                $consorcioPrice    = isset($consorcioGroupParcelas['consorcio_price']) ? (string)$consorcioGroupParcelas['consorcio_price'] : '';

                                                if ($consorcioQuantity === '' && $consorcioPrice === '') { continue; }
                                                ?>
                                                <div class="wkode-used-bike__card-prices">
                                                    <?php if ($consorcioQuantity !== '') : ?>
                                                        <h5 class="wkode-used-bike__card-prices-quantity">
                                                            <?php echo esc_html($consorcioQuantity); ?>X
                                                        </h5>
                                                    <?php endif; ?>
                                                    <?php if ($consorcioPrice !== '') : ?>
                                                        <h5 class="wkode-used-bike__card-prices-price">
                                                            R$ <?php echo esc_html($consorcioPrice); ?>
                                                        </h5>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="wkode-used-bikes__card-footer">
                                    <div class="wkode-used-bikes__card-footer-btn w-full">
                                        <a href="#" class="wkode-btn wkode-btn--outline-red w-full text-center openModalBtnConsorcio">
                                            <?php echo esc_html__('Solicitar cotação', 'wkode'); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </article>
        <?php endwhile; ?>

    </main>

    <div class="wkode-single-used-bikes-template__form modal" id="myModalConsorcio">
        <h2 class="wkode-single-used-bikes-template__form-title">
            <span class="closeConsorcio">
                <img class="wkode-single-used-bikes__img" src="<?php echo esc_url(get_theme_file_uri('/assets/img/svg/white-x-thick.svg')); ?>" alt="">
            </span>
        </h2>
        <?php echo do_shortcode('[wpforms id="308" title="false"]'); ?>
    </div>
</div>

<?php get_footer(); ?>