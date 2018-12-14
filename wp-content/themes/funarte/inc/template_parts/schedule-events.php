<?php
/**
 * items: array of item
 *	item: one array = ['tag_class_area'=>'',
 *										 'url_img'=>'',
 *										 'title'=>'',
 *										 'month'=>'',
 *										 'day'=>'',
 *										 'schedule'=>'',
 *										 'local'=>'',
 *										 'content'=>'',
 *										 'url'=>'']
 */
if(!isset($items)):
	echo "<br><b> parameter not found! </b><br>";
else:
	$id = 0;
?>
<section class="box-carousel-schedule mb-100">
	<h2 class="title-1">Agenda Cultural</h2>

	<div class="carousel-schedule__wrapper">
		<div class="carousel-schedule__control">
			<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
			<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
		</div>

		<div class="carousel-schedule__thumb">
		<?php foreach ($items as $item): $id++;?>
			<div class="carousel-schedule__image carousel-schedule__image-<?php echo $id; ?> <?php echo $id == 1 ? 'visible' : ''; ?>" style="background-image: url(<?php echo $item['url_img']; ?>);"></div>
		<?php endforeach; ?>
		</div>

		<ul class="carousel-schedule">
			<?php foreach ($items as $item): $id++;?>
				<li class="color-<?php echo $item['tag_class_area']; ?> <?php echo $id==2? 'active' : ''; ?>">
					<div class="carousel-schedule__body">
						<h3 class="title-2"><?php echo $item['title']; ?></h3>
						<span class="carousel-schedule__date">
							<?php echo $item['month']; ?>
							<strong><?php echo $item['day']; ?></strong>
						</span>
						<hr>
						<div class="carousel-schedule__row">
							<div class="carousel-schedule__column-1">
								<span class="carousel-schedule__time">inicia as: <?php echo $item['schedule']; ?></span>
								<span class="carousel-schedule__local"><?php echo $item['local']; ?></span>
							</div>
							<div class="carousel-schedule__column-2">
								<p><?php echo $item['content']; ?></p>
								<a href="<?php echo $item['url']; ?>" class="link-more">Ler mais</a>
							</div>
						</div>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
<?php endif; ?>