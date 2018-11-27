<style type="text/css">
	#licitacao_custombox table.licitacao-metabox input.date {		
		background: transparent url('<?php echo $THEME_FOLDER; ?>/assets/img/ico/ico-calendar.png') 98% center no-repeat;
		width: 105px;
	}
	#licitacao_custombox table.licitacao-metabox input.date:focus {
		background-color: #FFC;
	}
	#licitacao_custombox table.licitacao-metabox label.check-label {
		font-weight: bold;
	}
	#licitacao_custombox table.form-table th,
	#licitacao_custombox table.form-table td {
		padding: 5px 10px;
	}
	#licitacao_custombox table.licitacao-metabox input.hour {
		width: 50px;
	}
	#licitacao_custombox table.licitacao-metabox input.hour:focus {
		background-color: #FFC;
	}
</style>

<input type="hidden" name="licitacao_custombox" id="licitacao_custombox" value="<?php echo $nonce; ?>" />
<table class="form-table licitacao-metabox">
	<tr valign="middle">
		<th scope="row" style="vertical-align: middle"><label for="licitacao-numero">Número da licitação</label></th>
		<td><input type="text" name="licitacao-numero" id="licitacao-numero" value="<?php echo $licitacao_numero; ?>" /></td>
	</tr>
	<tr valign="middle">
		<th scope="row" style="vertical-align: middle"><label for="licitacao-data">Data da licitação</label></th>
		<td><input type="text" class="date" name="licitacao-data" id="licitacao-data" value="<?php echo $licitacao_data ?>" /></td>
	</tr>
	<tr valign="middle">
		<th scope="row" style="vertical-align: middle"><label for="licitacao-hora">Hora da licitaçao</label></th>
		<td><input type="text" class="hour" name="licitacao-hora" id="licitacao-hora" value="<?php echo $licitacao_hora; ?>" /></td>
	</tr>
	<tr valign="middle" class="msg-horas">
		<td style="vertical-align: middle; text-align: center; background: #FFC; line-height: 15px" colspan="2">Use horas como <b>23:59</b> no formato HH:MM</td>
	</tr>
</table>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#licitacao-data').datepicker({
			dateFormat: 'dd/mm/yy',
			showButtonPanel: true,
			showOtherMonths: true,
		});
	});
</script>