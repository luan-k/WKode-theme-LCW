<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <? wp_head(); ?>
</head>
<?php
// Get the site name from WordPress settings
$site_name = get_bloginfo('name');

// Generate the alt text for the logo image
$logo_alt = sprintf('%s logo', $site_name);
?>
<body <?php body_class(); ?> >
	<div class="wraper" >
    <header class="wkode-header">
      <div class="wkode-header__nav wkode-header__nav--top">
        <div class="wkode-header__logo-wraper">
					<a class="" href="<?php echo esc_url(site_url()); ?>">
						<img class="logo" src="<?php echo get_theme_file_uri('/assets/img/svg/lcw-light.svg')?>" alt="<?php echo $logo_alt; ?>">
					</a>
				</div>
        <nav class="wkode-header__icons-wrapper">
          <a target="_blank" class="wkode-header__social-media-icon" href="#" style="background-image: url(<?php echo get_theme_file_uri('/assets/img/svg/linkedin-logo.svg'); ?>);">
          </a>
          <a target="_blank" class="wkode-header__social-media-icon" href="#" style="background-image: url(<?php echo get_theme_file_uri('/assets/img/svg/facebook-logo.svg'); ?>);">
          </a>
          <a target="_blank" class="wkode-header__social-media-icon" href="#" style="background-image: url(<?php echo get_theme_file_uri('/assets/img/svg/youtube-logo.svg'); ?>);">
          </a>
          <a target="_blank" class="wkode-header__social-media-icon" href="#" style="background-image: url(<?php echo get_theme_file_uri('/assets/img/svg/instagram-logo.svg'); ?>);">
          </a>
        </nav>
      </div>
      <div class="wkode-header__nav" id="navbarNavAltMarkup">
        <?php 
        wp_nav_menu(
          array(
						'theme_location'    => 'main_menu',
						'container'         => 'nav',
						'container_class'   => 'wkode-header__menu-container',
						'menu_class'        => 'nav navbar-nav',
				  )
        );
        ?>
         <a href="<?php echo esc_url(site_url('/search')); ?>" class="search-trigger js-search-trigger nav-item nav-link text-3xl"><i class="fa fa-search" aria-hidden="true"></i></a>
        <div class="menu-hover-line"></div>

      </div>
      <!-- <div class="wkode-header__megamenu">
        <ul class="megamenu__menu-wrapper">
          <li class="megamenu__parent">
            <a href="" class="">street</a>
            <ul class="megamenu__child">
              <li class="">
                <a href="" class="">City</a>
              </li>
              <li class="">
                <a href="" class="">Scooter</a>
              </li>
              <li class="">
                <a href="" class="">Naked</a>
                <ul class="">
                  <li class="">
                    <a href="" class="">CB 500 Twister</a>
                  </li>
                  <li class="">
                    <a href="" class="">CB 500 F</a>
                  </li>
                  <li class="">
                    <a href="" class="">CB 650R</a>
                  </li>
                  <li class="">
                    <a href="" class="">CB 1000R</a>
                  </li>
                  <li class="">
                    <a href="" class="">CB 1000R Black Edition</a>
                  </li>
                </ul>
              </li>
              
            </ul>
          </li>
        </ul>
      </div> -->
    </header>