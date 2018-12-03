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
	$espacos = \funarte\EspacoCultural::get_instance()->get_espacos($query);
	$editais = \funarte\Edital::get_instance()->get_editais('todos', $query);

	$query_news = ['cat' => (int)$area->term_id, 'post_type' => 'post', 'posts_per_page' => 9, 'paged' => false, 'orderby' => 'date', 'order' => 'DESC'];
	$noticias = query_posts($query_news);

	$query_eventos = ['paged' => false, 'post_type' => 'evento', 'orderby' => 'meta_value', 'order' => 'ASC', 'cat' => (int)$area->term_id ];
	$eventos = \funarte\Evento::get_instance()->get_eventos_from_month(date('m'),date('Y'), $query_eventos);
	if (empty($eventos)) {
		$eventos = \funarte\Evento::get_instance()->get_last_eventos($query);
	}
?>

<main role="main">
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
											'descricao'	=> $destaque->post_content,
											'url' 		=> $url];
				}
			}
			$arg = ['items' => $items];
			funarte_load_part('carousel-highlights', $arg);
			//FIM-CAROUSEL-HIGHLIGHTS
		?>

		<div class="row">
			<!--//MAIS INFORMAÇÕES -->
			<div class="col-md-6">
				<h3>Mais Informações</h3>
				<?php
					$fields = array('coordenador','telefone1','telefone2','fax','email','endereco');
					foreach ($fields as $field) {
						${$field} = get_post_meta($post_area->ID, 'area_de_interesse-' . $field, true);
					}
				?>
				<span>
					<strong><?php echo $coordenador; ?></strong>
				</span>
				<?php if (!empty($telefone1) || !empty($fax) || !empty($email)) { ?>
					<span>
						Contatos
						<?php if (!empty($telefone1)) { ?>
							<strong>Tel: <?php echo $telefone1; ?></strong>
							<?php if (!empty($telefone2)) { ?>
									<strong><?php echo $telefone2; ?></strong>
							<?php } ?>
						<?php } ?>
						<?php if (!empty($fax)) { ?>
							<strong>Fax: <?php echo $fax; ?></strong>
						<?php } ?>
						<?php if (!empty($email)) { ?>
							<strong><?php echo $email; ?></strong>
						<?php } ?>
						<?php if (!empty($endereco)) { ?>
							<span>
								Endereço
								<strong><?php echo $endereco; ?></strong>
							</span>
						<?php } ?>
					</span>
				<?php } ?>
			</div>
			<!--//FIM MAIS INFORMAÇÕES -->

			<!--//LINKS RELACIONADOS -->
			<div class="col-md-6">
				[LINKS RELACIONADOS]
			</div>
			<!--//FIM LINKS RELACIONADOS -->
		</div>
	</div>

	<!-- ESPAÇO CULTURAL -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>Espaços Culturais</h3>
			</div>
			<?php 
				foreach ($espacos as $espaco) {
					$estado = get_post_meta($espaco->ID, 'espaco-estado', true);
					$area = (!isset($query['cat'])) ? get_single_category() : get_category($query['cat']);
					if (!has_post_thumbnail($espaco->ID)) { 
						continue;
					}
					echo "<div class='col-md-6'><ul>";
					echo "<li>$estado</li>";
					echo "<li>$area->name</li>";
					echo "<li>" . get_permalink($espaco->ID) . "</li>";
					echo "<li>" . \funarte\EspacoCultural::get_instance()->formata_endereco($espaco->ID) . "</li>"; 
					echo "<li>" . get_post_meta($espaco->ID, 'espaco-telefone1', true) . "</li>";
					echo "<li>" . esc_attr($espaco->post_title) . "</li>";
					echo "<li>" . get_the_post_thumbnail($espaco->ID,'medium') . "</li>";
					echo "</ul></div>";
				}
			?>
		</div>
	</div>
	<!-- FIM ESPAÇO CULTURAL -->

	<!-- EDITAIS -->
	<?php
		$items = [];
		foreach ($editais as $edital) {
			$items[] = ['tag_class_area'=>$area->slug,
									'tag_name_area'=>$area->name,
									'tag_subname_area'=>\funarte\Edital::get_instance()->get_edital_status($edital->ID),
									'title' => $edital->post_title ,
									'url'=>get_permalink($edital->ID)];
		}
		$arg = ['title'=> 'Editais', 'items' => $items,
						'destaque' => ['url'=> get_template_directory_uri(),
													 'title'=> '[TITULO]',
													 'tag_name_area'=>$area->name,
													 'tag_class_area'=>$area->slug,
													 'content'=>'[CONTEUTO DO DESTAQUE]',
													 'img_url'=> get_template_directory_uri() . '/assets/img/fke/destaque_001.jpg']
		];
		funarte_load_part('notices-highlights', $arg);
	?>
	<!-- FIM EDITAIS -->

	<!-- NOTICIAS -->
	<?php
		$default_img_url = get_template_directory_uri() . '/assets/img/fke/news_003.jpg';
		$items = [];
		foreach ($noticias as $noticia) {
			$items[] = ['tag_class_area'=>$area->slug,
									'tag_name_area' =>$area->name,
									'tag_subname_area'=>'',
									'title' => $noticia->post_title,
									'url'=> get_permalink($noticia->ID),
									'content'=> get_the_excerpt($noticia->ID),
									'url_img'=> get_the_post_thumbnail_url($noticia->ID) ? get_the_post_thumbnail_url($noticia->ID) : $default_img_url];
		}
		$arg = ['items' => $items, 'more_news_url' => '#'];
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

</main>
	
<?php get_footer();
