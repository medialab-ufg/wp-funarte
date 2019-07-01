<?php
	get_header();
	query_posts(array(
		'post_type' => \funarte\Estrutura::get_instance()->get_post_type(),
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_parent' => 0
	));
	function FUNARTE_get_childrens_estrutura($ID) {
		$arg = array(
			'post_parent' => $ID,
			'post_type'   => 'estrutura',
			'numberposts' => -1,
			'post_status' => 'any');
		return get_children($arg);
	}
?>

<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container mb-100">

		<?php
			$links = [
				['link_name'=>'Contatos']];
			funarte_load_part('breadcrumb', ['links'=>$links]);
			funarte_load_part('box-title', ['titles'=>['Contatos', 'Informações']]);
		?>

		<div class="list-boxes-info">
			<?php if(have_posts()): while(have_posts()): the_post(); ?>
				<section class="box-info">
					<h3 class="title-h4"><?php the_title(); ?></h3>
					<?php 
						the_content();
						$filhos = FUNARTE_get_childrens_estrutura(get_the_ID());
						if(!empty($filhos)): ?>
							<div class="box-info__collapse">
								<button class="collapse__button" type="button">Exibir a estrutura de <?php the_title() ?></button>
								<div class="collapse__text">
									<?php foreach($filhos as $filho_ID => $filho): ?>
										<div class="text__block">
											<strong><?php echo $filho->post_title; ?></strong>
											<?php 
												$content = $filho->post_content; 
												$content = apply_filters('the_content', $content);
												echo $content;

												$netos = FUNARTE_get_childrens_estrutura($filho_ID);
												
												foreach($netos as $neto):
											?>
													<button class="collapse__button" type="button">Exibir a estrutura de <?php echo $filho->post_title; ?></button>
													<div class="collapse__text">
														<?php
															echo '<strong>' . $neto->post_title . '</strong>';
															$content = $neto->post_content; 
															$content = apply_filters('the_content', $content);
															echo $content;
														?>
													</div>
											<?php endforeach;
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