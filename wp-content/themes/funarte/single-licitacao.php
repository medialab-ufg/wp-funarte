<?php
	use \funarte\taxModalidade;
	$pagina = home_url( $wp->request );
	$modalidade = wp_get_post_terms( $post->ID, taxModalidade::get_instance()->get_name());
	$modalidade = $modalidade[0];
	$ano = get_post_meta($post->ID, 'licitacao-ano', true);

	get_header();
	if (have_posts()) : the_post(); ?>
		<main role="main" class="mb-100">
			<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
			<div class="container">

				<?php
					$tags = [];
					$categoria_modalidade = wp_get_object_terms($post->ID, \funarte\taxModalidade::get_instance()->get_name());
					if ($categoria_modalidade[0]->slug != "inexigibilidade" and $categoria_modalidade[0]->slug != "dispensa") {
						if($modalidade) {
							$tags[] = [	'slug'=> 'funarte',
													'name'=> $categoria_modalidade[0]->name
												];
						}
					}
					$social_list = "<ul>
													<li><a href='http://www.facebook.com/sharer.php?u=$pagina' class='tooltip-social-media__facebook' target='_blank'><i class='mdi mdi-facebook'></i></a></li>
													<li><a href='http://twitter.com/share?url=$pagina' class='tooltip-social-media__twitter' target='_blank'><i class='mdi mdi-twitter'></i></a></li>
													<li class='whatsapp-item'><a href='whatsapp://send?text=$pagina' data-action='share/whatsapp/share' class='tooltip-social-media__whatsapp' target='_blank'><i class='mdi mdi-whatsapp'></i></a></li>
												</ul>";
					$links = [
						['link_name'=>'Licitação','link_url'=>'/licitacao'],
						['link_name'=>get_the_title()]];
					funarte_load_part('breadcrumb', ['links'=>$links]);
					funarte_load_part('box-title', ['titles'=>['Funarte', 'Licitações'],'social_list' => $social_list]);
					funarte_load_part('title-page', [	'title'=> get_the_title(),
																								'img'  => false,
																								'tags'=> $tags]); ?>

				<div class="row justify-content-between">
					<div class="col-md-7">
						<div class="box-text box-text--type-b">
							<?php
								$thumbnailPost = get_the_post_thumbnail(get_the_ID(), array('width' => 380, 'height' => null, 'after' => '<hr />'));
								if (!empty($thumbnailPost)):
							?>
								<div class="box-text__image">
									<?php echo $thumbnailPost; ?>
								</div>
							<?php endif; ?>

							<div class="box-text__text">
								<?php the_content(); ?>
							</div>

							<div class="box-text__table">
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
							?>
						</div>
					</div>
					<div class="col-md-4">
						<aside class="content-aside">
							<?php if ($controleModalidade != "Dispensa" and $controleModalidade != "Inexigibilidade") :
									query_posts(array(
										'post_type' => 'licitacao',
										'post__not_in' => array($post->ID),
										'meta_key' => 'licitacao-ano',
										'meta_value' => (int)$ano,
										'posts_per_page' => 5
									));
									if(have_posts()) : ?>
										<div class="box-bidding">
											<h4 class="title-h1--type-b">Mais licitações</h4>
											<ul class="list-bidding--type-b">
												<?php
												$post_type = get_post_type_archive_link( get_post_type() );
												while(have_posts()) :
													the_post();
													$modalidade = wp_get_post_terms( $post->ID, taxModalidade::get_instance()->get_name());
													$modalidade = $modalidade[0];
												?>
													<li class="color-funarte">
														<div class="link-area">
															<a href="<?php echo "$post_type?modalidade=$modalidade->slug"; ?>"><?php echo $modalidade->name; ?></a>
														</div>
														<strong><?php the_title(); ?></strong>
														<a class="link-more" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">Ler mais</a>
													</li>
												<?php endwhile; ?>
											</ul>
										</div>
									<?php
									endif;
								endif;
							?>
						</aside>
					</div>
				</div>
			</div>
		</main>
<?php 
	endif;
get_footer();