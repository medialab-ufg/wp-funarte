<?php

get_header();
$info_extra = true;

$search_helper = \funarte\Search::get_instance();
$order_param = isset($_GET['ordenar']) ? $_GET['ordenar'] : 'date_desc';

?>

<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">

		<?php
			$links = [
				['link_name'=>'Busca','link_url'=>'/?s']];
			funarte_load_part('breadcrumb', ['links'=>$links]); 
		?>
		
		<div class="box-title">
			<h2 class="title-h1">Resultados de busca</h2>

			<form class="form-multi form-area" method="get">
				<fieldset>
					<legend>Formulário de reordenação</legend>
					<select name="ordenar"class='select_local'>
						<option value="">Ordenar</option>
							<option value="title" <?php selected($order_param, 'title'); ?>>Por título</option>
							<option value="date_desc" <?php selected($order_param, 'date_desc'); ?>>Mais novos primeiro</option>
							<option value="date_asc" <?php selected($order_param, 'date_asc'); ?>>Mais antigos primeiro</option>
					</select>
				</fieldset>

				<fieldset>
					<legend>Formulário de filtro por área</legend>
					<?php
					wp_dropdown_categories(array(
						'show_option_none' => 'Filtrar por área',
						'option_none_value' => '',
						'hide_empty' => true,
						'id' => 'select-categoria',
						'class' => 'select_area',
						'name' => 'area',
						'value_field' => 'id',
						'selected' => isset($_GET['area']) ? $_GET['area'] : ''));
					?>
				</fieldset>

				<fieldset>
					<legend>Campo de busca</legend>

					<div class="form-group">
						<label class="sr-only" for="busca-texto">Pesquisar</label>
						<input type="text" id="busca-texto" name="s" class='input_search' placeholder="<?php echo get_search_query(); ?>" value="<?php echo get_search_query(); ?>">
						<button type="submit"><i class="mdi mdi-magnify"></i><span class="sr-only">Pesquisar</span></button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>

	<div class="container">
		<aside>
			<button type="button" class="box-list-links__button"><i class="mdi mdi-chevron-left"></i><i class="mdi mdi-chevron-right"></i></button>
			<div class="box-list-links active">
				<h3 class="title-6 box-list-links__title">Tipos de resultados</h3>
				
				<?php 
				$post_types = $search_helper->get_search_post_types_groups();
				
				?>
				
				<ul>
					<?php foreach ($post_types as $group => $group_def): ?>
						<li class="<?php echo $search_helper->active_class($group); ?>">
							<a href="<?php echo add_query_arg('search_type', $group); ?>">
								<?php echo $group_def['label']; ?> (<?php echo $search_helper->get_group_search_count($group); ?>)
							</a>
						</li>
					<?php endforeach; ?>

				</ul>
			</div>
		</aside>
		<section class="list-soft">
			<?php 
			if(have_posts()) :
				$total = $wp_query->found_posts;
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
				<?php echo get_pagination(); ?>
			<?php endif; ?>
		</section>
	</div>
</main>


<?php get_footer(); ?>