<?php 
	get_header();
	$edital = \funarte\Edital::get_instance();
	$status = $edital->get_edital_status($post->ID);

	if (have_posts()) { the_post(); ?>
		<div id="section">
			<h2 class="titulo-25">
				<span>
					<a href="<?php echo get_bloginfo('url') . '/editais'; ?>" title="Editais">Editais</a> /
					<a href="<?php echo get_bloginfo('url') . '/editais/?status=' . $status; ?>" title="<?php echo esc_attr($edital->get_edital_status_name($post->ID)); ?>"><?php echo $edital->get_edital_status_name($post->ID); ?></a>
				</span>
			</h2>
			<h1 class="titulo-45 post"><?php the_title(); ?></h1>

			<?php
			$areas = get_the_category();
			if (!empty($areas)): ?>
				<div class="relacionamento">
					<span>Relacionado a:
						<?php foreach ($areas as $area): ?>
							<small class="<?php echo $area->category_nicename; ?>"><?php echo $area->name; ?></small>
							<?php if ($area != end($areas)) { ?>, <?php } ?>
						<?php endforeach; ?>
					</span>
				</div>
			<?php endif; ?>

			<div class="titulo-publicacao">
				<small>Publicado em <?php the_time(get_option('date_format')); ?></small>
			</div>

			<div class="conteudo-texto">
				<?php get_the_post_thumbnail(get_the_ID(), array('width' => 380, 'height' => null, 'after' => '<hr />')); ?>
				<h3>Sobre o Edital</h3>
				<?php the_content(); ?>
			</div>

			<div class="outras-infos-texto">
				<div class="resultado">
					<h3>
						<span><?php echo $edital->get_edital_status_name($post->ID); ?></span>
						<?php if ($status == 'aberto') { ?>
							<span class="interrogacao">
								<a href="#" title="Ajuda">?</a>
								<div class="box-guia">
									<p>Fique atento ao prazo final e inscreva-se a tempo. Estamos esperando seu projeto.</p>
								</div>
							</span>
						<?php } elseif ($status == 'avaliacao') { ?>
							<span class="interrogacao">
								<a href="#" title="Ajuda">?</a>
								<div class="box-guia">
									<p>Após o fim do prazo para inscrições, uma comissão julgadora avalia as propostas recebidas. Em seguida, a lista de projetos classificados será divulgada neste portal.</p>
								</div>
							</span>
						<?php } elseif ($status == 'resultado') { ?>
							<span class="interrogacao">
								<a href="#" title="Ajuda">?</a>
								<div class="box-guia">
									<p>Já foi divulgada a relação dos projetos classificados. Os proponentes contemplados devem proceder às próximas etapas previstas pelo edital (ex.: envio de documentação).</p>
								</div>
							</span>
						<?php } ?>
					</h3>
					<?php
					if ($status == 'aberto') {
						$meta = array(
							'inscricoes' => array(
								'inicio' => strtotime(get_post_meta($post->ID, 'edital-inscricoes_inicio', true)),
								'fim' => strtotime(get_post_meta($post->ID, 'edital-inscricoes_fim', true))
							),
							'prorrogado' => (bool)get_post_meta($post->ID, 'edital-prorrogado', true),
							'resultado' => (bool)get_post_meta($post->ID, 'edital-resultado', true)
						);
					?>
					<div class="descricao">
						<?php if ($meta['prorrogado']) { ?>
						<span class="fundo-amarelo">Prorrogado</span>
						<?php } ?>
						<span>Início: <strong><?php echo date('d/m/Y', $meta['inscricoes']['inicio']); ?></strong></span>
						<span>Término: <strong><?php echo date('d/m/Y', $meta['inscricoes']['fim']); ?></strong></span>
					</div>
					<?php } ?>
				</div>
			</div>
			
			<?php 
				$THEME_FOLDER = get_template_directory();
				$DS = DIRECTORY_SEPARATOR;
				$META_FOLDER = $THEME_FOLDER . $DS . 'inc' . $DS . 'post_types' . $DS . 'edital' . $DS;
				require_once($META_FOLDER . 'widget-arquivos-relacionados.php');
			?>
			
		</div>
		<?php }
get_footer();