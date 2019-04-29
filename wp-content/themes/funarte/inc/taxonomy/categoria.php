<?php
namespace funarte;

class taxCategoria {
	use Singleton;

	private $name = 'category';
	public function get_name() {
		return $this->name;
	}

	protected function init() {
		// add_action('init', array( &$this, "register_taxonomy" ), 9);
	}

	public function register_taxonomy() {
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
			$this->name,
			["post", "page"],
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

taxCategoria::get_instance();