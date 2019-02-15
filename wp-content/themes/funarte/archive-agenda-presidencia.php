<?php 
	get_header();
	$dia = (isset($_GET['dia'])) ? $_GET['dia'] : date('d/m/Y');
?>
	<main role="main" class="mb-100">
		<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
		<div class="container box-agenda">
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
					<aside class="aside">
						<div class="datepicker-agenda"></div>
					</aside>
				</div>
				<div class="col-md-8">
					<section class="content">
						<?php 
							if(have_posts()): the_post();
								$data_agenda = get_post_meta($post->ID, "agenda-presidencia-data", true);
								echo "<h3 class='title-h4--type-b'>Eventos do dia $data_agenda</h3>";
								the_content();
							else:
								echo "<p>Não foi encontrado nenhum evento no dia $dia.</p>";
							endif;
						?>
					</section>
				</div>
			</div>
		</div>
	</main>
<?php
get_footer();
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>