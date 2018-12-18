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

					<div class="tainacan-single-post">
						<article role="article">
							<h1 class="title-content-items"><?php _e( 'Attachments', 'tainacan-interface' ); ?></h1>
							<section class="tainacan-content single-item-collection margin-two-column">
								<div class="single-item-collection--attachments">
									<?php foreach ( $attachment as $attachment ) { ?>
										<div class="single-item-collection--attachments-img">
											<a href="<?php echo $attachment->guid; ?>" target="_BLANK">
												<?php
													echo wp_get_attachment_image( $attachment->ID, 'tainacan-interface-item-attachments' );
												?>
											</a>
										</div>
									<?php }
									?>
								</div>
							</section>
						</article>
					</div>

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
											<div class="card-body bg-white border-0 pl-0 pt-0 pb-1">
												<h3 class="title-content-items"><?php _e( 'Thumbnail', 'tainacan-interface' ); ?></h3>
												<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'tainacan-medium-full' ) ?>" class="item-card--thumbnail mt-2">
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
										<?php
											$args = array(
												'before_title' => '<div><h3 class="title-content-items">',
												'after_title' => '</h3>',
												'before_value' => '<p>',
												'after_value' => '</p></div>',
											);
											//$field = null;
											tainacan_the_metadata( $args );
										?>
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