<?php
/**
 * items: array of item
 * 			item: one array = ['tag_class_area'=>'', 'tag_name_area'=>'', 'tag_url_area'=>'', 'tag_subname_area'=>'', 'title' => '' , 'url'=>'' , 'content'=>'']
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
	$flag = true;
	foreach ($items as $item):
		if (isset($item['url_img']) && $item['url_img'] != null ):
			$url_img = $item['url_img'];
		else:
			$url_img = funarte_get_img_default($item['tag_class_area']);
		endif;

		$tag_url = isset($item['tag_url_area']) ? $item['tag_url_area'] : '#';
		$li .= "<li class='color-" . $item['tag_class_area'] . "'>
							<div class='link-area'>
								<a href='$tag_url'>" . $item['tag_name_area'] . "</a>
							</div>
							<div class='box-news__image' style='background-image: url($url_img);'></div>
							<h3 class='news-title'>" . $item['title'] . "</h3>
							<span>" . $item['content'] . "</span>
							<a href='" . $item['url'] . "' class='link-more'>Ler mais</a>
						</li>";
		if($col++ == $number_cols-1) {
			//<!-- SÓ A PRIMEIRA UL VEM COM A CLASSE VISIBLE -->
			if ($flag) {
				$ul .= "<ul class='box-news__list visible'>$li</ul>";
				$flag = false;
			}	else {
				$ul .= "<ul class='box-news__list'>$li</ul>";;
			}
			$li = "";
			$col = 0; 
		}
	endforeach;
?>
	<section class="box-news mb-100">
		<div class="container">
			<h2 class="title-1 mb-44"><a href="<?php echo $more_news_url;?>">Notícias</a></h2>
			<?php echo $ul; ?>
			<a href="<?php echo $more_news_url;?>" class="box-news__load"><i class="mdi mdi-chevron-down"></i><i class="mdi mdi-plus"></i><span class="sr-only">Ver mais</span></a>
		</div>
	</section>
<?php endif; ?>