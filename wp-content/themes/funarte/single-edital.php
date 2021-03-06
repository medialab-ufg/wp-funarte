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
					$edicoes = $edital->get_edital_editions($post->ID);
				?>

				<div class="row justify-content-between mb-100">
					<div class="col-md-7">
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
							
						</div>
					</div>
					
					<div class="col-md-4">
					
						<div class="box-data">
							<h4 class="title-5">Informações</h4>
							<div class="box-data__row">
							<span><b><?php echo $edital->get_edital_status_name($post->ID); ?>: </b>
								<?php if ($status == 'aberto') { ?>
									Fique atento ao prazo final e inscreva-se a tempo. Estamos esperando seu projeto.
								<?php } elseif ($status == 'avaliacao') { ?>
									Após o fim do prazo para inscrições, uma comissão julgadora avalia as propostas recebidas. Em seguida, a lista de projetos classificados será divulgada neste portal.
								<?php } elseif ($status == 'resultado') { ?>
										Já foi divulgada a relação dos projetos classificados. Os proponentes contemplados devem proceder às próximas etapas previstas pelo edital (ex.: envio de documentação).
								<?php } ?>
							</span>
							</div>
							
							<div class="box-data__row">
								
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

									<span>
										<strong>Inscrições <?php if ($meta['prorrogado']) echo 'prorrogadas'; ?></strong>
									</span>
									<span>
										<b>Início:</b> <?php echo date('d/m/Y', $meta['inscricoes']['inicio']); ?>
									</span>
									<span>
										<b>Término:</b> <?php echo date('d/m/Y', $meta['inscricoes']['fim']); ?>
									</span>

								<?php } ?>
							</div>

						</div>
					
						<?php if ( !empty($html_widget) || !empty($edicoes) ): ?>
						
							

							<?php if (!empty($html_widget)): ?>
								<aside class="content-aside">
									<?php echo $html_widget; ?>
								</aside>
							<?php endif; ?>

							<?php if( !empty($edicoes)): ?>
								<div class="box-simple-links mb-0">
									<h2 class="title-h1">Outras Edições</h2>
									<ul class="list-simple-links">
										<?php foreach ( $edicoes as $edital_rel ): ?>
											<li class="color-funarte">
												<strong><?php echo $edital_rel->post_title; ?></strong>
												<a class="link-more" target="_blank" title="<?php echo $edital_rel->post_title; ?>" href="<?php echo get_the_permalink($edital_rel->ID); ?>">Visitar</a>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							<?php endif; ?>
						
						<?php endif; ?>
					</div>
				</div>
			</div>
		</main>
	<?php }
get_footer();
