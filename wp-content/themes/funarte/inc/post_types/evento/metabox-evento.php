<style type="text/css">
		#evento_custombox table.evento-metabox input.date {
			background: transparent url('<?php echo $THEME_FOLDER; ?>/assets/img/ico/ico-calendar.png') 98% center no-repeat;
			width: 105px;
		}
		#evento_custombox table.evento-metabox input:focus {
			background-color: #FFC;
		}
		#evento_custombox table.evento-metabox input.hour {
			width: 50px;
		}
		#evento_custombox table.evento-metabox label.check-label {
			font-weight: bold;
		}
		#evento_custombox table.form-table th,
		#evento_custombox table.form-table td {
			padding: 5px 10px;
		}
		</style>
		
		<input type="hidden" name="evento_custombox" id="evento_custombox" value="<?php echo $nonce; ?>" />
		<table class="form-table evento-metabox">
			<tr valign="middle">
				<th scope="row" style="vertical-align: middle">Mais de um dia</th>
				<td>
					<input type="radio" name="evento[multiplo]" id="multiploSim" value="1" <?php if ($evento['multiplo']) { ?>checked="checked"<?php } ?> /> <label for="multiploSim" class="check-label">Sim</label>&nbsp;&nbsp;
					<input type="radio" name="evento[multiplo]" id="multiploNao" value="0" <?php if (!$evento['multiplo']) { ?>checked="checked"<?php } ?> /> <label for="multiploNao" class="check-label">Não</label>
				</td>
			</tr>
			<tr valign="middle">
				<th scope="row" style="vertical-align: middle">Dia inteiro</th>
				<td>
					<input type="radio" name="evento[diainteiro]" id="diainteiroSim" value="1" <?php if ($evento['diainteiro']) { ?>checked="checked"<?php } ?> /> <label for="diainteiroSim" class="check-label">Sim</label>&nbsp;&nbsp;
					<input type="radio" name="evento[diainteiro]" id="diainteiroNao" value="0" <?php if (!$evento['diainteiro']) { ?>checked="checked"<?php } ?> /> <label for="diainteiroNao" class="check-label">Não</label>
				</td>
			</tr>
			<tr valign="middle">
				<th scope="row" style="vertical-align: middle"><label for="dataInicio"><?php if (!$evento['multiplo']) { ?>Data do evento<?php } else { ?>Data inicial<?php } ?></label></th>
				<td><input type="text" class="date" name="evento[data_inicio]" id="dataInicio" value="<?php echo date('d/m/Y', $evento['inicio']); ?>" /></td>
			</tr>
			<tr valign="middle" <?php if (!$evento['multiplo']) { ?>style="display: none"<?php } ?>>
				<th scope="row" style="vertical-align: middle"><label for="dataFim">Data final</label></th>
				<td><input type="text" class="date" name="evento[data_fim]" id="dataFim" value="<?php echo date('d/m/Y', $evento['fim']); ?>" /></td>
			</tr>
			
			<tr valign="middle" <?php if ($evento['diainteiro']) { ?>style="display: none"<?php } ?>>
				<th scope="row" style="vertical-align: middle"><label for="horaInicio">Hora de início</label></th>
				<td><input type="text" class="hour" name="evento[hora_inicio]" id="horaInicio" value="<?php echo date('H:i', $evento['inicio']); ?>" /></td>
			</tr>
			<tr valign="middle" <?php if ($evento['diainteiro']) { ?>style="display: none"<?php } ?>>
				<th scope="row" style="vertical-align: middle"><label for="horaFim">Hora de término</label></th>
				<td><input type="text" class="hour" name="evento[hora_fim]" id="horaFim" value="<?php echo date('H:i', $evento['fim']); ?>" /></td>
			</tr>
			
			<tr valign="middle" class="msg-horas" <?php if ($evento['diainteiro']) { ?>style="display: none"<?php } ?>>
				<td style="vertical-align: middle; text-align: center; background: #FFC; line-height: 15px" colspan="2">Use horas como <b>HH:MM</b> no formato 23:59</td>
			</tr>
		</table>
		
		<h3>Notícia Relacionada</h3>
		<div id="related_post_container">
			<?php echo $this->get_evento_related_post_metabox_content($post->ID); ?>
		</div>
		
		<script type="text/javascript">
		jQuery(document).ready(function() {
			// Data de início
			jQuery('#dataInicio').datepicker({
				dateFormat: 'dd/mm/yy',
				showButtonPanel: true,
				showOtherMonths: true,
				onSelect: function (dateText, inst) {
					$('#dataFim').datepicker('option', 'minDate', dateText);
				}
			});
			// Data de término
			jQuery('#dataFim').datepicker({
				dateFormat: 'dd/mm/yy',
				showButtonPanel: true,
				showOtherMonths: true,
				minDate: '<?php echo $evento['fim']; ?>'
			});

			// Ativando o dia múltiplo
			jQuery('#multiploSim').click(function() {
				jQuery('label[for=dataInicio]').text('Data inicial');
				jQuery('#dataFim').parent().parent().fadeIn();
			});
			// Desativando o dia múltiplo
			jQuery('#multiploNao').click(function() {
				jQuery('label[for=dataInicio]').text('Data do evento');
				jQuery('#dataFim').parent().parent().fadeOut();
			});

			// Ativando dia inteiro
			jQuery('#diainteiroSim').click(function() {
				jQuery('#horaInicio').parent().parent().fadeOut();
				jQuery('#horaFim').parent().parent().fadeOut();
				jQuery('tr.msg-horas').fadeOut();
			});
			// Desativando dia inteiro
			jQuery('#diainteiroNao').click(function() {
				jQuery('#horaInicio').parent().parent().fadeIn();
				jQuery('#horaFim').parent().parent().fadeIn();
				jQuery('tr.msg-horas').fadeIn();
			});
			// Criando post relacionado
			jQuery('#criar-noticia-relacionada').click(function() {
				jQuery(this).attr('disabled', 'disabled');
				jQuery(this).val('Criando...');
				jQuery.get(ajaxurl, {action: 'evento_create_related_post', event_id: jQuery('#post_ID').val()}, function(data) {
					jQuery('#related_post_container').html(data);
				});
			});
		});
		</script>