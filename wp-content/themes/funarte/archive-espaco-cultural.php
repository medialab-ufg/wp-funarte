<?php
get_header();
?>
<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">
		<?php include('inc/template_parts/breadcrumb.php'); ?>

		<div class="box-title">
			<h2 class="title-h1">Funarte <span>Espaços Culturais</span></h2>

			<div class="box-forms">
				<form class="form-area" action="#" method="post">
					<fieldset>
						<legend>filtrar por local</legend>
						<select>
							<option value="">Filtrar por local</option>
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

	<?php if (have_posts()): ?>
	<div class="container">
		<section class="list-soft">
			<div class="row justify-content-between">
				<?php while (have_posts()): the_post(); ?>
					<div class="list-soft__item col-lg-5 color-funarte">
						<div class="list-soft__content">
							<?php
								$thumbnail = get_the_post_thumbnail( $post_id,'medium');
							?>

							<div class="list-soft__image <?php echo empty($thumbnail) ? 'no-image' : '' ?>">
								<div class="link-area">
									<strong><?php echo get_post_meta($post->ID, "espaco-estado", true); ?></strong>
								</div>
								<?php echo $thumbnail; ?>
							</div>

							<div class="list-soft__text">
								<h3 class="title-h5">
									<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
										<?php the_title(); ?>
									</a>
								</h3>

								<p><?php echo wp_trim_words(get_the_content(),50); ?></p>

								<a class="link-more" href="<?php the_permalink(); ?>">Leia mais</a>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</section>

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
	<?php endif;?>
</main>
<?php
get_footer();
?>
