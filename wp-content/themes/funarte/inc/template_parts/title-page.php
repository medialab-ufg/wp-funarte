<?php
/**
 * tag:
 * title:
 * img:
 * 
 */
if(!isset($tag) || !isset($title) || !isset($img) || !isset($tag_class_area) ) :
	echo "<br><b> parameter not found! </b> <br>";
else :
?>
<div class="box-title-page <?php echo !empty($img) ? 'box-title-page--image' : ''; ?>">
	<div class="link-area">
		<?php if(isset($tag_url_area)): ?>
			<a class="color-<?php echo $tag_class_area; ?>" href="<?php echo $tag_url_area; ?>"><?php echo $tag; ?></a>
		<?php else: ?>
			<strong class="color-<?php echo $tag_class_area; ?>"><?php echo $tag; ?></strong>
		<?php endif; ?>
	</div>
	<h3 class="title-page">
		<?php echo $title; ?>
	</h3>

	<?php if (!empty($img)): ?>
		<div class="box-title-page__thumb">
			<img src="<?php echo $img ?>" alt="<?php echo $title; ?>">
			<span class="box-title-page__caption"><?php the_post_thumbnail_caption(); ?></span>
		</div>
	<?php endif; ?>
</div>
<?php endif;