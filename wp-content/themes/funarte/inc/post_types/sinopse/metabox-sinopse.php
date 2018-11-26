<input type="hidden" name="sinopse_custombox" id="sinopse_custombox" value="<?php echo $nonce; ?>" />

<table class="form-table sinopse-maisinformacoes-metabox">
	<tbody>
		<tr valign="middle">
			<th scope="row"><label for="sinopse-ref">Referencia</label></th>
			<td>
				<input type="text" id="sinopse-ref" name="sinopse[ref]" style="width:35%" value="<?php echo $sinopse['ref']; ?>" />
				<p class="description"><strong>Exemplo:</strong> 7535</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="sinopse-paginas">Nº de páginas</label></th>
			<td>
				<input type="text" name="sinopse[paginas]" id="sinopse-telefone1" style="width: 35%" value="<?php echo $sinopse['paginas']; ?>">
				<p class="description"><strong>Exemplo:</strong> 285</p>
			</td>
		</tr>			
		<tr valign="middle">
			<th scope="row"><label for="sinopse-preco">Preço</label></th>
			<td>
				<span>R$</span><input type="text" name="sinopse[preco]" id="sinopse-preco" style="width: 35%" value="<?php echo $sinopse['preco']; ?>">
				<p class="description"><strong>Exemplo:</strong> 28,90</p>
			</td>
		</tr>
		<tr valign="middle">
			<th scope="row"><label for="sinopse-formato">Formato</label></th>
			<td>
				<input type="text" name="sinopse[formato]" id="sinopse-formato" style="width: 35%" value="<?php echo $sinopse['formato']; ?>">
				<p class="description"><strong>Exemplo:</strong> 23,5 x 99,7 cm</p>
			</td>
		</tr>
	</tbody>
</table>