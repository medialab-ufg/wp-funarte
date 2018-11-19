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

	public function register_taxonomy() {
		$this->register_taxonomy_tag();
		$this->register_taxonomy_regionais();
		$this->register_taxonomy_categorias();
		$this->register_taxonomy_categorias_edital();
		$this->register_taxonomy_categorias_espacos_culturais();
	}

	private function register_taxonomy_regionais() {
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

	private function register_taxonomy_categorias() {
		$labels = array(
			'name' =>'Categorias',
			'singular_name' => 'Categoria',
			'search_items' => 'Buscar Categoria',
			'all_items' => 'Todas as Categorias',
			'parent_item' => 'Categoria',
			'parent_item_colon' => 'Categoria Acima:',
			'edit_item' => 'Editar Categoria',
			'update_item' => 'Atualizar Categoria',
			'add_new_item' => 'Adicionar Novo Categoria',
			'new_item_name' => 'Novo nome da Categoria',
		);
		register_taxonomy(
			"category",
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

	private function register_taxonomy_categorias_edital() {
		$labels = array(
			'name' =>'Editais',
			'singular_name' => 'Edital',
			'search_items' => 'Buscar Edital',
			'all_items' => 'Todas as Editais',
			'parent_item' => 'Edital',
			'parent_item_colon' => 'Edital Acima:',
			'edit_item' => 'Editar Edital',
			'update_item' => 'Atualizar Edital',
			'add_new_item' => 'Adicionar Novo Edital',
			'new_item_name' => 'Novo nome do Edital',
		);
		register_taxonomy_for_object_type( 'editais', 'evento' );
		// register_taxonomy(
		// 	"editais",
		// 	"evento",
		// 	array(
		// 		'hierarchical' => true,
		// 		'labels' => $labels,
		// 		'show_ui' => true,
		// 		'query_var' => true,
		// 		'rewrite' => false
		// 	)
		// );
	}

	private function register_taxonomy_categorias_espacos_culturais() {
		$labels = array(
			'name' =>'Espaços Culturais',
			'singular_name' => 'Espaço Cultural',
			'search_items' => 'Buscar Espaço Cultural',
			'all_items' => 'Todas as Espaços Culturais',
			'parent_item' => 'Espaço Cultural',
			'parent_item_colon' => 'Espaço Cultural Acima:',
			'edit_item' => 'Editar Espaço Cultural',
			'update_item' => 'Atualizar Espaço Cultural',
			'add_new_item' => 'Adicionar Novo Espaço Cultural',
			'new_item_name' => 'Novo nome do Espaço Cultural',
		);
		register_taxonomy(
			"espacos-culturais",
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