<?php 

#define('ABSPATH', dirname(__FILE__) . '\wp\');

require_once('wp-config.php');

$posts = new WP_Query([
    'cat' => 9,
    'posts_per_page' => -1
]);

#Gerar documentos anexados no TAINACAN - Seta o primeiro como document_id e os outros dois muda o post_parent e coloca o ID do item#



function scrapeImage($text) {
    $pattern = '/src=[\'"]?([^\'" >]+)[\'" >]/';
    preg_match($pattern, $text, $link);
    $link = $link[1];
    $link = urldecode($link);
    return $link;

}

while ($posts->have_posts()) {
    
    $posts->the_post();
    
##Variáveis dos Posts##
    
	#post->ID; #ID do post
    echo $title = $post->post_title, "\n"; #Título do Post
    #$post_link = get_permalink($post); #Link do Post
    #$post_content = $post->post_content; #Conteúdo do Post - !Verificar como remover parte indesejada do conteúdo.!
    

##Documentos Anexados aos Posts (Audios)##

    #Verificando a existencia de documentos anexados ao post.

    $att = $media = get_attached_media('audio');
    
	$count_att = 0;
	$count_link = 0;
    if ($att) {
		
		foreach ($att as $atch) {
			$count_att++;
			echo $count_att, ' - ';
			echo $atch->ID; #IDs dos documentos anexados ao post.
			echo "\n";
		}
 
    } else{
		
	#Verificando os posts com documentos anexados por link no conteúdo.
		
		$content = $post->post_content;
		preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $content, $matches);
		$links = $matches[0];
		
		foreach ($links as $link){
			
			
			if (strpos($link, '.mp3') !== false){
				$count_link++;
				
				echo $count_link, ' - ';
				echo attachment_url_to_postid($link); #IDs dos documentos anexados ao post via link.
				echo "\n";
			}
		}
			
	}
    
    
    
    echo "\n";
    
    
}



 ?>
