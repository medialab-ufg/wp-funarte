<?php
get_header(); the_post();
?>
<main role="main">
	<div class="container">

		<?php
			$links = [['link_name'=>get_the_title()]];
			funarte_load_part('breadcrumb', ['links'=>$links]); 
		?>

		<div class="box-title">
			<h2 class="title-h1"><?php the_title(); ?></h2>
		</div>
		<?php
			if(has_post_thumbnail()) {
				post_thumbnail(get_the_ID(), array('width' => 380, 'height' => 280));
			}
			the_content();
		?>
	</div>
</main>
	
<?php get_footer(); ?>