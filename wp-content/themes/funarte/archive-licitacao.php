<?php

$licitacao = \funarte\Licitacao::get_instance();
$modalidade = (isset($_GET['modalidade'])) ? $licitacao->get_modalidade_by_name($_GET['modalidade']) : false;
$ano = (isset($_GET['ano']) && (preg_match('/^\d{4}$/', (int)$_GET['ano']))) ? (int)$_GET['ano'] : date('Y');

$params = array(
	'post_type' => 'licitacao',
	'meta_key' => 'licitacao-ano',
	'meta_value' => $ano
);

if($modalidade) {
	$params = array_merge(array(\funarte\taxModalidade::get_instance()->get_name() => $modalidade->slug), $params);
}
query_posts($params);
get_header();
?>

<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">
		<?php include('inc/template_parts/breadcrumb.php'); ?>

		<div class="box-title">
			
			<?php if($modalidade) { ?>
				<h2 class="title-h1"><?php echo $modalidade->name; ?></h2>
			<?php } else { ?>
				<h2 class="title-h1">Funarte <span>Licitações</span></h2>
			<?php } ?>

			<div class="box-forms">
				<form class="form-ano form-select" action="#" method="post">
					<fieldset>
						<legend>Formulário de ano</legend>

						<select>
							<option value="">Ano</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
						</select>
					</fieldset>
				</form>

				<form class="form-categoria form-select" action="#" method="post">
					<fieldset>
						<legend>Formulário de categoria</legend>

						<select>
							<option value="">Categoria</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
						</select>
					</fieldset>
				</form>

				<form class="form-filtro" action="#" method="post">
					<fieldset>
						<legend>Formulário de filtro</legend>

						<div class="form-group">
							<label class="sr-only" for="filtro-texto">Pesquisar</label>
							<input type="text" id="filtro-texto" placeholder="Pesquisar">
							<button type="submit"><i class="mdi mdi-magnify"></i><span class="sr-only">Pesquisar</span></button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>

	<?php if (have_posts()): ?>
	<section class="box-tabs">
		<div class="container">
			<ul class="list-bidding">
				<?php while (have_posts()): the_post(); ?>
					<li>
						<?php 
							$categoria_modalidade = wp_get_object_terms($post->ID, \funarte\taxModalidade::get_instance()->get_name());
							if ($categoria_modalidade[0]->slug != "inexigibilidade" and $categoria_modalidade[0]->slug != "dispensa") {
								if(!$modalidade) {
									echo '<div class="link-area"><a class="color-funarte" href="#">' . $categoria_modalidade[0]->name . '</a></div>';
								}
							}
						?>

						<h3 class="title-h5">
							<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
								<?php the_title(); ?>
							</a>
						</h3>
						<p><?php echo wp_trim_words(get_the_content(),30); ?></p>
						<a class="link-more" href="<?php the_permalink(); ?>">Leia mais</a>
					</li>
				<?php endwhile; ?>
			</ul>

			<div class="box-pagination">
				<ul class="box-pagination__list">
					<li class="active"><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">6</a></li>
				</ul>
				<div class="box-pagination__control">
					<button type="button" class="control__previous"><i class="mdi mdi-chevron-left"></i></button>
					<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
				</div>
			</div>
		</div>
	</section>
	<?php endif;?>
</main>
<?php
get_footer();
?>
