<?php

get_header();
$pagina = home_url( $wp->request );

if (have_posts()): the_post();
	$estado = get_post_meta($post->ID, 'espaco-estado', true);
	$prefix = 'espaco';
	$espaco = array(
		'telefone1' => get_post_meta($post->ID, "{$prefix}-telefone1", true),
		'telefone2' => get_post_meta($post->ID, "{$prefix}-telefone2", true),
		'email' => get_post_meta($post->ID, "{$prefix}-email", true),
		'link' => get_post_meta($post->ID, "{$prefix}-link", true),
		'maplink' => get_post_meta($post->ID, "{$prefix}-maplink", true),
	
		'rua' => get_post_meta($post->ID, "{$prefix}-rua", true),
		'numero' => get_post_meta($post->ID, "{$prefix}-numero", true),
		'complemento' => get_post_meta($post->ID, "{$prefix}-complemento", true),
		'bairro' => get_post_meta($post->ID, "{$prefix}-bairro", true),
		'cidade' => get_post_meta($post->ID, "{$prefix}-cidade", true),
		'estado' => get_post_meta($post->ID, "{$prefix}-estado", true),
		'cep' => get_post_meta($post->ID, "{$prefix}-cep", true)
	);
?>

	<main role="main">
		<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
		<div class="container">

			<?php 
				$links = [
					['link_name'=>'Espaços Culturais','link_url'=>'/espaco-cultural'],
					['link_name'=>get_the_title()]];
				funarte_load_part('breadcrumb', ['links'=>$links]);
				$social_list = "<ul>
													<li><a href='http://www.facebook.com/sharer.php?u=$pagina' class='tooltip-social-media__facebook' target='_blank'><i class='mdi mdi-facebook'></i></a></li>
													<li><a href='http://twitter.com/share?url=$pagina' class='tooltip-social-media__twitter' target='_blank'><i class='mdi mdi-twitter'></i></a></li>
													<li class='whatsapp-item'><a href='whatsapp://send?text=$pagina' data-action='share/whatsapp/share' class='tooltip-social-media__whatsapp' target='_blank'><i class='mdi mdi-whatsapp'></i></a></li>
												</ul>";
				funarte_load_part('box-title', ['titles'=>['Funarte', 'Espaços Culturais'], 'social_list' => $social_list]);
			?>

			<?php
				$areas = get_the_category();
				$tags = [];
				foreach ($areas as $area):
					$tags[] = [	'slug'=> $area->slug,
											'name'=> $area->name,
											'url_area'=> home_url() . '/category/' . $area->slug];
				endforeach;
			?>

			<?php funarte_load_part('title-page', ['title'=> get_the_title(), 'img'  => get_the_post_thumbnail_url( ),'tags'=> $tags]); ?>

			<div class="row justify-content-between mb-100">
				<div class="col-md-6">
					<div class="box-text">
						<h4 class="title-5">Sobre</h4>
						<div class="box-text__text">
							<?php the_content(); ?>
						</div>

						<?php
							$evento_post_type = \funarte\Evento::get_instance();
							$espaco_tax = wp_get_post_terms( get_the_ID(), \funarte\taxEspacosCulturais::get_instance()->get_name());
							if(!empty($espaco)):
								$params = array(
									'mes' => date('m'),
									'ano' => date('Y'),
									'colunas' => 5
								);

								if(isset($espaco_tax) && !empty($espaco_tax)) {
									$query = array(
										'tax_query' => [
											[ 'taxonomy'=> \funarte\taxEspacosCulturais::get_instance()->get_name(), 
												'field' => 'slug',
												'terms'   => $espaco_tax[0]->slug]
										]
									);
								}

								$eventos = $evento_post_type->get_eventos_from_month($params['mes'], $params['ano'], $query);
								if (empty($eventos)) {
									$eventos = $evento_post_type->get_last_eventos($query);
								}

								if (!empty($eventos)): ?>
									<div class="box-carousel-events">
										<h4 class="title-5">Próximos eventos no local</h4>
										<div class="carousel-events__wrapper">
											<div class="carousel-events__control">
												<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
												<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
											</div>
											<ul class="carousel-events">
												<?php
												foreach ($eventos as $evento):
													$area = get_the_category($post->ID);
													$evento->inicio = strtotime('00:00:00', strtotime(get_post_meta($evento->ID, 'evento-inicio', true)));
													$evento->fim = strtotime('23:59:59', strtotime(get_post_meta($evento->ID, 'evento-fim', true)));
													$evento->local = get_post_meta($evento->ID, 'evento-local', true);
													$evento->hora_inicio = strtotime(get_post_meta($evento->ID, 'evento-inicio', true));
													if (($evento->fim >= time())): ?>
														<li>
															<div class="link-area">
																<a class="color-<?php echo $area[0]->slug; ?>" href="#"><?php echo $area[0]->name; ?></a>
															</div>
															<?php if (has_post_thumbnail($evento->ID)): ?>
																<img src="<?php echo get_the_post_thumbnail_url($evento->ID); ?>" alt="<?php echo $evento->post_title; ?>">
															<?php endif; ?>
															<strong><?php echo $evento->post_title; ?></strong>
														</li> 
													<?php 
													endif;
												endforeach; ?>
											</ul>
										</div>
									</div>
								<?php endif;
							endif;
							wp_reset_query();
						?>
					</div>
				</div>
				
				<div class="col-md-5">
					<aside class="content-aside">
						<div class="box-data">
							<h4 class="title-5">Informações</h4>

							<div class="box-data__row">
								<strong>Informações ao público:</strong>

								<?php if (!empty($espaco['telefone1'])) ?>
									<span><?php echo $espaco['telefone1']; ?></span>

								<?php if (!empty($espaco['telefone2'])) ?>
									<span><?php echo $espaco['telefone2']; ?></span>

								<?php if (!empty($espaco['email'])) ?>
									<a href="mailto:<?php echo $espaco['email']; ?>"><?php echo $espaco['email']; ?></a>

								<?php if (!empty($espaco['link'])) ?>
									<a href="<?php echo $espaco['link']; ?>" rel="nofollow"><?php echo $espaco['link']; ?></a>
							</div>

							<?php 
							if (!empty($espaco['maplink'])):
								$espaco['maplink'] .= '&t=r';
								$maps = gmaps_url($espaco['maplink']);
								$mapa = the_gmaps_src(null, $maps['latitude'], $maps['longitude'], $maps['zoom'], 194, 120, null, 'A', '0x'.getCategoryColor());
							?>
								<div class="box-data__row">
									<span><b>Local:</b></span>
									<span><?php echo $estado; ?></span>
								</div>

								<h4 class="title-5">Veja como chegar</h4>
							
								<div id="map">
									<strong>
										<a class="mapa" href="<?php echo $espaco['maplink'] . '&output=embed'; ?>" rel="shadowbox;title=<?php the_title(); ?>" title="Amplie o mapa">
											<img src="<?php echo $mapa; ?>" alt="Mapa do espaço cultural" width="194" height="120" />
										</a>
									</strong>
								</div>
							<?php endif; ?>
						</div>
					</aside>
				</div>
			</div>
		</div>
	</main>
<?php 
endif;
get_footer();