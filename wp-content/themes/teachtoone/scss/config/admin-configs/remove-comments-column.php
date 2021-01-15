<?php

// Remove comments column from post lists
function flexlayout_disable_comments() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if (post_type_supports($post_type,'comments')) {
			remove_post_type_support($post_type,'comments');
			remove_post_type_support($post_type,'trackbacks');
		}
	}
}
add_action('admin_init','flexlayout_disable_comments');