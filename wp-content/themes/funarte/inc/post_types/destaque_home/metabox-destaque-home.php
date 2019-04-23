<input type="hidden" name="destaque_custom_box" id="destaque_custom_box" value="<?php echo $nonce; ?>" display="none" />
	
<style>
	table#form_destaque_home tr {
		height: 40px;
		line-height: 18px;
	}
	
	table#form_destaque_home tr td{
		padding-top: 3px;
	}
	
	table#form_destaque_home tr td input{
		margin-right: 10px;
	}
</style>

<table width="90%" id="form_destaque_home">
	<tr>
		<td width="35%">
			<label for="destaque-url">URL</label>
		</td>
		<td width="65%">
			<input type="text" id="destaque_url" name="destaque[url]" style="width:100%;" value="<?php echo esc_url($destaqueurl); ?>" />
		</td>
	</tr>
	<tr>
		<td width="15%">
			<label for="destaque-home_site">Destaque</label>
		</td>
		<td width="85%">
			<input type="checkbox" id="destaque-home_site" name="destaque[home_site]" <?php if($destaquehomesite) { echo 'checked = "checked"';} ?> /><label for="destaque-home_site">Destacar na Home principal do portal</label><br />
			<input type="checkbox" id="destaque-home_area" name="destaque[home_area]" <?php if($destaquehomearea) { echo 'checked = "checked"';} ?> /><label for="destaque-home_area">Destacar na Home da área de interesse</label><br />
			<input type="checkbox" id="destaque-secundario" name="destaque[secundario]" <?php if($secundario) { echo 'checked = "checked"';} ?> /><label for="destaque-secundario">Destaque como Secundário</label><br />
		</td>
	</tr>
	<!-- <tr>
		<td width="15%">
			<label for="destaque-posicao">Posição</label>
		</td>
		<td width="85%">
			<input type="radio" id="destaque-posicao-1" name="destaque[posicao]" value="1" <?php if($posicao == 1) {echo 'checked == "checked"';} ?> /><label for="destaque-posicao-1">Destaque principal com imagem </label><br />
			<input type="radio" id="destaque-posicao-2" name="destaque[posicao]" value="2" <?php if($posicao == 2) {echo 'checked == "checked"';} ?>/><label for="destaque-posicao-2">Destaque lateral</label>
		</td>
	</tr> -->
	<tr>
		<td width="15%">
			<label for="destaque-posicao">Onde abrir</label>
		</td>
		<td width="85%">
			<input type="radio" id="destaque-target-1" name="destaque[target]" value="_self" <?php if($target == "_self") {echo 'checked == "checked"';} ?> />&nbsp;<label for="destaque-target-1">Mesma janela</label><br />
			<input type="radio" id="destaque-target-2" name="destaque[target]" value="_blank" <?php if($target == "_blank") {echo 'checked == "checked"';} ?>/>&nbsp;<label for="destaque-target-2">Nova janela ou aba (links externos)</label>
		</td>
	</tr>
</table>