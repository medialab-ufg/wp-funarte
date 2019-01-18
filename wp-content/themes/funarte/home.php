<?php

$categoria = (isset($_GET['area'])) ? get_category_by_name($_GET['area']) : false;

if (!empty($categoria))
	$bodyClass = $categoria->slug;

get_header();

$params = array();
if ($categoria)
	$params['cat'] = (int)$categoria->term_id;

query_posts(array_merge(array(
	'post_type' => 'post',
	'posts_per_page' => 12,
	'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
	'orderby' => 'date',
	'order' => 'DESC'
), $params));
?>

	<main role="main">
		<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
		<div class="container">

			<?php
				$links = [['link_name'=>'Notícias']];
				funarte_load_part('breadcrumb', ['links'=>$links]); 
			?>

			<div class="box-title">
				<h2 class="title-h1 mb-50">Notícias<span>Mídias</span></h2>

				<div class="box-forms">
					<form class="form-area" action="#" method="get">
						<fieldset>
							<legend>Formulário de seleção de área</legend>

							<select name="area" id="select-categoria" class="select_area">
								<option value="" selected="selected">Filtrar por área</option>
								<option class="level-0" value="funarte">Funarte</option>
								<option class="level-0" value="artes-integradas">Artes Integradas</option>
								<option class="level-0" value="artes-visuais">Artes Visuais</option>
								<option class="level-0" value="circo">Circo</option>
								<option class="level-0" value="danca">Dança</option>
								<option class="level-0" value="literatura">Literatura</option>
								<option class="level-0" value="musica">Música</option>
								<option class="level-0" value="teatro">Teatro</option>
								<option class="level-0" value="estudio-f">Estúdio F</option>
							</select>
						</fieldset>
					</form>
				</div>
			</div>

			<div class="row justify-content-between mb-90">
				<div class="col-md-4">
					<div class="box-bidding box-bidding--type-b">
						<div class="carousel-bidding--type-b__control">
							<button type="button" class="control__prev slick-arrow"><i class="mdi mdi-chevron-up"></i></button>
							<button type="button" class="control__next slick-arrow"><i class="mdi mdi-chevron-down"></i></button>
						</div>

						<ul class="list-bidding--type-b box-bidding--type-b__carousel">
							<li class="color-funarte">
								<div class="link-area">
									<a href="#">Facebook</a>
								</div>
								<strong>Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do</strong>
								<a class="link-more" href="#">Ler mais</a>
							</li>
							<li class="color-funarte">
								<div class="link-area">
									<a href="#">Twitter</a>
								</div>
								<strong>Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do</strong>
								<a class="link-more" href="#">Ler mais</a>
							</li>
							<li class="color-funarte">
								<div class="link-area">
									<a href="#">Facebook</a>
								</div>
								<strong>Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do</strong>
								<a class="link-more" href="#">Ler mais</a>
							</li>
							<li class="color-funarte">
								<div class="link-area">
									<a href="#">Facebook</a>
								</div>
								<strong>Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do</strong>
								<a class="link-more" href="#">Ler mais</a>
							</li>
							<li class="color-funarte">
								<div class="link-area">
									<a href="#">Twitter</a>
								</div>
								<strong>Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do</strong>
								<a class="link-more" href="#">Ler mais</a>
							</li>
							<li class="color-funarte">
								<div class="link-area">
									<a href="#">Facebook</a>
								</div>
								<strong>Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do</strong>
								<a class="link-more" href="#">Ler mais</a>
							</li>
							<li class="color-funarte">
								<div class="link-area">
									<a href="#">Facebook</a>
								</div>
								<strong>Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do</strong>
								<a class="link-more" href="#">Ler mais</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="col-md-7">
					<div class="box-carousel-audio">
						<div class="carousel-bidding--type-b__control">
							<button type="button" class="control__prev slick-arrow"><i class="mdi mdi-chevron-up"></i></button>
							<button type="button" class="control__next slick-arrow"><i class="mdi mdi-chevron-down"></i></button>
						</div>

						<ul class="carousel-audio">
							<li>
								<div class="box-carousel-audio__row-1">
									<div class="box-carousel-audio__info">
										<div class="link-area">
											<a class="color-funarte" href="#">Podcast</a>
										</div>
										<strong>Lorem ipsum dolor sit amet, consectetuer adi</strong>
									</div>
									<div class="box-carousel-audio__image" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/img/fke/audio_001.jpg' ?>);"></div>
								</div>
								<div class="box-carousel-audio__row-2">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incidi-dunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercita-tion ullamco laboris.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.  ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in</p>
									<a class="link-more" href="#">Ler mais</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="box-title">
				<h2 class="title-h1 mb-30">Notícias<span>Recentes</span></h2>

				<div class="box-forms">
					<form class="form-area" action="#" method="get">
						<fieldset>
							<legend>Formulário de seleção de área</legend>
							<?php
							wp_dropdown_categories(array(
								'show_option_none' => 'Filtrar por área',
								'option_none_value' => '',
								'hide_empty' => true,
								'id' => 'select-categoria',
								'class' => 'select_area',
								'name' => 'area',
								'value_field' => 'slug',
								'selected' => (isset($categoria->slug)) ? $categoria->slug : null));
							?>
						</fieldset>
					</form>
				</div>
			</div>
		</div>

		<section class="box-news">
			<div class="container">
				<ul class='box-news__list visible'>
					<?php if (have_posts()) :	while (have_posts()) : 
						the_post();
						$area = get_the_category()[0];
						?>
						<li class='color-<?php echo $area->slug; ?>'>
							<div class='link-area'>
								<a href="<?php echo home_url() . '/category/' . $area->slug; ?>"><?php echo $area->name; ?></a>
							</div>

							<?php 
								if (has_post_thumbnail()):
							?>
									<div class="box-news__image" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
							<?php else:?>
									<div class="box-news__image" style="background-image: url('<?php echo funarte_get_img_default($area->slug); ?>');"></div>
							<?php endif; ?>

							<h3 class='news-title'><?php the_title(); ?></h3>
							<?php the_excerpt(); ?>
							<a href='<?php the_permalink();  ?>' class='link-more'>Ler mais</a>
						</li>
					<?php 
					endwhile;
					echo get_pagination();
					endif; ?>
				</ul>
			</div>
		</section>
	</main>
<?php get_footer(); ?>