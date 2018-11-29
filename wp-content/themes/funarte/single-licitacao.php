<?php
	use \funarte\taxModalidade;
	
	$modalidade = wp_get_post_terms( $post->ID, taxModalidade::get_instance()->get_name());
	$modalidade = $modalidade[0];
	$ano = get_post_meta($post->ID, 'licitacao-ano', true);

	get_header();
	if (have_posts()) : the_post(); ?>
		<main role="main">
			<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
			<div class="container">
				<?php include('inc/template_parts/breadcrumb.php'); ?>

				<div class="box-title">
					<h2 class="title-h1">
						<a href="<?php echo get_bloginfo('url') . '/licitacao'; ?>">Funarte <span>Licitações</span></a>
					</h2>
				</div>

				<!-- A DIV ABAIXO DEVE IR PARA O TEMPLATE_PARTS -->
				<div class="box-title-page">
					<?php 
						$categoria_modalidade = wp_get_object_terms($post->ID, \funarte\taxModalidade::get_instance()->get_name());
						if ($categoria_modalidade[0]->slug != "inexigibilidade" and $categoria_modalidade[0]->slug != "dispensa") {
							if(!$modalidade) {
								echo '<div class="link-area"><a class="color-funarte" href="#">' . $categoria_modalidade[0]->name . '</a></div>';
							}
						}
					?>
					<h3 class="title-page"><?php the_title(); ?></h3>
					<strong>Contratação de empresa especializada na prestação de serviços continuados com dedica-ção exclusiva de mão-de-obra, na execução de atividades ligadas à produção de espetácu-los teatrais, de dança, de musicais e de circo, relativos às atividades complementares e acessórias à área de atuação da Fundação Nacional de Artes – FUNARTE, localizadas nas cidades do Rio de Janeiro/RJ, São Paulo/SP, Belo Horizonte/MG e Brasília/DF, conforme con-dições, quantidades e exigências estabelecidas neste Edital e seus anexos.</strong>
				</div>

				<div class="row justify-content-between">
					<div class="<?php echo !empty($html_widget) ? 'col-md-7' : 'col-md-12' ?>">
						<div class="box-text">
							<div class="box-text__text">
							<?php
								$thumbnailPost = get_the_post_thumbnail(get_the_ID(), array('width' => 380, 'height' => null, 'after' => '<hr />'));
								if (!empty($thumbnailPost)):
							?>
								<div class="box-text__image">
									<?php echo $thumbnailPost; ?>
								</div>
							<?php endif; ?>

								<?php the_content(); ?>

								<table>
									<thead>
										<tr>
											<td>Número</td>
											<td>Data</td>
											<td>Hora</td>
											<td>Modalidade</td>
										</tr>
									</thead>
									<tbody>
										<?php
											$numero = get_post_meta($post->ID, 'licitacao-numero', true);
											$data = get_post_meta($post->ID, 'licitacao-data', true);
											$hora = get_post_meta($post->ID, 'licitacao-hora', true);
											$controleModalidade = $modalidade->name;
										?>
										<tr>
											<td><?php echo $numero; ?></td>
											<td><?php echo $data; ?></td>
											<td><?php echo $hora; ?></td>
											<td><?php echo $modalidade->name; ?></td>
										</tr>
									</tbody>
								</table>
							</div>

							<?php
							$THEME_FOLDER = get_template_directory();
							$DS = DIRECTORY_SEPARATOR;
							$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'widget' . $DS;
							require_once($META_FOLDER . 'arquivos-relacionados.php');
							
							if ($controleModalidade != "Dispensa" and $controleModalidade != "Inexigibilidade") :
								query_posts(array(
									'post_type' => 'licitacao',
									'post__not_in' => array($post->ID),
									'meta_key' => 'licitacao-ano',
									'meta_value' => (int)$ano,
									'posts_per_page' => 5
								));
								if(have_posts()) : ?>
									<div>
										<h3>
											<?php echo "<a href='/licitacoes/?ano=$ano' title='Outras licitações de $ano' >Outras licitações de $ano</a>";?>
										</h3>
										<ul>
											<?php
											while(have_posts()) :
												the_post();
												$modalidade = wp_get_post_terms( $post->ID, taxModalidade::get_instance()->get_name());
												$modalidade = $modalidade[0];
											?>
												<li>
													<h6><?php echo $modalidade->name; ?></h6>
													<h4><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
														<?php the_title(); ?>
													</a></h4>
												</li>
											<?php  endwhile; ?>
										</ul>
									</div>
								<?php 
								endif; 
							endif;
							?>
						</div>
					</div>
				</div>
			</div>
		</main>
<?php 
	endif;
get_footer();