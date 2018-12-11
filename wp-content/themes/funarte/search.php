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

			<div class="box-forms">
				<form class="form-area" action="#" method="post">
					<fieldset>
						<legend>Formulário de reordenação</legend>
						<select class='select_local'>
							<option value="">Ordenar por</option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
						</select>
					</fieldset>
				</form>

				<form class="form-area" action="#" method="post">
					<fieldset>
						<legend>Formulário de filtro</legend>
						<select class='select_local'>
							<option value="">Filtrar por área</option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
						</select>
					</fieldset>
				</form>

				<form class="form-filtro form-filtro--espaco-cultural">
					<fieldset>
						<legend>Formulário de filtro de editais</legend>

						<div class="form-group">
							<label class="sr-only" for="filtro-editais-texto">Pesquisar editais</label>
							<input type="text" id="filtro-editais-texto" class='input_search' placeholder="Pesquisar editais" value="<?php echo $busca; ?>">
							<button type="submit"><i class="mdi mdi-magnify"></i><span class="sr-only">Pesquisar</span></button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<aside>
					<div class="box-list-links">
						<h3 class="title-6 box-list-links__title">Tipos de resultados</h3>

						<ul>
							<li><a href="#">Espaços Culturais (76)</a></li>
							<li><a href="#">Notícias (113)</a></li>
							<li><a href="#">Eventos (3)</a></li>
							<li><a href="#">Acervos (32)</a></li>
							<li><a href="#">Editais (16)</a></li>
							<li><a href="#">Itens de acervo (213)</a></li>
							<li><a href="#">Coleções (5)</a></li>
							<li><a href="#">Contatos (12)</a></li>
							<li><a href="#">Outros (39)</a></li>
						</ul>
					</div>
				</aside>
			</div>
			<div class="col-md-8">
				<section class="list-soft">
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
							<h3 class="title-7">Buscando por "<?php echo get_search_query(); ?>"</h3>
							<span>Exibindo <?php echo $start; ?> a <?php echo $end; ?> de <?php echo $total; ?> resultados.</span>
						</div>

						<ul class="list-bidding list-bidding--type-c">
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
									$imagem = get_the_post_thumbnail_url( get_the_ID(),'medium');
								?>

								<li class="color-<?php echo $tag_class; ?>">
									<?php if (!empty($imagem)): ?>
										<div class="list-bidding__image" style="background-image: url('<?php echo $imagem; ?>');"></div>
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
				</section>
			</div>
		</div>
	</div>
</main>


<?php get_footer(); ?>