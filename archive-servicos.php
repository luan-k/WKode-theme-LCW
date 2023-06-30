<?php get_header(); ?>

<section id="primary" class="wkode-archive wkode-archive--servicos content-area py-60">
    <h1 class="page-title text-left font-rubik text-white text-6xl font-semibold uppercase mb-36 container">
        Serviços
    </h1>
    <main id="main" class="wkode-archive__main site-main mb-60" role="main">

        <?php if (have_posts()) : ?>

            <div class="wkode-archive__grid">

                <?php while (have_posts()) : the_post();
                ?>
                    <div class="wkode-services__card ">
                        <a href="<?php the_permalink(); ?>" class="wkode-services__card-img-wrapper">
                            <img class="wkode-services__card-img" src="<?php if(has_post_thumbnail()){ the_post_thumbnail_url('wkode_servicos_archive'); } else { echo get_theme_file_uri('./assets/img/standart_image.png'); }  ?>" alt="" srcset=""> 
                        </a> 
                        <div class="wkode-services__card-body ">
                            <h3 class="wkode-services__card-title ">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo wp_trim_words( the_title() , 15); ?>
                                </a>
                            </h3>
                            <div class="wkode-services__card-content">
                                <?php echo wp_trim_words( get_the_content() , 67); ?>
                            </div>

                            <a href="<?php the_permalink(); ?>" class=" wkode-services__card-btn wkode-btn wkode-btn--solid-red ">Ler Mais</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

        <?php else : ?>
            <p><?php esc_html_e('No posts found.', 'text-domain'); ?></p>
        <?php endif; ?>

    </main>

</section>

<?php get_footer(); ?>