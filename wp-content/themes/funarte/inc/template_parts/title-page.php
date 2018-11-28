<?php
/**
 * texto: o texto de denro... 
 * 
 */
if(!isset($tag) || !isset($title) || !isset($img)) :
	echo "<br><b> parameter not found! </b> <br>";
else : 
 ?>
<div class="box-title-page box-title-page--image color-artes-visuais">
	<ul class="link-area">
		<li class="color-funarte">
			<a href="#"><?php echo $tag; ?></a>
		</li>
	</ul>
	<h3 class="title-page">
		<?php echo $title; ?>
	</h3>
	<img src="<?php echo $img ?>" alt="<?php echo $title; ?>">
</div>
<?php endif;