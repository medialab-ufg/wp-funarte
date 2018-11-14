<?php
get_header();

while (have_posts()): the_post();
?>
	<div>
		<a href=<?php echo get_post_permalink(get_the_ID()); ?> >
			<h3> <?php the_title(); ?> </h3> 
			<div> <?php echo get_the_date(); ?> </div>
		</a>
	</div> <br> <br>
<?php
//the_content();
endwhile;

get_footer();
?>
