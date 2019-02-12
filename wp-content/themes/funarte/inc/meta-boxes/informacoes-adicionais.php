<?php 

namespace Funarte;

class MetaboxMaisInformacoes {
	use Singleton;
	
	protected $meta_key = 'mais_info';
	protected $allowed_templates = ['page-tpl-box-verde-e-links.php'];
	
	protected function init() {
		add_action('add_meta_boxes', array(&$this, 'add_custom_box'));
		add_action('save_post', array(&$this, 'save_custom_box'));
	}
	
	public function add_custom_box() {
		add_meta_box('pages_mais_infos_metabox', __( 'Mais Informações'),
			array(&$this, 'meta_box'), 'page', 'advanced', 'high');
	}

	public function save_custom_box($post_id) {
		global $post;
		$page_template = get_page_template_slug( $post_id );
		if (!in_array($page_template, $this->allowed_templates)) {
			return $post_id;
		}

		if (empty($_POST)) {
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

		$metadata = get_post_meta($post->ID, $this->meta_key, true);
		?>
		
		<p>
			Estas opções se aplicam somente às páginas que utilizam o modelo com Caixa de Informações.
		</p>
		
		<label> Conteúdo principal</label><br/>
		<textarea name="<?php echo $this->meta_key ?>[content]"><?php echo isset($metadata['content'])?$metadata['content']:''; ?></textarea>
		
		<br/><br/>
		
		<label> Conteúdo da seção "Mais Contatos"</label><br/>
		<textarea name="<?php echo $this->meta_key ?>[mais_content]"><?php echo isset($metadata['mais_content'])?$metadata['mais_content']:'';; ?></textarea>
		
		
		<script>
		
		function showHideMaisInfoMeta() {
			if (jQuery('#page_template').val() != 'page-tpl-box-verde-e-links.php') {
				jQuery('#pages_mais_infos_metabox').hide();
			} else {
				jQuery('#pages_mais_infos_metabox').show();
			}
		}
		
		jQuery(document).ready(function() {
			showHideMaisInfoMeta();
			jQuery('#page_template').change(function() {
				showHideMaisInfoMeta();
			});
		});
		
		</script>
		
		<?php 

	}
	
	public function get_value($post_id, $field) {
		$meta = get_post_meta($post_id, $this->meta_key, true);
		
		if (isset($meta[$field]))
			return apply_filters('the_content', $meta[$field]);
		
		return '';
		
	}

	 
}

MetaboxMaisInformacoes::get_instance();

?>