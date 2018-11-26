<?php
namespace funarte;

class Evento {
	use Singleton;

	protected $POST_TYPE = "evento";

	protected function init() {
		add_action('init', array( &$this, "register_post_type" ));
		add_action('add_meta_boxes', array(&$this, 'add_custom_box'));
		add_action('save_post', array(&$this, 'save_custom_box'));
		
	}

	public function register_post_type() {
		
		$POST_TYPE_NAME_PLURAL = "Eventos";
		$POST_TYPE_NAME_SINGULAR = "Evento";

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
			'exclude_from_search' => true
		);

		register_post_type($this->POST_TYPE, $post_type_args);
	}

	public function add_custom_box() {
		add_meta_box('evento_custombox', __( 'Datas e horários do evento'),
			array(&$this, 'print_evento_custom_box'), $this->POST_TYPE, 'side', 'high');

			add_meta_box('evento_details_custombox', __( 'Detalhes do evento'),
			array(&$this, 'print_evento_details_custom_box'), $this->POST_TYPE, 'advanced', 'high');
	}

	public function print_evento_custom_box() {
		global $post;
		$nonce = wp_create_nonce(__FILE__);
		
		$evento = get_post_meta($post->ID, 'evento-inicio', true);
		if ($post->ID && !empty($evento)) {
			$evento = array(
				'multiplo' => (bool)get_post_meta($post->ID, 'evento-multiplo', true),
				'diainteiro' => (bool)get_post_meta($post->ID, 'evento-diainteiro', true),
				'inicio' => strtotime(get_post_meta($post->ID, 'evento-inicio', true)),
				'fim' => strtotime(get_post_meta($post->ID, 'evento-fim', true))
			);
		} else {
			$evento = array(
				'multiplo' => false,
				'diainteiro' => true,
				'inicio' => strtotime('+1 hour'),
				'fim' => strtotime('+1 day 1 hour')
			);
		}
		// Inclui o template do formulário
		$THEME_FOLDER = get_template_directory();
		$DS = DIRECTORY_SEPARATOR;
		$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'post_types' . $DS . 'evento' . $DS;
		require_once($META_FOLDER . 'metabox-evento.php');
	}
	
	public function print_evento_details_custom_box() {
		global $post;
		$nonce = wp_create_nonce(__FILE__);
		
		$evento = get_post_meta($post->ID, 'evento-inicio', true);
		if ($post->ID && !empty($evento)) {
			$evento = array(
				'local' => get_post_meta($post->ID, 'evento-local', true),
				'maplink' => get_post_meta($post->ID, 'evento-maplink', true),
				'link' => get_post_meta($post->ID, 'evento-link', true),
				'email' => get_post_meta($post->ID, 'evento-email', true),
				'telefone' => get_post_meta($post->ID, 'evento-telefone', true)
			);
		} else {
			$evento = array(
				'local' => '',
				'maplink' => '',
				'link' => '',
				'email' => '',
				'telefone' => ''
			);
		}
		// Inclui o template do formulário
		$THEME_FOLDER = get_template_directory();
		$DS = DIRECTORY_SEPARATOR;
		$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'post_types' . $DS . 'evento' . $DS;
		require_once($META_FOLDER . 'metabox-detalhes-evento.php');
	}

	public function save_custom_box($post_id) {
		global $post; 
		if ($post->post_type != $this->POST_TYPE) {
			return $post_id;
		}
		$this->save_evento_custom_box($post_id);
	}

	public function save_evento_custom_box($post_id) {
		if (empty($_POST))
			return $post_id;
		// Verifica o nonce
		if (!wp_verify_nonce($_POST['evento_custombox'], __FILE__))
			return $post_id;
		// É um autosave?
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;
		// Não pode editar o Evento?
		if (!current_user_can('edit_post', $post_id))
			return $post_id;

		$fields = array(
			'multiplo', 'diainteiro', 'data_inicio', 'data_fim', 'hora_inicio',
			'hora_fim', 'local', 'maplink', 'link', 'email', 'telefone');
		
		$evento = $_POST['evento'];
		foreach ($evento as $field => &$value) {
			// Verifica se os campos são seguros
			if (in_array($field, $fields)) {
				// Converte as datas
				if (in_array($field, array('data_inicio', 'data_fim')) && preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $value)) {
					list($dia, $mes, $ano) = explode('/', $value);
					$value = $ano . '-' . $mes . '-' . $dia;
					continue;
				// Converte os horários
				} else if (in_array($field, array('hora_inicio', 'hora_fim')) && preg_match('/^\d{2}:\d{2}$/', $value)) {
					switch ($field) {
						case 'hora_inicio':
							$field = 'inicio';
							$value = $evento['data_inicio'] . ' ' . $value . ':00';
							break;
						case 'hora_fim':
							$field = 'fim';
							$value = $evento['data_fim'] . ' ' . $value . ':00';
							break;
					}
				// Converte os booleanos	
				} else if (is_bool($value) || preg_match('/^[01]{,1}$/', $value)) {
					$value = ((bool)$value) ? '1' : '0';
				}
				if (($field == 'fim') && !(bool)$_POST['evento']['multiplo']) {
					$inicio = get_post_meta($post_id, 'evento-inicio', true);
					$value = date('Y-m-d', strtotime($inicio)) . ' ' . date('H:i:s', strtotime($value));
				}
				update_post_meta($post_id, 'evento-' . $field, $value);
			}
		}
		return $evento;
	}

}

Evento::get_instance();