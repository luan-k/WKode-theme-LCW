<?php

// Post type new bikes
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
        'name'                       => _x( 'Modelos', 'Taxonomy General Name', 'moto-nova-categoria' ),
        'singular_name'              => _x( 'Modelo', 'Taxonomy Singular Name', 'moto-nova-categoria' ),
        'menu_name'                  => __( 'Modelos', 'moto-nova-categoria' ),
        'all_items'                  => __( 'Todas os Modelos', 'moto-nova-categoria' ),
        'parent_item'                => __( 'Modelo Parente', 'moto-nova-categoria' ),
        'parent_item_colon'          => __( 'Modelo Parente:', 'moto-nova-categoria' ),
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


// Post type new bikes
function create_used_posttype() {

    register_post_type( 'motos-seminovas',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Motos Seminovas' ),
                'singular_name' => __( 'Moto Seminova' )
            ),
            'public'              => true,
			'menu_icon'           => 'dashicons-media-default',
            'has_archive'         => true,
            'rewrite'             => array('slug' => 'motos-seminovas'),
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
			'taxonomies' => array( 'moto_seminova_categoria' ),
			'capability_type'     => 'post',
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail',  'revisions', 'custom-fields', ),

        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_used_posttype' );

function create_used_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Marcas', 'Taxonomy General Name', 'moto-seminova-categoria' ),
        'singular_name'              => _x( 'Marca', 'Taxonomy Singular Name', 'moto-seminova-categoria' ),
        'menu_name'                  => __( 'Marcas', 'moto-seminova-categoria' ),
        'all_items'                  => __( 'Todas as Marcas', 'moto-seminova-categoria' ),
        'parent_item'                => __( 'Marca Parente', 'moto-seminova-categoria' ),
        'parent_item_colon'          => __( 'Marca Parente:', 'moto-seminova-categoria' ),
        'new_item_name'              => __( 'Novo Item', 'moto-seminova-categoria' ),
        'add_new_item'               => __( 'Adicionar novo Item', 'moto-seminova-categoria' ),
        'edit_item'                  => __( 'Editar Item', 'moto-seminova-categoria' ),
        'update_item'                => __( 'Update Item', 'moto-seminova-categoria' ),
        'view_item'                  => __( 'Ver Item', 'moto-seminova-categoria' ),
        'separate_items_with_commas' => __( 'Separar Items com virgulas', 'moto-seminova-categoria' ),
        'add_or_remove_items'        => __( 'Adiconar ou Remover Items', 'moto-seminova-categoria' ),
        'choose_from_most_used'      => __( 'Escolher os Mais Usados', 'moto-seminova-categoria' ),
        'popular_items'              => __( 'Items Populares', 'moto-seminova-categoria' ),
        'search_items'               => __( 'Procurar Items', 'moto-seminova-categoria' ),
        'not_found'                  => __( 'Não Encontrado', 'moto-seminova-categoria' ),
        'no_terms'                   => __( 'Nenhum Item', 'moto-seminova-categoria' ),
        'items_list'                 => __( 'Lista de Items', 'moto-seminova-categoria' ),
        'items_list_navigation'      => __( 'Navegação de items de lista ', 'moto-seminova-categoria' ),
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
    register_taxonomy( 'moto_seminova_categoria', array( 'motos-seminovas' ), $args );

}
add_action( 'init', 'create_used_taxonomy', 0 );
function create_models_used_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Modelos', 'Taxonomy General Name', 'moto-seminova-modelo' ),
        'singular_name'              => _x( 'Modelo', 'Taxonomy Singular Name', 'moto-seminova-modelo' ),
        'menu_name'                  => __( 'Modelos', 'moto-seminova-modelo' ),
        'all_items'                  => __( 'Todos os Modelos', 'moto-seminova-modelo' ),
        'parent_item'                => __( 'Modelo Parente', 'moto-seminova-modelo' ),
        'parent_item_colon'          => __( 'Modelo Parente:', 'moto-seminova-modelo' ),
        'new_item_name'              => __( 'Novo Item', 'moto-seminova-modelo' ),
        'add_new_item'               => __( 'Adicionar novo Item', 'moto-seminova-modelo' ),
        'edit_item'                  => __( 'Editar Item', 'moto-seminova-modelo' ),
        'update_item'                => __( 'Update Item', 'moto-seminova-modelo' ),
        'view_item'                  => __( 'Ver Item', 'moto-seminova-modelo' ),
        'separate_items_with_commas' => __( 'Separar Items com virgulas', 'moto-seminova-modelo' ),
        'add_or_remove_items'        => __( 'Adiconar ou Remover Items', 'moto-seminova-modelo' ),
        'choose_from_most_used'      => __( 'Escolher os Mais Usados', 'moto-seminova-modelo' ),
        'popular_items'              => __( 'Items Populares', 'moto-seminova-modelo' ),
        'search_items'               => __( 'Procurar Items', 'moto-seminova-modelo' ),
        'not_found'                  => __( 'Não Encontrado', 'moto-seminova-modelo' ),
        'no_terms'                   => __( 'Nenhum Item', 'moto-seminova-modelo' ),
        'items_list'                 => __( 'Lista de Items', 'moto-seminova-modelo' ),
        'items_list_navigation'      => __( 'Navegação de items de lista ', 'moto-seminova-modelo' ),
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
    register_taxonomy( 'moto_seminova_modelo', array( 'motos-seminovas' ), $args );

}
add_action( 'init', 'create_models_used_taxonomy', 0 );

