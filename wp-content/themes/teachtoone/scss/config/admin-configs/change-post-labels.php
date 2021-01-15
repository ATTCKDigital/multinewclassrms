<?php
// Change labels of "Posts" in wp-admin
// https://stackoverflow.com/questions/26145878/renaming-post-to-something-else
// Replace "Stories" with desired label

function flexlayout_change_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'Stories';
	$submenu['edit.php'][5][0] = 'Stories';
	$submenu['edit.php'][10][0] = 'Add Story';
	$submenu['edit.php'][16][0] = 'Tags';
	echo '';
}

add_action('admin_menu', 'flexlayout_change_post_menu_label');

// Change post object labels
function flexlayout_change_post_object_label() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'Stories';
	$labels->singular_name = 'Story';
	$labels->add_new = 'Add Story';
	$labels->add_new_item = 'Add Story';
	$labels->edit_item = 'Edit Story';
	$labels->new_item = 'Story';
	$labels->view_item = 'View Story';
	$labels->search_items = 'Search Stories';
	$labels->not_found = 'No Stories found';
	$labels->not_found_in_trash = 'No Stories found in Trash';
}

add_action('init', 'flexlayout_change_post_object_label');