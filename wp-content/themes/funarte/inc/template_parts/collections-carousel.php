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
				
				<li class="color-circo <?php if (($x % 2) != 0) echo 'carousel-collection__reverse'; ?> ">
					<div class="link-area">
						<a href="#">Teatro</a>
					</div>
					<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_001.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipisLorem ipsum dolor sit amet, consectetuer adipis">
				</li>
				
			<?php endwhile; ?>
		<?php endif; ?>
		
	</ul>
</div>
