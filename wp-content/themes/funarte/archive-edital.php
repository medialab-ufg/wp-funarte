<?php
if (!empty($_GET['area'])) {
	$area = get_category_by_name($_GET['area']);
	if (!empty($area))
		$cat = $area->term_id;
}

$params = array(
	's' => (isset($_GET['busca'])) ? $_GET['busca'] : '',
	'cat' => isset($cat) ? $cat : null,
	'paged' => get_query_var('paged') ? get_query_var('paged') : 1
);

$status = (isset($_GET['status']) && !empty($_GET['status'])) ? $_GET['status'] : 'todos';
$edital = \funarte\Edital::get_instance();
$editais = $edital->get_editais($status, $params);
$area = get_category((int)$params['cat']);

get_header();
?>
<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">
		<?php include('inc/template_parts/breadcrumb.php'); ?>

		<div class="box-title">
			<h2 class="title-h1">Editais</h2>

			<div class="box-forms">
				<form class="form-area" action="#" method="post">
					<fieldset>
						<legend>Formulário de seleção de área</legend>

						<select>
							<option value="">Filtrar por área</option>
							<option value="Artes integradas">Artes integradas</option>
							<option value="Artes visuais">Artes visuais</option>
							<option value="Circo">Circo</option>
							<option value="Dança">Dança</option>
							<option value="Literatura">Literatura</option>
							<option value="Música">Música</option>
							<option value="Teatro">Teatro</option>
						</select>
					</fieldset>
				</form>

				<form class="form-filtro-editais" action="#" method="post">
					<fieldset>
						<legend>Formulário de filtro de editais</legend>

						<div class="form-group">
							<label class="sr-only" for="filtro-editais-texto">Pesquisar editais</label>
							<input type="text" id="filtro-editais-texto" placeholder="Pesquisar editais">
							<button type="submit"><i class="mdi mdi-magnify"></i><span class="sr-only">Pesquisar</span></button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>

		<?php
		if (!empty($editais) && have_posts()):
		?>
			<section class="box-tabs">
				<div class="list-tabs">
					<div class="container">
						<ul>
							<li class="active"><a href="#">Todos</a></li>
							<li><a href="#">Inscrições abertas</a></li>
							<li><a href="#">Em avaliação</a></li>
							<li><a href="#">Resultados</a></li>
						</ul>
					</div>
				</div>
				<div class="content-tab">
					<div class="container">
						<ul class="list-notices"><?php while (have_posts()): the_post(); ?>
							<li class="color-<?php echo get_the_category()[0]->slug; ?>">
								<!-- <h6><?php echo $edital->get_edital_status_name($post->ID); ?></h6> -->

								<div class="list-notices-image">
									<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/espaco_002.jpg'; ?>" alt="<?php the_title(); ?>">
								</div>

								<div class="list-notices-text">
									<?php
										$areas = get_the_category();
										if (!empty($areas)): ?>
										<div class="link-area">
											<?php foreach ($areas as $area): ?>
												<a class="<?php echo 'color-' . $area->category_nicename; ?>" href="#"><?php echo $area->name; ?></a>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>

									<h3 class="title-h5">
										<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
											<?php the_title(); ?>
										</a>
									</h3>

									<p><?php echo wp_trim_words(get_the_content(),50); ?></p>

									<a class="link-more" href="<?php the_permalink(); ?>">Leia mais</a>
								</div>
							</li>
						<?php endwhile; ?></ul>
						<?php echo get_pagination(); ?>
					</div>
				</div>
			</section>
		<?php 
		endif;
		?>

	</div>
</main>

<?php
get_footer();
?>
