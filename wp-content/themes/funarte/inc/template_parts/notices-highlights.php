<?php
/**
 * title: title
 * items: array of item
 * 			item: one array = ['tag_class_area'=>'', 'tag_name_area'=>'', 'tag_url_area'=>'', 'tag_subname_area'=>'', 'title' => '' , 'url'=>'']
 * destaque: ['tag_class_area'=>'', 'tag_name_area'=>'', 'url'=>'', 'content'=>'', 'title'=>'', 'img_url'=>'']
 *
 */
if(!isset($title) || !isset($items) || !isset($destaque)):
	echo "<br><b> parameter not found! </b><br>";
else:
?>
<div class="box-notices-highlight mb-100">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-6">
				<section class="box-carousel-notices">
					<?php if (isset($url_title)): ?>
						<h2 class="title-1 mb-60"><a href="<?php echo $url_title; ?>"><?php echo $title ?></a></h2>
					<?php else: ?>
					<h2 class="title-1 mb-60"><?php echo $title ?></h2>
					<?php endif; ?>
					<div class="carousel-notices__wrapper">
						<div class="carousel-notices__control">
							<button type="button" class="control__prev"><i class="mdi mdi-chevron-up"></i></button>
							<button type="button" class="control__next"><i class="mdi mdi-chevron-down"></i></button>
						</div>
						<ul class="carousel-notices">
							<?php foreach ($items as $item): ?>
								<li>
									<div class="link-area">
										<?php if( isset($item['tag_url_area']) && !empty($item['tag_url_area']) ):
											$tag_url = isset($item['tag_url_area']) ? $item['tag_url_area'] : '#'; ?>
											<a class="color-<?php echo $item['tag_class_area']; ?>" href="<?php echo $tag_url; ?>">
												<?php echo $item['tag_name_area']; ?>
											</a>
										<?php else: ?>
											<strong class="color-<?php echo $item['tag_class_area']; ?>">
												<?php echo $item['tag_name_area']; ?>
											</strong>
										<?php endif; ?>
										<span><?php echo $item['tag_subname_area']; ?></span>
									</div>
									<h3 class="title-4 title-4--type-b"><?php echo $item['title']; ?></h3>
									<a href="<?php echo $item['url']; ?>" class="link-more">Ler mais</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</section>
			</div>
				<div class="col-xs-12 col-lg-6">
					<section class="box-highlight color-<?php echo $destaque['tag_class_area']; ?>">
						<h2 class="title-1">Destaque</h2>
						<a href="<?php echo $destaque['url'];?>">
							<div class="box-highlight__image-wrapper">
								<div class="box-highlight__image" style="background-image: url(<?php echo $destaque['img_url'] ?>);"></div>
							</div>
						</a>
						<div class="link-area">
							<strong class="color-<?php echo $destaque['tag_class_area']; ?>" href="#"><?php echo $destaque['tag_name_area']; ?></strong>
						</div>
						<h3 class="title-3">
							<a href="<?php echo $destaque['url'];?>">
								<?php echo $destaque['title']; ?>
							</a>
						</h3>
						<p><?php echo $destaque['content']; ?></p>
						<a href="<?php echo $destaque['url'];?>" class="link-more">Ler mais</a>
					</section>
				</div>
			</div>
		</div>
	</div>
  <?php endif; ?>
