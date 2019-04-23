<?php

add_action('admin_init', 'theme_options_init');
add_action('admin_menu', 'theme_options_menu');

function theme_options_init() {
	register_setting('theme_options_options', 'theme_options');
}

function theme_options_menu() {
	$topLevelMenuLabel = 'SLUG';
	$page_title = 'Funarte configuração';
	$menu_title = 'Funarte configuração';
	add_menu_page($page_title, $menu_title, 'edit_themes', 'theme_options', 'theme_options_page_callback_function'); 
}

function get_theme_default_options() {
	return array(
		'url_dados_abertos' => 'youtube.com/video'
	);
}

function get_funarte_option($option_name) {
	$option = wp_parse_args( get_option('theme_options'), get_theme_default_options() );
	return isset($option[$option_name]) ? $option[$option_name] : false;
}

function theme_options_page_callback_function() {
?>
	<div class="wrap span-20">
		<h2><?php echo __('Configurações Funarte'); ?></h2>
		<form action="options.php" method="post" class="clear prepend-top">
	  	<?php settings_fields('theme_options_options'); ?>
	  	<?php $options = wp_parse_args( get_option('theme_options'), get_theme_default_options() );?>
	  	<div class="span-20 ">
				<h3><?php _e("Dados Abertos", 'SLUG'); ?></h3>
				<div class="span-6 last">
		  		<label for="wellcome_title"><strong><?php _e("URL Dados Abertos: "); ?></strong></label>
		  		<input type="text" id="wellcome_title" class="text" name="theme_options[url_dados_abertos]" value="<?php echo htmlspecialchars($options['url_dados_abertos']); ?>"/>
				</div>

				<h3>Dados da conta do Instagram</h3>
				<div class="span-6 last">
		  		<label for="instagram-access-token"><strong>Access token</strong></label>
		  		<input type="text" id="instagram-access-token" class="text" name="theme_options[instagram][access_token]" value="<?php echo htmlspecialchars($options['instagram']['access_token']); ?>"/>
				</div>
				<div class="span-6 last">
		  		<label for="instagram-user-id"><strong>User ID</strong></label>
		  		<input type="text" id="instagram-user-id" class="text" name="theme_options[instagram][user_id]" value="<?php echo htmlspecialchars($options['instagram']['user_id']); ?>"/>
				</div>
	  	</div>
			<input type="submit" class="button-primary" value="<?php _e('Salvar', 'SLUG'); ?>" />
		</form>
  </div>
<?php
}
