<?php
/**
 * Template Name: Caixa Mais informações e links
 */
get_header();


if(have_posts()) : the_post();
?>

<main role="main" class="mb-100">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
	<div class="container">

		<?php
			$links = [
				['link_name'=>get_the_title()]];
			funarte_load_part('breadcrumb', ['links'=>$links]); 
		?>

		<div class="box-title">
			<h2 class="title-h1">Funarte <!--<span>Representações Regionais</span>--></h2>
		</div>

		<?php $imagem = get_the_post_thumbnail( get_the_ID(),'large'); ?>

		<?php funarte_load_part('title-page', ['title'=> get_the_title(), 
			'img'  => get_the_post_thumbnail_url(get_the_ID() ),
		]); ?>

		<div class="row justify-content-between">
			<div class="col-md-6">
				<div class="box-text">
					<h4 class="title-5--type-b">Sobre</h4>
					<div class="box-text__text">
						<?php the_content(); ?>
					</div>
				</div>

				
			</div>

			<div class="col-md-5">
				<aside class="content-aside">
					<div class="box-data">
						<h4 class="title-5">Informações</h4>

						<div class="box-data__row">
							<span><?php echo \Funarte\MetaboxMaisInformacoes::get_instance()->get_value(get_the_ID(), 'content'); ?></span>
							
							<?php
								if ( \Funarte\MetaboxMaisInformacoes::get_instance()->get_value(get_the_ID(), 'mais_content') ) : ?>
									<div class="box-info__collapse">
										<button class="collapse__button" type="button">
											Exibir todos os contatos
										</button>
										<div class="collapse__text">
											<span>
											<?php echo \Funarte\MetaboxMaisInformacoes::get_instance()->get_value(get_the_ID(), 'mais_content'); ?>
											</span>
										</div>
									</div>
								<?php endif;
							?>
						</div>
						
					</div>
				</aside>
			</div>
		</div>
	</div>
</main>

<?php
endif;
get_footer();
?>
