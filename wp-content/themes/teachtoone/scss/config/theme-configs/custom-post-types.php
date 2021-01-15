<?php
add_action('init', 'flexlayout_create_cpt_tax');

// Register custom post types and taxonomies here.
function flexlayout_create_cpt_tax() {
	register_taxonomy('press_tag', array('press'),
		array(
			'hierarchical' => false,
			'labels' => array(
				'name' => __('Tags'),
				'singular_name' => __('Tag'),
				'menu_name' => __('Tags'),
				'all_items' => __('All Tags'),
				'edit_item' => __('Edit Tag'),
				'view_item' => __('View Tag'),
				'add_new_item' => __('Add new Tag'),
				'new_item_nme' => __('New Tag'),
				'parent_item' => __('Parent Tag'),
				'parent_item_colon' => __('Parent Tag:'),
				'search_items' => __('Search Tags'),
				'popular_items' => __('Popular Tags'),
				'separate_items_with_commas' => __('Separate Tags with commas'),
				'add_or_remove_items' => __('Add or remove Tags'),
				'choose_from_most_used' => __('Choose from most used Tags'),
				'not_found' => __('No Tags found'),
			),
			'show_ui' => true,
			'show_in_quick_edit' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'show_in_rest' => true,
			'rewrite' => array('slug' => 'press-tag'),
			'has_archive' => false,
		)
	);


	register_post_type('campaigns',
		array(
			'labels' => array(
				'name' => __('Campaigns'),
				'singular_name' => __('Campaign'),
				'add_new_item' => __('Add new Campaign'),
				'edit_item' => __('Edit Campaign'),
				'new_item' => __('New Campaign'),
				'view_item' => __('View Campaign'),
				'view_items' => __('View Campaign'),
				'search_items' => __('Search Campaign'),
				'not_found' => __('No Campaign found'),
				'not_found_in_trash' => __('No Campaign found in Trash'),
				'archives' => __('Campaign'),
				'attributes' => __('Campaign Attributes'),
				'insert_into_item' => __('Insert into Campaign'),
				'uploaded_to_this_item' => __('Uploaded to this Campaign')
			),
			'hierarchical' => false,
			'public' => true,
			'has_archive' => true,
			'menu_position'=> 30,
			'rewrite' => array('slug' => 'campaigns'),
			'supports' => array('title', 'thumbnail', 'author', 'page-attributes', 'excerpt'),
			'menu_icon'=> 'dashicons-megaphone',
			'exclude_from_search' => false,
			'publicly_queryable'=> true,
			'show_in_nav_menus'=> true,
			'query_var' => true,
		)
	);
}

?>
