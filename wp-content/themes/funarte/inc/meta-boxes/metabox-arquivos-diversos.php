<?php 

namespace Funarte;

class MetaboxArquivosDiversos {
	use Singleton;
	
	protected $meta_key = 'arquivos-diversos';
	protected $allowed_templates = ['page-tpl-box-verde-e-links.php'];
	
	protected function init() {
		add_action('add_meta_boxes', array(&$this, 'add_custom_box'));
		add_action('save_post', 		 array(&$this, 'save_custom_box'));
	}
	
	public function add_custom_box() {
		$post_ID = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
		$page_template = get_page_template_slug( $post_ID );
		if (in_array($page_template, $this->allowed_templates)) {
			add_meta_box('pages_arquivos-diversos_metabox', __( 'Arquivos Diversos'),
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

		if(isset($_POST[$this->meta_key])){
			update_post_meta($post_id, $this->meta_key, $_POST[$this->meta_key]);
		}
		return $post_id;
	}

	public function meta_box() {
		global $post;
		wp_nonce_field( 'save_'.__CLASS__, __CLASS__.'_noncename' );
		if ((!empty($post->ID)) && (!empty($post->post_title))) {
			$arquivos_diversos = get_post_meta($post->ID, "arquivos-diversos", true);
		} else {
			$arquivos_diversos = array('arquivos' => array(['descricao' => '', 'url' => '']));
		}

		$metadata = get_post_meta($post->ID, $this->meta_key, true);
		$THEME_FOLDER = get_template_directory();
		$DS = DIRECTORY_SEPARATOR;
		$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'meta-boxes' . $DS;
		require_once($META_FOLDER . 'metabox-arquivos-diversos.view.php');
	}

	public function get_arquivos_diversos() {
		global $post;
		if ((!empty($post->ID)) && (!empty($post->post_title))) {
			$arquivos_diversos = get_post_meta($post->ID, "arquivos-diversos", true);
		} else {
			$arquivos_diversos = array('arquivos' => array(['descricao' => '', 'url' => '']));
		}
		return $arquivos_diversos['arquivos'];
	}
}

MetaboxArquivosDiversos::get_instance();

?>