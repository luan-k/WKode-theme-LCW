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
			'menu_icon'           => 'dashicons-star-filled',
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
			'menu_icon'           => 'dashicons-star-half',
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
			'menu_icon'           => 'dashicons-archive',
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
			'taxonomies' => array( 'produto_acessorios_diversos' ),
			'capability_type'     => 'post',
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail',  'revisions', 'custom-fields', ),

        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_products_posttype' );

function create_products_taxonomy_acessorios_diversos() {

    $labels = array(
        'name'                       => _x( 'Acessórios Diversos', 'Taxonomy General Name', 'acessorios-diversos' ),
        'singular_name'              => _x( 'Acessório', 'Taxonomy Singular Name', 'acessorios-diversos' ),
        'menu_name'                  => __( 'Acessórios Diversos', 'acessorios-diversos' ),
        'all_items'                  => __( 'Todos os Acessórios', 'acessorios-diversos' ),
        'parent_item'                => __( 'Acessórios Parente', 'acessorios-diversos' ),
        'parent_item_colon'          => __( 'Acessórios Parente:', 'acessorios-diversos' ),
        'new_item_name'              => __( 'Novo Item', 'acessorios-diversos' ),
        'add_new_item'               => __( 'Adicionar novo Item', 'acessorios-diversos' ),
        'edit_item'                  => __( 'Editar Item', 'acessorios-diversos' ),
        'update_item'                => __( 'Update Item', 'acessorios-diversos' ),
        'view_item'                  => __( 'Ver Item', 'acessorios-diversos' ),
        'separate_items_with_commas' => __( 'Separar Items com virgulas', 'acessorios-diversos' ),
        'add_or_remove_items'        => __( 'Adiconar ou Remover Items', 'acessorios-diversos' ),
        'choose_from_most_used'      => __( 'Escolher os Mais Usados', 'acessorios-diversos' ),
        'popular_items'              => __( 'Items Populares', 'acessorios-diversos' ),
        'search_items'               => __( 'Procurar Items', 'acessorios-diversos' ),
        'not_found'                  => __( 'Não Encontrado', 'acessorios-diversos' ),
        'no_terms'                   => __( 'Nenhum Item', 'acessorios-diversos' ),
        'items_list'                 => __( 'Lista de Items', 'acessorios-diversos' ),
        'items_list_navigation'      => __( 'Navegação de items de lista ', 'acessorios-diversos' ),
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
    register_taxonomy( 'produto_acessorios_diversos', array( 'produtos' ), $args );

}
add_action( 'init', 'create_products_taxonomy_acessorios_diversos', 0 );

function create_products_taxonomy_roupas_equipamentos() {

    $labels = array(
        'name'                       => _x( 'Roupas e Equipamentos', 'Taxonomy General Name', 'roupas-equipamentos' ),
        'singular_name'              => _x( 'Equipamento', 'Taxonomy Singular Name', 'roupas-equipamentos' ),
        'menu_name'                  => __( 'Roupas e Equipamentos', 'roupas-equipamentos' ),
        'all_items'                  => __( 'Todos os Equipamentos', 'roupas-equipamentos' ),
        'parent_item'                => __( 'Equipamentos Parente', 'roupas-equipamentos' ),
        'parent_item_colon'          => __( 'Equipamentos Parente:', 'roupas-equipamentos' ),
        'new_item_name'              => __( 'Novo Item', 'roupas-equipamentos' ),
        'add_new_item'               => __( 'Adicionar novo Item', 'roupas-equipamentos' ),
        'edit_item'                  => __( 'Editar Item', 'roupas-equipamentos' ),
        'update_item'                => __( 'Update Item', 'roupas-equipamentos' ),
        'view_item'                  => __( 'Ver Item', 'roupas-equipamentos' ),
        'separate_items_with_commas' => __( 'Separar Items com virgulas', 'roupas-equipamentos' ),
        'add_or_remove_items'        => __( 'Adiconar ou Remover Items', 'roupas-equipamentos' ),
        'choose_from_most_used'      => __( 'Escolher os Mais Usados', 'roupas-equipamentos' ),
        'popular_items'              => __( 'Items Populares', 'roupas-equipamentos' ),
        'search_items'               => __( 'Procurar Items', 'roupas-equipamentos' ),
        'not_found'                  => __( 'Não Encontrado', 'roupas-equipamentos' ),
        'no_terms'                   => __( 'Nenhum Item', 'roupas-equipamentos' ),
        'items_list'                 => __( 'Lista de Items', 'roupas-equipamentos' ),
        'items_list_navigation'      => __( 'Navegação de items de lista ', 'roupas-equipamentos' ),
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
    register_taxonomy( 'produto_roupas_equipamentos', array( 'produtos' ), $args );

}
add_action( 'init', 'create_products_taxonomy_roupas_equipamentos', 0 );

function create_products_taxonomy_capacetes() {

    $labels = array(
        'name'                       => _x( 'Capacetes', 'Taxonomy General Name', 'capacetes' ),
        'singular_name'              => _x( 'Capacete', 'Taxonomy Singular Name', 'capacetes' ),
        'menu_name'                  => __( 'Capacetes', 'capacetes' ),
        'all_items'                  => __( 'Todos os Capacetes', 'capacetes' ),
        'parent_item'                => __( 'Capacetes Parente', 'capacetes' ),
        'parent_item_colon'          => __( 'Capacetes Parente:', 'capacetes' ),
        'new_item_name'              => __( 'Novo Capacete', 'capacetes' ),
        'add_new_item'               => __( 'Adicionar novo Capacete', 'capacetes' ),
        'edit_item'                  => __( 'Editar Capacete', 'capacetes' ),
        'update_item'                => __( 'Update Capacete', 'capacetes' ),
        'view_item'                  => __( 'Ver Capacete', 'capacetes' ),
        'separate_items_with_commas' => __( 'Separar Capacetes com virgulas', 'capacetes' ),
        'add_or_remove_items'        => __( 'Adiconar ou Remover Capacetes', 'capacetes' ),
        'choose_from_most_used'      => __( 'Escolher os Mais Usados', 'capacetes' ),
        'popular_items'              => __( 'Capacetes Populares', 'capacetes' ),
        'search_items'               => __( 'Procurar Capacetes', 'capacetes' ),
        'not_found'                  => __( 'Não Encontrado', 'capacetes' ),
        'no_terms'                   => __( 'Nenhum Capacete', 'capacetes' ),
        'items_list'                 => __( 'Lista de Capacetes', 'capacetes' ),
        'items_list_navigation'      => __( 'Navegação de items de lista ', 'capacetes' ),
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
    register_taxonomy( 'produto_capacetes', array( 'produtos' ), $args );

}
add_action( 'init', 'create_products_taxonomy_capacetes', 0 );






// Post type Services
function create_services_posttype() {

    register_post_type( 'servicos',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Serviços' ),
                'singular_name' => __( 'Serviço' )
            ),
            'public'              => true,
			'menu_icon'           => 'dashicons-admin-tools',
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







// Post type Electrics
function create_electrics_posttype() {

    register_post_type( 'eletricos',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Elétricos' ),
                'singular_name' => __( 'Elétrico' )
            ),
            'public'              => true,
			'menu_icon'           => 'dashicons-admin-plugins',
            'has_archive'         => true,
            'rewrite'             => array('slug' => 'eletricos'),
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
add_action( 'init', 'create_electrics_posttype' );
?>