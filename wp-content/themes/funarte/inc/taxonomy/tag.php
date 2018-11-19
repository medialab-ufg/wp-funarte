<?php
namespace funarte;

class taxTag {
	use Singleton;

	private $name = 'post_tag';
	public function get_name() {
		return $this->name;
	}

	protected function init() {
		add_action('init', array( &$this, "register_taxonomy" ), 9);
	}

	public function register_taxonomy() {
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
			$this->name,
			"post",
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

taxTag::get_instance();