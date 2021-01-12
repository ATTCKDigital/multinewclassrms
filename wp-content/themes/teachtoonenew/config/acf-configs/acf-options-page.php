<?php
// custom settings page, use acf to add necessary fields
if (function_exists('acf_add_options_page')) {
	// add global settings in settings menu
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Global Settings',
		'menu_title' 	=> 'Global Settings',
		'parent_slug' 	=> 'options-general.php',
	));
}
