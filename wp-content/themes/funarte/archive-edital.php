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
$edital = \funarte\Edital::get_instance();
$editais = $edital->get_editais($status, $params);
$area = get_category((int)$params['cat']);

get_header();
if (!empty($editais) && have_posts()):
?>
	<ul><?php while (have_posts()): the_post(); ?>
		<li>
			<h6><?php echo $edital->get_edital_status_name($post->ID); ?></h6>
			<div class="relacionamento">
				<span>Relacionado a: <small class="<?php echo $area->slug; ?>"><?php echo $area->name; ?></small></span>
			</div>
			<h4>
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
					<?php the_title(); ?>
				</a>
			</h4>
		</li>
	<?php endwhile; ?></ul>
<?php 
endif;
get_footer();
?>
