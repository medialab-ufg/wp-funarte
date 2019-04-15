	<footer role="contentinfo" class="footer">
		<a href="#footer" id="footer" name="footer" class="sr-only">Início do rodapé</a>
		<div class="container">
			<div class="footer__columns">
				<div class="columns__options">
					<div class="columns__column-b links-list">
						<div class="box-form-newsletter">
							<strong>Assine nossa newsletter:</strong>
							<form class="form-newsletter" action="#" method="post">
								<fieldset>
									<legend>Formulário de cadastro de email</legend>

									<div class="form-group">
										<label class="sr-only" for="newsletter-email">Digite seu email</label>
										<input type="text" id="newsletter-email">
										<button type="submit"><i class="mdi mdi-arrow-right"></i></button>
									</div>
								</fieldset>
							</form>
						</div>

						<div class="box-social-media-list">
							<strong>Redes sociais:</strong>
							<ul class="social-media-list">
								<li><a href="#"><i class="mdi mdi-facebook"></i></a></li>
								<li><a href="#"><i class="mdi mdi-twitter"></i></a></li>
								<li><a href="#"><i class="mdi mdi-instagram"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="columns__lists">
					<div class="columns__column-a links-list links-list--collapse">
						<strong>Áreas artísticas:</strong>
						<?php
							wp_nav_menu( array(
									'theme_location'    => 'rodape-coluna-1',
									'depth'             => 1,
									'container'         => '',
									'container_class'   => '',
									'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
									'walker'            => new WP_Bootstrap_Navwalker(),
								) );
						?>
					</div>
					
					<div class="columns__column-a links-list links-list--collapse">
						<strong>Funarte:</strong>
						<?php
							wp_nav_menu( array(
									'theme_location'    => 'rodape-coluna-2',
									'depth'             => 1,
									'container'         => '',
									'container_class'   => '',
									'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
									'walker'            => new WP_Bootstrap_Navwalker(),
								) );
						?>
					</div>

					<div class="columns__column-a links-list links-list--collapse">
						<strong>Acervos:</strong>
						<?php
							wp_nav_menu( array(
									'theme_location'    => 'rodape-coluna-3',
									'depth'             => 1,
									'container'         => '',
									'container_class'   => '',
									'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
									'walker'            => new WP_Bootstrap_Navwalker(),
								) );
						?>
					</div>
				</div>
			</div>

			<div class="footer__logos">
				<div class="box-logo-footer-horizontal">
					<a class="logo-footer-horizontal-1" href="http://www.funarte.gov.br/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/img/lgo/funarte2.svg'; ?>" alt="Fundação Nacional de Artes - Funarte - Ministério da Cidadania - Pátria Amada Brasil - Governo Federal"></a>
					<a class="logo-footer-horizontal-2" href="http://www.brasil.gov.br/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/img/lgo/gov_horizontal.svg'; ?>" alt="Ministério da Cidadania - Pátria Amada Brasil - Governo Federal"></a>
				</div>

				<div class="box-logo-footer-vertical">
					<a class="logo-footer-vertical-1" href="http://www.funarte.gov.br/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/img/lgo/funarte2.svg'; ?>" alt="Fundação Nacional de Artes - Funarte"></a>
					<a class="logo-footer-vertical-2" href="http://www.brasil.gov.br/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/img/lgo/gov_vertical.svg'; ?>" alt="Ministério da Cidadania - Pátria Amada Brasil - Governo Federal"></a>
				</div>

				<a class="logo-footer-3" href="<?php echo site_url() . '/acessoainformacao/'; ?>" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/img/lgo/informacao.svg'; ?>" alt="Acesso à informação"></a>
			</div>
		</div>
	</footer>

	<button type="button" class="button-scroll-top"><i class="mdi mdi-chevron-up"></i></button>

	<?php wp_footer(); ?>

	<script defer="defer" src="//barra.brasil.gov.br/barra.js" type="text/javascript"></script>

	</body>
</html>