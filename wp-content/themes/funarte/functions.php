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

register_nav_menus( array(
	'principal' => __( 'Menu Principal', 'funarte' ),
) );

// Register Custom Navigation Walker
require_once get_template_directory() . '/assets/lib/class-wp-bootstrap-navwalker.php';

//includes
require_once('inc/traits/post_type.php');
require_once('inc/post_types/edital/edital.php');
require_once('inc/post_types/agenda/agenda.php');