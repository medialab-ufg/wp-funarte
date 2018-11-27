<input type="hidden" name="aquisicao-nonce" id="aquisicao-nonce" value="<?php echo $nonce; ?>" />

<table class="form-table">
	<tbody>
		<tr valign="middle">
			<th scope="row" width="50%" style="vertical-align: middle">
				<label for="relatorio-ano">Mês da aquisição</label>
			</th>
			<td width="50%">
				<select id="aquisicao-mes" name="mes" style="width: 90px" />
				<?php
				$mes = date('n', $timestamp ? $timestamp : time());
				$mes_atual = date('n');
				for ($i = 1; $i <= 12; $i++) { ?>
					<?php $selected = ((empty($mes) && ($i == $mes_atual)) || ($mes == $i)) ? 'selected="selected"' : ''; ?>
					<option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo date_i18n('F', strtotime('January +'. ($i - 1) .' month')); ?></option>
				<?php } ?>
				</select>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row" width="50%" style="vertical-align: middle">
				<label for="aquisicao-ano">Ano da aquisição</label>
			</th>
			<td width="50%">
				<select id="aquisicao-ano" name="ano" style="width: 60px" />
				<?php
				$ano = date('Y', $timestamp ? $timestamp : time());
				$ano_atual = date('Y');
				for ($i = ($ano_atual - 10); $i <= ($ano_atual + 1); $i++) { ?>
					<?php $selected = ((empty($ano) && ($i == $ano_atual)) || ($ano == $i)) ? 'selected="selected"' : ''; ?>
					<option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
				<?php } ?>
				</select>
			</td>
		</tr>
	</tbody>
</table>