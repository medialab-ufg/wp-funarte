<?php 
	get_header();
	$dia = (isset($_GET['dia'])) ? $_GET['dia'] : date('d/m/Y');
?>
	<main role="main" class="mb-100">
		<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
		<div class="container">
			<?php
				$links = [
					['link_name'=>'Funarte', 'link_url'=>'/'],
					['link_name'=>'Agenda institucional do presidente']];
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
							if(have_posts()): the_post();
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