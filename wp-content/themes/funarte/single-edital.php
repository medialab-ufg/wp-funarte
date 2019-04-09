<?php 
	get_header();
	$edital = \funarte\Edital::get_instance();
	$status = $edital->get_edital_status($post->ID);
	$pagina = home_url( $wp->request );

	if (have_posts()) { the_post(); ?>
		<main role="main">
			<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
			<div class="container">

				<?php 
					$links = [
						['link_name'=>'Editais/Chamamentos','link_url'=>'/edital'],
						['link_name'=>get_the_title()]];
					funarte_load_part('breadcrumb', ['links'=>$links]); 

					$social_list = "<ul>
													<li><a href='http://www.facebook.com/sharer.php?u=$pagina' class='tooltip-social-media__facebook' target='_blank'><i class='mdi mdi-facebook'></i></a></li>
													<li><a href='http://twitter.com/share?url=$pagina' class='tooltip-social-media__twitter' target='_blank'><i class='mdi mdi-twitter'></i></a></li>
													<li class='whatsapp-item'><a href='whatsapp://send?text=$pagina' data-action='share/whatsapp/share' class='tooltip-social-media__whatsapp' target='_blank'><i class='mdi mdi-whatsapp'></i></a></li>
												</ul>";
					funarte_load_part('box-title', ['titles'=>['Editais/Chamamentos', $edital->get_edital_status_name($post->ID)], 'social_list' => $social_list ]); 
				?>

				<?php
					$areas = get_the_category();
					$tags = [];
					foreach ($areas as $area):
						$tags[] = [	'slug'=> $area->slug,
											'name'=> $area->name,
											'url_area'=> home_url() . '/category/' . $area->slug];
					endforeach;
				?>
				
				<?php funarte_load_part('title-page', [	'title'=> get_the_title(),
																								'date_pub' => get_the_time(get_option('date_format')),
																								'img'  => get_the_post_thumbnail_url(),
																								'tags'=> $tags]); ?>

				<?php
					$params = ['return'=>true];
					$THEME_FOLDER = get_template_directory();
					$DS = DIRECTORY_SEPARATOR;
					$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'widget' . $DS;
					require_once($META_FOLDER . 'arquivos-relacionados.php');
				?>

				<div class="row justify-content-between mb-100">
					<div class="<?php echo !empty($html_widget) ? 'col-md-7' : 'col-md-12' ?>">
						<div class="box-text">
							<div class="box-text__text">
								<?php the_content(); ?>

								<?php
									$arg = array(
										'post_parent' => get_the_ID(),
										'post_type'   => \funarte\Edital::get_instance()->get_post_type(),
										'numberposts' => -1);
									$filhos = get_children($arg);
									if(!empty($filhos)): ?>
										<?php foreach($filhos as $filho): ?>
										<div class="box-edital-filho">
											<h4 class="box-edital-filho__title">
												<?php echo $filho->post_title; ?> 
												<span><?php echo '(' . get_the_time(get_option('date_format'), $filho) . ')'; ?></span>
											</h4>
											<?php 
												$content = $filho->post_content; 
												$content = apply_filters('the_content', $content);
												echo '<div class="box-edital-filho__content">' . $content . '</div>';
											?>
										</div>
										<?php endforeach; ?>
									<?php endif ?>

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

				<strong> Outras edições </strong>
				<div class="row mb-100">
				 <?php 
					 $edicoes = $edital->get_edital_editions($post->ID);
					 if (have_posts()):
						?> 						
						<ul> <?php
						while (have_posts()):
							the_post();
							?>
								<li><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></li>
							<?php
						endwhile;
						?> </ul> <?php
					endif;
				 ?>
				</div>

			</div>
		</main>
	<?php }
get_footer();