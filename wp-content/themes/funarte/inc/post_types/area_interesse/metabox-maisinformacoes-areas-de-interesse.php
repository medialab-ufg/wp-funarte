<input type="hidden" name="maisinfo_areas-de-interesse_custombox" id="maisinfo_regioanal_custombox" value="<?php echo $nonce; ?>" />
<table class="form-table areas-de-interesse-maisinformacoes-metabox">
	<tbody>
		<tr valign="middle">
			<th scope="row"><label for="areas-de-interesse-coordenador">Coordenador</label></th>
			<td>
				<input type="text" id="areas-de-interesse-coordenador" name="area-de-interesse[coordenador]" style="width:100%" value="<?php echo $coordenador; ?>" />
				<p class="description"><strong>Exemplo:</strong> João da Silva</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="areas-de-interesse-telefone1">Telefone 1</label></th>
			<td>
				<input type="text" id="areas-de-interesse-telefone1" name="area-de-interesse[telefone1]" style="width: 35%" value="<?php echo $telefone1; ?>">
				<p class="description"><strong>Exemplo:</strong> (21) 2533-8090</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="areas-de-interesse-telefone2">Telefone 2</label></th>
			<td>
				<input type="text" id="areas-de-interesse-telefone2" name="area-de-interesse[telefone2]" style="width: 35%" value="<?php echo $telefone2; ?>">
				<p class="description"><strong>Exemplo:</strong> (21) 2533-8090</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="areas-de-interesse-fax">Fax</label></th>
			<td>
				<input type="text" id="areas-de-interesse-fax" name="area-de-interesse[fax]" style="width: 35%" value="<?php echo $fax; ?>">
				<p class="description"><strong>Exemplo:</strong> (21) 2533-8090</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="areas-de-interesse-coordenador">E-mail</label></th>
			<td>
				<input type="text" id="areas-de-interesse-coordenador" name="area-de-interesse[email]" style="width:100%" value="<?php echo $email; ?>" />
				<p class="description"><strong>Exemplo:</strong> contato@centro.com.br</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="areas-de-interesse-endereco">Endereço</label></th>
			<td>
				<input type="text" id="areas-de-interesse-endereco" name="area-de-interesse[endereco]" style="width: 80%" value="<?php echo $endereco; ?>">
				<p class="description"><strong>Exemplo:</strong> Rua da Impresa 16, sala 1308, Centro - Rio de Janeiro - RJ</p>
			</td>
		</tr>
	</tbody>
</table>