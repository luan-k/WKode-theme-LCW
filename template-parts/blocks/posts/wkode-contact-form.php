<?php 

if( isset( $block['data']['preview'] )  ) {    /* rendering in inserter preview  */ ?>

	<img src="<?php echo get_theme_file_uri('template-parts/blocks/preview/wkode-contact-form.png'); ?>" style="width:100%; height:auto;">

<?php
}else{ ?>

<section class="wkode-contact-block">
    <div class="wkode-contact-block__wrapper ">
        <header class="wkode-contact-block__title-header">
            <h2 class="wkode-contact-block__title">
                Fale conosco. A sua opinião é muito importante para nós!
            </h2>
            <h3 class="wkode-contact-block__subtitle">
                Horário de atendimento:
            </h3>
            <p class="wkode-contact-block__text mb-6">
                Segunda à sexta das: 08h00 às 18h00
            </p>
            <p class="wkode-contact-block__text mb-6">
                (48) 3369-4159
            </p>
            <p class="wkode-contact-block__text mb-6">
                Armando Calil Bulos, 6515, Ingleses - Florianópolis/SC 88058-001
            </p>
        </header>
        <div class="wkode-contact-block__form ">
            <?php echo do_shortcode( '[wpforms id="492" title="false"]' ); ?>
        </div>
    </div>

</section>

<?php 
} ?>