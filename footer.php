        <footer id="footer" class="wkode-footer">
          <?php

          ?>
          <div class="wkode-footer__wrapper grid grid-cols-1 md:grid-cols-12 gap-14">
            <?php
            wp_nav_menu(
              array(
                'theme_location'    => 'footer_menu_1',
                'container'         => 'wkode-footer__nav-1',
                'container_class'   => 'wkode-footer__menu-container-1',
                'menu_class'        => 'wkode-footer__menu-class wkode-footer__menu-class-1',
              )
            );
            wp_nav_menu(
              array(
                'theme_location'    => 'footer_menu_2',
                'container'         => 'wkode-footer__nav-2',
                'container_class'   => 'wkode-footer__menu-container-2',
                'menu_class'        => 'wkode-footer__menu-class wkode-footer__menu-class-2',
              )
            );
            ?>
            <div class="wkode-footer__menu-class wkode-footer__menu-class-3">
              <h3 class="wkode-footer__menu-class-title">
                Redes Sociais
              </h3>
              <nav class="wkode-header__icons-wrapper sub-menu mb-6">
                <a target="_blank" class="wkode-header__social-media-icon" href="#" style="background-image: url(<?php echo get_theme_file_uri('/assets/img/svg/linkedin-logo-footer.svg'); ?>);">
                </a>
                <a target="_blank" class="wkode-header__social-media-icon" href="https://www.facebook.com/LCWMotos" style="background-image: url(<?php echo get_theme_file_uri('/assets/img/svg/facebook-logo-footer.svg'); ?>);">
                </a>
                <a target="_blank" class="wkode-header__social-media-icon" href="#" style="background-image: url(<?php echo get_theme_file_uri('/assets/img/svg/youtube-logo-footer.svg'); ?>);">
                </a>
                <a target="_blank" class="wkode-header__social-media-icon" href="https://www.instagram.com/lcwmotos/" style="background-image: url(<?php echo get_theme_file_uri('/assets/img/svg/instagram-logo-footer.svg'); ?>);">
                </a>
              </nav>
              <div class="wkode-footer__logo-wrapper">
                <a class="" href="<?php echo esc_url(site_url()); ?>">
                  <img class="logo" src="<?php echo get_theme_file_uri('/assets/img/svg/lcw-dark.svg')?>" alt="<?php  ?>">
                </a>
              </div>
            </div>
          </div>
          <hr class="wkode-footer__horizontal-footer">
          <div class="wkode-footer__logo container">
            <h5>LCW Motos © <?php echo date("Y"); ?> - Todos os direitos reservados. </h5>
            <img class="logo" src="<?php echo get_theme_file_uri('/assets/img/svg/wkode-logo-footer.svg')?>" alt="<?php  ?>">
          </div>
        </footer>
      <?php wp_footer() ?>

    </div>
  </body>
</html>