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

	$collections = new WP_Query([
		'post_type' => 'tainacan-collection',
		'posts_per_page' => -1,
		'cat' => $area->term_id
	]);
	
	// Se a área de interesse não existir
	if (!$area || empty($area) || !$post_area || empty($post_area)) {
		header("Location: " . get_bloginfo('url')); exit;
	}
	$bodyClass = $area->slug;
	get_header();

	$query = ['cat' => (int)$area->term_id];
	$cat = (isset($query['cat'])) ? get_category($query['cat']) : null;
	$destaques = \funarte\DestaqueHome::get_instance()->get_destaques('area', 1, 5, $query);
	$destaque_secundario = \funarte\DestaqueHome::get_instance()->get_destaque_secundario('area',$query);
	$espacos = \funarte\EspacoCultural::get_instance()->get_espacos($query);
	$editais = \funarte\Edital::get_instance()->get_editais('todos', $query);

	$query_news = ['cat' => (int)$area->term_id, 'post_type' => 'post', 'posts_per_page' => 9, 'paged' => false, 'orderby' => 'date', 'order' => 'DESC'];
	$noticias = new WP_Query($query_news);

	$query_eventos = ['cat' => (int)$area->term_id, 'posts_per_page' => 10 ];
	$eventos = \funarte\Evento::get_instance()->get_eventos_from_month(date('m'),date('Y'), $query_eventos);
	if (empty($eventos)) {
		$eventos = \funarte\Evento::get_instance()->get_last_eventos($query_eventos);
	}

	$query_links_relacionados = ['cat' => (int)$area->term_id, 'orderby' => 'menu_order', 'order' => 'ASC', 'post_type' => \funarte\LinkRelacionado::get_instance()->get_post_type(), 'posts_per_page' => -1];
	$links_relacionados = new WP_Query($query_links_relacionados);
?>

