<?php
namespace funarte;

class MidiaAudio {
	use Singleton;

	private $POST_TYPE = "midia_audio";

	protected function init() {
		add_action('init', array( &$this, "register_post_type" ));
		add_action('add_meta_boxes', array(&$this, 'add_custom_box'));
		add_action('save_post', array(&$this, 'save_custom_box'));
	}

	public function register_post_type() {
		$POST_TYPE_NAME_PLURAL = "Mídias Áudios";
		$POST_TYPE_NAME_SINGULAR = "Mídia Áudio";

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
			'has_archive' => false,
			'hierarchical' => false,
			'show_in_menu' => true,
			'capability_type' => 'post',
			'show_in_nav_menus' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'supports' => array('title', 'revisions'),
			'taxonomies' => [
				taxTag::get_instance()->get_name(),
				taxCategoria::get_instance()->get_name(),
			]
		);

		register_post_type($this->POST_TYPE, $post_type_args);
	}

	public function get_post_type() {
		return $this->POST_TYPE;
	}

	public function get_audios($params = array()) {
		$params = array_merge(array(
			'post_type' => $this->POST_TYPE,
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => -1
		), $params);
		$posts = query_posts($params);
		wp_reset_query();
		return $posts;
	}

	public function add_custom_box() {
		add_meta_box('audio_url',__('URL'),
					array(&$this, 'audio_ulr_custom_box'), $this->POST_TYPE, 'advanced', 'high');
	}

	public function audio_ulr_custom_box() {
		global $post;
		$nonce = wp_create_nonce(__FILE__);
		$url = get_post_meta($post->ID, 'midia-audio-url', true);
		$THEME_FOLDER = get_template_directory();
		$DS = DIRECTORY_SEPARATOR;
		$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'post_types' . $DS . 'midia_audio' . $DS;
		require_once($META_FOLDER . 'metabox-audio-url.php');
	}

	public function save_custom_box($post_id) {
		global $post; 
		if ($post && $post->post_type != $this->POST_TYPE) {
			return $post_id;
		}
		$this->save_audio_url_box($post_id);
	}

	public function save_audio_url_box($post_id) {
		if (empty($_POST)) {
			return $post_id;
		}
		// Verifica o nonce
		if (!wp_verify_nonce($_POST['audio_url_custom_box'], __FILE__)) {
			return $post_id;
		}
		// Não pode editar o Destaque?
		if (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		$url = $_POST['audio_url'];
		update_post_meta($post_id, 'midia-audio-url', $url);
		
	}

}

MidiaAudio::get_instance();