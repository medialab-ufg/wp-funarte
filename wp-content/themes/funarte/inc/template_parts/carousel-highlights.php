<?php
/**
 * items: array of item
 * item: one array = ['img_url'=>'img_url','title'=>'title','descricao'=>'descricao', 'url'=>'URL']
 * 
 */
if(!isset($items)):
	echo "<br><b> parameter not found! </b><br>";
else:
?>
<section class="box-carousel-highlights">
	<div class="carousel-highlights__control">
		<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
		<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
	</div>
	<ul class="carousel-highlights">
		<?php foreach ($items as $item): ?>
			<li>
				<a href="<?php echo $item['url'];?>" title="<?php echo $item['title'];?>">
				<img src="<?php echo $item['img_url'];?>" alt="<?php echo $item['title'];?>">
				</a>
				<div class="carousel-highlights__caption">
					<strong><a href="<?php echo $item['url'];?>" title="<?php echo $item['title'];?>"><?php echo $item['title'];?></a></strong>
					<span><a href="<?php echo $item['url'];?>" title="<?php echo $item['title'];?>"><?php echo $item['descricao'];?></a></span>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
<?php endif; ?>