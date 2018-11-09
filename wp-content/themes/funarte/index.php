<?php
	get_header();
?>

<main role="main">
	<div class="container">
		<section class="carousel-highlights">
			<div class="carousel-highlights__control">
				<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
				<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
			</div>
			<ul>
				<li>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/carrossel_001.jpg'; ?>" alt="Coleção exemplo">
					<div class="carousel-highlights__caption">
						<strong>Coleção exemplo</strong>
						<span>Título de item exemplo da coleção exemplo</span>
					</div>
				</li>
				<li>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/carrossel_002.jpg'; ?>" alt="Coleção exemplo 2">
					<div class="carousel-highlights__caption">
						<strong>Coleção exemplo 2</strong>
						<span>Título de item exemplo da coleção exemploTítulo de item exemplo da coleção exemplo</span>
					</div>
				</li>
				<li>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/carrossel_003.jpg'; ?>" alt="Coleção exemplo 3">
					<div class="carousel-highlights__caption">
						<strong>Coleção exemplo 3</strong>
						<span>Título de item exemplo da coleção exemploTítulo de item exemplo da coleção exemploTítulo de item exemplo da coleção exemplo</span>
					</div>
				</li>
				<li>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/carrossel_004.jpg'; ?>" alt="Coleção exemplo 4">
					<div class="carousel-highlights__caption">
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

	<section class="box-news mb-100">
		<div class="container">
			<h2 class="title-1 mb-44">Notícias</h2>

			<!-- SÓ A PRIMEIRA UL VEM COM A CLASSE VISIBLE -->
			<ul class="visible">
				<li class="color-artes-visuais">
					<a href="#" class="link-area">Artes visuais</a>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_001.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="box-news__more">Ler mais</a>
				</li>
				<li class="color-danca">
					<a href="#" class="link-area">Dança</a>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_002.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="box-news__more">Ler mais</a>
				</li>
				<li class="color-circo">
					<a href="#" class="link-area">Circo</a>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="box-news__more">Ler mais</a>
				</li>
			</ul>
			<ul>
				<li class="color-artes-visuais">
					<a href="#" class="link-area">Artes visuais</a>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_001.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="box-news__more">Ler mais</a>
				</li>
				<li class="color-danca">
					<a href="#" class="link-area">Dança</a>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_002.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="box-news__more">Ler mais</a>
				</li>
				<li class="color-circo">
					<a href="#" class="link-area">Circo</a>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="box-news__more">Ler mais</a>
				</li>
			</ul>
			<ul>
				<li class="color-artes-visuais">
					<a href="#" class="link-area">Artes visuais</a>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_001.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="box-news__more">Ler mais</a>
				</li>
				<li class="color-danca">
					<a href="#" class="link-area">Dança</a>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_002.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="box-news__more">Ler mais</a>
				</li>
				<li class="color-circo">
					<a href="#" class="link-area">Circo</a>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="box-news__more">Ler mais</a>
				</li>
			</ul>

			<a href="#" class="box-news__load"><i class="mdi mdi-chevron-down"></i><i class="mdi mdi-plus"></i><span class="sr-only">Ver mais</span></a>
		</div>
	</section>

	<div class="container">
		<section class="carousel-schedule mb-100">
			<h2 class="title-1">Agenda Cultural</h2>

			<div class="carousel-schedule__wrapper">
				<div class="carousel-schedule__control">
					<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
					<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
				</div>
				<ul>
					<li class="color-teatro">
						<h3 class="title-2">Festival de música regional</h3>
						<span class="carousel-schedule__date">Set<strong>29</strong></span>
						<hr>
						<span class="carousel-schedule__time">das 13 às 17 horas</span>
						<span class="carousel-schedule__local">MediaLab/ UFG - R. Samambaia, S/N - Vila Itatiaia, Goiânia - GO, 74690-900</span>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/agenda_001.jpg'; ?>" alt="Festival de música regional">
						<p>Lorem ipsum dolor sit amet, consecte-tur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation veniam, quis nostrud exercitation ullam-co laboris.grsuysdbhsidgs</p>
						<a href="#" class="carousel-schedule__more">Ler mais</a>
					</li>
					<li class="color-musica">
						<h3 class="title-2">Festival de música regional</h3>
						<span class="carousel-schedule__date">Set<strong>30</strong></span>
						<hr>
						<span class="carousel-schedule__time">das 13 às 17 horas</span>
						<span class="carousel-schedule__local">MediaLab/ UFG - R. Samambaia, S/N - Vila Itatiaia, Goiânia - GO, 74690-900</span>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/agenda_002.jpg'; ?>" alt="Festival de música regional">
						<p>Lorem ipsum dolor sit amet, consecte-tur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation veniam, quis nostrud exercitation ullam-co laboris.grsuysdbhsidgs</p>
						<a href="#" class="carousel-schedule__more">Ler mais</a>
					</li>
				</ul>
			</div>
		</section>

		<section class="carousel-collection mb-100">
			<h2 class="title-1 mb-65">Acervo</h2>

			<div class="carousel-collection__wrapper">
				<div class="carousel-collection__control">
					<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
					<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
				</div>
				<ul>
					<li class="color-circo">
						<a href="#" class="link-area">Circo</a>
						<p>Lorem ipsum dolor sit amet, consectetuer adipisLorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_001.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipisLorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-literatura carousel-collection__reverse">
						<a href="#" class="link-area">Literatura</a>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_002.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-artes-visuais">
						<a href="#" class="link-area">Artes visuais</a>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_003.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-teatro carousel-collection__reverse">
						<a href="#" class="link-area">Teatro</a>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_004.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-circo">
						<a href="#" class="link-area">Circo</a>
						<p>Lorem ipsum dolor sit amet, consectetuer adipisLorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_001.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipisLorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-literatura carousel-collection__reverse">
						<a href="#" class="link-area">Literatura</a>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_002.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-artes-visuais">
						<a href="#" class="link-area">Artes visuais</a>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_003.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-teatro carousel-collection__reverse">
						<a href="#" class="link-area">Teatro</a>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_004.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-literatura carousel-collection__reverse">
						<a href="#" class="link-area">Literatura</a>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_002.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-artes-visuais">
						<a href="#" class="link-area">Artes visuais</a>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_003.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
				</ul>
			</div>
		</section>
	</div>
</main>

<?php
	get_footer();
?>