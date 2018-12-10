<?php

get_header();
$info_extra = true;

$params = array(
	's' => get_search_query(),
	'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
	'post_type' => array(
		'post',
		'page',
		// Custom posts que entram no resultado
		\funarte\Edital::get_instance()->get_post_type(),
		\funarte\Evento::get_instance()->get_post_type(),
		\funarte\Regional::get_instance()->get_post_type(),
		\funarte\EspacoCultural::get_instance()->get_post_type(),
		\funarte\Licitacao::get_instance()->get_post_type(),
		\funarte\NovaAquisicao::get_instance()->get_post_type(),
		\funarte\Estrutura::get_instance()->get_post_type()
		//$Relatorio->postTypeRelatorio['name']
	)
);
?>

<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">
		<?php include('inc/template_parts/breadcrumb.php'); ?>
		<div class="box-title">
			<h2 class="title-h1">Resultados de busca</h2>
		</div>
	</div>

	<div class="container">
		<section class="list-soft">
			<div class="row">
				<?php 
				if(have_posts()) :
					$busca_sem_filtro = new WP_Query(array_merge($params, array('showposts'=> -1)));
					wp_reset_query();
					query_posts($params);
					$total = $busca_sem_filtro->post_count;
					$start = max(((get_query_var('paged') - 1) * get_option('posts_per_page')) + 1, 1);
					$end = min($start + get_option('posts_per_page') - 1, $total);
				?>
					<div class="relacionamento">
						<span>Buscando por "<strong><?php echo get_search_query(); ?>"</strong>"</span>
						<span class="exibindo-paginas">Exibindo <strong><?php echo $start; ?></strong> a <strong><?php echo $end; ?></strong> de <strong><?php echo $total; ?></strong> resultados.</span>
					</div>

					<ul class="list-bidding">
						<?php while (have_posts()): the_post(); ?>
							<?php
								$area = get_the_category(get_the_ID());
								if (!empty($area)) { 
									$tag_name = $area[0]->name;
									$tag_class = $area[0]->slug;
									$tag_url = get_category_link( $area[0]->cat_ID );
								}	else {
									$tag_name = 'funarte';
									$tag_class = 'funarte';
								}
								$imagem = get_the_post_thumbnail( get_the_ID(),'medium');
							?>

							<li class="color-<?php echo $tag_class; ?>">
								<?php if (!empty($imagem)): ?>
									<div class="list-bidding__image">
										<?php echo $imagem; ?>
									</div>
								<?php endif; ?>

								<div class="list-bidding__text">
									<div class="link-area">
										<a href="<?php echo $tag_url; ?>" class="color-<?php echo $tag_class; ?>">
											<?php echo $tag_name; ?>
										</a>
									</div>
									<h3 class="title-h5"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h3>
									<?php the_excerpt(); ?>
									<a href="<?php the_permalink(); ?>" class="link-more">Ler mais</a>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
			</div>
		</section>
	</div>
</main>


<?php get_footer(); ?>