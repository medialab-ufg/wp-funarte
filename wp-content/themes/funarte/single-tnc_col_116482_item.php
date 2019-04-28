<?php 
$item = tainacan_get_item();
$bloco1 = wp_get_attachment_url($item->get_document());
$bloco1_post = get_post($item->get_document());
$bloco1_title = $bloco1_post->post_title;
$attachments = get_attached_media( 'audio' );

$bloco2= false;
$bloco3 = false;
if (is_array($attachments) && sizeof($attachments) > 0) {
	$_bl1 = array_shift($attachments);
	$bloco2 = wp_get_attachment_url($_bl1->ID);
	$bloco2_title = $_bl1->post_title;
}
if (is_array($attachments) && sizeof($attachments) > 0) {
	$_bl2 = array_shift($attachments);
	$bloco3 = wp_get_attachment_url($_bl2->ID);
	$bloco3_title = $_bl2->post_title;
}
?>

<?php get_header(); ?>

<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container mb-100">
		<?php funarte_load_part('box-title', ['titles'=>['Acervo', tainacan_get_the_collection_name()]]); ?>

		<?php if ( have_posts() ) : ?>
			<?php do_action( 'tainacan-interface-single-item-top' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="tainacan-title">
					<div class="tainacan-title-page" style="border-width: 2px !important;">
						<ul class="list-inline mb-0">
							<li class="list-inline-item text-midnight-blue title-page">
								<?php the_title(); ?>
							</li>
							<li class="list-inline-item float-right title-back">
								<a href="javascript:history.go(-1)">
									<?php _e( 'Back', 'tainacan-interface' ); ?>
								</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="tainacan-single-post collection-single-item">
					<article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>
						<?php if ( tainacan_has_document() ) : ?>
							<h3 class="title-content-items">Conteúdo</h3>

							<div class="box-tainacan-document">
								<div class="row justify-content-between">
									<div class="col-md-6">
										
										<ul class="box-acervo__social-media-list">
											<?php if ( true == get_theme_mod( 'tainacan_facebook_share', true ) ) : ?> 
												<li>
													<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="item-card-link--sharing" target="_blank">
														<img src="<?php echo get_template_directory_uri() . '/assets/img/ico/facebook-circle.png'; ?>" alt="">
													</a>
												</li>
											<?php endif; ?>
											<?php if ( true == get_theme_mod( 'tainacan_twitter_share', true ) ) : ?> 
												<?php
												$twitter_option = get_option( 'tainacan_twitter_user' );
												$via = ! empty( $twitter_option ) ? '&amp;via=' . esc_attr( get_option( 'tainacan_twitter_user' ) ) : '';
												?>
												<li>
													<a href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php the_title_attribute(); ?><?php echo $via; ?>" target="_blank" class="item-card-link--sharing">
														<img src="<?php echo get_template_directory_uri() . '/assets/img/ico/twitter-circle.png'; ?>" alt="">
													</a>
												</li>
											<?php endif; ?>
											<?php if ( true == get_theme_mod( 'tainacan_google_share', true ) ) : ?> 
												<li>
													<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" class="item-card-link--sharing">
														<img src="<?php echo get_template_directory_uri() . '/assets/img/ico/google-plus-circle.png'; ?>" alt="">
													</a>
												</li>
											<?php endif; ?>
										</ul>
										
										<br/>
										<?php if (has_post_thumbnail()): ?>
											<div class="box-tainacan-document__data">
												<h4 class="box-acervo__metadata-title"><?php _e( 'Thumbnail', 'tainacan-interface' ); ?></h4>
												<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'tainacan-medium-full' ) ?>">
											</div>
										<?php endif; ?>	
										
										<div class="box-tainacan-document__data">
											<?php
												$args = array(
													'before_title' => '<strong class="box-acervo__metadata-title">',
													'after_title' => '</strong>',
													'before_value' => '<p>',
													'after_value' => '</p>',
													'exclude_title' => true
												);
												//$field = null;
												tainacan_the_metadata( $args );
											?>
										</div>

										
									</div>
									<div class="col-md-5">
										<div class="video-list video-list__type-audio">
											<div class="box-tainacan-document__playlist">
												<strong><?php echo $bloco1_title; ?></strong>

												<div class="video-player mb-60">
													<video autoplay src="<?php echo $bloco1; ?>" class="video-video"></video>
													<div class="video-bar">
														<button type="button" class="video-play"><i class="mdi mdi-play"></i></button>
														<button type="button" class="video-pause inativo"><i class="mdi mdi-pause"></i></button>
														<div class="video-progress">
															<div class="video-progress__background">
																<div class="video-progress__bar"></div>
															</div>
														</div>
														<div class="video-current"></div>
														<div class="video-duration"></div>
														<button type="button" class="video-volume"><i class="mdi mdi-volume-high"></i><i class="mdi mdi-volume-mute"></i></button>
														<button type="button" class="video-full"><i class="mdi mdi-fullscreen"></i></button>
													</div>
												</div>
												
												<?php if ($bloco2): ?>
													
													<strong><?php echo $bloco2_title; ?></strong>

													<div class="video-player mb-60">
														<video autoplay src="<?php echo $bloco2; ?>" class="video-video"></video>
														<div class="video-bar">
															<button type="button" class="video-play"><i class="mdi mdi-play"></i></button>
															<button type="button" class="video-pause inativo"><i class="mdi mdi-pause"></i></button>
															<div class="video-progress">
																<div class="video-progress__background">
																	<div class="video-progress__bar"></div>
																</div>
															</div>
															<div class="video-current"></div>
															<div class="video-duration"></div>
															<button type="button" class="video-volume"><i class="mdi mdi-volume-high"></i><i class="mdi mdi-volume-mute"></i></button>
															<button type="button" class="video-full"><i class="mdi mdi-fullscreen"></i></button>
														</div>
													</div>
													
												<?php endif; ?>
												
												<?php if ($bloco3): ?>
													
													<strong><?php echo $bloco3_title; ?></strong>

													<div class="video-player mb-60">
														<video autoplay src="<?php echo $bloco3; ?>" class="video-video"></video>
														<div class="video-bar">
															<button type="button" class="video-play"><i class="mdi mdi-play"></i></button>
															<button type="button" class="video-pause inativo"><i class="mdi mdi-pause"></i></button>
															<div class="video-progress">
																<div class="video-progress__background">
																	<div class="video-progress__bar"></div>
																</div>
															</div>
															<div class="video-current"></div>
															<div class="video-duration"></div>
															<button type="button" class="video-volume"><i class="mdi mdi-volume-high"></i><i class="mdi mdi-volume-mute"></i></button>
															<button type="button" class="video-full"><i class="mdi mdi-fullscreen"></i></button>
														</div>
													</div>
													
												<?php endif; ?>

											</div>
										</div>
									</div>
								</div>
								<?php //tainacan_the_document(); ?>
							</div>
						<?php endif; ?>
					</article>
				</div>



				<?php
				$tax = \Tainacan\Repositories\Taxonomies::get_instance()->fetch_one(['name'=>'Assunto']);
				$slug_taxonomia = $tax->get_db_identifier();
				$terms = get_the_terms(get_the_ID(), $slug_taxonomia);
				if (!empty($terms)):
					$terms_slugs = array_map(function($el) { return $el->slug; }, $terms);
					$link_more = get_term_link($terms[0]->term_id);
					$loop = new WP_Query([
						'posts_per_page' => 3,
						'post_type' => 'post',
						'tax_query' => [
							[
								['taxonomy' => $slug_taxonomia, 'field' => 'slug', 'terms' => $terms_slugs]
							]
						]
					]);
				?>

				<section class="box-related-links color-funarte">
					<h3 class="box-carousel-attachments__title">Links relacionados</h3>

					<ul class="box-related-links__list">
						<?php while ( $loop->have_posts() ) : $loop->the_post(); 
							$image = has_post_thumbnail() ? get_the_post_thumbnail_url()  : funarte_get_img_default( ); ?>
							<li>
								<img src="<?php echo $image; ?>" alt="Imagem">
								<a href="<?php echo get_permalink() ?>"><span><?php echo get_the_title(); ?></span></a>
							</li>
						<?php endwhile; ?>
					</ul>

					<a href="<?php echo $link_more; ?>" class="link-more--type-b"><i class="mdi mdi-plus"></i></a>
				</section>
			<?php
				wp_reset_query();
				endif;
			?>

				<div class="tainacan-border"></div>

				<div class="tainacan-single-post">
					<article role="article">
						<?php do_action( 'tainacan-interface-single-item-metadata-begin' ); ?>

					</article>
				</div>


			<?php endwhile; ?>
		<?php else : ?>
			<?php _e( 'Nothing found', 'tainacan-interface' ); ?>
		<?php endif; ?>
	</div>
</main>



<?php get_footer(); ?>
