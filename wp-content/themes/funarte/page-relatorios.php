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
		$contents[$filho->post_title] = $filho->post_content;
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

		<section class="box-tabs">
			<div class="list-tabs">
				<div class="container">
					<ul>
						<?php foreach ($contents as $title => $content):
							echo "<li class='$title'><a href='#'>$title</a></li>";
						endforeach;?>
					</ul>
				</div>
			</div>

			<div class="content-tab">
				<div class="container">
					<?php foreach ($contents as $title => $content) : ?>
						<div class="<?php echo $title; ?>">
							<?php echo $content;?>
						</div>
					<?php endforeach;?>
				</div>
			</div>
		</section>
	</div>
</main>
	
<?php get_footer(); ?>