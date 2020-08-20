<?php
/**
 * collections: ojeto WP_Query com as coleções (posts do tipo tainacan-collection)
 * title: 
 * url_title:
 */
?>
<?php if ($collections->have_posts()): $x = 1; ?>
	<section class="box-carousel-collection mb-100">
		<?php if (isset($url_title)) : ?>
			<h2 class="title-1  mb-65"><a href="<?php echo $url_title; ?>"> <?php echo $title; ?> </a></h2>
		<?php elseif (isset($title)) : ?>
			<h2 class="title-1 mb-65"><?php echo $title; ?></h2>
		<?php endif; ?> 
		<div class="box-carousel-collection">
			<div class="carousel-collection__wrapper">
				<div class="carousel-collection__control">
					<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
					<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
				</div>
				<ul class="carousel-collection">
					
					<?php if ( is_page_template('page-cedoc.php') ) : ?>

						<li class="color-funarte carousel-collection__reverse">
							<div class="link-area">
								<strong>CEDOC</strong>
							</div>
							
							<p><a target="_blank" href="http://cedoc.funarte.gov.br/sophia_web/">Catálogo CEDOC (Sophia Biblioteca)</a></p>
							<a target="_blank" href="http://cedoc.funarte.gov.br/sophia_web/">
								<div class="carousel-collection__image" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/img/CEDOC.png' ?>);"></div>
							</a>
							
						</li>

						<li class="color-funarte carousel-collection__reverse">
							<div class="link-area">
								<strong>CEDOC</strong>
							</div>
							
							<p><a target="_blank" href="<?php echo home_url('sobre-o-acervo-sergio-britto-digital'); ?>">Acervo Sergio Britto (Sophia Acervo)</a></p>
							<a target="_blank" href="<?php echo home_url('sobre-o-acervo-sergio-britto-digital'); ?>">
								<div class="carousel-collection__image" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/img/sergio-britto.jpg' ?>);"></div>
							</a>
						</li>

						<li class="color-funarte carousel-collection__reverse">
							<div class="link-area">
								<strong>CEDOC</strong>
							</div>
							
							<p><a target="_blank" href="https://atom.funarte.gov.br/">Acervos Privados (Atom)</a></p>
							<a target="_blank" href="https://atom.funarte.gov.br/">
								<div class="carousel-collection__image" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/img/ATOM.png' ?>);"></div>
							</a>
							
						</li>
						
					<?php else : ?>
						
						<?php while ($collections->have_posts()): $collections->the_post(); $x++; ?>
							<?php
								if (!isset($area)) {
									$area_ = get_area_class(get_the_ID());
								} else {
									$area_ = $area;
								}
								$image = has_post_thumbnail()? get_the_post_thumbnail_url()  : funarte_get_img_default($area_['slug']);
								$link_area = get_category_link( $area_['ID'] );
							?>
							<li class="color-<?php echo $area_['slug']; if (($x % 2) != 0) echo ' carousel-collection__reverse'; ?> ">
								<div class="link-area">
									<?php if( empty($link_area)) : ?>
										<strong><?php echo $area_['name'];?></strong>
									<?php else : ?>
										<a href="<?php echo $link_area; ?>"><?php echo $area_['name'];?></a>
									<?php endif;?>
									
								</div>
								<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
								<a href="<?php the_permalink(); ?>">
									<div class="carousel-collection__image" style="background-image: url(<?php echo $image ?>);"></div>
								</a>
							</li>
						<?php endwhile; ?>
						
						<li class="color-funarte carousel-collection__reverse">
							<div class="link-area">
								<strong>Funarte</strong>
							</div>
							
							<p><a target="_blank" href="cedoc">CEDOC Digital</a></p>
							<a target="_blank" href="cedoc">
								<div class="carousel-collection__image" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/img/CEDOC_digital.png' ?>);"></div>
							</a>
							
						</li>

					<?php endif; ?>

				</ul>
			</div>
		</div>
	</section>
<?php endif; ?>