<?php
get_header();

$fields = array('coordenador', 'rua', 'numero', 'complemento', 'fax', 'email',
				'bairro', 'cidade', 'cep', 'telefone1', 'telefone2', 'contatos');

foreach ($fields as $field) {
	${$field} = get_post_meta(get_the_ID(), "regional-{$field}", true);
}
if(have_posts()) : the_post();
?>

<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">
		<?php include('inc/template_parts/breadcrumb.php'); ?>

		<div class="box-title">
			<h2 class="title-h1">
				<a href="<?php echo get_bloginfo('url') . '/regional'; ?>">
					Representações Regionais
				</a> 
			</h2>
		</div>

		<div class="box-title-page color-artes-visuais">
			<h3 class="title-page"><?php the_title(); ?></h3>
			<?php post_thumbnail(get_the_ID(), array('width' => 380, 'height' => null)); ?>
		</div>

		<div>
			<div class="box-text">
				<div class="box-text__date">
					<small>Publicado em <?php the_time(get_option('date_format')); ?></small>
				</div>
				<div class="box-text__text">
					<div class="box-text__image">
						<?php get_the_post_thumbnail(get_the_ID(), array('width' => 380, 'height' => null, 'after' => '<hr />')); ?>
					</div>
					<h3>sobre</h3>
					<?php  the_content(); ?>
				</div>
			</div>

			<div class="box-text">
				<div class="widgets-pa mais-infos">
					<h3>Mais Informações</h3> <br />
					<?php
					if (!empty($coordenador))
						echo "<span><strong>$coordenador</strong></span><br />";
					if (!empty($telefone1)) {
						$conteudo = 'Tel.: ' . $telefone1;
						if (!empty($telefone2))
							$conteudo .= " <br/> $telefone2";
						echo "<span>$conteudo</span><br />";
					}
					if (!empty($fax))
						echo "<span>Fax: $fax</span><br />";
					if (!empty($email))
						echo "<span>email:{$email}</span> <br >";
					if (!empty($rua)) {
						$conteudo = $rua;
						if (!empty($numero))
							$conteudo .= ', Nº ' . $numero;
						if (!empty($complemento))
							$conteudo .= ' - ' . $complemento;
						echo "<span>$conteudo</span> <br>";
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
						echo "<span>CEP $cep</span>";
				
					if (!empty($contatos)) : ?>
						<div class="mais-infos-estrutura">
							<ul style="display: none">
								<?php foreach ($contatos as $contato) : ?>
								<li>
									<?php 
										echo '<h6>' . $contato['area'] . '</h6>';
										echo '<span><strong>' . $contato['responsavel'] . '</strong></span>';
										if (isset($contato['telefone']) && !empty($contato['telefone'])) :
											echo '<span>Tel.: ' . $contato['telefone'] . '</span> <br >';
										endif;
										if (isset($contato['email']) && !empty($contato['email'])) :
											echo '<span>' . $contato['email'] . ' mailto:' . $contato['email'] . '</span>';
											endif;
									?>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<div class="box-text">
			  <h3>Lista de Próximos Eventos</h3> <br />
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
							'meta_value' => date('Y-m-d')
						);

						
						$the_query = new WP_Query( $query );
						if ( $the_query->have_posts() ) {
    					echo '<ul>';
    					while ( $the_query->have_posts() ) {
        				$the_query->the_post();
        				echo '<li>' . get_the_title() . '</li>';
    					}
    					echo '</ul>';
						} else {
							echo "nenhum evento";
						}
						wp_reset_postdata();
					}
				?>
			</div>
		</div>
	</div>
</main>

<?php
endif;
get_footer();
?>
