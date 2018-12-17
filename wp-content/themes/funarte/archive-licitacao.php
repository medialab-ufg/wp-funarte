<?php

function get_anos() {
	$posts = query_posts(array(
		'post_type' => \funarte\Licitacao::get_instance()->get_post_type(),
		'posts_per_page' =>	-1
	));

	$anos = array();
	while (have_posts()) {
		the_post();
		$ano = trim(get_post_meta(get_the_ID(), 'licitacao-ano', true));
		if (!empty($ano))
			$anos[] = $ano;
	}
	wp_reset_query();
	$anos = array_unique($anos);
	sort($anos);
	return $anos;
}

$licitacao = \funarte\Licitacao::get_instance();
$modalidade = (isset($_GET['modalidade'])) ? $licitacao->get_modalidade_by_name($_GET['modalidade']) : false;
$ano = (isset($_GET['ano']) && (preg_match('/^\d{4}$/', (int)$_GET['ano']))) ? (int)$_GET['ano'] : date('Y');
$anos = get_anos();
$modalidades = get_terms(\funarte\taxModalidade::get_instance()->get_name());

$params = array(
	'post_type' => 'licitacao',
	'meta_key' => 'licitacao-ano',
	'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
	'meta_value' => $ano
);

if($modalidade) {
	$params = array_merge(array(\funarte\taxModalidade::get_instance()->get_name() => $modalidade->slug), $params);
}
query_posts($params);
get_header();
?>

<main role="main" class="mb-100">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">
		<?php
			$links = [
				['link_name'=>'Licitações']];
			funarte_load_part('breadcrumb', ['links'=>$links]); 
		?>

		<div class="box-title">
			
			<?php if($modalidade) { ?>
				<h2 class="title-h1"><?php echo $modalidade->name; ?></h2>
			<?php } else { ?>
				<h2 class="title-h1">Funarte <span>Licitações</span></h2>
			<?php } ?>
			
			<div class="box-forms">
				<form class="form-ano form-select" action="#" method="post">
					<fieldset>
						<legend>Formulário de ano </legend>
						<select onChange="filter();" class="select_ano">
							<?php foreach ($anos as $ano_):?>
							<option value="<?php echo $ano_; ?>" <?php if($ano_ == $ano) echo 'selected'; ?>>
								<?php echo $ano_; ?>
							</option>
							<?php endforeach; ?>
						</select>
					</fieldset>
				</form>

				<form class="form-categoria form-select" action="#" method="post">
					<fieldset>
						<legend>Formulário de categoria</legend>
						<select onChange="filter();" class="select_modalidade">
							<option value="">Categoria</option>
							<?php foreach ($modalidades as $modalidade_):?>
								<option value="<?php echo $modalidade_->slug; ?>" <?php if($modalidade && $modalidade_->slug == $modalidade->slug ) echo 'selected'; ?>>
									<?php echo $modalidade_->name; ?>
								</option>
							<?php endforeach; ?>
						</select>
					</fieldset>
				</form>
			</div>
		</div>
	</div>

	<?php if (have_posts()): ?>
	<div class="container">
		<ul class="list-bidding">
			<?php while (have_posts()): the_post(); ?>
				<li>
					<div class="list-bidding__text">
						<?php
							// $categoria_modalidade = wp_get_object_terms($post->ID, \funarte\taxModalidade::get_instance()->get_name());
							// if(!empty($categoria_modalidade)) 
							// if ($categoria_modalidade[0]->slug != "inexigibilidade" and $categoria_modalidade[0]->slug != "dispensa") {
							// 	echo '<div class="link-area"><a class="color-funarte" href="?modalidade=' . $categoria_modalidade[0]->slug . '">' . $categoria_modalidade[0]->name . '</a></div>';
							// }
						?>

						<h3 class="title-h5">
							<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
								<?php the_title(); ?>
							</a>
						</h3>
						<p><?php echo wp_trim_words(get_the_content(),30); ?></p>
						<a class="link-more" href="<?php the_permalink(); ?>">Leia mais</a>
					</div>
				</li>
			<?php endwhile; ?>
		</ul>
		
		<?php echo get_pagination(); ?>
		
	</div>
	<?php endif;?>
</main>
<?php
get_footer();
?>