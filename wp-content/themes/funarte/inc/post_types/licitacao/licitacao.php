<?php
namespace funarte;

class Licitacao {
	use Singleton;

	private $POST_TYPE = "licitacao";

	protected function init() {
		add_action('init', array( &$this, "register_post_type" ));
		add_action('add_meta_boxes', array(&$this, 'add_custom_box'));
		add_action('save_post', array(&$this, 'save_custom_box'));
	}

	public function add_custom_box() {
		add_meta_box('relatorio_custombox', __( 'Informações'),
					array(&$this, 'licitacao_custom_box'), $this->POST_TYPE, 'side', 'high');
	}

	public function save_custom_box($post_id) {
		global $post; 
		if ($post && $post->post_type != $this->POST_TYPE) {
			return $post_id;
		}
		$this->save_licitacao_custom_box($post_id);
	}

	public function register_post_type() {
		$POST_TYPE_NAME_PLURAL = "Licitações";
		$POST_TYPE_NAME_SINGULAR = "Licitação";

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
				taxTag::get_instance()->get_name(),
				taxModalidade::get_instance()->get_name()
			]
		);
		register_post_type($this->POST_TYPE, $post_type_args);
	}

	public function licitacao_custom_box() {
		global $post;
		$nonce = wp_create_nonce(__FILE__);
		$licitacao_numero = get_post_meta($post->ID, 'licitacao-numero', true);
		$licitacao_data = get_post_meta($post->ID, 'licitacao-data', true);
		$licitacao_hora = get_post_meta($post->ID, 'licitacao-hora', true);
		if(empty($licitacao_hora)) {
			$licitacao_hora = date('H:i');
		}
		if ($post->ID && empty($licitacao_hora)) {
				$licitacao_hora = strtotime('+1 day 1 hour');
		}
		
		$THEME_FOLDER = get_template_directory();
		$DS = DIRECTORY_SEPARATOR;
		$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'post_types' . $DS . 'licitacao' . $DS;
		require_once($META_FOLDER . 'metabox-licitacao.php');
	}

	public function save_licitacao_custom_box($post_id) {
		if (empty($_POST)) {
			return $post_id;
		}
		// Verifica o nonce
		if (!wp_verify_nonce($_POST['licitacao_custombox'], __FILE__)) {
			return $post_id;
		}
		// Não pode editar a Licitacao?
		if (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		if(isset($_POST['licitacao-numero']) && !empty($_POST['licitacao-numero'])) {
			update_post_meta($post_id, 'licitacao-numero', $_POST['licitacao-numero']);
		}
		if(isset($_POST['licitacao-data']) && !empty($_POST['licitacao-data'])) {
			update_post_meta($post_id, 'licitacao-data', $_POST['licitacao-data']);
			$ano = explode('/', $_POST['licitacao-data'], 3);
			$ano = $ano[2];
			update_post_meta($post_id, 'licitacao-ano', $ano);
		}
		if(isset($_POST['licitacao-hora']) && !empty($_POST['licitacao-hora'])) {
			update_post_meta($post_id, 'licitacao-hora', $_POST['licitacao-hora']);
		}
	}

}

Licitacao::get_instance();