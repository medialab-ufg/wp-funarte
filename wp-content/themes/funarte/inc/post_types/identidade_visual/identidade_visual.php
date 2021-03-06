<?php
namespace funarte;

class IdentidadeVisual {
	use Singleton;

	private $POST_TYPE = "identidade-visual";

	protected function init() {
		add_action('init', array( &$this, "register_post_type" ));
		add_action('init', array( &$this, "register_taxonomy" ));
	}

	public function register_post_type() {
		$POST_TYPE_NAME_PLURAL = "Identidades Visuais";
		$POST_TYPE_NAME_SINGULAR = "Identidade Visual";

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
			'exclude_from_search' => false,
			'supports' => array('title', 'editor', 'revisions'),
			'taxonomies' => [
				taxTag::get_instance()->get_name(),
				taxIdentidadeVisual::get_instance()->get_name()
			]
		);

		register_post_type($this->POST_TYPE, $post_type_args);
	}

	public function register_taxonomy() {
		
	}

}

IdentidadeVisual::get_instance();