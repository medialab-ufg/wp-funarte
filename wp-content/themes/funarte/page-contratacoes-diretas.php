<?php

function get_anos() {
	$posts = query_posts(array(
		'post_type' => \funarte\Licitacao::get_instance()->get_post_type(),
		'post_title' => "%dispensa%",
		'posts_per_page' =>	-1
	));

	$anos = array( );
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
	'post_type' => \funarte\Licitacao::get_instance()->get_post_type(),
	'post_title' => "%dispensa%",
	'meta_key' => 'licitacao-ano',
	'meta_value' => $ano,
	'tax_query' => [
		['taxonomy' => \funarte\taxModalidade::get_instance()->get_name(),
		'field' => 'name',
		'terms' => ['inexigibilidade', 'dispensa'],
		'operator' => 'IN']
	]
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
				['link_name'=>'Contratações Diretas']];
			funarte_load_part('breadcrumb', ['links'=>$links]); 
		?>

		<div class="box-title">
			
			<?php if($modalidade) { ?>
				<h2 class="title-h1"><?php echo $modalidade->name; ?></h2>
			<?php } else { ?>
				<h2 class="title-h1">Funarte <span>Contratações Diretas <?php echo $ano; ?></span></h2>
			<?php } ?>
			
			<div class="box-forms">
				<form class="form-ano form-select" action="#" method="post">
					<fieldset>
						<legend>Formulário de ano </legend>
						<select onChange="filter();" class="select_ano">
							<option value="">
                                Filtrar por ano
                            </option>
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
								<?php if ($modalidade_->slug == "inexigibilidade" or $modalidade_->slug == "dispensa") : ?>
									<option value="<?php echo $modalidade_->slug; ?>" <?php if($modalidade && $modalidade_->slug == $modalidade->slug ) echo 'selected'; ?>>
										<?php echo $modalidade_->name; ?>
									</option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</fieldset>
				</form>
			</div>
		</div>
	</div>

	<div class="container">
		<?php if (have_posts()): ?>
			<ul class="list-bidding">
				<?php while (have_posts()): the_post();
					$terms_modalidade = get_the_terms( get_the_ID(), \funarte\taxModalidade::get_instance()->get_name());
					if (isset($terms_modalidade))
						$name_modalidade = $terms_modalidade[0]->name;
				?>
					<li>
						<div class="list-bidding__text">
							<div class="link-area">
								<strong class="color-funarte"><?php echo $name_modalidade; ?></strong>
							</div>
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
		<?php else: ?>
			Nenhum resultado encontrado.
		<?php endif;?>
	</div>
</main>
<?php
get_footer();
?>
