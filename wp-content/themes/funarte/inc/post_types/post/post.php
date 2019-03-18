<?php
namespace funarte;

class Post {
	use Singleton;


	protected function init() {
		add_action('wp_enqueue_scripts', array(&$this, 'extra_files'), 15);
		add_action('add_meta_boxes', array(&$this, 'add_custom_box'));
		add_action('save_post', array(&$this, 'save_custom_box'));
	}
	
	public function add_custom_box() {
		add_meta_box('post_custombox', __( 'Configuração'),
					array(&$this, 'post_custom_box'), 'post', 'side','high');
	}

	public function post_custom_box() {
		global $post;
		$nonce = wp_create_nonce(__FILE__);
		$qtd_columns = get_post_meta($post->ID, 'post-quantity-columns', true);
		if (!isset($qtd_columns) || empty($qtd_columns) || $qtd_columns == "") {
			$qtd_columns = '1';
		}
		?>
		Quantidade de colunas: <br>
		<input type="hidden" name="post_custombox" id="post_custombox" value="<?php echo $nonce; ?>" />
		<select name="post-quantity-columns">
			<option value='2'  <?php if($qtd_columns == '2' ) { echo "selected"; } ?> >duas colunas</option>
			<option value='1' <?php if($qtd_columns == '1') { echo "selected"; }?>>uma coluna</option>
		</select>
		<?php
	}

	public function save_custom_box($post_id) {
		global $post; 
		if ($post && $post->post_type != 'post') {
			return $post_id;
		}
		$this->save_post_custom_box($post_id);
	}


	private function save_post_custom_box($post_id) {
		if (empty($_POST))
			return $post_id;

		// Verifica o nonce
		if (!wp_verify_nonce($_POST['post_custombox'], __FILE__))
			return $post_id;

		// É um autosave?
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;

		// Não pode editar o post?
		if (!current_user_can('edit_post', $post_id))
			return $post_id;

		$qtd_columns = $_POST['post-quantity-columns'];
		update_post_meta($post_id, 'post-quantity-columns', $qtd_columns);
	}

	public function extra_files() {
		if (is_home()) {
			wp_enqueue_script('post-js', get_theme_file_uri() . '/inc/post_types/post/post.js', null, microtime(), true);
		}
	}

}

Post::get_instance();