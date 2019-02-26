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
	base.collapse.manipularColuna();

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
	base.carrossel.iniciarMidias();
	base.carrossel.iniciarAudios();
	base.audio.ativar();

	// Institucional e Relatórios
	base.tabs.visualizar();
	base.carrossel.verificarTabs();
	base.carrossel.iniciarTabsOnOff();
	base.carrossel.iniciarTabsOn();

	// Resultado de busca
	base.menuLateral.exibir();

	// Eventos
	base.carrossel.iniciarCalendarioCompacto();
	base.carrossel.iniciarCalendarioCompleto();
	base.carrossel.iniciarCalendarioFormulario();
	base.calendario.ativar();
	base.calendario.ativarCompacto();
	base.calendario.atualizaCarrosselCompacto();

	// Lista de coleções de áudios
	base.audio.ativarListaColecao();

	// Agenda do Presidente
	base.calendario.ativarAgenda();
});

var base = {
	audio: {
		ativar: function() {
			var $audioPlayer = $('.audio-player');

			if ($audioPlayer.length > 0) {
				$audioPlayer.musicPlayer({
					elements: ['controls', 'time', 'volume', 'progress']
				});
			}
		},

		ativarListaColecao: function() {
			$('#items-list-results').on('click','.audios-list__play button',function() {
				var $this = $(this);

				$this.parent().siblings('.audios-list__audio').musicPlayer({
					elements: ['controls', 'time', 'volume', 'progress']
				});

				$this.parents('.audios-list__box').addClass('active');
			});
		}
	},

	calendario: {
		ativarAgenda: function() {
			var $datepicker = $('.datepicker-agenda'),
				dataUrl;

			if ($datepicker.length > 0) {
				$datepicker.datepicker({
					onSelect: function(text, data) {
						window.location = '/agenda-presidencia/?dia=' + text;
					}
				});

				dataUrl = location.search.split('?dia=')[1];
				if (dataUrl) {
					$datepicker.datepicker('setDate',dataUrl);
				}
			}
		},

		ativar: function() {
			if ($('.datepicker,.datepicker-agenda').length > 0) {
				( function( factory ) {
					if ( typeof define === "function" && define.amd ) {
						define( [ "../widgets/datepicker" ], factory );
					} else {
						factory( jQuery.datepicker );
					}
				}( function( datepicker ) {

					datepicker.regional[ "pt-BR" ] = {
						closeText: "Fechar",
						prevText: "&#x3C;Anterior",
						nextText: "Próximo&#x3E;",
						currentText: "Hoje",
						monthNames: [ "Janeiro","Fevereiro","Março","Abril","Maio","Junho",
						"Julho","Agosto","Setembro","Outubro","Novembro","Dezembro" ],
						monthNamesShort: [ "Jan","Fev","Mar","Abr","Mai","Jun",
						"Jul","Ago","Set","Out","Nov","Dez" ],
						dayNames: [
							"Domingo",
							"Segunda-feira",
							"Terça-feira",
							"Quarta-feira",
							"Quinta-feira",
							"Sexta-feira",
							"Sábado"
						],
						dayNamesShort: [ "D","S","T","Q","Q","S","S" ],
						dayNamesMin: [ "D","S","T","Q","Q","S","S" ],
						weekHeader: "Sm",
						dateFormat: "dd/mm/yy",
						firstDay: 0,
						isRTL: false,
						showMonthAfterYear: false,
						yearSuffix: ""
					};

					datepicker.setDefaults( datepicker.regional[ "pt-BR" ] );
					return datepicker.regional[ "pt-BR" ];

				} ) );

				$('.datepicker').datepicker();
			}
		},

		ativarCompacto: function() {
			var $datepicker = $('.datepicker-compacto');

			if ($datepicker.length > 0) {
				var dataInicial,
					dataFinal,
					date1,
					date2,
					dataPadrao =  $('.box-calendario').find('.slick-active').find('.box-calendario__data').data('inicial'),
					dataConcluida;

				if (dataPadrao) {
					dataConcluida = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dataPadrao);
				} else {
					dataPadrao = null;
				}

				$datepicker.datepicker({
					defaultDate: dataConcluida,
					beforeShowDay: function(date) {
						dataInicial = $('.box-calendario').find('.slick-active').find('.box-calendario__data').data('inicial');
						dataFinal = $('.box-calendario').find('.slick-active').find('.box-calendario__data').data('final');

						if (dataInicial) {
							date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dataInicial);
						} else {
							date1 = 0;
						}
						if (dataFinal) {
							date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dataFinal);
						} else {
							date2 = 0;
						}

						return [true, date1 && ((date.getTime() == date1.getTime()) || (date2 && date >= date1 && date <= date2)) ? 'active' : ''];
					},
					onSelect: function(text, data) {
						base.calendario.atualizaCarrosselCompacto();
					}
				});
			}
			
			$('.datepicker-compacto-filtro').change(function() {
				base.calendario.atualizaCarrosselCompacto();
			});
			
		},
		
		atualizaCarrosselCompacto: function() {
			var estrutura = '<ul class="calendario-carousel">',
				$box = $('.box-calendario'),
				$boxMain = $('.box-calendario-main'),
				contador = 0,
				$datepicker = $('.datepicker-compacto');

			if ($datepicker.length > 0) {
				var selectedDate = $datepicker.datepicker( "getDate" );
				if (!selectedDate) {
					return;
				}
				
				selectedDate = selectedDate.getTime() / 1000; //js timestamp is in miliseconds
				
				var local = $('#datepicker-compacto-filtro-local').val();
				var area = $('#datepicker-compacto-filtro-area').val();
				
				var query = 'day=' + selectedDate;
				
				if (local) {
					query += '&local=' + local;
				}
				
				if (area) {
					query += '&area=' + area;
				}
				
				
				
				$.ajax({
					type: "GET",
					url: funarte.ajaxurl + '?action=get_events_by_day&' + query,
					timeout: 3000,
					contentType: "application/json; charset=utf-8",
					cache: false,
					beforeSend: function() {
						$('.calendario-carousel,.slick-dots').remove();
						$boxMain.addClass('loading').removeClass('active');
					},
					error: function() {
						$boxMain.removeClass('loading');
						$box.html('<span class="box-calendario__message">Não foi encontrado nenhum evento no dia selecionado.</span>');
					},
					success: function(html) {
						var slides = JSON.parse(html),
							dataInicialSeparada,
							dataFinalSeparada;

						$.each(slides,function(i, slide) {
							
							dataInicialSeparada = slide.dataInicial.split('/');
							dataFinalSeparada = slide.dataFinal.split('/');

							mesInicial = base.calendario.transformarMes(dataInicialSeparada[1]);
							mesFinal = base.calendario.transformarMes(dataFinalSeparada[1]);
							
							var dataString = dataInicialSeparada[0] + '/' + mesInicial;
							if (slide.dataInicial != slide.dataFinal) {
								dataString += ' - ' + dataFinalSeparada[0] + '/' + mesFinal;
							}

							estrutura += '<li class="color-' + slide.areaSlug + '">\
											<h3 class="box-calendario__data" data-inicial="' + slide.dataInicial + '" data-final="' + slide.dataFinal + '">' + dataString + '</h3>\
											<h4 class="box-calendario__titulo">' + slide.titulo + '</h4>\
											<hr>\
											<div class="box-calendario__imagem" style="background-image: url(' + slide.imagem + ');">\
												<div class="link-area">\
													<a href="' + slide.areaLink + '">' + slide.areaSlug + '</a>\
												</div>\
											</div>\
											<div class="box-calendario__linha">\
												<div class="box-calendario__coluna-1">\
													<span class="box-calendario__time">' + slide.horario + '</span>\
													<span class="box-calendario__pin">' + slide.endereco + '</span>\
												</div>\
												<div class="box-calendario__coluna-2">\
													<p>' + slide.texto + '</p>\
													<a class="link-more" href="' + slide.url + '">Ler mais</a>\
												</div>\
											</div>\
										</li>';

							contador++;
							
						});

						if (contador <= 0) {
							estrutura += '<li><span class="box-calendario__message">Não foi encontrado nenhum evento no dia selecionado.</span></li>';
						}

						estrutura += '</ul>';

						$box.html(estrutura);

						base.carrossel.iniciarCalendarioCompacto();
						$datepicker.datepicker('refresh');
						$boxMain.removeClass('loading');
					}
				});
			}
		},

		transformarMes: function(data) {
			switch(data) {
				case '01':
					mes = 'JAN';
					break;
				case '02':
					mes = 'FEV';
					break;
				case '03':
					mes = 'MAR';
					break;
				case '04':
					mes = 'ABR';
					break;
				case '05':
					mes = 'MAI';
					break;
				case '06':
					mes = 'JUN';
					break;
				case '07':
					mes = 'JUL';
					break;
				case '08':
					mes = 'AGO';
					break;
				case '09':
					mes = 'SET';
					break;
				case '10':
					mes = 'OUT';
					break;
				case '11':
					mes = 'NOV';
					break;
				case '12':
					mes = 'DEZ';
					break;
			}

			return mes;
		}
	},

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
		},

		manipularColuna: function() {
			$('.links-list--collapse').find('strong').on('click',function() {
				$(this).toggleClass('active').siblings('ul').toggleClass('active');
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
		iniciarMidias: function() {
			var $carousel = $('.box-bidding--type-b');

			$('.box-bidding--type-b__carousel').slick({
				speed: 1000,
				infinite: false,
				slidesToShow: 3,
				slidesToScroll: 3,
				vertical: true,
				adaptiveHeight: true,
				prevArrow: $carousel.find('.control__prev'),
				nextArrow: $carousel.find('.control__next'),
			});
		},

		iniciarAudios: function() {
			var $carousel = $('.box-carousel-audio');

			$('.carousel-audio').slick({
				speed: 1000,
				infinite: false,
				slidesToShow: 1,
				slidesToScroll: 1,
				vertical: true,
				//adaptiveHeight: true,
				prevArrow: $carousel.find('.control__prev'),
				nextArrow: $carousel.find('.control__next'),
			});
		},

		iniciarCalendarioCompacto: function() {
			var $carousel = $('.box-calendario-main'),
				$calendario = $('.calendario-carousel');

			$calendario.slick({
				speed: 500,
				infinite: false,
				slidesToShow: 1,
				slidesToScroll: 1,
				dots: true,
				appendDots: $carousel,
				adaptiveHeight: true,
				prevArrow: $carousel.find('.control__prev'),
				nextArrow: $carousel.find('.control__next')
			});

			$calendario.on('afterChange',function(slick, currentSlide) {
				$('.datepicker-compacto').datepicker('refresh');
			});

			$carousel.addClass('active');
		},

		iniciarCalendarioFormulario: function() {
			$('.carousel-calendar-box .form-filtro-calendario input.datepicker-field').on('change',function(event){ 
				var data = $(this).val().split('/');
				var url = window.location.href;
				url = url.split('?')[0];
				url += '?dia=' + data[0] + '&mes=' + data[1] + '&ano=' + data[2];
				window.location.href = url;
			});
		},

		iniciarCalendarioCompleto: function() {
			var $carousel = $('.carousel-calendar-box');
			var status = true;

			function adicionarEventosMes(slick, pos, params, addBefore) {
				params.action = 'get_events_by_period';
				var request = $.ajax({
					url: funarte.ajaxurl,
					type: "GET",
					data: params,
					success: function(data) {
						var html_el = '';
						Object.keys(data.events).forEach(function(key, index){
							eventos = data.events[key];
							var days = ['DOM','SEG','TER','QUA','QUI','SEX','SAB'];
							
							var dia_semana = days[ ( new Date(key.replace( /(\d{2})\/(\d{2})\/(\d{4})/, "$2/$1/$3"))).getDay() ];
							var mes_ano = key.split("/")[0] + '/' + key.split("/")[1];

							var html_evento = '';
							for (var idx in eventos) {
								var evento = eventos[idx];
								html_evento = html_evento +
									'<div class="carousel-calendar__event color-'+ evento.cat.slug +'"> \
										<strong>' + evento.title + '</strong> \
										<span class="carousel-calendar__pin">' + evento.local + '</span> \
											<span class="carousel-calendar__time">das ' + evento.hora.inicio + ' às ' + evento.hora.fim + ' horas</span>  \
									</div>';
							}
							html_evento = html_evento == '' ? '<strong>Nenhum evento</strong>' : html_evento;
							html_el = html_el + '<li data-dia="' + key + '" ><div class="carousel-calendar__button"><button type="text">' + dia_semana + '<br>' + mes_ano + '</button> </div>' + html_evento +	'</li>';
						});
						if(addBefore == true) {
							slick.currentSlide = slick.currentSlide + params.left;
						}
						slick.slickAdd(html_el, pos, addBefore);
						status = true;
					},
					error: function(e) {
						status = true;
					}
				});
			}

			$('.carousel-calendar').on('afterChange', function(event, slick, currentSlide) {
				if (status == true ) {
					if (slick.slideCount - slick.currentSlide <= 7) {
						status = false;
						var dia = $('.carousel-calendar li:last-of-type').data('dia');
						var param = {day:dia, left:0, rigth:20};
						adicionarEventosMes(slick, slick.slideCount-1, param, false);
					} else if (slick.currentSlide <= 7) {
						status = false;
						var dia = $('.carousel-calendar li:first-of-type').data('dia');
						var param = {day:dia, left:20, rigth:0};
						adicionarEventosMes(slick, 0, param, true);
					}
				}
			});
			
			$('.carousel-calendar').on('init', function(event, slick){
				slick.slickGoTo($('.carousel-calendar li.active').data('slick-index'));
			});

			$('.carousel-calendar').slick({
				speed: 500,
				infinite: false,
				slidesToShow: 5,
				slidesToScroll: 5,
				centerMode: true,
				centerPadding: '0',
				focusOnSelect: true,
				adaptiveHeight: true,
				prevArrow: $carousel.find('.control__prev'),
				nextArrow: $carousel.find('.control__next'),
				responsive: [
					{
						breakpoint: 1200,
						settings: {
							slidesToShow: 4,
							slidesToScroll: 4
						}
					},
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3
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
						breakpoint: 450,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});
		},

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
				var $caption = $('.carousel-highlights__captions'),
					largura = $('.hidden__caption-' + nextSlide).outerWidth(),
					padding = 20;

				$caption.css('width',largura + (padding * 2));

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
							breakpoint: 1200,
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
				variableWidth: true,
				dots: true,
				responsive: [
					{
						breakpoint: 1200,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
						}
					},
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 1,
							variableWidth: false
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