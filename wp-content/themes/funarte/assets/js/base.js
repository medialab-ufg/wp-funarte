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
	base.instagram.ativarFeed();

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

	// Lista de coleções de videos
	base.video.ativar();
	base.video.ativarAvulso();

	// Agenda do Presidente
	base.calendario.ativarAgenda();
});

var base = {
	instagram: {
		ativarFeed: function() {
			var $target = $('#instagram-feed');

			if (($target.length > 0) && (funarte.instagram.access_token != '') && (funarte.instagram.user_id != '')) {
				var feed = new Instafeed({
					accessToken: funarte.instagram.access_token,//'289181919.3c600d4.76b5b17c6da94742be36bc1465a1e41d',
					get: 'user',
					userId: funarte.instagram.user_id,//289181919
					target: 'instagram-feed',
					limit: 3,
					resolution: 'standard_resolution',
					template: '<div class="box-social-media__box"><a href="{{link}}" target="_blank"><img src="{{image}}"/></a><strong>{{caption}}</strong></div>'
				});
				feed.run();
			}
		}
	},

	video: {
		ativar: function() {
			var $boxPai = $('#items-list-results');

			if ($boxPai.length > 0) {
				$boxPai.on('click','.videos-list__play button',function() {
					var $this = $(this),
						$box = $this.parent().siblings('.videos-list__video'),
						video = $box.data('video'),
						estrutura = '';

					if (video) {
						$('video').each(function() {
							$(this)[0].pause();
						});

						$('.video-play').removeClass('inativo');
						$('.video-pause').addClass('inativo');

						estrutura = '<video autoplay src="' + video + '" class="video-video"></video>\
									<div class="video-bar">\
										<button type="button" class="video-play"><i class="mdi mdi-play"></i></button>\
										<button type="button" class="video-pause"><i class="mdi mdi-pause"></i></button>\
										<div class="video-progress">\
											<div class="video-progress__background">\
												<div class="video-progress__bar"></div>\
											</div>\
										</div>\
										<div class="video-current"></div>\
										<div class="video-duration"></div>\
										<button type="button" class="video-volume"><i class="mdi mdi-volume-high"></i><i class="mdi mdi-volume-mute"></i></button>\
										<button type="button" class="video-full"><i class="mdi mdi-fullscreen"></i></button>\
									</div>';
						$box.html(estrutura);

						$this.parents('.audios-list__box').addClass('video-active');

						// Play
						$boxPai.on('click','.video-play',function(event) {
							event.stopImmediatePropagation();

							$('video').each(function() {
								$(this)[0].pause();
							});
							$('.video-play').removeClass('inativo');
							$('.video-pause').addClass('inativo');

							var $this = $(this);

							$this.parents('.video-player').addClass('active').find('.video-player__thumb').addClass('video-active');

							$this.addClass('inativo').parents('.videos-list__video').find('video')[0].play();
							$this.siblings('.video-pause').removeClass('inativo');
						});

						// Pause
						$boxPai.on('click','.video-pause',function(event) {
							event.stopImmediatePropagation();
							var $this = $(this);

							$this.addClass('inativo').parents('.videos-list__video').find('video')[0].pause();
							$this.siblings('.video-play').removeClass('inativo');
							$this.parents('.video-player').removeClass('active');
						});

						// Volume
						$boxPai.on('click','.video-volume',function(event) {
							event.stopImmediatePropagation();
							var $this = $(this),
								videoMute = $this.parents('.videos-list__video').find('video')[0];

							if (videoMute.muted == false ) {
								videoMute.muted = true;
								$this.addClass('muted');
							} else {
								videoMute.muted = false;
								$this.removeClass('muted');
							}
						});

						// Full Screen
						$boxPai.on('click','.video-full',function() {
							var $this = $(this),
								videoFull = $this.parents('.videos-list__video').find('video')[0];

							if (videoFull.mozRequestFullScreen) {
								videoFull.mozRequestFullScreen();
							} else if (videoFull.webkitRequestFullScreen) {
								videoFull.webkitRequestFullScreen();
							}

							$this.parents('.video-player').find('.video-player__thumb').addClass('video-active');
						});

						// Tempo
						var $timeVideo;
						setInterval(function() {
							$('.videos-list__video').each(function() {
								var $this = $(this);

								$timeVideo = $this.find('video').get(0);

								if ($timeVideo != undefined) {
									$this.find('.video-duration').text(base.video.converterTempo($timeVideo.duration));
									$this.find('.video-current').text(base.video.converterTempo($timeVideo.currentTime));
									$this.find('.video-progress__bar').css('width',(Math.floor((100 / $timeVideo.duration) * $timeVideo.currentTime) + '%'));

									if ($timeVideo.currentTime == $timeVideo.duration) {
										$this.find('.video-progress__bar').css('width','100%');
										$this.find('.video-play').removeClass('inativo');
										$this.find('.video-pause').addClass('inativo');
										$this.removeClass('active');
									}
								}
							});
						}, 500);

						// Barra de progresso
						$boxPai.on('click','.video-progress__background',function(event) {
							var $this = $(this),
								offset = $this.offset(),
								eixoX = event.pageX - offset.left,
								$video = $this.parents('.video-bar').siblings('video')[0],
								valorMaximo = $video.duration,
								valorFinal = eixoX * valorMaximo / $this.width();

							$video.currentTime = valorFinal;
							$this.find('.video-progress__bar').css('width',eixoX);
						});
					} else {
						$box.addClass('youtube-video');
					}
				});

				// Pausa todos os videos ao mudar a visualizacao
				$('#items-list-area').on('click','.dropdown-item',function(event) {
					event.stopImmediatePropagation();

					$('video').each(function() {
						$(this)[0].pause();
					});

					$('.video-play').removeClass('inativo');
					$('.video-pause').addClass('inativo');
				});

				// Pausa todos os videos ao mudar o filtro
				$('#filters-desktop-aside').on('change','select',function() {
					$('video').each(function() {
						$(this)[0].pause();
					});

					$('.video-play').removeClass('inativo');
					$('.video-pause').addClass('inativo');
				});
			}
		},

		converterTempo : function (time) {
			var base = this;

			m=~~(time/60), s=~~(time % 60);
			return (m<10?"0"+m:m)+':'+(s<10?"0"+s:s);
		},

		ativarAvulso: function() {
			$boxPai = $('.video-list');

			if ($boxPai.length > 0) {
				// Play
				$boxPai.on('click','.video-play',function(event) {
					event.stopImmediatePropagation();

					// Pausando todos os outros players
					$('video').each(function() {
						$(this)[0].pause();
					});
					$('.video-play').removeClass('inativo');
					$('.video-pause').addClass('inativo');

					var $this = $(this);

					$this.parents('.video-player').addClass('active').find('.video-player__thumb').addClass('video-active');

					$this.addClass('inativo').parents('.video-player').find('video')[0].play();
					$this.siblings('.video-pause').removeClass('inativo');
				});

				// Pause
				$boxPai.on('click','.video-pause',function(event) {
					event.stopImmediatePropagation();
					var $this = $(this);

					$this.addClass('inativo').parents('.video-player').find('video')[0].pause();
					$this.siblings('.video-play').removeClass('inativo');
					$this.parents('.video-player').removeClass('active');
				});

				// Volume
				$boxPai.on('click','.video-volume',function(event) {
					event.stopImmediatePropagation();
					var $this = $(this),
						videoMute = $this.parents('.video-player').find('video')[0];

					if (videoMute.muted == false ) {
						videoMute.muted = true;
						$this.addClass('muted');
					} else {
						videoMute.muted = false;
						$this.removeClass('muted');
					}
				});

				// Full Screen
				$boxPai.on('click','.video-full',function() {
					var $this = $(this),
						videoFull = $this.parents('.video-player').find('video')[0];

					if (videoFull.mozRequestFullScreen) {
						videoFull.mozRequestFullScreen();
					} else if (videoFull.webkitRequestFullScreen) {
						videoFull.webkitRequestFullScreen();
					}

					$this.parents('.video-player').find('.video-player__thumb').addClass('video-active');
				});

				// Tempo
				var $timeVideo;
				setInterval(function() {
					$('.video-player').each(function() {
						var $this = $(this);

						$timeVideo = $this.find('video').get(0);

						if ($timeVideo != undefined) {
							$this.find('.video-duration').text(base.video.converterTempo($timeVideo.duration));
							$this.find('.video-current').text(base.video.converterTempo($timeVideo.currentTime));
							$this.find('.video-progress__bar').css('width',(Math.floor((100 / $timeVideo.duration) * $timeVideo.currentTime) + '%'));

							if ($timeVideo.currentTime == $timeVideo.duration) {
								$this.find('.video-progress__bar').css('width','100%');
								$this.find('.video-play').removeClass('inativo');
								$this.find('.video-pause').addClass('inativo');
								$this.removeClass('active');
							}
						}
					});
				}, 500);

				// Barra de progresso
				$boxPai.on('click','.video-progress__background',function(event) {
					var $this = $(this),
							offset = $this.offset(),
							eixoX = event.pageX - offset.left,
							$video = $this.parents('.video-bar').siblings('video')[0],
							valorMaximo = $video.duration,
							valorFinal = eixoX * valorMaximo / $this.width();

					$video.currentTime = valorFinal;
					$this.find('.video-progress__bar').css('width',eixoX);
				});
			}
		}
	},

	audio: {
		ativar: function() {
			// var $audioPlayer = $('.audio-player');

			// if ($audioPlayer.length > 0) {
			// 	$audioPlayer.musicPlayer({
			// 		elements: ['controls', 'time', 'volume', 'progress']
			// 	});
			// }
		},

		ativarListaColecao: function() {
			// $('#items-list-results').on('click','.audios-list__play button',function() {
			// 	var $this = $(this);

			// 	$this.parent().siblings('.audios-list__audio').musicPlayer({
			// 		elements: ['controls', 'time', 'volume', 'progress']
			// 	});

			// 	$this.parents('.audios-list__box').addClass('active');
			// });
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
			$('.box-list-links__button').on('click',function(e) {
				e.stopPropagation();

				$('.box-list-links').toggleClass('active');
				$(this).toggleClass('active');
			});

			$('.box-list-links').on('click',function(e) {
				e.stopPropagation();
			});

			$('body').on('click',function() {
				$('.box-list-links').removeClass('active');
				$('.box-list-links__button').removeClass('active');
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

				//history.pushState('',target, target);

				return false;
			});

			// $( window ).on( 'hashchange', function( e ) {
			// 	$(window.location.hash + '-trigger').click();
			// 	$(window.location.hash + '-trigger').html('asdasd');
			// } );

			var current = window.location.hash;
			if (current && current.includes('content-tab')) {
				$(current + '-trigger').click();
			}

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

				$('body').toggleClass('menu-mobile-active');
			});
		}
	},

	noticias: {
		visualizar: function() {
			$('.box-news__load').on('click',function() {
				var $this = $(this),
					$proxima = $this.siblings('.box-news__list').find('li.visible:last').nextAll('li:lt(3)');

				if ($proxima.length > 0) {
					$proxima.addClass('visible');

					if ($this.siblings('.box-news__list').find('li.visible:last').next('li').length == 0) {
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
				adaptiveHeight: false,
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

		atualizaCalendarioCompletoEventos: function() {
			$('.form-filtro-calendario').addClass('form-loading');
			$datepicker = $('.carousel-calendar-box .form-filtro-calendario input.datepicker-field');
			if ($datepicker.length > 0) {
				var selectedDate = $datepicker.datepicker( "getDate" );
				if (!selectedDate) {
					selectedDate = $('li.slick-center').data('dia');
				} else {
					selectedDate = $.datepicker.formatDate("dd/mm/yy", selectedDate);
				}
				var local = $('.carousel-calendar-box .form-filtro-calendario select.select_local').val();
				var area  = $('.carousel-calendar-box .form-filtro-calendario select.select_area').val();

				var slick = $('.carousel-calendar').slick("getSlick");
				var param = {day:selectedDate, left:10, rigth:10, local:local, area:area};
				base.carrossel.adicionarEventos(slick, slick.slideCount-1, param, false, function(slick, count){
					slick.currentSlide = 10;
					for(var i = count - 1; i >=0 ; i--) {
				 		slick.slickRemove(i);
					}
					$('.form-filtro-calendario').removeClass('form-loading');
				});

			}
		},

		iniciarCalendarioFormulario: function() {
			$('.form-filtro-calendario').on('submit', function(event){
				event.preventDefault();
				base.carrossel.atualizaCalendarioCompletoEventos();
			});
		},

		status: true,
		adicionarEventos: function(slick, pos, params, addBefore, $callback) {
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
									<a href="' + evento.permalink + '"><strong>' + evento.title + '</strong> </a> \
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
					var count = slick.slideCount;
					slick.slickAdd(html_el, pos, addBefore);
					if($callback) $callback(slick, count);

					base.carrossel.status = true;
					$('.box-calendar__control button.slick-arrow').removeClass("slick-disabled");
					$('.box-calendar__control button.slick-arrow').attr("disabled", !base.carrossel.status);
				},
				error: function(e) {

					base.carrossel.status = true;
					$('.box-calendar__control button.slick-arrow').removeClass("slick-disabled");
					$('.box-calendar__control button.slick-arrow').attr("disabled", !base.carrossel.status);
				}
			});
		},

		iniciarCalendarioCompleto: function() {
			var $carousel = $('.carousel-calendar-box');

			$('.carousel-calendar').on('afterChange', function(event, slick, currentSlide) {
				if (base.carrossel.status == true ) {
					if (slick.slideCount - slick.currentSlide <= 7) {

						base.carrossel.status = false;
						$('.box-calendar__control button.slick-arrow').addClass("slick-disabled");
						$('.box-calendar__control button.slick-arrow').attr("disabled", !base.carrossel.status);

						var dia = $('.carousel-calendar li:last-of-type').data('dia');
						var param = {day:dia, left:0, rigth:20};
						base.carrossel.adicionarEventos(slick, slick.slideCount-1, param, false);
					} else if (slick.currentSlide <= 7) {
						base.carrossel.status = false;
						$('.box-calendar__control button.slick-arrow').addClass("slick-disabled");
						$('.box-calendar__control button.slick-arrow').attr("disabled", !base.carrossel.status);

						var dia = $('.carousel-calendar li:first-of-type').data('dia');
						var param = {day:dia, left:20, rigth:0};
						base.carrossel.adicionarEventos(slick, 0, param, true);
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
				$carousel = $boxCarousel.find('.list-tabs__main'),
				itens = $carousel.find('a');

			if (itens.length > 2) {
				$carousel.on('init', function(event, slick, currentSlide, nextSlide) {
					$boxCarousel.find('.box-tabs__control').addClass('active');
				});

				$carousel.slick({
					speed: 500,
					infinite: false,
					slidesToShow: 4,
					slidesToScroll: 1,
					prevArrow: $boxCarousel.find('.control__prev'),
					nextArrow: $boxCarousel.find('.control__next'),
					adaptiveHeight: true,
					responsive: [
						{
							breakpoint: 1200,
							settings: {
								slidesToShow: 3
							}
						},
						{
							breakpoint: 992,
							settings: {
								slidesToShow: 2
							}
						},
						{
							breakpoint: 767,
							settings: {
								slidesToShow: 1
							}
						}
					]
				});
			}
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

			$('.carousel-highlights').on('init', function(event, slick) {
				var $caption = $('.carousel-highlights__box'),
					largura = ($('.carousel-highlights__caption-0').outerWidth()),
					padding = 20;

				$caption.css('width',largura + (padding * 2));
			});

			$('.carousel-highlights').slick({
				speed: 1000,
				fade: true,
				infinite: true,
				autoplay: true,
				autoplaySpeed: 4000,
				slidesToShow: 1,
				prevArrow: $carousel.find('.control__prev'),
				nextArrow: $carousel.find('.control__next'),
				dots: true,
				adaptiveHeight: true
			})
			.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
				var $caption = $('.carousel-highlights__box'),
					largura = ($('.carousel-highlights__caption-' + nextSlide).outerWidth()),
					padding = 20;

				$caption.css('width',largura + (padding * 2));

				$('.carousel-highlights__captions')
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
					speed: 500,
					infinite: false,
					slidesToShow: 4,
					slidesToScroll: 4,
					prevArrow: $carousel.find('.control__prev'),
					nextArrow: $carousel.find('.control__next'),
					adaptiveHeight: true,
					responsive: [
						{
							breakpoint: 1200,
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
				speed: 500,
				infinite: false,
				slidesToShow: 2,
				slidesToScroll: 1,
				autoplay: false,
				prevArrow: $carousel.find('.control__next'), // Botoes trocados de proposito
				nextArrow: $carousel.find('.control__prev'),
				adaptiveHeight: true,
				variableWidth: true,
				initialSlide: 1,
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
					.find('.carousel-schedule__image-' + nextSlide)
					.addClass('visible');

				$('.box-carousel-schedule .color-artes-visuais hr').css({
					'width':'150%',
					'transform': 'translate(20%,0)'
				});
			})
			.on('afterChange', function() {
				$('.box-carousel-schedule .color-artes-visuais hr').css({
					'width':'100%',
					'transform': 'translate(0,0)'
				});
				$('.box-carousel-schedule li.slick-active+.slick-active hr').css('width','70%');
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
				initialSlide: 1,
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
			$('#s').on('focus',function() {
				$(this).parents('.box-searchform').addClass('active');
			});

			$('#searchsubmit').on('blur',function() {
				$(this).parents('.box-searchform').removeClass('active');
			});

			$('.searchform-button').on('click',function() {
				$(this).parents('.box-searchform').toggleClass('active');
			});

			$('.box-searchform').on('click',function(e) {
				e.stopPropagation();
			});

			$('body,.searchcancel').on('click',function() {
				$('.box-searchform').removeClass('active');
			});
		}
	},

	jsNaoObstrusivo: {
		ativar: function() {
			$('body').addClass('js');
		}
	}
};
