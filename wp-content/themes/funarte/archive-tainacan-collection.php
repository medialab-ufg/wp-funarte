<?php get_header(); ?>




<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">
		<?php
			$links = [
				['link_name'=>'Acervo']];
			funarte_load_part('breadcrumb', ['links'=>$links]); 
		?>

		<h2 class="title-h1">Acervo</h2>
		<br />
		<?php funarte_load_part('collections-carousel', ['collections' => $wp_query]); ?>
	</div>
</main>



<?php get_footer(); ?>