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
	$noticias = query_posts($query_news);

	$query_eventos = ['paged' => false, 'post_type' => 'evento', 'orderby' => 'meta_value', 'order' => 'ASC', 'cat' => (int)$area->term_id ];
	$eventos = \funarte\Evento::get_instance()->get_eventos_from_month(date('m'),date('Y'), $query_eventos);
	if (empty($eventos)) {
		$eventos = \funarte\Evento::get_instance()->get_last_eventos($query_eventos);
	}
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

					$img_url = get_the_post_thumbnail_url($destaque->ID);
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

		<div class="row justify-content-between">
			<!--//MAIS INFORMAÇÕES -->
			<div class="col-md-7">
				<div class="box-more-info">
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
					</ul>
				</div>
			</div>
			<!--//FIM MAIS INFORMAÇÕES -->

			<!--//LINKS RELACIONADOS -->
			<div class="col-md-4">
				<div class="box-simple-links">
					<h2 class="title-h1">Links relacionados</h2>

					<ul class="list-simple-links">
						<li class="color-funarte">
							<div class="link-area">
								<a href="#">CEDOC</a>
							</div>
							<strong>Escola Nacional de Circo</strong>
							<a class="link-more" href="#">Visitar</a>
						</li>
						<li class="color-funarte">
							<div class="link-area">
								<a href="#">CEDOC</a>
							</div>
							<strong>Escola Nacional de Circo</strong>
							<a class="link-more" href="#">Visitar</a>
						</li>
						<li class="color-funarte">
							<div class="link-area">
								<a href="#">CEDOC</a>
							</div>
							<strong>Escola Nacional de Circo</strong>
							<a class="link-more" href="#">Visitar</a>
						</li>
					</ul>
				</div>
			</div>
			<!--//FIM LINKS RELACIONADOS -->
		</div>
	</div>

	<!-- ESPAÇO CULTURAL -->
	<div class="container">
		<div class='box-carousel-zoom'>
			<h2 class="title-1">Espaços Culturais</h2>

			<div class="carousel-zoom__wrapper">
				<div class="carousel-zoom__control">
					<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
					<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
				</div>

				<ul class="carousel-zoom">
				<?php
					$contador = 0;

					foreach ($espacos as $espaco) {
						$estado = get_post_meta($espaco->ID, 'espaco-estado', true);
						$area = (!isset($query['cat'])) ? get_single_category() : get_category($query['cat']);
						$url_img = has_post_thumbnail($espaco->ID) ? get_the_post_thumbnail_url($espaco->ID) : funarte_get_img_default();
				?>
							<li class="color-funarte carousel-zoom__item-<?php echo $contador++%3; ?>">
								<div class="link-area">
									<strong><?php echo $estado ?></strong>
								</div>
								<div class="carousel-zoom__image" style="background-image: url('<?php echo $url_img ?>');"></div>

								<div class="carousel-zoom__text">
									<strong><?php echo esc_attr($espaco->post_title) ?></strong>
									<p><?php echo \funarte\EspacoCultural::get_instance()->formata_endereco($espaco->ID) ?> - <?php echo get_post_meta($espaco->ID, 'espaco-telefone1', true) ?></p>
									<a class="link-more" href="<?php echo get_permalink($espaco->ID) ?>">Ler mais</a>
								</div>
							</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
	<!-- FIM ESPAÇO CULTURAL -->

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
		$arg = ['title'=> 'Editais', 'items' => $items,
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
		foreach ($noticias as $noticia) {
			$items[] = ['tag_class_area'=>$area->slug,
									'tag_name_area' =>$area->name,
									'tag_url_area' => get_category_link( $area->cat_ID ),
									'tag_subname_area'=>'',
									'title' => $noticia->post_title,
									'url'=> get_permalink($noticia->ID),
									'content'=> get_the_excerpt($noticia->ID),
									'url_img'=> get_the_post_thumbnail_url($noticia->ID) ? get_the_post_thumbnail_url($noticia->ID) : null];
		}
		$arg = ['items' => $items, 'more_news_url' => '/noticias?area=' . $area->name];
		funarte_load_part('box-news', $arg);
	?>
	<!-- FIM NOTICIAS -->

	<!-- EVENTOS -->
	<div class="container">
		<?php
			$default_img_url = get_template_directory_uri() . '/assets/img/fke/agenda_002.jpg';
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
				$items[] = ['url' => get_permalink($evento->ID),
 										'day'=> $day,
										'month'=> $month,
										'local' => $local,
										'title' => $evento->post_title,
										//'url_img' => get_the_post_thumbnail_url($evento->ID) ? get_the_post_thumbnail_url($evento->ID) : $default_img_url,
										'url_img' => $default_img_url,
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
			<h2 class="title-1 mb-65">Acervo</h2>

			<?php  ?>
			
			<?php funarte_load_part('collections-carousel', ['collections' => $collections, 'area' => ['slug'=>$area->slug, 'name'=>$area->name]]); ?>
			
		</section>
	</div>

</main>
	
<?php get_footer();
