<?php 
	get_header(); 
?>
<?php if ( have_posts() ) : the_post(); ?>
	
	<div class="post-content" role="main">
		<h3> <?php the_title(); ?> </h3> 
		<div> <?php the_content(); ?> </div>
		<div> <?php echo get_the_date(); ?> </div>
	</div>

<?php
endif;
get_footer();