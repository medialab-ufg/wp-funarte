<?php
get_header();
?>

<main role="main">
	<div class="container">
		<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>

		<div class="box-title">
			<h2 class="title-h1 mb-50">Notícias<span>Mídias</span></h2>

			<div class="box-forms">
				<form class="form-area" action="#" method="get">
					<fieldset>
						<legend>Formulário de seleção de área</legend>

						<select name="area" id="select-categoria" class="select_area">
							<option value="" selected="selected">Filtrar por área</option>
							<option class="level-0" value="funarte">Funarte</option>
							<option class="level-0" value="artes-integradas">Artes Integradas</option>
							<option class="level-0" value="artes-visuais">Artes Visuais</option>
							<option class="level-0" value="circo">Circo</option>
							<option class="level-0" value="danca">Dança</option>
							<option class="level-0" value="literatura">Literatura</option>
							<option class="level-0" value="musica">Música</option>
							<option class="level-0" value="teatro">Teatro</option>
							<option class="level-0" value="estudio-f">Estúdio F</option>
						</select>
					</fieldset>
				</form>
			</div>
		</div>

		<div class="box-carousels-news">
			<div class="box-carousel-audio">
				<div class="box-carousel-audio__control">
					<button type="button" class="control__prev slick-arrow"><i class="mdi mdi-chevron-up"></i></button>
					<button type="button" class="control__next slick-arrow"><i class="mdi mdi-chevron-down"></i></button>
				</div>

				<ul class="carousel-audio">
					<li>
						<div class="box-carousel-audio__row-1">
							<div class="box-carousel-audio__image" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/img/fke/audio_001.jpg' ?>);"></div>
							<div class="box-carousel-audio__info">
								<div class="link-area">
									<a class="color-funarte" href="#">Podcast</a>
								</div>
								<strong>Lorem ipsum dolor sit amet, consectetuer adi</strong>

								<div class="audio-player">
									<ul class="playlist">
										<li><a href="<?php echo get_template_directory_uri() . '/assets/audio/sound.mp3' ?>);"></a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="box-carousel-audio__row-2">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incidi-dunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercita-tion ullamco laboris.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.  ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in</p>
							<a class="link-more" href="#">Ler mais</a>
						</div>
					</li>
					<li>
						<div class="box-carousel-audio__row-1">
							<div class="box-carousel-audio__image" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/img/fke/audio_001.jpg' ?>);"></div>
							<div class="box-carousel-audio__info">
								<div class="link-area">
									<a class="color-funarte" href="#">Podcast</a>
								</div>
								<strong>2 Lorem ipsum dolor sit amet, consectetuer adi</strong>

								<div class="audio-player">
									<ul class="playlist">
										<li><a href="<?php echo get_template_directory_uri() . '/assets/audio/sound.mp3' ?>);"></a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="box-carousel-audio__row-2">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incidi-dunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercita-tion ullamco laboris.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.  ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in</p>
							<a class="link-more" href="#">Ler mais</a>
						</div>
					</li>
					<li>
						<div class="box-carousel-audio__row-1">
							<div class="box-carousel-audio__image" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/img/fke/audio_001.jpg' ?>);"></div>
							<div class="box-carousel-audio__info">
								<div class="link-area">
									<a class="color-funarte" href="#">Podcast</a>
								</div>
								<strong>3 Lorem ipsum dolor sit amet, consectetuer adi</strong>

								<div class="audio-player">
									<ul class="playlist">
										<li><a href="<?php echo get_template_directory_uri() . '/assets/audio/sound.mp3' ?>);"></a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="box-carousel-audio__row-2">
							<p>Lorem ipsum dolor sit amet</p>
							<a class="link-more" href="#">Ler mais</a>
						</div>
					</li>
					<li>
						<div class="box-carousel-audio__row-1">
							<div class="box-carousel-audio__image" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/img/fke/audio_001.jpg' ?>);"></div>
							<div class="box-carousel-audio__info">
								<div class="link-area">
									<a class="color-funarte" href="#">Podcast</a>
								</div>
								<strong>4 Lorem ipsum dolor sit amet, consectetuer adi</strong>

								<div class="audio-player">
									<ul class="playlist">
										<li><a href="<?php echo get_template_directory_uri() . '/assets/audio/sound.mp3' ?>);"></a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="box-carousel-audio__row-2">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incidi-dunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercita-tion ullamco laboris.Lorem ipsum dolor sit</p>
							<a class="link-more" href="#">Ler mais</a>
						</div>
					</li>
				</ul>
			</div>

			<div class="box-bidding box-bidding--type-b">
				<div class="carousel-bidding--type-b__control">
					<button type="button" class="control__prev slick-arrow"><i class="mdi mdi-chevron-up"></i></button>
					<button type="button" class="control__next slick-arrow"><i class="mdi mdi-chevron-down"></i></button>
				</div>

				<ul class="list-bidding--type-b box-bidding--type-b__carousel">
					<li class="color-funarte">
						<div class="link-area">
							<a href="#">Facebook</a>
						</div>
						<strong>Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do</strong>
						<a class="link-more" href="#">Ler mais</a>
					</li>
					<li class="color-funarte">
						<div class="link-area">
							<a href="#">Twitter</a>
						</div>
						<strong>Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do</strong>
						<a class="link-more" href="#">Ler mais</a>
					</li>
					<li class="color-funarte">
						<div class="link-area">
							<a href="#">Facebook</a>
						</div>
						<strong>Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do</strong>
						<a class="link-more" href="#">Ler mais</a>
					</li>
					<li class="color-funarte">
						<div class="link-area">
							<a href="#">Facebook</a>
						</div>
						<strong>Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do</strong>
						<a class="link-more" href="#">Ler mais</a>
					</li>
					<li class="color-funarte">
						<div class="link-area">
							<a href="#">Twitter</a>
						</div>
						<strong>Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do</strong>
						<a class="link-more" href="#">Ler mais</a>
					</li>
					<li class="color-funarte">
						<div class="link-area">
							<a href="#">Facebook</a>
						</div>
						<strong>Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do</strong>
						<a class="link-more" href="#">Ler mais</a>
					</li>
					<li class="color-funarte">
						<div class="link-area">
							<a href="#">Facebook</a>
						</div>
						<strong>Título lorem ipsum sit dolor amet, con-sectetur adispicing elit, sed do</strong>
						<a class="link-more" href="#">Ler mais</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="box-social-media">
			<div class="box-social-media__box-twitter">
				<div class="box-social-media__box-scroll color-funarte">
					<div class="link-area">
						<strong class="color-funarte">Twitter</strong>
					</div>
					<a class="twitter-timeline" data-theme="light" href="https://twitter.com/Funarte?ref_src=twsrc%5Etfw">Tweets by Funarte</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
				</div>
			</div>

			<div class="box-social-media__box-facebook">
				<div class="box-social-media__box-scroll color-funarte">
					<div class="link-area">
						<strong class="color-funarte">Facebook</strong>
					</div>
					<div id="fb-root"></div>
					<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.2"></script>
					<div class="fb-page" data-href="https://www.facebook.com/funarte" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
						<blockquote cite="https://www.facebook.com/funarte" class="fb-xfbml-parse-ignore">
							<a href="https://www.facebook.com/funarte">Funarte</a>
						</blockquote>
					</div>
				</div>
			</div>

			<div class="box-social-media__box-instagram">
				<div id="instagram-feed" class="box-social-media__box-scroll color-funarte">
					<div class="link-area">
						<strong class="color-funarte">Instagram</strong>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
?>