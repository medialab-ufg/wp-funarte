<?php get_header(); ?>

<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container mb-100">
		<div class="box-title">
			<h2 class="title-h1">Acervo <span><?php echo tainacan_get_the_collection_name(); ?></span></h2>
		</div>

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
							<h3 class="title-content-items"><?php _e( 'Document', 'tainacan-interface' ); ?></h3>

							<section class="tainacan-content single-item-collection margin-two-column">
								<div class="single-item-collection--document">
									<?php tainacan_the_document(); ?>
								</div>
							</section>
						<?php endif; ?>
					</article>
				</div>


				<?php if ( tainacan_has_document() ) : ?>
					<div class="tainacan-border"></div>
				<?php endif; ?>

				<?php
					$attachment = array_values(
						get_children(
							array(
								'post_parent' => $post->ID,
								'post_type' => 'attachment',
								'post_mime_type' => 'image',
								'order' => 'ASC',
								'numberposts'  => -1,
							)
						)
					);
				?>

				<?php if ( ! empty( $attachment ) ) : ?>

					<section class="box-carousel-attachments">
						<h3 class="box-carousel-attachments__title"><?php _e( 'Attachments', 'tainacan-interface' ); ?></h3>

						<div class="box-carousel__control">
							<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
							<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
						</div>

						<ul class="carousel-attachments">
							<?php foreach ( $attachment as $attachment ) { ?>
								<li>
									<a href="<?php echo $attachment->guid; ?>" target="_BLANK" style="background-image: url(<?php echo wp_get_attachment_image_url( $attachment->ID, 'tainacan-interface-item-attachments' ); ?>);"></a>
								</li>
							<?php }
							?>
						</ul>
					</section>

					<div class="tainacan-title my-5">
						<div class="border-bottom border-silver tainacan-title-page" style="border-width: 1px !important;">
						</div>
					</div>

				<?php endif; ?>


				<div class="tainacan-single-post">
					<article role="article">
						<!-- <h1 class="title-content-items"><?php _e( 'Information', 'tainacan-interface' ); ?></h1> -->
						<section class="tainacan-content single-item-collection margin-two-column">
							<div class="single-item-collection--information justify-content-center">
								<div class="row">
									<div class="col s-item-collection--metadata">
										<div class="card border-0">
											<div class="box-acervo-info">
												<h3 class="box-acervo-info__title"><?php _e( 'Thumbnail', 'tainacan-interface' ); ?></h3>
												<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'tainacan-medium-full' ) ?>" class="box-acervo-info__image">
											</div>
										</div>
										<div class="card border-0 my-3">
											<div class="card-body bg-white border-0 pl-0 pt-0 pb-1">
												<h3 class="title-content-items"><?php _e( 'Share', 'tainacan-interface' ); ?></h3>
												<div class="btn-group" role="group">
													<?php if ( true == get_theme_mod( 'tainacan_facebook_share', true ) ) : ?> 
														<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="item-card-link--sharing" target="_blank">
															<img src="<?php echo get_template_directory_uri() . '/assets/images/facebook-circle.png'; ?>" alt="">
														</a>
													<?php endif; ?>
													<?php if ( true == get_theme_mod( 'tainacan_twitter_share', true ) ) : ?> 
														<?php
														$twitter_option = get_option( 'tainacan_twitter_user' );
														$via = ! empty( $twitter_option ) ? '&amp;via=' . esc_attr( get_option( 'tainacan_twitter_user' ) ) : '';
														?>
														<a href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php the_title_attribute(); ?><?php echo $via; ?>" target="_blank" class="item-card-link--sharing">
															<img src="<?php echo get_template_directory_uri() . '/assets/images/twitter-circle.png'; ?>" alt="">
														</a>
													<?php endif; ?>
													<?php if ( true == get_theme_mod( 'tainacan_google_share', true ) ) : ?> 
														<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" class="item-card-link--sharing">
															<img src="<?php echo get_template_directory_uri() . '/assets/images/google-plus-circle.png'; ?>" alt="">
														</a>
													<?php endif; ?>
												</div>
											</div>
										</div>
										<?php do_action( 'tainacan-interface-single-item-metadata-begin' ); ?>

										<ul class="box-acervo__metadata">
											<?php
												$args = array(
													'before_title' => '<li><h4 class="box-acervo__metadata-title">',
													'after_title' => '</h4>',
													'before_value' => '<p>',
													'after_value' => '</p></li>',
												);
												//$field = null;
												tainacan_the_metadata( $args );
											?>
										</ul>
									</div>
								</div>
							</div>
						</section>
					</article>
				</div>


			<?php endwhile; ?>
		<?php else : ?>
			<?php _e( 'Nothing found', 'tainacan-interface' ); ?>
		<?php endif; ?>
	</div>
</main>



<?php get_footer(); ?>