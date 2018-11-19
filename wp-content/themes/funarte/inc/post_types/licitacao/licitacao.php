<?php
namespace funarte;

class Licitacao {
	use PostType;

	private $POST_TYPE = "licitacao";

	protected function init() {
		add_action('init', array( &$this, "register_post_type" ));
		add_action('init', array( &$this, "register_taxonomy" ));
	}

	public function register_post_type() {
		$POST_TYPE_NAME_PLURAL = "Licitações";
		$POST_TYPE_NAME_SINGULAR = "Licitação";

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

		register_post_type($this->POST_TYPE, $post_type_args);
	}

	public function register_taxonomy() {
		$this->register_taxonomy_tag();
		$this->register_taxonomy_modalidade_licitacao();
	}

	private function register_taxonomy_tag() {
		$labels = array(
			'name' =>'TAG',
			'singular_name' => 'TAGS',
			'search_items' => 'Buscar TAG',
			'all_items' => 'Todas as TAGS',
			'parent_item' => 'TAG',
			'parent_item_colon' => 'TAG Acima:',
			'edit_item' => 'Editar TAG',
			'update_item' => 'Atualizar TAG',
			'add_new_item' => 'Adicionar Nova TAG',
			'new_item_name' => 'Novo nome de TAG',
		);
		register_taxonomy(
			"post_tag",
			$this->POST_TYPE,
			array(
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => false
			)
		);
	}

	private function register_taxonomy_modalidade_licitacao() {
		$labels = array(
			'name' =>'Modalidade de licitações',
			'singular_name' => 'Modalidade de licitação',
			'search_items' => 'Buscar Modalidade de licitações',
			'all_items' => 'Todas as Modalidades de licitações',
			'parent_item' => 'Modalidade de licitações',
			'parent_item_colon' => 'Modalidade de licitação Acima:',
			'edit_item' => 'Editar Modalidade de licitação',
			'update_item' => 'Atualizar Modalidade de licitação',
			'add_new_item' => 'Adicionar Nova Modalidade de licitação',
			'new_item_name' => 'Novo nome de Modalidade de licitação',
		);
		register_taxonomy(
			"modalidade",
			$this->POST_TYPE,
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

Licitacao::get_instance();