<?php get_header(); ?>




<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container mb-100">
		<?php
			$links = [
				['link_name'=>'Acervo']];
			funarte_load_part('breadcrumb', ['links'=>$links]); 
		?>

		<div class="box-title">
			<h2 class="title-h1"><a href="<?php echo get_bloginfo('url') . '/collections'; ?>">Acervo</a> <!-- <span>Permanente</span> --></h2>
		</div>

		<?php funarte_load_part('collections-carousel', ['collections' => $wp_query]); ?>
	</div>
</main>



<?php get_footer(); ?>