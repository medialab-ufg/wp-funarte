<?php
get_header();
$estados = \funarte\EspacoCultural::get_instance()->get_estados();

if (isset($_GET['estado']) && !empty($_GET['estado']))
	$estado = $_GET['estado'];

	$busca = (isset($_GET['busca'])) ? $_GET['busca'] : '';

	if (!empty($_GET['area'])) {
		$area = get_category_by_name($_GET['area']);
		if (!empty($area)) 
			$cat = $area->term_id;
	} else {
		$cat = null;
		//$area = get_the_category()[0];
		$area = null;
	}

$params = array(
	'post_type' => \funarte\EspacoCultural::get_instance()->get_post_type(),
	'orderby' => 'title',
	'order' => 'ASC',
	'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
	'posts_per_page' => 10,
	'cat' => isset($cat) ? $cat : null,
	's' => $busca,
);

if (isset($estado)) {
	$params = array_merge(array(
		'meta_key' => 'espaco-estado',
		'meta_value' => $estado
	), $params);
} else {
	$estado = "";
}
query_posts($params);
?>
<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">

		<?php
			$links = [
				['link_name'=>'Espaços Culturais']];
			funarte_load_part('breadcrumb', ['links'=>$links]); 
		?>
		<div class="box-title">
			<h2 class="title-h1">Funarte <span>Espaços Culturais</span></h2>

			<div class="box-forms">
				<form class="form-area" action="#" method="post">
					<fieldset>
						<legend>filtrar por local</legend>
						<select class='select_local' onChange="filter();">
							<option value="">Filtrar por local</option>
							<?php foreach ($estados as $estado_) { ?>
								<option value="<?php echo $estado_; ?>" <?php if($estado_ == $estado) echo 'selected=true'; ?> >
									<?php echo $estado_; ?>
								</option>
							<?php } ?>
						</select>
					</fieldset>
				</form>

				<form class="form-area form-filtro form-filtro--espaco-cultural" action="#" method="post">
					<fieldset>
						<legend>Filtrar por área</legend>
						<?php
						wp_dropdown_categories(array(
							'show_option_none' => 'Filtrar por área',
							'option_none_value' => '',
							'hide_empty' => true,
							'id' => 'select-categoria',
							'class' => 'select_area',
							'name' => 'area',
							'value_field' => 'slug',
							'selected' => (isset($cat)) ? $area->slug : null));
						?>
					</fieldset>
				</form>

				<form class="form-filtro form-filtro--espaco-cultural">
					<fieldset>
						<legend>Formulário de filtro de espaço</legend>

						<div class="form-group">
							<label class="sr-only" for="filtro-espaco-texto">Pesquisar espaço</label>
							<input type="text" id="filtro-espaco-texto" class='input_search' placeholder="Pesquisar espaços" value="<?php echo $busca; ?>">
							<button type="submit"><i class="mdi mdi-magnify"></i><span class="sr-only">Pesquisar</span></button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>

	<?php if (have_posts()): ?>
	<div class="container mb-100">
		<section class="list-soft">
			<div class="row justify-content-between">
				<?php while (have_posts()): the_post(); ?>
					<div class="list-soft__item col-lg-5 color-funarte">
						<div class="list-soft__content">
							<?php
								$thumbnail = get_the_post_thumbnail_url( get_the_ID(),'medium') ? get_the_post_thumbnail_url( get_the_ID(),'medium') : funarte_get_img_default('funarte');
							?>

							<div class="list-soft__image <?php echo empty($thumbnail) ? 'no-image' : '' ?>" style="background-image: url(<?php echo $thumbnail ?>);">
								<?php if (!empty($area)): ?>
									<div class="link-area">
										<a class="<?php echo 'color-' . $area->slug; ?>" href="<?php echo get_category_link( $area->term_id ); ?>"><?php echo $area->name; ?></a>
									</div>
								<?php else:
									$area_tmp = get_area_class(get_the_ID());
								?>
									<div class="link-area">
										<?php if( isset($area_tmp['ID']) ): ?>
											<a class="<?php echo 'color-' . $area_tmp['slug']; ?>" href="<?php echo get_category_link( $area_tmp['ID'] ); ?>"><?php echo $area_tmp['name']; ?></a>
										<?php else: ?>
											<strong class="<?php echo 'color-' . $area_tmp['slug']; ?>"><?php echo $area_tmp['name']; ?></strong>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>

							<div class="list-soft__text">
								<h3 class="title-h5">
									<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
										<?php the_title(); ?>
									</a>
								</h3>

								<strong class="list-soft__local"><?php echo get_post_meta($post->ID, "espaco-estado", true); ?></strong>

								<p><?php echo wp_trim_words(get_the_content(),50); ?></p>

								<a class="link-more" href="<?php the_permalink(); ?>">Leia mais</a>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				<?php echo get_pagination(); ?>
			</div>
		</section>
	</div>
	<?php endif;?>
</main>
<?php
get_footer();
?>
