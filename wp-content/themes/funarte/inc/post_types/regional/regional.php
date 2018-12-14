<?php
namespace funarte;

class Regional {
	use Singleton;

	private $POST_TYPE = "regional";

	protected function init() {
		add_action('init', array( &$this, "register_post_type" ));
		add_action('add_meta_boxes', array(&$this, 'add_custom_box'));
		add_action('save_post', array(&$this, 'save_custom_box'));
	}

	public function register_post_type() {
		$POST_TYPE_NAME_PLURAL = "Representações Regionais";
		$POST_TYPE_NAME_SINGULAR = "Representação Regional";

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
			'exclude_from_search' => false,
			'supports' => array('title', 'editor', 'thumbnail', 'permalink'),
			'taxonomies' => [
				taxRegional::get_instance()->get_name(),
				taxTag::get_instance()->get_name()
			]
		);

		register_post_type($this->POST_TYPE, $post_type_args);
	}

	public function add_custom_box() {
		add_meta_box('regional_custombox', __( 'Mais Informações'),
			array(&$this, 'regional_custom_box'), $this->POST_TYPE, 'advanced', 'high');
	}

	public function save_custom_box($post_id) {
		global $post; 
		if ($post && $post->post_type != $this->POST_TYPE) {
			return $post_id;
		}
		$this->save_regional_custom_box($post_id);
	}

	public function regional_custom_box() {
		global $post;
		$nonce = wp_create_nonce(__FILE__);
		$prefix = 'regional';
		$regional = array();
		if ((!empty($post->ID)) && (!empty($post->post_title))) {
			$regional = array(
				'coordenador'	=> get_post_meta($post->ID, "{$prefix}-coordenador", true),
				'rua'			=> get_post_meta($post->ID, "{$prefix}-rua", true),
				'numero'		=> get_post_meta($post->ID, "{$prefix}-numero", true),
				'complemento'	=> get_post_meta($post->ID, "{$prefix}-complemento", true),
				'bairro'		=> get_post_meta($post->ID, "{$prefix}-bairro", true),
				'cidade' 		=> get_post_meta($post->ID, "{$prefix}-cidade", true),
				'estado'		=> get_post_meta($post->ID, "{$prefix}-estado", true),
				'cep' 			=> get_post_meta($post->ID, "{$prefix}-cep", true),
				'telefone1'		=> get_post_meta($post->ID, "{$prefix}-telefone1", true),
				'telefone2'		=> get_post_meta($post->ID, "{$prefix}-telefone2", true),
				'fax'			=> get_post_meta($post->ID, "{$prefix}-fax", true),
				'email'			=> get_post_meta($post->ID, "{$prefix}-email", true),
				'contatos'		=> get_post_meta($post->ID, "{$prefix}-contatos", true),
			);
		} else { 
			$regional = array(
				'coordenador' => '',
				'rua' => '',
				'numero' => '',
				'complemento' => '',
				'bairro' => '',
				'cidade' => '',
				'cep' => '',
				'telefone1' => '',
				'telefone2' => '',
				'fax' => '',
				'email' => '',
				'contatos' => array(
					array(
						'area' => '',
						'responsavel' => '',
						'telefone' => '',
						'email' => ''
					)
				)
			);
		}

		$THEME_FOLDER = get_template_directory();
		$DS = DIRECTORY_SEPARATOR;
		$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'post_types' . $DS . 'regional' . $DS;
		require_once($META_FOLDER . 'metabox-maisinformacoes-regional.php');
	}

	public function save_regional_custom_box($post_id) {
		if (empty($_POST)) {
			return $post_id;
		}
		// Verifica o nonce
		if (!wp_verify_nonce($_POST['maisinfo_regional_custombox'], __FILE__)) {
			return $post_id;
		}
		// Não pode editar a Regional?
		if (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		$fields = array(
			'coordenador',
			'rua',
			'numero',
			'complemento',
			'bairro',
			'cidade',
			'cep',
			'telefone1',
			'telefone2',
			'fax',
			'email');
		$regional = $_POST['regional'];
		foreach ($regional AS $field => &$value) {
			if (in_array($field, $fields)) {
				update_post_meta($post_id, 'regional-' . $field, $value);
			}
		}
		$contatos = $_POST['contatos'];
		foreach ($contatos as $key => $contato) {
			if (empty($contato['area']) || empty($contato['responsavel']))
				unset($contatos[$key]);
		}
		update_post_meta($post_id, 'regional-contatos', $contatos);
		return $regional;
	}

	public function get_post_type() {
		return $this->POST_TYPE;
	}
}

Regional::get_instance();