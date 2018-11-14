	<footer role="contentinfo" class="footer">
		<a href="#footer" id="footer" name="footer" class="sr-only">Início do rodapé</a>
		<div class="container">
			<div class="footer__columns">
				<div class="columns__column-a links-list">
					<strong>Áreas artísticas:</strong>
					<ul>
						<li><a href="#">Teatro</a></li>
						<li><a href="#">Circo</a></li>
						<li><a href="#">Dança</a></li>
						<li><a href="#">Literatura</a></li>
						<li><a href="#">Música</a></li>
						<li><a href="#">Artes visuais</a></li>
						<li><a href="#">Artes integradas</a></li>
					</ul>
				</div><div class="columns__column-a links-list">
					<strong>Funarte:</strong>
					<ul>
						<li><a href="#">Institucional</a></li>
						<li><a href="#">Estrutura organizacional</a></li>
						<li><a href="#">Espaços culturais</a></li>
						<li><a href="#">Regionais</a></li>
						<li><a href="#">Relatórios</a></li>
						<li><a href="#">Licitações</a></li>
						<li><a href="#">Contratações diretas</a></li>
					</ul>
				</div><div class="columns__column-a links-list">
					<strong>Acervos:</strong>
					<ul>
						<li><a href="#">Arquivos permanentes</a></li>
						<li><a href="#">Arquivos privados</a></li>
						<li><a href="#">Audiovisual</a></li>
						<li><a href="#">Bibliotecas</a></li>
						<li><a href="#">Funarte</a></li>
					</ul>
				</div>
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
			<img class="logo-footer" src="<?php echo get_template_directory_uri() . '/assets/img/lgo/funarte_ministerio_cultura.png'; ?>" alt="Funarte - Fundação Nacional de Artes - Ministério da Cultura">
		</div>
	</footer>

	<?php wp_footer(); ?>

	</body>
</html>