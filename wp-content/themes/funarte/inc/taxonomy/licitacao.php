<?php
namespace funarte;

class taxLicitacao {
	use Singleton;

	private $name = 'licitacao';
	public function get_name() {
		return $this->name;
	}

	protected function init() {
		add_action('init', array( &$this, "register_taxonomy" ), 9);
	}

	public function register_taxonomy() {
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

taxLicitacao::get_instance();
