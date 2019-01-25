<?php
get_header();
if(have_posts()) : the_post();
?>
	<main role="main" class="mb-100">
		<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>
		<div class="container">
			<?php
				$links = [
					['link_name'=>'Notícias','link_url'=>'/noticias'],
					['link_name'=>get_the_title()]];
				funarte_load_part('breadcrumb', ['links'=>$links]); 
			?>

			<div class="box-title">
				<h2 class="title-h1">Funarte<span>Notícias</span></h2>
			</div>

			<?php
				$imagem = get_the_post_thumbnail( );
				$areas = get_the_category();
				$tags = [];
				foreach ($areas as $area):
					$tags[] = [	'slug'=> $area->slug,
											'name'=> $area->name,
											'url_area'=> home_url() . '/category/' . $area->slug];
				endforeach;
			?>

			<?php funarte_load_part('title-page', ['title'=> get_the_title(), 'img'  => get_the_post_thumbnail_url( ),
																						'tags'=> $tags]); ?>

			<div class="box-text box-text--2-columns mb-100">
				<div class="box-text__text">
					<?php the_content(); ?>
				</div>
			</div>

			<?php
				$tax = \Tainacan\Repositories\Taxonomies::get_instance()->fetch_one(['slug'=>'assunto']);
				$slug_taxonomia = $tax->get_db_identifier();
				$terms = get_the_terms(get_the_ID(), $slug_taxonomia);
				$terms_slugs = array_map(function($el) { return $el->slug; }, $terms);

				$loop = new WP_Query([
    			'posts_per_page' => 3,
					'post_type' => \Tainacan\Repositories\Repository::get_collections_db_identifiers(),
					'taxonomy' => [
						'tax_query' => [
							['field' => 'slug', 'terms' => $terms_slugs]
						]
					]
				]);

				while ( $loop->have_posts() ) : $loop->the_post();
					the_title();
					$image = has_post_thumbnail() ? get_the_post_thumbnail_url()  : funarte_get_img_default( );
					echo $image;
				endwhile;
			?>
		</div>
	</main>
<?php
endif;
get_footer();
?>