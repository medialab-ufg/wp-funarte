<?php 
	get_header();
?>

<?php if(have_posts()) : the_post(); ?>

	<main role="main">
		<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
		<div class="container">
			<?php
				$areas = get_the_category();
				$tags = [];
				foreach ($areas as $area):
					$tags[] = [	'slug'=> $area->slug,
										'name'=> $area->name,
										'url_area'=> home_url() . '/category/' . $area->slug];
				endforeach;
				$data_inicio = strtotime(get_post_meta(get_the_ID(), 'evento-inicio', true));
				$data_fim = strtotime(get_post_meta(get_the_ID(), 'evento-fim', true));
				$hora_inicio = date_i18n('H:i', $data_inicio);
				$hora_fim = date_i18n('H:i', $data_fim);
				$dia_inteiro = (bool)get_post_meta(get_the_ID(), 'evento-diainteiro', true);
				$multiplo= (bool)get_post_meta(get_the_ID(), 'evento-multiplo', true);

				$links = [
					['link_name'=>'Agenda','link_url'=>'/evento'],
					['link_name'=>get_the_title()]];
				funarte_load_part('breadcrumb', ['links'=>$links]);
				funarte_load_part('box-title', ['titles'=>['Agenda cultural']]);
				funarte_load_part('title-page', [	'title'=> get_the_title(),
																					'date_pub' => get_the_time(get_option('date_format')),
																					'img'  => get_the_post_thumbnail_url(),
																					'tags'=> $tags]); ?>

			<div class="row justify-content-between mb-100">
				<div class="col-md-6">
					<div class="box-text">
						<?php the_content(); ?>
					</div>
				</div>

				<div class="col-md-5">
					<aside class="content-aside">
						<div class="box-data">
							<h4 class="title-5">Informações</h4>
							<div class="box-data__row">
								<strong>Informações ao público:</strong>
								<?php if ($ev_tel = get_post_meta(get_the_ID(), 'evento-telefone', true)): ?>
									<span><?php echo $ev_tel; ?></span>
								<?php endif; ?>
								<?php if ($ev_email = get_post_meta(get_the_ID(), 'evento-email', true)): ?>
									<a href="mailto:<?php echo $ev_email; ?>"><?php echo $ev_email; ?></a>
								<?php endif; ?>
								<?php if ($ev_site = get_post_meta(get_the_ID(), 'evento-link', true)): ?>
									<a href="<?php echo $ev_site; ?>" rel="nofollow"><?php echo $ev_site; ?></a>
								<?php endif; ?>
							</div>

							<?php if ($multiplo): ?>
								<span><b>Dias:</b></span>
								<span>De <?php echo date_i18n('j \d\e F', $data_inicio);?> a <?php echo date_i18n('j \d\e F \d\e Y', $data_fim) ?></span>
							<?php else: ?>
								<span><b>Dia:</b></span>
								<span><?php echo date_i18n('j \d\e F \d\e Y', $data_inicio) ?></strong></span>
							<?php endif; ?>

							<?php if ($dia_inteiro) : ?>
								<span><b>Horário:</b></span>
								<span>Evento de dia inteiro</span>
							<?php elseif (!$multiplo && ($hora_inicio == $hora_fim)) : ?>
								<span><b>Horário:</b></span>
								<span><?php echo $hora_inicio; ?></span>
							<?php else: ?>
								<span><b>Horário:</b></span>
								<span><?php echo $hora_inicio; ?> às <?php echo $hora_fim; ?></span>
							<?php endif; ?>

							<?php if ($ev_local = get_post_meta(get_the_ID(), 'evento-local', true)): ?>
								<span><b>Local:</b></span>
								<span><?php echo $ev_local; ?></span>
							<?php endif; ?>
											
							<?php if ($ev_maplink = get_post_meta(get_the_ID(), 'evento-maplink', true)): ?>
								<h4 class="title-5">Veja como chegar</h4>
								<div id="map">
									<strong>
										<a class="mapa" href="<?php echo $ev_maplink; ?>" title="Amplie o mapa">
											<img src="http://maps.google.com/maps/api/staticmap?center=-22.91788,-43.17935&amp;zoom=17&amp;size=194x120&amp;maptype=&amp;markers=size:mid|color:0x3B8313|label:A|-22.91788,-43.17935&amp;sensor=false" alt="Mapa do espaço cultural" width="194" height="120">
										</a>
									</strong>
								</div>
							<?php endif; ?>
						</div>


						<?php
							$mes = date('m');
							$ano = date('Y');
							$mes = 2;
							$ano = 2016;
							$query = [
								'paged' => false,
								'post_type' => \funarte\Evento::get_instance()->get_post_type(),
								'orderby' => 'meta_value',
								'order' => 'ASC',
								'posts_per_page'	=> 5
							];
							$cat = (isset($query['cat'])) ? get_category($query['cat']) : null;
							$eventos = \funarte\Evento::get_instance()->get_eventos_from_month($mes, $ano, $query);
							if (empty($eventos))
								$eventos = \funarte\Evento::get_instance()->get_last_eventos($query);
							if (have_posts()): ?>
								<div class="box-bidding">
									<h4 class="title-h1--type-b">Mais eventos</h4>

									<ul class="list-bidding--type-b">
										<?php
										while (have_posts()):
											the_post();
											if ( isset(get_the_category()[0]) ) {
												$area = get_the_category()[0];
											} else {
												$area = null;
											}
										?>
											<li class="color-<?php echo isset($area->slug)?$area->slug:'funarte'; ?>">
												<div class="link-area">
													<a href="#"><?php echo isset($area->name)?$area->name:'funarte'; ?></a>
												</div>
												<strong>
													<?php the_title(); ?>
												</strong>
												<a class="link-more" href="<?php echo get_the_permalink(); ?>">Ler mais</a>
											</li>
										<?php
										endwhile;
										?>
									</ul>
								</div>
							<?php endif; ?>
					</aside>
				</div>
			</div>
		</div>
	</main>
<?php endif; ?>

<!--
<?php if ( have_posts() ) : the_post(); ?>
	
	<?php
		$areas = get_the_category();
		if (!empty($areas) && (count($areas) > 1)) { ?>
		<div class="relacionamento">
			<span>Relacionado a:
			<?php foreach ($areas AS $area) { ?>
				<small class="<?php echo $area->category_nicename; ?>"><?php echo $area->name; ?></small><?php if ($area != end($areas)) { ?>, <?php } ?>
			<?php } ?>
			</span>
		</div>
	<?php } ?>
	
	<div class="post-content" role="main">
		<h3> <?php the_title(); ?> </h3> 
		<div> <?php the_content(); ?> </div>
		<div> <?php echo get_the_date(); ?> </div>
	</div>

<?php endif; ?>
-->
<?php get_footer();
