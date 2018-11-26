<input type="hidden" name="evento_custombox" id="evento_details_custombox" value="<?php echo $nonce; ?>" />

<table class="form-table evento-details-metabox">
	<tr valign="middle">
		<th scope="row"><label for="eventoLocal">Local do evento</label></th>
		<td>
			<textarea name="evento[local]" id="eventoLocal" style="width: 80%; height: 40px"><?php echo $evento['local']; ?></textarea>
			<p class="description">Endereço do evento - <strong>Exemplo:</strong> Rua São José, 50 - Centro - Rio de Janeiro, RJ</p>
		</td>
	</tr>
	<tr valign="middle">
		<th scope="row"><label for="eventoMaplink">Link do Google Maps</label></th>
		<td>
			<input type="text" name="evento[maplink]" id="eventoMaplink" style="width: 80%" value="<?php echo $evento['maplink']; ?>" />
			<p class="description">Link do local do evento no Google Maps - <strong>Exemplo:</strong> <a href="http://maps.google.com/maps?oe=UTF-8&q=Rua+S%C3%A3o+Jos%C3%A9,+50+-+Centro+-+Rio+de+Janeiro,+RJ&ie=UTF8&hq=&hnear=R.+S%C3%A3o+Jos%C3%A9,+50+-+Centro,+Rio+de+Janeiro,+20010-020,+Brasil&ei=Jm-aTJuEE8P98AahoKly&ved=0CBUQ8gEwAA&z=16" target="_blank">http://maps.google.com/maps?oe=UTF-8&q=Rua+S%C3%A3o+Jos%C3%A9,+50+-+Centro+-+Rio+de+Janeiro,+RJ&ie=UTF8&hq=&hnear=R.+S%C3%A3o+Jos%C3%A9,+50+-+Centro,+Rio+de+Janeiro,+20010-020,+Brazil&ei=Jm-aTJuEE8P98AahoKly&ved=0CBUQ8gEwAA&ll=-22.905165,-43.17525&spn=0.007689,0.009667&z=17</a></p>
		</td>
	</tr>
</table>

<h3>Mais Informações (Contato)</h3>
<table class="form-table evento-details-metabox">
	<tr valign="middle">
		<th scope="row"><label for="eventoLink">Link de contato</label></th>
		<td>
			<input type="text" name="evento[link]" id="eventoLink" style="width: 80%" value="<?php echo $evento['link']; ?>" />
			<p class="description">Link para mais informações - <strong>Exemplo:</strong> <a href="http://www.funarte.gov.br/" target="_blank">http://www.funarte.gov.br/</a></p>
		</td>
	</tr>
	<tr valign="middle">
		<th scope="row"><label for="eventoEmail">E-mail de contato</label></th>
		<td>
			<input type="text" name="evento[email]" id="eventoEmail" style="width: 35%" value="<?php echo $evento['email']; ?>" />
			<p class="description">E-mail para mais informações - <strong>Exemplo:</strong> contato@funarte.gov.br</p>
		</td>
	</tr>
	<tr valign="middle">
		<th scope="row"><label for="eventoTelefone">Telefone de contato</label></th>
		<td>
			<input type="text" name="evento[telefone]" id="eventoTelefone" style="width: 20%" value="<?php echo $evento['telefone']; ?>" />
			<p class="description">Telefone para mais informações - <strong>Exemplo:</strong> (21) 1111-1111</p>
		</td>
	</tr>
</table>