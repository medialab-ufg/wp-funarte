<?php
get_header();
if(have_posts()) : the_post();
?>
	<main role="main" class="mb-100">
		<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
		<div class="container">
			<?php include('inc/template_parts/breadcrumb.php'); ?>

			<div class="box-title">
				<h2 class="title-h1"><a href="<?php echo get_bloginfo('url') . '/noticias'; ?>">Notícias</a> <a href="#"><span>Recentes</span></a> </h2>
			</div>

			<?php
				$imagem = get_the_post_thumbnail( );

				$area = get_the_category()[0];
			?>

			<div class="box-title-page <?php echo !empty($imagem) ? 'box-title-page--image' : ''; ?>">
				<div class='link-area'>
					<a href="<?php echo home_url() . '/category/' . $area->slug; ?>" class="color-<?php echo $area->slug; ?>"><?php echo $area->name; ?></a>
				</div>
				<h3 class="title-page"><?php the_title(); ?></h3>
				<?php
					if (!empty($imagem))
						echo $imagem;
				?>
			</div>

			<div class="box-text box-text--2-columns mb-100">
				<div class="box-text__text">
					<?php the_content(); ?>
				</div>
			</div>

			<section class="box-carousel-image">
				<div class="carousel-image__wrapper">
					<div class="carousel-image__control">
						<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
						<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
					</div>
					<ul class="carousel-image">
						<li>
							<a href="#"><img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>" alt=""></a>
						</li>
						<li>
							<a href="#"><img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>" alt=""></a>
						</li>
						<li>
							<a href="#"><img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>" alt=""></a>
						</li>
						<li>
							<a href="#"><img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>" alt=""></a>
						</li>
						<li>
							<a href="#"><img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>" alt=""></a>
						</li>
					</ul>
				</div>
			</section>
		</div>
	</main>
<?php
endif;
get_footer();
?>