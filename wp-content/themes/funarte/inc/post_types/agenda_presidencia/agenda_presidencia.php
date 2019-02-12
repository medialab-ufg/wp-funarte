<?php
namespace funarte;

class AgendaPresidencia {
	use Singleton;

	private $POST_TYPE = "agenda-presidencia";
	private $prefix = 'agenda-presidencia';

	protected function init() {
		add_action('init', array( &$this, "register_post_type" ));
		add_action('add_meta_boxes', array(&$this, 'add_custom_box'));
		add_action('save_post', array(&$this, 'save_custom_box'));
		add_filter( 'wp_insert_post_data' , array(&$this, 'modify_post_title'), '99', 1 );
	}

	public function register_post_type() {
		$POST_TYPE_NAME_PLURAL = "Agenda da Presidência";
		$POST_TYPE_NAME_SINGULAR = "Agenda da Presidência";

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
			'supports' => array('editor')
		);

		register_post_type($this->POST_TYPE, $post_type_args);
	}

	public function add_custom_box() {
		add_meta_box('agenda_presidencia_custombox', __( 'Agenda do Dia'),
			array(&$this, 'agenda_presidencia_custom_box'), $this->POST_TYPE, 'advanced', 'high');
	}

	public function save_custom_box($post_id) {
		global $post; 
		if ($post == null || $post->post_type != $this->POST_TYPE) {
			return $post_id;
		}
		$this->save_areas_interesse_custom_box($post_id);
	}

	public function agenda_presidencia_custom_box() {
		global $post;
		$nonce = wp_create_nonce(__FILE__);
		
		$data_agenda = get_post_meta($post->ID, "{$this->prefix}-data", true);
		$data_agenda = $data_agenda ? $data_agenda : date('d/m/y');
		?>
			<input type="hidden" name="agenda_presidencia_nonce_custombox" id="agenda_presidencia_nonce_custombox" value="<?php echo $nonce; ?>" />
			<label for="data"> Dia: </label>
			<input type="text" class="date" name="<?php echo "{$this->prefix}-data"; ?>" id="data" value="<?php echo $data_agenda; ?>" />
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('#data').datepicker({
						dateFormat: 'dd/mm/yy',
						showButtonPanel: true,
						showOtherMonths: true
					});
				});
			</script>
		<?php
	}

	public function save_areas_interesse_custom_box($post_id) {
		if (empty($_POST)) {
			return $post_id;
		}
		if (!wp_verify_nonce($_POST['agenda_presidencia_nonce_custombox'], __FILE__)) {
			return $post_id;
		}
		if (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		$data_agenda = $_POST["$this->prefix-data"];
		update_post_meta($post_id, "$this->prefix-data", $data_agenda);
	}

	public function modify_post_title( $data ) {
		if($data['post_type'] == $this->POST_TYPE && isset($_POST["$this->prefix-data"])) {
			$title = "Agenda do dia: " . $_POST["$this->prefix-data"];
			$data['post_title'] =  $title ; 
		}
		return $data; 
}

	public function get_post_type_name() {
		return $this->POST_TYPE;
	}
}

AgendaPresidencia::get_instance();