<?php
namespace funarte;

class taxIdentidadeVisual {
	use Singleton;

	private $name = 'identidade-visual';
	public function get_name() {
		return $this->name;
	}

	protected function init() {
		add_action('init', array( &$this, "register_taxonomy" ), 9);
	}

	public function register_taxonomy() {
		$labels = array(
			'name' =>'Identidade Visual',
			'singular_name' => 'Identidade Visual',
			'search_items' => 'Buscar Identidade Visual',
			'all_items' => 'Todas as Identidades Visuais',
			'parent_item' => 'Identidade Visual',
			'parent_item_colon' => 'Identidade Visual Acima:',
			'edit_item' => 'Editar Identidade Visual',
			'update_item' => 'Atualizar Identidade Visual',
			'add_new_item' => 'Adicionar Nova Identidade Visual',
			'new_item_name' => 'Novo nome da Identidade Visual',
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

taxIdentidadeVisual::get_instance();
