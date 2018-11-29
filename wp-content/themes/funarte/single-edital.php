<?php 
	get_header();
	$edital = \funarte\Edital::get_instance();
	$status = $edital->get_edital_status($post->ID);

	if (have_posts()) { the_post(); ?>
		<main role="main">
			<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
			<div class="container">
				<?php include('inc/template_parts/breadcrumb.php'); ?>

				<div class="box-title">
					<h2 class="title-h1"><a href="<?php echo get_bloginfo('url') . '/edital'; ?>">Editais</a> <a href="<?php echo get_bloginfo('url') . '/editais/?status=' . $status; ?>"><span><?php echo $edital->get_edital_status_name($post->ID); ?></span></a></h2>
				</div>

				<!-- A DIV ABAIXO DEVE IR PARA O TEMPLATE_PARTS -->
				<div class="box-title-page color-artes-visuais">
					<?php
						$areas = get_the_category();
						if (!empty($areas)): ?>
						<div class="link-area">
							<?php foreach ($areas as $area): ?>
								<a class="<?php echo 'color-' . $area->category_nicename; ?>" href="#"><?php echo $area->name; ?></a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					<h3 class="title-page"><?php the_title(); ?></h3>
				</div>

				<?php 
					$params = ['return'=>true];
					$THEME_FOLDER = get_template_directory();
					$DS = DIRECTORY_SEPARATOR;
					$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'widget' . $DS;
					require_once($META_FOLDER . 'arquivos-relacionados.php');
				?>

				<div class="row justify-content-between">
					<div class="<?php echo !empty($html_widget) ? 'col-md-7' : 'col-md-12' ?>">
						<div class="box-text">
							<div class="box-text__date">
								<small>Publicado em <?php the_time(get_option('date_format')); ?></small>
							</div>

							<div class="box-text__text">
								<div class="box-text__image">
									<?php get_the_post_thumbnail(get_the_ID(), array('width' => 380, 'height' => null, 'after' => '<hr />')); ?>
								</div>

								<?php the_content(); ?>

								<a href="#" class="button-1 button-inscreva-se">Inscreva-se</a>
							</div>

							<!-- VERIFICAR O USO DESTE BLOCO -->

							<!-- <div class="box-text__info">
								<div class="resultado">
									<h3>
										<span><?php echo $edital->get_edital_status_name($post->ID); ?></span>
										<?php if ($status == 'aberto') { ?>
											<span class="interrogacao">
												<a href="#" title="Ajuda">?</a>
												<div class="box-guia">
													<p>Fique atento ao prazo final e inscreva-se a tempo. Estamos esperando seu projeto.</p>
												</div>
											</span>
										<?php } elseif ($status == 'avaliacao') { ?>
											<span class="interrogacao">
												<a href="#" title="Ajuda">?</a>
												<div class="box-guia">
													<p>Após o fim do prazo para inscrições, uma comissão julgadora avalia as propostas recebidas. Em seguida, a lista de projetos classificados será divulgada neste portal.</p>
												</div>
											</span>
										<?php } elseif ($status == 'resultado') { ?>
											<span class="interrogacao">
												<a href="#" title="Ajuda">?</a>
												<div class="box-guia">
													<p>Já foi divulgada a relação dos projetos classificados. Os proponentes contemplados devem proceder às próximas etapas previstas pelo edital (ex.: envio de documentação).</p>
												</div>
											</span>
										<?php } ?>
									</h3>
									<?php
									if ($status == 'aberto') {
										$meta = array(
											'inscricoes' => array(
												'inicio' => strtotime(get_post_meta($post->ID, 'edital-inscricoes_inicio', true)),
												'fim' => strtotime(get_post_meta($post->ID, 'edital-inscricoes_fim', true))
											),
											'prorrogado' => (bool)get_post_meta($post->ID, 'edital-prorrogado', true),
											'resultado' => (bool)get_post_meta($post->ID, 'edital-resultado', true)
										);
									?>
									<div class="descricao">
										<?php if ($meta['prorrogado']) { ?>
										<span class="fundo-amarelo">Prorrogado</span>
										<?php } ?>
										<span>Início: <strong><?php echo date('d/m/Y', $meta['inscricoes']['inicio']); ?></strong></span>
										<span>Término: <strong><?php echo date('d/m/Y', $meta['inscricoes']['fim']); ?></strong></span>
									</div>
									<?php } ?>
								</div>
							</div> -->
						</div>
					</div>
					<?php if (!empty($html_widget)): ?>
						<div class="col-md-4">
							<aside class="content-aside">
								<?php echo $html_widget; ?>
							</aside>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</main>
	<?php }
get_footer();