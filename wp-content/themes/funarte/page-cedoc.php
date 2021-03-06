<?php
/**
 * Template Name: CEDOC - Abas e Carrossel
 */

get_header(); the_post();

$arg = array(
	'post_parent' => get_the_ID(),
	'post_type'   => 'page',
	'numberposts' => -1,
	'post_status' => 'any',
	'order'		  => 'ASC',
	'orderby' 	  => 'menu_order');

$contents = [];
$filhos = get_children($arg);
if(!empty($filhos)):
	foreach($filhos as $filho):
		$contents[$filho->post_name] = ['content'=>$filho->post_content,'title'=>$filho->post_title];
	endforeach;
endif;

?>
<main role="main">
	<div class="container">

		<?php
			$links = [['link_name'=>get_the_title()]];
			funarte_load_part('breadcrumb', ['links'=>$links]); 
			funarte_load_part('box-title', ['titles'=>['Funarte', get_the_title()]]); 
		?>

		<div class="mb-100">
			
			<!-- BOX-TABS--ACTIVE: CLASSE UTILIZADA PARA ATIVAR A TROCA DE ABAS VIA JS -->
			<section class="box-tabs box-tabs--active">
				<!-- LIST-TABS-ON: CLASSE UTILIZADA PARA ATIVAR O CARROSSEL DE ABAS -->
				<div class="list-tabs list-tabs--on-off">
					<div class="box-tabs__control">
						<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
						<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
					</div>
					<div class="container">
						<ul class="list-tabs__main">
							<?php
								$contador = 0;
								foreach ($contents as $key => $content):
							?>

								<li class="<?php echo $contador == 0 ? 'active' : ''; ?>"><a href="#content-tab-<?php echo $key; ?>"><?php echo $content['title']; ?></a></li>

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
						<div id="content-tab-<?php echo $key; ?>" class="content-tab__content content-tab__content--two-columns <?php echo $contador == 0 ? 'active' : ''; ?>">
							<!-- <h3 class="title-h4 content-tab__title"><?php echo $content['title'] ?></h3> -->
							<?php echo apply_filters('the_content', $content['content']); ?>
						</div>
					<?php
						$contador++;
						endforeach;
					?>
				</div>

			</section>
		</div>

		<!-- ACERVO -->
		<div class="mb-100">
			<?php
				$collections = new WP_Query([
					'post_type' => 'tainacan-collection',
					'posts_per_page' => -1
				]); 
				$url_title = get_post_type_archive_link('tainacan-collection');
				funarte_load_part('collections-carousel', ['title'=>'Acervo CEDOC', 'collections' => $collections ]); 
				wp_reset_postdata();
			?>
		</div>
		<!-- FIM ACERVO -->
		
		<div class="mb-100">
			<section class="cedoc-avisos">
				<div class="content-tab">
					<div class="content-tab__content content-tab__content--two-columns">
						<?php the_content(); ?>
					</div>
				</div>
			</section>
		</div> 
	</div>
</main>
	
<?php get_footer(); ?>