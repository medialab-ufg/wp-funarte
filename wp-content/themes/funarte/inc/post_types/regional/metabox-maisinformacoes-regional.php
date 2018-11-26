<style type="text/css">
a.add {
	padding: 5px 10px;
	background: #CEC;
	border: 1px solid #AEA;
	
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	
	color: black;
	text-decoration: none;
	
	margin: 0 0 0 5px;
}
</style>

<input type="hidden" name="maisinfo_regional_custombox" id="maisinfo_regioanal_custombox" value="<?php echo $nonce; ?>" />

<table class="form-table regional-maisinformacoes-metabox">
	<tbody>
		<tr valign="middle">
			<th scope="row"><label for="regional-coordenador">Coordenador</label></th>
			<td>
				<input type="text" id="regional-coordenador" name="regional[coordenador]" style="width:100%" value="<?php echo $regional['coordenador']; ?>" />
				<p class="description"><strong>Exemplo:</strong> João da Silva</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="regional-telefone1">Telefone 1</label></th>
			<td>
				<input type="text" name="regional[telefone1]" id="regional-telefone1" style="width: 35%" value="<?php echo $regional['telefone1']; ?>">
				<p class="description"><strong>Exemplo:</strong> (21) 2533-8090</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="regional-telefone2">Telefone 2</label></th>
			<td>
				<input type="text" name="regional[telefone2]" id="regional-telefone2" style="width: 35%" value="<?php echo $regional['telefone2']; ?>">
				<p class="description"><strong>Exemplo:</strong> (21) 2533-8090</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="regional-fax">Fax</label></th>
			<td>
				<input type="text" name="regional[fax]" id="regional-fax" style="width: 35%" value="<?php echo $regional['fax']; ?>">
				<p class="description"><strong>Exemplo:</strong> (21) 2533-8090</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="regional-email">E-mail</label></th>
			<td>
				<input type="text" name="regional[email]" id="regional-email" style="width: 60%" value="<?php echo $regional['email']; ?>">
				<p class="description"><strong>Exemplo:</strong> contato@email.com</p>
			</td>
		</tr>
	</tbody>
</table>

<h3>Endereço</h3>
<table class="form-table regional-maisinformacoes-metabox">
	<tbody>
		<tr valign="middle">
			<th scope="row"><label for="regional-rua">Rua</label></th>
			<td>
				<input type="text" name="regional[rua]" id="regional-rua" style="width: 80%" value="<?php echo $regional['rua']; ?>">
				<p class="description"><strong>Exemplo:</strong> Rua São José</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="regional-numero">Número</label></th>
			<td>
				<input type="text" name="regional[numero]" id="regional-numero" style="width: 50%"  value="<?php echo $regional['numero']; ?>">
				<p class="description"><strong>Exemplo:</strong> 50</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="regional-complemento">Complemento</label></th>
			<td>
				<input type="text" name="regional[complemento]" id="regional-complemento" style="width: 50%"  value="<?php echo $regional['complemento']; ?>">
				<p class="description"><strong>Exemplo:</strong> sala 1220</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="regional-bairro">Bairro</label></th>
			<td>
				<input type="text" name="regional[bairro]" id="regional-bairro" style="width: 35%" value="<?php echo $regional['bairro']; ?>">
				<p class="description"><strong>Exemplo:</strong> Centro</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="regional-cidade">Cidade</label></th>
			<td>
				<input type="text" name="regional[cidade]" id="regional-cidade" style="width: 35%" value="<?php echo $regional['cidade']; ?>">
				<p class="description"><strong>Exemplo:</strong> Rio de Janeiro</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="regional-estado">Estado</label></th>
			<td>
				<input type="text" name="regional[estado]" id="regional-estado" style="width: 35%" value="<?php echo $regional['estado']; ?>">
				<p class="description"><strong>Exemplo:</strong> Rio de Janeiro</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="regional-cep">Cep</label></th>
			<td>
				<input type="text" name="regional[cep]" id="regional-cep" style="width: 35%" value="<?php echo $regional['cep']; ?>">
				<p class="description"><strong>Exemplo:</strong> 20010-020</p>
			</td>
		</tr>
	</tbody>
