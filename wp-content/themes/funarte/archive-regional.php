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
		<ul class="list-bidding">
			<?php if(have_posts()): while(have_posts()): the_post(); ?>
			<li class="color-funarte">
				<?php
					$imagem = get_the_post_thumbnail( $post_id,'medium');

					if (!empty($imagem)):
				?>
				<div class="list-bidding__image">
					<?php echo $imagem; ?>
				</div>
				<?php endif; ?>

				<div class="list-bidding__text">
					<div class="link-area">
						<strong class="color-funarte"><?php echo get_post_meta($post->ID, "regional-cidade", true); ?></strong>
					</div>
					<h3 class="title-h5"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h3>
					<?php 
						the_excerpt();
					?>
					<a href="<?php the_permalink(); ?>" class="link-more">Ler mais</a>
				</div>
			</li>
			<?php endwhile; endif;?>
		</ul>
	</div>
</main>
<?php
get_footer();
?>
