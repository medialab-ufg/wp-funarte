<?php
/**
 * tag:
 * title:
 * img:
 * 
 */
if(!isset($tag) || !isset($title) || !isset($img) || !isset($tag_class_area)) :
	echo "<br><b> parameter not found! </b> <br>";
else :
 ?>
<div class="box-title-page <?php echo !empty($img) ? 'box-title-page--image' : ''; ?>">
	<div class="link-area">
		<a class="color-<?php echo $tag_class_area; ?>" href="#"><?php echo $tag; ?></a>
	</div>
	<h3 class="title-page">
		<?php echo $title; ?>
	</h3>

	<?php if (!empty($img)): ?>
		<img src="<?php echo $img ?>" alt="<?php echo $title; ?>">
	<?php endif; ?>
</div>
<?php endif;