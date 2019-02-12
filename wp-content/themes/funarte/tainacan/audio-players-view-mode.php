<?php if ( have_posts() ) : ?>
	<ul class="audios-list">
	<?php while ( have_posts() ) : the_post(); ?>
		<li>
			<div class="audios-list__box">
				<button type="button" class="audios-list__play"><i class="mdi mdi-play-circle-outline"></i></button>
				<ul class="audios-list__audio">
					<li><a href="<?php echo funarte_get_document_url(); ?>"></a></li>
				</ul>

				<div class="audios-list__title">
					<strong><?php the_title(); ?></strong>
				</div>

				<div class="audios-list__columns">
					<div class="audios-list__image" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>

					<div class="audios-list__text">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</li>
	<?php endwhile; ?>
	</ul>
<?php else: ?>
	
	Nada
	
	
<?php endif; ?>