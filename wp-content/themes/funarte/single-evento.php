<?php 
	get_header(); 

	// if (get_single_category()) {
	// 	$area = get_single_category();
	// 	if ($area->name == 'Estúdio F')
	// 		$area = get_category_by_name('Música');
	// 	$Breadcrumb->addBread($area->name, get_bloginfo('url') . '/agenda-cultural/?area=' . $area->slug);
	// }
?>

<?php if(have_posts()) : the_post(); ?>

    <main role="main">
        <a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>

        <div class="container">
                <?php 
					$links = [
						['link_name'=>'Agenda','link_url'=>'/evento'],
						['link_name'=>get_the_title()]];
					funarte_load_part('breadcrumb', ['links'=>$links]); 
				?>
                <?php
					$areas = get_the_category();
					$tags = [];
					foreach ($areas as $area):
						$tags[] = [	'slug'=> $area->slug,
											'name'=> $area->name,
											'url_area'=> home_url() . '/category/' . $area->slug];
					endforeach;
				?>

            <div class="box-title">
                <h2 class="title-h1">Agenda cultural</h2>
            </div>
            
            <?php funarte_load_part('title-page', [	'title'=> get_the_title(),
																								'date_pub' => get_the_time(get_option('date_format')),
																								'img'  => get_the_post_thumbnail_url(),
																								'tags'=> $tags]); ?>

    

            <div class="row justify-content-between mb-100">
                <div class="col-md-6">
                    <div class="box-text">
                        
                        <?php the_content(); ?>

                        <div class="box-carousel-events">
                            <div class="carousel-events__wrapper">
                                <div class="carousel-events__control">
                                    <button type="button" class="control__next"><i class="mdi mdi-chevron-right"></i></button>
                                    <button type="button" class="control__prev"><i class="mdi mdi-chevron-left"></i></button>
                                </div>

                                <ul class="carousel-events">
                                    <li>
                                        <div class="link-area">
                                            <a class="color-teatro" href="#">Teatro</a>
                                        </div>
                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_001.jpg'; ?>" alt="Imagem">
                                        <strong>Lorem Ipsum</strong>
                                    </li>
                                    <li>
                                        <div class="link-area">
                                            <a class="color-teatro" href="#">Teatro</a>
                                        </div>
                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_001.jpg'; ?>" alt="Imagem">
                                        <strong>Lorem Ipsum</strong>
                                    </li>
                                    <li>
                                        <div class="link-area">
                                            <a class="color-teatro" href="#">Teatro</a>
                                        </div>
                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_001.jpg'; ?>" alt="Imagem">
                                        <strong>Lorem Ipsum</strong>
                                    </li>
                                    <li>
                                        <div class="link-area">
                                            <a class="color-teatro" href="#">Teatro</a>
                                        </div>
                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/fke/news_001.jpg'; ?>" alt="Imagem">
                                        <strong>Lorem Ipsum</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <aside class="content-aside">
                        <div class="box-data">
                            <h4 class="title-5">Informações</h4>

                            <div class="box-data__row">
                                <strong>Informações ao público:</strong>

                                <?php if ($ev_tel = get_post_meta(get_the_ID(), 'evento-telefone', true)): ?>
                                    <span><?php echo $ev_tel; ?></span>
                                <?php endif; ?>
                                
                                <?php if ($ev_email = get_post_meta(get_the_ID(), 'evento-email', true)): ?>
                                    <a href="mailto:<?php echo $ev_email; ?>"><?php echo $ev_email; ?></a>
                                <?php endif; ?>
                                
                                <?php if ($ev_site = get_post_meta(get_the_ID(), 'evento-link', true)): ?>
                                    <a href="<?php echo $ev_site; ?>" rel="nofollow"><?php echo $ev_site; ?></a>
                                <?php endif; ?>

                                
                            </div>

                            <?php if ($ev_local = get_post_meta(get_the_ID(), 'evento-local', true)): ?>
                               <span><b>Local:</b></span>
                               <span><?php echo $ev_local; ?></span>
                            <?php endif; ?>
                            
                            <?php if ($ev_maplink = get_post_meta(get_the_ID(), 'evento-maplink', true)): ?>
                               <h4 class="title-5">Veja como chegar</h4>

                                <div id="map">
                                    <strong>
                                        <a class="mapa" href="<?php echo $ev_maplink; ?>" title="Amplie o mapa">
                                            <img src="http://maps.google.com/maps/api/staticmap?center=-22.91788,-43.17935&amp;zoom=17&amp;size=194x120&amp;maptype=&amp;markers=size:mid|color:0x3B8313|label:A|-22.91788,-43.17935&amp;sensor=false" alt="Mapa do espaço cultural" width="194" height="120">
                                        </a>
                                    </strong>
                                </div>
                            <?php endif; ?>


                            
                        </div>

                        <div class="box-bidding">
                            <h4 class="title-h1--type-b">Mais eventos</h4>

                            <ul class="list-bidding--type-b">
                                <li class="color-danca">
                                    <div class="link-area">
                                        <a href="#">Dança</a>
                                    </div>
                                    <strong>Título lorem ipsum sit dolor amet, consectetur adispicing elit. Maecenas vel finibus quam. Vivamus eu congue metus, ac ullamcorpoer metus. Duis feugiat diam non  es...</strong>
                                    <a class="link-more" href="#">Ler mais</a>
                                </li>
                                <li class="color-artes-integradas">
                                    <div class="link-area">
                                        <a href="#">Artes Integradas</a>
                                    </div>
                                    <strong>Título lorem ipsum sit dolor amet, consectetur adispicing elit. Maecenas vel finibus quam. Vivamus eu congue metus, ac ullamcorpoer metus. Duis feugiat diam non  es...</strong>
                                    <a class="link-more" href="#">Ler mais</a>
                                </li>
                                <li class="color-circo">
                                    <div class="link-area">
                                        <a href="#">Circo</a>
                                    </div>
                                    <strong>Título lorem ipsum sit dolor amet, consectetur adispicing elit. Maecenas vel finibus quam. Vivamus eu congue metus, ac ullamcorpoer metus. Duis feugiat diam non  es...</strong>
                                    <a class="link-more" href="#">Ler mais</a>
                                </li>
                                <li class="color-multicategoria">
                                    <div class="link-area">
                                        <a href="#">Multicategoria</a>
                                    </div>
                                    <strong>Título lorem ipsum sit dolor amet, consectetur adispicing elit. Maecenas vel finibus quam. Vivamus eu congue metus, ac ullamcorpoer metus. Duis feugiat diam non  es...</strong>
                                    <a class="link-more" href="#">Ler mais</a>
                                </li>
                                <li class="color-circo">
                                    <div class="link-area">
                                        <a href="#">Circo</a>
                                    </div>
                                    <strong>Título lorem ipsum sit dolor amet, consectetur adispicing elit. Maecenas vel finibus quam. Vivamus eu congue metus, ac ullamcorpoer metus. Duis feugiat diam non  es...</strong>
                                    <a class="link-more" href="#">Ler mais</a>
                                </li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
<?php endif; ?>

<!--
<?php if ( have_posts() ) : the_post(); ?>
	
	<?php
		$areas = get_the_category();
		if (!empty($areas) && (count($areas) > 1)) { ?>
		<div class="relacionamento">
			<span>Relacionado a:
			<?php foreach ($areas AS $area) { ?>
				<small class="<?php echo $area->category_nicename; ?>"><?php echo $area->name; ?></small><?php if ($area != end($areas)) { ?>, <?php } ?>
			<?php } ?>
			</span>
		</div>
	<?php } ?>
	
	<div class="post-content" role="main">
		<h3> <?php the_title(); ?> </h3> 
		<div> <?php the_content(); ?> </div>
		<div> <?php echo get_the_date(); ?> </div>
	</div>

<?php endif; ?>
-->
<?php get_footer();
