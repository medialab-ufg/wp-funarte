<?php

/*
 * Retorna todos os áudios anexados a um post
 *
 * @return array - com informações sobre cada midia
 */
function get_post_audios($postID = null){
	$media = get_post_files($postID, array('post_mime_type' => 'audio'), false);
	return $media;
}

/*
 * Retorna todos os vídeos anexados a um post
 *
 * @return array - com informações sobre cada midia
 */
function get_post_videos($postID = null){
	$media = get_post_files($postID, array('post_mime_type' => 'video'), false);
	return $media;
}

/*
 * Retorna todas as imagens anexadas a um post
 *
 * @return array - com informações sobre cada midia
 */
function get_post_images($postID = null){
	$media = get_post_files($postID, array('post_mime_type' => 'image'), false);
	return $media;
}

/*
 * Exibe a busca com o resumo a partir do primeiro termo encontrado no conteúdo e os termos inseridos marcados
 *
 * @return void
 */
function the_highlight_search($conteudo, $busca, $margem = null, $read_more_link = null){
	global $post;
	
	if (is_null($margem))
		$margem = mb_strlen($conteudo);
		
	$conteudo = strip_tags($conteudo);
	
	//pega o conteudo do post
	#$conteudo = get_the_content($post_ID);
	//pega o item buscado
	#$busca = get_search_query();
	
	$busca_array = explode(' ', $busca);
	
	//limite de caracteres antes e depois do primeiro item encontrado.
	#$margem = 10;
	
	//posição do primeiro item encontrado
	$posicao = stripos($conteudo, $busca_array[0]);
	
	//tamanhos para formar o texto de aparição no resultado de busca
	$inicio = max(($posicao - $margem), 0);
	$fim = $posicao + mb_strlen($busca) + $margem;
	$length = $fim - $inicio;
	
	//resultado
	$texto = mb_substr($conteudo,$inicio, $length);
	
	//verficação e rotina para evitar se quebrar texto ao meio.
	if (($texto[0] !=' ') OR ($texto[strlen($texto)-1] != '.') OR ($texto[strlen($texto)-1] != '0')){
		while (($texto[0] != ' ') AND ($inicio > 0)){
			$inicio++;
			$texto = mb_substr($conteudo,$inicio, $length);
		}
		
		$last = $texto[strlen($texto)-1];
		
		while (preg_match('/([0-9a-z]|\p{L}|\p{Latin})/i', $last) && ($length < strlen($conteudo))) {
			$length++;
			$texto = mb_substr($conteudo, $inicio, $length);
			$last = $texto[strlen($texto)-1];
		}
	}
	
	//resultado final, após textos não serem quebrados
	$resumo = mb_substr($conteudo, $inicio, $length - 1);
	
	foreach ($busca_array AS &$busca)
		$busca = preg_quote($busca, '/');
	
	//marca as palavras encontradas
	$busca = implode('|', $busca_array);
	
	if (strlen($busca) > 3)
		$resumo = preg_replace("/({$busca})/i", '<strong class="light">\0</strong>', $resumo);
	
	if ($inicio > 0) {
		$resumo = '&hellip;' . trim($resumo);
	}
	
	if ($length < strlen($conteudo)) {
		if (!empty($read_more_link))
			$resumo = trim($resumo) . '&nbsp;<a href="' . $read_more_link . '" title="Leia mais">[...]</a>';
		else
			$resumo = trim($resumo) . '&hellip;';
	}
	      
	echo $resumo;
}



/**
 * Converte o tamanho do arquivo para uma exibição mais "humana"
 * 
 * Exemplos:
 *  1024 	-> 1 KB
 *  355744 	-> 347 KB
 *  
 * @author Eric Heudiard
 * @link http://www.php.net/manual/en/function.filesize.php#99333
 * 
 * @param int $size - Tamanho do arquivo (em bytes)
 * 
 * @return string - Tamanho do arquivo convertido
 */
function format_file_size($size) {
	$sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
	return ($size == 0) ? 0 : (round($size/pow(1024, ($i = floor(log($size, 1024)))), $i > 1 ? 2 : 0) . $sizes[$i]);
}



