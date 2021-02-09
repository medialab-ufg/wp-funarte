<?php 

namespace Funarte;

class MetaboxListaManualColecoes {
	use Singleton;
	
	protected $meta_key = 'cedoc-lista-colecao';
	protected $allowed_templates = ['page-cedoc.php'];
	
	protected function init() {
		add_action('add_meta_boxes', array(&$this, 'add_custom_box'));
		add_action('save_post', array(&$this, 'save_custom_box'));
	}
	
	public function add_custom_box() {
		$post_ID = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : null);
		if ($post_ID == null ) {
			return;
		}
		$page_template = get_page_template_slug( $post_ID );
		if (in_array($page_template, $this->allowed_templates)) {
			add_meta_box('pages_link-lista-colecao_metabox', __( 'Lista de coleções'),
				array(&$this, 'meta_box'), 'page', 'advanced', 'high');
		}
	}

	public function save_custom_box($post_id) {
		$page_template = get_page_template_slug( $post_id );
		if (!in_array($page_template, $this->allowed_templates)) {
			return $post_id;
		}

		// Verifica o nonce
		if (!wp_verify_nonce($_POST[__CLASS__.'_noncename'], 'save_'.__CLASS__))
			return;
		// Não pode editar?
		if (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		if(isset($_POST['cedoc-lista'])) {
			update_post_meta($post_id, $this->meta_key, $_POST['cedoc-lista']);
		}
		return $post_id;
	}

	public function meta_box() {
		global $post;
		wp_nonce_field( 'save_'.__CLASS__, __CLASS__.'_noncename' );
		if (!empty($post->ID) && !empty($post->post_title)) {
			$item_list = get_post_meta($post->ID, $this->meta_key, true);
		}
		$THEME_FOLDER = get_template_directory();
		$DS = DIRECTORY_SEPARATOR;
		$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'meta-boxes' . $DS;
		require_once($META_FOLDER . 'metabox-lista-manual-colecoes.view.php');
	}
}

MetaboxListaManualColecoes::get_instance();
