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
		$contents[$filho->post_name] = ['content'=>$filho->post_content,'title'=>$filho->post_title];
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
						<?php
							$contador = 0;
							foreach ($contents as $key => $content) :
						?>
								<li class="<?php echo $contador == 0 ? 'active' : ''; ?>"><a href="#content-tab-<?php echo $key; ?>"><?php echo $content['title'] ?></a></li>
						<?php
							$contador++;
							endforeach;
						?>
					</ul>
				</div>
			</div>

			<div class="content-tab">
				<?php
					$contador = 0;
					foreach ($contents as $key => $content) :
				?>
					<div id="content-tab-<?php echo $key; ?>" class="content-tab__content <?php echo $contador == 0 ? 'active' : ''; ?>">
						<h3 class="title-h4 content-tab__title"><?php echo $content['title'] ?></h3>
						<p><?php echo $content['content'] ?></p>
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