<?php
	get_header();
	$type = (isset($_GET['type']) && !empty($_GET['type'])) ? $_GET['type'] : 'todos';
?>
<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">

		<?php
			$links = [
				['link_name'=>'Itens Relacionados']];
			funarte_load_part('breadcrumb', ['links'=>$links]); 
		?>

		<div class="box-title">
			<h2 class="title-h1">Itens Relacionados</h2>
		</div>

		<section class="box-tabs">
			<!-- LIST-TABS-ON-OFF: CLASSE UTILIZADA PARA ATIVAR/DESATIVAR O CARROSSEL DE ABAS AO PASSAR POR 1100PX DE LARGURA -->
			<div class="list-tabs list-tabs--on-off">
				<div class="box-tabs__control">
					<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
					<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
				</div>
				<div class="container">
					<ul class="list-tabs__main">
						<li class="<?php if($type=='todos') echo 'active'; ?>"><a data-type="todos" class="link-tabs" href="#">Todos</a></li>
						<li class="<?php if($type=='itens') echo 'active'; ?>"><a data-type="itens" class="link-tabs" href="./&tipo=itens">Itens</a></li>
						<li class="<?php if($type=='noticias') echo 'active'; ?>"><a data-type="noticias" class="link-tabs" href="&tipo=noticias">Notícias</a></li>
					</ul>
				</div>
			</div>

			<div class="content-tab">
				<div class="container">
					<ul class="list-notices">
						<?php while (have_posts()): the_post(); ?>
						<?php if(has_category()) $area = get_the_category()[0];
											else $area = (object)['slug'=>'funarte', 'name'=>"funarte"]; ?>
						
						<li class="color-<?php echo $area->slug; ?>">
							<div class="list-notices-image" style="background-image: url(<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : funarte_get_img_default($area->slug); ?>)"></div>
							<div class="list-notices-text">
								<?php
									$areas = get_the_category();
									if (!empty($areas)): ?>
									<div class="link-area">
										<?php foreach ($areas as $area): ?>
											<a class="<?php echo 'color-' . $area->category_nicename; ?>" href="<?php echo get_category_link( $area->cat_ID ); ?>"><?php echo $area->name; ?></a>
											<em class="link-area__type"><?php echo get_post_type() == 'post' ? 'Notícia' : '' ?></em>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>

								<h3 class="title-h5">
									<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
										<?php the_title(); ?>
									</a>

									<?php echo get_post_type() != 'post' ? '<em class="link-area__type">Item de acervo</em>' : '' ?>
								</h3>
								<p><?php echo wp_trim_words(get_the_content(),50); ?></p>

								<a class="link-more" href="<?php the_permalink(); ?>">Leia mais</a>
							</div>
						</li>
						<?php endwhile; ?>
					</ul>
					<?php echo get_pagination(); ?>
				</div>
			</div>
		</section>
	</div>
</main>

<script>
	window.onload = function() {
		$(".link-tabs").on("click", function(e) {
			var searchParams = new URLSearchParams(window.location.search);
			var args = {};
			for(var key of searchParams.keys()) {
				args[key] = searchParams.get(key);
			}
			args['type'] = this.dataset.type;
			applyFilters(args);
			e.preventDefault();
		});
	}
</script>

<?php get_footer();