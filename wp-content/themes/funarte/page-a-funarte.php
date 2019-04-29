<?php
get_header();
$arg = array(
	'post_parent' => get_the_ID(),
	'post_type'   => 'page',
	'numberposts' => -1,
	'post_status' => 'any',
	'orderby' => 'menu_order',
	'order' => 'ASC'
	);

$contents = [];
$filhos = get_children($arg);
if(!empty($filhos)):
	foreach($filhos as $filho): 
		$contents[$filho->post_name] = ['content'=>$filho->post_content,'title'=>$filho->post_title];
	endforeach;
endif;
$options = wp_parse_args( get_option('theme_options'), get_theme_default_options() );
$url_dados_abertos = "#";
if(isset($options['url_dados_abertos'])) {
	$url_dados_abertos = $options['url_dados_abertos'];
}
?>
<main role="main">
	<div class="container">

		<?php
			$links = [['link_name'=>get_the_title()]];
			funarte_load_part('breadcrumb', ['links'=>$links]); 
		?>
		
		<div class="box-title">
			<h2 class="title-h1">Funarte <span>Institucional</span></h2>
			<a class="box-title__link" href="<?php echo $url_dados_abertos; ?>" target="_blank">Dados Abertos</a>
		</div>

		<!-- BOX-TABS--ACTIVE: CLASSE UTILIZADA PARA ATIVAR A TROCA DE ABAS VIA JS -->
		<section class="box-tabs box-tabs--active">
			<!-- LIST-TABS-ON-OFF: CLASSE UTILIZADA PARA ATIVAR/DESATIVAR O CARROSSEL DE ABAS AO PASSAR POR 1100PX DE LARGURA -->
			<div class="list-tabs list-tabs--on-off">
				<div class="box-tabs__control">
					<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
					<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
				</div>
				<div class="container">
					<ul class="list-tabs__main">
						<?php
							$contador = 0;
							foreach ($contents as $key => $content) :
						?>
								<li id="content-tab-<?php echo $key; ?>-trigger" class="<?php echo $contador == 0 ? 'active' : ''; ?>"><a href="#content-tab-<?php echo $key; ?>"><?php echo $content['title'] ?></a></li>
						<?php
							$contador++;
							endforeach;
						?>
						<li><a id="content-tab-identidade-visual-trigger" href="#content-tab-identidade-visual">Identidade Visual</a></li>
					</ul>
				</div>
			</div>

			<div class="content-tab">
				<?php
					$contador = 0;
					foreach ($contents as $key => $content) :
				?>
					<div id="content-tab-<?php echo $key; ?>" class="content-tab__content <?php echo $contador == 0 ? 'active' : ''; ?>">
						<h3 class="title-h4 content-tab__title"><?php echo $content['title'] ?></h3>
						<p><?php echo apply_filters('the_content', $content['content']); ?></p>
					</div>
				<?php
					$contador++;
					endforeach;
				?>
				
				<div id="content-tab-identidade-visual" class="content-tab__content">
					<h3 class="title-h4 content-tab__title">Identidade Visual</h3>
					
					<?php $categorias = get_terms(\funarte\taxIdentidadeVisual::get_instance()->get_name()); ?>
					
					<?php $pageIdentidade = get_page_by_path('identidade-visual'); ?>
					
					<?php if (is_object($pageIdentidade)): ?>
						<?php echo apply_filters('the_content', $pageIdentidade->post_content); ?>
					<?php endif; ?>
					
					<?php foreach ($categorias as $category) : ?>
						
						
						<?php 
						$ids = new WP_Query([
							\funarte\taxIdentidadeVisual::get_instance()->get_name() => $category->slug,
							'posts_per_page' => -1,
							'orderby' => 'name',
							'order' => 'ASC'
						]);
						
						if (!$ids->have_posts()) {
							continue;
						}
						?>
						
						<h2><?php echo $category->name; ?></h2>
						
						<?php while ($ids->have_posts()): $ids->the_post(); ?>
							
							<div class="row justify-content-between">
								<div class="col-md-6">
									
									<h3><?php the_title(); ?></h3>
							
									<?php the_content(); ?>
								
								</div>
								
								<div class="col-md-5">
									
									<?php
										$THEME_FOLDER = get_template_directory();
										$DS = DIRECTORY_SEPARATOR;
										$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'widget' . $DS;
										include($META_FOLDER . 'arquivos-relacionados.php');
									?>
									
								</div>
							</div>
						
						<?php endwhile; ?>
						
					<?php endforeach; ?>
					
					
					
					
					<?php wp_reset_postdata(); ?>
				</div>
				
			</div>
		</section>
	</div>
</main>
<?php get_footer(); ?>