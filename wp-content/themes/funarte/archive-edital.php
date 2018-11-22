<?php
if (!empty($_GET['area'])) {
	$area = get_category_by_name($_GET['area']);
	if (!empty($area))
		$cat = $area->term_id;
}

$params = array(
	's' => (isset($_GET['busca'])) ? $_GET['busca'] : '',
	'cat' => isset($cat) ? $cat : null,
	'paged' => get_query_var('paged') ? get_query_var('paged') : 1
);

$status = (isset($_GET['status']) && !empty($_GET['status'])) ? $_GET['status'] : 'todos';
$Edital = \funarte\Edital::get_instance();
$editais = $Edital->get_editais($status, $params);

get_header();
?>

<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">
		<?php include('inc/template_parts/breadcrumb.php'); ?>

		<div class="box-title">
			<h2 class="title-h1">Editais</h2>
		</div>

		<?php
		if (!empty($editais) && have_posts()):
		?>
			<ul class="list-notices"><?php while (have_posts()): the_post(); ?>
				<li>
					<h6><?php echo $Edital->get_edital_status_name($post->ID); ?></h6>

					<div class="link-area">
						<a href="#"><?php the_category(); ?></a>
					</div>
					<h3 class="title-h5">
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
							<?php the_title(); ?>
						</a>
					</h3>

					<?php the_excerpt(); ?>
				</li>
			<?php endwhile; ?></ul>
		<?php 
		endif;
		?>

	</div>
</main>

<?php
get_footer();
?>
