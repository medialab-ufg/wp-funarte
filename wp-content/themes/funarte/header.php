<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<?php wp_head(); ?>
	</head>

	<body>
		<!-- MENU DE ACESSIBILIDADE -->
		<div class="accessibility-bar">
			<nav class="container">
				<ul class="accessibility-shortcuts" role="menubar">
					<li role="menuitem"><a href="#content" accesskey="c"><span>c</span> Ir para o conteúdo</a></li>
					<li role="menuitem"><a href="#funarte-navigation-menu" accesskey="m"><span>m</span> Ir para o menu</a></li>
					<li role="menuitem"><a href="#s" accesskey="b"><span>b</span> Ir para a busca</a></li>
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
		</div>

		<!-- AVISO DE ERRO CASO O JS ESTEJA DESATIVADO OU NÃO ESTEJA FUNCIONANDO -->
		<noscript>
			<span>Seu navegador não tem suporte a JavaScript ou o mesmo está desativado.</span>
		</noscript>

		<header role="banner" class="header">
			<div class="container">
				<div class="header__row">
					<h1><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri() . '/assets/img/lgo/funarte.png'; ?>" alt="Funarte - Fundação Nacional de Artes"></a></h1>

					<a href="#funarte-navigation-menu" id="funarte-navigation-menu" name="funarte-navigation-menu" class="sr-only">Início do menu de navegação</a>
					<nav class="navbar navbar-expand-lg navbar-light navigation-menu" role="navigation">
						<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
							<i class="mdi mdi-close"></i>
						</button>

						<div class="menu-wrapper">
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

							<ul class="areas-list">
								<li><a class="color-circo" href="#">Circo</a></li>
								<li><a class="color-teatro" href="#">Teatro</a></li>
								<li><a class="color-danca active" href="#">Dança</a></li>
								<li><a class="color-musica" href="#">Música</a></li>
								<li><a class="color-artes-integradas" href="#">Artes integradas</a></li>
								<li><a class="color-artes-visuais" href="#">Artes visuais</a></li>
								<li><a class="color-literatura" href="#">Literatura</a></li>
							</ul>
						</div>
					</nav>

					<?php get_search_form(); ?>
				</div>

			</div>
		</header>