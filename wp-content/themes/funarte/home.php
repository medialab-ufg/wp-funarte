<?php

$categoria = (isset($_GET['area'])) ? get_category_by_name($_GET['area']) : false;

if (!empty($categoria))
	$bodyClass = $categoria->slug;

get_header();

$params = array();
if ($categoria)
	$params['cat'] = (int)$categoria->term_id;

query_posts(array_merge(array(
	'post_type' => 'post',
	'posts_per_page' => 12,
	'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
	'orderby' => 'date',
	'order' => 'DESC'
), $params));
?>

	<main role="main">
		<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
		<div class="container">

			<?php
				$links = [['link_name'=>'Notícias']];
				funarte_load_part('breadcrumb', ['links'=>$links]);
			?>

			<div class="box-title">
				<h2 class="title-h1 mb-30">Notícias<span>Recentes</span></h2>

				<div class="box-forms">
					<form class="form-area" action="#" method="get">
						<fieldset>
							<legend>Formulário de seleção de área</legend>
							<?php
							wp_dropdown_categories(array(
								'show_option_none' => 'Filtrar por área',
								'option_none_value' => '',
								'hide_empty' => true,
								'id' => 'select-categoria',
								'class' => 'select_area',
								'name' => 'area',
								'value_field' => 'slug',
								'selected' => (isset($categoria->slug)) ? $categoria->slug : null));
							?>
						</fieldset>
					</form>
				</div>
			</div>
		</div>

		<section class="box-news">
			<div class="container">
				<ul class='box-news__list box-news__list--interna'>
					<?php if (have_posts()) :	while (have_posts()) :
						the_post();
						$area = get_area_class(get_the_ID());
						//$area = get_the_category()[0];
						?>
						<li class='color-<?php echo $area['slug']; ?>'>
							<div class='link-area'>
								<?php if( isset($area['ID']) ): ?>
									<a class="<?php echo 'color-' . $area['slug']; ?>" href="<?php echo get_category_link( $area['ID'] ); ?>"><?php echo $area['name']; ?></a>
								<?php else: ?>
									<strong class="<?php echo 'color-' . $area['slug']; ?>"><?php echo $area['name']; ?></strong>
								<?php endif; ?>
							</div>

							<a href='<?php the_permalink();  ?>'>
								<?php
									if (has_post_thumbnail()):
								?>
										<div class="box-news__image" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'funarte-medium'); ?>');"></div>
								<?php else:?>
										<div class="box-news__image" style="background-image: url('<?php echo funarte_get_img_default($area->slug); ?>');"></div>
								<?php endif; ?>
							</a>
							<h3 class='news-title'>
								<a href='<?php the_permalink();  ?>'>
									<?php the_title(); ?>
								</a>
							</h3>

							<?php if (get_the_subtitle()): ?>
								<p class="news-subtitle">
									<?php echo wp_trim_words(get_the_subtitle(),11); ?>
								</p>
							<?php endif; ?>

							<p><?php echo wp_trim_words(get_the_excerpt(),21); ?></p>

							<a href='<?php the_permalink();  ?>' class='link-more'>Ler mais</a>
						</li>
					<?php
					endwhile;
					echo get_pagination();
					endif; ?>
				</ul>
			</div>
		</section>
	</main>
<?php get_footer(); ?>