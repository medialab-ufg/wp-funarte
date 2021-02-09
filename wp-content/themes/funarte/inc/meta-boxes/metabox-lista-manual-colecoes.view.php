<style type="text/css">
a.add-lista-manual-colecao {
	padding: 5px 10px;
	background: #CEC;
	border: 1px solid #AEA;
	color: black;
	text-decoration: none;
	margin: 0 0 0 5px;
}
</style>

<h3>Lista de coleções</h3>
<a href="#" title="" class="add-lista-manual-colecao">Adicionar</a>
<div class="repeat">
	<?php
	$i = 1;
	if ( empty($item_list) || !isset($item_list['colecoes']) ) {
		$item_list = array('colecoes' => array(array('url' => '', 'nome' => '', 'url_imagem' => '')));
	}
	?>
	<table class="form-table table-lista-manual-colecao">
		<thead>
			<tr>
				<th>Nome</th>
				<th>URL</th>
				<th>URL imagem</th>
				<th>opção</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($item_list['colecoes'] as $item) : ?>
				<tr valign="middle">
					<td>
						<input
							type="text" 
							name="cedoc-lista[colecoes][<?php echo $i; ?>][nome]"
							id="colecao_nome-<?php echo $i; ?>" value="<?php echo $item['nome']; ?>"
						/>
					</td>
					<td>
						<input
							type="text"
							name="cedoc-lista[colecoes][<?php echo $i; ?>][url]"
							id="colecao_url-<?php echo $i; ?>" value="<?php echo $item['url']; ?>"
						/>
					</td>
					<td>
						<input
							type="text"
							name="cedoc-lista[colecoes][<?php echo $i; ?>][url_imagem]"
							id="colecao_url_imagem-<?php echo $i; ?>" value="<?php echo $item['url_imagem']; ?>"
						/>
					</td>
					<td>
						<a href="#" class="remove">Excluir</a>
					</td>
				</tr>
			<?php $i++; endforeach; ?>
		</tbody>
	</table>
	<div style="height: 10px">
	</div>
</div>

<script type="text/javascript">
	jQuery('a.add-lista-manual-colecao').click(function(e) {
		e.preventDefault();
		total = jQuery('table.table-lista-manual-colecao tr').size();
		total++;
		var table_row =
			'<tr> \
				<td> \
					<input type="text" name="cedoc-lista[colecoes][' + total + '][nome]" id="colecao_nome-' + total + '" value="" /> \
				</td> \
				<td> \
					<input type="text" name="cedoc-lista[colecoes][' + total + '][url]" id="colecao_url-' + total + '" value="" /> \
				</td> \
				<td> \
					<input type="text" name="cedoc-lista[colecoes][' + total + '][url_imagem]" id="colecao_url_imagem-' + total + '" value="" /> \
				</td> \
				<td> \
					<a href="#" class="remove">Excluir</a> \
				</td> \
			<tr>'
		jQuery('table.table-lista-manual-colecao tr:last').after(table_row);
	});

	jQuery('a.remove').live('click', function(e) {
		e.preventDefault();
		jQuery(this).closest('table.table-lista-manual-colecao tr').remove();
		i = 1;
		jQuery('div.repeat table.table-lista-manual-colecao').each(function() {
			$('tr:first th strong', this).text((i++) + 'ª coleção');
		});
	});
</script>