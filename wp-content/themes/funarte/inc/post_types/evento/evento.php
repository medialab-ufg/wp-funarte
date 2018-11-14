<?php
namespace funarte;

class Evento {
	use PostType;

	protected function init() {
		add_action('init', array( &$this, "register_post_type" ));
		add_action('init', array( &$this, "register_taxonomy" ));
	}

	public function register_post_type() {
		$POST_TYPE = "evento";
		$POST_TYPE_NAME_PLURAL = "Eventos";
		$POST_TYPE_NAME_SINGULAR = "Evento";

		$post_type_labels = array(
			'edit_item' => 'Editar',
			'add_new' => 'Adicionar Novo',
			'search_items' => 'Pesquisar',
			'name' => $POST_TYPE_NAME_PLURAL,
			'menu_name' => $POST_TYPE_NAME_PLURAL,
			'singular_name' => $POST_TYPE_NAME_SINGULAR,
			'new_item' => 'Novo ' . $POST_TYPE_NAME_PLURAL,
			'view_item' => 'Visualizar ' . $POST_TYPE_NAME_PLURAL,
			'add_new_item' =>'Adicionar ' . $POST_TYPE_NAME_PLURAL,
			'parent_item_colon' => $POST_TYPE_NAME_PLURAL . ' acima:',
			'not_found' => 'Nenhum ' . $POST_TYPE_NAME_PLURAL . ' encontrado',
			'not_found_in_trash' => 'Nenhum ' . $POST_TYPE_NAME_PLURAL . ' encontrado na lixeira'
		);
		$post_type_args = array(
			'labels' => $post_type_labels,
			'public' => true,
			'show_ui' => true,
			'rewrite' => true,
			'query_var' => true,
			'can_export' => true,
			'has_archive' => true,
			'show_in_menu' => true,
			'capability_type' => 'post',
			'show_in_nav_menus' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => true
		);

		register_post_type($POST_TYPE, $post_type_args);
	}

	function register_taxonomy() {
        $labels = array(
            'name' =>'Categorias de regionais',
            'singular_name' => 'Categorias de regionais',
            'search_items' => 'Buscar Categorias de regionais',
            'all_items' => 'Todas as Categorias de regionais',
            'parent_item' => 'Categorias de regionais Acima',
            'parent_item_colon' => 'Categorias de regionais Acima:',
            'edit_item' => 'Editar Categorias de regionais',
            'update_item' => 'Atualizar Categorias de regionais',
            'add_new_item' => 'Adicionar Nova Categorias de regionais',
            'new_item_name' => 'Novo nome de Categorias de regionais',
        );
        register_taxonomy(
            "regionais",
            "evento",
            array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => false
            )
        );
    }
}

Evento::get_instance();