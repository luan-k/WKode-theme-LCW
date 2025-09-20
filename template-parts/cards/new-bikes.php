<?php
$table = get_field('wkode_single_new_bikes_table', get_the_ID());
$year  = '';
$km    = '';

require_once get_template_directory() . '/inc/format_prices.php';

if (is_array($table)) {
    $year = isset($table['wkode_single_new_table_year']) ? (string)$table['wkode_single_new_table_year'] : '';
    $km   = isset($table['wkode_single_new_table_km']) ? (string)$table['wkode_single_new_table_km'] : '';
}

$price = get_field('wkode_single_new_bikes_price', get_the_ID());
?>
<div class="wkode-used-bikes__card mx-2">

    <a class="wkode-used-bikes__card-link" href="<?php the_permalink(); ?>">
        <img class="wkode-used-bikes__card-img" src="<?php if (has_post_thumbnail()) { the_post_thumbnail_url('motos_seminovas_card'); } else { echo get_theme_file_uri('./assets/img/standart-used.png'); } ?>" alt="">
    </a>

    <div class="wkode-used-bikes__card-body">
        <h3 class="wkode-used-bikes__card-title">
            <a href="<?php the_permalink(); ?>">
                <?php echo esc_html( wp_trim_words( get_the_title(), 15 ) ); ?>
            </a>
        </h3>
        <div class="wkode-used-bikes__card-info">
            <div class="wkode-used-bikes__card-info-date">
                <img class="wkode-used-bikes__card-img" src="<?php echo esc_url( get_theme_file_uri('./assets/img/svg/calendar-used.svg') ); ?>" alt="">
                <?php
                if ($year !== '') {
                    echo esc_html($year);
                } else {
                    echo '23/23';
                }
                ?>
            </div>
            <div class="wkode-used-bikes__card-info-km">
                <img class="wkode-used-bikes__card-img" src="<?php echo esc_url( get_theme_file_uri('./assets/img/svg/km.svg') ); ?>" alt="">
                <?php
                if ($km !== '') {
                    echo esc_html($km);
                } else {
                    echo '0';
                }
                ?>
            </div>
        </div>
    </div>

    <div class="wkode-used-bikes__card-footer">
        <div class="wkode-used-bikes__card-footer-price">
            <?php
            if ($price) {
                echo 'R$ ' . esc_html( format_price($price) );
            } else {
                echo 'consulte';
            }
            ?>
        </div>
        <div class="wkode-used-bikes__card-footer-btn">
            <a href="<?php the_permalink(); ?>" class="wkode-btn wkode-btn--outline-red">Ver Mais</a>
        </div>
    </div>
</div>