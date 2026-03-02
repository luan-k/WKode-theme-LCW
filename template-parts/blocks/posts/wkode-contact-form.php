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
                Armando Calil Bulos, 6515, Ingleses - Florianópolis/SC 88058-001
            </p>
        </header>
        <div class="wkode-contact-block__form ">
            <p class="wkode-contact-block__text mb-6">
                Entrem contato conosco pelo WhatsApp
            </p>
            <a target="_blank" href="https://app.leadster.com.br/capture/4EqLLbVcdSjjYUcZ" class="btn-input items-center justify-center wkode-btn wkode-btn--solid-red w-full block text-center mb-6" id="">
                Fale Conosco
            </a>
            <p class="wkode-contact-block__text mb-6">
                Se preferir, envie e-mail para  <a href="mailto:contato@lcwmotos.com.br">contato@lcwmotos.com.br</a>
            </p>
        </div>
    </div>

</section>

<?php 
} ?>