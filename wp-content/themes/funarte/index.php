<?php
	get_header();
?>

<main role="main">
	<div class="container">
		<section class="highlights-carousel">
			<div class="highlights-carousel__control">
				<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
				<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
			</div>
			<ul>
				<li>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/carrossel_001.jpg'; ?>" alt="Coleção exemplo">
					<div class="highlights-carousel__caption">
						<strong>Coleção exemplo</strong>
						<span>Título de item exemplo da coleção exemplo</span>
					</div>
				</li>
				<li>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/carrossel_002.jpg'; ?>" alt="Coleção exemplo 2">
					<div class="highlights-carousel__caption">
						<strong>Coleção exemplo 2</strong>
						<span>Título de item exemplo da coleção exemploTítulo de item exemplo da coleção exemplo</span>
					</div>
				</li>
				<li>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/carrossel_003.jpg'; ?>" alt="Coleção exemplo 3">
					<div class="highlights-carousel__caption">
						<strong>Coleção exemplo 3</strong>
						<span>Título de item exemplo da coleção exemploTítulo de item exemplo da coleção exemploTítulo de item exemplo da coleção exemplo</span>
					</div>
				</li>
				<li>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/carrossel_004.jpg'; ?>" alt="Coleção exemplo 4">
					<div class="highlights-carousel__caption">
						<strong>Coleção exemplo 4</strong>
						<span>Título de item exemplo da coleção exemploTítulo de item exemplo da coleção exemploTítulo de item exemplo da coleção exemploTítulo de item exemplo da coleção exemplo</span>
					</div>
				</li>
			</ul>
		</section>
	</div>

	<div class="color-row mb-60">
		<div class="container">
			<div class="row">
				<div class="col-4">
					<h2 class="title-1">Editais</h2>
				</div>
				<div class="col-8">
					<h2 class="title-1">Destaque</h2>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<h2 class="title-1">Notícias</h2>
		<h2 class="title-1">Agenda Cultural</h2>
		<h2 class="title-1">Acervo</h2>
	</div>
</main>

<?php
	get_footer();
?>