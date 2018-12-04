<?php
get_header();
if(have_posts()) : the_post();
?>
	<main role="main">
		<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
		<div class="container">
			<?php include('inc/template_parts/breadcrumb.php'); ?>

			<div class="box-title">
				<h2 class="title-h1"><a href="<?php echo get_bloginfo('url') . '/noticias'; ?>">Notícias</a> <a href="#"><span>Recentes</span></a> </h2>
			</div>

			<?php $imagem = get_the_post_thumbnail( ); ?>

			<div class="box-title-page <?php echo !empty($imagem) ? 'box-title-page--image' : ''; ?>">
				<h3 class="title-page"><?php the_title(); ?></h3>
				<?php
					if (!empty($imagem))
						echo $imagem;
				?>
			</div>

			<div class="row justify-content-between">
				<div class="box-text">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</main>
<?php
endif;
get_footer();
?>