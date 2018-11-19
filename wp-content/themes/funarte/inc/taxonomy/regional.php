<?php
namespace funarte;

class taxRegional {
	use Singleton;

	private $name = 'regionais';
	public function get_name() {
		return $this->name;
	}

	protected function init() {
		add_action('init', array( &$this, "register_taxonomy" ), 9);
	}

	public function register_taxonomy() {
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

taxRegional::get_instance();

