<?php if ( have_posts() ) : ?>
	<ul class="audios-list">
	<?php while ( have_posts() ) : the_post(); ?>
		<li>
			<div class="audios-list__title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<!-- <button type="button" class="audios-list__share"><i class="mdi mdi-share-variant"></i></button> -->
			</div>

			<?php $videoUrl = funarte_get_document_url(); ?>

			<div class="audios-list__box <?php echo empty($videoUrl) ? '' : 'audios-list__has-audio'; ?>">
				<div class="videos-list__play">
					<button type="button"><i class="mdi mdi-play-circle-outline"></i></button>
				</div>
				<?php
					$youtube = get_youtube_video_ID($videoUrl);
					if ($youtube == false) {
						echo '<div class="videos-list__video" data-video="' . $videoUrl . '"></div>';
					} else {
						echo '<div class="videos-list__video"><iframe src="https://www.youtube.com/embed/' . $youtube . '" frameborder="0" allowfullscreen></iframe></div>';
					}
				?>

				<div class="audios-list__columns">
					<?php $imagem = get_the_post_thumbnail_url();
						if (empty($imagem)): ?>
						<div class="audios-list__image" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/img/bkg/grafismo_funarte.png'; ?>);"></div>
					<?php else: ?>
						<div class="audios-list__image" style="background-image: url(<?php echo $imagem; ?>);"></div>
					<?php endif; ?>

					<div class="audios-list__text base-tooltip">
						<span>
							<?php the_excerpt(); ?>
							<span class="audios-list__tooltip"><?php the_content(); ?></span>
						</span>
					</div>
				</div>
			</div>
		</li>
	<?php endwhile; ?>
	</ul>
<?php else: ?>
	
	Nada
	
	
<?php endif; ?>