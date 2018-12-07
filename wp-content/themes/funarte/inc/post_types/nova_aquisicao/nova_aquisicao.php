<?php
namespace funarte;

class NovaAquisicao {
	use Singleton;

	private $POST_TYPE = "nova-aquisicao";

	protected function init() {
		add_action('init', array( &$this, "register_post_type" ));
		add_action('add_meta_boxes', array(&$this, 'add_custom_box'));
		add_action('save_post', array(&$this, 'save_custom_box'));
	}

	public function add_custom_box() {
		add_meta_box('novasaquisicoes_custombox', __( 'Detalhes'),
					array(&$this, 'novas_aquisicoes_custom_box'), $this->POST_TYPE, 'side', 'high');
	}

	public function save_custom_box($post_id) {
		global $post; 
		if ($post && $post->post_type != $this->POST_TYPE) {
			return $post_id;
		}
		$this->save_novas_aquisicoes_custom_box($post_id);
	}

	public function register_post_type() {
		$POST_TYPE_NAME_PLURAL = "Novas Aquisições";
		$POST_TYPE_NAME_SINGULAR = "Nova Aquisição";

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
				taxTag::get_instance()->get_name()
			]
		);

		register_post_type($this->POST_TYPE, $post_type_args);
	}

	public function novas_aquisicoes_custom_box() {
		global $post;
		$nonce = wp_create_nonce(__FILE__);
		$timestamp = get_post_meta($post->ID, 'aquisicao-timestamp', true);

		$THEME_FOLDER = get_template_directory();
		$DS = DIRECTORY_SEPARATOR;
		$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'post_types' . $DS . 'nova_aquisicao' . $DS;
		require_once($META_FOLDER . 'metabox-detalhes-aquisicao.php');
	}

	public function save_novas_aquisicoes_custom_box($post_id) {
		if (empty($_POST)) {
			return $post_id;
		}
		if (!wp_verify_nonce($_POST['aquisicao-nonce'], __FILE__)) {
			return $post_id;
		}
		if (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		$timestamp = mktime(1, 1, 1, (int)$_POST['mes'], 1, (int)$_POST['ano']);
		update_post_meta($post_id, 'aquisicao-timestamp', $timestamp);
	}

	public function get_post_type() {
		return $this->POST_TYPE;
	}

}

NovaAquisicao::get_instance();