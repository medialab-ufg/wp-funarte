<?php
namespace funarte;

class taxEstrutura {
	use Singleton;

	private $name = 'estrutura';
	public function get_name() {
		return $this->name;
	}

	protected function init() {
		add_action('init', array( &$this, "register_taxonomy" ), 9);
	}

	public function register_taxonomy() {
		$labels = array(
			'name' =>'Estruturas',
			'singular_name' => 'Estrutura',
			'search_items' => 'Buscar Estrutura',
			'all_items' => 'Todas as Estrutura',
			'parent_item' => 'Estrutura',
			'parent_item_colon' => 'Estrutura Acima:',
			'edit_item' => 'Editar Estrutura',
			'update_item' => 'Atualizar EdiEstruturatal',
			'add_new_item' => 'Adicionar Novo Estrutura',
			'new_item_name' => 'Novo nome do Estrutura',
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

taxEstrutura::get_instance();
