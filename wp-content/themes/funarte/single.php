<?php
global $wp;
$pagina = home_url( $wp->request );

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
				$social_list = "<ul>
													<li><a href='http://www.facebook.com/sharer.php?u=$pagina' class='tooltip-social-media__facebook' target='_blank'><i class='mdi mdi-facebook'></i></a></li>
													<li><a href='http://twitter.com/share?url=$pagina' class='tooltip-social-media__twitter' target='_blank'><i class='mdi mdi-twitter'></i></a></li>
													<li class='whatsapp-item'><a href='whatsapp://send?text=$pagina' data-action='share/whatsapp/share' class='tooltip-social-media__whatsapp' target='_blank'><i class='mdi mdi-whatsapp'></i></a></li>
												</ul>";
				funarte_load_part('box-title', ['titles'=>['Funarte', 'Notícias'], 'social_list' => $social_list ]); 
			?>

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

			<?php 
				funarte_load_part('title-page', [
					'title'=> get_the_title(), 
					'img'  => get_the_post_thumbnail_url( get_the_ID(), 'funarte-medium' ), 
					'tags'=> $tags,
					'date_pub' => get_the_date()
				]);
				$qtd_columns = get_post_meta( get_the_ID(), "post-quantity-columns");
				$show_two_columns_class = (isset($qtd_columns[0]) && $qtd_columns[0] == "2") ? 'box-text--2-columns' : '' ;
			?>
			<div class="box-text <?php echo $show_two_columns_class; ?> mb-100">
				<div class="box-text__text">
					<?php the_content(); ?>
				</div>
			</div>

			<!-- <section class="box-carousel-image">
				<div class="carousel-image__wrapper">
					<div class="carousel-image__control">
						<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
						<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
					</div>
					<ul class="carousel-image">
						<li>
							<a href="#"><img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>" alt=""></a>
						</li>
						<li>
							<a href="#"><img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>" alt=""></a>
						</li>
						<li>
							<a href="#"><img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>" alt=""></a>
						</li>
						<li>
							<a href="#"><img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>" alt=""></a>
						</li>
						<li>
							<a href="#"><img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_003.jpg'; ?>" alt=""></a>
						</li>
					</ul>
				</div>
			</section> -->

			<?php
				$tax = \Tainacan\Repositories\Taxonomies::get_instance()->fetch_one(['name'=>'Assunto']);
				if ($tax instanceof \Tainacan\Entities\Taxonomy):
					$slug_taxonomia = $tax->get_db_identifier();
					$terms = get_the_terms(get_the_ID(), $slug_taxonomia);
					if (!empty($terms)):
						$terms_slugs = array_map(function($el) { return $el->slug; }, $terms);
						$link_more = get_term_link($terms[0]->term_id);
						$loop = new WP_Query([
							'posts_per_page' => 3,
							'post_type' => \Tainacan\Repositories\Repository::get_collections_db_identifiers(),
							'tax_query' => [
								[
									['taxonomy' => $slug_taxonomia, 'field' => 'slug', 'terms' => $terms_slugs]
								]
							]
						]);
						?>

						<section class="box-related-links color-funarte">
							<h3 class="box-carousel-attachments__title">Links relacionados</h3>
							<ul class="box-related-links__list">
								<?php 
									while ( $loop->have_posts() ) : $loop->the_post();
									$image = has_post_thumbnail() ? get_the_post_thumbnail_url()  : funarte_get_img_default( );
								?>
									<li>
										<img src="<?php echo $image; ?>" alt="Imagem">
										<a href="<?php echo get_permalink() ?>"><span><?php echo get_the_title(); ?></span></a>
									</li>
								<?php
									endwhile;
								?>
							</ul>
							<a href="<?php echo $link_more; ?>" class="link-more--type-b"><i class="mdi mdi-plus"></i></a>
						</section>
					<?php
					wp_reset_query();
					endif;
				endif;
				?>
		</div>
	</main>
<?php
endif;
get_footer();
?>
