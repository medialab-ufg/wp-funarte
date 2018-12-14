<?php
add_theme_support( 'post-thumbnails' );

function funarte_load_part($name, $args) {
	$THEME_FOLDER = get_template_directory();
	$DS = DIRECTORY_SEPARATOR;
	$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'template_parts' . $DS;
	extract($args);
	require($META_FOLDER . $name . '.php');
}

function funarte_get_img_default($area='') {
	$base_dir = get_template_directory_uri() . '/assets/img/bkg/';
	switch ($area) {
		case 'artes-integradas':
			$img = 'grafismo_artes_integradas.png';
			break;
		case 'danca':
			$img = 'grafismo_danca.png';
			break;
		case 'funarte':
			$img = 'grafismo_funarte.png';
			break;
		case 'literatura':
			$img = 'grafismo_literatura.png';
			break;
		case 'musica':
			$img = 'grafismo_musica.png';
			break;
		case 'teatro':
			$img = 'grafismo_teatro.png';
			break;
		case 'circo':
			$img = 'grafismo_circo.png';
			break;
		case 'artes-visuais':
			$img = 'grafismo_artes_visuais.png';
			break;
		default:
		$img = 'grafismo.png';
			break;
	}
	return $base_dir . $img;
}

function extra_files() {
	// Fontes
	wp_enqueue_style('google-custom-fonts', '//fonts.googleapis.com/css?family=Roboto:400,400i,700,700i|Sansita:400,400i,700,700i');

	// CSS
	wp_enqueue_style('bootstrap-cdn-style', '//stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css');
	wp_enqueue_style('theme-style', get_stylesheet_uri(), null, microtime());
	wp_enqueue_style('slick-theme-style', get_theme_file_uri() . '/assets/css/plugins/slick-theme.css', null, microtime());
	wp_enqueue_style('slick-style', get_theme_file_uri() . '/assets/css/plugins/slick.css', null, microtime());
	wp_enqueue_style('material-design-icons-cdn-style', '//cdn.materialdesignicons.com/2.8.94/css/materialdesignicons.min.css', null, microtime());
	wp_enqueue_style('main-style', get_theme_file_uri() . '/assets/css/base.min.css', null, microtime());

	// Javascript
	wp_enqueue_script('jquery-cdn', '//code.jquery.com/jquery-2.2.4.min.js', null, microtime(), true);
	wp_enqueue_script('popper-cdn', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', null, microtime(), true);
	wp_enqueue_script('bootstrap-cdn-js', '//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', null, microtime(), true);
	wp_enqueue_script('main-js', get_theme_file_uri() . '/assets/js/base.min.js', null, microtime(), true);
	wp_enqueue_script('slick-js', get_theme_file_uri() . '/assets/js/plugins/slick.min.js', null, microtime(), true);
	wp_enqueue_script('filters-js', get_theme_file_uri() . '/assets/js/filters.js', null, microtime(), true);
}
add_action('wp_enqueue_scripts','extra_files');

function add_files_admin() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-datepicker', array( 'jquery' ) );

	wp_register_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
	wp_enqueue_style( 'jquery-ui' ); 
}
add_action('admin_enqueue_scripts', 'add_files_admin');

register_nav_menus( array(
	'principal' => __( 'Menu Principal', 'funarte' ),
	'rodape' => __( 'Rodapé', 'funarte' )
) );

function get_post_files($postID = null, $params = array(), $exclude = '/^(image\/(jpeg|png|gif)|audio\/)/') {
	global $post;
	$postID = (!is_null($postID)) ? (int)$postID : $post->ID;
	$upload_dir = wp_upload_dir();
	$params = array_merge(array(
		'post_type' => 'attachment',
		'post_parent' => $postID,
		'orderby' => 'menu_order',
		'order' => 'ASC'
	), $params);
	$posts = get_children($params);
	
	if ($exclude && is_string($exclude) && !empty($exclude)) {
		foreach ($posts as $key => &$attachment) {
			if (preg_match($exclude, $attachment->post_mime_type)) {
				unset($posts[$key]);
				continue;
			}
			$attachment->path = str_replace(
				array($upload_dir['baseurl'], '/'),
				array($upload_dir['basedir'], DIRECTORY_SEPARATOR),
				$attachment->guid);
			if (!file_exists($attachment->path)) {
				unset($posts[$key]); continue;
			}
			$attachment->size = filesize($attachment->path);
		}
	}
	return $posts;
}



// Register Custom Navigation Walker
require_once get_template_directory() . '/assets/lib/class-wp-bootstrap-navwalker.php';

require_once('inc/functions.lib.php');
require_once('inc/traits/singleton.php');

// search
require_once('inc/search/search.php');

//includes - taxonomy
require_once('inc/taxonomy/identidade-visual.php');
require_once('inc/taxonomy/categoria_edital.php');
require_once('inc/taxonomy/espaco_cultural.php');
require_once('inc/taxonomy/categoria.php');
require_once('inc/taxonomy/estrutura.php');
require_once('inc/taxonomy/modalidade.php');
require_once('inc/taxonomy/regional.php');
require_once('inc/taxonomy/tag.php');

//includes - post type
require_once('inc/post_types/edital/edital.php');
require_once('inc/post_types/agenda/agenda.php');
require_once('inc/post_types/evento/evento.php');
require_once('inc/post_types/sinopse/sinopse.php');
require_once('inc/post_types/regional/regional.php');
require_once('inc/post_types/licitacao/licitacao.php');
require_once('inc/post_types/estrutura/estrutura.php');
require_once('inc/post_types/destaque_home/destaque_home.php');
require_once('inc/post_types/edicao_online/edicao_online.php');
require_once('inc/post_types/area_interesse/area_interesse.php');
require_once('inc/post_types/nova_aquisicao/nova_aquisicao.php');
require_once('inc/post_types/espaco_cultural/espaco_cultural.php');
require_once('inc/post_types/identidade_visual/identidade_visual.php');

//includes - customizes on pages
require_once('inc/pages/relatorios.php');

//tainacan
require_once('inc/tainacan/tainacan_taxonomy_categoria.php');