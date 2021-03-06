<?php
if (!empty($_GET['area'])) {
	$area = get_category_by_name($_GET['area']);
	if (!empty($area))
		$cat = $area->term_id;
}

$busca = (isset($_GET['busca'])) ? $_GET['busca'] : '';
$params = array(
	's' => $busca,
	'cat' => isset($cat) ? $cat : null,
	'paged' => get_query_var('paged') ? get_query_var('paged') : 1
);

$status = (isset($_GET['status']) && !empty($_GET['status'])) ? $_GET['status'] : 'todos';
$edital = \funarte\Edital::get_instance();
$editais = $edital->get_editais($status, $params);
$area = get_category((int)$params['cat']);

get_header();
?>
<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">

		<?php
			$links = [
				['link_name'=>'Editais/Chamamentos']];
			funarte_load_part('breadcrumb', ['links'=>$links]); 
		?>

		<div class="box-title">
			<h2 class="title-h1">Editais/Chamamentos</h2>

			<div class="box-forms">
				<form class="form-area" action="#" method="post">
					<fieldset>
						<legend>Formulário de seleção de área</legend>

						<?php
						wp_dropdown_categories(array(
							'show_option_none' => 'Filtrar por área',
							'option_none_value' => '',
							'hide_empty' => true,
							'id' => 'select-categoria',
							'class' => 'select_area',
							'name' => 'area',
							'value_field' => 'slug',
							'selected' => (isset($area->slug)) ? $area->slug : null));
						?>
						
					</fieldset>
				</form>

				<form class="form-filtro form-filtro--editais">
					<fieldset>
						<legend>Formulário de filtro de editais</legend>
						<div class="form-group">
							<label class="sr-only" for="filtro-editais-texto">Pesquisar</label>
							<input type="text" id="filtro-editais-texto" class="input_search" placeholder="Pesquisar" value="<?php echo $busca;?>">
							<button type="submit"><i class="mdi mdi-magnify"></i><span class="sr-only">Pesquisar</span></button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>

	<section class="box-tabs box-tabs--type-b">
		<!-- LIST-TABS-ON-OFF: CLASSE UTILIZADA PARA ATIVAR/DESATIVAR O CARROSSEL DE ABAS AO PASSAR POR 1100PX DE LARGURA -->
		<div class="list-tabs list-tabs--on-off">
			<div class="box-tabs__control">
				<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
				<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
			</div>
			<div class="container">
				<ul class="list-tabs__main">
					<li class="<?php if($status=='todos') echo 'active'; ?>"><a data-status="todos" class="link-tabs" href="#">Todos</a></li>
					<li class="<?php if($status=='aberto') echo 'active'; ?>"><a data-status="aberto" class="link-tabs" href="#">Inscrições abertas</a></li>
					<li class="<?php if($status=='avaliacao') echo 'active'; ?>"><a data-status="avaliacao" class="link-tabs" href="#">Em avaliação</a></li>
					<li class="<?php if($status=='resultado') echo 'active'; ?>"><a data-status="resultado" class="link-tabs" href="#">Resultados</a></li>
				</ul>
			</div>
		</div>

		<?php if (!empty($editais) && have_posts()):?>
		<div class="content-tab">
			<div class="container">
				<ul class="list-notices"><?php while (have_posts()): the_post(); ?>
					<li class="color-<?php echo get_the_category()[0]->slug; ?>">
						<div class="list-notices-image" style="background-image: url(<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : funarte_get_img_default(get_the_category()[0]->slug); ?>)">
						</div>
						<div class="list-notices-text">
							<?php
								$areas = get_the_category();
								if (!empty($areas)): ?>
								<div class="link-area">
									<?php if ( count($areas) > 1 ): ?>
										<strong class="color-multicategoria">Multicategoria</strong>
									<?php else: ?>
										<a class="<?php echo 'color-' . $areas[0]->category_nicename; ?>" href="<?php echo get_category_link( $areas[0]->cat_ID ); ?>"><?php echo $areas[0]->name; ?></a>
									<?php endif; ?>

									<em class="list-notices-text__date">Publicado em <?php the_date(); ?></em>
								</div>
							<?php endif; ?>

							<h3 class="title-h5">
								<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
									<?php the_title(); ?>
								</a>
							</h3>
							<p><?php echo wp_trim_words(get_the_content(),50); ?></p>

							<a class="link-more" href="<?php the_permalink(); ?>">Leia mais</a>
						</div>
					</li>
					<?php endwhile; ?>
				</ul>
				<?php echo get_pagination(); ?>
			</div>
		</div>
		<?php else:?>
			<div class="content-tab">
				<div class="container">
					Não existem editais.
				</div>
			</div>
		<?php endif;?>
	</section>
</main>

<?php
get_footer();
?>
