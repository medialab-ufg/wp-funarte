<?php
namespace funarte;

class Search {
	use Singleton;


	protected function init() {
		add_action('pre_get_posts', [$this, 'pre_get_posts']);
	}
	
	function pre_get_posts($wp_query) {
		if ( $wp_query->is_main_query() && $wp_query->is_search() && !is_admin() ) {
			
			if (isset($_GET['search_type'])) {
				$groups = $this->get_search_post_types_groups();
				if (isset($groups[$_GET['search_type']])) {
					$post_types = $groups[$_GET['search_type']]['post_types'];
					$wp_query->set('post_type', $post_types);
				}
				
			}
			
			if (isset($_GET['area'])) {
				$wp_query->set('cat', $_GET['area']);
			}
			
			if (isset($_GET['ordenar'])) {
				switch ($_GET['ordenar']) {
					case 'title':
						$wp_query->set('orderby', 'post_title');
						$wp_query->set('order', 'ASC');
						break;
					case 'date_asc':
						$wp_query->set('order', 'ASC');
				}
			}
			
		}
	}
	
	
	function get_search_post_types_groups() {
		return $post_types = [
			'noticias' => [
				'label' => 'Notícias',
				'post_types' => [
					'post'
				]
			],
			'espacos' => [
				'label' => 'Espaços Culturais',
				'post_types' => [
					'espaco-cultural'
				]
			],
			'editais' => [
				'label' => 'Editais',
				'post_types' => [
					'edital'
				]
			],
			'eventos' => [
				'label' => 'Eventos',
				'post_types' => [
					'evento',
				]
			],
			'acervos' => [
				'label' => 'Acervos',
				'post_types' => [
					'tainacan-collection'
				]
			],
			'itens-de-acervo' => [
				'label' => 'Itens de Acervo',
				'post_types' => $this->get_items_post_types()
			],
			'contatos' => [
				'label' => 'Contatos',
				'post_types' => [
					'estrutura'
				]
			],
			'contratos' => [
				'label' => 'Licitações',
				'post_types' => [
					'licitacao'
				]
			],
			'outros' => [
				'label' => 'Outros',
				'post_types' => [
					'page',
					'identidade-visual'
				]
			],
		];
	}
	
	function get_items_post_types() {
		
		if (! class_exists('\Tainacan\Repositories\Repository') ) {
			return ['none'];
		}
		
		return \Tainacan\Repositories\Repository::get_collections_db_identifiers();;
	}
	
	function get_post_types_search_count($post_types, $search = '', $cat = null) {
		$args = [
			'post_type' => $post_types,
			's' => $search,
			'posts_per_page' => 1
		];
		if (!is_null($cat)) {
			$args['cat'] = $cat;
		}
		$query = new \WP_Query($args);
		return $query->found_posts;
	}
	
	function get_group_search_count($group) {
		$groups = $this->get_search_post_types_groups();
		if (isset($groups[$group])) {
			$search = '';
			$cat = null;
			if (isset($_GET['s'])) {
				$search = $_GET['s'];
			}
			
			if (isset($_GET['area'])) {
				$cat = $_GET['area'];
			} 
			
			return $this->get_post_types_search_count($groups[$group]['post_types'], $search, $cat);
		}
		return 0;
	}
	
	function active_class($group) {
		if (isset($_GET['search_type'])) {
			if ($_GET['search_type'] == $group) {
				return 'active';
			}
		}
	}

	
}

Search::get_instance();