<?php
/**
 * tags: array of tag
 * title:
 * img:
 * 
 */
if( !isset($title) || !isset($img) ) :
	echo "<br><b> parameter not found! </b> <br>";
else :
?>
<div class="box-title-page <?php echo !empty($img) ? 'box-title-page--image' : ''; ?>">
	<div class="box-title-page__text">
		<div class="link-area">
			<?php if (isset($tags)) : ?>
					<?php foreach ($tags as $tag): ?>
					<?php if(isset($tag['url_area'])): ?>
						<a href="<?php echo home_url() . '/category/' . $tag['slug']; ?>" class="color-<?php echo $tag['slug']; ?>"><?php echo $tag['name']; ?></a>
					<?php else: ?>
						<strong class="color-<?php echo $tag['slug']; ?>"><?php echo $tag['name']; ?></strong>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<?php if(isset($date_pub)): ?>
			<div class="box-text__date">
				<small>Publicado em <?php echo $date_pub; ?></small>
			</div>
		<?php endif; ?>

		<h3 class="title-page"><?php the_title(); ?></h3>
	</div>

	<?php if (!empty($img)): ?>
		<div class="box-title-page__thumb">
			<img src="<?php echo $img ?>" alt="<?php echo $title; ?>">
			<span class="box-title-page__caption"><?php the_post_thumbnail_caption(); ?></span>
		</div>
	<?php endif; ?>
</div>
<?php endif;