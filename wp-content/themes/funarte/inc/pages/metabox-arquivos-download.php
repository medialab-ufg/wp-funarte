<style type="text/css">
a.add {
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
<a href="#" title="" class="add">Adicionar</a>
<div class="repeat">
	<?php
	$i = 1;
	if (empty($download['links'])) {
		$download['links'] = array(array('link' => '', 'descricao' => ''));
	}
	?>
	<table class="form-table">
		<tbody>
			<?php foreach ($download['links'] as $link) : ?>
				<tr valign="middle">
					<td>
						<p class="description"><?php echo $link['descricao']; ?></p>
					</td>
					<td>
						<p class="link"><?php echo $link['link']; ?></p>
					</td>
				</tr>
			<?php	endforeach; ?>
		</tbody>
	</table>
	<div style="height: 10px">
	</div>
</div>