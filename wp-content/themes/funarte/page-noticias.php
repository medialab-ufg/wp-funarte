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
			<?php include('inc/template_parts/breadcrumb.php'); ?>

			<div class="box-title">
				<h2 class="title-h1"><a href="<?php echo get_bloginfo('url') . '/noticias'; ?>">Notícias</a> <a href="#"><span>Recentes</span></a> </h2>
			</div>
		</div>

		<section class="box-news mb-100">
			<div class="container">
				<ul class='box-news__list visible'>
					<?php if (have_posts()) :	while (have_posts()) : 
						the_post();
						$area = get_the_category()[0];
						?>
						<li class='color-<?php echo $area->slug; ?>'>
							<div class='link-area'>
									<a href='#'><?php echo $area->name; ?></a>
							</div>
							<?php 
								if (has_post_thumbnail()):
									the_post_thumbnail('medium', array('title' => esc_attr(get_the_title()), 'width' => 120, 'height' => 90)); 
								else:?>
									<img src='<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>' alt='<?php esc_attr(get_the_title()); ?>'>
							<?php endif; ?>
							<h3 class='news-title'><?php the_title(); ?></h3>
							<span></span>
							<a href='<?php the_permalink();  ?>' class='link-more'>Ler mais</a>
						</li>
					<?php endwhile;	endif; ?>
				</ul>
			</div>
		</section>
	</main>
<?php get_footer(); ?>