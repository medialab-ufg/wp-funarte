<?php
namespace funarte;

class AreaInteresse {
	use Singleton;

	private $POST_TYPE = "area-de-interesse";

	protected function init() {
		add_action('init', array( &$this, "register_post_type" ));
		add_action('add_meta_boxes', array(&$this, 'add_custom_box'));
		add_action('save_post', array(&$this, 'save_custom_box'));
	}

	public function register_post_type() {
		$POST_TYPE_NAME_PLURAL = "Àreas Interesse";
		$POST_TYPE_NAME_SINGULAR = "Área Interesse";

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
			'taxonomies' => [
				taxCategoria::get_instance()->get_name(),
				taxTag::get_instance()->get_name()
			]
		);

		register_post_type($this->POST_TYPE, $post_type_args);
	}

	public function add_custom_box() {
		add_meta_box('regional_custombox', __( 'Mais Informações'),
			array(&$this, 'areas_interesse_custom_box'), $this->POST_TYPE, 'advanced', 'high');
	}

	public function save_custom_box($post_id) {
		global $post; 
		if ($post && $post->post_type != $this->POST_TYPE) {
			return $post_id;
		}
		$this->save_areas_interesse_custom_box($post_id);
	}

	public function areas_interesse_custom_box() {
		global $post;
		$nonce = wp_create_nonce(__FILE__);
		$prefix = 'area_de_interesse';
		$coordenador = get_post_meta($post->ID, "{$prefix}-coordenador", true);
		$telefone1 = get_post_meta($post->ID, "{$prefix}-telefone1", true);
		$telefone2 = get_post_meta($post->ID, "{$prefix}-telefone2", true);
		$fax = get_post_meta($post->ID, "{$prefix}-fax", true);
		$email = get_post_meta($post->ID, "{$prefix}-email", true);
		$endereco = get_post_meta($post->ID, "{$prefix}-endereco", true);

		$THEME_FOLDER = get_template_directory();
		$DS = DIRECTORY_SEPARATOR;
		$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'post_types' . $DS . 'area_interesse' . $DS;
		require_once($META_FOLDER . 'metabox-maisinformacoes-areas-de-interesse.php');
	}

	public function save_areas_interesse_custom_box($post_id) {
		if (empty($_POST)) {
			return $post_id;
		}
		if (!wp_verify_nonce($_POST['maisinfo_areas-de-interesse_custombox'], __FILE__)) {
			return $post_id;
		}
		if (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		$prefix = 'area_de_interesse';
		$fields = array( 'coordenador', 'telefone1', 'telefone2','fax', 'email', 'endereco');
		$post = $_POST['area-de-interesse'];
		foreach ($post AS $key => $value) {
			if (!in_array($key, $fields))
				continue;
			update_post_meta($post_id, "{$prefix}-{$key}", $value);
		}
	}
}

AreaInteresse::get_instance();