<?php if ( have_posts() ) : ?>
	<ul class="audios-list">
	<?php while ( have_posts() ) : the_post(); ?>
		<li>
			<div class="audios-list__title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<!-- <button type="button" class="audios-list__share"><i class="mdi mdi-share-variant"></i></button> -->
			</div>

			<?php $audioUrl = funarte_get_document_url(); ?>

			<div class="audios-list__box <?php echo empty($audioUrl) ? '' : 'audios-list__has-audio'; ?>">
				<div class="audios-list__play">
					<button type="button"><i class="mdi mdi-play-circle-outline"></i></button>
				</div>
				<div class="audios-list__audio">
					<ul class="playlist">
						<li><a href="<?php echo $audioUrl; ?>"></a></li>
					</ul>
				</div>

				<div class="audios-list__columns">
					<div class="audios-list__image" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>

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