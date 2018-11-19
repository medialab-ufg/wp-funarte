<?php 
	get_header(); 

	if (get_single_category()) {
		$area = get_single_category();
		if ($area->name == 'Estúdio F')
			$area = get_category_by_name('Música');
		$Breadcrumb->addBread($area->name, get_bloginfo('url') . '/agenda-cultural/?area=' . $area->slug);
	}
?>
<?php if ( have_posts() ) : the_post(); ?>
	
	<?php
		$areas = get_the_category();
		if (!empty($areas) && (count($areas) > 1)) { ?>
		<div class="relacionamento">
			<span>Relacionado a:
			<?php foreach ($areas AS $area) { ?>
				<small class="<?php echo $area->category_nicename; ?>"><?php echo $area->name; ?></small><?php if ($area != end($areas)) { ?>, <?php } ?>
			<?php } ?>
			</span>
		</div>
	<?php } ?>
	
	<div class="post-content" role="main">
		<h3> <?php the_title(); ?> </h3> 
		<div> <?php the_content(); ?> </div>
		<div> <?php echo get_the_date(); ?> </div>
	</div>

<?php
endif;
get_footer();