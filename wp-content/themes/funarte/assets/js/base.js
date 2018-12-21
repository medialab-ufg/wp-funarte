$(document).ready(function() {
	// Todas as paginas
	base.acessibilidade.iniciar();
	base.acessibilidade.manipularFontes();
	base.acessibilidade.ativarAltoContraste();
	base.busca.manipular();
	base.jsNaoObstrusivo.ativar();
	base.menu.manipular();
	base.scroll.rolarAoTopo();
	base.scroll.observarRolagem();
	base.scroll.manipularElemento();

	// Home
	base.carrossel.iniciarDestaques();
	base.carrossel.iniciarAcervo();
	base.carrossel.iniciarAgenda();
	base.carrossel.iniciarEditais();
	base.noticias.visualizar();

	// Contatos
	base.collapse.manipularBox1();

	// Espaços Culturais
	base.carrossel.iniciarEventos();

	// Interna de categorias
	base.carrossel.iniciarZoom();

	// Interna de acervo
	base.carrossel.iniciarAnexos();

	// Interna de notícias
	base.carrossel.iniciarImagens();

	// Institucional e Relatórios
	base.tabs.visualizar();
	base.carrossel.verificarTabs();
	base.carrossel.iniciarTabsOnOff();
	base.carrossel.iniciarTabsOn();

	// Resultado de busca
	base.menuLateral.exibir();
});

