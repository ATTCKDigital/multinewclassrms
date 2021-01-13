<?php 

/**
 * Advanced Custom Fields Options function
 * Always fetch an Options field value from the default language. Allows user to set global options that will appear on all languages. To use, get_global_option('field_name', 'options');
 * https://support.advancedcustomfields.com/forums/topic/get-option-from-wpml-default-language/
 */
function flexlayout_acf_set_language() {
  return acf_get_setting('default_language');
}

function flexlayout_get_global_option($name) {
	add_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
	$option = get_field($name, 'option');
	remove_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
	return $option;
}