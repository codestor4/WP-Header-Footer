<?php

/*
Plugin Name: WP Header Footer
Description: This plugin will help you add scripts in the header and footer.
Author: Omkar Bhagat
Version: 1.0.0
*/

// this will create menu
function create_my_menu() {
	add_menu_page(
		'OB HeaderFooterScripts', // title
		'OB Add Scripts', // name
		'manage_options', // permissions
		'ob-add-scripts', // slug
		'ob_menu_main_content', // this func will tell what to display on the page
		'dashicons-format-quote', // dashicon
		200 // order
	);
}

// when admin menu is called, create my menu will be called
add_action('admin_menu', 'create_my_menu');


function ob_menu_main_content() {

		if(array_key_exists('submit_scripts_update', $_POST)) {
			update_option('ob_header_scripts', $_POST['header_scripts']);
			update_option('ob_footer_scripts', $_POST['footer_scripts']);
			
			?>

			<div class="updated notice notice-success is-dismissible">
		        <p>Changes Saved! Check your site's source code ;)</p>
		    </div>

			<?php
		}

		$header_scripts = get_option('ob_header_scripts', 'none');
		$footer_scripts = get_option('ob_footer_scripts', 'none');

	?>

	<div class="wrap">
		<h2> Update Scripts </h2>

		<form action="" method="POST">
			<label for="header_scripts"> Header Scripts </label>
			<textarea name="header_scripts" class="large-text"><?php print $header_scripts; ?></textarea>

			<label for="footer_scripts"> Footer Scripts </label>
			<textarea name="footer_scripts" class="large-text"><?php print $footer_scripts; ?></textarea>

			<input type="submit" name="submit_scripts_update" value="Update Scripts" class="button button-primary"/>
		</form>
	</div>

	<?php
}

function ob_display_header_scripts() {
	$header_scripts = get_option('ob_header_scripts', 'none');
	print $header_scripts;
}
add_action('wp_head', 'ob_display_header_scripts');

function ob_display_footer_scripts() {
	$footer_scripts = get_option('ob_footer_scripts', 'none');
	print $footer_scripts;
}
add_action('wp_footer', 'ob_display_footer_scripts');
?>
