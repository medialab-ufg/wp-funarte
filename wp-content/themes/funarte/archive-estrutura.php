<?php
	get_header();
	query_posts(array(
		'post_type' => \funarte\Estrutura::get_instance()->get_post_type(),
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC'
	));
?>

<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container mb-100">
		<div class="box-breadcrumb">
			<a class="box-breadcrumb__home" href="#"><i class="mdi mdi-home"></i></a>
			<a href="#">Contatos</a>
		</div>

		<div class="box-title">
			<h2 class="title-h1">Contatos <span>Informações</span></h2>
		</div>

		<div class="list-boxes-info">
			<?php if(have_posts()): while(have_posts()): the_post(); ?>
				<section class="box-info">
					<h3 class="title-h4"><?php the_title(); ?></h3>
					<?php 
						the_content();
						$arg = array(
							'post_parent' => get_the_ID(),
							'post_type'   => 'estrutura',
							'numberposts' => -1,
							'post_status' => 'any');
						$filhos = get_children($arg);
						if(!empty($filhos)): ?>
							<div class="box-info__collapse">
								<button class="collapse__button" type="button">Exibir a estrutura de <?php the_title() ?></button>
								<div class="collapse__text">
									<?php foreach($filhos as $filho): ?>
										<div class="text__block">
											<strong><?php echo $filho->post_title; ?></strong>
											<?php 
												$content = $filho->post_content; 
												$content = apply_filters('the_content', $content);
												echo $content;
											?>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif ?>
				</section>
			<?php endwhile; endif;?>
		</div>
	</div>
</main>

<?php
	get_footer();
?>