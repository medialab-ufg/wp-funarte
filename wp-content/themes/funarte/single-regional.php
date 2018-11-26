<?php
get_header();

$fields = array('coordenador', 'rua', 'numero', 'complemento', 'fax', 'email',
				'bairro', 'cidade', 'cep', 'telefone1', 'telefone2', 'contatos');

foreach ($fields as $field) {
	${$field} = get_post_meta(get_the_ID(), "regional-{$field}", true);
}
if(have_posts()) : the_post();
?>

<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">
		<?php include('inc/template_parts/breadcrumb.php'); ?>

		<div class="box-title">
			<h2 class="title-h1">
				<a href="<?php echo get_bloginfo('url') . '/regional'; ?>">
					Representações Regionais
				</a> 
			</h2>
		</div>

		<div class="box-title-page color-artes-visuais">
			<h3 class="title-page"><?php the_title(); ?></h3>
			<?php post_thumbnail(get_the_ID(), array('width' => 380, 'height' => null)); ?>
		</div>

		<div>
			<div class="box-text">
				<div class="box-text__date">
					<small>Publicado em <?php the_time(get_option('date_format')); ?></small>
				</div>
				<div class="box-text__text">
					<div class="box-text__image">
						<?php get_the_post_thumbnail(get_the_ID(), array('width' => 380, 'height' => null, 'after' => '<hr />')); ?>
					</div>
					<h3>sobre</h3>
					<?php  the_content(); ?>
				</div>
			</div>
		</div>

	</div>
</main>

<?php
endif;
get_footer();
?>
