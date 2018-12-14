<?php
/**
 * collections: ojeto WP_Query com as coleções (posts do tipo tainacan-collection)
 * 
 */
?> 
<div class="carousel-collection__wrapper">
	<div class="carousel-collection__control">
		<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
		<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
	</div>
	<ul class="carousel-collection">
		<?php if ($collections->have_posts()): $x = 1; ?>
			<?php while ($collections->have_posts()): $collections->the_post(); $x++; ?>

				<?php
					if (!isset($area))
						$area_ = ['name'=>get_the_category(get_the_ID())[0]->name, 'slug'=>get_the_category(get_the_ID())[0]->slug ];
					else {
						$area_ = $area;
					}
					$image = has_post_thumbnail()? get_the_post_thumbnail_url()  : funarte_get_img_default($area_['slug']);
				?>
				
				<li class="color-<?php echo $area_['slug']; if (($x % 2) != 0) echo ' carousel-collection__reverse'; ?> ">
					<div class="link-area">
						<a href="#"><?php echo $area_['name'];?></a>
					</div>
					<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
					<img src="<?php echo $image; ?>" alt="<?php the_title(); ?>">
				</li>
				
			<?php endwhile; ?>
		<?php endif; ?>
		
	</ul>
</div>
