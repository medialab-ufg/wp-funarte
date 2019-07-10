<?php
namespace funarte;

class Evento {
	use Singleton;

	protected $POST_TYPE = "evento";

	protected function init() {
		add_action('init', array( &$this, "register_post_type" ));
		add_action('add_meta_boxes', array(&$this, 'add_custom_box'));
		add_action('save_post', array(&$this, 'save_custom_box'));
		
		add_action('wp_ajax_get_events_by_day', array(&$this, 'ajax_get_events_by_day'));
		add_action('wp_ajax_nopriv_get_events_by_day', array(&$this, 'ajax_get_events_by_day'));
		
		add_action('wp_ajax_get_events_by_period', array(&$this, 'ajax_get_events_by_period'));
		add_action('wp_ajax_nopriv_get_events_by_period', array(&$this, 'ajax_get_events_by_period'));
		
		add_action('wp_ajax_evento_create_related_post', array(&$this, 'ajax_create_related_post'));
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
			'exclude_from_search' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'permalink', 'revisions'),
			'taxonomies' => array(
				taxEspacosCulturais::get_instance()->get_name(),
				taxCategoria::get_instance()->get_name(),
				taxTag::get_instance()->get_name(),
				taxRegional::get_instance()->get_name())
		);

		register_post_type($this->POST_TYPE, $post_type_args);
	}

	public function add_custom_box() {
		add_meta_box('evento_custombox', __( 'Datas e horários do evento'),
			array(&$this, 'evento_custom_box'), $this->POST_TYPE, 'side', 'high');

			add_meta_box('evento_details_custombox', __( 'Detalhes do evento'),
			array(&$this, 'evento_details_custom_box'), $this->POST_TYPE, 'advanced', 'high');
	}

	public function evento_custom_box() {
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
	
	public function evento_details_custom_box() {
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
		if ($post && $post->post_type != $this->POST_TYPE) {
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

	public function get_eventos_from_month($mes = null, $ano = null, $params = array()) {
		$mes = (empty($mes)) ? date('m') : (int)$mes;
		$ano = (empty($ano)) ? date('Y') : (int)$ano;

		$timestamp = mktime(0, 0, 0, $mes, 1, $ano);
		$dia_final = mktime(23, 59, 59, $mes, date('t', $timestamp), $ano);

		$params = array_merge(array(
			'post_type' 	=> $this->POST_TYPE,
			'posts_per_page'	=> -1,
			'meta_query' => array(
				'relation' => 'AND',
				'evento-inicio' => ['key'     => 'evento-fim',
														'value'   => date('Y-m-d H:i:s',mktime(0, 0, 0, $mes, 1, $ano)),
														'compare' => '>='],
				'evento-fim'=> ['key'     => 'evento-inicio',
												'value'   => date('Y-m-d H:i:s',mktime(23, 59, 59, $mes, date('t', $timestamp), $ano)),
												'compare' => '<=']
			),
			'order'			=> 'ASC',
			'orderby' 	=> 'meta_value',
			'meta_key'	=> 'evento-inicio'
		), $params);

		return query_posts($params);
	}

	public function get_last_eventos($params = array()) {
		
		$query = array(
			'paged' => false,
			'post_type' => 'evento',
			'orderby' => 'meta_value',
			'order' => 'ASC',
			'meta_key' => 'evento-inicio',
			'meta_query' => [
				'meta_inicio' => [
					'key' => 'evento-inicio',
					'compare' => 'EXISTS',
				],
				[
					'key' => 'evento-fim',
					'compare' => '>=',
					'value' => date('Y-m-d')
				],
				'relation' => 'AND'
			]
		);
		
		$params = array_merge($query, $params);
		return query_posts($params);
	}
	
	public function get_post_type() {
		return $this->POST_TYPE;
	}
	
	/**
	* Retorna todos os evenos que acontecem em um dia, ou seja
	* que começam hoje ou antes de hoje e terminam hoje ou depois de Hoje
	* 
	* @param $date Objeto DateTime com a data a ser buscada 
	* @param $param opcional. parametros adicionais de busca por eventos 
	* @return array 
	*/
	function get_events_by_day(\DateTime $date, $params = []) {
		
		$inicio = $date->format('Y-m-d') . ' 23:59:59';
		$fim = $date->format('Y-m-d') . ' 00:00:00';
		$meta_q = isset($params['meta_query']) ? $params['meta_query'] : [];
		
		$meta_query = array_merge($meta_q, [
			[
				'key' => 'evento-inicio',
				'value' => $inicio,
				'compare' => '<='
			],
			[
				'key' => 'evento-fim',
				'value' => $fim,
				'compare' => '>='
			]
		]);
		
		$params = array_merge(array(
			'post_type' 	=> $this->POST_TYPE,
			'posts_per_page' 	=> -1,
			'meta_query' => $meta_query
		), $params);
		
		return new \WP_Query($params);
	}
	
	
	/**
	* Espera data no formato timestamp
	*/
	function ajax_get_events_by_day() {
		
		$day = $_GET['day'];
		$response = [];
		
		if ( is_numeric($day) ) {
			$day = intval($day);
			$datestring = date('Y-m-d', (int) $day);
			$date = new \DateTime($datestring);
			
			$extra_args = [];
			$extra_args['tax_query'] = [];
			
			if (isset($_GET['local']) && is_numeric($_GET['local'])) {
				$extra_args['tax_query'][] = [
					'taxonomy' => 'espacos-culturais',
					'terms' => (int) $_GET['local'],
				];
			}
			
			if (isset($_GET['area']) && is_numeric($_GET['area'])) {
				$extra_args['tax_query'][] = [
					'taxonomy' => 'category',
					'terms' => (int) $_GET['area'],
				];
			}
			
			$events = $this->get_events_by_day($date, $extra_args);
			
			while ($events->have_posts()) {
				$events->the_post();
				
				$areas = get_the_category();
				$areaNome = '';
				$areaSlug = '';
				$areaLink = '';
				if (sizeof($areas) > 0) {
					$area = $areas[0];
					$areaNome = $area->name;
					$areaSlug = $area->slug;
					$areaLink = get_term_link($area);
				}
				
				$dataInicial_meta = get_post_meta(get_the_ID(), 'evento-inicio', true);
				$dataInicial = preg_replace('/(\d{4})-(\d{2})-(\d{2})(.+)/','$3/$2/$1', $dataInicial_meta);
				$horaInicial = preg_replace('/(.+) (\d{2}):(\d{2}):(\d{2})/','$2:$3', $dataInicial_meta);
				
				$dataFinal = get_post_meta(get_the_ID(), 'evento-fim', true);
				$dataFinal = preg_replace('/(\d{4})-(\d{2})-(\d{2})(.+)/','$3/$2/$1', $dataFinal);
				
				$imagem = '';
				if ( has_post_thumbnail() ) {
					$imagem = get_the_post_thumbnail_url(get_the_ID(),'medium_large');
				}
				
				$titulo = get_the_title();
				
				$horario = $horaInicial;
				$endereco = get_post_meta(get_the_ID(), 'evento-local', true);
				$texto  = get_the_excerpt();
				$url = get_permalink();

				$response[] = [
					"dataInicial" => $dataInicial,
					"dataFinal" => $dataFinal,
					"areaLink" => $areaLink,
					"areaNome" => $areaNome,
					"areaSlug" => $areaSlug,
					"imagem" => $imagem,
					"titulo" => $titulo,
					"horario" => $horario,
					"endereco" => $endereco,
					"texto" => $texto,
					"url" => $url
				];
				
			}
				
			
		}
		
		echo json_encode($response);
		
		die;
		
	}

	function get_prepared_events_by_month($month, $year) {
		$response = [];
		$timestamp = mktime(1, 1, 1, $month, 1, $year);
		$days_in_month  = date('t', $timestamp);
		
		for($day=1; $day <= $days_in_month; $day++) {
			$response['events'][sprintf("%'.02d", $day) . '/' . sprintf("%'.02d", $month) . '/'. $year] = [];
		}

		$events = $this->get_eventos_from_month($month, $year);

		foreach ($events as $event) {
			$cat = get_the_category($event->ID);
			if($cat && isset($cat)) $cat = $cat[0];
			else $cat = ['slug'=>'funarte', 'name'=>'funarte'];
			$local =  get_post_meta($event->ID, 'evento-local', true);

			$inicio  = strtotime(get_post_meta($event->ID, 'evento-inicio', true));
			$hora_inicio = date('H:i', $inicio);  
			$dia_inicio  = date('d/m/Y',$inicio);

			$fim 	= strtotime(get_post_meta($event->ID, 'evento-fim', true));
			$hora_fim = date('H:i', $fim);  
			$dia_fim 	= date('d/m/Y', $fim);

			$multiplo = (bool)get_post_meta($event->ID, 'evento-multiplo', true);

			if($multiplo) {
				$day_point = $inicio;
				while($day_point <= $fim && $day_point <= mktime(23, 59, 59, $month, $days_in_month, $year)) {
					$dia_inicio  = date('d/m/Y', $day_point);
					$response['events'][$dia_inicio][] = [
						'ID' => $event->ID,
						'title' => $event->post_title,
						'local' => $local,
						'cat' => $cat,
						'hora' => ['inicio'=>$hora_inicio, 'fim' => $hora_fim]
					];
					$day_point = strtotime('+1 day', $day_point);
				}
			} else {
				$response['events'][$dia_inicio][] = [
					'ID' => $event->ID,
					'title' => $event->post_title,
					'local' => $local,
					'cat' => $cat,
					'hora' => ['inicio'=>$hora_inicio, 'fim' => $hora_fim]
				];
			}
		}
		return $response;
	}

	/**
	* Retorna todos os evenos que acontecem dentro de um intervalo
	* 
	* @param $center_date Objeto DateTime com a data central do intervalo 
	* @param $length opcional. tamanho do intervalo pretendido 
	* @return array 
	*/
	function get_events_by_period(\DateTime $center_date, $length_left = 15, $length_right = 15, $param = []) {
		$response = [];
		$begin = clone $center_date;
		$end = clone $center_date;
		date_add($end,  date_interval_create_from_date_string($length_right." days"));
		date_sub($begin,date_interval_create_from_date_string($length_left." days"));
		
		if ($length_right == 0)
			$end->modify('yesterday');
		
			if ($length_left == 0)
			$begin->modify('tomorrow');
		

		$end->modify('tomorrow')->modify('1 second ago');
		$interval = \DateInterval::createFromDateString('1 day');
		$period = new \DatePeriod($begin, $interval, $end);
		foreach ($period as $dt) {
			$date = date('d/m/Y', $dt->getTimestamp());
			$response['events'][$date] = [];
		}


		if (!empty($_GET['area'])) {
			$area = get_category_by_name($_GET['area']);
			if (!empty($area))
				$cat = $area->term_id;
		}

		$params = array(
			'post_type' 	=> $this->POST_TYPE,
			'posts_per_page'	=> -1,
			'cat' => isset($cat) ? $cat : null,
			'meta_query' => array(
				'relation' => 'AND',
				'evento-fim' => ['key'     => 'evento-fim',
													'value'   => date('Y-m-d H:i:s', $begin->getTimestamp()),
													'compare' => '>='],
				'evento-inicio'=> ['key'     => 'evento-inicio',
												'value'   => date('Y-m-d H:i:s', $end->getTimestamp()),
												'compare' => '<=']
			),
			'orderby' => ['evento-inicio' => 'ASC']
		);

		if (isset($_GET['local']) && is_numeric($_GET['local'])) {
			$extra_args = [];
			$extra_args['tax_query'] = [[
				'taxonomy' => 'espacos-culturais',
				'terms' => (int) $_GET['local'],
			]];
			$params = array_merge($params, $extra_args);
		}
		
		$events = query_posts($params);
		foreach ($events as $event) {
			$cat = get_the_category($event->ID);
			if($cat && isset($cat)) $cat = $cat[0];
			else $cat = ['slug'=>'funarte', 'name'=>'funarte'];
			$local =  get_post_meta($event->ID, 'evento-local', true);

			$inicio  = strtotime(get_post_meta($event->ID, 'evento-inicio', true));
			$hora_inicio = date('H:i', $inicio);  
			$dia_inicio  = date('d/m/Y',$inicio);

			$fim_evento 	= strtotime(get_post_meta($event->ID, 'evento-fim', true));
			$hora_fim = date('H:i', $fim_evento);  
			$dia_fim 	= date('d/m/Y', $fim_evento);

			$multiplo = (bool)get_post_meta($event->ID, 'evento-multiplo', true);

			if($multiplo) {
				$day_point = $inicio < $begin->getTimestamp() ? $begin->getTimestamp() : $inicio;
				while($day_point <= $fim_evento && $day_point <= $end->getTimestamp() ) {
					$dia_inicio  = date('d/m/Y', $day_point);
					$response['events'][$dia_inicio][] = [
						'ID' => $event->ID,
						'permalink' => get_permalink($event->ID),
						'title' => $event->post_title,
						'local' => $local,
						'cat' => $cat,
						'hora' => ['inicio'=>$hora_inicio, 'fim' => $hora_fim]
					];
					$day_point = strtotime('+1 day', $day_point);
				}
			} else {
				$response['events'][$dia_inicio][] = [
					'ID' => $event->ID,
					'permalink' => get_permalink($event->ID),
					'title' => $event->post_title,
					'local' => $local,
					'cat' => $cat,
					'hora' => ['inicio'=>$hora_inicio, 'fim' => $hora_fim]
				];
			}
		}
		return $response;
	}
	
	public function get_evento_related_post_metabox_content($event_id) {
		$post_id = get_post_meta($event_id, '_related_post', true);
		$event_status = get_post_status($event_id);
		if ($post_id) {
			$post = get_post($post_id);
			$return = $post->post_title . ' ( ';
			$return .= '<a href="' . get_edit_post_link($post_id) . '" target="_blank">Editar</a>';
			if ($post->post_status == 'publish') {
				$return .= ' | <a href="' . get_permalink($post_id) . '" target="_blank">Ver</a>';
			}
			
			$return .= ' )';
			
			return $return;
			
		} elseif ( $event_status == 'publish' ) {
			return '<input type="button" class="button" value="Criar notícia relacionada" id="criar-noticia-relacionada" />';
		} else {
			return '<input type="button" class="button" disabled="disabled" value="Criar notícia relacionada" id="criar-noticia-relacionada" /><br/><small>É preciso publicar o evento primeiro</small>';
		}
	}
	
	public function ajax_create_related_post() {
		$event_id = $_GET['event_id'];
		$this->create_related_post($event_id);
		echo $this->get_evento_related_post_metabox_content($event_id);
		die;
	}
	
	public function create_related_post($event_id) {
		$event = get_post($event_id);

		$data_inicio	= strtotime(get_post_meta($event_id, 'evento-inicio', true));
		$data_fim			= strtotime(get_post_meta($event_id, 'evento-fim', true));
		$hora_inicio	= date_i18n('H:i', $data_inicio);
		$hora_fim			= date_i18n('H:i', $data_fim);
		$dia_inteiro	= (bool)get_post_meta($event_id, 'evento-diainteiro', true);
		$multiplo			= (bool)get_post_meta($event_id, 'evento-multiplo', true);

		$content = $event->post_content;
		
		$box = "\n\n";
		
		$box .= '<strong>Informações ao público:</strong>';
		$box .= "\n";
		if ($ev_tel = get_post_meta($event_id, 'evento-telefone', true)) {
				$box .= '<span>' . $ev_tel . '</span>';
				$box .= "\n";
		}
		if ($ev_email = get_post_meta($event_id, 'evento-email', true)) {
			$box .= '<a href="mailto:' . $ev_email . '">' . $ev_email . '</a>';
			$box .= "\n";
		}
		if ($ev_site = get_post_meta($event_id, 'evento-link', true)) {
			$box .= '<a href="' . $ev_site . '" rel="nofollow">' . $ev_site . '</a>';
			$box .= "\n";
		}
		
		if ($ev_local = get_post_meta($event_id, 'evento-local', true)){
			$box .= '<span><b>Local:</b></span>';
			$box .= "\n";
			$box .= '<span>' . $ev_local . '</span>';
			$box .= "\n";
		}

		if ($multiplo) {
			$box .= '<span><b>Dias: </b></span>';
			$box .= '<span>De ' . date_i18n('j \d\e F', $data_inicio) . ' a ' . date_i18n('j \d\e F \d\e Y', $data_fim) . '</span>';
			$box .= "\n";
		} else {
			$box .= '<span><b>Dia:</b></span>';
			$box .= '<span>' . date_i18n('j \d\e F \d\e Y', $data_inicio) . '</strong></span>';
			$box .= "\n";
		}

		if ($dia_inteiro) {
			$box .= '<span><b>Horário: </b></span>';
			$box .= '<span>Evento de dia inteiro</span>';
			$box .= "\n";
		} elseif (!$multiplo && ($hora_inicio == $hora_fim)) {
			$box .= '<span><b>Horário: </b></span>';
			$box .= '<span>' . $hora_inicio . '</span>';
			$box .= "\n";
		} else {
			$box .= '<span><b>Horário: </b></span>';
			$box .= '<span>' . $hora_inicio . ' às ' . $hora_fim . '</span>';
			$box .= "\n";
		}
		
		$content .= $box;
		
		$post = [
			'post_title' => $event->post_title,
			'post_status' => 'draft',
			'post_content' => $content
		];
		
		$new_post = wp_insert_post($post);
		
		if (is_int($new_post)) {
			update_post_meta($event_id, '_related_post', $new_post);
			return $new_post;
		}
		return false;
		
	}

	/**
	* Espera data no formato timestamp
	*/
	function ajax_get_events_by_period() {
		$day 		= $_GET['day'];
		$left 	= isset($_GET['left'])  ? $_GET['left']  : 15;
		$rigth 	= isset($_GET['rigth']) ? $_GET['rigth'] : 15;
		$local 	= isset($_GET['local']) ? $_GET['local'] : '';
		$area 	= isset($_GET['area'])  ? $_GET['area']  : '';
		
		$timestamp = strtotime(str_replace("/", "-", $day));
		$datestring = date('d-m-Y', $timestamp);
		$date = new \DateTime($datestring);
		$response = $this->get_events_by_period($date, $left, $rigth, ['area' => $area, 'local' => $local]);
		wp_send_json($response, 200);
	}
}

Evento::get_instance();