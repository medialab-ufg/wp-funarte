<?php
namespace funarte;

class EspacoCultural {
	use Singleton;

	private $POST_TYPE = "espaco-cultural";

	protected function init() {
		add_action('init', array( &$this, "register_post_type" ));
		add_action('add_meta_boxes', array(&$this, 'add_custom_box'));
		add_action('save_post', array(&$this, 'save_custom_box'));
	}

	public function add_custom_box() {
		add_meta_box('espaco_custombox', __( 'Dados do espaço cultural'),
					array(&$this, 'espaco_cultural_custom_box'), $this->POST_TYPE, 'normal', 'high');
	}

	public function save_custom_box($post_id) {
		global $post; 
		if ($post && $post->post_type != $this->POST_TYPE) {
			return $post_id;
		}
		$this->save_espaco_cultural_custom_box($post_id);
	}

	public function register_post_type() {
		$POST_TYPE_NAME_PLURAL = "Espacos Culturais";
		$POST_TYPE_NAME_SINGULAR = "Espaço cultural";

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
			'supports' => array('title', 'editor', 'thumbnail', 'permalink'),
			'taxonomies' => [
				taxEspacosCulturais::get_instance()->get_name(),
				taxCategoria::get_instance()->get_name(),
				taxRegional::get_instance()->get_name(),
				taxTag::get_instance()->get_name()
			]
		);

		register_post_type($this->POST_TYPE, $post_type_args);
	}

	public function espaco_cultural_custom_box() {
		global $post;
		$nonce = wp_create_nonce(__FILE__);
		$prefix = 'espaco';
		$espaco = get_post_meta($post->ID, "{$prefix}-maplink", true);
		if ($post->ID && (!empty($post->post_title) || !empty($espaco))) {
			$espaco = array(
				'telefone1' => get_post_meta($post->ID, "{$prefix}-telefone1", true),
				'telefone2' => get_post_meta($post->ID, "{$prefix}-telefone2", true),
				'email' 		=> get_post_meta($post->ID, "{$prefix}-email", true),
				'link' 			=> get_post_meta($post->ID, "{$prefix}-link", true),
				'maplink' 	=> get_post_meta($post->ID, "{$prefix}-maplink", true),
			
				'complemento' => get_post_meta($post->ID, "{$prefix}-complemento", true),
				'rua' 		=> get_post_meta($post->ID, "{$prefix}-rua", true),
				'numero' 	=> get_post_meta($post->ID, "{$prefix}-numero", true),
				'bairro' 	=> get_post_meta($post->ID, "{$prefix}-bairro", true),
				'cidade' 	=> get_post_meta($post->ID, "{$prefix}-cidade", true),
				'estado' 	=> get_post_meta($post->ID, "{$prefix}-estado", true),
				'cep' => get_post_meta($post->ID, "{$prefix}-cep", true)
			);
		} else {
			$espaco = array(
				'telefone1' => '',
				'telefone2' => '',
				'email' => '',
				'link' => '',
				'maplink' => '',
			
				'rua' => '',
				'numero' => '',
				'complemento' => '',
				'bairro' => '',
				'cidade' => '',
				'estado' => '',
				'cep' => ''
			);
		}

		$THEME_FOLDER = get_template_directory();
		$DS = DIRECTORY_SEPARATOR;
		$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'post_types' . $DS . 'espaco_cultural' . $DS;
		require_once($META_FOLDER . 'metabox-detalhes-espaco-cultural.php');
	}

	public function save_espaco_cultural_custom_box($post_id) {
		if (empty($_POST)) {
			return $post_id;
		}
		if (!wp_verify_nonce($_POST['espaco_custombox'], __FILE__)) {
			return $post_id;
		}
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		if (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		$fields = array('rua', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'maplink', 'link', 'email', 'telefone1', 'telefone2', 'cep');
		$espaco = $_POST['espaco'];
		foreach ($espaco AS $field => &$value) {
			if (in_array($field, $fields)) {
				update_post_meta($post_id, 'espaco-' . $field, $value);
			}
		}
		return $espaco;
	}

}

EspacoCultural::get_instance();