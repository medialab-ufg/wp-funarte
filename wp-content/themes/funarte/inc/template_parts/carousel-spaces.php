<?php
/**
 * $title: titulo do bloco
 * $url_title: <optional> url para o titulo
 * $espacos: lista de espaços
 */

if ( !isset($title) || !isset($espacos) ) :
	echo "<br> <b> parameter not found! </b> <br>";
else:
?>
<!-- ESPAÇO CULTURAL -->
	<div class="container">
		<div class='box-carousel-zoom mb-100'>
			<?php if (isset($url_title)) : ?>
				<h2 class="title-1"><a href="<?php echo $url_title; ?>"><?php echo $title; ?></a></h2>
			<?php else : ?>
				<h2 class="title-1"><?php echo $title; ?></h2>
			<?php endif; ?>

			<div class="carousel-zoom__wrapper">
				<div class="carousel-zoom__control">
					<button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
					<button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
				</div>

				<ul class="carousel-zoom">
					<li class="carousel-zoom__item">
						<div class="carousel-zoom__image"></div>
					</li>
				<?php
					$contador = 0;
					foreach ($espacos as $espaco) :
						$estado = get_post_meta($espaco->ID, 'espaco-estado', true);
						$url_img = has_post_thumbnail($espaco->ID) ? get_the_post_thumbnail_url($espaco->ID) : funarte_get_img_default();
					?>
						<li class="color-funarte carousel-zoom__item-<?php echo $contador++%3; ?>">
							<div class="link-area">
								<strong><?php echo $estado ?></strong>
							</div>
							<div class="carousel-zoom__image" style="background-image: url('<?php echo $url_img ?>');"></div>

							<div class="carousel-zoom__text">
								<strong><?php echo esc_attr($espaco->post_title) ?></strong>
								<p><?php echo \funarte\EspacoCultural::get_instance()->formata_endereco($espaco->ID) ?> - <?php echo get_post_meta($espaco->ID, 'espaco-telefone1', true) ?></p>
								<a class="link-more" href="<?php echo get_permalink($espaco->ID) ?>">Ler mais</a>
							</div>
						</li>
					<?php endforeach; ?>
					<li class="carousel-zoom__item">
						<div class="carousel-zoom__image"></div>
					</li>
				</ul>
			</div>
		</div>
	</div>
<!-- FIM ESPAÇO CULTURAL -->
<?php endif; ?>