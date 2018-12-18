<?php get_header(); ?>




<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container mb-100">
		<div class="box-title">
			<h2 class="title-h1">Acervo <span><?php tainacan_the_term_name(); ?></span></h2>
		</div>

		<?php tainacan_the_faceted_search(); ?>
	</div>
</main>



<?php get_footer(); ?>