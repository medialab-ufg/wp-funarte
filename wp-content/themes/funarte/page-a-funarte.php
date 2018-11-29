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
			<h2 class="title-h1">Funarte <span>institucional</span></h2>
		</div>

		<section class="box-tabs">
			<div class="list-tabs">
					<div class="container">
						<ul>
							<li class="active"><a href="#">Sobre</a></li>
							<li><a href="#">Missão</a></li>
							<li><a href="#">Informações Básicas</a></li>
							<li><a href="#">Identidade</a></li>
						</ul>
					</div>
				</div>
				<div class="content-tab">
					<div class="container">
						<?php foreach ($contents as $title => $content) : ?>
							<div>
								<h3 class="title-h5"><?php echo $title ?></h3>
								<p><?php echo $content ?></p>
						</div>
						<?php	endforeach; ?>
					</div>
				</div>
			</div>
		</section>
	</div>
</main>
<?php get_footer(); ?>