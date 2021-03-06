
<?php

#Connecting to Wordpress
$_SERVER['SERVER_PROTOCOL'] = "HTTP/1.1";
$_SERVER['REQUEST_METHOD'] = "GET";

define( 'WP_USE_THEMES', false );
define( 'SHORTINIT', false );

$path_to_bh = 'C:\wamp\www\funarte\wp-blog-header.php';
$name_of_collection = 'Videos_Script';
$path_to_itens = 'itens_videos.csv';


#Path of wp
require($path_to_bh);



#Generating object instances for Collection, Metadata, Items, and Item_Metadata
$collectionsRepo = \Tainacan\Repositories\Collections::get_instance();
$metadataRepo = \Tainacan\Repositories\Metadata::get_instance();
$itemsRepo = \Tainacan\Repositories\Items::get_instance();
$itemMetadataRepo = \Tainacan\Repositories\Item_Metadata::get_instance();

#################################

#Getting the Colletion
$collection = $collectionsRepo->fetch(['name'=>$name_of_collection], 'OBJECT');
$collection = $collection[0];


$fh = fopen($path_to_itens, "r") or die("ERROR OPENING DATA");

while (($data = fgetcsv($fh, 0, ",")) == TRUE){
	$linecount++;
}
fclose($fh);


#Getting metadata title from csv array

if (($handle = fopen($path_to_itens, "r")) == TRUE) {
	
	$cont = 0;
	
	while (($data = fgetcsv($handle, 0, ",")) == TRUE){
		
		if($cont == 0){
			
			echo "Tratando primeira linha \n";
			$headers = array_map('trim', $data);
			
		}else{
			
			$item = new \Tainacan\Entities\Item();
			
			$item->set_title($data[0]);
			$item->set_status('publish');
			$item->set_collection($collection);
			
			if ($item->validate()) {
				
				$item = $itemsRepo->insert($item);
				for ($i = 0; $i <=sizeof($data); $i++) {
					
					$metadatum = $metadataRepo->fetch(['name' => $headers[$i]], 'OBJECT');
					$metadatum = $metadatum[0];
					
					
					if ($metadatum->get_metadata_type() == 'Tainacan\Metadata_Types\Taxonomy'){
						
						$itemMetadata = new \Tainacan\Entities\Item_Metadata_Entity($item, $metadatum);
						$taxonomy_value = explode("||",$data[$i]);
						$itemMetadata->set_value($taxonomy_value);
						
					} else if (strpos($metadatum->get_name(), 'MVL')!== false){
						
						$itemMetadata = new \Tainacan\Entities\Item_Metadata_Entity($item, $metadatum);
						$metadata_mvl = explode("||",$data[$i]);
						$itemMetadata->set_value($metadata_mvl);
					
					}else{
						
						$itemMetadata = new \Tainacan\Entities\Item_Metadata_Entity($item, $metadatum);
						$itemMetadata->set_value($data[$i]);
					}
					
					if ($itemMetadata->validate()) {
						
						$itemMetadataRepo->insert($itemMetadata);
						
					}else {
						echo 'Erro no metadado ', $metadatum->get_name(), ' no item ', $data[0];
						$erro = $itemMetadata->get_errors();
						echo var_dump($erro);
					}
				}
				if ($item->validate()) {
					$item = $itemsRepo->insert($item);
					echo 'Item ', $data[0], ' - inserted', "\n";
					echo $linecount-$cont, ' remain', "\n";
					echo ($cont/$linecount)*100, '% Completed', "\n" ,"\n";
				}else{
					echo 'Erro no preenchientos dos campos', $cont, "\n";
					$errors = $item->get_errors();
					var_dump($errors);
					echo  "\n\n";
					die;
				}
				
			}else {
				echo 'Erro na linha ', $cont;
				echo  "\n\n";
				var_dump($item);
				echo  "\n\n";
				die;
			}
			
		}
		$cont+=1;
	}
fclose($handle);
}


?>
