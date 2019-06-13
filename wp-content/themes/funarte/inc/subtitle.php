<?php
add_action('edit_page_form', 'subtitle_field');
add_action('edit_form_advanced', 'subtitle_field');
add_action('save_post', 'subtitle_save');

/*
 * Monta o campo de texto, estiliza para descer os outros campos e o jquery força sua aparição abaixo do campo de título
 *
 * @return void
 */
function subtitle_field() {
	global $post;
	if($post->post_type == 'post') { 
	$subtitle = get_post_meta($post->ID, 'subtitle', true);
?>
	<div id="subtitle">
		<label for="post_subtitle"><?php echo __('Subtítulo'); ?></label>
		<input type="text" tabindex="1" size="30" id="post_subtitle" name="post_subtitle" value="<?php echo $subtitle; ?>" />
	</div>
	<script type="text/javascript">
		jQuery('#subtitle').appendTo('#titlewrap');
	</script>
	<style>
		#subtitle { margin: 10px 0 0; }
		#post_subtitle {
			font-size: 1.7em;
			outline: medium none;
			padding: 3px 4px;
			width: 100%;
		}
	</style>
<?php
	}
}

/*
 * Salva o campo de subtítulo
 */
function subtitle_save($postID) {
	if (isset($_POST['post_subtitle']) && !empty($_POST['post_subtitle']))
		update_post_meta($postID, 'subtitle', htmlentities($_POST['post_subtitle'], ENT_QUOTES, 'UTF-8', false));
}


/*
 * Retorna o valor inserido no campo de subtitulo
 *
 * @param $id - ID do post
 * 
 * @return string
 */
function get_the_subtitle( $id = 0 ) {
	$post = get_post($id);

	$id = isset($post->ID) ? $post->ID : (int) $id;

	$subtitle = get_post_meta($id, 'subtitle', true);

	$subtitle = apply_filters('the_title', $subtitle, $id);

	return $subtitle;
}

/*
 * Imprime o subtítulo
 *
 * @param string $before - texto para ser inserido antes do subtítulo
 * @param string $after - texto para ser inserido depois do subtítulo
 * @param boolean $echo - true - imprime a string, false - retorna o novo subtitulo gerado
 *
 * @return void|string
 */
function the_subtitle($before = '', $after = '', $echo = true) {
	global $post;


	$subtitle = get_the_subtitle($post->ID);
	
	$subtitle = $before . $subtitle . $after;
	
	if ( $echo )
		echo $subtitle;
	else
		return $subtitle;
}
?>