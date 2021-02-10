<?php
//Template for creating and registering an acf block.
//Additional details: https://www.advancedcustomfields.com/blog/acf-5-8-introducing-acf-blocks-for-gutenberg/
//Namespace function names "register_block_blockname" & "block_render_callback_logo-animation"

add_action('acf/init', 'register_block_logo_animation');
function register_block_logo_animation() {
	
	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register a logo-animation block
		acf_register_block(array(
			'name'				=> 'logo-animation',
			'title'				=> __('Logo Animation'),
			'description'		=> __('A custom logo animation block.'),
			'render_callback'	=> 'block_render_callback_logo_animation',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'logo animation', 'image', 'logo' ),
			'parent'			=> '',
			'mode'				=> 'edit'
		));
	}
}

function block_render_callback_logo_animation( $block ) {
	
	// convert name ("acf/logo-animation") into path friendly slug ("logo-animation")
	$slug = str_replace('acf/', '', $block['name']);
	
	// include a template part from within the "template-parts/block" folder
	if( file_exists( locate_template("gutenberg/blocks/block_{$slug}/{$slug}.php") ) ) {
		include( locate_template("gutenberg/blocks/block_{$slug}/{$slug}.php") );
	}

}