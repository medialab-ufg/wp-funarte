<?php 

#OBS - Gerar documentos anexados no TAINACAN - Seta o primeiro como document_id e os outros dois muda o post_parent e coloca o ID do item#


#Connecting with Wordpress:
$_SERVER['SERVER_PROTOCOL'] = "HTTP/1.1";
$_SERVER['REQUEST_METHOD'] = "GET";
        
define( 'WP_USE_THEMES', false );
define( 'SHORTINIT', false );

#define('ABSPATH', dirname(__FILE__) . '\wp\');

require_once('wp-blog-header.php');

$collectionsRepo = \Tainacan\Repositories\Collections::get_instance();
$metadataRepo = \Tainacan\Repositories\Metadata::get_instance();
$itemsRepo = \Tainacan\Repositories\Items::get_instance();
$itemMetadataRepo = \Tainacan\Repositories\Item_Metadata::get_instance();


##Criando a coleção dos resgistros do Estúdio F##

$collection = new \Tainacan\Entities\Collection();
$collection->set_name('Estúdio F');
$collection->set_status('publish');
$collection->set_description('Coleção com os registros do Estúdio F.');


if ($collection->validate()) {
	$insertedCollection = $collectionsRepo->insert($collection);
	
	
	#Setando Metadados Núcleo.
	$collection_core_metadata = $metadataRepo->get_core_metadata($insertedCollection);
	
	foreach ($collection_core_metadata as $coreMetadata) {
		
		if($coreMetadata->get_name() == 'Title'){
			$coreMetadata->set_name('Título');
			$coreMetadata->set_description('Título do Programa.');
			echo "Atualizando Core Field: ", 'Título', "\n";
			
			if ($coreMetadata->validate()){
				$insertedMetadata = $metadataRepo->insert($coreMetadata);
			}else {
					$erro = $coreMetadata->get_errors();
					var_dump($erro);
			}
			
		}elseif($coreMetadata->get_name() == 'Description'){
			$coreMetadata->set_name('Descrição');
			$coreMetadata->set_description('Descrição do Programa.');
			echo "Atualizando Core Field: ", 'Descrição', "\n";
			
			if ($coreMetadata->validate()){
				$insertedMetadata = $metadataRepo->insert($coreMetadata);
			}else {
					$erro = $coreMetadata->get_errors();
					var_dump($erro);
			}
		}
	}
	
	#Criando Metadado para 'Artista' verificar a necessidade de taxonomia.
	$metadado = new \Tainacan\Entities\Metadatum();
	$metadado->set_collection($insertedCollection);
	$metadado->set_name('Artista');
	$metadado->set_description('Nome do artista participante.');
	$metadado->set_metadata_type('Tainacan\Metadata_Types\Text');
	$metadado->set_status('publish');
	$metadado->set_display('yes');
	
	if ($metadado->validate()){
		$insertedMetadata = $metadataRepo->insert($metadado);
	}else {
		$erro = $metadado->get_errors();
		var_dump($erro);
	}
}

#Função para a Inserção dos Itens
function item_insert($metadata_title, $content){
	
	$collection = $collectionsRepo->fetch(['name'=>'Estúdio F'], 'OBJECT');
	$collection = $collection[0];

	$item = new \Tainacan\Entities\Item();
	$item->set_title($metadata_title);
	$item->set_status('publish');
	$item->set_collection($collection);

	if ($item->validate()) {
		
		$item = $itemsRepo->insert($item);
		$metadatum = $metadataRepo->fetch(['name' => $metadata_title], 'OBJECT');
		$metadatum = $metadatum[0];
		$itemMetadata = new \Tainacan\Entities\Item_Metadata_Entity($item, $metadatum);
		$itemMetadata->set_value($content);
		
		#Validando ItemMetadata
		if ($itemMetadata->validate()) {
						
			$itemMetadataRepo->insert($itemMetadata);
						
		}else {
			echo 'Erro no metadado ', $metadatum->get_name(), ' no item ', 'Título';
			$erro = $itemMetadata->get_errors();
			echo var_dump($erro);
		}
		
		#Validando Item
		if ($item->validate()) {
	
			$item = $itemsRepo->insert($item);
			echo 'Item ', 'Título', ' - inserted', "\n";
		}else{
			echo 'Erro no preenchientos dos campos', "\n";
			$errors = $item->get_errors();
			var_dump($errors);
			echo  "\n\n";
			die;
		}
	
	}else{
		echo 'Erro no Metadados', 'Título';
		echo  "\n\n";
		var_dump($item);
		echo  "\n\n";
		die;
	}
	return $item;
}

##Recuperando registros do site e adicionando à coleção.##
require_once('wp-config.php');

$posts = new WP_Query([
    'cat' => 9,
    'posts_per_page' => -1
]);


while ($posts->have_posts()) {
    
    $posts->the_post();
    
#Recuperando valores#
    
	#post->ID; #ID do post
    #$post_link = get_permalink($post); #Link do Post
    
    #$post->post_title; #Título do Post *
    item_insert('Título', $post->post_title);
    
    #$post->post_content; #Conteúdo do Post - !Verificar como remover parte indesejada do conteúdo.! *
    item_insert('Descrição', $post->post_content);
    
    #explode(" - ", $title)[1]; #Artista *
    item_insert('Artista',explode(" - ", $post->post_title)[1]);

#Documentos Anexados aos Posts (Audios)#

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

}



 ?>
