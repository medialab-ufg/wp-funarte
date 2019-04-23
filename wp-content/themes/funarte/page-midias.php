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
								<?php $url = get_post_meta($video->ID, 'midia-video-url', true); ?>
								<li>
									<div class="box-carousel-audio__row-1">
										<div class="video-player">
											<div class="link-area">
												<a class="color-funarte" href="#">Vídeo</a>
											</div>
											<?php
												$youtube = explode('?v=', $url);
												if ( ! empty($youtube[1]) ):
											?>

												<iframe class="video-player__youtube" src="https://www.youtube.com/embed/<?php echo $youtube[1]; ?>" frameborder="0" allowfullscreen></iframe>

											<?php else: ?>

												<video autoplay src="<?php echo $url; ?>" class="video-video"></video>
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

		<div class="box-social-media">
			<div class="box-social-media__box-twitter">
				<div class="box-social-media__box-scroll color-funarte">
					<div class="link-area">
						<strong class="color-funarte">Twitter</strong>
					</div>
					<a class="twitter-timeline" data-theme="light" href="https://twitter.com/Funarte?ref_src=twsrc%5Etfw">Tweets by Funarte</a>
					<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
				</div>
			</div>

			<div class="box-social-media__box-facebook">
				<div class="box-social-media__box-scroll color-funarte">
					<div class="link-area">
						<strong class="color-funarte">Facebook</strong>
					</div>
					<div id="fb-root"></div>
					<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.2"></script>
					<div class="fb-page" data-href="https://www.facebook.com/funarte" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/funarte" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/funarte">Funarte</a></blockquote></div>
				</div>
			</div>

			<div class="box-social-media__box-instagram">
				<div id="instagram-feed" class="box-social-media__box-scroll color-funarte">
					<div class="link-area">
						<strong class="color-funarte">Instagram</strong>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
?>