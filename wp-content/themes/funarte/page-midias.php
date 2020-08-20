<?php
get_header();
$audios = \funarte\MidiaAudio::get_instance()->get_audios();
$videos = \funarte\MidiaVideo::get_instance()->get_videos();
?>

<main role="main">
	<div class="container">
		<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>

		<div class="box-title">
			<h2 class="title-h1 mb-50">Notícias<span>Mídias</span></h2>
		</div>

		<div class="box-carousels-news mb-90">
			<div class="box-carousel-audio">

				<?php if ( ! empty($videos) ): ?>
					<div class="box-carousel-audio__control">
						<button type="button" class="control__prev slick-arrow"><i class="mdi mdi-chevron-up"></i></button>
						<button type="button" class="control__next slick-arrow"><i class="mdi mdi-chevron-down"></i></button>
					</div>

					<div class="video-list">
						<ul class="carousel-audio">
							<?php foreach($videos as $video): ?>
								<?php 
									$url = get_post_meta($video->ID, 'midia-video-url', true); 
									$thumbnail_video = get_the_post_thumbnail_url( $video->ID,'medium') ? get_the_post_thumbnail_url( $video->ID,'medium') : '';
								?>
								<li>
									<div class="box-carousel-audio__row-1">
										<div class="video-player">
											<div class="link-area">
												<a class="color-funarte" href="#">Vídeo</a>
											</div>
											<?php
												$youtube = get_youtube_video_ID($url);
												if ( $youtube != false ):
											?>

												<iframe class="video-player__youtube" src="https://www.youtube.com/embed/<?php echo $youtube; ?>" frameborder="0" allowfullscreen></iframe>

											<?php else: ?>

												<?php if ($thumbnail_video): ?>
													<img src="<?php echo $thumbnail_video; ?>" alt="Vídeo" class="video-player__thumb">
												<?php endif; ?>
												
												<video src="<?php echo $url; ?>" class="video-video"></video>
												<div class="video-bar">
													<button type="button" class="video-play"><i class="mdi mdi-play"></i></button>
													<button type="button" class="video-pause inativo"><i class="mdi mdi-pause"></i></button>
													<div class="video-progress">
														<div class="video-progress__background">
															<div class="video-progress__bar"></div>
														</div>
													</div>
													<div class="video-current"></div>
													<div class="video-duration"></div>
													<button type="button" class="video-volume"><i class="mdi mdi-volume-high"></i><i class="mdi mdi-volume-mute"></i></button>
													<button type="button" class="video-full"><i class="mdi mdi-fullscreen"></i></button>
												</div>

											<?php endif; ?>
										</div>
									</div>
									<div class="box-carousel-audio__row-2">
										<div class="box-carousel-audio__info">
											<strong><?php echo $video->post_title; ?></strong>

											<?php
												$string = (strlen($video->post_content) > 200) ? substr($video->post_content,0,200).'...' : $video->post_content;
												echo '<p>' . $string . '</p>';
											?>
										</div>
									</div>
								</li>
							<?php endforeach;?>
						</ul>
					</div>
				<?php endif; ?>
			</div>

			<div class="box-bidding box-bidding--type-b">

				<?php if ( ! empty($audios) ): ?>
					<div class="carousel-bidding--type-b__control">
						<button type="button" class="control__prev slick-arrow"><i class="mdi mdi-chevron-up"></i></button>
						<button type="button" class="control__next slick-arrow"><i class="mdi mdi-chevron-down"></i></button>
					</div>

					<ul class="list-bidding--type-b box-bidding--type-b__carousel">
						<?php foreach($audios as $audio): ?>
							<?php $url = get_post_meta($audio->ID, 'midia-audio-url', true); ?>
							<li class="color-funarte">
								<div class="link-area">
									<strong class="color-funarte">Áudio</strong>
								</div>
								<strong><?php echo $audio->post_title; ?></strong>
								<a class="link-more" href="<?php echo $url; ?>" target="_blank">Ler mais</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>

	</div>
</main>

<?php
get_footer();
?>