/**
 * Converte uma cor hexa decimal para o equivalente em RGB 
 *
 * @param string $hexStr - hexadecimal
 * @param boolean $returnAsString 
 * @param string $seperator - separa os valores do rgb. Aplicável apensar se o segundo parametro for true.
 * @return array or string - depende do segundo parametro. Retorna false se o valor de hexadecimal for inválido
 */                                                                                                
function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}

 /*
 * Retorna a cor hexadecimal de uma categoria baseado no slug
 *
 * @param string $slug - Slug da categoria
 * @return string;
 */
function getCategoryColor($slug = false) {
	if(!$slug){
		$slug = get_the_category();
		$slug = $slug[0]->category_nicename;
	}
	
	switch($slug) {
		case 'artes-integradas':
			return 'BB2200';
			break;
		case 'artes-visuais':
			return '0099AA';
			break;
		case 'circo';
			return 'CC0055';
			break;
		case 'danca':
			return '9AA336';
			break;
		case 'literatura':
			return '664499';
			break;
		case 'musica':
			return 'F6972D';
			break;
		case 'teatro':
			return '3B8313';
			break;
		default:
			return '2F546C';
	}
	
}

 /*
 * Exibe o hexadecimal de uma categoria baseado no slug
 *
 * @param string $slug - Slug da categoria
  */
function theCategoryColor($slug){
	echo '#'.getCategoryColor($slug);
}

/**
 * Add custom mime types
 * 
 * @param array $old - Old mime types (defined by WordPress)
 * 
 * @return array
 */
function custom_mime_types($old = array()) {	
	$new = array(
		'ai'	=> 'application/postscript',
		'cdr'	=> 'image/x-coreldraw',
		'eps'	=> 'image/x-eps',
		'rar'	=> 'application/x-rar-compressed'
	);
	unset($old['bmp']);
	
	return array_merge($old, $new);	
}

add_filter('upload_mimes', 'custom_mime_types');

 /*
 * Retorna a classe certa para o mimetype
 *
 * @return string;
 */
function getMimeTypeIcon($mimetype) {
	switch($mimetype){
		case 'text/richtext':
		case 'application/rtf':
		case 'text/plain':
		case 'application/x-vnd.oasis.opendocument.text':
			return 'rtf';
			break;
		case 'application/msword':
			return 'doc';
			break;
		case 'application/pdf':
		case 'application/pdfx':
			return 'pdf';
			break;
		case 'application/zip':
		case 'application/x-rar':
		case 'application/x-rar-compressed':
		case 'application/x-7z':
			return 'zip';
			break;
		case 'image/jpeg':
		case 'image/png':
		case 'image/gif':
			return 'jpg';
			break;
		case 'image/tiff':
			return 'tiff';
			break;
		case 'application/vnd.ms-excel':
		case 'application/msexcel':
			return 'xls';
			break;
		case 'application/vnd.ms-powerpoint':
			return 'ppt';
			break;
		case 'application/postscript':
			return 'ai';
			break;
		case 'image/x-coreldraw':
			return 'cdr';
			break;
		case 'image/x-eps':
			return 'eps';
			break;		
		default:
			return 'file';			
	}
	
}

 /*
 * Quebra uma url do google maps, separando em array os valores encontrados
 *
 * @param string $map_url - Url gerado pelo box "link" do Google Maps
 * @return array or false;
 */
function gmaps_url($map_url) {	
	$maps = parse_url($map_url);
	parse_str($maps['query'], $maps);
	if(empty($maps) OR !preg_match('/^-?\d+\.\d+,-?\d+\.\d+$/',$maps['ll']))
		return false;
	else {
		$mapa = explode(',', $maps['ll'], 2);
		$mapa = array('latitude' => $mapa[0], 'longitude' => $mapa[1], 'zoom' => $maps['z']);
		return $mapa;
	}
}


 /*
 * Gera uma imagem de thumb do mapa
 *
 * @param string $name - Nome da imagem (local);
 * @param string $latitude - Latitude do mapa;
 * @param string $longitude - Longitude do mapa;
 * @param string $zoom - Nível de zoom do mapa;
 * @param string $width - Largura do thumb de imagem gerado;
 * @param string $height - Altura do thumb de imagem gerado;
 * @param string $type - Tipo de mapa (valores possíveis: 'hybrid', 'satellite', 'roadmap', 'terrain');
 * @param string $letra - Letra em Caixa Alta para aparecer no Marcador (valor padrão 'F');
 * @param string $cor - Cor do marcador (valores possíveis: black, brown, green, purple, yellow, blue, gray, orange, red, white ou hexa '0xFFFFCC');
 * @param string $size - Tamanho do marcador (valores possíveis: tiny, mid, small);
 * 
 * @return string;
 */
