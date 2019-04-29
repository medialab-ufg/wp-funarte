<?php
get_header(); the_post();
?>
<main role="main">
	<div class="container">

		<?php
			$links = [['link_name'=>get_the_title()]];
			funarte_load_part('breadcrumb', ['links'=>$links]);

			$areas = get_the_category();
			$tags = [];
			foreach ($areas as $area):
				$tags[] = [	'slug'=> $area->slug,
									'name'=> $area->name,
									'url_area'=> home_url() . '/category/' . $area->slug];
			endforeach;

			if(has_post_thumbnail()) {
				funarte_load_part('title-page', ['title'=> get_the_title(), 'img'  => get_the_post_thumbnail_url( ), 'tags'=> $tags]);
			} else {
				funarte_load_part('title-page', ['title'=> get_the_title(), 'img'  => [], 'tags'=> $tags]);
			}
		?>
		<div class="box-text mb-100">
			<div class="box-text__text">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</main>
	
<?php get_footer(); ?>