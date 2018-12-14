<?php
namespace funarte;

class TainacanTaxonomyCategoria {
	use Singleton;

	public $taxonomy_categoria = 'tainacan_collection_funarte_taxonomy_categoria';

	protected function init() {
		add_action( 'tainacan-register-admin-hooks', array( $this, 'register_hook' ) );
		add_action( 'tainacan-insert-tainacan-collection', array( $this, 'save_data' ) );
		add_filter( 'tainacan-api-response-collection-meta', array( $this, 'add_meta_to_response' ), 10, 2 );
		add_action( 'init', array( &$this, "register_taxonomy_category" ), 15);
	}

	function register_hook() {
		if ( function_exists( 'tainacan_register_admin_hook' ) ) {
				tainacan_register_admin_hook( 'collection', array( $this, 'form' ) );
		}
	}

	function save_data( $object ) {
		if ( ! function_exists( 'tainacan_get_api_postdata' ) ) {
			return;
		}
		$post = tainacan_get_api_postdata();
		if ( $object->can_edit() ) {
			if ( isset( $post->{$this->taxonomy_categoria} ) ) {
				update_post_meta( $object->get_id(), $this->taxonomy_categoria, $post->{$this->taxonomy_categoria});
				
				$terms = wp_get_object_terms( $object->get_id(), 'category');
				$terms_ID  = [];
				foreach ($terms as $term) {
					$terms_ID[] = $term->term_id;
				}
				wp_remove_object_terms( $object->get_id(), $terms_ID, 'category' );
				wp_set_object_terms( $object->get_id(), $post->{$this->taxonomy_categoria}, 'category');
			}
		}
	}

	function add_meta_to_response( $extra_meta, $request ) {
		$extra_meta = array(
			$this->taxonomy_categoria,
		);
		return $extra_meta;
	}

	function register_taxonomy_category() {
		register_taxonomy_for_object_type( 'category', 'tainacan-collection' );
	}

	function form() {
		if ( ! function_exists( 'tainacan_get_api_postdata' ) ) {
				return '';
		}

		$categories = get_categories();
		ob_start();
		?>
			<div class="field tainacan-collection--change-text-color">
				<label class="label"><?php _e( 'Area', 'tainacan-interface' ); ?></label>
				<div class="control is-clearfix"> 
						<?php foreach ($categories as $categorie): ?>
							<input type="checkbox" name="<?php echo $this->taxonomy_categoria; ?>" value="<?php echo $categorie->slug;?>">
								<?php echo $categorie->name; ?><br>
						<?php endforeach; ?>
				</div>
			</div>
		<?php
		return ob_get_clean();
	}

}

TainacanTaxonomyCategoria::get_instance();

