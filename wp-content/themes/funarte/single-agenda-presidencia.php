<?php 
	get_header(); 
	$dia = (isset($_GET['dia'])) ? $_GET['dia'] : date('d/m/Y');
	$args = array(
    'posts_per_page'   => 1,
    'post_type'        => \funarte\AgendaPresidencia::get_instance()->get_post_type_name(),
    'meta_key'         => 'agenda-presidencia-data',
    'meta_value'       => $dia
	);
	query_posts( $args );
?>
	<main role="main" class="mb-100">
		<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
		<div class="container">
			<?php
				$links = [
					['link_name'=>'Agenda institucional do presidente'],
					['link_name'=>get_the_title()]];
				funarte_load_part('breadcrumb', ['links'=>$links]); 
			?>

			<div class="box-title">
				<h2 class="title-h1">Funarte <span>Agenda institucional do presidente</span></h2>
			</div>

			<div class="row justify-content-between">
				<div class="col-md-4">
					<aside class="content-aside">
						Calendário
					</aside>
				</div>
				<div class="col-md-7">
					<aside class="content-aside">
						<?php 
							if(have_posts()) : the_post();
								$data_agenda = get_post_meta($post->ID, "agenda-presidencia-data", true);
								echo "Eventos do dia $data_agenda";
								the_content();
							else:
								echo "Não existe eventos para o dia $dia";
							endif;
						?>
					</aside>
				</div>
			</div>
		</div>
	</main>
<?php
get_footer();