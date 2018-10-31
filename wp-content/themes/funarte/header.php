<!DOCTYPE html>
<html>
	<head>
		<?php wp_head(); ?>
	</head>

	<body>
		<!-- MENU DE ACESSIBILIDADE
		<div class="accessibility-bar">
			<nav class="accessibility-bar__container">
				<ul class="accessibility-shortcuts" role="menubar">
					<li role="menuitem"><a href="#content" accesskey="c"><span>c</span> Ir para o conteúdo</a></li>
					<li role="menuitem"><a href="#tainacan-navigation-menu" accesskey="m"><span>m</span> Ir para o menu</a></li>
					<li role="menuitem"><a href="#tainacan-search-header" accesskey="b"><span>b</span> Ir para a busca</a></li>
					<li role="menuitem"><a href="#footer" accesskey="r"><span>r</span> Ir para o rodapé</a></li>
				</ul>

				<ul class="accessibility-options" role="menubar">
					<li role="menuitem">
						<span>Fonte</span>
						<button type="button" class="button-text-minus" accesskey="5">A-</button>
						<button type="button" class="button-text-default" accesskey="6">A</button>
						<button type="button" class="button-text-plus" accesskey="7">A+</button>
					</li>
					<li role="menuitem">
						<span>Contraste</span>
						<button type="button" class="button-high-contrast" accesskey="8">Alto Contraste</button>
					</li>
				</ul>
			</nav>
		</div> -->

		<!-- AVISO DE ERRO CASO O JS ESTEJA DESATIVADO OU NÃO ESTEJA FUNCIONANDO -->
		<noscript>
			<style>
				noscript {
					margin: 0;
					padding: 12px 15px;
					font-size: 18px;
					color: #000;
					text-align: center;
					display: block;
					background-color: #FFC107;
				}
			</style>

			<span>Seu navegador não tem suporte a JavaScript ou o mesmo está desativado.</span>
		</noscript>

		<header role="banner" class="site-header">
			<div class="container">
				<div class="site-header__row">
					<h1><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri() . '/assets/img/lgo/funarte.jpg'; ?>" alt="Funarte - Fundação Nacional de Artes"></a></h1>

					<nav class="navbar navbar-expand-lg navbar-light navigation-menu" role="navigation">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<?php
							wp_nav_menu( array(
								'theme_location'    => 'principal',
								'depth'             => 2,
								'container'         => 'div',
								'container_class'   => 'collapse navbar-collapse',
								'container_id'      => 'bs-example-navbar-collapse-1',
								'menu_class'        => 'nav navbar-nav',
								'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
								'walker'            => new WP_Bootstrap_Navwalker(),
							) );
						?>
					</nav>

					<?php get_search_form(); ?>
				</div>

				<ul class="areas-list">
					<li><a class="areas-list__vermelho-1" href="#">Circo</a></li>
					<li><a class="areas-list__rosa-1" href="#">Teatro</a></li>
					<li><a class="areas-list__amarelo-1 active" href="#">Dança</a></li>
					<li><a class="areas-list__laranja-1" href="#">Música</a></li>
					<li><a class="areas-list__roxo-1" href="#">Artes integradas</a></li>
					<li><a class="areas-list__azul-1" href="#">Artes visuais</a></li>
					<li><a class="areas-list__limao-1" href="#">Literatura</a></li>
				</ul>
			</div>
		</header>