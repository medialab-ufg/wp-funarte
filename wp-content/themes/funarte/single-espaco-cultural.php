<?php 
get_header();
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
			<?php include('inc/template_parts/breadcrumb.php'); ?>

			<div class="box-title">
				<h2 class="title-h1"><a href="#">Funarte</a> <a href="<?php echo get_bloginfo('url') . '/espaco-cultural'; ?>"><span>Espaços Culturais</span></a></h2>
			</div>
			<?php funarte_load_part('title-page', ['tag'=> $estado, 'title'=> get_the_title(), 'img'  => get_the_post_thumbnail_url( )]); ?>

			<div class="row justify-content-between">
				<div class="col-md-6">
					<div class="box-text">
						<h4 class="title-5">Sobre</h4>
						<div class="box-text__text">
							<?php the_content(); ?>
						</div>

						<div class="box-carousel-events">
							<h4 class="title-5">Próximos eventos no local</h4>
							<div class="carousel-events__wrapper">
								<div class="carousel-events__control">
									<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
									<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
								</div>
								<ul class="carousel-events">
									<?php
									$evento_post_type = \funarte\Evento::get_instance();
									//$espaco_tax = get_term_by('slug', $post->post_name , \funarte\taxEspacosCulturais::get_instance()->get_name());
									$espaco_tax = wp_get_post_terms( get_the_ID(), \funarte\taxEspacosCulturais::get_instance()->get_name());
									if(!empty($espaco)):
										$params = array(
											'mes' => date('m'),
											'ano' => date('Y'),
											'colunas' => 5
										);

										$query = array(
											'paged' => false,
											'post_type' => 'evento',
											'orderby' => 'meta_value',
											'order' => 'ASC',
											//$espaco->taxonomy => $espaco->slug,
											$espaco_tax[0]->taxonomy => $espaco_tax[0]->slug
										);

										$eventos = $evento_post_type->get_eventos_from_month($params['mes'], $params['ano'], $query);
										if (empty($eventos)) {
											$eventos = $evento_post_type->get_last_eventos($query);
										}
										if (have_posts()):
											while (have_posts()):
												the_post();
												$area = get_the_category($post->ID);
												$evento = new stdClass();
												$evento->inicio = strtotime('00:00:00', strtotime(get_post_meta(get_the_ID(), 'evento-inicio', true)));
												$evento->fim = strtotime('23:59:59', strtotime(get_post_meta(get_the_ID(), 'evento-fim', true)));
												$evento->local = get_post_meta(get_the_ID(), 'evento-local', true);
												$evento->hora_inicio = strtotime(get_post_meta(get_the_ID(), 'evento-inicio', true));
												if (($evento->fim >= time())): ?>
													<li>
														<ul class="link-area">
															<li class="color-<?php echo $area[0]->name; ?>">
																<a href="#"><?php echo $area[0]->name; ?></a>
															</li>
														</ul>
														<?php if (has_post_thumbnail()): ?>
															<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
														<?php endif; ?>
														<strong><?php the_title(); ?></strong>
													</li>
												<?php
												endif;
											endwhile;
										endif;
									endif;
									wp_reset_query();
									?>
									<li>
										<ul class="link-area">
											<li class="color-danca">
												<a href="#">Dança</a>
											</li>
										</ul>
										<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg' ?>" alt="Título lorem ipsum sit dolor amet, consectetur adispicing ">
										<strong>Título lorem ipsum sit dolor amet, consectetur adispicing</strong>
									</li>
									<li>
										<ul class="link-area">
											<li class="color-danca">
												<a href="#">Dança</a>
											</li>
										</ul>
										<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg' ?>" alt="Título lorem ipsum sit dolor amet, consectetur adispicing ">
										<strong>Título lorem ipsum sit dolor amet, consectetur adispicing</strong>
									</li>
									
								</ul>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-5">
					<aside class="content-aside">
						<div class="box-data">
							<h4 class="title-5">Informações</h4>

							<div class="box-data__row">
								<strong>Informações ao público:</strong>
									<?php if (!empty($espaco['telefone1'])) ?>
    								<strong><?php echo $espaco['telefone1']; ?></strong>
									
									<?php if (!empty($espaco['telefone2'])) ?>
										<strong><?php echo $espaco['telefone2']; ?></strong>
						
									<?php if (!empty($espaco['email'])) ?>
										<a href="mailto:<?php echo $espaco['email']; ?>"><?php echo $espaco['email']; ?></a>
						
									<?php if (!empty($espaco['link'])) ?>
										<a href="<?php echo $espaco['link']; ?>" rel="nofollow"><?php echo $espaco['link']; ?></a>
							</div>

							<div class="box-data__row">
								<span><b>Local:</b></span>
							</div>

							<h4 class="title-5">Veja como chegar</h4>

							<div id="map"></div>
						</div>
					</aside>
				</div>
			</div>
		</div>
	</main>

	<script>
		function initMap() {
			var local = {lat: -25.344, lng: 131.036},
				map = new google.maps.Map(document.getElementById('map'), {
					zoom: 4,
					center: local
				}),
				marker = new google.maps.Marker({
					position: local,
					map: map
				});
		}
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=ASDF&callback=initMap"></script>
<?php 
endif;
get_footer();