<?php

if ( ! function_exists( 'wkode_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wkode_theme_setup() {
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'custom-logo' );

		/**
		 * Specify Image Sizes
		 */
		update_option( 'thumbnail_size_w', 70 );
		update_option( 'thumbnail_size_h', 80 );
		update_option( 'thumbnail_crop', 1 );

		update_option( 'medium_size_w', 360 );
		update_option( 'medium_size_h', 300 );

		update_option( 'large_size_w', 750 );
		update_option( 'large_size_h', 540 );

		add_image_size( 'slider', 1910, 800, true, array( 'center', 'center' ) );
		add_image_size( 'slider_mobile', 1080, 1080, true, array( 'center', 'center' ) );

		add_image_size( 'wkode_main_block', 1080, 550, true, array( 'center', 'center' ) );
		add_image_size( 'wkode_main_block_mobile', 1200, 1200, true, array( 'center', 'center' ) );

		add_image_size( 'motos_seminovas_card', 397, 350, true, array( 'center', 'center' ) );

		add_image_size( 'products_card', 250, 250, true, array( 'center', 'center' ) );

		add_image_size( 'wkode_main_block_card_overlay', 1115, 830, true, array( 'center', 'center' ) );

		add_image_size( 'single_page_featured_image', 1870, 752, true, array( 'center', 'center' ) );

		add_image_size( 'wkode_single_new_bikes', 1870, 1248, true, array( 'center', 'center' ) );

		add_image_size( 'wkode_single_image_blocks', 640, 313, true, array( 'center', 'center' ) );

		add_image_size( 'wkode_single_image_standart_block', 640, 501, true, array( 'center', 'center' ) );

		add_image_size( 'wkode_single_new_slide_bg', 1920, 768, true, array( 'center', 'center' ) );

		add_image_size( 'wkode_new_bikes_single__gallery_two_cols', 275, 458, true, array( 'center', 'center' ) );
		add_image_size( 'wkode_new_bikes_single__gallery_six_cols', 845, 458, true, array( 'center', 'center' ) );
		add_image_size( 'wkode_new_bikes_single__gallery_four_cols', 560, 458, true, array( 'center', 'center' ) );
		add_image_size( 'wkode_new_bikes_single__gallery_one_by_one', 768, 768, true, array( 'center', 'center' ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'wkode_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		register_nav_menus(
			array(
				'main_menu' 	=> 'Main Menu',
				'footer_menu_1' => 'Footer Menu 1',
				'footer_menu_2' => 'Footer Menu 2'
			)
		);

		// Remove post format
		remove_theme_support( 'post-formats' );

		// declare support for woocommerce
		add_theme_support( 'woocommerce' );

	}
endif; // wkode_theme_setup
add_action( 'after_setup_theme', 'wkode_theme_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function wkode_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wkode' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wkode_widgets_init' );


function my_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'my_excerpt_length' );

if ( function_exists( 'acf_register_block_type' ) ) {

	add_action(
		'acf/init',
		function () {

			// Register new block category.
			add_filter( 'block_categories_all', 'register_block_categories', 10, 1 );

			/**
			 * Register category for blocks
			 *
			 * @param $categories
			 *
			 * @return array
			 */
			function register_block_categories( $categories ) {
				return array_merge(
					array(
						array(
							'slug'  => 'wkode',
							'title' => __( 'WKode', 'wkode' ),
						),
					),
					$categories
				);
			}

			acf_register_block_type(
				array(
					'name'            => 'wkode-slider',
					'title'           => __( 'WKode Slider' ),
					'description'     => __( 'Um block de slider para o tema padrão Wkode' ),
					'render_template' => 'template-parts/blocks/posts/wkode-slider.php',
					'category'        => 'wkode',
					'icon'            => 'slides',
					'supports'        => array(
						'multiple' => false, // prevent block from being added more than once on a page
					),
					'validation_callback' => 'my_wkode_slider_block_validation', // add custom validation function
					'keywords'        => array( 'wkode slider', 'wkode', 'slider', 'carousel', 'carrossel', 'carrocel', 'home', 'hero' ),
					'example'  => array(
						'attributes' => array(
							'mode' => 'preview',
							'data' => array(
								'preview' => '/template-parts/blocks/preview/wkode-slider.png',
							)
						)
					)
				)
			);
			function my_wkode_slider_block_validation($block, $content = '', $is_preview = false, $post_id = 0) {
				if (is_admin()) {
					global $post;
					$blocks = parse_blocks($post->post_content);

					// count how many times this block is present on the page
					$count = 0;
					foreach ($blocks as $block_item) {
						if ($block_item['blockName'] === $block['name']) {
							$count++;
						}
					}

					// if the block is already present once, prevent it from being added again
					if ($count >= 1) {
						return false;
					}
				}

				return $block;
			}
			acf_register_block_type(
				array(
					'name'            => 'wkode-main-block',
					'title'           => __( 'Moto nova bloco' ),
					'description'     => __( 'Um bloco primariamente feito para colocar a nova moto na home page. Mas pode ser usado para vários propósitos.' ),
					'render_template' => 'template-parts/blocks/posts/wkode-main-block.php',
					'category'        => 'wkode',
					'icon'            => 'align-pull-right',
					'keywords'        => array( 'wkode Bloco principal', 'wkode', 'Principal', 'Moto', 'nova', 'moto nova', 'home' ),
					'example'  => array(
						'attributes' => array(
							'mode' => 'preview',
							'data' => array(
								'preview' => '/template-parts/blocks/preview/wkode-main-block.png',
							)
						)
					)
				)
			);
			acf_register_block_type(
				array(
					'name'            => 'wkode-new-bikes-block',
					'title'           => __( 'Motos novas carrocel bloco' ),
					'description'     => __( 'O bloco principal usado para mostrar as novas motos em um carrocel' ),
					'render_template' => 'template-parts/blocks/posts/wkode-new-bikes.php',
					'category'        => 'wkode',
					'icon'            => 'align-pull-right',
					'keywords'        => array( 'wkode Bloco principal', 'wkode', 'Principal', 'Moto', 'nova', 'moto nova', 'home', 'carrocel' ),
					/* 'example'  => array(
						'attributes' => array(
							'mode' => 'preview',
							'data' => array(
								'preview' => '/template-parts/blocks/preview/wkode-main-block.png',
							)
						)
					) */
				)
			);
			acf_register_block_type(
				array(
					'name'            => 'wkode-used-bikes-block',
					'title'           => __( 'Motos seminovas carrocel bloco' ),
					'description'     => __( 'O bloco principal usado para mostrar as motos seminovas em um carrocel' ),
					'render_template' => 'template-parts/blocks/posts/wkode-used-bikes.php',
					'category'        => 'wkode',
					'icon'            => 'align-pull-right',
					'keywords'        => array( 'wkode Bloco principal', 'wkode', 'Principal', 'Moto', 'seminova', 'moto seminova', 'home', 'carrocel' ),
					/* 'example'  => array(
						'attributes' => array(
							'mode' => 'preview',
							'data' => array(
								'preview' => '/template-parts/blocks/preview/wkode-main-block.png',
							)
						)
					) */
				)
			);
			acf_register_block_type(
				array(
					'name'            => 'wkode-multiple-image-consorcio-block',
					'title'           => __( 'Bloco multiplas Images de consórcio' ),
					'description'     => __( 'Um bloco com múltiplas imagens primariamente feito para o consórcio na home page. Mas pode ser usado para vários propósitos.' ),
					'render_template' => 'template-parts/blocks/posts/wkode-multiple-image-consorcio-block.php',
					'category'        => 'wkode',
					'icon'            => 'align-pull-right',
					'keywords'        => array( 'wkode Bloco principal', 'Imagens', 'wkode', 'Principal', 'Moto', 'nova', 'moto nova', 'home' ),
					/* 'example'  => array(
						'attributes' => array(
							'mode' => 'preview',
							'data' => array(
								'preview' => '/template-parts/blocks/preview/wkode-multiple-image-consorcio-block.png',
							)
						)
					) */
				)
			);
			acf_register_block_type(
				array(
					'name'            => 'wkode-products',
					'title'           => __( 'Produtos' ),
					'description'     => __( 'Bloco usado para mostrar produtos na home page' ),
					'render_template' => 'template-parts/blocks/posts/wkode-products.php',
					'category'        => 'wkode',
					'icon'            => 'align-pull-right',
					'keywords'        => array( 'wkode Bloco principal', 'wkode', 'Principal', 'acessorio', 'produto', 'moto seminova', 'home', 'carrocel' ),
					/* 'example'  => array(
						'attributes' => array(
							'mode' => 'preview',
							'data' => array(
								'preview' => '/template-parts/blocks/preview/wkode-main-block.png',
							)
						)
					) */
				)
			);
			acf_register_block_type(
				array(
					'name'            => 'wkode-main-block-card-revisao-geral',
					'title'           => __( 'Revisão Geral' ),
					'description'     => __( 'Bloco usado para mostrar os serviços' ),
					'render_template' => 'template-parts/blocks/posts/wkode-main-block-card-revisao-geral.php',
					'category'        => 'wkode',
					'icon'            => 'align-pull-right',
					'keywords'        => array( 'wkode Bloco principal', 'wkode', 'Principal', 'Revisão Geral'),
					/* 'example'  => array(
						'attributes' => array(
							'mode' => 'preview',
							'data' => array(
								'preview' => '/template-parts/blocks/preview/wkode-main-block.png',
							)
						)
					) */
				)
			);
		}
	);
}
