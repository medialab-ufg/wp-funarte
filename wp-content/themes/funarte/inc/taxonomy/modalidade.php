<?php
namespace funarte;

class taxModalidade {
	use Singleton;

	private $name = 'modalidade';
	public function get_name() {
		return $this->name;
	}

	protected function init() {
		add_action('init', array( &$this, "register_taxonomy" ), 9);
	}

	public function register_taxonomy() {
		$labels = array(
			'name' =>'Modalidades',
			'singular_name' => 'Modalidade',
			'search_items' => 'Buscar Modalidade',
			'all_items' => 'Todas as Modalidade',
			'parent_item' => 'Modalidade',
			'parent_item_colon' => 'Modalidade Acima:',
			'edit_item' => 'Editar Modalidade',
			'update_item' => 'Atualizar Modalidade',
			'add_new_item' => 'Adicionar Novo Modalidade',
			'new_item_name' => 'Novo nome do Modalidade',
		);
		register_taxonomy(
			$this->name,
			"None",
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

taxModalidade::get_instance();
