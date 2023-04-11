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

		}
	);
}
// Our custom post type function
function create_posttype() {

    register_post_type( 'motos-novas',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Motos Novas' ),
                'singular_name' => __( 'Motos Novas' )
            ),
            'public'              => true,
			'menu_icon'           => 'dashicons-media-default',
            'has_archive'         => true,
            'rewrite'             => array('slug' => 'motos-novas'),
            'show_in_rest'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'taxonomies' => array( 'moto_nova_categoria' ),
			'capability_type'     => 'post',
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail',  'revisions', 'custom-fields', ),

        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

function create_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Nome da Categoria', 'Taxonomy General Name', 'moto-nova-categoria' ),
        'singular_name'              => _x( 'Categoria', 'Taxonomy Singular Name', 'moto-nova-categoria' ),
        'menu_name'                  => __( 'Nome Categoria', 'moto-nova-categoria' ),
        'all_items'                  => __( 'Todas as Categorias', 'moto-nova-categoria' ),
        'parent_item'                => __( 'Categoria Parente', 'moto-nova-categoria' ),
        'parent_item_colon'          => __( 'Categoria Parente:', 'moto-nova-categoria' ),
        'new_item_name'              => __( 'Novo Item', 'moto-nova-categoria' ),
        'add_new_item'               => __( 'Adicionar novo Item', 'moto-nova-categoria' ),
        'edit_item'                  => __( 'Editar Item', 'moto-nova-categoria' ),
        'update_item'                => __( 'Update Item', 'moto-nova-categoria' ),
        'view_item'                  => __( 'Ver Item', 'moto-nova-categoria' ),
        'separate_items_with_commas' => __( 'Separar Items com virgulas', 'moto-nova-categoria' ),
        'add_or_remove_items'        => __( 'Adiconar ou Remover Items', 'moto-nova-categoria' ),
        'choose_from_most_used'      => __( 'Escolher os Mais Usados', 'moto-nova-categoria' ),
        'popular_items'              => __( 'Items Populares', 'moto-nova-categoria' ),
        'search_items'               => __( 'Procurar Items', 'moto-nova-categoria' ),
        'not_found'                  => __( 'Não Encontrado', 'moto-nova-categoria' ),
        'no_terms'                   => __( 'Nenhum Item', 'moto-nova-categoria' ),
        'items_list'                 => __( 'Lista de Items', 'moto-nova-categoria' ),
        'items_list_navigation'      => __( 'Navegação de items de lista ', 'moto-nova-categoria' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
		'show_in_rest'               => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'moto_nova_categoria', array( 'motos-novas' ), $args );

}
add_action( 'init', 'create_taxonomy', 0 );

/* function create_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Taxonomy Name', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Taxonomy Singular Name', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Taxonomy Name', 'text_domain' ),
        'all_items'                  => __( 'All Items', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'New Item Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Item', 'text_domain' ),
        'edit_item'                  => __( 'Edit Item', 'text_domain' ),
        'update_item'                => __( 'Update Item', 'text_domain' ),
        'view_item'                  => __( 'View Item', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Items', 'text_domain' ),
        'search_items'               => __( 'Search Items', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No items', 'text_domain' ),
        'items_list'                 => __( 'Items list', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'taxonomy_name', array( 'motos-novas' ), $args );

}
add_action( 'init', 'create_taxonomy', 0 ); */