function the_gmaps_src($name, $latitude, $longitude, $zoom = 15, $width = 194, $height = 120, $type = 'roadmap', $letra = 'A', $cor = '0xFF6600', $size = 'mid' ){
	return 	'http://maps.google.com/maps/api/staticmap?' .
				'center=' . $latitude . ',' . $longitude . 
				'&zoom=' . $zoom . 
				'&size=' . $width . 'x' . $height . 
				'&maptype=' . $type . 
				'&markers=' . 'size:' . $size . '|color:' . $cor . '|label:' . $letra . '|' . $latitude . ',' . $longitude . 
				'&sensor=false';
}

/**
 * Retorna a primeira categoria de um post
 * 
 * @param int $postID - ID do post
 * 
 * @return object
 */
function get_single_category($postID = null) {
	global $post, $Edital;
	
	if (is_null($postID) && is_null($post)) return false;
	
	$postID = (!is_null($postID)) ? $postID : $post->ID;

	$cat = get_the_category($postID);
	
	/**
	 * Se não encontrou uma categoria
	 * OU
	 * Tem mais de uma categoria
	 * OU
	 * É um edital
	 */
	if (empty($cat) || (count($cat) > 1) || $Edital->isEdital($postID))
		return get_category_by_name('Funarte');
	else 
		return $cat[0];	
}


/**
 * Retorna a primeira slug de categoria de um post
 * 
 * @return string
 */
function category_body_class($extra = null) {
	$class = get_body_class();

	wp_reset_query();
	
	$category = get_single_category();
	
	if (is_single() || is_page() && !empty($category))
		if (!is_evento() && !is_edital() && !is_espacocultural() && !is_page('Notícias'))
			$class[] = $category->slug;
	
	if (!empty($extra))
		$class[] = $extra;
		
	if (in_array('Estúdio F', $class))
		$class[] = 'Música';
		
	return join(' ', array_unique($class));
}

/**
 * Retorna o objeto da categoria pelo seu nome
 * 
 * @param string $name - Nome da categoria
 * 
 * @return object
 */
function get_category_by_name($name) {
	$categoria =get_term_by('name', $name, 'category');
	if(!$categoria)
		$categoria = get_term_by('slug', $name, 'category');
	return $categoria;
}

/**
 * Retorna a URL de redimensionamento do thumbnail de um post
 * 
 * @param int $postID - ID do post
 * @param int $width - Largura do thumbnail
 * @param int $height - Altura do thumbnail
 * 
 * @return string
 */
function get_resized_post_thumbnail_url($postID, $width = null, $height = null, $quality = 80) {
	$thumbnail = wp_get_attachment_url(get_post_thumbnail_id($postID));
	return get_resized_imagem_url($thumbnail, $width, $height, $quality);
}

/**
 * Retorna a URL de redimensionamento de uma imagem
 * 
 * @param int $url - URL da imagem
 * @param int $width - Largura
 * @param int $height - Altura
 * 
 * @return string
 */
function get_resized_imagem_url($url, $width = null, $height = null, $quality = 80) {
	$url = str_replace(get_bloginfo('url') . '/wp-content/', '', $url);
	$thumbnail = get_bloginfo('template_url') . '/thumbnail.php?image=' . $url;
	if (!empty($width)) $thumbnail .= '&amp;width=' . $width;
	if (!empty($height)) $thumbnail .= '&amp;height=' . $height;
	if (!empty($quality)) $thumbnail .= '&amp;quality=' . max(0, min($quality, 100));
	
	return $thumbnail;
}

