<?php
// Get repeater rows (may be array or false/null)
$colors = get_field('wkode_motorcycles_post_colors', get_the_ID());
if (!is_array($colors)) {
    $colors = [];
}

$title     = wp_trim_words(get_the_title(), 15);
$permalink = get_permalink();
?>
<div class="wkode-new-bikes__card">
    <h3 class="wkode-new-bikes__card-title">
        <a href="<?php echo esc_url($permalink); ?>">
            <?php echo esc_html($title); ?>
        </a>
    </h3>

    <a href="<?php echo esc_url($permalink); ?>">
        <?php if (!empty($colors)) : ?>
            <?php foreach ($colors as $index => $field) :
                $postImg = isset($field['wkode_motorcycles_post_img']) ? $field['wkode_motorcycles_post_img'] : '';
                if (!$postImg) { continue; }
                $imgClass = 'wkode-new-bikes__card-img' . ($index === 0 ? ' active-color-image' : '');
            ?>
                <img class="<?php echo esc_attr($imgClass); ?>" src="<?php echo esc_url($postImg); ?>" alt="<?php echo esc_attr($title); ?>">
            <?php endforeach; ?>
        <?php elseif (has_post_thumbnail()) : ?>
            <?php
            $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            if ($thumb_url) :
            ?>
                <img class="wkode-new-bikes__card-img active-color-image" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($title); ?>">
            <?php endif; ?>
        <?php endif; ?>
    </a>

    <div class="wkode-new-bikes__card-colors text-black">
        <?php if (!empty($colors)) : ?>
            <?php foreach ($colors as $index => $field) :
                $biOrTri     = isset($field['wkode_motorcycles_bicolor_ou_tricolor']) ? strtolower((string)$field['wkode_motorcycles_bicolor_ou_tricolor']) : '';
                $postColor   = isset($field['wkode_motorcycles_post_color']) ? sanitize_hex_color($field['wkode_motorcycles_post_color']) : '';
                $secondColor = isset($field['wkode_motorcycles_post_color_two']) ? sanitize_hex_color($field['wkode_motorcycles_post_color_two']) : '';
                $thirdColor  = isset($field['wkode_motorcycles_post_color_three']) ? sanitize_hex_color($field['wkode_motorcycles_post_color_three']) : '';

                if ($biOrTri === 'bicolor') {
                    $biOrTriClass = 'wkode-new-bikes__card-color--bicolor';
                } elseif ($biOrTri === 'tricolor') {
                    $biOrTriClass = 'wkode-new-bikes__card-color--tricolor';
                } else {
                    $biOrTriClass = 'wkode-new-bikes__card-color--unique';
                }

                $active_color = ($index === 0) ? 'active-color' : '';
            ?>
                <span class="wkode-new-bikes__card-color <?php echo esc_attr($active_color); ?>">
                    <?php if ($postColor) : ?>
                        <span class="<?php echo esc_attr($biOrTriClass); ?>" style="background-color: <?php echo esc_attr($postColor); ?>"></span>
                    <?php endif; ?>

                    <?php if ($biOrTriClass === 'wkode-new-bikes__card-color--bicolor' && $secondColor) : ?>
                        <span class="<?php echo esc_attr($biOrTriClass); ?>" style="background-color: <?php echo esc_attr($secondColor); ?>"></span>
                    <?php elseif ($biOrTriClass === 'wkode-new-bikes__card-color--tricolor') : ?>
                        <?php if ($secondColor) : ?>
                            <span class="<?php echo esc_attr($biOrTriClass); ?>" style="background-color: <?php echo esc_attr($secondColor); ?>"></span>
                        <?php endif; ?>
                        <?php if ($thirdColor) : ?>
                            <span class="<?php echo esc_attr($biOrTriClass); ?>" style="background-color: <?php echo esc_attr($thirdColor); ?>"></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </span>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>