var base = {
	scroll: {
		rolarAoTopo: function() {
			$('.button-scroll-top').on('click',function() {
				$('html,body').animate({scrollTop: 0}, 'slow');
			});
		},

		observarRolagem: function() {
			var $window = $(window);

			$window.on('scroll',function() {
				base.scroll.manipularElemento(($window.height() / 2));
			});
		},

		manipularElemento: function(height) {
			var $window = $(window),
				$button = $('.button-scroll-top');

			if (height == undefined) {
				height = ($window.height() / 2);
			}

			if (height >= $window.scrollTop()) {
				if (!$button.hasClass('hidden')) {
					$button.addClass('hidden');
				}
			} else {
				if ($button.hasClass('hidden')) {
					$button.removeClass('hidden');
				}
			}
		}
	},

	menuLateral: {
		exibir: function() {
			$('.box-list-links__button').on('click',function() {
				$('.box-list-links').toggleClass('active');
				$(this).toggleClass('active');
			});
		}
	},

	tabs: {
		visualizar: function() {
			$('.box-tabs--active')
			.find('.list-tabs')
			.find('a')
			.on('click',function() {
				var target = $(this).attr('href');

				$(target)
					.addClass('active')
					.siblings('.content-tab__content')
					.removeClass('active');

				$(this)
					.parent('li')
					.addClass('active')
					.siblings('li')
					.removeClass('active');

				return false;
			});
		}
	},

	collapse: {
		manipularBox1: function() {
			$('.collapse__button').on('click',function() {
				var $this = $(this),
					text = $this.text(),
					word = text.split(' '),
					newText = '';

				word[0] = word[0] == 'Ocultar' ? 'Exibir' : 'Ocultar';

				for (var i = 0; i < word.length; i++) {
					newText += word[i] + ' ';
				}

				$this
					.text(newText)
					.toggleClass('active')
					.siblings('.collapse__text')
					.slideToggle(200);
			});
		}
	},

	menu: {
		manipular: function() {
			$('.navbar-toggler').on('click',function() {
				$(this)
				.parents('.navigation-menu')
				.find('.menu-wrapper')
				.toggleClass('active');
			});
		}
	},

	noticias: {
		visualizar: function() {
			$('.box-news__load').on('click',function() {
				var $this = $(this),
					$proxima = $this.siblings('ul.visible:last').next('ul');

				if ($proxima.length > 0) {
					$proxima.addClass('visible');

					if ($proxima.next('ul').length == 0) {
						$this.addClass('active');
					}

					return false;
				}
			});
		}
	},

	carrossel: {
		verificarTabs: function() {
			var $carousel = $('.list-tabs-on-off').find('.list-tabs__main');

			$(window).resize(function() {
				var $windowWidth = $(window).width();

				if ($windowWidth < 1100) {
					if (!$carousel.hasClass('slick-slider')) {
						base.carrossel.iniciarTabsOnOff();
					}
				}
			});
		},

		iniciarTabsOnOff: function() {
			var $boxCarousel = $('.list-tabs--on-off'),
				$carousel = $boxCarousel.find('.list-tabs__main');

			$carousel.slick({
				speed: 1000,
				infinite: false,
				slidesToShow: 2,
				slidesToScroll: 1,
				prevArrow: $boxCarousel.find('.control__prev'),
				nextArrow: $boxCarousel.find('.control__next'),
				adaptiveHeight: true,
				responsive: [
					{
						breakpoint: 10000,
						settings: 'unslick'
					},
					{
						breakpoint: 1100,
						settings: {
							slidesToShow: 2,
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1
						}
					}
				]
			});
		},

		iniciarTabsOn: function() {
			var $boxCarousel = $('.list-tabs--on'),
				$carousel = $boxCarousel.find('.list-tabs__main');

			$carousel.slick({
				speed: 1000,
				infinite: false,
				slidesToShow: 3,
				slidesToScroll: 1,
				prevArrow: $boxCarousel.find('.control__prev'),
				nextArrow: $boxCarousel.find('.control__next'),
				adaptiveHeight: true,
				responsive: [
					{
						breakpoint: 1200,
						settings: {
							slidesToShow: 2
						}
					},
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 1
						}
					}
				]
			});
		},

		iniciarImagens: function() {
			var $carousel = $('.box-carousel-image');

			$('.carousel-image').slick({
				speed: 1000,
				infinite: false,
				slidesToShow: 3,
				slidesToScroll: 1,
				prevArrow: $carousel.find('.control__prev'),
				nextArrow: $carousel.find('.control__next'),
				responsive: [
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 586,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});
		},

		iniciarDestaques: function() {
			var $carousel = $('.box-carousel-highlights');

			$('.carousel-highlights').slick({
				speed: 1000,
				fade: true,
				infinite: true,
				autoplay: false,
				autoplaySpeed: 2000,
				slidesToShow: 1,
				prevArrow: $carousel.find('.control__prev'),
				nextArrow: $carousel.find('.control__next'),
				dots: true,
				adaptiveHeight: true
			})
			.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
				var $caption = $('.carousel-highlights__captions');
				largura = $('.hidden__caption-' + nextSlide).outerWidth();
				console.log(largura);
				$caption.css('width',largura);

				$caption
					.find('.visible')
					.removeClass('visible')
					.end()
					.find('.carousel-highlights__caption-' + nextSlide)
					.addClass('visible');
			});
		},

		iniciarAcervo: function() {
			var $carousel = $('.box-carousel-collection'),
				itens = $('.carousel-collection').find('li').length;

			if (itens > 4) {
				$('.carousel-collection').slick({
					speed: 1000,
					infinite: false,
					slidesToShow: 4,
					slidesToScroll: 4,
					prevArrow: $carousel.find('.control__prev'),
					nextArrow: $carousel.find('.control__next'),
					adaptiveHeight: true,
					responsive: [
						{
							breakpoint: 768,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 2
							}
						},
						{
							breakpoint: 586,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1
							}
						}
					]
				});
			}
		},

		iniciarAgenda: function() {
			var $carousel = $('.box-carousel-schedule');

			$('.carousel-schedule').slick({
				speed: 2000,
				infinite: false,
				slidesToShow: 2,
				slidesToScroll: 1,
				autoplay: false,
				prevArrow: $carousel.find('.control__next'), // Botoes trocados de proposito
				nextArrow: $carousel.find('.control__prev'),
				adaptiveHeight: true,
				variableWidth: true,
				responsive: [
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 1,
							variableWidth: false
						}
					}
				]
			})
			.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
				$thumb = $('.carousel-schedule__thumb');

				$thumb
					.find('.visible')
					.removeClass('visible')
					.end()
					.find('.carousel-schedule__image-' + (nextSlide + 1))
					.addClass('visible');

				$carousel.addClass('barra-larga');
			})
			.on('afterChange', function() {
				$carousel.removeClass('barra-larga');
			});
		},

		iniciarEditais: function() {
			var $carousel = $('.box-carousel-notices');

			$('.carousel-notices').slick({
				speed: 1000,
				infinite: false,
				slidesToShow: 4,
				slidesToScroll: 4,
				vertical: true,
				adaptiveHeight: true,
				prevArrow: $carousel.find('.control__prev'),
				nextArrow: $carousel.find('.control__next'),
			});
			// .on('beforeChange', function(event, slick, currentSlide, nextSlide) {
			// 	// if (nextSlide < currentSlide) {
			// 	// 	$carousel.addClass('reverse');
			// 	// } else {
			// 	// 	$carousel.removeClass('reverse');
			// 	// }
			// });
		},

		iniciarEventos: function() {
			var $boxCarousel = $('.box-carousel-events'),
				$carousel = $('.carousel-events'),
				quantidade = $carousel.find('li').length;

			if (quantidade > 2) {
				$boxCarousel.addClass('carousel-active');

				$('.carousel-events').slick({
					speed: 1000,
					infinite: true,
					slidesToShow: 2,
					slidesToScroll: 1,
					prevArrow: $boxCarousel.find('.control__prev'),
					nextArrow: $boxCarousel.find('.control__next'),
					responsive: [
						{
							breakpoint: 530,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1
							}
						}
					]
				});
			}
		},

		iniciarAnexos: function() {
			var $boxCarousel = $('.box-carousel-attachments'),
				$carousel = $('.carousel-attachments'),
				quantidade = $carousel.find('li').length;

			if (quantidade > 6) {
				$boxCarousel.addClass('carousel-active');

				$carousel.slick({
					speed: 1000,
					infinite: false,
					slidesToShow: 6,
					slidesToScroll: 1,
					autoplay: true,
					autoplaySpeed: 2000,
					prevArrow: $boxCarousel.find('.control__prev'),
					nextArrow: $boxCarousel.find('.control__next'),
					responsive: [
						{
							breakpoint: 1200,
							settings: {
								slidesToShow: 5
							}
						},
						{
							breakpoint: 992,
							settings: {
								slidesToShow: 4
							}
						},
						{
							breakpoint: 768,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 2
							}
						},
						{
							breakpoint: 430,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1
							}
						}
					]
				});
			}
		},

		iniciarZoom: function() {
			var $carousel = $('.box-carousel-zoom');

			$('.carousel-zoom').slick({
				speed: 1000,
				infinite: false,
				slidesToShow: 3,
				slidesToScroll: 1,
				prevArrow: $carousel.find('.control__prev'),
				nextArrow: $carousel.find('.control__next'),
				adaptiveHeight: true,
				variableWidth: true,
				responsive: [
					{
						breakpoint: 990,
						settings: {
							variableWidth: false
						}
					},
					{
						breakpoint: 600,
						settings: {
							variableWidth: false,
							slidesToShow: 1
						}
					}
				]
			});
		}
	},

	acessibilidade: {
		iniciar: function() {
			accessibilityCounter = 0;
		},

		manipularFontes: function() {
			jQuery('.button-text-minus').on('click',function() {
				if (accessibilityCounter > -3) {
					var _html = jQuery('html'),
						fonte = _html.css('font-size'),
						tamanho = fonte.split('px');

					_html.css('font-size', (parseInt(tamanho[0]) - 2));
					accessibilityCounter--;
				}
			});

			jQuery('.button-text-default').on('click',function() {
				jQuery('html').css('font-size','1rem');
				accessibilityCounter = 0;
			});

			jQuery('.button-text-plus').on('click',function() {
				if (accessibilityCounter < 3) {
					var _html = jQuery('html'),
						fonte = _html.css('font-size'),
						tamanho = fonte.split('px');

					_html.css('font-size', (parseInt(tamanho[0]) + 3));
					accessibilityCounter++;
				}
			});
		},

		ativarAltoContraste: function() {
			jQuery('.button-high-contrast').on('click',function() {
				jQuery('body').toggleClass('contraste');
			});
		}
	},

	busca: {
		manipular: function() {
			var $box = $('.box-searchform');

			$('#s').on('focus',function() {
				$box.addClass('active');
			});

			$('#searchsubmit').on('blur',function() {
				$box.removeClass('active');
			});

			$('.searchform-button').on('click',function() {
				$box.toggleClass('active');
			});

			$box.on('click',function(e) {
				e.stopPropagation();
			});

			$('body,.searchcancel').on('click',function() {
				$box.removeClass('active');
			});
		}
	},

	jsNaoObstrusivo: {
		ativar: function() {
			$('body').addClass('js');
		}
	}
};