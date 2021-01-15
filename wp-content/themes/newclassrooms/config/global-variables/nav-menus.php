<?php
	$menus = array(
		'primary' => __('Primary Navigation', '_flex'),
		'secondary' => __('Secondary Navigation', '_flex'),
		'footer' => __('Footer Navigation', '_flex'),
	);

	if (!defined('FLEXLAYOUT_MENUS')) {
		define('FLEXLAYOUT_MENUS', $menus);
	}
