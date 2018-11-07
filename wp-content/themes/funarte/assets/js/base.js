$(document).ready(function() {
	base.acessibilidade.iniciar();
	base.acessibilidade.manipularFontes();
	base.acessibilidade.ativarAltoContraste();
	base.busca.manipular();
	base.jsNaoObstrusivo.ativar();

	base.carrossel.iniciar();
	base.noticias.visualizar();
});

var base = {
	noticias: {
		visualizar: function() {
			$('.box-news__load').on('click',function() {
				var $this = $(this),
					$lista = $this
								.siblings('.visible:last')
								.next('ul');

				if ($lista.length > 0) {
					$lista
					.addClass('visible');
				} else {
					$this.addClass('hidden');
				}
			});
		}
	},

	carrossel: {
		iniciar: function() {
			var $carousel = $('.highlights-carousel');

			$carousel.find('ul').slick({
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
			/*
			 * BOTÃO DE EXIBIÇÃO DO FORMULÁRIO DE BUSCA
			*/
			jQuery('.tainacan-search-button').on('click',function() {
				var _elementoPai = jQuery(this).parents('.input-group');

				if (!_elementoPai.hasClass('hover')) {
					_elementoPai.addClass('hover');

					return false;
				} else {
					if (jQuery('#tainacan-search-header').val() == '') {
						_elementoPai.removeClass('hover');

						return false;
					}
				}
			});

			jQuery('#tainacan-search-header').on({
				'focus': function() {
					jQuery(this).parents('.input-group').addClass('hover');
				},
				'blur': function() {
					jQuery(this).parents('.input-group').removeClass('hover');
				}
			});

			/*
			 * AO CLICAR EM QUALQUER LUGAR DA PÁGINA, O CAMPO DE BUSCA ABERTO É FECHADO
			*/
			var _formBusca = jQuery('.tainacan-search-form'),
				_formBuscaFilho = _formBusca.find('.input-group');

			_formBusca.on('click',function(e) {
				e.stopPropagation();
			});

			jQuery('body').on('click',function() {
				if (_formBuscaFilho.hasClass('hover')) {
					_formBuscaFilho.removeClass('hover');
				}
			});
		}
	},

	jsNaoObstrusivo: {
		ativar: function() {
			$('body').addClass('js');
		}
	}
};