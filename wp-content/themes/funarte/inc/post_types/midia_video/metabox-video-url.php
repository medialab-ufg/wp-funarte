<input type="hidden" name="video_url_custom_box" id="video_url_custom_box" value="<?php echo $nonce; ?>" display="none" />
	
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

<table width="90%" id="form_video_midia">
	<tr>
		<td width="20%">
			<label for="url">URL</label>
		</td>
		<td width="80%">
			<input type="text" id="video_url" name="video_url" style="width:100%;" value="<?php echo esc_url($url); ?>" />
		</td>
	</tr>
</table>