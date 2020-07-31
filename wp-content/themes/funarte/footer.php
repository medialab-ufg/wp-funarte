	<footer role="contentinfo" class="footer">
		<a href="#footer" id="footer" name="footer" class="sr-only">Início do rodapé</a>
		<div class="container">
			<div class="footer__columns">

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
				</div>

				<div class="columns__options">
					<div class="columns__column-b links-list">
						<strong>Redes sociais:</strong>
						<div class="columns__social-iframes">
							<div>
								<p>Facebook:</p>
								<iframe 
									src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ffunarte&tabs=timeline&width=255&height=400&small_header=true&adapt_container_width=true&hide_cover=true&show_facepile=true&appId" 
									width="255" 
									height="400" 
									style="border:none;overflow:hidden" 
									scrolling="no" 
									frameborder="0" 
									allowTransparency="true" 
									allow="encrypted-media">
								</iframe>
							</div>
							<div>
								<p>Twitter:</p>
								<a class="twitter-timeline" data-lang="pt" data-width="255" data-height="400" href="https://twitter.com/Funarte?ref_src=twsrc%5Etfw">
									Tweets da Funarte
								</a> 
								<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
							</div>
						</div>
						<div class="box-social-media-list">
							<ul class="social-media-list">
								<li><a href="https://pt-br.facebook.com/funarte/"><i class="mdi mdi-facebook"></i></a></li>
								<li><a href="https://twitter.com/Funarte"><i class="mdi mdi-twitter"></i></a></li>
							</ul>
						</div>
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

				<div class="box-logos-footer">
					<a class="logo-footer-4" href="https://sistema.ouvidorias.gov.br/publico/Manifestacao/SelecionarTipoManifestacao.aspx?ReturnUrl=%2f" target="_blank">
						<img src="<?php echo get_template_directory_uri() . '/assets/img/lgo/e_ouv.png'; ?>" alt="Acesso à informação">
					</a>
					<a class="logo-footer-3" href="<?php echo home_url() . '/acessoainformacao/'; ?>" target="_blank">
						<img src="<?php echo get_template_directory_uri() . '/assets/img/lgo/informacao.svg'; ?>" alt="Acesso à informação">
					</a>
				</div>
			</div>
		</div>
	</footer>

	<button type="button" class="button-scroll-top"><i class="mdi mdi-chevron-up"></i></button>

	<?php wp_footer(); ?>

	<script defer="defer" src="//barra.brasil.gov.br/barra.js" type="text/javascript"></script>

	</body>
</html>