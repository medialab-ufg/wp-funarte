<?php if ( have_posts() ) : ?>
	
	
	<?php while ( have_posts() ) : the_post(); ?>
		
		
		<?php the_title(); ?>
		
		<?php echo funarte_get_document_url(); ?>
		
		<br/>
		<br/>
		
		
	<?php endwhile; ?>
	
	
<?php else: ?>
	
	Nada
	
	
<?php endif; ?>