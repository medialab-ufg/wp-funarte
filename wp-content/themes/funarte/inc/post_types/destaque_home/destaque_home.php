<?php
namespace funarte;

class DestaqueHome {
	use Singleton;

	private $POST_TYPE = "destaque-home";

	protected function init() {
		add_action('init', array( &$this, "register_post_type" ));
		add_action('add_meta_boxes', array(&$this, 'add_custom_box'));
		add_action('save_post', array(&$this, 'save_custom_box'));
	}

	public function register_post_type() {
		$POST_TYPE_NAME_PLURAL = "Destaques";
		$POST_TYPE_NAME_SINGULAR = "Destaque";

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
			'exclude_from_search' => true,
			'supports' => array(
				'title','editor','thumbnail','page-attributes'),
			'taxonomies' => [
				taxCategoria::get_instance()->get_name()
			]
		);

		register_post_type($this->POST_TYPE, $post_type_args);
	}

	public function add_custom_box() {
		add_meta_box('destaque_url',__('Informações'),
					array(&$this, 'destaque_home_custom_box'), $this->POST_TYPE, 'advanced', 'high');
	}

	public function save_custom_box($post_id) {
		global $post; 
		if ($post && $post->post_type != $this->POST_TYPE) {
			return $post_id;
		}
		$this->save_destaque_home_custom_box($post_id);
	}

	public function destaque_home_custom_box() {
		global $post;
		$nonce = wp_create_nonce(__FILE__);
		$destaqueurl = get_post_meta($post->ID, 'destaque-url', true);
		$destaquehomesite = get_post_meta($post->ID, 'destaque-home_site', true);
		$destaquehomearea = get_post_meta($post->ID, 'destaque-home_area', true);
		$posicao = get_post_meta($post->ID, 'destaque-posicao', true);
		$target = get_post_meta($post->ID, 'destaque-target', true);
	
		$THEME_FOLDER = get_template_directory();
		$DS = DIRECTORY_SEPARATOR;
		$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'post_types' . $DS . 'destaque_home' . $DS;
		require_once($META_FOLDER . 'metabox-destaque-home.php');
	}

	public function save_destaque_home_custom_box($post_id) {
		if (empty($_POST)) {
			return $post_id;
		}
		// Verifica o nonce
		if (!wp_verify_nonce($_POST['destaque_custom_box'], __FILE__)) {
			return $post_id;
		}
		// Não pode editar o Destaque?
		if (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		$fields = array('url', 'posicao', 'target');
		$data = $_POST['destaque'];
		foreach ($data AS $field => $value) {
			if (!in_array($field, $fields)) {
				continue;
			}
			update_post_meta($post_id, 'destaque-' . $field, $value);
		}
		// Checkboxes (podem não existir no post)
		$fields = array('home_site', 'home_area');
		foreach ($fields AS $field) {
			$value = (isset($data[$field]) && !empty($data[$field])) ? 1 : 0;
			update_post_meta($post_id, 'destaque-' . $field, $value);
		}
	}

}

DestaqueHome::get_instance();