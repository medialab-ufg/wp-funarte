<?php
get_header();

$fields = array('coordenador', 'rua', 'numero', 'complemento', 'fax', 'email',
				'bairro', 'cidade', 'cep', 'telefone1', 'telefone2', 'contatos');

foreach ($fields as $field) {
	${$field} = get_post_meta(get_the_ID(), "regional-{$field}", true);
}
if(have_posts()) : the_post();
?>

<main role="main" class="mb-100">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">
		<?php include('inc/template_parts/breadcrumb.php'); ?>

		<div class="box-title">
			<h2 class="title-h1"><a href="<?php echo get_bloginfo('url') . '/regional'; ?>">Funarte <span>Representações Regionais</span></a></h2>
		</div>

		<?php $imagem = get_the_post_thumbnail( get_the_ID(),'large'); ?>

		<div class="box-title-page <?php echo !empty($imagem) ? 'box-title-page--image' : ''; ?>">

			<div class="link-area">
				<strong class="color-funarte"><?php echo get_post_meta($post->ID, "regional-cidade", true); ?></strong>
			</div>

			<h3 class="title-page"><?php the_title(); ?></h3>

			<?php
				if (!empty($imagem)):
			?>
				<div class="box-title-page__thumb">
					<?php echo $imagem; ?>
					<span class="box-title-page__caption"><?php the_post_thumbnail_caption(); ?></span>
				</div>
			<?php
				endif;
			?>
		</div>

		<div class="row justify-content-between">
			<div class="col-md-6">
				<div class="box-text">
					<h4 class="title-5--type-b">Sobre</h4>
					<div class="box-text__text">
						<?php the_content(); ?>
					</div>
				</div>

				<div class="box-text">
					<h4 class="title-5--type-b">Próximos eventos no local</h4>

					<?php
						//jogar isso para um widget?
						$regional = wp_get_post_terms( get_the_ID(), \funarte\taxRegional::get_instance()->get_name());
						if(!empty($regional)) {
							$query = array(
								'paged' => false,
								'post_type' => 'evento',
								'orderby' => 'meta_value',
								'order' => 'ASC',
								$regional[0]->taxonomy => $regional[0]->slug,
								'post__not_in' => array(get_the_ID()),
								'meta_key'	 => 'evento-inicio',
								'meta_compare' 		=> '<',
								'meta_value' => date('Y-m-d'),
								'posts_per_page' => 4
							);

							$the_query = new WP_Query( $query );
							if ( $the_query->have_posts() ) {
					?>

						<ul class="list-bidding--type-b">

					<?php
							while ( $the_query->have_posts() ) {
							$the_query->the_post();

							$areas = get_the_category();
					?>
							<li class="<?php echo 'color-' . $areas[0]->slug; ?>">
								<?php
									if (!empty($areas)): ?>
									<div class="link-area">
										<?php foreach ($areas as $area): ?>
											<a class="<?php echo 'color-' . $area->slug; ?>" href="<?php echo get_category_link( $area->cat_ID ) ?>"><?php echo $area->name; ?></a>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>

								<strong><?php the_title(); ?></strong>
								<a class="link-more" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">Ler mais</a>
							</li>
					<?php
							}
					?>

						</ul>

					<?php
							} else {
								echo "nenhum evento";
							}
							wp_reset_postdata();
						}
					?>
				</div>
			</div>

			<div class="col-md-5">
				<aside class="content-aside">
					<div class="box-data">
						<h4 class="title-5">Informações</h4>

						<div class="box-data__row">
							<?php
								if (!empty($coordenador))
									echo "<div class='box-data__row'><strong>$coordenador</strong></div>";
								if (!empty($telefone1)) {
									$conteudo = '<b>Tel.:</b> ' . $telefone1;
									if (!empty($telefone2))
										$conteudo .= " <br/> $telefone2";
									echo "<div class='box-data__row'><span>$conteudo</span></div>";
								}
								if (!empty($fax))
									echo "<div class='box-data__row'><span><b>Fax:</b> $fax</span></div>";
								if (!empty($email))
									echo "<div class='box-data__row'><span><b>Email:</b> {$email}</span></div>";
							?>

							<div class='box-data__row'>
							<?php
								if (!empty($rua)) {
									$conteudo = $rua;
									if (!empty($numero))
										$conteudo .= ', Nº ' . $numero;
									if (!empty($complemento))
										$conteudo .= ' - ' . $complemento;
									echo "<span>$conteudo</span>";
								}
								if (!empty($cidade)) {
									$conteudo = '';
									if (!empty($bairro))
										$conteudo .= $bairro . ' - ';
									$conteudo .= $cidade;
									echo "<span>$conteudo</span>";
								}
								if (!empty($estado))
									echo "<span>$estado</span>";
								if (!empty($cep))
									echo "<span><b>CEP:</b> $cep</span>";
							?>
							</div>

							<?php
								if (!empty($contatos)) : ?>
									<div class="box-info__collapse">
										<button class="collapse__button" type="button">Exibir todos os contatos</button>
										<div class="collapse__text">
											<?php foreach ($contatos as $contato) : ?>
												<div class="text__block">
													<strong><?php echo $contato['area']; ?></strong>
													<strong><?php echo $contato['responsavel']; ?></strong>
													<?php
														if (isset($contato['telefone']) && !empty($contato['telefone'])) :
															echo '<span><b>Tel.:</b> ' . $contato['telefone'] . '</span>';
														endif;
														if (isset($contato['email']) && !empty($contato['email'])) :
															echo '<a href="mailto:' . $contato['email'] . '">' . $contato['email'] . '</a>';
														endif;
													?>
												</div>
											<?php endforeach; ?>
										</div>
									</div>
								<?php endif;
							?>
						</div>
						<h4 class="title-5">Veja como chegar</h4>

						<div id="map"></div>
					</div>
				</aside>
			</div>
		</div>
	</div>
</main>

<?php
endif;
get_footer();
?>
