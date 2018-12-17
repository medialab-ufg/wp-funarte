<?php
namespace funarte;

class Post {
	use Singleton;


	protected function init() {
    add_action('wp_enqueue_scripts', array(&$this, 'extra_files'), 15);
  }
  
  public function extra_files() {
    if (is_home()) {
			wp_enqueue_script('post-js', get_theme_file_uri() . '/inc/post_types/post/post.js', null, microtime(), true);
		}
	}
	
}

Post::get_instance();