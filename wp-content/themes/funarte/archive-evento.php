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
			<form class="form-filtro-calendario" action="#" method="post">
				<div class="row">
					<fieldset class="col-md-2">
						<legend>campo do filtro para o calendário por local</legend>

						<?php
						wp_dropdown_categories([
							'show_option_none' => 'Filtrar por local',
							'option_none_value' => '',
							'hide_empty' => true,
							'orderby' => 'name',
							'order' => 'ASC',
							'class' => 'select_local',
							'name' => 'local',
							'taxonomy' => 'espacos-culturais'
						]);
						?>
					</fieldset>
						
					<fieldset class="col-md-2">
						<legend>campo do filtro para o calendário por área</legend>
						<?php
						wp_dropdown_categories(array(
							'show_option_none' => 'Filtrar por área',
							'option_none_value' => '',
							'hide_empty' => true,
							'id' => 'select-categoria',
							'class' => 'select_area',
							'name' => 'area',
							'value_field' => 'slug'));
						?>
					</fieldset>

					<fieldset class="col-md-2">
						<legend>campo do filtro filtro para o calendário por data</legend>
						<input type="text" class="datepicker datepicker-field">
					</fieldset>
					
					<button type="submit">
						<i class="mdi mdi-magnify active"></i>
						<span class="sr-only">Pesquisar</span>
					</button>
					<img class="loading" style="display:none;" src="<?php echo get_template_directory_uri() . '/assets/img/ico/loading.gif'; ?>" />

				</div>
			</form>
		

			<?php
				$datestring = (isset($_GET['dia'])) ? str_replace('/', '-', $_GET['dia']) : date('d-m-Y');
				$date = new \DateTime($datestring);
				$eventos = \funarte\Evento::get_instance()->get_events_by_period($date, 10, 10);
				$days = ['DOM','SEG','TER','QUA','QUI','SEX','SAB'];
			?>

			<div class="carousel-calendar__wrapper">
				<div class="box-calendar__control">
					<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
					<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
				</div>
				<ul class="carousel-calendar">

					<?php foreach ($eventos['events'] as $data => $eventos_dia): ?>
						<li class="calendar-slide <?php echo $data == date('d/m/Y', strtotime($datestring)) ? 'active':''; ?>" data-dia="<?php echo $data; ?>" >
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
										<strong><a href="<?php echo $evento['permalink'];?>" title="<?php echo $evento['title']; ?>" ><?php echo $evento['title']; ?></a></strong>
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