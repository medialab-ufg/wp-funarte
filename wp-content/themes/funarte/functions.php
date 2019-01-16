<?php

add_action('after_setup_theme', function() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
});



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

function get_area_class($postID = null) {
	if (is_null($postID)) return false;
	
	$cat = get_the_category($postID);
	if (empty($cat) )
		return ['slug'=>'funarte', 'name'=>'funarte'];
	else 
		return ['slug'=>$cat[0]->slug, 'name'=>$cat[0]->name];
}

function get_pagination() {

	if ( is_singular() ) {
		return;
	}

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	$cur_posts = min( (int) $wp_query->get( 'posts_per_page' ), $wp_query->found_posts );
	$to_paged = max( (int) $wp_query->get( 'paged' ), 1 );
	$count_max = ( $to_paged - 1 ) * $cur_posts;
	/** Add current page to the array */
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}

	/** Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	} ?>

	<div class="box-pagination">
		<span class="box-pagination__list">
			<?php
				/** Link to first page, plus ellipses if necessary */
				if ( ! in_array( 1, $links ) ) {
					$class = 1 == $paged ? ' class="active"' : '';

					printf( '<a%s href="%s">%s</a>,' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

					if ( ! in_array( 2, $links ) ) {
						echo '<span>&hellip;</span>';
					}
				}

				/** Link to current page, plus 2 pages in either direction if necessary */
				sort( $links );
				foreach ( (array) $links as $link ) {
					$class = $paged == $link ? ' class="active"' : '';
					printf( '<a%s href="%s">%s</a>,' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
				}

				/** Link to last page, plus ellipses if necessary */
				if ( ! in_array( $max, $links ) ) {
					if ( ! in_array( $max - 1, $links ) ) {
						echo '<span>&hellip;</span>' . "\n";
					}

					$class = $paged == $max ? ' class="active"' : '';
					printf( '<a%s href="%s">%s</a>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
				}
			?>
		</span>
		<div class="box-pagination__control">
			<?php /** Previous and Next Post Link */
				if ( get_previous_posts_link() ) {
					printf( '%s', get_previous_posts_link( '<i class="mdi mdi-chevron-left"></i>' ) );
				}
				if ( get_next_posts_link() ) {
					printf( '%s', get_next_posts_link( '<i class="mdi mdi-chevron-right"></i>' ) );
				}
			?>
		</div>
	</div>
<?php }

function extra_files() {
	// Fontes
	wp_enqueue_style('google-custom-fonts', '//fonts.googleapis.com/css?family=Roboto:400,400i,700,700i|Sansita:400,400i,700,700i');

	// CSS
	wp_enqueue_style('bootstrap-cdn-style', get_theme_file_uri() . '/assets/css/plugins/bootstrap.min.css');
	wp_enqueue_style('theme-style', get_stylesheet_uri(), null, microtime());
	wp_enqueue_style('slick-theme-style', get_theme_file_uri() . '/assets/css/plugins/slick-theme.css', null, microtime());
	wp_enqueue_style('slick-style', get_theme_file_uri() . '/assets/css/plugins/slick.css', null, microtime());
	wp_enqueue_style('material-design-icons-cdn-style', get_theme_file_uri() . '/assets/css/plugins/materialdesignicons.min.css', null, microtime());
	wp_enqueue_style('main-style', get_theme_file_uri() . '/assets/css/base.min.css', null, microtime());

	// Javascript
	wp_enqueue_script('jquery-cdn', get_theme_file_uri() . '/assets/js/plugins/jquery-2.2.4.min.js', null, microtime(), true);
	wp_enqueue_script('popper-cdn', get_theme_file_uri() . '/assets/js/plugins/popper.min.js', null, microtime(), true);
	wp_enqueue_script('bootstrap-cdn-js', get_theme_file_uri() . '/assets/js/plugins/bootstrap.min.js', null, microtime(), true);
	wp_enqueue_script('main-js', get_theme_file_uri() . '/assets/js/base.min.js', null, microtime(), true);
	wp_enqueue_script('slick-js', get_theme_file_uri() . '/assets/js/plugins/slick.min.js', null, microtime(), true);
	wp_enqueue_script('filters-js', get_theme_file_uri() . '/assets/js/filters.js', null, microtime(), true);
}
add_action('wp_enqueue_scripts','extra_files');

function add_files_admin() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-datepicker', array( 'jquery' ) );

	wp_register_style('jquery-ui', get_theme_file_uri() . '/assets/css/plugins/jquery-ui.css');
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

//  COrrige link errado que o tainacan gerava até 0.6.1 
add_filter('post_type_link', function($permalink, $post, $leavename) {
	
	if ( ! class_exists('\Tainacan\Entities\Collection')) {
		return $permalink;
	}
	
	$collection_post_type = \Tainacan\Entities\Collection::get_post_type();
	
	if (!is_admin() && $post->post_type == $collection_post_type) {
		$permalink = str_replace(site_url(), home_url(), $permalink);
	}
	
	return $permalink;
	
}, 15, 3);

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
require_once('inc/post_types/post/post.php');
require_once('inc/post_types/edital/edital.php');
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
require_once('inc/post_types/link_relacionado/link_relacionado.php');
require_once('inc/post_types/identidade_visual/identidade_visual.php');

//includes - customizes on pages
require_once('inc/pages/relatorios.php');
require_once('inc/options/options_config.php');

//tainacan
require_once('inc/tainacan/tainacan_taxonomy_categoria.php');