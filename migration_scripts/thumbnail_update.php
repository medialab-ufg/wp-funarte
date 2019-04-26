<?php 

$path_to_itens = 'teste_funarte.csv';

#Connecting with Wordpress:
$_SERVER['SERVER_PROTOCOL'] = "HTTP/1.1";
$_SERVER['REQUEST_METHOD'] = "GET";
        
define( 'WP_USE_THEMES', false );
define( 'SHORTINIT', false );

#define('ABSPATH', dirname(__FILE__) . '\wp\');

require( 'C:\wamp\www\funarte\wp-blog-header.php');

$itemsRepo = \Tainacan\Repositories\Items::get_instance();
$itemMedia = \Tainacan\Media::get_instance();


if (($handle = fopen($path_to_itens, "r")) == TRUE) {
	
	echo "Importando o csv..", "\n";
	
	$cont=0;
	
	while(($data = fgetcsv($handle, 0, ",")) == TRUE){
		
		if($cont == 0){
		
			echo("Pulando Cabeçalio", "\n");
			
		}else{
			
			$idMedia = $itemMedia->insert_attachment_from_file($data[1]);
			
			if(is_int($idMedia)){				
				
				echo "Upload da Imagem ", $data[1], " concluído!", "\n";
				
			}else{
				
				echo "Erro no upload da Imagem ", data[1], "\n";
			}
			
			$item = $itemsRepo->fetch($data[0], 'OBJECT');
			
			echo "Adicionando a imagem como thumbnail do Item ", $item->get_title(), "\n";
			
			$item->set__thumbnail_id($idMedia);
			
			if ($item->validate()) {
				
				$item = $itemsRepo->insert($item);
				echo "Item Validado e Thumbnail adicionada com sucesso!", "\n";
				
			}else{
				
				echo "Não foi possível validar o Item";
				
			}
			
			die;
		}
		
	$cont+=1;
	
	}

fclose($handle);

}
?>
