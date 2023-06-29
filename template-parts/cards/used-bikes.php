<?php
// Get the value of the custom field for the current post 
$table = get_field('wkode_single_used_table', get_the_ID());
$year = '';
$km = '';
if($table){
    $year = $table['wkode_single_used_table_year'];
    $km = $table['wkode_single_used_table_km'];
}
$price = get_field('wkode_single_used_price', get_the_ID());
?>
<div class="wkode-used-bikes__card mx-2">
    
    <a class="wkode-used-bikes__card-link" href="<?php the_permalink(); ?>">
        <img class="wkode-used-bikes__card-img" src="<?php if(has_post_thumbnail()){ the_post_thumbnail_url('motos_seminovas_card'); } else { echo get_theme_file_uri('./assets/img/standart-used.png'); }  ?>" alt="" srcset=""> 
    </a>
    <div class="wkode-used-bikes__card-body">
        <h3 class="wkode-used-bikes__card-title ">
            <a href="<?php the_permalink(); ?>">
                <?php echo wp_trim_words( the_title() , 15); ?>
            </a>
        </h3>
        <div class="wkode-used-bikes__card-info">
            <div class="wkode-used-bikes__card-info-date">
                <img class="wkode-used-bikes__card-img" src="<?php echo get_theme_file_uri('./assets/img/svg/calendar-used.svg'); ?>" alt="" srcset=""> 
                <?php 
                if($year){
                    echo $year; 
                }else{
                    echo "23/23";
                }?>
            </div>
            <div class="wkode-used-bikes__card-info-km">
                <img class="wkode-used-bikes__card-img" src="<?php echo get_theme_file_uri('./assets/img/svg/km.svg'); ?>" alt="" srcset=""> 
                <?php
                if($km){
                    echo $km; 
                }else{
                    echo "1000";
                } ?>
            </div>
        </div>
    </div>
    <div class="wkode-used-bikes__card-footer">
        <div class="wkode-used-bikes__card-footer-price">
            <?php
            if($price){
                echo 'R$ '. $price;
            }else{
                echo "consulte";
            }
            ?>
        </div>
        <div class="wkode-used-bikes__card-footer-btn"><a href="<?php the_permalink(); ?>" class="wkode-btn wkode-btn--outline-red">Ver Mais</a></div>
    </div>
</div>