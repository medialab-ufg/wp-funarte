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
						<legend>Formulário para filtrar eventos por local</legend>

						<?php 
						
						wp_dropdown_categories([
							'show_option_none'   => 'Filtrar por local',
							'option_none_value'		=> '',
							'orderby'           => 'name',
							'order'             => 'ASC',
							'name'              => 'local',
							'taxonomy'			=> 'espacos-culturais',
							'id'                => 'datepicker-compacto-filtro-local',
							'class'				=> 'datepicker-compacto-filtro',
						]);
						
						?>
						
					</fieldset>
				</form>

				<form class="form-filtro-calendario" action="#" method="post">
					<fieldset>
						<legend>Formulário para filtrar eventos por área</legend>
						
						<?php 
						
						wp_dropdown_categories([
							'show_option_none'   => 'Filtrar por área',
							'option_none_value'		=> '',
							'orderby'           => 'name',
							'order'             => 'ASC',
							'name'              => 'cat',
							'id'                => 'datepicker-compacto-filtro-area',
							'class'				=> 'datepicker-compacto-filtro',
						]);
						
						?>

					</fieldset>
				</form>

				<!--<form class="form-filtro-calendario" action="#" method="post">
					<fieldset>
						<legend>Formulário de filtro para o calendário</legend>

						<select>
							<option value="">Todos os eventos</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
						</select>
					</fieldset>
				</form> -->

				<form class="form-filtro-calendario form-filtro-calendario--datepicker" action="#" method="post">
					<fieldset>
						<legend>Formulário de filtro para o calendário</legend>

						<input type="text" class="datepicker-compacto datepicker-field">
					</fieldset>
				</form>
			</div>

			<div class="box-calendario-main loading">
				<div class="carousel-highlights__control">
					<button type="button" class="control__next slick-arrow"><i class="mdi mdi-chevron-right"></i></button>
					<button type="button" class="control__prev slick-arrow"><i class="mdi mdi-chevron-left"></i></button>
				</div>

				<div class="box-calendario">
					<ul class="calendario-carousel">
						
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

			<?php
				$dia_corrente = (isset($_GET['dia'])) ? $_GET['dia'] : date('d');
				$mes_corrente = (isset($_GET['mes'])) ? $_GET['mes'] : date('m');
				$ano_corrente = (isset($_GET['ano'])) ? $_GET['ano'] : date('Y');
				// $mes_corrente = date('m');
				// $ano_corrente = date('Y');
				$eventos = \funarte\Evento::get_instance()->get_prepared_events_by_month($mes_corrente, $ano_corrente);
				$days = ['DOM','SEG','TER','QUA','QUI','SEX','SAB'];
			?>

			<div class="carousel-calendar__wrapper">
				<div class="box-calendar__control">
					<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
					<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
				</div>
				<ul class="carousel-calendar" data-mes="<?php echo $mes_corrente; ?>" data-ano="<?php echo $ano_corrente; ?>" >
					<?php foreach ($eventos['events'] as $data => $eventos_dia): ?>
						<li class="<?php echo $data == date('d/m/Y', strtotime("$dia_corrente-$mes_corrente-$ano_corrente")) ? 'active':''; ?>" >
							<div class="carousel-calendar__button">
								<?php
									$data = str_replace('/', '-', $data);
									$dia_semana = $days[date('w', strtotime($data))]; 
								?>
								<button type="text"><?php echo $dia_semana.'<br>'.substr($data, 0, 5); ?></button>
							</div>
							<?php if (!empty($eventos_dia)): ?>
							<?php foreach ($eventos_dia as $evento) : ?>
								<div class="carousel-calendar__event color-<?php echo $evento['cat']->slug; ?>">
									<strong><a href="<?php echo get_permalink($evento['ID']);?>" title="<?php echo $evento['title']; ?>" ><?php echo $evento['title']; ?></a></strong>
									<span class="carousel-calendar__pin"><?php echo $evento['local']; ?> </span>
									<span class="carousel-calendar__time"><?php echo $evento['hora']['inicio'] . " às " . $evento['hora']['fim'] ; ?> </span>
								</div>
							<?php endforeach; ?>
							<?php else: ?>
									<strong>Nenhum evento</strong>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>