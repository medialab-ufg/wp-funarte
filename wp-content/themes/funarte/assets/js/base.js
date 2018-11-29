$(document).ready(function() {
	// Todas as paginas
	base.acessibilidade.iniciar();
	base.acessibilidade.manipularFontes();
	base.acessibilidade.ativarAltoContraste();
	base.busca.manipular();
	base.jsNaoObstrusivo.ativar();
	base.menu.manipular();

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
});

var base = {
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
				$(this).siblings('.menu-wrapper').toggleClass('active');
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
			});
		},

		iniciarAcervo: function() {
			var $carousel = $('.box-carousel-collection');

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
		},

		iniciarAgenda: function() {
			var $carousel = $('.box-carousel-schedule');

			$('.carousel-schedule').slick({
				speed: 1000,
				infinite: false,
				slidesToShow: 2,
				slidesToScroll: 1,
				prevArrow: $carousel.find('.control__prev'),
				nextArrow: $carousel.find('.control__next'),
				adaptiveHeight: true,
				variableWidth: true,
				responsive: [
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							variableWidth: false
						}
					}
				]
			})
			.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
				if (nextSlide > currentSlide) {
					$carousel
						.find('.active')
						.removeClass('active')
						.next('li')
						.addClass('active');
				} else {
					$carousel
						.find('.active')
						.removeClass('active')
						.prev('li')
						.addClass('active');
				}
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
			})
			.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
				if (nextSlide < currentSlide) {
					$carousel.addClass('reverse');
				} else {
					$carousel.removeClass('reverse');
				}
			});
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