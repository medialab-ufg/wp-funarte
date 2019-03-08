<?php
/**
 */
if ( ( !isset($titles) && sizeof($titles) > 0 ) ) :
	echo "<br> <b> parameter not found! </b> <br>";
else:
?>
	<div class="box-title">
		<h2 class="title-h1">
			<?php echo $titles[0]; ?>
			<?php if (isset($titles[1])): ?><span><?php echo $titles[1]; ?></span> <?php endif; ?>
			<?php if ( isset($social_list) ): ?>
				<span class="tooltip-social-media">
					<button type="button"><i class="mdi mdi-share-variant"></i></button>
					<span class="tooltip-social-media__box">
						<?php echo $social_list; ?>
						<!-- <ul>
							<li><a href="#" class="tooltip-social-media__facebook" target="_blank"><i class="mdi mdi-facebook"></i></a></li>
							<li><a href="#" class="tooltip-social-media__twitter" target="_blank"><i class="mdi mdi-twitter"></i></a></li>
							<li class="whatsapp-item"><a href="#" data-action="share/whatsapp/share" class="tooltip-social-media__whatsapp" target="_blank"><i class="mdi mdi-whatsapp"></i></a></li>
							<li><a href="#" class="tooltip-social-media__linkedin" target="_blank"><i class="mdi mdi-linkedin"></i></a></li>
							<li><a href="#" class="tooltip-social-media__pinterest" target="_blank"><i class="mdi mdi-pinterest"></i></a></li>
							<li><a href="#" class="tooltip-social-media__email" target="_blank"><i>@</i></a></li>
						</ul> -->
					</span>
				</span>
			<?php endif; ?>
		</h2>
	</div>
<?php endif; ?>