function create_styles_used_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Estilos', 'Taxonomy General Name', 'moto-seminova-estilo' ),
        'singular_name'              => _x( 'Estilo', 'Taxonomy Singular Name', 'moto-seminova-estilo' ),
        'menu_name'                  => __( 'Estilos', 'moto-seminova-estilo' ),
        'all_items'                  => __( 'Todos os Estilos', 'moto-seminova-estilo' ),
        'parent_item'                => __( 'Estilo Parente', 'moto-seminova-estilo' ),
        'parent_item_colon'          => __( 'Estilo Parente:', 'moto-seminova-estilo' ),
        'new_item_name'              => __( 'Novo Item', 'moto-seminova-estilo' ),
        'add_new_item'               => __( 'Adicionar novo Item', 'moto-seminova-estilo' ),
        'edit_item'                  => __( 'Editar Item', 'moto-seminova-estilo' ),
        'update_item'                => __( 'Update Item', 'moto-seminova-estilo' ),
        'view_item'                  => __( 'Ver Item', 'moto-seminova-estilo' ),
        'separate_items_with_commas' => __( 'Separar Items com virgulas', 'moto-seminova-estilo' ),
        'add_or_remove_items'        => __( 'Adiconar ou Remover Items', 'moto-seminova-estilo' ),
        'choose_from_most_used'      => __( 'Escolher os Mais Usados', 'moto-seminova-estilo' ),
        'popular_items'              => __( 'Items Populares', 'moto-seminova-estilo' ),
        'search_items'               => __( 'Procurar Items', 'moto-seminova-estilo' ),
        'not_found'                  => __( 'Não Encontrado', 'moto-seminova-estilo' ),
        'no_terms'                   => __( 'Nenhum Item', 'moto-seminova-estilo' ),
        'items_list'                 => __( 'Lista de Items', 'moto-seminova-estilo' ),
        'items_list_navigation'      => __( 'Navegação de items de lista ', 'moto-seminova-estilo' ),
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
    register_taxonomy( 'moto_seminova_estilos', array( 'motos-seminovas' ), $args );

}
add_action( 'init', 'create_styles_used_taxonomy', 0 );


// Post type Products
function create_products_posttype() {

    register_post_type( 'produtos',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Produtos' ),
                'singular_name' => __( 'Produto' )
            ),
            'public'              => true,
			'menu_icon'           => 'dashicons-media-default',
            'has_archive'         => true,
            'rewrite'             => array('slug' => 'produtos'),
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
			'taxonomies' => array( 'categoria_produto' ),
			'capability_type'     => 'post',
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail',  'revisions', 'custom-fields', ),

        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_products_posttype' );

function create_products_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Categoria de Produtos', 'Taxonomy General Name', 'categoria-produto' ),
        'singular_name'              => _x( 'Categoria', 'Taxonomy Singular Name', 'categoria-produto' ),
        'menu_name'                  => __( 'Modelos', 'categoria-produto' ),
        'all_items'                  => __( 'Todas as Categorias', 'categoria-produto' ),
        'parent_item'                => __( 'Categoria Parente', 'categoria-produto' ),
        'parent_item_colon'          => __( 'Categoria Parente:', 'categoria-produto' ),
        'new_item_name'              => __( 'Novo Item', 'categoria-produto' ),
        'add_new_item'               => __( 'Adicionar novo Item', 'categoria-produto' ),
        'edit_item'                  => __( 'Editar Item', 'categoria-produto' ),
        'update_item'                => __( 'Update Item', 'categoria-produto' ),
        'view_item'                  => __( 'Ver Item', 'categoria-produto' ),
        'separate_items_with_commas' => __( 'Separar Items com virgulas', 'categoria-produto' ),
        'add_or_remove_items'        => __( 'Adiconar ou Remover Items', 'categoria-produto' ),
        'choose_from_most_used'      => __( 'Escolher os Mais Usados', 'categoria-produto' ),
        'popular_items'              => __( 'Items Populares', 'categoria-produto' ),
        'search_items'               => __( 'Procurar Items', 'categoria-produto' ),
        'not_found'                  => __( 'Não Encontrado', 'categoria-produto' ),
        'no_terms'                   => __( 'Nenhum Item', 'categoria-produto' ),
        'items_list'                 => __( 'Lista de Items', 'categoria-produto' ),
        'items_list_navigation'      => __( 'Navegação de items de lista ', 'categoria-produto' ),
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
    register_taxonomy( 'categoria_produto', array( 'produtos' ), $args );

}
add_action( 'init', 'create_products_taxonomy', 0 );






// Post type Products
function create_services_posttype() {

    register_post_type( 'servicos',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Serviços' ),
                'singular_name' => __( 'Serviço' )
            ),
            'public'              => true,
			'menu_icon'           => 'dashicons-media-default',
            'has_archive'         => true,
            'rewrite'             => array('slug' => 'servicos'),
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
			//'taxonomies' => array( 'categoria_produto' ),
			'capability_type'     => 'post',
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail',  'revisions', 'custom-fields', ),

        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_services_posttype' );

?>