<?php
/**
 * items: array of item
 * 			item: one array = ['tag_class_area'=>'', 'tag_name_area'=>'', 'tag_url_area'=>'', 'tag_subname_area'=>'', 'title' => '' , 'url'=>'' , 'content'=>'', 'subtitle'=>'']
 * more_news_url: url to page of news
 */
if(!isset($number_cols)):
	$number_cols = 3;
endif;
if(!isset($items)):
	echo "<br><b> parameter not found! </b><br>";
else:
	$col = 0; 
	$ul = "";
	$li = "";
	$visible = "";
	$flag = true;
	foreach ($items as $item):
		if (isset($item['url_img']) && $item['url_img'] != null ):
			$url_img = $item['url_img'];
		else:
			$url_img = funarte_get_img_default($item['tag_class_area']);
		endif;

		if( isset($item['tag_url_area']) && !empty($item['tag_url_area']) ) {
			$tag_url = "<a href='" . $item['tag_url_area'] . "'>" . $item['tag_name_area'] . "</a>";
		} else {
			$tag_url = "<strong>" . $item['tag_name_area'] . "</strong>";
		}

		$visible = $col < $number_cols ? " visible" : "";
		$col++;
		$li .= "<li class='color-" . $item['tag_class_area'] . $visible . "'>
							<div class='link-area'>
								$tag_url
							</div>
							<a href='" . $item['url'] . "'><span class='box-news__image' style='background-image: url($url_img);'></span></a>
							<h3 class='news-title'><a href='" . $item['url'] . "'>" . $item['title'] . "</a></h3>
							<p class='news-subtitle'>" . (isset($item['subtitle']) ? $item['subtitle'] : '' ) . "</p>
							<p>" . $item['content'] . "</p>
							<a href='" . $item['url'] . "' class='link-more'>Ler mais</a>
						</li>";
	endforeach;
?>
	<section class="box-news mb-100">
		<div class="container">
			<h2 class="title-1 mb-44"><a href="<?php echo $more_news_url;?>">Notícias</a></h2>
			<ul class="box-news__list">
				<?php echo $li; ?>
			</ul>
			<a href="<?php echo $more_news_url;?>" class="box-news__load"><i class="mdi mdi-chevron-down"></i><i class="mdi mdi-plus"></i><span class="sr-only">Ver mais</span></a>
		</div>
	</section>
<?php endif; ?>