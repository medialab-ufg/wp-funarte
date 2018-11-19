<?php
namespace funarte;

class taxEditais {
	use Singleton;

	private $name = 'editais';
	public function get_name() {
		return $this->name;
	}

	protected function init() {
		add_action('init', array( &$this, "register_taxonomy" ), 9);
	}

	public function register_taxonomy() {
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

taxEditais::get_instance();
