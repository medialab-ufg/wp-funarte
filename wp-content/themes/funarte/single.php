<?php
	get_header();
?>
<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">
		<?php include('inc/template_parts/breadcrumb.php'); ?>

		<div class="box-title">
			<h2 class="title-h1"><a href="<?php echo get_bloginfo('url') . '/noticias'; ?>">Notícias</a> <a href="#"><span>Recentes</span></a> </h2>
		</div>
	</div>
</main>

<?php
	get_footer();
?>