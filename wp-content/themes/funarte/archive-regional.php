<?php
get_header();
?>
<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">
		<div class="box-breadcrumb">
			<a class="box-breadcrumb__home" href="#"><i class="mdi mdi-home"></i></a>
			<a href="#">Funarte</a>
		</div>
		<div class="box-title">
			<h2 class="title-h1">Funarte <span> Representações Regionais</span></h2>
		</div>
		<div class="list-boxes-info">
			<?php if(have_posts()): while(have_posts()): the_post(); ?>
			<section class="box-info">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
				<h3 class="title-h4"><?php the_title(); ?></h3>
				</a>
				<?php 
					the_excerpt();
				?>
			</section>
			<?php endwhile; endif;?>
		</div>
	</div>
</main>
<?php
get_footer();
?>
