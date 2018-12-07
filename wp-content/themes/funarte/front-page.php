<?php
	get_header();

	$query_eventos = ['paged' => false, 'post_type' => 'evento', 'orderby' => 'meta_value', 'order' => 'ASC'];
	$eventos = \funarte\Evento::get_instance()->get_eventos_from_month(date('m'), date('Y'), $query_eventos);
	if (empty($eventos)) {
		$eventos = \funarte\Evento::get_instance()->get_last_eventos($query_eventos);
	}
	$query_news = ['post_type' => 'post', 'posts_per_page' => 9, 'paged' => false, 'orderby' => 'date', 'order' => 'DESC'];
	$noticias = query_posts($query_news);
	$destaques = \funarte\DestaqueHome::get_instance()->get_destaques('area', 1, 5);
	$editais = \funarte\Edital::get_instance()->get_editais('todos');
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
			$area = get_the_category($edital->ID);
			$items[] = ['tag_class_area'=>$area[0]->slug,
									'tag_name_area'=>$area[0]->name,
									'tag_url_area'=>get_category_link( $area[0]->cat_ID ),
									'tag_subname_area'=>\funarte\Edital::get_instance()->get_edital_status($edital->ID),
									'title' => $edital->post_title ,
									'url'=>get_permalink($edital->ID)];
		}
		$arg = ['title'=> 'Editais', 'items' => $items,
											'destaque' => ['url'=> get_template_directory_uri(),
											'title'=> '[TITULO]',
											'tag_name_area'=>$area[0]->name,
											'tag_class_area'=>$area[0]->slug,
											'content'=>'[CONTEUTO DO DESTAQUE]',
											'img_url'=> get_template_directory_uri() . '/assets/img/fke/destaque_001.jpg']
		];
		funarte_load_part('notices-highlights', $arg);
	?>

	<!-- NOTICIAS -->
	<?php
		$default_img_url = get_template_directory_uri() . '/assets/img/fke/news_003.jpg';
		$items = [];
		foreach ($noticias as $noticia) {
			$area = get_the_category($noticia->ID);
			$items[] = ['tag_class_area'=>$area[0]->slug,
									'tag_name_area' =>$area[0]->name,
									'tag_url_area'=>get_category_link( $area[0]->cat_ID ),
									'tag_subname_area'=>'',
									'title' => $noticia->post_title,
									'url'=> get_permalink($noticia->ID),
									'content'=> get_the_excerpt($noticia->ID),
									'url_img'=> get_the_post_thumbnail_url($noticia->ID) ? get_the_post_thumbnail_url($noticia->ID) : $default_img_url];
		}
		$arg = ['items' => $items, 'more_news_url' => '/noticias'];
		funarte_load_part('box-news', $arg);
	?>
	<!-- FIM NOTICIAS -->

	<!-- EVENTOS -->
	<div class="container">
		<?php
			$default_img_url = get_template_directory_uri() . '/assets/img/fke/agenda_002.jpg';
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
				} else {
					$day = date_i18n('d', $inicio);
					$month = date_i18n('M', $inicio);
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

			<div class="carousel-collection__wrapper">
				<div class="carousel-collection__control">
					<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
					<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
				</div>
				<ul class="carousel-collection">
					<li class="color-circo">
						<div class="link-area">
							<a href="#">Circo</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipisLorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_001.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipisLorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-literatura carousel-collection__reverse">
						<div class="link-area">
							<a href="#">Literatura</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_002.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-artes-visuais">
						<div class="link-area">
							<a href="#">Artes visuais</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_003.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-teatro carousel-collection__reverse">
						<div class="link-area">
							<a href="#">Teatro</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_004.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-circo">
						<div class="link-area">
							<a href="#">Circo</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipisLorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_001.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipisLorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-literatura carousel-collection__reverse">
						<div class="link-area">
							<a href="#">Literatura</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_002.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-artes-visuais">
						<div class="link-area">
							<a href="#">Artes visuais</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_003.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-teatro carousel-collection__reverse">
						<div class="link-area">
							<a href="#">Teatro</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_004.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-literatura carousel-collection__reverse">
						<div class="link-area">
							<a href="#">Literatura</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_002.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-artes-visuais">
						<div class="link-area">
							<a href="#">Artes visuais</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_003.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
				</ul>
			</div>
		</section>
	</div>
</main>

<?php
	get_footer();
?>