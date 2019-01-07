<style type="text/css">
a.add-relatorio-arquivos-diversos {
	padding: 5px 10px;
	background: #CEC;
	border: 1px solid #AEA;
	color: black;
	text-decoration: none;
	margin: 0 0 0 5px;
}
</style>
<input type="hidden" name="relatorios_arquivos_diversos_custombox" id="relatorios_arquivos_diversos_custombox" value="<?php echo $nonce; ?>" />
<h3>Arquivos Diversos</h3>
<a href="#" title="" class="add-relatorio-arquivos-diversos">Adicionar</a>
<div class="repeat">
	<?php
	$i = 1;
	if ($arquivos_diversos == "" || !isset($arquivos_diversos['arquivos']) ) {
		$arquivos_diversos = array('arquivos' => array(array('url' => '', 'descricao' => '')));
	}
	?>
	<table class="form-table table-relatorio-arquivos-diversos">
		<thead>
			<tr>
				<th>Descrição</th>
				<th>URL</th>
				<th>opção</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($arquivos_diversos['arquivos'] as $arquivo) : ?>
				<tr valign="middle">
					<td>
						<input type="text" name="arquivos-diversos[arquivos][<?php echo $i; ?>][descricao]" id="arquivo_descricao-<?php echo $i; ?>" value="<?php echo $arquivo['descricao']; ?>" />
					</td>
					<td>
						<input type="text" name="arquivos-diversos[arquivos][<?php echo $i; ?>][url]" id="arquivo_url-<?php echo $i; ?>" value="<?php echo $arquivo['url']; ?>" />
					</td>
					<td>
						<a href="#" class="remove">Excluir</a>
					</td>
				</tr>
			<?php	$i++; endforeach; ?>
		</tbody>
	</table>
	<div style="height: 10px">
	</div>
</div>

<script type="text/javascript">
	jQuery('a.add-relatorio-arquivos-diversos').click(function(e) {
		e.preventDefault();
		total = jQuery('table.table-relatorio-arquivos-diversos tr').size();
		total++;
		var table_row = '<tr> \
											<td> \
												<input type="text" name="arquivos-diversos[arquivos][' + total + '][descricao]" id="arquivo_descricao-' + total + '" value="" /> \
											</td> \
											<td> \
												<input type="text" name="arquivos-diversos[arquivos][' + total + '][url]" id="arquivo_url-' + total + '" value="" /> \
											</td> \
											<td> \
												<a href="#" class="remove">Excluir</a> \
											</td> \
										<tr>'
		jQuery('table.table-relatorio-arquivos-diversos tr:last').after(table_row);
	});

	jQuery('a.remove').live('click', function(e) {
		e.preventDefault();
		jQuery(this).closest('table.table-relatorio-arquivos-diversos tr').remove();
		i = 1;
		jQuery('div.repeat table.table-relatorio-arquivos-diversos').each(function() {
			$('tr:first th strong', this).text((i++) + 'º contato');
		});
	});
</script>