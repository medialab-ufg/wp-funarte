<?php 
	get_header();
?>
<div class="container">
	<section class="box-tabs">
		<!-- LIST-TABS-ON-OFF: CLASSE UTILIZADA PARA ATIVAR/DESATIVAR O CARROSSEL DE ABAS AO PASSAR POR 1100PX DE LARGURA -->
		<div class="list-tabs list-tabs--on-off">
			<div class="box-tabs__control">
				<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
				<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
			</div>
			<div class="container">
				<ul class="list-tabs__main">
					<li class="<?php if($status=='todos') echo 'active'; ?>"><a data-status="todos" class="link-tabs" href="#">Todos</a></li>
					<li class="<?php if($status=='itens') echo 'active'; ?>"><a data-status="itens" class="link-tabs" href="#">Itens</a></li>
					<li class="<?php if($status=='noticias') echo 'active'; ?>"><a data-status="noticias" class="link-tabs" href="#">Notícias</a></li>
				</ul>
			</div>
		</div>

		<?php if (!empty($editais) && have_posts()):?>
		<div class="content-tab">
			<div class="container">
				<ul class="list-notices"><?php while (have_posts()): the_post(); ?>
					<li class="color-<?php echo get_the_category()[0]->slug; ?>">
						<div class="list-notices-image" style="background-image: url(<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : funarte_get_img_default(get_the_category()[0]->slug); ?>)">
						</div>
						<div class="list-notices-text">
							<?php
								$areas = get_the_category();
								if (!empty($areas)): ?>
								<div class="link-area">
									<?php foreach ($areas as $area): ?>
										<a class="<?php echo 'color-' . $area->category_nicename; ?>" href="<?php echo get_category_link( $area->cat_ID ); ?>"><?php echo $area->name; ?></a>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<h3 class="title-h5">
								<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
									<?php the_title(); ?>
								</a>
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
		<?php else:?>
			<div class="content-tab">
				<div class="container">
					Não existem editais.
				</div>
			</div>
		<?php endif;?>
	</section>

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
</div>

<?php get_footer();