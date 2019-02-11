<?php 

#define('ABSPATH', dirname(__FILE__) . '\wp\');

require_once('wp-config.php');

$posts = new WP_Query([
    'cat' => 9,
    'posts_per_page' => -1
]);


function scrapeImage($text) {
    $pattern = '/src=[\'"]?([^\'" >]+)[\'" >]/';
    preg_match($pattern, $text, $link);
    $link = $link[1];
    $link = urldecode($link);
    return $link;

}

#var_dump( attachment_url_to_postid('http://localhost/funarte/wp-content/uploads/2016/12/EF-324-Novos-Baianos-bloco-3.mp3') ); die;

while ($posts->have_posts()) {
    
    $posts->the_post();
    
    #echo get_permalink($post); #Link do Post
    #echo 'Post ID - ', $post->ID, ' '; # ID do post
    

    #Verificando se tem documentos anexados ao post.

    $att = $media = get_attached_media('audio');
    
    if ($att) {
        // seta o primeiro como document_id e os outros dois muda o post_parent e coloca o ID do item
		foreach ($att as $atch) {
			#echo 'Att ID - ', $atch->ID, ' ';
			
			}
 
    } else {
		

		
		$content = $post->post_content;
		echo preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $content, $matches);
		$links = $matches[0];
		
		foreach ($links as $link){
			if (strpos($link, '.mp3') !== false){
				echo attachment_url_to_postid($link4, "\n";	
			}
		}
			
	}die;
    
    
    // seta o primeiro como document_id e os outros dois muda o post_parent e coloca o ID do item
    
    echo "\n";
    
    
}



 ?>
