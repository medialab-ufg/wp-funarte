<?php get_header(); ?>

<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>

	<div class="container">
		<div class="box-breadcrumb">
			<a class="box-breadcrumb__home" href="/"><i class="mdi mdi-home"></i></a>
			<a href="/evento">Agenda cultural</a>
		</div>

		<div class="box-title">
			<h2 class="title-h1">Agenda cultural <span>Eventos do dia</span></h2>
		</div>

		<div class="datepicker-box mb-100">
			<div class="box-calendario-sidebar">
				<div class="datepicker-compacto"></div>

				<form class="form-filtro-calendario" action="#" method="post">
					<fieldset>
						<legend>Formulário de filtro para o calendário</legend>

						<select>
							<option value="">Todos os locais</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
						</select>
					</fieldset>
				</form>

				<form class="form-filtro-calendario" action="#" method="post">
					<fieldset>
						<legend>Formulário de filtro para o calendário</legend>

						<select>
							<option value="">Filtrar por área</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
						</select>
					</fieldset>
				</form>

				<form class="form-filtro-calendario" action="#" method="post">
					<fieldset>
						<legend>Formulário de filtro para o calendário</legend>

						<select>
							<option value="">Todos os eventos</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
						</select>
					</fieldset>
				</form>

				<form class="form-filtro-calendario form-filtro-calendario--datepicker" action="#" method="post">
					<fieldset>
						<legend>Formulário de filtro para o calendário</legend>

						<input type="text" class="datepicker-compacto datepicker-field">
					</fieldset>
				</form>
			</div>

			<div class="box-calendario-main">
				<div class="carousel-highlights__control">
					<button type="button" class="control__next slick-arrow"><i class="mdi mdi-chevron-right"></i></button>
					<button type="button" class="control__prev slick-arrow"><i class="mdi mdi-chevron-left"></i></button>
				</div>

				<div class="box-calendario">
					<ul class="calendario-carousel">
						<li class="color-teatro">
							<h3 class="box-calendario__data" data-inicial="27/01/2019" data-final="10/02/2019">27/JAN - 10/FEV</h3>

							<h4 class="box-calendario__titulo">Festival de<br>música regional</h4>
							<hr>

							<div class="box-calendario__imagem" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/img/fke/agenda_001.jpg' ?>);">
								<div class="link-area">
									<a href="#">Teatro</a>
								</div>
							</div>

							<div class="box-calendario__linha">
								<div class="box-calendario__coluna-1">
									<span class="box-calendario__time">das 13 às 17 horas</span>
									<span class="box-calendario__pin">MediaLab/ UFG - R. Samambaia,<br>S/N - Vila Itatiaia, Goiânia - GO,<br>74690-900</span>
								</div>
								<div class="box-calendario__coluna-2">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation veniam, quis nostrud laboris.grsuysdbhsidgs</p>
									<a class="link-more" href="#">Ler mais</a>
								</div>
							</div>
						</li>
						<li class="color-danca">
							<h3 class="box-calendario__data" data-inicial="27/01/2019" data-final="07/02/2019">27/JAN - 07/FEV</h3>

							<h4 class="box-calendario__titulo">Festival de<br>música regional</h4>
							<hr>

							<div class="box-calendario__imagem">
								<div class="link-area">
									<a href="#">Dança</a>
								</div>
								<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/agenda_001.jpg' ?>" alt="Imagem">
							</div>

							<div class="box-calendario__linha">
								<div class="box-calendario__coluna-1">
									<span class="box-calendario__time">das 13 às 17 horas</span>
									<span class="box-calendario__pin">MediaLab/ UFG - R. Samambaia,<br>S/N - Vila Itatiaia, Goiânia - GO,<br>74690-900</span>
								</div>
								<div class="box-calendario__coluna-2">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation veniam, quis nostrud laboris.grsuysdbhsidgs</p>
									<a class="link-more" href="#">Ler mais</a>
								</div>
							</div>
						</li>
						<li class="color-circo">
							<h3 class="box-calendario__data" data-inicial="27/01/2019" data-final="30/01/2019">27/JAN - 30/JAN</h3>

							<h4 class="box-calendario__titulo">Festival de<br>música regional</h4>
							<hr>

							<div class="box-calendario__imagem">
								<div class="link-area">
									<a href="#">Circo</a>
								</div>
								<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/agenda_001.jpg' ?>" alt="Imagem">
							</div>

							<div class="box-calendario__linha">
								<div class="box-calendario__coluna-1">
									<span class="box-calendario__time">das 13 às 17 horas</span>
									<span class="box-calendario__pin">MediaLab/ UFG - R. Samambaia,<br>S/N - Vila Itatiaia, Goiânia - GO,<br>74690-900</span>
								</div>
								<div class="box-calendario__coluna-2">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation veniam, quis nostrud laboris.grsuysdbhsidgs</p>
									<a class="link-more" href="#">Ler mais</a>
								</div>
							</div>
						</li>
						<li class="color-artes-visuais">
							<h3 class="box-calendario__data" data-inicial="27/01/2019" data-final="28/01/2019">27/JAN - 28/JAN</h3>

							<h4 class="box-calendario__titulo">Festival de<br>música regional</h4>
							<hr>

							<div class="box-calendario__imagem">
								<div class="link-area">
									<a href="#">Artes Visuais</a>
								</div>
								<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/agenda_001.jpg' ?>" alt="Imagem">
							</div>

							<div class="box-calendario__linha">
								<div class="box-calendario__coluna-1">
									<span class="box-calendario__time">das 13 às 17 horas</span>
									<span class="box-calendario__pin">MediaLab/ UFG - R. Samambaia,<br>S/N - Vila Itatiaia, Goiânia - GO,<br>74690-900</span>
								</div>
								<div class="box-calendario__coluna-2">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation veniam, quis nostrud laboris.grsuysdbhsidgs</p>
									<a class="link-more" href="#">Ler mais</a>
								</div>
							</div>
						</li>
						<li class="color-artes-integradas">
							<h3 class="box-calendario__data" data-inicial="27/01/2019" data-final="29/01/2019">27/JAN - 29/JAN</h3>

							<h4 class="box-calendario__titulo">Festival de<br>música regional</h4>
							<hr>

							<div class="box-calendario__imagem">
								<div class="link-area">
									<a href="#">Artes Integradas</a>
								</div>
								<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/agenda_001.jpg' ?>" alt="Imagem">
							</div>

							<div class="box-calendario__linha">
								<div class="box-calendario__coluna-1">
									<span class="box-calendario__time">das 13 às 17 horas</span>
									<span class="box-calendario__pin">MediaLab/ UFG - R. Samambaia,<br>S/N - Vila Itatiaia, Goiânia - GO,<br>74690-900</span>
								</div>
								<div class="box-calendario__coluna-2">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation veniam, quis nostrud laboris.grsuysdbhsidgs</p>
									<a class="link-more" href="#">Ler mais</a>
								</div>
							</div>
						</li>
						<li class="color-musica">
							<h3 class="box-calendario__data" data-inicial="27/01/2019" data-final="31/01/2019">27/JAN - 31/JAN</h3>

							<h4 class="box-calendario__titulo">Festival de<br>música regional</h4>
							<hr>

							<div class="box-calendario__imagem">
								<div class="link-area">
									<a href="#">Música</a>
								</div>
								<img src="<?php echo get_template_directory_uri() . '/assets/img/fke/agenda_001.jpg' ?>" alt="Imagem">
							</div>

							<div class="box-calendario__linha">
								<div class="box-calendario__coluna-1">
									<span class="box-calendario__time">das 13 às 17 horas</span>
									<span class="box-calendario__pin">MediaLab/ UFG - R. Samambaia,<br>S/N - Vila Itatiaia, Goiânia - GO,<br>74690-900</span>
								</div>
								<div class="box-calendario__coluna-2">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation veniam, quis nostrud laboris.grsuysdbhsidgs</p>
									<a class="link-more" href="#">Ler mais</a>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="box-title">
			<h2 class="title-h1">Agenda cultural <span>Calendário</span></h2>
		</div>

		<div class="carousel-calendar-box mb-100">
			<div class="row">
				<div class="col-md-2">
					<form class="form-filtro-calendario" action="#" method="post">
						<fieldset>
							<legend>Formulário de filtro para o calendário</legend>

							<select>
								<option value="">Todos os eventos</option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
							</select>
						</fieldset>
					</form>
				</div>
				<div class="col-md-2">
					<form class="form-filtro-calendario" action="#" method="post">
						<fieldset>
							<legend>Formulário de filtro para o calendário</legend>

							<select>
								<option value="">Todos os locais</option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
							</select>
						</fieldset>
					</form>
				</div>
				<div class="col-md-2">
					<form class="form-filtro-calendario" action="#" method="post">
						<fieldset>
							<legend>Formulário de filtro para o calendário</legend>

							<select>
								<option value="">Filtrar por área</option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
							</select>
						</fieldset>
					</form>
				</div>
				<div class="col-md-2">
					<form class="form-filtro-calendario" action="#" method="post">
						<fieldset>
							<legend>Formulário de filtro para o calendário</legend>

							<input type="text" class="datepicker datepicker-field">
						</fieldset>
					</form>
				</div>
			</div>

			<div class="carousel-calendar__wrapper">
				<div class="box-calendar__control">
					<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
					<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
				</div>
				<ul class="carousel-calendar">
					<li>
						<div class="carousel-calendar__button">
							<button type="text">SEG<br>03/08</button>
						</div>

						<div class="carousel-calendar__event color-teatro">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>

						<div class="carousel-calendar__event color-circo">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>
					</li>
					<li>
						<div class="carousel-calendar__button">
							<button type="text">TER<br>04/08</button>
						</div>

						<div class="carousel-calendar__event color-artes-visuais">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>
					</li>
					<li>
						<div class="carousel-calendar__button">
							<button type="text">QUA<br>05/08</button>
						</div>

						<div class="carousel-calendar__event color-danca">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>

						<div class="carousel-calendar__event color-artes-integradas">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>

						<div class="carousel-calendar__event color-artes-visuais">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>
					</li>
					<li>
						<div class="carousel-calendar__button">
							<button type="text">QUI<br>06/08</button>
						</div>

						<div class="carousel-calendar__event color-musica">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>

						<div class="carousel-calendar__event color-circo">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>
					</li>
					<li>
						<div class="carousel-calendar__button">
							<button type="text">SEX<br>07/08</button>
						</div>

						<div class="carousel-calendar__event color-artes-visuais">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>

						<div class="carousel-calendar__event color-danca">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>
					</li>
					<li>
						<div class="carousel-calendar__button">
							<button type="text">SAB<br>08/08</button>
						</div>

						<div class="carousel-calendar__event color-teatro">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>

						<div class="carousel-calendar__event color-circo">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>
					</li>
					<li>
						<div class="carousel-calendar__button">
							<button type="text">DOM<br>09/08</button>
						</div>

						<div class="carousel-calendar__event color-artes-visuais">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>
					</li>
					<li>
						<div class="carousel-calendar__button">
							<button type="text">SEG<br>10/08</button>
						</div>

						<div class="carousel-calendar__event color-danca">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>

						<div class="carousel-calendar__event color-artes-integradas">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>

						<div class="carousel-calendar__event color-artes-visuais">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>
					</li>
					<li>
						<div class="carousel-calendar__button">
							<button type="text">TER<br>11/08</button>
						</div>

						<div class="carousel-calendar__event color-musica">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>

						<div class="carousel-calendar__event color-circo">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>
					</li>
					<li>
						<div class="carousel-calendar__button">
							<button type="text">QUA<br>12/08</button>
						</div>

						<div class="carousel-calendar__event color-artes-visuais">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>

						<div class="carousel-calendar__event color-danca">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>
					</li>
					<li>
						<div class="carousel-calendar__button">
							<button type="text">QUI<br>13/08</button>
						</div>

						<div class="carousel-calendar__event color-teatro">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>

						<div class="carousel-calendar__event color-circo">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>
					</li>
					<li>
						<div class="carousel-calendar__button">
							<button type="text">SEX<br>14/08</button>
						</div>

						<div class="carousel-calendar__event color-artes-visuais">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>
					</li>
					<li>
						<div class="carousel-calendar__button">
							<button type="text">SAB<br>15/08</button>
						</div>

						<div class="carousel-calendar__event color-danca">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>

						<div class="carousel-calendar__event color-artes-integradas">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>

						<div class="carousel-calendar__event color-artes-visuais">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>
					</li>
					<li>
						<div class="carousel-calendar__button">
							<button type="text">DOM<br>16/08</button>
						</div>

						<div class="carousel-calendar__event color-musica">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>

						<div class="carousel-calendar__event color-circo">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>
					</li>
					<li>
						<div class="carousel-calendar__button">
							<button type="text">SEG<br>17/08</button>
						</div>

						<div class="carousel-calendar__event color-artes-visuais">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>

						<div class="carousel-calendar__event color-danca">
							<strong>FESTIVAL DE MÚSICA REGIONAL</strong>
							<span class="carousel-calendar__pin">Goiânia - GO</span>
							<span class="carousel-calendar__time">das 13 às 17 horas</span>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</main>
