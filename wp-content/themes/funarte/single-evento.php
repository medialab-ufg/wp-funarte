<?php 
	get_header(); 

	// if (get_single_category()) {
	// 	$area = get_single_category();
	// 	if ($area->name == 'Estúdio F')
	// 		$area = get_category_by_name('Música');
	// 	$Breadcrumb->addBread($area->name, get_bloginfo('url') . '/agenda-cultural/?area=' . $area->slug);
	// }
?>
<main role="main">
	<a href="#content" id="content" name="content" class="sr-only">Início do conteúdo</a>

	<div class="container">
		<div class="box-breadcrumb">
			<a class="box-breadcrumb__home" href="/"><i class="mdi mdi-home"></i></a>
			<a href="/evento">Agenda cultural</a>
			<span>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy</span>
		</div>

		<div class="box-title">
			<h2 class="title-h1">Agenda cultural</h2>
		</div>

		<div class="box-title-page box-title-page--image">
			<div class="box-title-page__text">
				<div class="link-area">
					<a href="<?php echo home_url() . '/category/artes-visuais' ?>" class="color-artes-visuais">Artes Visuais</a>
				</div>

				<h3 class="title-page">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy</h3>
			</div>

			<div class="box-title-page__thumb">
				<img src="http://localhost.funarte/wp-content/uploads/2010/11/espacos-culturais-casa-de-paschoal-carlos-magno.jpg" alt="Casa Funarte Paschoal Carlos Magno – Teatro Funarte Duse">
				<span class="box-title-page__caption">Casa de Paschoal Carlos Magno / Teatro Funarte Duse</span>
			</div>
		</div>

		<div class="row justify-content-between mb-100">
			<div class="col-md-6">
				<div class="box-text">
					<h4 class="title-5">Sinopse</h4>

					<div class="box-text__text">
						<p>Quando os vilões estão reunidos, sob o comando da malvada bruxa Karina, tudo pode acontecer. Um plano para dominar o Mundo da Fantasia tem Ca-pitão Gancho, Lobo Mau, Madrasta e Malévola ávidos pelo poder, e conta também com Sininho, que parece ser a mais nova vilã do reino. O que Karina planeja é dominar o reino da fantasia com a ajuda dos vilões, mas para isso acontecer todos os personagens precisam ser capturados. Alguns, porém, conseguiram fugir para o Mundo Real, pois sentiam que suas histórias não eram mais lidas e apreciadas pelas crianças.</p>
						<p>Para encontrar os personagens, Karina conta com o colar mágico da desa-parecida Rainha Cecilia, e confia a busca à sua mais nova aliada, Sininho. O que ninguém desconfia é que Sininho é uma espiã da Rainha Cecilia e agora as duas irão partir para o Mundo Real a fim de resgatarem os personagens fujões. Mas a tarefa não será fácil. Afinal de contas, como achar alguns per-sonagens em meio a bilhões de humanos? Usando o poder do colar e uma dose de intuição.</p>
						<p>Nessa busca, elas se deparam com uma nova Chapeuzinho Vermelho, aliás, ela nem se chama mais assim, e não é mais aquela garotinha ingênua que se apavorava com o Lobo Mau. Três princesas também escaparam do Mundo da Fantasia: Branca de Neve, que tenta emplacar seu programa infantil; Bela Adormecida, sonhando com sua carreira de dançarina, apesar da falta de aptidão; e Cinderela, a mais nova rica depois do leilão do sapati-nho de cristal.</p>
						<p>Uma dupla famosa e cheia de fãs promete levantar o público na turnê mais esperada do século, o “Show de Mary & John”. Será que vamos descobrir quem são esses dois? E por fim, temos o grande empresário, Peter, dono de fábricas, marcas e tudo aquilo que possa gerar lucros, um adulto que nem lembra mais da sua importância no Mundo da Fantasia.</p>
						<p>Cecilia e Sininho terão uma missão quase impossível, pois os personagens não querem retornar e os vilões já estão a caminho para capturá-los. Com muita música e diversão, a história pretende mostrar que o “Era uma vez...” está mais vivo do que nunca na realidade das crianças.</p>

						<h4 class="title-5">Ficha Técnica:</h4>

						<b>Elenco</b>
						<p>André Avram; Carolina Chagas; Catharina Dent; Dara Ferreira; Janine Ramos; João Vicente; Julia Nepomuceno; Júlio Cariús; Kamilly Brito; Laura Ramos; Marcos Hassler; Pam Nascimento; Raquel Jordão e Stephanie Leme</p>
						<b>Coreografia</b>
						<p>Ana Lolago; Ana Luiza; Bane; Gabriel O’Queiroz; Karina Cunha; Leonardo Ce-lestino; Luke Tamas; Natália Medeiros; Nathan Mendes; Sam; Tarcila Barce-los e Zeck West</p>
						<b>Produção</b>
						<p>Edson Mazonni; Ízaías Rangel; Wallace Andrade e Yasmin Mazoleni</p>

						<p>
							Texto e Direção Geral: Jayme Kamus
							<br>
							Produção: Brenda Agrassar
							<br>
							Coreografia: Kianne Soares
							<br>
							Cenografia: Maria Ceiçaquat.
						</p>
					</div>

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

							<span>(21) 3233-1306</span>

							<a href="mailto:casapaschoalcarlosmagno.teatroduse@funarte.gov.br">casapaschoalcarlosmagno.teatroduse@funarte.gov.br</a>

							<a href="https://www.facebook.com/coteatro.funarte" rel="nofollow">https://www.facebook.com/coteatro.funarte</a>
						</div>

						<div class="box-data__row">
							<span><b>Local:</b></span>
							<span>Rio de Janeiro</span>
						</div>

						<h4 class="title-5">Veja como chegar</h4>

						<div id="map">
							<strong>
								<a class="mapa" href="http://www.google.com/maps/ms?source=s_q&amp;hl=en&amp;geocode=&amp;ie=UTF8&amp;msa=0&amp;msid=102333391455124264758.000495a7f6191f1106c1e&amp;ll=-22.91788,-43.17935&amp;spn=0.005554,0.011362&amp;t=h&amp;z=17&amp;t=r&amp;output=embed" rel="shadowbox;title=Casa Funarte Paschoal Carlos Magno – Teatro Funarte Duse" title="Amplie o mapa">
									<img src="http://maps.google.com/maps/api/staticmap?center=-22.91788,-43.17935&amp;zoom=17&amp;size=194x120&amp;maptype=&amp;markers=size:mid|color:0x3B8313|label:A|-22.91788,-43.17935&amp;sensor=false" alt="Mapa do espaço cultural" width="194" height="120">
								</a>
							</strong>
						</div>
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