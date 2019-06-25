	<?php
	get_header();

	$eventos = \funarte\Evento::get_instance()->get_eventos_from_month(date('m'), date('Y'));
	// para desenvolvimento e testes deixamos fixo no ano passado onde há mais eventos
	// $eventos = \funarte\Evento::get_instance()->get_eventos_from_month(10, 2018, $query_eventos);
	if (empty($eventos)) {
		$query_eventos = ['posts_per_page' => 20];
		$eventos = \funarte\Evento::get_instance()->get_last_eventos($query_eventos);
	}
	$query_news = ['post_type' => 'post', 'posts_per_page' => 9, 'paged' => false, 'meta_query' => [['key' => 'nao-destacar-home', 'compare' => 'NOT EXISTS']], 'orderby' => 'date', 'order' => 'DESC'];
	$noticias = query_posts($query_news);
	$destaques = \funarte\DestaqueHome::get_instance()->get_destaques('home', 1, 5);
	$destaque_secundario = \funarte\DestaqueHome::get_instance()->get_destaque_secundario();
	$editais = \funarte\Edital::get_instance()->get_editais('todos');
?>

<main role="main" class="mb-100">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">
		<?php
			$items = [];
			if ( !empty($destaques) && count($destaques) > 1) {
				foreach ($destaques as $destaque) {
					if (!has_post_thumbnail($destaque->ID)) {
						continue;
					}
					$img_url = get_the_post_thumbnail_url($destaque->ID, 'funarte-destaques');
					$url = get_post_meta($destaque->ID, 'destaque-url', true);
					$items[] = ['img_url'		=> $img_url,
				 							'title'			=> $destaque->post_title, 
											'descricao'	=> $destaque->post_content,
											'url' 			=> $url];
				}
			}
			$arg = ['items' => $items];
			funarte_load_part('carousel-highlights', $arg);
		?>
	</div>

	<?php
		$items = [];
		foreach ($editais as $edital) {
			//$area = get_the_category($edital->ID);
			$area = get_area_class($edital->ID);
			$items[] = ['tag_class_area'=>$area['slug'],//$area[0]->slug,
									'tag_name_area'=>$area['name'],//$area[0]->name,
									'tag_url_area'=>get_category_link( $area['ID'] ),//$area[0]->cat_ID ),
									'tag_subname_area'=>\funarte\Edital::get_instance()->get_edital_status($edital->ID),
									'title' => $edital->post_title ,
									'url'=>get_permalink($edital->ID)];
		}
		
		$area = get_area_class($destaque_secundario->ID);
		$arg = ['title'=> 'Editais', 'url_title'=> get_post_type_archive_link(\funarte\Edital::get_instance()->get_post_type()),
											'items' => $items,
											'destaque' => [
														'url'=> get_post_meta($destaque_secundario->ID, 'destaque-url', true),
														'title'=> $destaque_secundario->post_title,
														'tag_name_area'=>$area['name'], //$area[0]->name,
														'tag_class_area'=>$area['slug'], //$area[0]->slug,
														'content'=> $destaque_secundario->post_content,
														'img_url'=> get_the_post_thumbnail_url($destaque_secundario->ID)]
		];
		funarte_load_part('notices-highlights', $arg);
	?>

	<!-- NOTICIAS -->
	<?php
		$items = [];
		foreach ($noticias as $noticia) {
			$area = get_area_class($noticia->ID);
			$link_area = $area['ID'] != null ? get_category_link( $area['ID'] ) : '';
			$img = get_the_post_thumbnail_url($noticia->ID, 'funarte-medium');
			//$area = get_the_category($noticia->ID);
			$items[] = ['tag_class_area'=>$area['slug'],//$area[0]->slug,
									'tag_name_area' =>$area['name'],//$area[0]->name,
									'tag_url_area'=>$link_area,
									'tag_subname_area'=>'',
									'title' => $noticia->post_title,
									'url'=> get_permalink($noticia->ID),
									'content'=> get_the_excerpt($noticia->ID),
									'url_img'=> $img ? $img : null];
		}
		$arg = ['items' => $items, 'more_news_url' => '/noticias'];
		funarte_load_part('box-news', $arg);
	?>
	<!-- FIM NOTICIAS -->

	<!-- EVENTOS -->
	<div class="container">
		<?php
			$items = [];
			foreach ($eventos as $evento) {
				$area = get_the_category($evento->ID);
				if ($area == null || empty($area)) {
					$area = new stdClass();
					$area->slug = 'funarte';
				} else {
					$area = $area[0];
				}
				
				$inicio = strtotime('00:00:00', strtotime(get_post_meta($evento->ID, 'evento-inicio', true)));
				$fim = strtotime('23:59:59', strtotime(get_post_meta($evento->ID, 'evento-fim', true)));
				$local = get_post_meta($evento->ID, 'evento-local', true);
				$schedule = strtotime(get_post_meta($evento->ID, 'evento-inicio', true));

				if (($inicio <= time()) && ($fim >= time())) {
					$day = date_i18n('d');
					$month = date_i18n('M');
					$month_mumber = date_i18n('m');
					$year = date_i18n('Y');
				} else {
					$day = date_i18n('d', $inicio);
					$month = date_i18n('M', $inicio);
					$month_mumber = date_i18n('m', $inicio);
					$year = date_i18n('Y', $inicio);
				}
				$url_img = has_post_thumbnail($evento->ID) ? get_the_post_thumbnail_url($evento->ID,'medium_large') : funarte_get_img_default($area->slug);
				$items[] = ['url' => get_permalink($evento->ID),
 										'day'=> $day,
										'month'=> $month,
										'month_mumber' => $month_mumber,
										'year' => $year,
										'local' => $local,
										'title' => $evento->post_title,
										'url_img' => $url_img,
										'content' => 	get_the_excerpt($evento->ID),
 										'schedule' => date_i18n('H:i', $schedule),
 										'tag_class_area'=>$area->slug];
			}
			$arg = ['items' => $items];
			funarte_load_part('schedule-events', $arg);
		?>
	</div>

	<div class="container">
		<section class="box-carousel-collection">
		<?php 
			$url_title = get_post_type_archive_link('tainacan-collection');

			$collections = new WP_Query([
				'post_type' => 'tainacan-collection',
				'posts_per_page' => -1
			]);
			
			funarte_load_part('collections-carousel', ['collections' => $collections, 'url_title' => $url_title, 'title' =>'Acervo']);
		?>
		</section>
	</div>
</main>

<?php
	get_footer();
?>