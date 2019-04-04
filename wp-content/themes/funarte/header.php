<?php
	$area = get_query_var('cat');
	$area = (!empty($area)) ? get_category((int)$area) : null;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1">

		<script type="text/javascript"> var templateUrl = '<?= get_bloginfo("template_url"); ?>'; </script>

		<?php wp_head(); ?>
	</head>
	
	<body <?php echo $area ? "class='body-color-$area->slug'" : "" ; ?> >

		<div id="barra-brasil" style="background:#7F7F7F; height: 20px; padding:0 0 0 10px;display:block;">
			<ul id="menu-barra-temp" style="list-style:none;">
				<li style="display:inline; float:left;padding-right:10px; margin-right:10px; border-right:1px solid #EDEDED">
					<a href="http://brasil.gov.br" style="font-family:sans,sans-serif; text-decoration:none; color:white;">Portal do Governo Brasileiro</a>
				</li>
				<li>
					<a style="font-family:sans,sans-serif; text-decoration:none; color:white;" href="http://epwg.governoeletronico.gov.br/barra/atualize.html">Atualize sua Barra de Governo</a>
				</li>
			</ul>
		</div>

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
					<h1><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri() . '/assets/img/lgo/funarte.svg'; ?>" alt="Funarte - Fundação Nacional de Artes"></a></h1>

					<a href="#funarte-navigation-menu" id="funarte-navigation-menu" name="funarte-navigation-menu" class="sr-only">Início do menu de navegação</a>
					<nav class="navbar navbar-expand-lg navbar-light navigation-menu" role="navigation">
						<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"><i class="mdi mdi-menu"></i></span>
							<i class="mdi mdi-close"></i>
						</button>

						<div class="menu-wrapper">
							<div class="menu-wrapper__scroll">
								<div class="box-searchform">
									<form role="search" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
										<fieldset>
											<legend>Formulário de busca</legend>
											<strong>Busca</strong>
											<label class="sr-only" for="s">Digite o que procura</label>
											<input type="text" value="" name="s" id="s1">

											<div class="box-buttons">
												<button class="searchcancel" type="button">Cancelar</button>
												<input type="submit" id="searchsubmit1" value="Pesquisar">
											</div>
										</fieldset>
									</form>

									<button type="button" class="searchform-button"><i class="mdi mdi-magnify"></i><i class="mdi mdi-close"></i></button>
								</div>

								<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon"><i class="mdi mdi-menu"></i></span>
									<i class="mdi mdi-close"></i>
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

								<ul class="areas-list">
									<li><a class="color-circo <?php echo ($area!=null && $area->slug == 'circo') ? 'active' : ''; ?>" 	href="<?php echo get_term_link('circo', 'category'); ?>">Circo</a></li>
									<li><a class="color-teatro <?php echo ($area!=null && $area->slug == 'teatro') ? 'active' : ''; ?>" href="<?php echo get_term_link('teatro', 'category'); ?>">Teatro</a></li>
									<li><a class="color-danca <?php echo ($area!=null && $area->slug == 'danca') ? 'active' : ''; ?>" 	href="<?php echo get_term_link('danca', 'category'); ?>">Dança</a></li>
									<li><a class="color-musica <?php echo ($area!=null && $area->slug == 'musica') ? 'active' : ''; ?>" href="<?php echo get_term_link('musica', 'category'); ?>">Música</a></li>
									<li><a class="color-artes-integradas <?php echo ($area!=null && $area->slug == 'artes-integradas') ? 'active' : ''; ?>" href="<?php echo get_term_link('artes-integradas', 'category'); ?>">Artes integradas</a></li>
									<li><a class="color-artes-visuais <?php echo ($area!=null && $area->slug == 'artes-visuais') ? 'active' : ''; ?>" href="<?php echo get_term_link('artes-visuais', 'category'); ?>">Artes visuais</a></li>
									<!-- <li><a class="color-literatura <?php echo ($area!=null && $area->slug == 'literatura') ? 'active' : ''; ?>" href="<?php echo get_term_link('literatura', 'category'); ?>">Literatura</a></li> -->
								</ul>
							</div>
						</div>
					</nav>
					<div class="background-menu"></div>

					<?php get_search_form(); ?>
				</div>

			</div>
		</header>