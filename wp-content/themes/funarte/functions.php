<?php

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
) );

// Register Custom Navigation Walker
require_once get_template_directory() . '/assets/lib/class-wp-bootstrap-navwalker.php';

require_once('inc/traits/singleton.php');
//includes - taxonomy
require_once('inc/taxonomy/identidade-visual.php');
require_once('inc/taxonomy/categoria_edital.php');
require_once('inc/taxonomy/espaco_cultural.php');
require_once('inc/taxonomy/categoria.php');
require_once('inc/taxonomy/estrutura.php');
require_once('inc/taxonomy/licitacao.php');
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