<?php
namespace funarte;

trait PostType {

	protected static $instance;

	final public static function get_instance() {
		return isset(static::$instance)
			? static::$instance
			: static::$instance = new static;
	}

	final private function __construct() {
		$this->init();
		$this->registrer_post_type_options();
		add_action('init', array( &$this, "register_post_type" ));
	}

	protected $POST_TYPE = "POST_TYPE";
	protected $POST_TYPE_NAME = "NAME";
	protected function init() {}

	protected $post_type_labels;
	protected $post_type_args;
	protected function registrer_post_type_options() {
		$this->post_type_labels = array(
			'edit_item' => 'Editar',
			'add_new' => 'Adicionar Novo',
			'search_items' => 'Pesquisar',
			'name' => $this->POST_TYPE_NAME,
			'menu_name' => $this->POST_TYPE_NAME,
			'singular_name' => $this->POST_TYPE_NAME,
			'new_item' => 'Novo ' . $this->POST_TYPE_NAME,
			'view_item' => 'Visualizar ' . $this->POST_TYPE_NAME,
			'add_new_item' =>'Adicionar ' . $this->POST_TYPE_NAME,
			'parent_item_colon' => $this->POST_TYPE_NAME . ' acima:',
			'not_found' => 'Nenhum ' . $this->POST_TYPE_NAME . ' encontrado',
			'not_found_in_trash' => 'Nenhum ' . $this->POST_TYPE_NAME . ' encontrado na lixeira'
		);
		$this->post_type_args = array(
			'labels' => $this->post_type_labels,
			'public' => true,
			'show_ui' => true,
			'rewrite' => true,
			'query_var' => true,
			'can_export' => true,
			'has_archive' => false,
			'show_in_menu' => true,
			'capability_type' => 'post',
			'show_in_nav_menus' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => true
		);
	}

	final public function register_post_type() {
		register_post_type($this->POST_TYPE, $this->post_type_args);
	}
}