<!--



<?php 
$categoria = (isset($_GET['area']) && ($_GET['area'] != 'Todas as áreas')) ? get_category_by_name($_GET['area']) : false;
$mes = (isset($_GET['mes'])) ? (int)$_GET['mes'] : date('n');
$ano = (isset($_GET['ano'])) ? (int)$_GET['ano'] : date('Y');

$estudiof = get_category_by_name('Estúdio F');
wp_dropdown_categories(array(
	'show_option_none' => 'Todas as áreas',
	'hide_empty' => false,
	'exclude' => array($estudiof->term_id),
	'id' => 'select-categoria',
	'name' => 'area',
	'selected' => ($categoria) ? $categoria->term_id : null)
);
?>

	<input type="hidden" name="ano" value="<?php echo $ano; ?>" />
	<select id="select-mes" name="mes">
		<option value="" <?php if(empty($mes)) { echo 'selected="selected"'; }?>>Todos os meses</option>
		<option value="1" <?php if($mes == 1) { echo 'selected="selected"'; }?>>Janeiro</option>
		<option value="2" <?php if($mes == 2) { echo 'selected="selected"'; }?>>Fevereiro</option>
		<option value="3" <?php if($mes == 3) { echo 'selected="selected"'; }?>>Março</option>
		<option value="4" <?php if($mes == 4) { echo 'selected="selected"'; }?>>Abril</option>
		<option value="5" <?php if($mes == 5) { echo 'selected="selected"'; }?>>Maio</option>
		<option value="6" <?php if($mes == 6) { echo 'selected="selected"'; }?>>Junho</option>
		<option value="7" <?php if($mes == 7) { echo 'selected="selected"'; }?>>Julho</option>
		<option value="8" <?php if($mes == 8) { echo 'selected="selected"'; }?>>Agosto</option>
		<option value="9" <?php if($mes == 9) { echo 'selected="selected"'; }?>>Setembro</option>
		<option value="10" <?php if($mes == 10) { echo 'selected="selected"'; }?>>Outubro</option>
		<option value="11" <?php if($mes == 11) { echo 'selected="selected"'; }?>>Novembro</option>
		<option value="12" <?php if($mes == 12) { echo 'selected="selected"'; }?>>Dezembro</option>						
	</select>

<?php while (have_posts()): the_post(); ?>
	<div>
		<a href=<?php echo get_post_permalink(get_the_ID()); ?> >
			<h3> <?php the_title(); ?> </h3> 
			<div> <?php echo get_the_date(); ?> </div>
		</a>
	</div> <br> <br>

	<label for="select-categoria">Filtre por </label>


<?php
//the_content();
endwhile;
?>
-->

<?php
get_footer();
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>