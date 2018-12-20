<?php
get_header();
$arg = array(
	'post_parent' => get_the_ID(),
	'post_type'   => 'page',
	'numberposts' => -1,
	'post_status' => 'any');

$contents = [];
$filhos = get_children($arg);
if(!empty($filhos)):
	foreach($filhos as $filho): 
		$contents[$filho->post_name] = ['content'=>$filho->post_content,'title'=>$filho->post_title];
	endforeach;
endif;
$options = wp_parse_args( get_option('theme_options'), get_theme_default_options() );
$url_dados_abertos = "#";
if(isset($options['url_dados_abertos'])) {
	$url_dados_abertos = $options['url_dados_abertos'];
}
?>
<main role="main">
	<div class="container">

		<?php
			$links = [['link_name'=>get_the_title()]];
			funarte_load_part('breadcrumb', ['links'=>$links]); 
		?>
		
		<div class="box-title">
			<h2 class="title-h1">Funarte <span>Institucional</span></h2>
			<a class="box-title__link" href="<?php echo $url_dados_abertos; ?>" target="_blank">Dados Abertos</a>
		</div>

		<!-- BOX-TABS--ACTIVE: CLASSE UTILIZADA PARA ATIVAR A TROCA DE ABAS VIA JS -->
		<section class="box-tabs box-tabs--active">
			<!-- LIST-TABS-ON-OFF: CLASSE UTILIZADA PARA ATIVAR/DESATIVAR O CARROSSEL DE ABAS AO PASSAR POR 1100PX DE LARGURA -->
			<div class="list-tabs list-tabs--on-off">
				<div class="box-tabs__control">
					<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
					<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
				</div>
				<div class="container">
					<ul class="list-tabs__main">
						<?php
							$contador = 0;
							foreach ($contents as $key => $content) :
						?>
								<li class="<?php echo $contador == 0 ? 'active' : ''; ?>"><a href="#content-tab-<?php echo $key; ?>"><?php echo $content['title'] ?></a></li>
						<?php
							$contador++;
							endforeach;
						?>
					</ul>
				</div>
			</div>

			<div class="content-tab">
				<?php
					$contador = 0;
					foreach ($contents as $key => $content) :
				?>
					<div id="content-tab-<?php echo $key; ?>" class="content-tab__content <?php echo $contador == 0 ? 'active' : ''; ?>">
						<h3 class="title-h4 content-tab__title"><?php echo $content['title'] ?></h3>
						<p><?php echo $content['content'] ?></p>
					</div>
				<?php
					$contador++;
					endforeach;
				?>
			</div>
		</section>
	</div>
</main>
<?php get_footer(); ?>