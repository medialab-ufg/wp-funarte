<?php
get_header();
$arg = array(
	'post_parent' => get_the_ID(),
	'post_type'   => 'page',
	'numberposts' => -1,
	'post_status' => 'any');

$contents = [];
$filhos = get_children($arg);
if(!empty($filhos)):
	foreach($filhos as $filho): 
		$contents[$filho->post_title] = $filho->post_content;
	endforeach;
endif;
?>
<main role="main">
	<div class="container">
		
		<div class="box-title">
			<h2 class="title-h1">Funarte <span>Institucional</span></h2>
		</div>

		<section class="box-tabs box-tabs--active">
			<div class="list-tabs">
				<div class="container">
					<ul>
						<li class="active"><a href="#content-tab-0">Sobre</a></li>
						<li><a href="#content-tab-1">Missão</a></li>
						<li><a href="#content-tab-2">Informações Básicas</a></li>
						<li><a href="#content-tab-3">Identidade</a></li>
					</ul>
				</div>
			</div>

			<div class="content-tab">
				<?php
					$contador = 0;
					foreach ($contents as $title => $content) :
				?>
					<div id="content-tab-<?php echo $contador; ?>" class="content-tab__content <?php echo $contador == 0 ? 'active' : ''; ?>">
						<h3 class="title-h4 content-tab__title"><?php echo $title ?></h3>
						<p><?php echo $content ?></p>
					</div>
				<?php
					$contador++;
					endforeach;
				?>
			</div>
		</section>
	</div>
</main>
<?php get_footer(); ?>