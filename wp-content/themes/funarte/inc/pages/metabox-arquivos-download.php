<style type="text/css">
a.add-relatorio-downloads {
	padding: 5px 10px;
	background: #CEC;
	border: 1px solid #AEA;
	color: black;
	text-decoration: none;
	margin: 0 0 0 5px;
}
</style>
<input type="hidden" name="relatorios_download_custombox" id="relatorios_download_custombox" value="<?php echo $nonce; ?>" />
<h3>Outros downloads</h3>
<a href="#" title="" class="add-relatorio-downloads">Adicionar</a>
<div class="repeat">
	<?php
	$i = 1;
	if (empty($download['links'])) {
		$download['links'] = array(array('link' => '', 'descricao' => ''));
	}
	?>
	<table class="form-table table-relatorio-downloads">
		<thead>
			<tr>
				<th>Descrição</th>
				<th>URL</th>
				<th>opção</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($download['links'] as $link) : ?>
				<tr valign="middle">
					<td>
						<input type="text" name="download[links][<?php echo $i; ?>][descricao]" id="download_descricao-<?php echo $i; ?>" value="<?php echo $link['descricao']; ?>" />
					</td>
					<td>
						<input type="text" name="download[links][<?php echo $i; ?>][url]" id="download_url-<?php echo $i; ?>" value="<?php echo $link['url']; ?>" />
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
	jQuery('a.add-relatorio-downloads').click(function(e) {
		e.preventDefault();
		total = jQuery('table.table-relatorio-downloads tr').size();
		total++;
		var table_row = '<tr> \
											<td> \
												<input type="text" name="download[links][' + total + '][descricao]" id="download_descricao-' + total + '" value="" /> \
											</td> \
											<td> \
												<input type="text" name="download[links][' + total + '][url]" id="download_url-' + total + '" value="" /> \
											</td> \
											<td> \
												<a href="#" class="remove">Excluir</a> \
											</td> \
										<tr>'
		jQuery('table.table-relatorio-downloads tr:last').after(table_row);
	});

	jQuery('a.remove').live('click', function(e) {
		e.preventDefault();
		jQuery(this).closest('table.table-relatorio-downloads tr').remove();
		i = 1;
		jQuery('div.repeat table.table-relatorio-downloads').each(function() {
			$('tr:first th strong', this).text((i++) + 'º contato');
		});
	});
</script>