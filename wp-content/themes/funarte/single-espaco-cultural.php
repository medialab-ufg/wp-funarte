<?php 
	get_header();
	$edital = \funarte\Edital::get_instance();
	$status = $edital->get_edital_status($post->ID);

	if (have_posts()) { the_post(); ?>
		<main role="main">
			<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
			<div class="container">
				<?php include('inc/template_parts/breadcrumb.php'); ?>

				<div class="box-title">
					<h2 class="title-h1"><a href="#">Funarte</a> <a href="<?php echo get_bloginfo('url') . '/espaco-cultural'; ?>"><span>Espaços Culturais</span></a></h2>
				</div>

				<!-- A DIV ABAIXO DEVE IR PARA O TEMPLATE_PARTS -->
				<div class="box-title-page box-title-page--image color-artes-visuais">
					<div class="link-area">
						<a class="color-funarte" href="#">[NOME DA CIDADE]</a>
					</div>
					<h3 class="title-page">Lorem ipsum dolor sit amet, consectetuer adi-piscing elit, sed diam no-nummy </h3>

					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/espaco_001.jpg'?>" alt="<?php the_title(); ?>">
				</div>

				<?php 
					$THEME_FOLDER = get_template_directory();
					$DS = DIRECTORY_SEPARATOR;
					$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'widget' . $DS;
					require_once($META_FOLDER . 'arquivos-relacionados.php');
				?>

				<div class="row justify-content-between">
					<div class="col-md-6">
						<div class="box-text">
							<h4 class="title-5">Sobre</h4>

							<div class="box-text__text">
								<div class="box-text__image">
									<?php get_the_post_thumbnail(get_the_ID(), array('width' => 380, 'height' => null, 'after' => '<hr />')); ?>
								</div>

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
										<li>
											<div class="link-area">
												<a class="color-danca" href="#">Dança</a>
											</div>
											<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg' ?>" alt="Título lorem ipsum sit dolor amet, consectetur adispicing ">
											<strong>Título lorem ipsum sit dolor amet, consectetur adispicing</strong>
										</li>
										<li>
											<div class="link-area">
												<a class="color-circo" href="#">Circo</a>
											</div>
											<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg' ?>" alt="Título lorem ipsum sit dolor amet, consectetur adispicing ">
											<strong>Título lorem ipsum sit dolor amet, consectetur adispicing</strong>
										</li>
										<li>
											<div class="link-area">
												<a class="color-danca" href="#">Dança</a>
											</div>
											<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg' ?>" alt="Título lorem ipsum sit dolor amet, consectetur adispicing ">
											<strong>Título lorem ipsum sit dolor amet, consectetur adispicing</strong>
										</li>
										<li>
											<div class="link-area">
												<a class="color-circo" href="#">Circo</a>
											</div>
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
									<strong>Cecilia em busca da fantasia</strong>
									<span>De 8 a 30 de setembro – sábados e domingos, às 16h</span>
								</div>

								<div class="box-data__row">
									<span><b>Classificação etária:</b> Livre</span>
									<span><b>Duração:</b> 70min.</span>
								</div>

								<div class="box-data__row">
									<span><b>Ingressos:</b> R$ 20 (Inteira) e R$ 10 (Meia)</span>
								</div>

								<div class="box-data__row">
									<strong>Teatro Dulcina<br>Rua Alcindo Guanabara 17, Centro – Rio de Janeiro (RJ)<br>(próximo ao VLT e ao Metrô Cinelândia)</strong>
									<span><b>Telefone:</b> (21) 2240 4879</span>
								</div>

								<div class="box-data__row">
									<span><b>Dias:</b> De 8 de setembro a 9 de setembro de 2018</span>
									<span><b>Horário:</b> 16:00 às 17:10</span>
									<span><b>Local:</b> Teatro Dulcina - Rua Alcindo Guanabara 17, Centro – Rio de Janeiro (RJ)</span>
								</div>

								<h4 class="title-5">Veja como chegar</h4>

								<div class="box-data__map">
									<?php echo get_post_meta($post->ID, "espaco-maplink", true); ?>
								</div>
							</div>
						</aside>
					</div>
				</div>
			</div>
		</main>
	<?php }
get_footer();