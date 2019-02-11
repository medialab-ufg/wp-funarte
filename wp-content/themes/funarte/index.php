<?php 
	get_header();
?>
<div class="container">
	<ul class="list-notices">
		<?php while (have_posts()): the_post(); ?>
		<?php if(has_category()) $area = get_the_category()[0];
							else $area = (object)['slug'=>'funarte', 'name'=>"funarte"]; ?>
		
		<li class="color-<?php echo $area->slug; ?>">
			<div class="list-notices-image" style="background-image: url(<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : funarte_get_img_default($area->slug); ?>)"></div>
			<div class="list-notices-text">
				<?php
					$areas = get_the_category();
					if (!empty($areas)): ?>
					<div class="link-area">
						<?php foreach ($areas as $area): ?>
							<a class="<?php echo 'color-' . $area->category_nicename; ?>" href="<?php echo get_category_link( $area->cat_ID ); ?>"><?php echo $area->name; ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<h3 class="title-h5">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
						<?php the_title(); ?>
					</a>
				</h3>
				<p><?php echo wp_trim_words(get_the_content(),50); ?></p>

				<a class="link-more" href="<?php the_permalink(); ?>">Leia mais</a>
			</div>
		</li>
		<?php endwhile; ?>
	</ul>
</div>

<?php get_footer();