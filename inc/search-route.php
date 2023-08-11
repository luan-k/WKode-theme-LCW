<?php

add_action('rest_api_init', 'WkodeRegisterSearch');
require_once get_template_directory() . '/inc/format_prices.php';

function WkodeRegisterSearch(){
    register_rest_route('wk/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'WkodeSearchResults',
		'permission_callback' => '__return_true'
    ));
}

function WkodeSearchResults($data){
    $newQuery = new WP_Query(array(
        'post_type' => array('motos-novas'),
        's' => sanitize_text_field($data['term']),
		'posts_per_page' => 12,
    ));
    $usedQuery = new WP_Query(array(
        'post_type' => array('motos-seminovas'),
        's' => sanitize_text_field($data['term']),
		'posts_per_page' => 12,
    ));
    $productsQuery = new WP_Query(array(
        'post_type' => array('produtos'),
        's' => sanitize_text_field($data['term']),
		'posts_per_page' => 12,
    ));
    $results = array(
        'newBikes' => array(),
        'usedBikes' => array(),
        'products' => array(),
    );

    while ($newQuery->have_posts()) {
        $newQuery->the_post();
    
        if (get_post_type() == 'motos-novas') {
            $custom_field_value = get_field('wkode_motorcycles_post_colors', get_the_ID());
            $newBike = array(
                'title' => wp_trim_words(get_the_title(), 15),
                'permalink' => get_the_permalink(),
                'images' => array(),
                'colors' => array(),
            );
    
            foreach ($custom_field_value as $index => $field) {
                $postImg = $field['wkode_motorcycles_post_img'];
                $postColor = $field['wkode_motorcycles_post_color'];
                $biOrTri = $field['wkode_motorcycles_bicolor_ou_tricolor'];
                $secondColor = $field['wkode_motorcycles_post_color_two'];
                $thirdColor = $field['wkode_motorcycles_post_color_three'];
    
                $isActiveColor = ($index == 0) ? ' active-color-image' : '';
    
                $newBike['images'][] = array(
                    'src' => $postImg,
                    'isActiveColor' => $isActiveColor,
                );
    
                $colorData = array(
                    'colorClass' => '',
                    'colorStyles' => array('background-color: ' . $postColor), // Initialize as an array
                    'isActiveColor' => ($index == 0) ? ' active-color' : '',
                );
    
                if ($biOrTri == 'bicolor') {
                    $colorData['colorClass'] = 'wkode-new-bikes__card-color--bicolor';
                    $colorData['colorStyles'][] = 'background-color: ' . $secondColor; // Add the second color
                } elseif ($biOrTri == 'tricolor') {
                    $colorData['colorClass'] = 'wkode-new-bikes__card-color--tricolor';
                    $colorData['colorStyles'][] = 'background-color: ' . $secondColor; // Add the second color
                    $colorData['colorStyles'][] = 'background-color: ' . $thirdColor; // Add the third color
                } else {
                    $colorData['colorClass'] = 'wkode-new-bikes__card-color--unique';
                }
    
                $newBike['colors'][] = $colorData;
            }
    
            array_push($results['newBikes'], $newBike);
        }
    }
    while ($usedQuery->have_posts()) {
        $usedQuery->the_post();
    
        if (get_post_type() == 'motos-seminovas') {
            $table = get_field('wkode_single_used_table', get_the_ID());
            $year = '';
            $km = '';
            if ($table) {
                $year = $table['wkode_single_used_table_year'];
                $km = $table['wkode_single_used_table_km'];
            }
            $price = get_field('wkode_single_used_price', get_the_ID());
    
            $usedBike = array(
                'title' => wp_trim_words(get_the_title(), 4),
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0, 'motos_seminovas_card'),
                'descricao' => wp_trim_words(get_the_content(), 24),
                'year' => $year ? $year : '23/23',
                'km' => $km ? $km : '1000',
                'price' => $price ? 'R$ ' . format_price($price) : 'consulte',
                'calendarSvg' => get_theme_file_uri('./assets/img/svg/calendar-used.svg'),
                'kmSvg' => get_theme_file_uri('./assets/img/svg/km.svg'),
            );
    
            array_push($results['usedBikes'], $usedBike);
        }
    }
    while($productsQuery->have_posts()){
        $productsQuery ->the_post();

        if(get_post_type() == 'produtos'){
            array_push($results['products'], array(
                'title' => wp_trim_words( get_the_title(), 4),
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0, 'products_card'),
            ));
        }
    }

    return $results;
}
// get field,
// permalink
// the title 15
// /*  */