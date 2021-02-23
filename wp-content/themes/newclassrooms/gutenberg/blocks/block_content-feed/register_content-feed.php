<?php
//Template for creating and registering an acf block.
//Additional details: https://www.advancedcustomfields.com/blog/acf-5-8-introducing-acf-blocks-for-gutenberg/
//Namespace function names "register_block_blockname" & "block_render_callback_feed-section"

add_action('acf/init', 'register_block_content_feed');
function register_block_content_feed() {

	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register a feed-section block
		acf_register_block(array(
			'name'				=> 'content-feed',
			'title'				=> __('Content Feed'),
			'description'		=> __('Displays custom post content.'),
			'render_callback'	=> 'block_render_callback_content_feed',
			'category'			=> 'formatting',
			'icon'				=> 'editor-table',
			'keywords'			=> array( 'content-feed', 'feed' ),
			'mode'				=> 'edit'
		));
	}
}

function block_render_callback_content_feed( $block ) {
	// Convert name ("acf/feed-section") into path friendly slug ("feed-section")
	$slug = str_replace('acf/', '', $block['name']);
	
	// Include a template part from within the "template-parts/block" folder
	if( file_exists( locate_template("gutenberg/blocks/block_{$slug}/{$slug}.php") ) ) {
		include( locate_template("gutenberg/blocks/block_{$slug}/{$slug}.php") );
	}

}