<input type="hidden" name="espaco_custombox" id="espaco_details_custombox" value="<?php echo $nonce; ?>" />

<table class="form-table espaco-details-metabox">
	<tr valign="middle">
		<th scope="row"><label for="espacoRua">Rua</label></th>
		<td>
			<input type="text" name="espaco[rua]" id="espacoRua" style="width: 50%" value="<?php echo $espaco['rua']; ?>" />
			<p class="description">Logradouro / Rua do espaço cultural - <strong>Exemplo:</strong> São José</p>
		</td>
	</tr>
	<tr valign="middle">
		<th scope="row"><label for="espacoNumero">Número e Complemento</label></th>
		<td>
			<input type="text" name="espaco[numero]" id="espacoNumero" style="width: 10%" value="<?php echo $espaco['numero']; ?>" /> /
			<input type="text" name="espaco[complemento]" id="espacoComplemento" style="width: 10%" value="<?php echo $espaco['complemento']; ?>" />
			<p class="description">Número e Complemento do espaço cultural - <strong>Exemplo:</strong> 50 / 12º andar</p>
		</td>
	</tr>
	<tr valign="middle">
		<th scope="row"><label for="espacoBairro">Bairro</label></th>
		<td>
			<input type="text" name="espaco[bairro]" id="espacoBairro" style="width: 40%" value="<?php echo $espaco['bairro']; ?>" />
			<p class="description">Bairro do espaço cultural - <strong>Exemplo:</strong> Centro</p>
		</td>
	</tr>
	<tr valign="middle">
		<th scope="row"><label for="espacoCidade">Cidade</label></th>
		<td>
			<input type="text" name="espaco[cidade]" id="espacoCidade" style="width: 30%" value="<?php echo $espaco['cidade']; ?>" />
			<p class="description">Cidade do espaço cultural - <strong>Exemplo:</strong> Rio de Janeiro</p>
		</td>
	</tr>
	<tr valign="middle">
		<th scope="row"><label for="espacoEstado">Estado</label></th>
		<td>
			<input type="text" name="espaco[estado]" id="espacoEstado" style="width: 40%" value="<?php echo $espaco['estado']; ?>" />
			<p class="description">Estado do espaço cultural - <strong>Exemplo:</strong> Rio de Janeiro</p>
		</td>
	</tr>
	<tr valign="middle">
		<th scope="row"><label for="espacoCep">CEP</label></th>
		<td>
			<input type="text" name="espaco[cep]" id="espacoCep" style="width: 20%" value="<?php echo $espaco['cep']; ?>" />
			<p class="description">CEP do espaço cultural - <strong>Exemplo:</strong> 20220-202</p>
		</td>
	</tr>
	<tr valign="middle">
		<th scope="row"><label for="espacoMaplink">Link do Google Maps</label></th>
		<td>
			<input type="text" name="espaco[maplink]" id="espacoMaplink" style="width: 80%" value="<?php echo $espaco['maplink']; ?>" />
			<p class="description">Link do local do espaço cultural no Google Maps - <strong>Exemplo:</strong> <a href="http://maps.google.com/maps?oe=UTF-8&q=Rua+S%C3%A3o+Jos%C3%A9,+50+-+Centro+-+Rio+de+Janeiro,+RJ&ie=UTF8&hq=&hnear=R.+S%C3%A3o+Jos%C3%A9,+50+-+Centro,+Rio+de+Janeiro,+20010-020,+Brasil&ei=Jm-aTJuEE8P98AahoKly&ved=0CBUQ8gEwAA&z=16" target="_blank">http://maps.google.com/maps?oe=UTF-8&q=Rua+S%C3%A3o+Jos%C3%A9,+50+-+Centro+-+Rio+de+Janeiro,+RJ&ie=UTF8&hq=&hnear=R.+S%C3%A3o+Jos%C3%A9,+50+-+Centro,+Rio+de+Janeiro,+20010-020,+Brasil&ei=Jm-aTJuEE8P98AahoKly&ved=0CBUQ8gEwAA&z=16</a></p>
		</td>
	</tr>
</table>

<h3>Mais Informações (Contato)</h3>		
<table class="form-table espaco-details-metabox">
	<tr valign="middle">
		<th scope="row"><label for="espacoLink">Link de contato</label></th>
		<td>
			<input type="text" name="espaco[link]" id="espacoLink" style="width: 80%" value="<?php echo $espaco['link']; ?>" />
			<p class="description">Link para mais informações - <strong>Exemplo:</strong> <a href="http://www.funarte.gov.br/" target="_blank">http://www.funarte.gov.br/</a></p>
		</td>
	</tr>
	<tr valign="middle">
		<th scope="row"><label for="espacoEmail">E-mail de contato</label></th>
		<td>
			<input type="text" name="espaco[email]" id="espacoEmail" style="width: 35%" value="<?php echo $espaco['email']; ?>" />
			<p class="description">E-mail para mais informações - <strong>Exemplo:</strong> contato@funarte.gov.br</p>
		</td>
	</tr>
	<tr valign="middle">
		<th scope="row"><label for="espacoTelefone1">1º Telefone de contato</label></th>
		<td>
			<input type="text" name="espaco[telefone1]" id="espacoTelefone1" style="width: 20%" value="<?php echo $espaco['telefone1']; ?>" />
			<p class="description">Telefone para mais informações - <strong>Exemplo:</strong> (21) 1111-1111</p>
		</td>
	</tr>
	<tr valign="middle">
		<th scope="row"><label for="espacoTelefone2">2º Telefone de contato</label></th>
		<td>
			<input type="text" name="espaco[telefone2]" id="espacoTelefone2" style="width: 20%" value="<?php echo $espaco['telefone2']; ?>" />
			<p class="description">Telefone para mais informações - <strong>Exemplo:</strong> (21) 1111-1111</p>
		</td>
	</tr>
</table>