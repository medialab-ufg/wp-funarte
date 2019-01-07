<?php 

namespace funarte;

class Relatorio {
	use Singleton;

	private $PAGE_SLUG = "relatorios";

	protected function init() {
		add_action( 'add_meta_boxes_page', array( &$this, "add_meta_boxes_page" ) );
		add_action('save_post', array(&$this, 'save_custom_box'));
	}	

	public function add_meta_boxes_page() {
		$post_ID = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
		$post = get_post( $post_ID );
		$slug = $post->post_name;
		if ( $this->PAGE_SLUG == $slug ) {
			add_meta_box( 'downloads_custombox' , __( 'Downloads'),
				array($this, 'meta_box_downloads'), 'page', 'advanced', 'high');
			
			add_meta_box( 'arquivos_diversos_custombox' , __( 'Arquivos Diversos'),
				 array($this, 'meta_box_arquivos_diversos'), 'page', 'advanced', 'high');
		}
	}

	public function save_custom_box($post_id) {
		global $post; 
		if ($post && $post->post_name != $this->PAGE_SLUG) {
			return $post_id;
		}
		$this->save_meta_box_downloads($post_id);
		$this->save_meta_box_arquivos_diversos($post_id);
	}

	function meta_box_downloads() {
		$prefix = $this->PAGE_SLUG;
		global $post;
		if ((!empty($post->ID)) && (!empty($post->post_title))) {
			$download = get_post_meta($post->ID, "{$prefix}-download", true);
		} else {
			$download = array('links' => array(['descricao' => 'descrição', 'url' => 'Link']));
		}

		$THEME_FOLDER = get_template_directory();
		$DS = DIRECTORY_SEPARATOR;
		$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'pages' . $DS;
		require_once($META_FOLDER . 'metabox-arquivos-download.php');
	}

	function meta_box_arquivos_diversos() {
		$prefix = $this->PAGE_SLUG;
		global $post;
		if ((!empty($post->ID)) && (!empty($post->post_title))) {
			$arquivos_diversos = get_post_meta($post->ID, "{$prefix}-arquivos-diversos", true);
		} else {
			$arquivos_diversos = array('arquivos' => array(['descricao' => 'descrição', 'url' => 'Link']));
		}

		$THEME_FOLDER = get_template_directory();
		$DS = DIRECTORY_SEPARATOR;
		$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'pages' . $DS;
		require_once($META_FOLDER . 'metabox-arquivos-diversos.php');
	}

	public function save_meta_box_downloads($post_id) {
		$prefix = $this->PAGE_SLUG;
		$downloads = $_POST['download'];
		update_post_meta($post_id, "$prefix-download", $downloads);
	}

	public function save_meta_box_arquivos_diversos($post_id) {
		$prefix = $this->PAGE_SLUG;
		$arquivos_diversos = $_POST['arquivos-diversos'];
		update_post_meta($post_id, "$prefix-arquivos-diversos", $arquivos_diversos);
	}

	public function get_downlods() {
		$prefix = $this->PAGE_SLUG;
		global $post;
		if ((!empty($post->ID)) && (!empty($post->post_title))) {
			$download = get_post_meta($post->ID, "{$prefix}-download", true);
		} else {
			$download = array('links' => array(['descricao' => 'descrição', 'url' => 'Link']));
		}
		return $download['links'];
	}

	public function get_arquivos_diversos() {
		$prefix = $this->PAGE_SLUG;
		global $post;
		if ((!empty($post->ID)) && (!empty($post->post_title))) {
			$arquivos_diversos = get_post_meta($post->ID, "{$prefix}-arquivos-diversos", true);
		} else {
			$arquivos_diversos = array('arquivos' => array(['descricao' => 'descrição', 'url' => 'Link']));
		}
		return $arquivos_diversos['arquivos'];
	}

}

Relatorio::get_instance();

