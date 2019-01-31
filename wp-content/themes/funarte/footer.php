	<footer role="contentinfo" class="footer">
		<a href="#footer" id="footer" name="footer" class="sr-only">Início do rodapé</a>
		<div class="container">
			<div class="footer__columns">
				<div class="columns__options">
					<div class="columns__column-b links-list">
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

						<strong>Redes sociais:</strong>
						<ul class="social-media-list">
							<li><a href="#"><i class="mdi mdi-facebook"></i></a></li>
							<li><a href="#"><i class="mdi mdi-twitter"></i></a></li>
							<li><a href="#"><i class="mdi mdi-instagram"></i></a></li>
						</ul>
					</div>
				</div>

				<div class="columns__lists">
					<div class="columns__column-a links-list">
						<strong>Áreas artísticas:</strong>
						<ul>
							<li><a href="/category/teatro/">Teatro</a></li>
							<li><a href="/category/circo/">Circo</a></li>
							<li><a href="/category/danca/">Dança</a></li>
							<li><a href="/category/literatura/">Literatura</a></li>
							<li><a href="/category/musica/">Música</a></li>
							<li><a href="/category/artes-visuais/">Artes visuais</a></li>
							<li><a href="/category/artes-integradas/">Artes integradas</a></li>
						</ul>
					</div>
					
					<div class="columns__column-a links-list">
						<strong>Funarte:</strong>
						<?php
							wp_nav_menu( array(
									'theme_location'    => 'rodape',
									'depth'             => 1,
									'container'         => '',
									'container_class'   => '',
									'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
									'walker'            => new WP_Bootstrap_Navwalker(),
								) );
						?>
					</div>

					<div class="columns__column-a links-list">
						<strong>Acervos:</strong>
						<ul>
							<li><a href="#">Arquivos permanentes</a></li>
							<li><a href="#">Arquivos privados</a></li>
							<li><a href="#">Audiovisual</a></li>
							<li><a href="#">Bibliotecas</a></li>
							<li><a href="#">Funarte</a></li>
						</ul>
					</div>
				</div>
			</div>
			<img class="logo-footer" src="<?php echo get_template_directory_uri() . '/assets/img/lgo/funarte_ministerio_cultura.png'; ?>" alt="Funarte - Fundação Nacional de Artes - Ministério da Cultura">
		</div>
	</footer>

	<button type="button" class="button-scroll-top"><i class="mdi mdi-chevron-up"></i></button>

	<?php wp_footer(); ?>

	<script defer="defer" src="//barra.brasil.gov.br/barra.js" type="text/javascript"></script>

	</body>
</html>