<?php
namespace funarte;

class Sinopse {
	use Singleton;

	private $POST_TYPE = "sinopse";

	protected function init() {
		add_action('init', array( &$this, "register_post_type" ));
		add_action('add_meta_boxes', array(&$this, 'add_custom_box'));
		add_action('save_post', array(&$this, 'save_custom_box'));
	}

	public function register_post_type() {
		$POST_TYPE_NAME_PLURAL = "Sinopses";
		$POST_TYPE_NAME_SINGULAR = "Sinopse";

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
				'title', 'editor', 'excerpt', 'thumbnail', 'permalink', 'page-attributes'),
			'taxonomies' => [
				taxCategoria::get_instance()->get_name()
			]
		);

		register_post_type($this->POST_TYPE, $post_type_args);
	}

	public function add_custom_box() {
		add_meta_box('sinopse_custombox', __( 'Informações'),
			array(&$this, 'sinopse_custom_box'), $this->POST_TYPE, 'advanced', 'high');
	}

	public function sinopse_custom_box() {
		global $post;
		$nonce = wp_create_nonce(__FILE__);
		$prefix = 'sinopse';
		$sinopse = array();
		if ((!empty($post->ID)) && (!empty($post->post_title))) {
			$sinopse = array(
				'ref'				=> get_post_meta($post->ID, "{$prefix}-ref", true),
				'preco'			=> get_post_meta($post->ID, "{$prefix}-preco", true),
				'paginas'		=> get_post_meta($post->ID, "{$prefix}-paginas", true),
				'formato'		=> get_post_meta($post->ID, "{$prefix}-formato", true),
			);
		} else {
			$sinopse = array(
				'ref' 		=> '',
				'paginas'	=> '',
				'preco'		=> '',
				'formato'	=> '',
			);
		}

		$THEME_FOLDER = get_template_directory();
		$DS = DIRECTORY_SEPARATOR;
		$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'post_types' . $DS . 'sinopse' . $DS;
		require_once($META_FOLDER . 'metabox-sinopse.php');
	}

	public function save_custom_box($post_id) {
		global $post; 
		if ($post && $post->post_type != $this->POST_TYPE) {
			return $post_id;
		}
		$this->save_sinopse_custom_box($post_id);
	}

	public function save_sinopse_custom_box($post_id) {
		if (empty($_POST)) {
			return $post_id;
		}
		// Verifica o nonce
		if (!wp_verify_nonce($_POST['sinopse_custombox'], __FILE__)) {
			return $post_id;
		}
		// Não pode editar a Licitacao?
		if (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		$fields = array( 'ref', 'paginas', 'preco', 'formato' );
		$sinopse = $_POST['sinopse'];
		foreach ($sinopse as $field => &$value) {
			if (in_array($field, $fields)) {
				update_post_meta($post_id, 'sinopse-' . $field, $value);
			}
		}
	}

}

Sinopse::get_instance();