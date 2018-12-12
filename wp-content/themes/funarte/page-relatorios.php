<?php
get_header(); the_post();

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
			<h2 class="title-h1">
				<a href="">Funarte</a>
				<span><?php the_title(); ?></span>
			</h2>
		</div>

		<div class="row justify-content-between mb-100">
			<div class="col-md-7">
				<section class="box-tabs box-tabs--active">
					<div class="list-tabs">
						<div class="container">
							<ul>
								<?php
									$contador = 0;
									foreach ($contents as $key => $content):
								?>

									<li class="<?php echo $contador == 0 ? 'active' : ''; ?>"><a href="#content-tab-<?php echo $key; ?>"><?php echo $content['title']; ?></a></li>

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
								<?php echo $content['content']; ?>
							</div>
						<?php
							$contador++;
							endforeach;
						?>
					</div>
				</section>
			</div>
			<div class="col-md-4">
				<aside class="content-aside">
					<div class="box-links">
						<h4 class="title-h1 box-links__title">Outros downloads</h4>

						<ul class="list-links">
							<li>
								<a href="#">O Papel Fundamental da Funarte no Ministério da Cultura</a>
							</li>
							<li>
								<a href="#">O Papel Fundamental da Funarte no Ministério da Cultura</a>
							</li>
							<li>
								<a href="#">O Papel Fundamental da Funarte no Ministério da Cultura</a>
							</li>
						</ul>
					</div>

					<div class="box-links">
						<h4 class="title-h1 box-links__title">Manual e formulários para elaboração da prestação de contas de convênios</h4>

						<ul class="list-links">
							<li>
								<a href="#">O Papel Fundamental da Funarte no Ministério da Cultura</a>
							</li>
							<li>
								<a href="#">O Papel Fundamental da Funarte no Ministério da Cultura</a>
							</li>
							<li>
								<a href="#">O Papel Fundamental da Funarte no Ministério da Cultura</a>
							</li>
						</ul>
					</div>
				</aside>
			</div>
		</div>
	</div>
</main>
	
<?php get_footer(); ?>