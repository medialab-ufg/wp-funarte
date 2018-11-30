<?php
	get_header();
?>

<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">
		<?php
			$arg = ['items' => array(
				['img_url'	=> get_template_directory_uri() . '/assets/img/fke/carrossel_002.jpg',
				 'title'			=> 'titles', 
				 'descricao'	=> 'descricao'],

				['img_url'	=> get_template_directory_uri() . '/assets/img/fke/carrossel_001.jpg',
				 'title'			=> 'Coleção exemplo',
				 'descricao'	=> 'Título de item exemplo da coleção exemplo'],

				['img_url' =>  get_template_directory_uri() . '/assets/img/fke/carrossel_002.jpg',
				 'title'			=> 'Coleção exemplo 2',
				 'descricao' => 'Título de item exemplo da coleção exemploTítulo de item exemplo da coleção exemplo'],

				['img_url'	=>  get_template_directory_uri() . '/assets/img/fke/carrossel_003.jpg',
				 'title'			=> 'Coleção exemplo 3',
				 'descricao'	=> 'Título de item exemplo da coleção exemploTítulo de item exemplo da coleção exemploTítulo de item exemplo da coleção exemplo'],

				['img_url'	=>  get_template_directory_uri() . '/assets/img/fke/carrossel_004.jpg',
				 'title'			=> 'Coleção exemplo 4',
				 'descricao'	=> 'Título de item exemplo da coleção exemploTítulo de item exemplo da coleção exemploTítulo de item exemplo da coleção exemploTítulo de item exemplo da coleção exemplo']
			)];
			funarte_load_part('carousel-highlights', $arg);
		?>
	</div>

	<?php
		$items = [['tag_class_area'=>'danca', 'tag_name_area'=>'Dança',
							 'tag_subname_area'=>'Inscrições abertas', 'title' => 'Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do' ,
							 'url'=>'#'],
							 ['tag_class_area'=>'artes-integradas', 'tag_name_area'=>'Artes integradas',
							 'tag_subname_area'=>'Inscrições abertas', 'title' => 'Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do' ,
							 'url'=>'#'],
							 ['tag_class_area'=>'circo', 'tag_name_area'=>'Circo',
							 'tag_subname_area'=>'Inscrições abertas', 'title' => 'Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do' ,
							 'url'=>'#'],
							 ['tag_class_area'=>'multicategoria', 'tag_name_area'=>'Multicategoria',
							 'tag_subname_area'=>'Inscrições abertas', 'title' => 'Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do' ,
							 'url'=>'#'],
							 ['tag_class_area'=>'multicategoria', 'tag_name_area'=>'Multicategoria',
							 'tag_subname_area'=>'Inscrições abertas', 'title' => 'Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do' ,
							 'url'=>'#']
							];
		
		$arg = ['title'=> 'Editais', 'items' => $items,
						'destaque' => ['url'=> '#',
													 'title'=> '[TITULO]',
													 'tag_name_area'=>'Dança',
													 'tag_class_area'=>'danca',
													 'content'=>'[CONTEUTO DO DESTAQUE]',
													 'img_url'=> get_template_directory_uri() . '/assets/img/fke/destaque_001.jpg']
		];
		funarte_load_part('notices-highlights', $arg);
	?>

	<section class="box-news mb-100">
		<div class="container">
			<h2 class="title-1 mb-44">Notícias</h2>

			<!-- SÓ A PRIMEIRA UL VEM COM A CLASSE VISIBLE -->
			<ul class="box-news__list visible">
				<li class="color-artes-visuais">
					<div class="link-area">
						<a href="#">Artes visuais</a>
					</div>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_001.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="link-more">Ler mais</a>
				</li>
				<li class="color-danca">
					<div class="link-area">
						<a href="#">Dança</a>
					</div>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_002.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="link-more">Ler mais</a>
				</li>
				<li class="color-circo">
					<div class="link-area">
						<a href="#">Circo</a>
					</div>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="link-more">Ler mais</a>
				</li>
			</ul>
			<ul class="box-news__list">
				<li class="color-artes-visuais">
					<div class="link-area">
						<a href="#">Artes visuais</a>
					</div>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_001.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="link-more">Ler mais</a>
				</li>
				<li class="color-danca">
					<div class="link-area">
						<a href="#">Dança</a>
					</div>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_002.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="link-more">Ler mais</a>
				</li>
				<li class="color-circo">
					<div class="link-area">
						<a href="#">Circo</a>
					</div>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="link-more">Ler mais</a>
				</li>
			</ul>
			<ul class="box-news__list">
				<li class="color-artes-visuais">
					<div class="link-area">
						<a href="#">Artes visuais</a>
					</div>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_001.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="link-more">Ler mais</a>
				</li>
				<li class="color-danca">
					<div class="link-area">
						<a href="#">Dança</a>
					</div>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_002.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="link-more">Ler mais</a>
				</li>
				<li class="color-circo">
					<div class="link-area">
						<a href="#">Circo</a>
					</div>
					<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>" alt="Título lorem ipsum sit dolor...">
					<h3 class="news-title">Título lorem ipsum sit dolor...</h3>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</span>
					<a href="#" class="link-more">Ler mais</a>
				</li>
			</ul>

			<a href="#" class="box-news__load"><i class="mdi mdi-chevron-down"></i><i class="mdi mdi-plus"></i><span class="sr-only">Ver mais</span></a>
		</div>
	</section>

	<div class="container">
		<section class="box-carousel-schedule mb-100">
			<h2 class="title-1">Agenda Cultural</h2>

			<div class="carousel-schedule__wrapper">
				<div class="carousel-schedule__control">
					<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
					<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
				</div>
				<ul class="carousel-schedule">
					<li class="color-teatro">
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/agenda_001.jpg'; ?>" alt="Festival de música regional">
						<div class="carousel-schedule__body">
							<h3 class="title-2">Festival de música regional</h3>
							<span class="carousel-schedule__date">Set<strong>29</strong></span>
							<hr>
							<div class="carousel-schedule__row">
								<div class="carousel-schedule__column-1">
									<span class="carousel-schedule__time">das 13 às 17 horas</span>
									<span class="carousel-schedule__local">MediaLab/ UFG - R. Samambaia, S/N - Vila Itatiaia, Goiânia - GO, 74690-900</span>
								</div>
								<div class="carousel-schedule__column-2">
									<p>Lorem ipsum dolor sit amet, consecte-tur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation veniam, quis nostrud exercitation ullam-co laboris.grsuysdbhsidgs</p>
									<a href="#" class="link-more">Ler mais</a>
								</div>
							</div>
						</div>
					</li>
					<li class="color-musica active">
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/agenda_002.jpg'; ?>" alt="Festival de música regional">
						<div class="carousel-schedule__body">
							<h3 class="title-2">Festival de música regional</h3>
							<span class="carousel-schedule__date">Set<strong>30</strong></span>
							<hr>
							<div class="carousel-schedule__row">
								<div class="carousel-schedule__column-1">
									<span class="carousel-schedule__time">das 13 às 17 horas</span>
									<span class="carousel-schedule__local">MediaLab/ UFG - R. Samambaia, S/N - Vila Itatiaia, Goiânia - GO, 74690-900</span>
								</div>
								<div class="carousel-schedule__column-2">
									<p>Lorem ipsum dolor sit amet, consecte-tur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation veniam, quis nostrud exercitation ullam-co laboris.grsuysdbhsidgs</p>
									<a href="#" class="link-more">Ler mais</a>
								</div>
							</div>
						</div>
					</li>
					<li class="color-teatro">
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/agenda_001.jpg'; ?>" alt="Festival de música regional">
						<div class="carousel-schedule__body">
							<h3 class="title-2">Festival de música regional</h3>
							<span class="carousel-schedule__date">Set<strong>29</strong></span>
							<hr>
							<div class="carousel-schedule__row">
								<div class="carousel-schedule__column-1">
									<span class="carousel-schedule__time">das 13 às 17 horas</span>
									<span class="carousel-schedule__local">MediaLab/ UFG - R. Samambaia, S/N - Vila Itatiaia, Goiânia - GO, 74690-900</span>
								</div>
								<div class="carousel-schedule__column-2">
									<p>Lorem ipsum dolor sit amet, consecte-tur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation veniam, quis nostrud exercitation ullam-co laboris.grsuysdbhsidgs</p>
									<a href="#" class="link-more">Ler mais</a>
								</div>
							</div>
						</div>
					</li>
					<li class="color-musica">
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/agenda_002.jpg'; ?>" alt="Festival de música regional">
						<div class="carousel-schedule__body">
							<h3 class="title-2">Festival de música regional</h3>
							<span class="carousel-schedule__date">Set<strong>30</strong></span>
							<hr>
							<div class="carousel-schedule__row">
								<div class="carousel-schedule__column-1">
									<span class="carousel-schedule__time">das 13 às 17 horas</span>
									<span class="carousel-schedule__local">MediaLab/ UFG - R. Samambaia, S/N - Vila Itatiaia, Goiânia - GO, 74690-900</span>
								</div>
								<div class="carousel-schedule__column-2">
									<p>Lorem ipsum dolor sit amet, consecte-tur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation veniam, quis nostrud exercitation ullam-co laboris.grsuysdbhsidgs</p>
									<a href="#" class="link-more">Ler mais</a>
								</div>
							</div>
						</div>
					</li>
					<li class="color-teatro">
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/agenda_001.jpg'; ?>" alt="Festival de música regional">
						<div class="carousel-schedule__body">
							<h3 class="title-2">Festival de música regional</h3>
							<span class="carousel-schedule__date">Set<strong>29</strong></span>
							<hr>
							<div class="carousel-schedule__row">
								<div class="carousel-schedule__column-1">
									<span class="carousel-schedule__time">das 13 às 17 horas</span>
									<span class="carousel-schedule__local">MediaLab/ UFG - R. Samambaia, S/N - Vila Itatiaia, Goiânia - GO, 74690-900</span>
								</div>
								<div class="carousel-schedule__column-2">
									<p>Lorem ipsum dolor sit amet, consecte-tur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation veniam, quis nostrud exercitation ullam-co laboris.grsuysdbhsidgs</p>
									<a href="#" class="link-more">Ler mais</a>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</section>

		<section class="box-carousel-collection">
			<h2 class="title-1 mb-65">Acervo</h2>

			<div class="carousel-collection__wrapper">
				<div class="carousel-collection__control">
					<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
					<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
				</div>
				<ul class="carousel-collection">
					<li class="color-circo">
						<div class="link-area">
							<a href="#">Circo</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipisLorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_001.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipisLorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-literatura carousel-collection__reverse">
						<div class="link-area">
							<a href="#">Literatura</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_002.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-artes-visuais">
						<div class="link-area">
							<a href="#">Artes visuais</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_003.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-teatro carousel-collection__reverse">
						<div class="link-area">
							<a href="#">Teatro</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_004.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-circo">
						<div class="link-area">
							<a href="#">Circo</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipisLorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_001.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipisLorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-literatura carousel-collection__reverse">
						<div class="link-area">
							<a href="#">Literatura</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_002.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-artes-visuais">
						<div class="link-area">
							<a href="#">Artes visuais</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_003.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-teatro carousel-collection__reverse">
						<div class="link-area">
							<a href="#">Teatro</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_004.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-literatura carousel-collection__reverse">
						<div class="link-area">
							<a href="#">Literatura</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetuer adipis</p>
						<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/acervo_002.jpg'; ?>" alt="Lorem ipsum dolor sit amet, consectetuer adipis">
					</li>
					<li class="color-artes-visuais">
						<div class="link-area">
							<a href="#">Artes visuais</a>
						</div>
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