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
                Loja: de segunda a sexta-feira, das 8h às 18h. Sábado das 8h às 12h
            </p>
            <p class="wkode-contact-block__text mb-6">
               Oficina: de segunda a sexta-feira das 8h às 12h e das 13h30 às 18h.
                Sábado das 8h às 12h
            </p>
            <p class="wkode-contact-block__text mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="inline-block mr-2" fill="white">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                </svg>
                
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" class="inline-block mr-2" fill="white">
                    <path d="M798-120q-125 0-247-54.5T329-329Q229-429 174.5-551T120-798q0-18 12-30t30-12h162q14 0 25 9.5t13 22.5l26 140q2 16-1 27t-11 19l-97 98q20 37 47.5 71.5T387-386q31 31 65 57.5t72 48.5l94-94q9-9 23.5-13.5T670-390l138 28q14 4 23 14.5t9 23.5v162q0 18-12 30t-30 12ZM241-600l66-66-17-94h-89q5 41 14 81t26 79Zm358 358q39 17 79.5 27t81.5 13v-88l-94-19-67 67ZM241-600Zm358 358Z"/>
                </svg>
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