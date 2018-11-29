<?php
	$areasDeInteresse = \funarte\AreaInteresse::get_instance();
	
	$area = get_query_var('cat');
	$area = get_category((int)$area);

	$post_area = get_posts(array(
		'post_type' => $areasDeInteresse->get_post_type_name(),
		'name' => $area->slug,
		'cat' => $area->term_id
	));
	$post_area = end($post_area);
	
	// Se a área de interesse não existir
	if (!$area || empty($area) || !$post_area || empty($post_area)) {
		header("Location: " . get_bloginfo('url')); exit;
	}
	$bodyClass = $area->slug;
	get_header();


	$query = ['cat' => (int)$area->term_id];
	$cat = (isset($query['cat'])) ? get_category($query['cat']) : null;
	
	$destaques = \funarte\DestaqueHome::get_instance()->get_destaques('area', 1, 5, $query);
?>

<main role="main">
  <a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">

		<?php
			$items = [];
			if ( !empty($destaques) && count($destaques) > 1) {
				foreach ($destaques as $destaque) {
					if (!has_post_thumbnail($destaque->ID)) {
						continue;
					}
					$img_url = get_the_post_thumbnail_url($destaque->ID);
					$url = get_post_meta($destaque->ID, 'destaque-url', true);
					$items[] = ['img_url'		=> $img_url,
				 							'title'			=> $destaque->post_title, 
											'descricao'	=> $destaque->post_content,
											'url' 		=> $url];
				}
			}
			$arg = ['items' => $items];
			funarte_load_part('carousel-highlights', $arg);
		?>

	</div>
</main>
	
<?php get_footer();