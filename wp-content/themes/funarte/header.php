<!DOCTYPE html>
<html>
	<head>
		<?php wp_head(); ?>
	</head>

	<body>
		<header role="banner" class="site-header">
			<div class="container">
				<div class="site-header__row">
					<h1><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri() . '/assets/img/lgo/funarte.jpg'; ?>" alt="Funarte - Fundação Nacional de Artes"></a></h1>

					<?php
						wp_nav_menu( array(
							'theme_location'	=> 'principal',
							'depth'				=> 2,
							'container'			=> 'nav',
							'container_class'	=> 'navigation-menu',
							'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
							'walker'			=> new WP_Bootstrap_Navwalker(),
						) );

						get_search_form();
					?>
				</div>

				<ul class="areas-list">
					<li><a class="areas-list__area-1" href="#">Circo</a></li>
					<li><a class="areas-list__area-2" href="#">Teatro</a></li>
					<li><a class="areas-list__area-3 active" href="#">Dança</a></li>
					<li><a class="areas-list__area-4" href="#">Música</a></li>
					<li><a class="areas-list__area-5" href="#">Artes integradas</a></li>
					<li><a class="areas-list__area-6" href="#">Artes visuais</a></li>
					<li><a class="areas-list__area-7" href="#">Literatura</a></li>
				</ul>
			</div>
		</header>