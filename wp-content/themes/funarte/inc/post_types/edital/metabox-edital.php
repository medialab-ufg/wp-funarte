<style type="text/css">
	#edital_custombox table.edital-metabox input.date {
		background: transparent url('<?php echo $THEME_FOLDER; ?>/assets/img/ico/ico-calendar.png') 98% center no-repeat;
		width: 105px;
	}
	#edital_custombox table.edital-metabox input.date:focus {
		background-color: #FFC;
	}
	#edital_custombox table.edital-metabox label.check-label {
		font-weight: bold;
	}
	#edital_custombox table.form-table th,
	#edital_custombox table.form-table td {
		padding: 5px 10px;
	}
</style>

<input type="hidden" name="edital_custombox" id="edital_custombox" value="<?php echo $nonce; ?>" />
<table class="form-table edital-metabox">
	<tr valign="middle">
		<th scope="row" style="vertical-align: middle"><label for="inscricoesInicio">Início das inscrições</label></th>
		<td><input type="text" class="date" name="edital[inscricoes_inicio]" id="inscricoesInicio" value="<?php echo $edital['inscricoes_inicio']; ?>" /></td>
	</tr>
	<tr valign="middle">
		<th scope="row" style="vertical-align: middle"><label for="inscricoesFim">Fim das inscrições</label></th>
		<td><input type="text" class="date" name="edital[inscricoes_fim]" id="inscricoesFim" value="<?php echo $edital['inscricoes_fim']; ?>" /></td>
	</tr>
	<tr valign="middle">
		<th scope="row" style="vertical-align: middle">Inscr. prorrogadas</th>
		<td>
			<input type="radio" name="edital[prorrogado]" id="prorrogadoSim" value="1" <?php if ($edital['prorrogado']) { ?>checked="checked"<?php } ?> /> <label for="prorrogadoSim" class="check-label">Sim</label>&nbsp;&nbsp;
			<input type="radio" name="edital[prorrogado]" id="prorrogadoNao" value="0" <?php if (!$edital['prorrogado']) { ?>checked="checked"<?php } ?> /> <label for="prorrogadoNao" class="check-label">Não</label>
		</td>
	</tr>
	<tr valign="middle">
		<th scope="row" style="vertical-align: middle">Resultado publicado</th>
		<td>
			<input type="radio" name="edital[resultado]" id="resultadoSim" value="1" <?php if ($edital['resultado']) { ?>checked="checked"<?php } ?> /> <label for="resultadoSim" class="check-label">Sim</label>&nbsp;&nbsp;
			<input type="radio" name="edital[resultado]" id="resultadoNao" value="0" <?php if (!$edital['resultado']) { ?>checked="checked"<?php } ?> /> <label for="resultadoNao" class="check-label">Não</label>
		</td>
	</tr>
	<tr valign="middle">
		<td style="vertical-align: middle; text-align: center; background: #FFC; line-height: 15px" colspan="2">Se as inscrições forem prorrogadas troque também a data do fim das inscrições</td>
	</tr>
</table>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#inscricoesInicio').datepicker({
			dateFormat: 'dd/mm/yy',
			showButtonPanel: true,
			showOtherMonths: true,
			onSelect: function (dateText, inst) {
				$('#inscricoesFim').datepicker('option', 'minDate', dateText);
			}
		});

		jQuery('#inscricoesFim').datepicker({
			dateFormat: 'dd/mm/yy',
			showButtonPanel: true,
			showOtherMonths: true,
			minDate: '<?php echo $edital['inscricoes_inicio']; ?>'
		});
	});
</script>