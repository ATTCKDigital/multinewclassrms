<?php
//Template for creating and registering an acf block.
//Additional details: https://www.advancedcustomfields.com/blog/acf-5-8-introducing-acf-blocks-for-gutenberg/
//Namespace function names "register_block_blockname" & "block_render_callback_circle-image"

add_action('acf/init', 'register_block_circle_image');
function register_block_circle_image() {
	
	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register a circle-image block
		acf_register_block(array(
			'name'				=> 'circle-image',
			'title'				=> __('Circle Image'),
			'description'		=> __('A custom circle image block.'),
			'render_callback'	=> 'block_render_callback_circle_image',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'circle-image', 'image' ),
			'parent'			=> '',
			'mode'				=> 'edit'
		));
	}
}

function block_render_callback_circle_image( $block ) {
	
	// convert name ("acf/circle-image") into path friendly slug ("circle-image")
	$slug = str_replace('acf/', '', $block['name']);
	
	// include a template part from within the "template-parts/block" folder
	if( file_exists( locate_template("gutenberg/blocks/block_{$slug}/{$slug}.php") ) ) {
		include( locate_template("gutenberg/blocks/block_{$slug}/{$slug}.php") );
	}

}