<?php 

#OBS - Gerar documentos anexados no TAINACAN - Seta o primeiro como document_id e os outros dois muda o post_parent e coloca o ID do item#


#Connecting with Wordpress:
$_SERVER['SERVER_PROTOCOL'] = "HTTP/1.1";
$_SERVER['REQUEST_METHOD'] = "GET";
        
define( 'WP_USE_THEMES', false );
define( 'SHORTINIT', false );

#define('ABSPATH', dirname(__FILE__) . '\wp\');


require( 'C:\wamp\www\funarte\wp-blog-header.php');

$collectionsRepo = \Tainacan\Repositories\Collections::get_instance();
$metadataRepo = \Tainacan\Repositories\Metadata::get_instance();
$itemsRepo = \Tainacan\Repositories\Items::get_instance();
$itemMetadataRepo = \Tainacan\Repositories\Item_Metadata::get_instance();


##Criando a coleção dos resgistros do Estúdio F##

$collection = new \Tainacan\Entities\Collection();
$collection->set_name('Edições Online');
$collection->set_status('publish');
$collection->set_description('Coleção com os registros do Edições Online');

flush_rewrite_rules();

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
}

##Recuperando registros do site e adicionando à coleção.##


function set_att_parent($id_att, $id_item) {
	
	global $wpdb;
	
	$wpdb->query( "UPDATE $wpdb->posts SET post_parent = $id_item WHERE ID = $id_att ");
	
}

$collection = $collectionsRepo->fetch(['name'=>'Edições Online'], 'OBJECT');
$collection = $collection[0];



require_once('wp-config.php');


$posts = new WP_Query([
    'post_type' => 'edicao-online',
    'posts_per_page' => -1,
    
]);


while ($posts->have_posts()) {
	
	$posts->the_post();

	$item = new \Tainacan\Entities\Item();
	$item->set_title($post->post_title);
	$item->set_status('publish');
	$item->set_collection($collection);
	
	if ($item->validate()) {
		
		$item = $itemsRepo->insert($item);
		$metadatum = $metadataRepo->fetch(['name' => 'Título'], 'OBJECT');
		$metadatum = $metadatum[0];
		$itemMetadata = new \Tainacan\Entities\Item_Metadata_Entity($item, $metadatum);
		$itemMetadata->set_value($post->post_title);
		
		if ($itemMetadata->validate()) {
						
			$itemMetadataRepo->insert($itemMetadata);
						
		}else {
			echo 'Erro no metadado ', $metadatum->get_name(), ' no item ', $post->post_title;
			$erro = $itemMetadata->get_errors();
			echo var_dump($erro);
		}
		
		$metadatum = $metadataRepo->fetch(['name' => 'Descrição'], 'OBJECT');
		$metadatum = $metadatum[0];
		$itemMetadata = new \Tainacan\Entities\Item_Metadata_Entity($item, $metadatum);
		$itemMetadata->set_value($post->post_content);
		
		if ($itemMetadata->validate()) {
						
			$itemMetadataRepo->insert($itemMetadata);
						
		}else {
			echo 'Erro no metadado ', $metadatum->get_name(), ' no item ', $post->post_title;
			$erro = $itemMetadata->get_errors();
			echo var_dump($erro);
		}

		#Validando Item
		if ($item->validate()) {
	
			$item = $itemsRepo->insert($item);
			echo 'Item ', $post->post_title, ' - inserted', "\n";
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
   
   
	$thumb_link = get_the_post_thumbnail($post);
	echo $thumb_link;
	preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $thumb_link, $matches);
	$thumb = $matches[0];
	
	$item->set__thumbnail_id(attachment_url_to_postid($thumb[0]));
	
	if ($item->validate()){
		$itemsRepo->insert($item);
		echo "Salvando item com Thumbnail \n";
	} else{
		echo 'Item não validado: ', $item->get_title();
	}

#Documentos Anexados aos Posts (Audios)#

    #Verificando a existencia de documentos anexados ao post.

    $att = $media = get_attached_media('');
    
	

    if ($att) {
		
		$count_att = 0;
		
		foreach ($att as $atch) {
			$count_att++;
			echo $count_att, ' - ';
			echo $atch->ID; #IDs dos documentos anexados ao post.
			echo "\n";
			
			if ($count_att == 1){
				
				$item->set_document($atch->ID);
				$item->set_document_type('attachment');
				
				if ($item->validate()){
					$itemsRepo->insert($item);
					echo "Salvando item com documento setado\n";
				} else{
					echo 'Item não validado: ', $item->get_title();
				}
				
			}else{
				
				set_att_parent($atch->ID, $item->get_id());
				#wp_update_post(Array('ID' => $atch->ID, 'post_parent' => $item->get_id()));
				
				if ($item->validate()){
					
					$itemsRepo->insert($item);
					echo "Salvando item com documento setado\n";
									
				} else{
					echo 'Item não validado: ', $item->get_title();
				}
			}
		}
    }

}
 ?>
