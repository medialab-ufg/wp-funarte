<?php
namespace funarte;

class Edital {
	use Singleton;

	private $POST_TYPE = "edital";

	protected function init() {
		add_action('init', array( &$this, "register_post_type" ));
		add_action('add_meta_boxes', array(&$this, 'add_custom_box'));
		add_action('save_post', array(&$this, 'save_custom_box'));
	}

	public function register_post_type() {
		$POST_TYPE_NAME_PLURAL = "Editais";
		$POST_TYPE_NAME_SINGULAR = "Edital";

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
				taxCategoria::get_instance()->get_name(),
				taxEditais::get_instance()->get_name(),
				taxTag::get_instance()->get_name()
			]
		);

		register_post_type($this->POST_TYPE, $post_type_args);
	}

	public function add_custom_box() {
		add_meta_box('edital_custombox', __( 'Dados e datas do edital'),
					array(&$this, 'edital_custom_box'), $this->POST_TYPE, 'side','high');
	}

	public function save_custom_box($post_id) {
		global $post; 
		if ($post && $post->post_type != $this->POST_TYPE) {
			return $post_id;
		}
		$this->save_edital_custom_box($post_id);
	}

	public function edital_custom_box() {
		global $post;
		$nonce = wp_create_nonce(__FILE__);

		$edital = get_post_meta($post->ID, 'edital-inscricoes_inicio', true);
		date_default_timezone_set("Brazil/East");
		if ($post->ID && !empty($edital)) {
			$edital = array(
				'inscricoes_inicio' => date('d/m/Y', strtotime(get_post_meta($post->ID, 'edital-inscricoes_inicio', true))),
				'inscricoes_fim' => date('d/m/Y', strtotime(get_post_meta($post->ID, 'edital-inscricoes_fim', true))),
				'prorrogado' => (bool)get_post_meta($post->ID, 'edital-prorrogado', true),
				'resultado' => (bool)get_post_meta($post->ID, 'edital-resultado', true)
			);
		} else {
			$edital = array(
				'inscricoes_inicio' => date('d/m/Y'),
				'inscricoes_fim' => date('d/m/Y', strtotime('+1 week')),
				'prorrogado' => false,
				'resultado' => false
			);
		}

		$THEME_FOLDER = get_template_directory();
		$DS = DIRECTORY_SEPARATOR;
		$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'post_types' . $DS . 'edital' . $DS;
		require_once($META_FOLDER . 'metabox-edital.php');
	}

	private function save_edital_custom_box($post_id) {
		if (empty($_POST))
			return $post_id;

		// Verifica o nonce
		if (!wp_verify_nonce($_POST['edital_custombox'], __FILE__))
			return $post_id;

		// É um autosave?
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;

		// Não pode editar o Edital?
		if (!current_user_can('edit_post', $post_id))
			return $post_id;

		$edital = $_POST['edital'];
		foreach ($edital as $field => &$value) {
			// Verifica se os campos são seguros
			if (in_array($field, array('inscricoes_inicio', 'inscricoes_fim', 'prorrogado', 'resultado'))) {
				if (in_array($field, array('inscricoes_inicio', 'inscricoes_fim')) && preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $value)) {
					// Converte a data
					list($dia, $mes, $ano) = explode('/', $value);
					$value = $ano . '-' . $mes . '-' . $dia;
				// Converte os booleanos
				} else {
					$value = (bool)$value;
				}
				update_post_meta($post_id, 'edital-' . $field, $value);
			}
		}
		return $edital;
	}

	public function get_editais($status = 'todos', $params = array()) {
		$hoje = date('Y-m-d');
		$query = array(
			'post_type' => $this->POST_TYPE,
			'posts_per_page' => -1
		);
		
		switch ($status) {
			case 'aberto':
				$query = array_merge($query, array(
					'meta_key' => 'edital-inscricoes_fim',
					'meta_compare' => '>=',
					'meta_value' => $hoje
				));
				break;
			case 'avaliacao':
			case 'resultados':
				$query = array_merge($query, array(
					'meta_key' => 'edital-inscricoes_fim',
					'meta_compare' => '<=',
					'meta_value' => $hoje
				));
				break;
		}
		
		$editais = query_posts($query);
		wp_reset_query();
		
		if ($status != 'todos')
			foreach ($editais as $key => $edital)
				if ($this->get_edital_status($edital->ID) != $status)
					unset($editais[$key]);
		
		if (empty($editais))
			return array();
		
		$ids = array();
		foreach ($editais as &$edital)
			array_push($ids, $edital->ID);
		
		$params = array_merge(array(
			'post__in' => $ids,
			'post_type' => $this->POST_TYPE,
			'orderby' => 'date',
			'order' => 'DESC'
		), $params);
		

		return query_posts($params);
	}

	public function get_edital_status($editalID) {
		$editalID = (int)$editalID;
		if (!(get_post_type($editalID) == $this->POST_TYPE))
			return false;
		$meta = array(
			'inscricoes_inicio' => strtotime(get_post_meta($editalID, 'edital-inscricoes_inicio', true)),
			'inscricoes_fim' => strtotime("+1 day" . (get_post_meta($editalID, 'edital-inscricoes_fim', true))),
			'prorrogado' => (bool)get_post_meta($editalID, 'edital-prorrogado', true),
			'resultado' => (bool)get_post_meta($editalID, 'edital-resultado', true),
		);
		$now = time();
		if (($now > $meta['inscricoes_inicio']) && ($now < $meta['inscricoes_fim']))
			return 'aberto';
		elseif (($now > $meta['inscricoes_fim']) && !$meta['resultado'])
			return 'avaliacao';
		else
			return 'resultado';
		return false;
	}

	public function get_edital_status_name($editalID) {
		return $this->get_edital_status_name_by_slug($this->get_edital_status($editalID));
	}

	public function get_edital_status_name_by_slug($name) {
		switch ($name) {
			case 'aberto':
				return 'Inscrições abertas';
				break;
			case 'avaliacao':
				return 'Em avaliação';
				break;
			case 'resultado':
				return 'Resultado';
				break;
		}
		return null;
	}

	public function get_post_type() {
		return $this->POST_TYPE;
	}
}

Edital::get_instance();