<main role="main" class="mb-100">
  <a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">
		<?php
			//CAROUSEL-HIGHLIGHTS
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
								'descricao'		=> $destaque->post_content,
								'url'			=> $url];
				}
			}
			$arg = ['items' => $items];
			funarte_load_part('carousel-highlights', $arg);
			//FIM-CAROUSEL-HIGHLIGHTS
		?>
	</div>

	<!-- EDITAIS -->
	<?php
		$items = [];
		foreach ($editais as $edital) {
			$items[] = ['tag_class_area'=>$area->slug,
									'tag_name_area'=>$area->name,
									'tag_url_area'=>get_category_link( $area->cat_ID ),
									'tag_subname_area'=>\funarte\Edital::get_instance()->get_edital_status($edital->ID),
									'title' => $edital->post_title ,
									'url'=>get_permalink($edital->ID)];
		}
		$arg = ['title'=> 'Editais', 'url_title'=> get_post_type_archive_link(\funarte\Edital::get_instance()->get_post_type()) . '?area=' . $area->slug,
						'items' => $items,
						'destaque' => ['url'=> get_post_meta($destaque_secundario->ID, 'destaque-url', true),
													 'title'=> $destaque_secundario->post_title,
													 'tag_name_area'=>$area->name,
													 'tag_class_area'=>$area->slug,
													 'content'=> $destaque_secundario->post_content,
													 'img_url'=> get_the_post_thumbnail_url($destaque_secundario->ID)]
		];
		funarte_load_part('notices-highlights', $arg);
	?>
	<!-- FIM EDITAIS -->

	<!-- NOTICIAS -->
	<?php
		$items = [];
		while ($noticias->have_posts()) {
			
			$noticias->the_post();
			
			$subtitle = '';
			if (get_the_subtitle()) {
				$subtitle = wp_trim_words(get_the_subtitle(),13);
			}
			
			$content = wp_trim_words(get_the_excerpt(),25);
			$img = get_the_post_thumbnail_url(get_the_ID(), 'funarte-medium');
			$items[] = ['tag_class_area'=>$area->slug,
									'tag_name_area' =>$area->name,
									'tag_url_area' => get_category_link( $area->cat_ID ),
									'tag_subname_area'=>'',
									'title' => get_the_title(),
									'url'=> get_permalink(),
									'content'=> $content,
									'subtitle' => $subtitle,
									'url_img'=> $img ? $img : null];
		}
		$arg = ['items' => $items, 'more_news_url' => '/noticias?area=' . $area->name];
		funarte_load_part('box-news', $arg);
		wp_reset_postdata();
	?>
	<!-- FIM NOTICIAS -->

	<!-- EVENTOS -->
	<div class="container">
		<?php
			$items = [];
			foreach ($eventos as $evento) {
				$inicio = strtotime('00:00:00', strtotime(get_post_meta($evento->ID, 'evento-inicio', true)));
				$fim = strtotime('23:59:59', strtotime(get_post_meta($evento->ID, 'evento-fim', true)));
				$local = get_post_meta($evento->ID, 'evento-local', true);
				$schedule = strtotime(get_post_meta($evento->ID, 'evento-inicio', true));

				if (($inicio <= time()) && ($fim >= time())) {
					$day = date_i18n('d');
					$month = date_i18n('F');
				} else {
					$day = date_i18n('d', $inicio);
					$month = date_i18n('F', $inicio);
				}
				$url_img = has_post_thumbnail($evento->ID) ? get_the_post_thumbnail_url($evento->ID,'medium_large') : funarte_get_img_default($area->slug);
				$items[] = ['url' => get_permalink($evento->ID),
 										'day'=> $day,
										'month'=> $month,
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
	<!-- FIM EVENTOS -->


	<!-- ESPAÇO CULTURAL -->
	<?php
		$title = 'Espaços Culturais';
		$url_title = get_post_type_archive_link(\funarte\EspacoCultural::get_instance()->get_post_type());
		$url_title .= '?area=' . $area->slug ;
		funarte_load_part('carousel-spaces', ['title'=>$title, 'url_title'=>$url_title, 'espacos'=>$espacos ]); 
	?>
	<!-- FIM ESPAÇO CULTURAL -->

	<div class="container">

		<!-- ACERVO -->
		<?php 
			$url_title = get_post_type_archive_link('tainacan-collection');
			$url_title .= '?area=' . $area->slug;
			funarte_load_part('collections-carousel', ['title'=>'Acervo', 'url_title'=>$url_title, 'collections' => $collections, 'area' => ['slug'=>$area->slug, 'name'=>$area->name]]); 
		?>
		<!-- FIM ACERVO -->

		<div class="row justify-content-between">
			<!--//MAIS INFORMAÇÕES -->
			<div class="col-md-7">
				<div class="box-more-info mb-0">
					<h2 class="title-h1">Mais Informações</h2>

					<ul class="list-more-info">
						<?php
							$fields = array('coordenador','telefone1','telefone2','fax','email','endereco');
							foreach ($fields as $field) {
								${$field} = get_post_meta($post_area->ID, 'area_de_interesse-' . $field, true);
							}
						?>
						<li>
							<span><?php echo $coordenador; ?></span>

							<?php if (!empty($telefone1) || !empty($fax) || !empty($email)) { ?>
								<strong>Contatos:</strong>

								<?php if (!empty($telefone1)) { ?>
									<span>Tel: <?php echo $telefone1; ?></span>
									<?php if (!empty($telefone2)) { ?>
											<span><?php echo $telefone2; ?></span>
									<?php } ?>
								<?php } ?>

								<?php if (!empty($fax)) { ?>
									<span><strong>Fax:</strong> <?php echo $fax; ?></span>
								<?php } ?>

								<?php if (!empty($email)) { ?>
									<span><strong>E-mail:</strong> <?php echo $email; ?></span>
								<?php } ?>

								<?php if (!empty($endereco)) { ?>
									<strong>Endereço:</strong>
									<span><?php echo $endereco; ?></span>
								<?php } ?>
							<?php } ?>
						</li>
						<li class="color-funarte">
							<a href="<?php echo get_bloginfo('url') . '/estrutura'; ?>" class="link-more">Ver outros contatos</a>
						</li>
					</ul>
				</div>
			</div>
			<!--//FIM MAIS INFORMAÇÕES -->

			<!--//LINKS RELACIONADOS -->
			<div class="col-md-4">
				<div class="box-simple-links mb-0">
					<h2 class="title-h1">Links relacionados</h2>

					<ul class="list-simple-links">
						<?php while ($links_relacionados->have_posts()): $links_relacionados->the_post(); ?>
							<li class="color-funarte">
								<strong><?php echo the_title(); ?></strong>
								<a class="link-more" target="_blank" href="<?php echo get_post_meta(get_the_ID(), 'linkrelacionado-url', true); ?>">Visitar</a>
							</li>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</ul>
				</div>
			</div>
			<!--//FIM LINKS RELACIONADOS -->
		</div>
	</div>
</main>
	
<?php get_footer();
