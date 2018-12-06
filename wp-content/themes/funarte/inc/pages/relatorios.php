<?php 

namespace funarte;

class Relatorio {
	use Singleton;

	private $PAGE_SLUG = "relatorios";

	protected function init() {
		add_action( 'add_meta_boxes_page', array( &$this, "add_meta_boxes_page" ) );
	}	

	public function add_meta_boxes_page() {
		$post_ID = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
		$post = get_post( $post_ID );
		$slug = $post->post_name;
		
		if ( $this->PAGE_SLUG == $slug ) {
			add_meta_box( 'downloads_custombox' ,__( 'Downloads'),
				array($this, 'meta_box_downloads'), 'page', 'advanced' , 'high');
			
			add_meta_box( 'arquivos_diversos_custombox' ,__( 'Arquivos Diversos'),
				 array($this, 'meta_box_arquivos_diversos'), 'page', 'advanced' , 'high');
		}
	}

	function meta_box_downloads() {
		?>
			<p>This will render inside of the meta box.</p>
			<select name="featured_photo">
				<option value="0" <?php selected( 0, $value ); ?> >No </option>
				<option value="1" <?php selected( 1, $value ); ?> >Yes </option>
			</select>
		<?php
	}

	function meta_box_arquivos_diversos() {
		echo "meta_box_arquivos_diversos";
	}

}

Relatorio::get_instance();