/**
 * Retorna o texto alternativo do thumbnail de um post
 * 
 * @param int $postID - ID do post
 * 
 * @return string
 */
function get_post_thumbnail_alt($postID) {
	return get_image_alt(get_post_thumbnail_id($postID));
}

/**
 * Retorna o texto alternativo da imagem de um post
 * 
 * @param int $postID - ID do post
 * 
 * @return string
 */
function get_image_alt($postID) {
	$alt = get_post_meta($postID, '_wp_attachment_image_alt', true);
	return !empty($alt) ? $alt : get_the_title($postID);
}

/**
 * Retorna a legenda do thumbnail de um post
 * 
 * @param int $postID - ID do post
 * 
 * @return string
 */
function get_post_thumbnail_legend($postID) {
	return get_image_legend(get_post_thumbnail_id($postID));
}

/**
 * Retorna a legenda doa imagem de um post
 * 
 * @param int $postID - ID do post
 * 
 * @return string
 */
function get_image_legend($postID) {
	$attachment = get_post($postID);
	return (!empty($attachment->post_excerpt)) ? $attachment->post_excerpt : get_image_alt($attachment->ID);
}

/**
 * Insere um widget passando alguns parâmetros para o mesmo * 
 * 
 * @param string $name - Nome do widget (dentro da pasta /widgets/) sem o .php
 * @param array $params - Parâmetros para passar para o widget
 * 
 * @return void
 */
function get_widget($name, $params = array()) {
	global $html;
	
	require(THEME_FOLDER . DS . 'widgets' . DS . $name . '.php');
	
	if (isset($html_widget) && isset($params['return']) && $params['return'])
		return $html_widget;
}

/**
 * Monta o bloco de thumbnail de um post
 * 
 * @param int $postID - Post ID
 * @param array $params - Parâmetros adicionais (width, height, before e after)
 * 
 * @return void
 */
function post_thumbnail($postID = null, $params = array()) {
	global $post, $html;
	
	$params = array_merge(array(
		'width' => 380,
		'height' => 280,
		'before' => '',
		'after' => '',
		'class' => ''
	), $params);
	
	$postID = (is_null($postID) ? $post->ID : (int)$postID);
	
	if (!has_post_thumbnail($postID)) return;
	
	$link = wp_get_attachment_url(get_post_thumbnail_id($postID));
	$thumbnail = get_resized_post_thumbnail_url($postID, $params['width'], $params['height']);
	
	$img = $html->img($thumbnail, array('alt' => get_post_thumbnail_alt($postID), 'width' => $params['width'], 'height' => $params['height']));
	?>	
	<?php echo $params['before']; ?>
	<div class="img-evento <?php echo $params['class']; ?>">		
		<?php echo $html->link($img, $link, array('title' => get_post_thumbnail_legend($postID), 'escape' => false, 'rel' => 'shadowbox')); ?>

		<?php if (get_post_thumbnail_legend($postID)) { ?>
		<div class="legenda-foto">
			<span><?php echo get_post_thumbnail_legend($postID); ?></span>
		</div>
		<?php } ?>
	</div>
	<?php echo $params['after']; ?>		
	<?php
}

/**
 * Retorna as ID3 tags de um arquivo
 * 
 * @param $arquivo Endereço do arquivi
 * 
 * @return array
 */
function get_ID3($arquivo) {
	require_once(THEME_FOLDER . 'php' . DS . 'libs' . DS . 'getid3' . DS . 'getid3.php');

	$getID3 = new getID3;
	$info = $getID3->analyze($arquivo);
	
	$tags = array('title', 'composer', 'artist', 'album', 'year', 'genre', 'track_number', 'comment');

	$id3 = array();
	foreach ($tags AS $tag) {
		if (isset($info['tags']['id3v2'][$tag]) && !empty($info['tags']['id3v2'][$tag])) {
			$valor = $info['tags']['id3v2'][$tag];
			if ($tag != 'artist')
				$id3[$tag] = $info['tags']['id3v2'][$tag][0];
			else
				$id3[$tag] = join(', ', $info['tags']['id3v2'][$tag]);
			$id3[$tag] = htmlentities($id3[$tag], ENT_QUOTES);
		}
	}
	return $id3;
}
?>