</table>

<h3>Contatos adicionais</h3>
<div class="repeat">
	<?php
	$i = 1;
	if (empty($regional['contatos'])) {
		$regional['contatos'] = array(
			array('area' => '', 'responsavel' => '', 'telefone' => '','email' => '')
		);
	}
	foreach ($regional['contatos'] as $contato) : ?>
		<table class="form-table regional-maisinformacoes-metabox contato-adicional">
			<tbody>
			<tr valign="middle">
				<th colspan="2" style="background: #ECECEC"><strong><?php echo $i; ?>º Contato</strong><?php if ($i > 1) { ?> <a href="#" class="remove">[Excluir este contato]</a><?php } ?></th>
			</tr>
			<tr valign="middle">
				<th scope="row"><label for="contatos_area-<?php echo $i; ?>">Área</label></th>
				<td>
					<input type="text" name="contatos[<?php echo $i; ?>][area]" id="contatos_area-<?php echo $i; ?>" style="width: 30%" value="<?php echo $contato['area']; ?>" />
					<p class="description"><strong>Exemplo:</strong> Administração</p>
				</td>
			</tr>
			<tr valign="middle">
				<th scope="row"><label for="contatos_responsavel-1">Responsável</label></th>
				<td>
					<input type="text" name="contatos[<?php echo $i; ?>][responsavel]" id="contatos_responsavel-<?php echo $i; ?>" style="width: 40%" value="<?php echo $contato['responsavel']; ?>" />
					<p class="description"><strong>Exemplo:</strong> Fulano da Silva</p>
				</td>
			</tr>
			<tr valign="middle">
				<th scope="row"><label for="contatos_telefone-<?php echo $i; ?>">Telefone</label></th>
				<td>
					<input type="text" name="contatos[<?php echo $i; ?>][telefone]" id="contatos_telefone-<?php echo $i; ?>" style="width: 25%" value="<?php echo $contato['telefone']; ?>" />
					<p class="description"><strong>Exemplo:</strong> (21) 1111-2222</p>
				</td>
			</tr>
			<tr valign="middle">
				<th scope="row"><label for="contatos_email-<?php echo $i; ?>">E-mail</label></th>
				<td>
					<input type="text" name="contatos[<?php echo $i; ?>][email]" id="contatos_email-<?php echo $i; ?>" style="width: 50%" value="<?php echo $contato['email']; ?>" />
					<p class="description"><strong>Exemplo:</strong> contato@orgao.gov.br</p>
				</td>
			</tr>
			</tbody>
		</table>
	<?php $i++; 
	endforeach; 
	?>
	<a href="#" title="" class="add">Adicionar novo contato</a>
	<div style="height: 10px">
	</div>
</div>

<script type="text/javascript">
	jQuery('a.add').click(function(e) {
		e.preventDefault();
		total = jQuery('table.contato-adicional').size();
		total++;
		$copy = jQuery('div.repeat table:eq(0)').clone();
		jQuery('tr:first th strong', $copy).text(total + 'º contato');
		jQuery('tr:first th strong', $copy).after(' <a href="#" class="remove">[Excluir este contato]</a>');
		jQuery('input', $copy).val('').each(function() {
			id = old_id = jQuery(this).attr('id');
			id = id.replace(/-[\d]+$/, '-' + total);
			name = jQuery(this).attr('name').replace(/contatos\[[\d]+\]/, 'contatos[' + total + ']');
			jQuery(this).attr('id', id).attr('name', name);
			jQuery('label[for=' + old_id + ']', $copy).attr('for', id);
		});
		$copy.hide();
		jQuery($copy).insertBefore(this).slideDown();
	});

	jQuery('a.remove').live('click', function(e) {
		e.preventDefault();
		jQuery(this).closest('table').remove();
		i = 1;
		jQuery('div.repeat table').each(function() {
			$('tr:first th strong', this).text((i++) + 'º contato');
		});
	});
</script>